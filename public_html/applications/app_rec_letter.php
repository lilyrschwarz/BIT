<?php
	session_start(); 
  	$_SESSION['completed_p4'];

	// connect to mysql
	$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
	// Check connection
	if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
	}
	//HANDLE FORM VALIDATION
	$somethingEmpty = "";

	$rec2Err = "";
	$rec3Err = "";

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

	// form validation:
	if (isset($_POST['submit'])){
   		$dataReady = true;
   		$_SESSION['completed_p4'] = false;

   		if (empty($_POST["fnameRec"])||empty($_POST["lnameRec"])||
   		empty($_POST["institution"]) ||empty($_POST["email"])){
	       $somethingEmpty = "One or more required fields are missing";
	       $dataReady = false;
	    }

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
	    else if (empty($fnameRecTest2) && empty($lnameRecTest2) && empty($institutionTest2) && empty($emailTest2)){
	    	//do nothing
	    }
	    else{
	    	//if some are empty, comunicate this error to the user
	    	$dataReady = false;
	    	$rec2Err = "Second Rec is missing information";
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
	    else if (empty($fnameRecTest3) && empty($lnameRecTest3) && empty($institutionTest3) && empty($emailTest3)){
	    	//do nothing
	    }
	    else{
	    	//if some are empty, comunicate this error to the user
	    	$dataReady = false;
	    	$rec3Err = "Third Rec is missing information";
	    }

	     //Insert into database 
    	if ($dataReady == true){

    	  $sql = "SELECT * FROM rec_letter WHERE uid = " .$_SESSION['id'];
    	  $result = mysqli_query($conn, $sql) or die ("**Check for existing rec letters failed**");
    	  if (mysqli_num_rows($result) == 0){
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
		  }
		  else{
		  	$sql = "DELETE FROM rec_letter WHERE uid = " .$_SESSION['id'];
			$result = mysqli_query($conn, $sql) or die ("**delete rec letter failed**");

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

		  }

	        //use session id to extract fname and last name.
			$sql = "SELECT fname, lname FROM users WHERE userID = " .$_SESSION['id'];
			$result = mysqli_query($conn, $sql) or die ("**********1st MySQL Error***********");
			$value = mysqli_fetch_object($result);
			$fname = $value->fname;
			$lname = $value->lname;

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
							<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/rec_letter.php"> http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/rec_letter.php </a>

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
							<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/rec_letter.php"> http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/rec_letter.php </a>

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
							<a href="http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/rec_letter.php"> http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/rec_letter.php </a>
						</p>
					</body>
					</html>';
	      	mail($email3, $subject, $msg, $headers) or die ("rec email failed");
	      }

	      $_SESSION['completed_p4'] = true;
	      header("Location:app_transcript.php"); 
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
    <li><a href="app_academic_info.php">Academic Information</a></li>
    <li><a href="app_prior_degrees.php">Prior Degrees</a></li>
    <li><a class="active" href="app_rec_letter.php">Recommendation Letters</a></li>
    <li><a href="app_transcript.php">Transcript</a></li>
    <li><a href="confirmation.php">Finish</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

    <h1> Page 4: Recommendation Letters </h1>
    <form id="mainform" method="post">

      <h3> Recomendation Letter </h3>
      <i>Enter the contact information of the person who will provide your recommendation letter.<br>
      We will reach out to this person and ask for their letter. <br>
      You can see the status of your recommendation letter on your homepage.</i> <br><br>

      <b>Recomendation Letter One (required)</b><br>
      First name <span class="field"><input type="text" name="fnameRec">
      <span class="error"><?php echo " " . $fnameRecErr;?></span></span><br>
      Last name <span class="field"><input type="text" name="lnameRec">
      <span class="error"><?php echo " " . $lnameRecErr;?></span></span><br>
      Institution <span class="field"><input type="text" name="institution">
      <span class="error"><?php echo " " . $institutionErr;?></span></span><br>
      Email <span class="field"><input type="text" name="email">
      <span class="error"><?php echo " " . $emailErr;?></span></span><br>
      <br><br>
      <b>Recomendation Letter Two (optional)</b>
      <span class="error"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $rec2Err;?></span><br>
      First name <span class="field"><input type="text" name="fnameRec2">
      <span class="error"><?php echo " " . $fnameRecErr2;?></span></span><br>
      Last name <span class="field"><input type="text" name="lnameRec2">
      <span class="error"><?php echo " " . $lnameRecErr2;?></span></span><br>
      Institution <span class="field"><input type="text" name="institution2">
      <span class="error"><?php echo " " . $institutionErr2;?></span></span><br>
      Email <span class="field"><input type="text" name="email2">
      <span class="error"><?php echo " " . $emailErr2;?></span></span><br>
      <br><br>
      <b>Recomendation Letter Three (optional)</b>
      <span class="error"><?php echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $rec3Err;?></span><br>
      First name <span class="field"><input type="text" name="fnameRec3">
      <span class="error"><?php echo " " . $fnameRecErr3;?></span></span><br>
      Last name <span class="field"><input type="text" name="lnameRec3">
      <span class="error"><?php echo " " . $lnameRecErr3;?></span></span><br>
      Institution <span class="field"><input type="text" name="institution3">
      <span class="error"><?php echo " " . $institutionErr3;?></span></span><br>
      Email <span class="field"><input type="text" name="email3">
      <span class="error"><?php echo " " . $emailErr3;?></span></span><br>
      

      
      <br> 
      <input type="submit" name="submit" value="Submit" class="btn"><br>
      <span class="error"><?php echo $somethingEmpty;?></span>
      
    </form>
  </body>
</html>