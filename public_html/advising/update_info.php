<?php
/*** LOGIN FUNCTIONALITY BELOW****/
session_start();
if($_SESSION['login_user'] && $_SESSION['role'] == 'alumni'){

}
else{
  echo $_SESSION['login_user'].$_SESSION['role'];
  header("Location: login.php");
}
/*** LOGIN FUNCTIONALITY ABOVE****/


$servername = "localhost";
$username = "BLT";
$password = "Blt1234!";
$dbname = "BLT";
$order=null;

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$address = $_POST['address'];
$phone_num = $_POST['phone_num'];

$order = mysqli_query($conn,"update alumni set email = '$email', address = '$address', phone_num = '$phone_num' where university_id =". $_SESSION['login_user']);

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
  <li><a class="active" href="alumni.php">Home</a></li>
  <li><a href="view_info.php">Current Enrolment</a></li>
  <li><a href="update_info.php">Transcript</a></li>
  <li><a href="alumni_transcript.php">Update Info</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul><br/></br>

  <h2>Update Personal Information</h2>

  <p>Update your personal information.</p>
  <form method="post">
    <label for="email">Email Address:</label>
    <input type="text" name="email" /><br />
    <label for="address">Address:</label>
    <input type="text" name="address" /><br />
    <label for="phone_num">Phone Number:</label>
    <input type="text" name="phone_num" /><br />
    <input type="submit" value="Save" formaction="update_info.php"/>

    <?php
      if ($order) {
        //  echo '<br>Input data is successful';
          header("Location: alumni.php");
      } else {
      //  echo mysqli_connect_error();
        //echo mysqli_error($conn);
        //  echo '<br>Input data is not valid';
      }
     ?>
  </form>

</body>
</html>
