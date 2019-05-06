<?php
session_start();

if($_SESSION['uid'] && $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/applytograduate.php");
}



    //connect to database
    $servername = "localhost";
    $username = "SJL";
    $password = "SJLoss1!";
    $dbname = "SJL";
    $db = new mysqli($servername, $username, $password, $dbname);



    $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['uid']);

    $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['uid']);
    while ($row2 = mysqli_fetch_array($thesis_url )) {
    $url = $row2['FilePath'].$row2['FileName'];
  //  var_dump($url);
    }
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
  <title>Audit</title>
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
    <li><a class="active" href="student.php">Advising Home</a></li>
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
</ul><br/></br>
<div align="center">
  <h2>Eligibility:</h2>

    <?php
    /*****************************************************/
    /* This value starts as 1, but if any of the checks  */
    /* to graduate fail, it gets changed to 0 which will */
    /* indicate to the grad secretary that the audit did */
    /* not complete successfully                         */
    /*****************************************************/
    $credits_sum = $db->query("SELECT sum(c.credits) as sum_of_credits from course c, transcript t where '".$_SESSION['uid']."'=t.uid AND t.crn=c.crn");
    $credits_sum = $credits_sum->fetch_assoc();
    $credits_sum = $credits_sum['sum_of_credits'];

    $cleared = 1;

    $user = $_SESSION['uid'];

    /* FIRST CHECK: did student fill out a form 1?     */
    $sql_1 = "SELECT * FROM form1 WHERE university_id =" .$user.";";
    $result = mysqli_query($db, $sql_1);

    if(empty($result) || $credits_sum<36){
        echo "Student Did Not Complete a Form 1.<br />";
        $cleared = 0;
        //header("Location: applytograduate.php");
    }
    else if (!empty($result)) {
        echo "Student Completed Form 1!<br />";
    }

    /***************************************************/
    /* FIRST CHECK: no more than 1 grade below B       */
    /***************************************************/
    $sql = "SELECT grade FROM transcript WHERE uid = ".$user.";";
    $result_3 = mysqli_query($db,$sql);

    if (!empty($result_3)) {
        while($row = $result_3->fetch_assoc()){
           $final_grades[] = $row;
        }
    }
    else{
        echo "Could Not Fetch Final Grades.<br />";
        $cleared = 0;
    }

    foreach($final_grades as $grades){
        if("{$grades[grade]}" === 'C'){
            $grades_below_b = $grades_below_b + 1;
        }
        else if("{$grades[grade]}" === 'D'){
            $grades_below_b = $grades_below_b + 1;
        }
        else if("{$grades[grade]}" === 'F'){
            $grades_below_b = $grades_below_b + 1;
        }
    }

    if($grades_below_b > 1){
        /* MORE THAN TWO GRADES BELOW B */
        echo "More Than One Grade Below B.<br />";
        $cleared = 0;
    }

    /***************************************************/
    /* SECOND CHECK: overall gpa > 3.5                 */
    /***************************************************/
    $sql = "SELECT GPA FROM student WHERE university_id = ".$user.";";
    $result_4 = mysqli_query($db,$sql);

    if(!empty($result_4)){
        $gpa = $result_4->fetch_assoc();
        if($gpa['GPA'] < (float)3.5){
            /* DID NOT MEET GPA REQT */
            echo "GPA Below 3.5.<br />";
            $cleared = 0;
        }
    }
    else{
	    echo "Could Not Access GPA Information. <br />";
	    echo $db->error;
        $cleared = 0;
    }

    /***************************************************/
    /* THIRD CHECK: overall credits > 36               */
    /***************************************************/



    if(!empty($credits_sum)){
        if($credits_sum < 36){
            /* DID NOT MEET CREDIT MINIMUM */
            echo "Did Not Meet Minimum Credit Requirement.<br />";
            $cleared = 0;
        }
    }
    else{
        echo "Could Not Retreive Credit Information. <br />";
        $cleared = 0;
    }

    /**************************************************/
    /* FOURTH CHECK: did the student's thesis get     */
    /*               approved?                        */
    /**************************************************/
    $thesis_a= $db->query("SELECT thesis_approved as approved FROM student WHERE university_id = '.$user.';");
    $thesis_a = $thesis_a->fetch_assoc();
    $thesis_a = $thesis_a['approved'];


  //  $sql = "SELECT thesis_approved FROM student WHERE university_id = '.$user.';";

        if($thesis_a === 1){
            echo "Thesis Has Been Approved by the GS!<br/>";

        }else{
          echo "Thesis Has Not Been Approved by the GS.<br/>";
          $cleared = 0;
        }
    }
    // else{
    //     echo "Could Not Access Thesis Information.<br />";
    //     echo $db->error;
    //     $cleared = 0;
    // }

    /**************************************************/
    /* IF WE MADE IT TO THIS POINT, CLEAR FOR GRAD!!! */
    /**************************************************/
    if($cleared === 1){
        $sql = "UPDATE student SET clear_for_grad = 1 WHERE university_id =".$user.";";
        echo "<b>Congrats! You are Cleared for Graduation!</b>";
    }else{
      echo "<b>Not Cleared for Graduation.</b>";
    }


    ?>

  </div>
</body>
</html>
