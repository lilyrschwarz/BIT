<?php
/*** LOGIN FUNCTIONALITY BELOW****/
session_start();
if($_SESSION['login_user'] && $_SESSION['role'] == 'student'){

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

$course1sub = $_POST['course1sub'];
$course1num = $_POST['course1num'];
$course1 = $course1sub.$course1num;

$course2sub = $_POST['course2sub'];
$course2num = $_POST['course2num'];
$course2 = $course2sub.$course2num;


$course3sub = $_POST['course3sub'];
$course3num = $_POST['course3num'];
$course3 = $course3sub.$course3num;


$course4sub = $_POST['course4sub'];
$course4num = $_POST['course4num'];
$course4 = $course4sub.$course4num;


$course5sub = $_POST['course5sub'];
$course5num = $_POST['course5num'];
$course5 = $course5sub.$course5num;


$course6sub = $_POST['course6sub'];
$course6num = $_POST['course6num'];
$course6 = $course6sub.$course6num;


$course7sub = $_POST['course7sub'];
$course7num = $_POST['course7num'];
$course7 = $course7sub.$course7num;


$course8sub = $_POST['course8sub'];
$course8num = $_POST['course8num'];
$course8 = $course8sub.$course8num;


$course9sub = $_POST['course9sub'];
$course9num = $_POST['course9num'];
$course9 = $course9sub.$course9num;


$course10sub = $_POST['course10sub'];
$course10num = $_POST['course10num'];
$course10 = $course10sub.$course10num;


$course11sub = $_POST['course11sub'];
$course11num = $_POST['course11num'];
$course11 = $course11sub.$course11num;


$course12sub = $_POST['course12sub'];
$course12num = $_POST['course12num'];
$course12 = $course12sub.$course12num;



$order = mysqli_query($conn,"update form1 set course1sub = '$course1sub', course1num = '$course1num', course2sub = '$course2sub', course2num = '$course2num', course3sub = '$course3sub', course3num = '$course3num', course4sub = '$course4sub', course4num = '$course4num', course5sub = '$course5sub', course5num = '$course5num', course6sub = '$course6sub', course6num = '$course6num', course7sub = '$course7sub', course7num = '$course7num', course8sub = '$course8sub', course8num = '$course8num', course9sub = '$course9sub', course9num = '$course9num', course10sub = '$course10sub', course10num = '$course10num', course11sub = '$course11sub', course11num = '$course11num', course12sub = '$course12sub', course12num = '$course12num' where university_id =". $_SESSION['login_user']);
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
<ul>
<li><a class="active" href="student.php">Home</a></li>
<li><a href="StudentEnrollmentInfo.php">Current Enrollment</a></li>
<li><a href="transcript.php">View Transcript</a></li>
<li><a href="studentinfo.php">Update Personal Information</a></li>
<li><a href="viewStudentPersonalInfo.php">View Personal Information</a></li>
<li><a href="viewform1.php">View Form 1</a></li>
<li><a href="applytograduate.php">Apply to Graduate</a></li>
<li><a href="logout.php">Logout</a></li>
</ul><br/></br>

</head>
<body>

  <h2>Form 1</h2>

  <p>Input your required courses that you will need to take to graduate</p>
  <form method="post">

    <h3>Course 1</h3><br/>
      <?php
      $result = $conn->query("SELECT  subject, course_num FROM courses");
          //or die ("cannot retrieve names");

      echo "<select name='course1'>";
            echo "<option value =0>----</option>";
      while ($row = mysqli_fetch_array($result )) {
            echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
      }
      echo "</select>";
      
      ?>


  <br/><br/>

  <h3>Course 2</h3><br/>
    <?php
    $result = $conn->query("SELECT  subject, course_num FROM courses");
        //or die ("cannot retrieve names");

    echo "<select name='course2'>";
          echo "<option value =0>----</option>";
    while ($row = mysqli_fetch_array($result )) {
          echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
    }
    echo "</select>";
    ?>

<br/><br/>

<h3>Course 3</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course3'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 4</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course4'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 5</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course5'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 6</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course6'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 7</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course7'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 8</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course8'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 9</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course9'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 10</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course10'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 11</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course11'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>

<h3>Course 12</h3><br/>
  <?php
  $result = $conn->query("SELECT  subject, course_num FROM courses");
      //or die ("cannot retrieve names");

  echo "<select name='course12'>";
        echo "<option value =0>----</option>";
  while ($row = mysqli_fetch_array($result )) {
        echo "<option value ='" . $row['subject'] . "." . $row['course_num'] . "'>" .  $row['subject'] . " " . $row['course_num'] . "</option>";
  }
  echo "</select>";
  ?>


<br/><br/>


    <input type="submit" value="Save" formaction="form1.php"/>

    <?php
      if ($order) {

          header("Location: student.php");
      } else {

      }
     ?>
  </form>
</body>
</html>
