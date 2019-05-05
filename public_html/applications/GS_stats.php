<?php
  session_start(); 

  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


















  if (isset($_POST['submit'])){

    $filter_FROM ="";

    $users_semester_WHERE ="";
    $users_year_WHERE ="";
    $users_degree_WHERE ="";

    $apprev_semester_WHERE ="";
    $apprev_year_WHERE ="";
    $apprev_degree_WHERE ="";

    $prideg_semester_WHERE ="";
    $prideg_year_WHERE ="";
    $prideg_degree_WHERE ="";

    $gre_semester_WHERE ="";
    $gre_year_WHERE ="";
    $gre_degree_WHERE ="";

    if (isset($_POST['semester']) || isset($_POST['year']) || isset($_POST['degree_type']) ){
      $filter_FROM = ", academic_info";
    }
    if (isset($_POST['semester'])){
      $users_semester_WHERE = " AND userID=uid AND semester ='".$_POST['semester']."'";
      $apprev_semester_WHERE = " AND app_review.uid=academic_info.uid AND semester ='".$_POST['semester']."'";
      $prideg_semester_WHERE = " AND prior_degrees.uid=academic_info.uid AND semester ='".$_POST['semester']."'";
      $gre_semester_WHERE = " AND gre.uid=academic_info.uid AND semester ='".$_POST['semester']."'";;
    }
    if (isset($_POST['year'])){
      $year_WHERE = " AND academic_info.year =".$_POST['year'];
    }
    if (isset($_POST['degree_type'])){
      $degree_WHERE = " AND degreeType ='".$_POST['degree_type']."'";
    }


    //total num applicants
    $q = "SELECT * FROM users".$filter_FROM." WHERE role = 'A'".$users_semester_WHERE.$year_WHERE.$degree_WHERE;
    $r = mysqli_query($conn, $q) or die($q);
    $numApplicants = 0;
    while($row = mysqli_fetch_assoc($r))
      $numApplicants++;

    //Number Admitted
    $q = "SELECT * FROM app_review".$filter_FROM." WHERE reviewerRole = 'CAC' AND (status = 6 OR status = 7 OR status = 9)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die("num admitted error");
    $numAdmitt = 0;
    while($row = mysqli_fetch_assoc($r))
      $numAdmitt++;

    //Num Rejected
    $q = "SELECT * FROM app_review".$filter_FROM." WHERE reviewerRole = 'CAC' AND status = 8".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("num rejected error");
    $numReject = 0;
    while($row = mysqli_fetch_assoc($r))
      $numReject++;

    //Average GPA
    $q = "SELECT gpa FROM prior_degrees".$filter_FROM." WHERE 1=1".$prideg_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ($q);
    $runningGPA = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['gpa'] != NULL){
        $runningGPA += $row['gpa'];
        $count++;
      }
    }
    $avgGPA = 0;
    if ($count != 0)
      $avgGPA = $runningGPA / $count;

    //Average GRE Verbal
    $q = "SELECT verbal FROM gre".$filter_FROM." WHERE 1=1".$gre_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("avg verbal error");
    $runningVerb = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['verbal'] != NULL){
        $runningVerb += $row['verbal'];
        $count++;
      }
    }
    $avgVerb = 0;
    if ($count != 0)
      $avgVerb = $runningVerb / $count;

    //Average GRE Quant
    $q = "SELECT quant FROM gre".$filter_FROM." WHERE 1=1".$gre_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("avg quant error");
    $runningQuant = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['quant'] != NULL){
        $runningQuant += $row['quant'];
        $count++;
      }
    }
    $avgQuant = 0;
    if ($count != 0)
      $avgQuant = $runningQuant / $count;

    //Average GRE advanced
    $q = "SELECT advScore FROM gre".$filter_FROM." WHERE 1=1".$gre_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("avg advScore error");
    $runningAdv = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['advScore'] != NULL){
        $runningAdv += $row['advScore'];
        $count++;
      }
    }
    $avgAdv = 0;
    if ($count != 0)
      $avgAdv = $runningAdv / $count;

    //Average GRE toefl
    $q = "SELECT toefl FROM gre".$filter_FROM." WHERE 1=1".$gre_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("avg toefl error");
    $runningTOEFL = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['toefl'] != NULL){
        $runningTOEFL += $row['toefl'];
        $count++;
      }
    }
    $avgTOEFL = 0;
    if ($count != 0)
      $avgTOEFL = $runningTOEFL / $count;







    //Average GPA admitted
    $q = "SELECT gpa FROM prior_degrees, app_review".$filter_FROM." WHERE prior_degrees".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg gpa error");
    $runningGPA = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['gpa'] != NULL){
        $runningGPA += $row['gpa'];
        $count++;
      }
    }
    $avgGPAAdmitted = 0;
    if ($count != 0)
      $avgGPAAdmitted = $runningGPA / $count;

    //Average GRE Verbal admitted
    $q = "SELECT verbal FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg verbal error:" + ($conn) );
    $runningVerb = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['verbal'] != NULL){
        $runningVerb += $row['verbal'];
        $count++;
      }
    }
    $avgVerbAdmitted = 0;
    if ($count != 0)
      $avgVerbAdmitted = $runningVerb / $count;

    //Average GRE Quant admitted
    $q = "SELECT quant FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg quant error");
    $runningQuant = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['quant'] != NULL){
        $runningQuant += $row['quant'];
        $count++;
      }
    }
    $avgQuantAdmitted = 0;
    if ($count != 0)
      $avgQuantAdmitted = $runningQuant / $count;

    //Average GRE advanced admitted
    $q = "SELECT advScore FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg advScore error");
    $runningAdv = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['advScore'] != NULL){
        $runningAdv += $row['advScore'];
        $count++;
      }
    }
    $avgAdvAdmitted = 0;
    if ($count != 0)
      $avgAdvAdmitted = $runningAdv / $count;

    //Average GRE toefl admitted
    $q = "SELECT toefl FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg toefl error");
    $runningTOEFL = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['toefl'] != NULL){
        $runningTOEFL += $row['toefl'];
        $count++;
      }
    }
    $avgTOEFLAdmitted = 0;
    if ($count != 0)
      $avgTOEFLAdmitted = $runningTOEFL / $count;






    //Average GPA Reject
    $q = "SELECT gpa FROM prior_degrees, app_review".$filter_FROM." WHERE prior_degrees".".uid = app_review.uid AND (status = 8)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("Reject avg gpa error");
    $runningGPA = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['gpa'] != NULL){
        $runningGPA += $row['gpa'];
        $count++;
      }
    }
    $avgGPAReject = 0;
    if ($count != 0)
      $avgGPAReject = $runningGPA / $count;

    //Average GRE Verbal Reject
    $q = "SELECT verbal FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 8)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("Reject avg verbal error:" + ($conn) );
    $runningVerb = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['verbal'] != NULL){
        $runningVerb += $row['verbal'];
        $count++;
      }
    }
    $avgVerbReject = 0;
    if ($count != 0)
      $avgVerbReject = $runningVerb / $count;

    //Average GRE Quant Reject
    $q = "SELECT quant FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 8)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("Reject avg quant error");
    $runningQuant = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['quant'] != NULL){
        $runningQuant += $row['quant'];
        $count++;
      }
    }
    $avgQuantReject = 0;
    if ($count != 0)
      $avgQuantReject = $runningQuant / $count;

    //Average GRE advanced Reject
    $q = "SELECT advScore FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 8)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("Reject avg advScore error");
    $runningAdv = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['advScore'] != NULL){
        $runningAdv += $row['advScore'];
        $count++;
      }
    }
    $avgAdvReject = 0;
    if ($count != 0)
      $avgAdvReject = $runningAdv / $count;

    //Average GRE toefl Reject
    $q = "SELECT toefl FROM gre, app_review".$filter_FROM." WHERE gre".".uid = app_review.uid AND (status = 8)".$apprev_semester_WHERE.$year_WHERE.$degree_WHERE;;
    $r = mysqli_query($conn, $q) or die ("Reject avg toefl error");
    $runningTOEFL = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['toefl'] != NULL){
        $runningTOEFL += $row['toefl'];
        $count++;
      }
    }
    $avgTOEFLReject = 0;
    if ($count != 0)
      $avgTOEFLReject = $runningTOEFL / $count;

  }




  ///////////////////////////////////////////////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////////////////




  else {
    //total num applicants
    $q = "SELECT * FROM users WHERE role = 'A'";
    $r = mysqli_query($conn, $q) or die("num applicants error");
    $numApplicants = 0;
    while($row = mysqli_fetch_assoc($r))
      $numApplicants++;

    //Number Admitted
    $q = "SELECT * FROM app_review WHERE reviewerRole = 'CAC' AND (status = 6 OR status = 7 OR status = 9)";
    $r = mysqli_query($conn, $q) or die("num admitted error");
    $numAdmitt = 0;
    while($row = mysqli_fetch_assoc($r))
      $numAdmitt++;

    //Num Rejected
    $q = "SELECT * FROM app_review WHERE reviewerRole = 'CAC' AND status = 8";
    $r = mysqli_query($conn, $q) or die ("num rejected error");
    $numReject = 0;
    while($row = mysqli_fetch_assoc($r))
      $numReject++;

    //Average GPA
    $q = "SELECT gpa FROM prior_degrees";
    $r = mysqli_query($conn, $q) or die ("avg gpa error");
    $runningGPA = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['gpa'] != NULL){
        $runningGPA += $row['gpa'];
        $count++;
      }
    }
    $avgGPA = 0;
    if ($count != 0)
      $avgGPA = $runningGPA / $count;

    //Average GRE Verbal
    $q = "SELECT verbal FROM gre";
    $r = mysqli_query($conn, $q) or die ("avg verbal error");
    $runningVerb = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['verbal'] != NULL){
        $runningVerb += $row['verbal'];
        $count++;
      }
    }
    $avgVerb = 0;
    if ($count != 0)
      $avgVerb = $runningVerb / $count;

    //Average GRE Quant
    $q = "SELECT quant FROM gre";
    $r = mysqli_query($conn, $q) or die ("avg quant error");
    $runningQuant = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['quant'] != NULL){
        $runningQuant += $row['quant'];
        $count++;
      }
    }
    $avgQuant = 0;
    if ($count != 0)
      $avgQuant = $runningQuant / $count;

    //Average GRE advanced
    $q = "SELECT advScore FROM gre";
    $r = mysqli_query($conn, $q) or die ("avg advScore error");
    $runningAdv = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['advScore'] != NULL){
        $runningAdv += $row['advScore'];
        $count++;
      }
    }
    $avgAdv = 0;
    if ($count != 0)
      $avgAdv = $runningAdv / $count;

    //Average GRE toefl
    $q = "SELECT toefl FROM gre";
    $r = mysqli_query($conn, $q) or die ("avg toefl error");
    $runningTOEFL = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['toefl'] != NULL){
        $runningTOEFL += $row['toefl'];
        $count++;
      }
    }
    $avgTOEFL = 0;
    if ($count != 0)
      $avgTOEFL = $runningTOEFL / $count;







    //Average GPA admitted
    $q = "SELECT gpa FROM prior_degrees, app_review WHERE prior_degrees".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)";
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg gpa error");
    $runningGPA = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['gpa'] != NULL){
        $runningGPA += $row['gpa'];
        $count++;
      }
    }
    $avgGPAAdmitted = 0;
    if ($count != 0)
      $avgGPAAdmitted = $runningGPA / $count;

    //Average GRE Verbal admitted
    $q = "SELECT verbal FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)";
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg verbal error:" + ($conn) );
    $runningVerb = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['verbal'] != NULL){
        $runningVerb += $row['verbal'];
        $count++;
      }
    }
    $avgVerbAdmitted = 0;
    if ($count != 0)
      $avgVerbAdmitted = $runningVerb / $count;

    //Average GRE Quant admitted
    $q = "SELECT quant FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)";
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg quant error");
    $runningQuant = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['quant'] != NULL){
        $runningQuant += $row['quant'];
        $count++;
      }
    }
    $avgQuantAdmitted = 0;
    if ($count != 0)
      $avgQuantAdmitted = $runningQuant / $count;

    //Average GRE advanced admitted
    $q = "SELECT advScore FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)";
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg advScore error");
    $runningAdv = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['advScore'] != NULL){
        $runningAdv += $row['advScore'];
        $count++;
      }
    }
    $avgAdvAdmitted = 0;
    if ($count != 0)
      $avgAdvAdmitted = $runningAdv / $count;

    //Average GRE toefl admitted
    $q = "SELECT toefl FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 6 OR status = 7 OR status = 9)";
    $r = mysqli_query($conn, $q) or die ("ADMITTED avg toefl error");
    $runningTOEFL = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['toefl'] != NULL){
        $runningTOEFL += $row['toefl'];
        $count++;
      }
    }
    $avgTOEFLAdmitted = 0;
    if ($count != 0)
      $avgTOEFLAdmitted = $runningTOEFL / $count;






    //Average GPA Reject
    $q = "SELECT gpa FROM prior_degrees, app_review WHERE prior_degrees".".uid = app_review.uid AND (status = 8)";
    $r = mysqli_query($conn, $q) or die ("Reject avg gpa error");
    $runningGPA = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['gpa'] != NULL){
        $runningGPA += $row['gpa'];
        $count++;
      }
    }
    $avgGPAReject = 0;
    if ($count != 0)
      $avgGPAReject = $runningGPA / $count;

    //Average GRE Verbal Reject
    $q = "SELECT verbal FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 8)";
    $r = mysqli_query($conn, $q) or die ("Reject avg verbal error:" + ($conn) );
    $runningVerb = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['verbal'] != NULL){
        $runningVerb += $row['verbal'];
        $count++;
      }
    }
    $avgVerbReject = 0;
    if ($count != 0)
      $avgVerbReject = $runningVerb / $count;

    //Average GRE Quant Reject
    $q = "SELECT quant FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 8)";
    $r = mysqli_query($conn, $q) or die ("Reject avg quant error");
    $runningQuant = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['quant'] != NULL){
        $runningQuant += $row['quant'];
        $count++;
      }
    }
    $avgQuantReject = 0;
    if ($count != 0)
      $avgQuantReject = $runningQuant / $count;

    //Average GRE advanced Reject
    $q = "SELECT advScore FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 8)";
    $r = mysqli_query($conn, $q) or die ("Reject avg advScore error");
    $runningAdv = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['advScore'] != NULL){
        $runningAdv += $row['advScore'];
        $count++;
      }
    }
    $avgAdvReject = 0;
    if ($count != 0)
      $avgAdvReject = $runningAdv / $count;

    //Average GRE toefl Reject
    $q = "SELECT toefl FROM gre, app_review WHERE gre".".uid = app_review.uid AND (status = 8)";
    $r = mysqli_query($conn, $q) or die ("Reject avg toefl error");
    $runningTOEFL = 0;
    $count = 0;
    while($row = mysqli_fetch_assoc($r)){
      if ($row['toefl'] != NULL){
        $runningTOEFL += $row['toefl'];
        $count++;
      }
    }
    $avgTOEFLReject = 0;
    if ($count != 0)
      $avgTOEFLReject = $runningTOEFL / $count;

  }

?>

<html>
  <head>
  <title>
    Statistics
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
        margin: 1px 0;
        border: none;
        width: 17.5%;
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
    select {
    	width:290px;
    	text-orientation: 
    }

  </style>

  <link rel="stylesheet" href="style.css">
  </head>
  
  <body>

    <ul>
    <li><a href="GS_home.php">Homepage</a></li>
    <li><a href="GS_admitted_list.php">View Admitted Students</a></li>
    <li><a class="active" href="GS_stats.php">View Statistics</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

    <h2> Applications Statistics</h2>
  

    <br>
    <form method='post'>


	    <select name="semester">
	    <option value ="D" disabled selected value> -- filter by semester -- </option>
	    <option value="FA">Fall</option>
	    <option value="SP">Spring</option>
	    <option value="SU">Summer</option>
	    </select>
	    <br>
	    <select name="year">
	    <option value ="D" disabled selected value> -- filter by year -- </option>
	    <option value="2019">2019</option>
	    <option value="2020">2020</option>
	    <option value="2021">2021</option>
	    <option value="2022">2022</option>
	    <option value="2023">2023</option>
	    <option value="2024">2024</option>
	    <option value="2025">2025</option>
	    <option value="2026">2026</option>
	    <option value="2027">2027</option>
	    <option value="2028">2028</option>
	    <option value="2029">2029</option>
	    <option value="2030">2030</option>
	    </select>
	    <br>
	    <select name="degree_type">
	    <option value ="D" disabled selected value> -- filter by degree program -- </option>
	    <option value="MS">Masters</option>
	    <option value="PHD">PhD</option>
	    </select>
	    <br><br>
      <input name='submit' type='submit' value='Apply Filters' class='btn'><br>
		
	</form>
    
    <h3>Populations </h3>
    <b>Total Number of Applicants: </b><?php echo $numApplicants;?><br>
    <b>Total Number Admitted: </b><?php echo $numAdmitt;?><br>
    <b>Total Number Rejected: </b><?php echo $numReject;?><br><br>

    <h3>General Credential Stats</h3>
    <b>Average GPA: </b><?php echo $avgGPA;?><br>
    <b>Average GRE Verbal Score: </b><?php echo $avgVerb;?><br>
    <b>Average GRE Quantitative Score: </b><?php echo $avgQuant;?><br>
    <b>Average GRE Advanced Score: </b><?php echo $avgAdv;?><br>
    <b>Average TOEFL Verbal Score: </b><?php echo $avgTOEFL;?><br><br>

    <h3>Credential Stats for Admitted Applicants</h3>
    <b>Average GPA: </b><?php echo $avgGPAAdmitted;?><br>
    <b>Average GRE Verbal Score: </b><?php echo $avgVerbAdmitted;?><br>
    <b>Average GRE Quantitative Score: </b><?php echo $avgQuantAdmitted;?><br>
    <b>Average GRE Advanced Score: </b><?php echo $avgAdvAdmitted;?><br>
    <b>Average TOEFL Verbal Score: </b><?php echo $avgTOEFLAdmitted;?><br><br>

    <h3>Credential Stats for Rejected Applicants</h3>
    <b>Average GPA: </b> <?php echo $avgGPAReject;?><br>
    <b>Average GRE Verbal Score: </b><?php echo $avgVerbReject;?><br>
    <b>Average GRE Quantitative Score: </b><?php echo $avgQuantReject;?><br>
    <b>Average GRE Advanced Score: </b><?php echo $avgAdvReject;?><br>
    <b>Average TOEFL Verbal Score: </b><?php echo $avgTOEFLReject;?><br><br>




	<br><br>

  </body>
</html>

