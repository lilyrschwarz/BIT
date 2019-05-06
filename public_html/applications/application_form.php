<?php
  session_start(); 
  /*Important variable that will be used later to determine 
  if we're ready to move to the next page of the application */
  $done = false;
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  //HANDLE FORM VALIDATION
  $somethingEmpty = "";

  $streetErr = "";
  $cityErr = "";
  $stateErr = "";
  $zipErr = "";
  $phoneErr = "";
  $ssnErr = "";

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

  $gpaErr = "";
  $dYearErr = "";
  $universityErr = "";
  $majorErr = "";
  $gpa2Err = "";
  $dYear2Err = "";
  $university2Err = "";
  $major2Err = "";
  $gpa3Err = "";
  $dYear3Err = "";
  $university3Err = "";
  $major3Err = "";
  $gpa4Err = "";
  $dYear4Err = "";
  $university4Err = "";
  $major4Err = "";

  $fnameRecErr = "";
  $lnameRecErr = "";
  $institutionErr = "";
  $emailErr = "";
  $fnameRecErr2 = "";
  $lnameRecErr2 = "";
  $institutionErr2 = "";
  $emailErr2 = "";
  $fnameRecErr3 = "";
  $lnameRecErr3 = "";
  $institutionErr3 = "";
  $emailErr3 = "";

  if (isset($_POST['submit'])){
    $dataReady = true;
    
    ////////////////////////////////////////////////////////////////////////
    //FORM VALIDATIONS
    ////////////////////////////////////////////////////////////////////////
    //make sure nothing's empty
    if(
      empty($_POST["street"]) ||
      empty($_POST["city"]) ||
      empty($_POST["state"]) ||
      empty($_POST["zip"]) ||
      empty($_POST["phone"]) ||
      empty($_POST["ssn"]) ||
      empty($_POST["degreeType"]) ||
      empty($_POST["semester"]) ||
      empty($_POST["appYear"]) ||
      // empty($_POST["verbal"]) ||
      // empty($_POST["quantitative"]) ||
      // empty($_POST["year"]) ||
      // empty($_POST["advScore"]) ||
      // empty($_POST["subject"]) ||
      // empty($_POST["toefl"]) ||
      // empty($_POST["advYear"]) ||
      // empty($_POST["aoi"]) ||
      // empty($_POST["experience"]) ||
      empty($_POST["gpa"]) ||
      empty($_POST["dYear"]) ||
      empty($_POST["university"]) ||
      empty($_POST["major"]) ||
      empty($_POST["type"]) ||
      empty($_POST["fnameRec"]) ||
      empty($_POST["lnameRec"]) ||
      empty($_POST["institution"]) ||
      empty($_POST["email"])){
       $somethingEmpty = "One or more required fields are missing";
       $dataReady = false;
    }
    
	    $streetTest = $_POST["street"];
	    $cityTest = $_POST["city"];
	    // $stateTest = $_POST["state"];
	    $zipTest = $_POST["zip"];
	    $phoneTest = $_POST["phone"];
	    $ssnTest = $_POST["ssn"];
	    
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

	    $gpaTest = $_POST["gpa"];
	    $dYearTest = $_POST["dYear"];
	    $universityTest = $_POST["university"];
	    $majorTest = $_POST["major"];
	    $gpa2Test = $_POST["gpa2"];
	    $dYear2Test = $_POST["dYear2"];
	    $university2Test = $_POST["university2"];
	    $major2Test = $_POST["major2"];
	    $gpa3Test = $_POST["gpa3"];
	    $dYear3Test = $_POST["dYear3"];
	    $university3Test = $_POST["university3"];
	    $major3Test = $_POST["major3"];
	    $gpa4Test = $_POST["gpa4"];
	    $dYear4Test = $_POST["dYear4"];
	    $university4Test = $_POST["university4"];
	    $major4Test = $_POST["major4"];
	    
	    $fnameRecTest = $_POST["fnameRec"];
	    $lnameRecTest = $_POST["lnameRec"];
	    $institutionTest = $_POST["institution"];
	    $emailTest = $_POST["email"];
	    $fnameRecTest2 = $_POST["fnameRec2"];
	    $lnameRecTest2 = $_POST["lnameRec2"];
	    $institutionTest2 = $_POST["institution2"];
	    $emailTest2 = $_POST["email2"];
	    $fnameRecTest3 = $_POST["fnameRec3"];
	    $lnameRecTest3 = $_POST["lnameRec3"];
	    $institutionTest3 = $_POST["institution3"];
	    $emailTest3 = $_POST["email3"];
	    
	    $street = "";
	    $city = "";
	    $state = $_POST["state"];
	    $zip = "";
	    $phone = "";
	    $ssn = "";
	    
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

	    $gpa = "";
	    $dYear = "";
	    $university = "";
	    $major = "";
	    $type = $_POST["type"];
	    $gpa2 = "";
	    $dYear2 = "";
	    $university2 = "";
	    $major2 = "";
	    $type2 = $_POST["type2"];
	    $gpa3 = "";
	    $dYear3 = "";
	    $university3 = "";
	    $major3 = "";
	    $type3 = $_POST["type3"];
	    $gpa4 = "";
	    $dYear4 = "";
	    $university4 = "";
	    $major4 = "";
	    $type4 = $_POST["type4"];
	    
	    $fnameRec = "";
	    $lnameRec = "";
	    $institution = "";
	    $email = "";
	    $fnameRec2 = "";
	    $lnameRec2 = "";
	    $institution2 = "";
	    $email2 = "";
	    $fnameRec3 = "";
	    $lnameRec3 = "";
	    $institution3 = "";
	    $email3 = "";
	    
	    function isValidSSN($value, $low = 0, $high = 999999999){
	    	$value = (int)$value;
	    	if ( $value > $high || $value < $low ) {
	   		  // return false (not a valid value)
	    	  return false;
	    	}
	    	//otherwise the year is valid so return true
	    	return true;
	    }
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
	    function isValidGPA($value, $low = 0, $high = 5.0){
	    	$value = (double)$value;
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

	    if (!empty($streetTest) && !preg_match("/^[a-zA-Z0-9 ]+$/i",$streetTest)) {
	      $streetErr = "Only letters, numbers, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($streetTest)){
	      $streetErr = "Street is required";
	      $dataReady = false;
	    }
	    else{
	      $street = $streetTest;
	    }
	     if (!empty($cityTest) && !preg_match("/^[a-zA-Z0-9 ]+$/i",$cityTest)) {
	      $cityErr = "Only letters, numbers, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($streetTest)){
	      $cityErr = "city is required";
	      $dataReady = false;
	    }
	    else{
	      $city = $cityTest;
	    }
	    if (empty($state)){
	    	$stateErr = "State is required";
	    	$dataReady = false;
	    }
	    if (!empty($zipTest) && !is_numeric($zipTest) && strlen((string)$zipTestp) != 5) {
	      $zipErr = "Only 5 digit numbers allowed";
	      $dataReady = false;
	    } 
	    else if (empty($zipTest)){
	      $zipErr = "Zip is required";
	      $dataReady = false;
	    }
	    else{
	      $zip = $zipTest;
	    }
	    if (!empty($phoneTest) && !is_numeric($phoneTest)) {
	      $phoneErr = "Only numbers allowed";
	      $dataReady = false;
	    } 
	    else if (empty($phoneTest)){
	      $phoneErr = "phone number is required";
	      $dataReady = false;
	    }
	    else{
	      $phone = $phoneTest;
	    }
	    if (!empty($ssnTest) && (!preg_match("/^[0-9]+$/i",$ssnTest) || !isValidSSN($ssnTest))) {
	      $ssnErr = "Not a valid social security number";
	      $dataReady = false;
	    }
	    else if (empty($ssnTest)){
	      $ssnErr = "SSN is required";
	      $dataReady = false;
	    } 
	    else{
	      $ssn = $ssnTest;
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

	    // prior degrees
	    if (!empty($gpaTest) && (!is_numeric($gpaTest) || !isValidGPA($gpaTest))) {
	      $gpaErr = "Not a valid gpa";
	      $dataReady = false;
	    }
	    else if (empty($gpaTest)){
	    	$gpaErr = "GPA required";
	        $dataReady = false;
	    }
	    else{
	      $gpa = $gpaTest;
	    }
	    if (!empty($dYearTest) && (!preg_match("/^[0-9]+$/i",$dYearTest) || !isValidYear($dYearTest))) {
	      $dYearErr = "Not a valid year";
	      $dataReady = false;
	    }
	    else if (empty($dYearTest)){
	      $dYearErr = "Degree year required";
	      $dataReady = false;
	    }
	    else{
	      $dYear = $dYearTest;
	    }
	    if (!empty($universityTest) && (!preg_match("/^[a-zA-Z ]+$/i",$universityTest))) {
	      $universityErr = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($universityTest)){
	      $universityErr = "Degree university required";
	      $dataReady = false;
	    }
	    else{
	      $university = $universityTest;
	    }
	    if (!empty($majorTest) && (!preg_match("/^[a-zA-Z ]+$/i",$majorTest))) {
	      $majorErr = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($majorTest)){
	      $majorErr = "Degree major required";
	      $dataReady = false;
	    }
	    else{
	      $major = $majorTest;
	    }
	    //optional degrees checks
	    if (!empty($gpa2Test) && (!is_numeric($gpa2Test) || !isValidGPA($gpa2Test))) {
	      $gpa2Err = "Not a valid gpa";    
	    }
	    else if (empty($gpa2Test)){} 
	    else{
	      $gpa2 = $gpa2Test;
	    }
	    if (!empty($dYear2Test) && (!preg_match("/^[0-9]+$/i",$dYear2Test) || !isValidYear($dYear2Test))) {
	      $dYear2Err = "Not a valid year";  
	    } 
	    else if (empty($dYear2Test)){} 
	    else{
	      $dYear2 = $dYear2Test;
	    }
	    if (!empty($university2Test) && !preg_match("/^[a-zA-Z ]+$/i",$university2Test)) {
	      $university2Err = "Only letters, and white space allowed";
	    } 
	    else if (empty($university2Test)){} 
	    else{
	      $university2 = $university2Test;
	    }
	    if (!empty($major2Test) && (!preg_match("/^[a-zA-Z ]+$/i",$major2Test))) {
	      $major2Err = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($major2Test)){}
	    else{
	      $major2 = $major2Test;
	    }
	    if (!empty($gpa3Test) && (!is_numeric($gpa3Test) || !isValidGPA($gpa3Test))) {
	      $gpa3Err = "Not a valid gpa";    
	    }
	    else if (empty($gpa3Test)){}  
	    else{
	      $gpa3 = $gpa3Test;
	    }
	    if (!empty($dYear3Test) && (!preg_match("/^[0-9]+$/i",$dYear3Test)  || !isValidYear($dYear3Test))) {
	      $dYear3Err = "Not a valid year";  
	    } 
	    else if (empty($dYear3Test)){} 
	    else{
	      $dYear3 = $dYear3Test;
	    }
	    if (!empty($university3Test) && !preg_match("/^[a-zA-Z ]+$/i",$university3Test) ) {
	      $university3Err = "Only letters, and white space allowed";
	    }
	    else if (empty($university3Test)){} 
	    else{
	      $university3 = $university3Test;
	    }
	    if (!empty($major3Test) && (!preg_match("/^[a-zA-Z ]+$/i",$major3Test))) {
	      $major3Err = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($major3Test)){}
	    else{
	      $major3 = $major3Test;
	    }
	    if (!empty($gpa4Test) && (!is_numeric($gpa4Test) || !isValidGPA($gpa4Test))) {
	      $gpa4Err = "Not a valid gpa";    
	    } 
	    else if (empty($gpa4Test)){} 
	    else{
	      $gpa4 = $gpa4Test;
	    }
	    if (!empty($dYear4Test) && (!preg_match("/^[0-9]+$/i",$dYear4Test) || !isValidYear($dYear4Test))) {
	      $dYear4Err = "Not a valid year";  
	    }
	    else if (empty($dYear4Test)){} 
	    else{
	      $dYear4 = $dYear4Test;
	    }
	    if (!empty($university4Test) && !preg_match("/^[a-zA-Z ]+$/i",$unversity4Test) ) {
	      $university4Err = "Only letters, and white space allowed";
	    }
	    else if (empty($university4Test)){} 
	    else{
	      $university4 = $university4Test;
	    }
	    if (!empty($major4Test) && (!preg_match("/^[a-zA-Z ]+$/i",$major4Test))) {
	      $major4Err = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($major4Test)){}
	    else{
	      $major4 = $major4Test;
	    }

	    //rec checks
	    if (!empty($fnameRecTest) && (!preg_match("/^[a-zA-Z ]+$/i",$fnameRecTest))) {
	      $fnameRecErr = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if(empty($fnameRecTest)){
	      $fnameRecErr = "Recommender name required";
	      $dataReady = false;
	    }
	    else{
	      $fnameRec = $fnameRecTest;
	    }
	    if (!empty($lnameRecTest) && (!preg_match("/^[a-zA-Z ]+$/i",$lnameRecTest))) {
	      $lnameRecErr = "Only letters, and white space allowed";
	      $dataReady = false;
	    }
	    else if(empty($lnameRecTest)){
	      $lnameRecErr = "Recommender name required";
	      $dataReady = false;
	    } 
	    else{
	      $lnameRec = $lnameRecTest;
	    }
	    if (!empty($institutionTest) && !preg_match("/^[a-zA-Z ]+$/i",$institutionTest)) {
	      $institutionErr = "Only letters, and white space allowed";
	      $dataReady = false;
	    }
	    else if (empty($institutionTest)){
	      $institutionErr = "Recommender institution required";
	      $dataReady = false;
	    }
	    else{
	      $institution = $institutionTest;
	    }
	    if (!empty($emailTest) && !filter_var($emailTest, FILTER_VALIDATE_EMAIL) ) {
	      $emailErr = "Invalid email";
	      $dataReady = false;
	    } 
	    else if(empty($emailTest)){
	      $emailErr = "Recommender email required";
	      $dataReady = false;
	    }
	    else{
	      $email = $emailTest;
	    }

	    //Optional Recs
	    $secondRec = false;
	    if (!empty($fnameRecTest2) && !empty($lnameRecTest2) && !empty($institutionTest2) && !empty($emailTest2)){
	    	$secondRec = true;
	    	if (!preg_match("/^[a-zA-Z ]+$/i",$fnameRecTest2)){
	    		$fnameRecErr2 = "Only letters, and white space allowed";
	    		$dataReady = false;
	    	}else{
	    		$fnameRec2 = $fnameRecTest2;
	    	}
	    	if (!preg_match("/^[a-zA-Z ]+$/i",$lnameRecTest2)){
	    		$lnameRecErr2 = "Only letters, and white space allowed";
	    		$dataReady = false;
	    	}else{
	    		$lnameRec2 = $lnameRecTest2;
	    	}
	    	if (!preg_match("/^[a-zA-Z ]+$/i",$institutionTest2)){
	    		$institutionErr2 = "Only letters, and white space allowed";
	    		$dataReady = false;
	    	}else{
	    		$institution2 = $institutionTest2;
	    	}
	    	if (!filter_var($emailTest2, FILTER_VALIDATE_EMAIL)){
	    		$emailErr2 = "Invalid email";
	      		$dataReady = false;
	    	}else{
	    		$email2 = $emailTest2;
	    	}
	    }
	    $thirdRec = false;
	    if (!empty($fnameRecTest3) && !empty($lnameRecTest3) && !empty($institutionTest3) && !empty($emailTest3)){
	    	$thirdRec = true;
	    	if (!preg_match("/^[a-zA-Z ]+$/i",$fnameRecTest3)){
	    		$fnameRecErr3 = "Only letters, and white space allowed";
	    		$dataReady = false;
	    	}else{
	    		$fnameRec3 = $fnameRecTest3;
	    	}
	    	if (!preg_match("/^[a-zA-Z ]+$/i",$lnameRecTest3)){
	    		$lnameRecErr3 = "Only letters, and white space allowed";
	    		$dataReady = false;
	    	}else{
	    		$lnameRec3 = $lnameRecTest3;
	    	}
	    	if (!preg_match("/^[a-zA-Z ]+$/i",$institutionTest3)){
	    		$institutionErr3 = "Only letters, and white space allowed";
	    		$dataReady = false;
	    	}else{
	    		$institution3 = $institutionTest3;
	    	}
	    	if (!filter_var($emailTest3, FILTER_VALIDATE_EMAIL)){
	    		$emailErr3 = "Invalid email";
	      		$dataReady = false;
	    	}else{
	    		$email3 = $emailTest3;
	    	}
	    }

    
    ////////////////////////////////////////////////////////////////////////
    
    
    //Insert into database 
    if ($dataReady == true){
      //use session id to extract fname and last name.
      $sql = "SELECT fname, lname FROM users WHERE userID = " .$_SESSION['id'];
      $result = mysqli_query($conn, $sql) or die ("**********1st MySQL Error***********");
      $value = mysqli_fetch_object($result);
      $fname = $value->fname;
      $lname = $value->lname;
      //personal info
      $sql = "SELECT uid FROM personal_info WHERE uid = " . $_SESSION['id'];
      $result = mysqli_query($conn, $sql) or die ("**Check for existing personal info Error**");
      if (mysqli_num_rows($result) == 0){
	    //fill in personal_info table iniially
	    $sql1 = "INSERT INTO personal_info VALUES('".$fname."', '".$lname."', ".$_SESSION['id'].", '".$street."', '".$city."', '".$state."', ".$zip.", ".$phone.", ".$ssn.")";
	    $result1 = mysqli_query($conn, $sql1) or die ("**********insert personal_info MySQL Error***********");
	  }
	  else{
	  	//upadate personal_info table
	    $sql1 = "UPDATE personal_info SET fname = '" .$fname. "', lname = '" .$lname. "', street = '" .$street. "', city = '" .$city. "', state = '" .$state. "', zip = " .$zip. ", phone = " .$phone. ", ssn = " .$ssn." WHERE uid = " .$_SESSION['id'];
	    $result1 = mysqli_query($conn, $sql1) or die ("**********update personal_info MySQL Error***********");
	  }
      //GRE
      if($subject != NULL){
	    $sql2 = "INSERT INTO gre VALUES(".$verbal.", ".$quantitative.", ".$year.", ".$advScore.", '".$subject."', " .$toefl.", ".$advYear.", ".$_SESSION['id'].")";
	    $result2 = mysqli_query($conn, $sql2) or die ("**********gre subject!=NULL MySQL Error***********");
	  }
	  else{
	  	$sql2 = "INSERT INTO gre VALUES(".$verbal.", ".$quantitative.", ".$year.", ".$advScore.", NULL, " .$toefl.", ".$advYear.", ".$_SESSION['id'].")";
	    $result2 = mysqli_query($conn, $sql2) or die ("**********gre subject==NULL MySQL Error***********");
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
      //fill in prior degrees table
      $sql4 = "INSERT INTO prior_degrees VALUES (".$gpa.", " .$dYear.", '".$university."', '" .$major. "', " .$_SESSION['id']. ", '".$type."')"; 
      $result4 = mysqli_query($conn, $sql4) or die ("**********4th MySQL Error***********");
      if(!empty($_POST["type2"]) && !empty($_POST["gpa2"]) && !empty($_POST["dYear2"]) && !empty($_POST["university2"]) && !empty($_POST["major2"])){
      	$sql4 = "INSERT INTO prior_degrees VALUES (".$gpa2.", " .$dYear2.", '".$university2."', '" .$major2. "', " .$_SESSION['id']. ", '".$type2."')"; 
        $result4 = mysqli_query($conn, $sql4) or die ("**********5.1 MySQL Error***********");
      }
      if(!empty($_POST["type3"]) && !empty($_POST["gpa3"]) && !empty($_POST["dYear3"]) && !empty($_POST["university3"]) && !empty($_POST["major3"])){
      	$sql4 = "INSERT INTO prior_degrees VALUES (".$gpa3.", " .$dYear3.", '".$university3."', '" .$major3. "', " .$_SESSION['id']. ", '".$type3."')"; 
        $result4 = mysqli_query($conn, $sql4) or die ("**********5.2 MySQL Error***********");
      }
      if(!empty($_POST["type4"]) && !empty($_POST["gpa4"]) && !empty($_POST["dYear4"]) && !empty($_POST["university4"]) && !empty($_POST["major4"])){
      	$sql4 = "INSERT INTO prior_degrees VALUES (".$gpa4.", " .$dYear4.", '".$university4."', '" .$major4. "', " .$_SESSION['id']. ", '".$type4."')"; 
        $result4 = mysqli_query($conn, $sql4) or die ("**********5.3 MySQL Error***********");
      }


      //fill in rec_letter table:
      $sql5 = "INSERT INTO rec_letter (fname, lname, email, institution, uid) VALUES('".$fnameRec."', '".$lnameRec."', '".$email."', '".$institution."', " . $_SESSION['id'] . ")";
      $result5 = mysqli_query($conn, $sql5) or die ("**********6th MySQL Error***********");
      //get recID 1
      $recID1;
      $sql = "SELECT MAX(recID) AS id FROM rec_letter";
      $result = mysqli_query($conn, $sql) or die ("get recID 1 failed");
  	  $value = mysqli_fetch_object($result);
 	  $recID1 = $value->id;
      if ($secondRec){
      	$sql = "INSERT INTO rec_letter (fname, lname, email, institution, uid) VALUES('".$fnameRec2."', '".$lnameRec2."', '".$email2."', '".$institution2."', " . $_SESSION['id'] . ")";
      	$result = mysqli_query($conn, $sql) or die ("insert 2nd rec failed"); 
      	//get recID 2
      	$recID2;
      	$sql = "SELECT MAX(recID) AS id FROM rec_letter";
      	$result = mysqli_query($conn, $sql) or die ("get recID 1 failed");
  	 	$value = mysqli_fetch_object($result);
 	  	$recID2 = $value->id;
      }
      if ($thirdRec){
      	$sql = "INSERT INTO rec_letter (fname, lname, email, institution, uid) VALUES('".$fnameRec3."', '".$lnameRec3."', '".$email3."', '".$institution3."', " . $_SESSION['id'] . ")";
      	$result = mysqli_query($conn, $sql) or die ("insert 3rd rec failed");
      	//get recID 3
      	$recID3;
      	$sql = "SELECT MAX(recID) AS id FROM rec_letter";
      	$result = mysqli_query($conn, $sql) or die ("get recID 1 failed");
  	 	$value = mysqli_fetch_object($result);
 	  	$recID3 = $value->id; 
      }

      //email rec
	  $msg = '<html>
				<head>
					<title>Invitation To Write Recommendation Letter</title>
				</head>
				<body>
					<p>
						'.$fname.' '.$lname.' has requested a letter of recommendation from you. If you <br>
						are interested, please copy the code provided, and follow the link below.<br>
						Code: ' .$recID1.'<br><br>
						<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/SJL-dev/applications/public_html/rec_letter.php"> http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/SJL-dev/applications/public_html/rec_letter.php </a>

					</p>
				</body>
				</html>';
	  $subject = "Recommendation Letter for " .$fname." ".$lname."";
	  $headers = "MIME-Version: 1.0" . "\r\n";
	  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      mail($email, $subject, $msg, $headers) or die ("rec email failed");
      
      //email optional recs
      if ($secondRec){
      	 $msg = '<html>
				<head>
					<title>Invitation To Write Recommendation Letter</title>
				</head>
				<body>
					<p>
						'.$fname.' '.$lname.' has requested a letter of recommendation from you. If you <br>
						are interested, please copy the code provided, and follow the link below.<br>
						Code: ' .$recID2.'<br><br>
						<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/SJL-dev/applications/public_html/rec_letter.php"> http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/SJL-dev/applications/public_html/rec_letter.php </a>

					</p>
				</body>
				</html>';
      	mail($email2, $subject, $msg, $headers) or die ("rec email failed");
      }
      if ($thirdRec){
      	 $msg = '<html>
				<head>
					<title>Invitation To Write Recommendation Letter</title>
				</head>
				<body>
					<p>
						'.$fname.' '.$lname.' has requested a letter of recommendation from you. If you <br>
						are interested, please copy the code provided, and follow the link below.<br>
						Code: ' .$recID3.'<br><br>
						<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/SJL-dev/applications/public_html/rec_letter.php"> http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/SJL-dev/applications/public_html/rec_letter.php </a>

					</p>
				</body>
				</html>';
      	mail($email3, $subject, $msg, $headers) or die ("rec email failed");
      }



      $sql = "UPDATE app_review SET status = 2 WHERE uid = " .$_SESSION['id']. "";
      $result = mysqli_query($conn, $sql) or die ("**********UPDATE STATUS MySQL Error***********");
      // If we made it here,  we're done
      $done = true;
    }

 //    var_dump($_FILES);
	// if (ftp_put($ftp_conn, "1.png",$_FILES['fileToUpload']['tmp_name'], FTP_BINARY)){
	//   echo "Successfully uploaded $file.";
	// }
	// else{
	//   echo "Error uploading $file.";
	// }
	  
	    //If the data was successfuly added to database, move to page 2
	    if ($done){
	      echo "done";
	      header("Location:home.php"); 
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
  </style>

  <link rel="stylesheet" href="style.css">
  </head>
  <span class="topright"><form method="post" action="logout.php"><input type="submit" name="submit" value="Logout"></form></span>
  
   <h1> Application Form </h1>
   
  
  <body>
    
    <form id="mainform" method="post">
      <h3> Personal Information </h3>
      Street 
      <span class="field"><input type="text" name="street">
      <span class="error"><?php echo " " . $streetErr;?></span></span><br>
      City
      <span class="field"><input type="text" name="city">
      <span class="error"><?php echo " " . $cityErr;?></span></span><br><br>
      State
      <span class="field"> 
      <select name="state">
      	<option value ="D" disabled selected value> -- select a state -- </option>
		<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="DC">District Of Columbia</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
	  </select><span class="error"><?php echo " " . $stateErr;?></span></span><br><br></span>
      Zip Code
      <span class="field"><input type="text" name="zip">
      <span class="error"><?php echo " " . $zipErr;?></span></span><br>
      Phone Number
      <span class="field"><input type="text" name="phone">
      <span class="error"><?php echo " " . $phoneErr;?></span></span><br>
      SSN 
      <span class="field"><input type="text" name="ssn">
      <span class="error"><?php echo " " . $ssnErr;?></span></span><br> 
      <hr>
      
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
      GRE: <br>
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
      <hr>

      <h3>Prior Degrees </h3>
      <b>Degree One (required)</b><br>
      Degree Type <br>
      <input type="radio" name="type" value="MS"> MS<br>
      <input type="radio" name="type" value="BS"> BS<br>
      <input type="radio" name="type" value="BA"> BA <br>
      GPA <span class="field"><input type="text" name="gpa">
      <span class="error"><?php echo " " . $gpaErr;?></span></span><br>
      Year <span class="field"><input type="text" name="dYear">
      <span class="error"><?php echo " " . $dYearErr;?></span></span><br>
      University <span class="field"><input type="text" name="university">
      <span class="error"><?php echo " " . $universityErr;?></span></span><br>
      Major <span class="field"><input type="text" name="major">
      <span class="error"><?php echo " " . $majorErr;?></span></span><br><br>
    
      <b>Degree Two (optional)</b><br>
      Degree Type <br>
      <input type="radio" name="type2" value="MS"> MS<br>
      <input type="radio" name="type2" value="BS"> BS<br>
      <input type="radio" name="type2" value="BA"> BA <br>
      GPA <span class="field"><input type="text" name="gpa2">
      <span class="error"><?php echo " " . $gpa2Err;?></span></span><br>
      Year <span class="field"><input type="text" name="dYear2">
      <span class="error"><?php echo " " . $dYear2Err;?></span></span><br>
      University <span class="field"><input type="text" name="university2">
      <span class="error"><?php echo " " . $university2Err;?></span></span><br>
      Major <span class="field"><input type="text" name="major2">
      <span class="error"><?php echo " " . $major2Err;?></span></span><br><br>
      
      <b>Degree Three (optional)</b><br>
      Degree Type <br>
      <input type="radio" name="type3" value="MS"> MS<br>
      <input type="radio" name="type3" value="BS"> BS<br>
      <input type="radio" name="type3" value="BA"> BA <br>
      GPA <span class="field"><input type="text" name="gpa3">
      <span class="error"><?php echo " " . $gpa3Err;?></span></span><br>
      Year <span class="field"><input type="text" name="dYear3">
      <span class="error"><?php echo " " . $dYear3Err;?></span></span><br>
      University <span class="field"><input type="text" name="university3">
      <span class="error"><?php echo " " . $university3Err;?></span></span><br>
      Major <span class="field"><input type="text" name="major3">
      <span class="error"><?php echo " " . $major3Err;?></span></span><br><br>

      <b>Degree Four (optional)</b><br>
      Degree Type <br>
      <input type="radio" name="type4" value="MS"> MS<br>
      <input type="radio" name="type4" value="BS"> BS<br>
      <input type="radio" name="type4" value="BA"> BA <br>
      GPA <span class="field"><input type="text" name="gpa4">
      <span class="error"><?php echo " " . $gpa4Err;?></span></span><br>
      Year <span class="field"><input type="text" name="dYear4">
      <span class="error"><?php echo " " . $dYear4Err;?></span></span><br>
      University <span class="field"><input type="text" name="university4">
      <span class="error"><?php echo " " . $university4Err;?></span></span><br>
      Major <span class="field"><input type="text" name="major4">
      <span class="error"><?php echo " " . $major4Err;?></span></span><br><br>
      <hr>

      <h3> Recomendation Letter </h3>
      <i>Enter the contact information of the person who will provide your recommendation letter.<br>
      We will reach out to this person and ask for their letter. <br>
      You can see the status of your recommendation letter on your homepage.</i> <br><br>

      <b>Recomendation Letter One (required)<b><br>
      First name <span class="field"><input type="text" name="fnameRec">
      <span class="error"><?php echo " " . $fnameRecErr;?></span></span><br>
      Last name <span class="field"><input type="text" name="lnameRec">
      <span class="error"><?php echo " " . $lnameRecErr;?></span></span><br>
      Institution <span class="field"><input type="text" name="institution">
      <span class="error"><?php echo " " . $institutionErr;?></span></span><br>
      Email <span class="field"><input type="text" name="email">
      <span class="error"><?php echo " " . $emailErr;?></span></span><br>
      <br><br>
      <b>Recomendation Letter Two (optional)<b><br>
      First name <span class="field"><input type="text" name="fnameRec2">
      <span class="error"><?php echo " " . $fnameRecErr2;?></span></span><br>
      Last name <span class="field"><input type="text" name="lnameRec2">
      <span class="error"><?php echo " " . $lnameRecErr2;?></span></span><br>
      Institution <span class="field"><input type="text" name="institution2">
      <span class="error"><?php echo " " . $institutionErr2;?></span></span><br>
      Email <span class="field"><input type="text" name="email2">
      <span class="error"><?php echo " " . $emailErr2;?></span></span><br>
      <br><br>
      <b>Recomendation Letter Three (optional)<b><br>
      First name <span class="field"><input type="text" name="fnameRec3">
      <span class="error"><?php echo " " . $fnameRecErr3;?></span></span><br>
      Last name <span class="field"><input type="text" name="lnameRec3">
      <span class="error"><?php echo " " . $lnameRecErr3;?></span></span><br>
      Institution <span class="field"><input type="text" name="institution3">
      <span class="error"><?php echo " " . $institutionErr3;?></span></span><br>
      Email <span class="field"><input type="text" name="email3">
      <span class="error"><?php echo " " . $emailErr3;?></span></span><br>
      <br><br><hr>

      <h3><b>Transcript</b></h3>
      Select image to upload:<br><br>
      <input type="file" name="fileToUpload" id="fileToUpload">
      
      <div class="bottomCentered"><input type="submit" name="submit" value="Submit">
      <span class="error"><?php echo $somethingEmpty;?></span></div>
      
    </form>
  </body>
</html>