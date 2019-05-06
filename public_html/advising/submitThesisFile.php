<?php

session_start();

if($_SESSION['uid'] &&  $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php");
}


$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";



  $db = mysqli_connect($servername, $username, $password, $dbname);

  $program_type = $db->query("SELECT program_type from student where university_id =".$_SESSION['uid']) or die("first query failed");


  $thesis_url = $db->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['uid']) or die("first query failed");
  while ($row2 = mysqli_fetch_array($thesis_url )) {
  $url = $row2['FilePath'].$row2['FileName'];
  //  var_dump($url);
  }

  if (!$db) {
	  die("connection failed" . mysqli_connect_error());
  }

  $student_id = $_SESSION['login_user'];
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
  <title>View Info</title>
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

<div align="center">

<h2>Submit Thesis</h2>

<br><br>
<form method='post' enctype="multipart/form-data">
    <input type="file" name="files"/><br><br>
    <input type="submit" name="submit" value="Upload"/>
</form>


<?php
    if(isset($_POST['submit'])) {

	$errors = array();

	$extension = array("pdf");

	if(isset($_FILES["files"])==false)
	{
		echo "<b>Please, Select the file to upload!!!</b>";
		return;
	}

	$uploadThisFile = true;
	$file_name=$_FILES["files"]["name"];
	$ext=pathinfo($file_name,PATHINFO_EXTENSION);


	//check if file is pdf
	if(!in_array(strtolower($ext),$extension)) {
		array_push($errors, "File type is invalid. Name:- ".$file_name);
		$uploadThisFile = false;
	}

	//check for if file already exists
	if(file_exists("Upload/".$_FILES["files"]["name"])) {
		array_push($errors, "File is already exist. Name:- ". $file_name);
		$uploadThisFile = false;
	}

	if($uploadThisFile){
		$tempName = $_FILES['files']['tmp_name'];

		$filename = basename($file_name,$ext).$_SESSION['login_user'];
		$newFileName = $filename.$ext;

    chmod($tempName, 777);
		$dir = 'Upload/';
		if(move_uploaded_file($tempName,'Upload/'.$newFileName)) {
		    //echo "File succesfully uploaded";

		    //opens thesis in another window
		    $url = $dir.$newFileName;
	  		echo "<script>window.open('$url', '_blank');</script>";


		}
		else {
			echo "Not uploaded.";
		}
		//echo $newFileName;
		$sql = mysqli_query($db, "UPDATE thesis
                                  SET FilePath ='$dir', FileName ='$newFileName'
                                  WHERE university_id=".$student_id);

        	if ( $sql === TRUE ) {
                    echo "Thesis successfully submitted.";
                    //header("Location: viewThesisFile.php");
        	}
        	else {
                    echo "error: <br>" .mysqli_error($db);
        	}

	}

	mysqli_close($db);
	$count = count($errors);
	if($count != 0) {
		foreach($errors as $error) {
			echo $error."<br/>";
		}
	}
    }
?>
</div>
</body>
</html>
