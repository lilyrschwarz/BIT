<?php
	session_start(); 
  	$_SESSION['completed_p3'];

	// connect to mysql
	$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
	// Check connection
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}
	//HANDLE FORM VALIDATION
	$somethingEmpty = "";

	$degree2Err = "";
	$degree3Err = "";
	$degree4Err = "";

	$typeErr = "";
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

	// form validation:
	if (isset($_POST['submit'])){
   		$dataReady = true;
   		$_SESSION['completed_p3'] = false;

   		if (empty($_POST["gpa"])||empty($_POST["dYear"])||empty($_POST["university"])
   		||empty($_POST["major"])||empty($_POST["type"])){
   			$somethingEmpty = "One or more required fields are missing";
      	 	$dataReady = false;
   		}

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

	    function isValidGPA($value, $low = 0, $high = 5.0){
	    	$value = (double)$value;
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

	    // prior degrees
	    if (empty($type)){
	    	$typeErr = "Degree type required";
	    	$dataReady = false;
	    }
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
	    $one_is_filled2 = false;
	    $one_is_empty2 = false;
	    if (!empty($gpa2Test) && (!is_numeric($gpa2Test) || !isValidGPA($gpa2Test))) {
	      $gpa2Err = "Not a valid gpa";    
	    }
	    else if (empty($gpa2Test)){$one_is_empty2 = true;} 
	    else{
	      $gpa2 = $gpa2Test;
	      $one_is_filled2 = true;
	    }
	    if (!empty($dYear2Test) && (!preg_match("/^[0-9]+$/i",$dYear2Test) || !isValidYear($dYear2Test))) {
	      $dYear2Err = "Not a valid year";  
	    } 
	    else if (empty($dYear2Test)){$one_is_empty2 = true;} 
	    else{
	      $dYear2 = $dYear2Test;
	      $one_is_filled2 = true;
	    }
	    if (!empty($university2Test) && !preg_match("/^[a-zA-Z ]+$/i",$university2Test)) {
	      $university2Err = "Only letters, and white space allowed";
	    } 
	    else if (empty($university2Test)){$one_is_empty2 = true;} 
	    else{
	      $university2 = $university2Test;
	      $one_is_filled2 = true;
	    }
	    if (!empty($major2Test) && (!preg_match("/^[a-zA-Z ]+$/i",$major2Test))) {
	      $major2Err = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($major2Test)){$one_is_empty2 = true;}
	    else{
	      $major2 = $major2Test;
	      $one_is_filled2 = true;
	    }
	    // handle partially filled degree
	    if($one_is_filled2 == true && $one_is_empty2 == true){
	    	$dataReady = false;
	    	$degree2Err = "Second Degree is missing information";
	    }

	    $one_is_filled3 = false;
	    $one_is_empty3 = false;
	    if (!empty($gpa3Test) && (!is_numeric($gpa3Test) || !isValidGPA($gpa3Test))) {
	      $gpa3Err = "Not a valid gpa";    
	    }
	    else if (empty($gpa3Test)){$one_is_empty3 = true;}  
	    else{
	      $gpa3 = $gpa3Test;
	      $one_is_filled3 = true;
	    }
	    if (!empty($dYear3Test) && (!preg_match("/^[0-9]+$/i",$dYear3Test)  || !isValidYear($dYear3Test))) {
	      $dYear3Err = "Not a valid year";  
	    } 
	    else if (empty($dYear3Test)){$one_is_empty3 = true;} 
	    else{
	      $dYear3 = $dYear3Test;
	      $one_is_filled3 = true;
	    }
	    if (!empty($university3Test) && !preg_match("/^[a-zA-Z ]+$/i",$university3Test) ) {
	      $university3Err = "Only letters, and white space allowed";
	    }
	    else if (empty($university3Test)){$one_is_empty3 = true;} 
	    else{
	      $university3 = $university3Test;
	      $one_is_filled3 = true;
	    }
	    if (!empty($major3Test) && (!preg_match("/^[a-zA-Z ]+$/i",$major3Test))) {
	      $major3Err = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($major3Test)){$one_is_empty3 = true;}
	    else{
	      $major3 = $major3Test;
	      $one_is_filled3 = true;
	    }
	    // handle partially filled degree
	    if($one_is_filled3 == true && $one_is_empty3 == true){
	    	$dataReady = false;
	    	$degree3Err = "Second Degree is missing information";
	    }

	    $one_is_filled4 = false;
	    $one_is_empty4 = false;
	    if (!empty($gpa4Test) && (!is_numeric($gpa4Test) || !isValidGPA($gpa4Test))) {
	      $gpa4Err = "Not a valid gpa";    
	    } 
	    else if (empty($gpa4Test)){$one_is_empty4 = true;} 
	    else{
	      $gpa4 = $gpa4Test;
	      $one_is_filled4 = true;
	    }
	    if (!empty($dYear4Test) && (!preg_match("/^[0-9]+$/i",$dYear4Test) || !isValidYear($dYear4Test))) {
	      $dYear4Err = "Not a valid year";  
	    }
	    else if (empty($dYear4Test)){$one_is_empty4 = true;} 
	    else{
	      $dYear4 = $dYear4Test;
	      $one_is_filled4 = true;
	    }
	    if (!empty($university4Test) && !preg_match("/^[a-zA-Z ]+$/i",$unversity4Test) ) {
	      $university4Err = "Only letters, and white space allowed";
	    }
	    else if (empty($university4Test)){$one_is_empty4 = true;} 
	    else{
	      $university4 = $university4Test;
	      $one_is_filled4 = true;
	    }
	    if (!empty($major4Test) && (!preg_match("/^[a-zA-Z ]+$/i",$major4Test))) {
	      $major4Err = "Only letters, and white space allowed";
	      $dataReady = false;
	    } 
	    else if (empty($major4Test)){$one_is_empty4 = true;}
	    else{
	      $major4 = $major4Test;
	      $one_is_filled4 = true;
	    }
	    // handle partially filled degree
	    if($one_is_filled4 == true && $one_is_empty4 == true){
	    	$dataReady = false;
	    	$degree3Err = "Second Degree is missing information";
	    }


	    //Insert into database 
    	if ($dataReady == true){
    		//fill in prior degrees table
    		$sql = "SELECT * FROM prior_degrees WHERE uid = " .$_SESSION['id'];
    		$result = mysqli_query($conn, $sql) or die ("**Check for existing prior degrees failed**");
    		if (mysqli_num_rows($result) == 0){
				$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa.", " .$dYear.", '".$university."', '" .$major. "', " .$_SESSION['id']. ", '".$type."')"; 
				$result4 = mysqli_query($conn, $sql4) or die ("**********4th MySQL Error***********");
				if(!empty($_POST["type2"]) && !empty($_POST["gpa2"]) && !empty($_POST["dYear2"]) && !empty($_POST["university2"]) && !empty($_POST["major2"])){
					$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa2.", " .$dYear2.", '".$university2."', '" .$major2. "', " .$_SESSION['id']. ", '".$type2."')"; 
					$result4 = mysqli_query($conn, $sql4) or die ("**********5.1 MySQL Error***********");
				}
				if(!empty($_POST["type3"]) && !empty($_POST["gpa3"]) && !empty($_POST["dYear3"]) && !empty($_POST["university3"]) && !empty($_POST["major3"])){
					$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa3.", " .$dYear3.", '".$university3."', '" .$major3. "', " .$_SESSION['id']. ", '".$type3."')"; 
					$result4 = mysqli_query($conn, $sql4) or die ("**********5.2 MySQL Error***********");
				}
				if(!empty($_POST["type4"]) && !empty($_POST["gpa4"]) && !empty($_POST["dYear4"]) && !empty($_POST["university4"]) && !empty($_POST["major4"])){
					$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa4.", " .$dYear4.", '".$university4."', '" .$major4. "', " .$_SESSION['id']. ", '".$type4."')"; 
					$result4 = mysqli_query($conn, $sql4) or die ("**********5.3 MySQL Error***********");
				}
			}
			else{
				$sql = "DELETE FROM prior_degrees WHERE uid = " .$_SESSION['id'];
				$result = mysqli_query($conn, $sql) or die ("**delete prior degrees failed**");

				$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa.", " .$dYear.", '".$university."', '" .$major. "', " .$_SESSION['id']. ", '".$type."')"; 
				$result4 = mysqli_query($conn, $sql4) or die ("**********4th MySQL Error***********");
				if(!empty($_POST["type2"]) && !empty($_POST["gpa2"]) && !empty($_POST["dYear2"]) && !empty($_POST["university2"]) && !empty($_POST["major2"])){
					$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa2.", " .$dYear2.", '".$university2."', '" .$major2. "', " .$_SESSION['id']. ", '".$type2."')"; 
					$result4 = mysqli_query($conn, $sql4) or die ("**********5.1 MySQL Error***********");
				}
				if(!empty($_POST["type3"]) && !empty($_POST["gpa3"]) && !empty($_POST["dYear3"]) && !empty($_POST["university3"]) && !empty($_POST["major3"])){
					$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa3.", " .$dYear3.", '".$university3."', '" .$major3. "', " .$_SESSION['id']. ", '".$type3."')"; 
					$result4 = mysqli_query($conn, $sql4) or die ("**********5.2 MySQL Error***********");
				}
				if(!empty($_POST["type4"]) && !empty($_POST["gpa4"]) && !empty($_POST["dYear4"]) && !empty($_POST["university4"]) && !empty($_POST["major4"])){
					$sql4 = "INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (".$gpa4.", " .$dYear4.", '".$university4."', '" .$major4. "', " .$_SESSION['id']. ", '".$type4."')"; 
					$result4 = mysqli_query($conn, $sql4) or die ("**********5.3 MySQL Error***********");
				}
			}

			$_SESSION['completed_p3'] = true;
			header("Location:app_rec_letter.php"); 
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
        background-color: #4CAF50;
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
      background-color: #4CAF50;
    }

  </style>

  <link rel="stylesheet" href="style.css">
  </head>
  
  
  <body>
    
    <ul>
    <li><a href="app_personal_info.php">Personal Information</a></li>
    <li><a href="app_academic_info.php">Academic Information</a></li>
    <li><a class="active" href="app_prior_degrees.php">Prior Degrees</a></li>
    <li><a href="app_rec_letter.php">Recommendation Letters</a></li>
    <li><a href="app_transcript.php">Transcript</a></li>
    <li><a href="confirmation.php">Finish</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

    <h1> Page 3: Prior Degrees </h1>
    <form id="mainform" method="post">

      <h3>Prior Degrees </h3>
      <b>Degree One (required)</b><br>
      Degree Type 
      <span class="error"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;" . $typeErr;?></span><br>
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
    
      <b>Degree Two (optional)</b><span class="error"><?php echo " " . $degree2Err;?></span><br>
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
      
      <b>Degree Three (optional)</b><span class="error"><?php echo " " . $degree3Err;?></span><br>
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

      <b>Degree Four (optional)</b><span class="error"><?php echo " " . $degree4Err;?></span><br>
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
      
      <br> 
      <input type="submit" name="submit" value="Submit" class="btn"><br>
      <span class="error"><?php echo $somethingEmpty;?></span>
      
    </form>
  </body>
</html>