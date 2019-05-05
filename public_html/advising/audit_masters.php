<?php
session_start();

if($_SESSION['uid'] && $_SESSION['type'] == 'MS'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_htmladvising/applytograduate.php");
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
    $cleared = 1;
    $credits_sum = $db->query("SELECT sum(c.credits) as sum_of_credits from course c, transcript t where '".$_SESSION['uid']."'=t.uid AND t.crn=c.crn");
    $credits_sum = $credits_sum->fetch_assoc();
    $credits_sum = $credits_sum['sum_of_credits'];

    /* store university ID in $user */
    $user = $_SESSION['uid'];

    /* FIRST CHECK: did student fill out a form 1?     */
    $sql_1 = "SELECT * FROM form1 WHERE university_id =" .$user.";";
    $result = mysqli_query($db, $sql_1);

    if(empty($result) || $credits_sum <30){
        echo "Student did not complete a form 1.<br />";
        $cleared = 0;
    }
    else if (!empty($result)) {
        echo "Completed Form 1!<br />";
    }

    /***************************************************/
    /* SECOND CHECK: completed required courses?       */
    /***************************************************/

    if(array_search(6212, $classes) !== FALSE){
        echo "Course 1 Requirement Met! <br />";
    }
    else{
        /* DID NOT MEET COURSE 1 REQT */
        echo "Course 1 Requirement Not Met. <br />";
        $cleared = 0;
    }

    if(array_search(6221, $classes) !== FALSE){
        echo "Course 2 Requirement Met! <br />";
    }
    else{
        /* DID NOT MEET COURSE 2 REQT */
        echo "Course 2 Requirement Not Met. <br />";
        $cleared = 0;
    }

    if(array_search(6461, $classes) !== FALSE){
        echo "Course 3 Requirement Met! <br />";
    }
    else{
        /* DID NOT MEET COURSE 3 REQT */
        echo "Course 3 Requirement Not Met. <br />";
        $cleared = 0;
    }

    /***************************************************/
    /* THIRD CHECK: no more than 2 grades below B      */
    /***************************************************/
    $sql = "SELECT grade FROM transcript WHERE uid = ".$user.";";
    $result_3 = mysqli_query($db,$sql);

    if (!empty($result_3)) {
        while($row = $result_3->fetch_assoc()){
           $final_grades[] = $row;
        }
    }
    else{
        echo "Could not Fetch Final Grades. <br />";
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

    if($grades_below_b > 2){
        /* MORE THAN TWO GRADES BELOW B */
        echo "More Than Two Grades Below B. Grade Requirement Not Met.<br />";
        $cleared = 0;
    }

    /***************************************************/
    /* FOURTH CHECK: overall gpa > 3.0                 */
    /***************************************************/
    $sql = "SELECT GPA FROM student WHERE university_id = ".$user.";";
    $result_4 = mysqli_query($db,$sql);

    if(!empty($result_4)){
        $gpa = $result_4->fetch_assoc();
        if($gpa['GPA'] < (float)3.0){
            /* DID NOT MEET GPA REQT */
            echo "GPA Below 3.0. GPA Requirement Not Met.<br />";
            echo $gpa;
            $cleared = 0;
        }
    }
    else{
      echo "Could Not Access GPA Information.<br />";
      echo $db->error;
        $cleared = 0;
    }

    /***************************************************/
    /* FIFTH CHECK: overall credits > 30               */
    /***************************************************/


    // $sql = "SELECT total_credits FROM student WHERE university_id = '.$user.';";
    // $result_5 = mysqli_query($db,$sql);
 if($credits_sum < 30){
            /* DID NOT MEET CREDIT MINIMUM */
            echo "Did Not Meet Minimum Credit Requirement.<br />";
            $cleared = 0;
        }

    // else{
    //     echo "Could not retreive credit information. Returning... <br />";
    //     $cleared = 0;
    // }

    /***************************************************/
    /* SIXTH CHECK: no more than 2 non-csci classes    */
    /* as a part of the 30 credit minimum              */
    /***************************************************/

    $sql = "SELECT subject FROM form1 WHERE university_id = ".$user.";";
    $result_6 = mysqli_query($db,$sql);

    $class_subj = array();
    if(!empty($result_6)){
        while($row = $result_6->fetch_assoc()){
            $class_subj[] = $row;
        }
    }
    else{
        echo "Could Not Receive Course Subject Data.<br />";
        $cleared = 0;
    }

    $num_noncsci_arr = array_count_values($class_subj);
    $num_noncsci = $num_noncsci_arr['ECE'] + $num_noncsci_arr['MATH'];
    if($num_noncsci > 2){
        /* MORE THAN 2 NON CSCI CLASSES */
        echo "More Than Two Classes in Minimum Credits are Non-CSCI.<br />";
        $cleared = 0;
        //return
    }

    /**************************************************/
    /* IF WE MADE IT TO THIS POINT, CLEAR FOR GRAD!!! */
    /**************************************************/
    if($cleared === 1){
        $sql = "UPDATE student SET clear_for_grad = 1 WHERE university_id =".$user.";";
        mysqli_query($db, $sql);
        echo "<b>Congrats! You are Cleared for Graduation!</b>";
    }else{
      echo "<b>Not Cleared for Graduation.</b>";
    }



    ?>

  </div>
</body>
</html>
