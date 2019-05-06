<?php
session_start();

    if($_SESSION['uid'] && $_SESSION['type'] == 'admin'){
    }
    else{
      echo $_SESSION['uid'].$_SESSION['type'];
      header("Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/registration/menu.php");
    }

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";


  $db = mysqli_connect($servername, $username, $password, $dbname);
  if (!$db) {
          die("connection failed" . mysqli_connect_error());
  }

?>

<!DOCTYPE html>
<html>
<title>Transcript</title>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
    /*tbody tr:nth-child(odd) {
        background-color: #ff33cc;
    }

    tbody tr:nth-child(even) {
        background-color: #e495e4;
    }

    h2 {
      color: #5689DF;
    }*/

    .center{
      text-align: center;
    }

    .topright {
        position: absolute;
        right: 10px;
        top: 20px;
      }
      .btn {
        background-color: #990000;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 40%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
      }
      .field {
        position: absolute;
        left: 180px;
      }
      /*body{line-height: 1.6;}*/
      .bottomCentered{
         position: fixed;
         text-align: center;
         bottom: 30px;
         width: 100%;
      }
      .error {color: #FF0000;}
      .topright {
        position: absolute;
        right: 10px;
        top: 10px;
      }

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
      }

      li a:hover:not(.active) {
      background-color: #111;
      }

      .active {
        background-color: #990000;
      }

  </style>

  <link rel="stylesheet" href="style.css">
  <head>
  <title>View Info</title>
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <!-- <style>
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
  </style> -->
  </head>
  <body>
    <ul>
    <li><a class="active" href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/advisor.php">Advising Home</a></li>
    <!-- <li><a href="StudentEnrollmentInfo.php">Current Enrolment</a></li>
    <li><a href="transcript.php">Transcript</a></li>
    <li><a href="studentinfo.php">Update Info</a></li>
    <li><a href="viewStudentPersonalInfo.php">View Info</a></li> -->
    <!-- <li><a href="form1.php">Update Form 1</a></li>
    <li><a href="viewform1.php">View Form 1</a></li>
    <li><a href="applytograduate.php">Apply to Graduate</a></li> -->


    <!-- <?php

    if (!empty($program_type)) {
      //foreach($course_array as $key=>$value)
      while($row = $program_type->fetch_assoc())
      {
        if($row['program_type'] == 'PhD'){
    ?>

    <li><a href="submitThesisFile.php" >Submit Thesis</a><li>
   <li><a href="<?php echo $url;?>" target="_blank">View Thesis</a><li>
  <?php
    }
   }
  }
              ?> -->
    <!-- <li><a href="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php">Main Menu</a></li> -->
    <li style="float:right"><a href="logout.php">Logout</a></li>

  </ul><br/></br>


<div class="w3-container">
<h1> View PhD Thesis: </h1>

<div class="w3-responsive">

<form method="post">
        <?php
  $result = $db->query("SELECT f_name, l_name,university_id
	  		FROM student
			WHERE program_type = 'PhD'") or die ("No Thesis Submissions");
        echo "Advisee: ";
        echo "<select name='student_id'>";
        while ($row = mysqli_fetch_array($result )) {
                echo "<option value ='".$row['university_id']."'>" .$row['f_name']." ".$row['l_name']. "</option>";
        }
        echo "</select>";
        ?>
        <br><br><input type="submit" name="submit" value="Submit">
</form>

<?php

  $student_id = $_POST['student_id'];
  $_SESSION['student_id'] = $student_id;

  //see if student submitted thesis
  // $studentThesis = mysqli_query($db,"SELECT FilePath, FileName FROM thesis where university_id=".$student_id);
  // $row = mysqli_fetch_array($studentThesis);

  //var_dump($studentThesis);

  if(isset($_POST['submit'])) {
    echo
    '
    <h3>Thesis:</h3>
    <a href= "Upload/'.$student_id.'.pdf" target="_blank">
    View Thesis





    </a><br><br>
    ';     // if(is_null($row['FileName'])) {
	   // echo "Student has not submitted a thesis.";
     //
	   // //updates student thesis requirement to 0, unable to graduate
     //       $updateThesis = $db->query("UPDATE student
     //                                   SET thesis_approved = 0
     //                                   WHERE university_id=".$student_id);
     // }
     // else {

	// //opens thesis in another window
	// $findFile = mysqli_query($db, "SELECT FilePath, FileName FROM thesis where university_id=".$student_id);
 	// while($row = mysqli_fetch_assoc($findFile)) {
  //            $url = $row['FilePath'].$row['FileName'];
  //            echo "<script>window.open('$url', '_blank');</script>";
	}

	//allows advisor to approve thesis
	echo "<form action='ThesisApproved.php' method='post'>
                 <input type='submit' name='approve' value='APPROVE'/>
              </form>";


?>
</div>
</div>
</body>
</html>
