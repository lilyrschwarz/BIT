<?php
	session_start();
	$_SESSION['completed_p2'];
  
	// connect to mysql
	$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
	// Check connection
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}
	//HANDLE FORM VALIDATION
	$somethingEmpty = "";

	$degreeTypeErr = "";
	$appYearErr = "";
	$semesterErr = "";
	$verbalErr = "";
	$quantitativeErr = "";
	$yearErr = "";
	$advScoreErr = "";
	// $subjectErr = "";
	$toeflErr = "";
	$advYearErr = "";
	$aoiErr = "";
	$experienceErr = "";

	// form validation:
	if (isset($_POST['submit'])){
    	$dataReady = true;
    	$_SESSION['completed_p2'] = false;

    	if ( empty($_POST["degreeType"]) || empty($_POST["semester"]) || empty($_POST["appYear"]) ){
    		$somethingEmpty = "One or more required fields are missing";
      	 	$dataReady = false;
    	}

    	$appYearTest = $_POST["appYear"];
    	$verbalTest = $_POST["verbal"];
	    $quantitativeTest = $_POST["quantitative"];
	    $yearTest =  $_POST["year"];
	    $advScoreTest = $_POST["advScore"];
	    // $subjectTest = $_POST["subject"];
	    $toeflTest = $_POST["toefl"];
	    $advYearTest = $_POST["advYear"];
	    $aoiTest = $_POST["aoi"];
	    $experienceTest = $_POST["experience"];

	    $appYear= "";
	    $verbal= "";
	    $quantitative= "";
	    $year= "";
	    $advScore= "";
	    $subject= "";
	    $toefl= "";
	    $advYear= "";
	    $aoi= ""; 
	    $experience= "";
	    $degreeType = $_POST["degreeType"];
	    $semester = $_POST["semester"];

	    function isValidYear($value, $low = 1950, $high = 2019){
	    	$value = (int)$value;
	    	if ( $value > $high || $value < $low ) {
	   		  // return false (not a valid value)
	    	  return false;
	    	}
	    	//otherwise the year is valid so return true
	    	return true;
	    }
	    function isValidAppYear($value, $low = 2019, $high = 2030){
	    	$value = (int)$value;
	    	if ( $value > $high || $value < $low ) {
	   		  // return false (not a valid value)
	    	  return false;
	    	}
	    	//otherwise the year is valid so return true
	    	return true;
	    }
	    function isValidScore($value, $low = 130, $high = 170){
	    	$value = (int)$value;
	    	if ( $value > $high || $value < $low ) {
	   		  // return false (not a valid value)
	    	  return false;
	    	}
	    	//otherwise the year is valid so return true
	    	return true;
	    }
	    function isValidTOEFL($value, $low = 0, $high = 120){
	    	$value = (int)$value;
	    	if ( $value > $high || $value < $low ) {
	   		  // return false (not a valid value)
	    	  return false;
	    	}
	    	//otherwise the year is valid so return true
	    	return true;
	    }

	    if (empty($_POST['degreeType'])){
	      $degreeTypeErr = "Degree type required";
	      $dataReady = false;
	    }
	    if (empty($_POST['semester'])){
	      $semesterErr = "Semester required";
	      $dataReady = false;
	    } 
	    if (!empty($appYearTest) && (!preg_match("/^[0-9]+$/i",$appYearTest) || !isValidAppYear($appYearTest))) {
	      $appYearErr = "Not a valid date";
	      $dataReady = false;
	    }
	    else if (empty($appYearTest)) {
	    	$appYearErr = "Application year required";
	        $dataReady = false;
	    }
	    else{
	      $appYear = $appYearTest;
	    }
	    if (empty($semester)){
	    	$semesterErr = "Application semester required";
	    	$dataReady = false;
	    }
	    //test checks
	    if (!empty($verbalTest) && (!preg_match("/^[0-9]+$/i",$verbalTest) || !isValidScore($verbalTest))) {
	      $verbalErr = "Not a valid GRE score (130-170)";
	      $dataReady = false;
	    }
	    else if (empty($verbalTest)){
	    	$verbal = "NULL";
	    }
	    else{
	      $verbal = $verbalTest;
	    }
	    if (!empty($quantitativeTest) && (!preg_match("/^[0-9]+$/i",$quantitativeTest) || !isValidScore($quantitativeTest))) {
	      $quantitativeErr = "Not a valid GRE score (130-170)";
	      $dataReady = false;
	    }
	    else if (empty($quantitativeTest)){
	    	$quantitative = "NULL";
	    } 
	    else{
	      $quantitative = $quantitativeTest;
	    } 
	    if (!empty($yearTest) && (!preg_match("/^[0-9]+$/i",$yearTest) || !isValidYear($yearTest))) {
	      $yearErr = "Not a valid date";
	      $dataReady = false;
	    }
	    else if (empty($yearTest)){
	    	$year = "NULL";
	    } 
	    else{
	      $year = $yearTest;
	    }
	    if (!empty($advScoreTest) && (!preg_match("/^[0-9]+$/i",$advScoreTest) || !isValidScore($advScoreTest))) {
	      $advScoreErr = "Not a valid GRE score (130-170)";
	      $dataReady = false;
	    } 
	    else if (empty($advScoreTest)){
	    	$advScore = "NULL";
	    }
	    else{
	      $advScore = $advScoreTest;
	    }
	    if (!empty($_POST['subject'])){
	    	$subject = $_POST["subject"]; 
	    }
	    else{
	    	$subject = "NULL";
	    }
	    if (!empty($toeflTest) && (!preg_match("/^[0-9]+$/i",$toeflTest) || !isValidTOEFL($toeflTest))) {
	      $toeflErr = "Not a valid TOEFL score (0-120)";
	      $dataReady = false;
	    } 
	    else if (empty($toeflTest)){
	    	$toefl = "NULL";
	    }
	    else{
	      $toefl = $toeflTest;
	    }
	    if (!empty($advYearTest) && (!preg_match("/^[0-9]+$/i",$advYearTest) || !isValidYear($advYearTest))) {
	      $advYearErr = "Not a valid date";
	      $dataReady = false;
	    }
	    else if (empty($advYearTest)){
	    	$advYear = "NULL";
	    } 
	    else{
	      $advYear = $advYearTest;
	    }
	    if (!empty($aoiTest) && !preg_match("/[A-Za-z0-9 ]+/", $aoiTest)) {
	      $aoiErr = "Only letters, numbers, and white space allowed";
	      $dataReady = false;
	    }
	    else if (empty($aoiTest)) {
	      $aoi = "N/A";
	    }
	    else{
	    	$aoi = $aoiTest;
	    }
	    if (!empty($experienceTest) && !preg_match("/[A-Za-z0-9 ]+/", $experienceTest)) {
	      $experienceErr = "Only letters, numbers, and white space allowed";
	      $dataReady = false;
	    }
	    else if (empty($experienceTest)){
	    	$experience = "N/A";
	    }
	    else{
	      $experience = $experienceTest;
	    }

	    //Insert into database 
    	if ($dataReady == true){
    		//GRE
    		$sql = "SELECT uid FROM gre WHERE uid = " . $_SESSION['id'];
			$result = mysqli_query($conn, $sql) or die ("**Check for existing gre info failed**");
			if (mysqli_num_rows($result) == 0){ 
				if($subject != NULL){
					$sql2 = "INSERT INTO gre VALUES(".$verbal.", ".$quantitative.", ".$year.", ".$advScore.", '".$subject."', " .$toefl.", ".$advYear.", ".$_SESSION['id'].")";
					$result2 = mysqli_query($conn, $sql2) or die ("**********gre subject!=NULL MySQL Error***********");
				}
				else{
					$sql2 = "INSERT INTO gre VALUES(".$verbal.", ".$quantitative.", ".$year.", ".$advScore.", NULL, " .$toefl.", ".$advYear.", ".$_SESSION['id'].")";
					$result2 = mysqli_query($conn, $sql2) or die ("**********gre subject==NULL MySQL Error***********");
				}
			}
			else{
				if($subject != NULL){
					$sql2 = "UPDATE gre SET verbal=".$verbal.", quant=".$quantitative.", year=".$year.", advScore=".$advScore.", subject='".$subject."', toefl=" .$toefl.", advYear=".$advYear." WHERE uid=".$_SESSION['id'];
					$result2 = mysqli_query($conn, $sql2) or die ("**********gre subject!=NULL MySQL Error***********");
				}
				else{
					$sql2 = "UPDATE gre SET verbal=".$verbal.", quant=".$quantitative.", year=".$year.", advScore=".$advScore.", subject=NULL, toefl=" .$toefl.", advYear=".$advYear." WHERE uid=".$_SESSION['id'];
					$result2 = mysqli_query($conn, $sql2) or die ("**********gre subject==NULL MySQL Error***********");
				}
			}

			//academic info
			$sql = "SELECT uid FROM academic_info WHERE uid = " . $_SESSION['id'];
			$result = mysqli_query($conn, $sql) or die ("**Check for existing academic info failed**");
			if (mysqli_num_rows($result) == 0){
				$sql3 = "INSERT INTO academic_info (uid, degreeType, AOI, experience, semester, year) VALUES(".$_SESSION['id'].", '".$degreeType."', '".$aoi."', '".$experience."', '".$semester."', ".$appYear.")";
				$result3 = mysqli_query($conn, $sql3) or die ("**********insert into academic info failed***********");
			}
			else{
				$sql3 = "UPDATE academic_info SET degreeType = '" .$degreeType. "', AOI = '" .$aoi. "', experience = '" .$experience. "', semester = '" .$semester. "', year = " .$appYear. " WHERE uid = " .$_SESSION['id'] ."";
				$result3 = mysqli_query($conn, $sql3) or die ("**********update academic info failed***********");
			}

			$_SESSION['completed_p2'] = true;
			header("Location:app_prior_degrees.php"); 
	    	exit;
    	}
    }
?>

<html>
  <head>
  <title>
    Application Form
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
        width: 25%;
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
  
  <body>

  	<ul>
    <li><a href="app_personal_info.php">Personal Information</a></li>
    <li><a class="active" href="app_academic_info.php">Academic Information</a></li>
    <li><a href="app_prior_degrees.php">Prior Degrees</a></li>
    <li><a href="app_rec_letter.php">Recommendation Letters</a></li>
    <li><a href="app_transcript.php">Transcript</a></li>
    <li><a href="confirmation.php">Finish</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

  	<h1> Page 2: Test Scores and Academic Information </h1>
    
    <form id="mainform" method="post">
      
      <h3> Academic Information </h3>
      What degree are you applying for? 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="error"><?php echo " " . $degreeTypeErr;?></span><br>
      <input type="radio" name="degreeType" value="MS" > MS<br>
      <input type="radio" name="degreeType" value="PHD"> PhD<br><br>
      Year <span class="field"><input type="text" name="appYear">
      <span class="error"><?php echo " " . $appYearErr;?></span></span><br> 
      Semester <br>
      <input type="radio" name="semester" value="FA"> Fall<br>
      <input type="radio" name="semester" value="SP"> Spring<br>
      <input type="radio" name="semester" value="SU"> Summer<br>
      <span class="error"><?php echo " " . $semesterErr;?> </span></span> <br><br>
      <b>GRE:</b> <br>
      Verbal <span class="field"><input type="text" name="verbal">
      <span class="error"><?php echo " " . $verbalErr;?></span></span><br>
      Quantitative <span class="field"><input type="text" name="quantitative">
      <span class="error"><?php echo " " . $quantitativeErr;?></span></span><br>
      Year of exam <span class="field"><input type="text" name="year">
      <span class="error"><?php echo " " . $yearErr;?></span></span><br><br>
      GRE advanced: <br>
      Score <span class="field"><input type="text" name="advScore">
      <span class="error"><?php echo " " . $advScoreErr;?></span></span><br>

      <br>Subject <span class="field"> 
      <select name="subject">
      	<option disabled selected value> -- select an option -- </option>
        <option value="Biology">Biology</option>
        <option value="Chemistry">Chemistry</option>
        <option value="English">English</option>
        <option value="Physics">Physics</option>
        <option value="Psychology">Pyschology</option>
      </select> </span><br><br>

      TOEFL Score <span class="field"><input type="text" name="toefl">
      <span class="error"><?php echo " " . $toeflErr;?></span></span><br>
      Year of exam <span class="field"><input type="text" name="advYear">
      <span class="error"><?php echo " " . $advYearErr;?></span></span><br><br>
      Areas of Interest <span class="field"><input type="text" name="aoi">
      <span class="error"><?php echo " " . $aoiErr;?></span></span><br>
      Experience <span class="field"><input type="text" name="experience">
      <span class="error"><?php echo " " . $experienceErr;?></span></span><br>
    
      <br> 
      <input type="submit" name="submit" value="Submit" class="btn"><br>
      <span class="error"><?php echo $somethingEmpty;?></span>
      
    </form>
  </body>
</html>