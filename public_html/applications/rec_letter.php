<?php
  session_start(); 
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  //FORM VALIDATION
  $dataReady = true;
  if (isset($_POST['submit'])){

    $recIDTest = $_POST["recID"];
    $recIDErr = "";
    $recID = "";
    $recTest = $_POST["rec"];
    $recErr = "";
    $rec = "";

    if(empty($recIDTest)){
    	$recIDErr = "Code required";
    	$dataReady = false;
    }
    else if (!is_numeric($recIDTest)){
    	$recIDErr = "Invalid code";
    	$dataReady = false;
    }
    else{
    	$sql = "SELECT * FROM rec_letter WHERE recID = " .$recIDTest. "";
    	$result = mysqli_query($conn, $sql) or die ("************* Select query failed *************");
    	if (mysqli_num_rows($result) == 0){
	        $recIDErr = "The code entered does not match any of the applicants";
	        $dataReady = false;
      }
      else
    		$recID = $recIDTest;
    }

    if(strlen($recTest) > 10000){
    	$recErr = "Your recommendation letter is too long";
    	$dataReady = false;
    }
    else if (empty($recTest)){
    	$recErr = "Please write your recommendation";
    	$dataReady = false;
    }
    else{
    	$rec = $recTest;
    }


    if ($dataReady){
    	$sql = "UPDATE rec_letter SET recommendation = '" .$rec. "' WHERE recID = " .$recID. "";
    	$result = mysqli_query($conn, $sql) or die ("The format of your recommendation could not be accepted. <br>Note: copying and pasting from outside the site may cause issues. Try typing it out instead.");
    	die("<h3> Recommendation Letter Sent. Please Exit This Page </h3>");
    }
  }
?>

<html>
 <head>
  <title>
    Recomendation Letter
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
  </style>
  <link rel="stylesheet" href="style.css">
 </head>
  
   <h1> Write Your Recommendation </h1>
   
  <body>
    
    <form id="mainform" method="post">
      Enter the code that was supplied in the email: <br>
      <input type="text" name="recID">
      <span class="error"><?php echo " " . $recIDErr;?></span></span>
      <br><br>
      
      <h3> Write recommendation below </h3>
      <textarea rows="50" cols="100" name="rec" form="mainform"> Enter Recommendation (250 words max)</textarea> <br>
      <span class="error"><?php echo " " . $recErr;?></span></span>

      <input type="submit" name="submit" value="Submit Recommendation" class="btn">

    </form>
      
    </form>

  </body>
</html>