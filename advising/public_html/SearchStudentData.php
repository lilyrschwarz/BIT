<?php
session_start();
if($_SESSION['login_user'] && $_SESSION['role'] == 'graduate_secretary'){
}
else{
  echo $_SESSION['login_user'].$_SESSION['role'];
  header("Location: login.php");
}

$servername = "localhost";
$username = "BLT";
$password = "Blt1234!";
$dbname = "BLT";

//create connection
$db = new mysqli($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
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
  <li><a class="active" href="gs.php">Home</a></li>
  <li><a href="SearchStudentData.php">Search Student Information</a></li>
  <li><a href="SearchStudentTranscriptGS.php">Search Student Transcript</a></li>
  <li><a href="AssignAdvisor.php">Assign Advisor to Student</a></li>
  <li><a href="SearchStudentRequirements.php">Graduate a Student</a></li>
  <li><a href="logout.php">Logout</a></li>
  </ul><br/></br>


<div class="w3-container">
<h2> Student Data </h2>
    <div class="w3-responsive">

    <form method="post">
       <label for="university_id">University ID of Student:</label>
       <input type="text" name="university_id" required/><br/>
       <input type="submit" value="Submit" formaction="SearchStudentData.php"/>
    </form>

    <table class="w3-table-all">
    <tr>
        <th> Student Name </th>
        <th> University ID</th>
        <th> Program Type </th>
    </tr>

<?php
    if($db->connect_error) {echo "connection error";}
    $university_id = $_POST['university_id'] ?? '';

    $result = $db->query( "SELECT f_name, l_name, university_id, program_type
                                  FROM student
                                  WHERE university_id =" .$university_id.";");

    if (!empty($result)) {
        while($row = $result->fetch_assoc())
        {
?>
     <tr>
        <td><?php echo $row["f_name"]; ?> <?php echo " " . $row["l_name"]; ?> </td>
        <td><?php echo $row["university_id"]; ?></td>
        <td><?php echo $row["program_type"]; ?></td>
     </tr>

<?php
        }
    }
?>
</table>

    <table class="w3-table-all">
    <tr>
        <th> Phone Number </th>
        <th> Address </th>
        <th> Email </th>
    </tr>
	    
	    <?php
    if($db->connect_error) {echo "connection error";}
    $university_id = $_POST['university_id'] ?? '';

    $result = $db->query( "SELECT phone_num, email, address
                                  FROM student
                                  WHERE university_id =" .$university_id.";");

    if (!empty($result)) {
        while($row = $result->fetch_assoc())
        {
?>
     <tr>
        <td><?php echo $row["phone_num"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["address"]; ?></td>
     </tr>

<?php
        }
    }
?>
</table>


</div>
</div>


</body>
</html>

