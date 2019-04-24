<?php
/*** LOGIN FUNCTIONALITY BELOW****/
session_start();

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";

//If they somehow got here without logging in, politely send them away
if(!$_SESSION['loggedin']) {
    header("Location: login.php");
    die();
}
$order=null;

// Create connection



$conn = mysqli_connect($servername, $username, $password, $dbname);

$program_type = $conn->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);

$thesis_url = $conn->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['login_user']);
while ($row2 = mysqli_fetch_array($thesis_url )) {
$url = $row2['FilePath'].$row2['FileName'];
//var_dump($url);
}
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//if (isset($_POST['submit'])) {
$email = $_POST['email'];
$address = $_POST['address'];
$phone_num = $_POST['phone_num'];

$order = mysqli_query($conn,"update student set email = '$email', address = '$address', phone_num = '$phone_num' where university_id =". $_SESSION['login_user']);

//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />-->
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
  <li><a class="active" href="student.php">Home</a></li>
  <li><a href="StudentEnrollmentInfo.php">Current Enrolment</a></li>
  <li><a href="transcript.php">Transcript</a></li>
  <li><a href="studentinfo.php">Update Info</a></li>
  <li><a href="viewStudentPersonalInfo.php">View Info</a></li>
  <li><a href="form1.php">Update Form 1</a></li>
  <li><a href="viewform1.php">View Form 1</a></li>
  <li><a href="applytograduate.php">Apply to Graduate</a></li>


  <?php

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
            ?>
  <li><a href="logout.php">Logout</a></li>
</ul><br/></br>

  <h2>Update Personal Information</h2>

  <p>Update your personal information.</p>
  <form method="post">
    <label for="email">Email Address:</label>
    <input type="email" name="email" required/><br />
    <label for="address">Address:</label>
    <input type="text" name="address" required /><br />
    <label for="phone_num">Phone Number:</label>
    <input type="text" name="phone_num" required/><br />
    <input type="submit" value="Save" formaction="studentinfo.php"/>

    <?php
      if ($order) {
        //  echo '<br>Input data is successful';
          header("Location: viewStudentPersonalInfo.php");
      } else {
      //  echo mysqli_connect_error();
        //echo mysqli_error($conn);
        //  echo '<br>Input data is not valid';
      }
     ?>
  </form>

</body>
</html>
