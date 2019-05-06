<?php
session_start();
//If they somehow got here without logging in, politely send them away
    if($_SESSION['uid'] && $_SESSION['type'] == 'secr'){
    }
    else{
      echo $_SESSION['uid'].$_SESSION['type'];
      header("Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/advisor.php");
    }
$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$db = new mysqli($servername, $username, $password, $dbname);


//  $query = mysql_query("SELECT subject, course_num, year, semester, credits, final_grade FROM transcript");
?>
<!DOCTYPE html>
<html>
<head>
<title>View Info</title>
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
  <li><a class="active" href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/student.php">Advising Home</a></li>
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
  <h2>Students Who are Cleared for Graduation</h2>


<!-- display form1 info -->
  <table class="w3-table-all">
  <tr>
    <th>Name</th>
    <th>Email Address</th>
  </tr>

  <?php
    //if($db->connect_error){echo "db connect error";}
    // echo "Student: ".$fullname;
    $alumni_array = $db->query("SELECT f_name, l_name, email FROM student where clear_for_grad =1");
    //echo $_SESSION['username'];
    if (!empty($alumni_array)) {
      //foreach($course_array as $key=>$value)

      while($row = $alumni_array->fetch_assoc())
      {
    ?>
  <tr>
    <td><?php echo $row["f_name"]; ?> <?php echo $row["l_name"]; ?></td>
    <td><?php echo $row["email"]; ?></td>
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
