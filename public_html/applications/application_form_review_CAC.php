<?php
  session_start();
  $_SESSION['recID1'];
  $_SESSION['recID2'];
  $_SESSION['recID3'];  
  /*Important variable that will be used later to determine 
  if we're ready to move to the next page of the application */
  $done = false;

  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  ////////////////////////////////////////////////////
  //RETRIEVE INFORMATION
  ////////////////////////////////////////////////////
  // get the applicant the GS wants to update
  $applicants = mysqli_query($conn, "SELECT * FROM users WHERE role='A'");
  while ($row = $applicants->fetch_assoc()) {
    if (isset($_POST[$row['userID']])) {
      $_SESSION['applicantID'] = $row['userID'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $name = $fname." ".$lname;
    }
  }
  if (!$_SESSION['applicantID'])
    echo "Error: Applicant not found</br>";

  //IF THIS STUDENT HAS ALREADY BEEN REVIEWED, TELL THE USER to go back
  $sql = "SELECT rating FROM app_review WHERE reviewerRole = 'CAC' AND uid = " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql); //or die ("************* INITIAL TEST SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  if ($value->rating != NULL){
    die('<h2> This student has already been reviewed <h2> <br><br>
        <form id="mainform" method="post" action="home.php">
        <input type="submit" name="submit" value="Back to Home">');
  }


  $sql = "SELECT degreeType, AOI, experience, semester, year FROM academic_info WHERE uid= " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* ACADEMIC INFO SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $degreeType = $value->degreeType;
  $aoi = $value->AOI;
  $experience = $value->experience;
  $semester = $value->semester;
  $year = $value->year;

  $sql = "SELECT verbal, quant, year, advScore, subject, toefl, advYear FROM gre WHERE uid= " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* GRE SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $verbal = $value->verbal;
  $quant = $value->quant;
  $greYear = $value->year;
  $advScore = $value->advScore;
  $subject = $value->subject;
  $toefl = $value->toefl;
  $advYear = $value->advYear;

  $sql = "SELECT institution FROM rec_letter WHERE uid = " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* REC LETTER SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $university = $value->institution;
  /////////////////////////////////////////////////////////////

 // FORM VALIDATION
  $somethingEmpty = "";
  $greenlight = 1;
  if (isset($_POST['submit'])){

    if (isset($_POST['rating1']) && (empty($_POST['rating1']) || empty($_POST['generic1']) || empty($_POST['credible1']))) {
      $greenlight = 0;
      $somethingEmpty = "One or more required fields are missing";
    }
    if (isset($_POST['rating2']) && (empty($_POST['rating2']) || empty($_POST['generic2']) || empty($_POST['credible2']))) {
      $greenlight = 0;
      $somethingEmpty = "One or more required fields are missing";
    }
    if (isset($_POST['rating3']) && (empty($_POST['rating3']) || empty($_POST['generic3']) || empty($_POST['credible3']))) {
      $greenlight = 0;
      $somethingEmpty = "One or more required fields are missing";
    }
    if(empty($_POST['action'])){
      $greenlight = 0;
      $somethingEmpty = "One or more required fields are missing";
    }
    
    if ($greenlight == 1){

      $action = $_POST["action"];
      $advisor;
      if (empty($_POST["advisor"]))
        $advisor = "NA";
      else
        $advisor = $_POST["advisor"];
      
      // Calculate final status (THIS WILL INDICATE THE FINAL DECISION) corresponding to the "final decision section" )
      $status = 5;
      if ($action == 1){
        $status = 8;
      }
      if ($action == 2){
        $status = 6;
      }
      if ($action == 3){
        $status = 6;
      }
      if ($action == 4){
        $status = 7;
      }



      // insert rec review into database
      $sql = "SELECT reviewID FROM app_review WHERE uid = ".$_SESSION['applicantID']." AND reviewerRole = 'CAC'";
      $result = mysqli_query($conn, $sql) or die ("************* GET reviewID FAILED*************");
      if (mysqli_num_rows($result) != 0){
        $value = mysqli_fetch_object($result);
        $reviewID = $value->reviewID;
      }
      else{
        die("Cannot Review: This applicant has not been initialized properly int the database");
      }


      //load general review info into datase
      $sql = "UPDATE app_review  SET reviewerRole = '" .$_SESSION['role']. "', reviewerID = " .$_SESSION['id'].", rating = " .$action.", advisor = '" .$advisor. "', status = 5 WHERE reviewID = " .$reviewID. "";
      $result = mysqli_query($conn, $sql) or die ("************* INSERT INTO app_review SQL FAILED *************");

      //update status for all instances of applicant
      $sql = "UPDATE app_review SET status = " .$status. " WHERE uid = " .$_SESSION['applicantID']. "";
      $result = mysqli_query($conn, $sql) or die ("************* UPDATE ALL STATUS'S SQL FAILED************");
       
      //check if defiency is empty. If not, update app review
      if (!empty($_POST["defCourse"])){
        $sql = "UPDATE app_review SET deficiency = '" . $_POST["defCourse"]. "' WHERE uid = " .$_SESSION['applicantID']. " AND reviewID = ".$reviewID . "";
        $result = mysqli_query($conn, $sql) or die ("************* UPDATE app_review WITH dificiency SQL FAILED *************");

      }
      //if comments is not empty, update app review
      if (!empty($_POST["comments"])){
        $sql = "UPDATE app_review SET comments = '" . $_POST["comments"]. "' WHERE uid = " .$_SESSION['applicantID']. " AND reviewID = " .$reviewID . "";
        $result = mysqli_query($conn, $sql) or die ("************* UPDATE app_review WITH comments SQL FAILED *************");
      }
      
      // //check if defiency is empty. If not, update app review
      // if (!empty($_POST["defCourse"])){
      //   $sql = "UPDATE app_review SET deficiency = '" . $_POST["defCourse"]. "' WHERE uid = " .$_SESSION['applicantID']. " AND reviewerRole = '" .$_SESSION['role'] . "'";
      //   $result = mysqli_query($conn, $sql) or die ("************* UPDATE app_review WITH dificiency SQL FAILED *************");
      // }

      // //if comments is not empty, update app review
      // if (!empty($_POST["comments"])){
      //   $sql = "UPDATE app_review SET comments = '" . $_POST["comments"]. "' WHERE uid = " .$_SESSION['applicantID']. " AND reviewerRole = '" .$_SESSION['role'] . "'";
      //   $result = mysqli_query($conn, $sql) or die ("************* UPDATE app_review WITH comments SQL FAILED *************");

      // }


      
      if (isset($_POST['rating1'])){
        $recID = $_SESSION['recID1'];
        $sql = "INSERT INTO rec_review VALUES(" .$reviewID. ", '" .$_SESSION['role']. "', ".$_SESSION['id'].", " .$_POST['rating1'].", " .$_POST['generic1']. ", " .$_POST['credible1']. ", " . $_SESSION['applicantID'].", ". $recID . ")";
        $result = mysqli_query($conn, $sql) or die ("************* INSERT INTO rec_review 1 SQL FAILED *************");
      }
      if (isset($_POST['rating2'])){
        $recID = $_SESSION['recID2'];
        $sql = "INSERT INTO rec_review VALUES(" .$reviewID. ", '" .$_SESSION['role']. "', ".$_SESSION['id'].", " .$_POST['rating2'].", " .$_POST['generic2']. ", " .$_POST['credible2']. ", " . $_SESSION['applicantID'].", ". $recID . ")";
        $result = mysqli_query($conn, $sql) or die ("************* INSERT INTO rec_review 2 SQL FAILED *************");
      }
      if (isset($_POST['rating3'])){
        $recID = $_SESSION['recID3'];
        $sql = "INSERT INTO rec_review VALUES(" .$reviewID. ", '" .$_SESSION['role']. "', ".$_SESSION['id'].", " .$_POST['rating3'].", " .$_POST['generic3']. ", " .$_POST['credible3']. ", " . $_SESSION['applicantID'].", ". $recID . ")";
        $result = mysqli_query($conn, $sql) or die ("************* INSERT INTO rec_review 3 SQL FAILED *************");
      }

      //if reject, require reason, and load reason into database
      if ($_POST["action"] == 1){
        $_SESSION['reviewID'] = $reviewID;
        header("Location:reason_for_reject.php"); 
        exit;
      }

      unset($_SESSION['recID1']);
      unset($_SESSION['recID2']);
      unset($_SESSION['recID3']);

      header("Location:home.php"); 
      exit;
    }
  }
?>

<html>
 <head>
  <title>
    CAC Review Form
  </title>
  
  <style>
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
 </head>

  <ul>
  <li><a href="home.php">Back</a></li>
  <li><a class="active" href="application_form_review.php">Review Applicant</a></li>
  <li style="float:right"><a href="logout.php">Log Out</a></li>
 </ul>
  
  <h1> Graduate Admissions Review Form </h1>

  <body>

    <!-- General info -->
    <b>Name: </b> <u> <?php echo $name; ?> </u> <br><br>
    <b>Student Number: </b> <u> <?php echo $_SESSION['applicantID']; ?> </u> <br><br>
    <b>Semester and Year of Application: </b> <u> <?php echo $semester." ".$year; ?> </u> <br><br>
    <b>Applying for Degree: </b> <u> <?php echo $degreeType; ?> </u> <br><br>
    <hr>

    <!-- Academic info -->
    <h3>Summary of Credentials </h3>
    <b>GRE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Verbal: </b>
    <u> <?php echo $verbal; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Quantitative: </b>
    <u> <?php echo $quant; ?> </u><br>
    <b>Year of Exam: </b> <u> <?php echo $greYear; ?> </u> <br>
    <b>GRE Advanced &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Score: </b>
    <u> <?php echo $advScore; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Subject: </b>
    <u> <?php echo $subject; ?> </u><br>
    <b>TOEFL Score: </b> <u> <?php echo $toefl; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Year of Exam: </b> <u> <?php echo $advYear; ?> </u> <hr>

    <!-- Prior Degrees -->
    <h3>Prior Degrees </h3> 
    <?php
      //display prior degree info in a table format
      $sql = "SELECT * FROM prior_degrees WHERE uid= " .$_SESSION['applicantID'];
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        echo "<table style=width:40%>";
        echo "<tr>";
        echo "<th>Degree</th>";
        echo "<th>GPA </th>";
        //Add Major
        echo "<th>Year</th>";
        echo "<th>University</th>";
        echo "<th>Major</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['deg_type'] . "</td>";
          echo "<td>" . $row['gpa'] . "</td>";
          echo "<td>" . $row['year'] . "</td>";
          echo "<td>" . $row['university'] . "</td>";
           echo "<td>" . $row['major'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
      }
    ?>
    <br>
    <b>Areas of Interest: </b> <u> <?php echo $aoi; ?> </u> <br>
    <b>Experience: </b> <u> <?php echo $experience; ?> </u> <hr>


    <!-- Rec letter -->
    <h3>Recommendation Letter </h3>

    <form id="mainform" method="post">
      <?php
        //show all recommendation letters
        $sql = "SELECT * FROM rec_letter WHERE uid= " .$_SESSION['applicantID'];
        $result = mysqli_query($conn, $sql);
        $num = 1;
        while($row = mysqli_fetch_assoc($result)) {
          echo "<b>Author:</b> <u>".$row['fname']." ".$row['lname']."</u><br>";
          echo "<b>From: </b> <u>".$row['institution']."</u> <br>";
          echo "<b>Letter: </b><br>";
          echo '<textarea readonly rows="15" cols="80" style="font-size: 18px;background: transparent;">'.$row['recommendation'].'</textarea>';
          echo "<br><br>";

          echo 
          '
          Rating: &nbsp;&nbsp;&nbsp;&nbsp; 
          1<input type="radio" name="rating'.$num.'" value=1 > &nbsp;&nbsp;&nbsp;&nbsp;
          2<input type="radio" name="rating'.$num.'" value=2 > &nbsp;&nbsp;&nbsp;&nbsp;
          3<input type="radio" name="rating'.$num.'" value=3 > &nbsp;&nbsp;&nbsp;&nbsp;
          4<input type="radio" name="rating'.$num.'" value=4 > &nbsp;&nbsp;&nbsp;&nbsp;
          5<input type="radio" name="rating'.$num.'" value=5 > <br>
          Generic: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
          Yes<input type="radio" name="generic'.$num.'" value=true> &nbsp;&nbsp;&nbsp;&nbsp;
          No<input type="radio" name="generic'.$num.'" value=false> <br>
          Credible: &nbsp;&nbsp;&nbsp;&nbsp; 
          Yes<input type="radio" name="credible'.$num.'" value=true> &nbsp;&nbsp;&nbsp;&nbsp;
          No<input type="radio" name="credible'.$num.'" value=false> <br><br>
          ';

          if($num == 1){
            $_SESSION['recID1'] = $row['recID'];
          }
          if($num == 2){
            $_SESSION['recID2'] = $row['recID'];
          }
          if($num == 3){
            $_SESSION['recID3'] = $row['recID'];
          }
          $num += 1;
          
        }
      ?>


      <!-- Overall Review -->
      <hr>



       <!--AVERAGE REVIEW GOES HERE-->
      <h2> Recommended Action </h2>
      <i> This is the average review of all faculty reviewers: </i>
      <?php 
        $sql = "SELECT rating FROM app_review WHERE reviewerRole = 'FR' AND uid = " .$_SESSION['applicantID'];
        $result = mysqli_query($conn, $sql) or die ("average review query failed");
        $total = 0;
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
          $temp = (int) $row['rating'];
          $total += $temp;
          $count ++;
        }

        $review = "";
        if ($count == 0){
          $review = "THIS APPLICANT HAS NOT BEEN REVIEWED";
        }
        else{
          $average = $total / $count;
          $average = round($average);
        }
        
        
        if ($average == 1){
          $review = "Reject";
        }
        if ($average == 2){
          $review = "Borderline Admit";
        }
        if ($average == 3){
          $review = "Admit Without Aid";
        }
        if ($average == 4){
          $review = "Admit With Aid";
        }

        echo '<u>'.$review.'</u>';

      ?>
      <hr>


      <h2> Final Decision </h2>

      1. <input type="radio" name="action" value=1 > Reject <br>
      2. <input type="radio" name="action" value=2 > Borderline Admit <br>
      3. <input type="radio" name="action" value=3 > Admit without Aid <br>
      4. <input type="radio" name="action" value=4 > Admit with aid <br>
      
      <b>Deficiency Courses if Any: </b><input type="text" name="defCourse"><br>
      <b>Recommended Advisor: </b><input type="text" name="advisor"><br><br>

      <b>CAC Comments: </b><br>
       <textarea rows="10" cols="71" style="font-size: 18px;" name="comments" form="mainform"></textarea>
      <br><br>

      <input type="submit" name="submit" value="Submit Review" class="btn">
      <span class="error"><?php echo $somethingEmpty;?></span>

    </form>

     

  </body>
</html>
