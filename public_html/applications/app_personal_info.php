<?php
  session_start(); 
  
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
      empty($_POST["ssn"])){
     
       $somethingEmpty = "One or more required fields are missing";
       $dataReady = false;
    }
    
	 $streetTest = $_POST["street"];
    $cityTest = $_POST["city"];
    // $stateTest = $_POST["state"];
    $zipTest = $_POST["zip"];
    $phoneTest = $_POST["phone"];
    $ssnTest = $_POST["ssn"];
    
    $street = "";
    $city = "";
    $state = $_POST["state"];
    $zip = "";
    $phone = "";
    $ssn = "";
	    
  	function isValidSSN($value, $low = 0, $high = 999999999){
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
  
   <h1> Application Form Page 1: Personal Information </h1>
   
  
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
      
      <div class="bottomCentered"><input type="submit" name="submit" value="Submit">
      <span class="error"><?php echo $somethingEmpty;?></span></div>
      
    </form>
  </body>
</html>