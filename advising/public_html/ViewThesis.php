<?php
    session_start();
    if($_SESSION['login_user'] && $_SESSION['role'] == 'advisor'){
    }
    else{
      echo $_SESSION['login_user'].$_SESSION['role'];
      header("Location: login.php");
    }

  $servername = "localhost";
  $username = "BLT";
  $password = "Blt1234!";
  $dbname = "BLT";
  $db = new mysqli($servername, $username, $password, $dbname);
  ?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta charset="UTF-8">
<meta name="viewport">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}
li {
  float: left;
}
li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-family: sans-serif;
}
li a:hover:not(.active) {
  background-color: #111;
}
.active {
  background-color: #4CAF50;
}
</style>

</head>

<body>

<ul>
  <li><a class="active" href="advisor.php">Home</a></li>
  <li><a href="SearchTranscript.php">Search Transcript</a></li>
  <li><a href="SearchForm1.php">Review Form1</a></li>
  <li><a href="ViewThesis.php">View Thesis</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul><br/><br/>

<div class="w3-container">
<h1> Thesis </h1>
<div class="w3-responsive">

 <form method="post">
        <?php
        $result = $db->query("SELECT f_name, l_name,university_id FROM student WHERE program_type = 'PhD' AND advisor =".$_SESSION['login_user']) or die ("cannot retrieve names");
        echo "Advisee: ";
        echo "<select name='student_id'>";
        while ($row = mysqli_fetch_array($result )) {
                echo "<option value =' ".$row['university_id']."'>" .$row['f_name']." ".$row['l_name']. "</option>";
        }
        echo "</select>";
        ?>
        <input type="submit" name="submit" value="Submit">
  </form>

<?php
        $student_id = $_POST['student_id'] ?? '';
        $_SESSION['studentid'] = $student_id;
        $studentThesis = $db->query("SELECT f_name, l_name, thesis
                                     FROM student
                                     WHERE university_id=".$student_id);
        $row = mysqli_fetch_array($studentThesis);
        $studentName = $row['f_name']." ".$row['l_name'];

        if(isset($_POST['submit'])) {
            if(is_null($row['thesis'])) {
                echo "Student has not submitted a thesis.";

                //updates student thesis requirement to 0, unable to graduate
                $updateThesis = $db->query("UPDATE student
                                            SET thesis_approved = 0
                                            WHERE university_id=".$student_id);

            }
            else {
                    echo "<h3>Student: $studentName</h3>";
                    echo "<br/><br>";
                    echo $row['thesis'];
                    echo "<br/><br/>";


                    echo "<form action='ThesisApproved.php' method='post'>
                        <input type='submit' name='approve' value='APPROVE'/>
                    </form>";

                    if(isset($_POST['approve'])) {
                        echo "Thesis approved.";
                        $updateThesis = $db->query("UPDATE student SET thesis_approved = 1 
                                                    WHERE university_id=".$student_id);
		}

	    }
	}

?>


</div>
</div>

</body>
</html>
