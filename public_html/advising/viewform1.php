<?php


session_start();

if($_SESSION['uid'] && $_SESSION['type'] == 'MS' || $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php");
}


$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";

  $db = new mysqli($servername, $username, $password, $dbname);
  $user = $_SESSION['uid'];

  $credits_sum = $db->query("SELECT sum(c.credits) as sum_of_credits from course c, transcript t where '".$_SESSION['uid']."'=t.uid AND t.crn=c.crn");
  $credits_sum = $credits_sum->fetch_assoc();
  $credits_sum = $credits_sum['sum_of_credits'];

  //$program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);
/*
  $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['login_user']);
  while ($row2 = mysqli_fetch_array($thesis_url )) {
        $url = $row2['FilePath'].$row2['FileName'];
        var_dump($url);
  }*/


//  $query = mysql_query("SELECT subject, course_num, year, semester, credits, final_grade FROM transcript");
?>
<!DOCTYPE html>
<html>
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
  <li><a class="active" href="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/advising/student.php">Advising Home</a></li>
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
  <h2>View Form 1</h2>
  <?php

  // if($credits_sum<30){
  //   //echo $credits_sum;
  //   echo "<b>ERROR: You need at least 30 credits to graduate. Please fill out Form 1 with the necessary credentials.</b></br>";
    // $sql_1 = "SELECT * FROM form1 WHERE university_id =" .$user.";";
    // // $result = mysqli_query($db, $sql_1);
    // // $makeEmpty = empty($result);
    // $form1_update = mysqli_query($db,"UPDATE form1 set subject = null, course_num = null where university_id= '$user';");
//  }else{
   ?>
  <div class="w3-responsive">
  <table class="w3-table-all">
  <tr>
    <th>Subject</th>
    <th>Course Number</th>
  </tr>

  <?php
    //if($db->connect_error){echo "db connect error";}

    $course_array = $db->query("SELECT subject, course_num FROM form1 where university_id =".  $_SESSION['uid']);
    //echo $_SESSION['username'];

    if (!empty($course_array)) {
      //foreach($course_array as $key=>$value)
      while($row = $course_array->fetch_assoc())
      {
    ?>
  <tr>
    <td><?php echo $row["subject"]; ?></td>
    <td><?php echo $row["course_num"]; ?></td>
  </tr>

  <?php
                 }
  }
//}
              ?>
  </table>
  </div>

  </div>

</body>
</html>
