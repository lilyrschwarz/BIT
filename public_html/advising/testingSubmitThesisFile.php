<?php
session_start();

if($_SESSION['uid'] &&  $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php");
}


	$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$error = "";
	//$failure = "";
	$confirmation = "";

	if (isset($_POST['submit'])){



		$target_dir = "Upload/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;

		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($target_file)) {
		    $error = "Sorry, file already exists";
		    $uploadOk = 0;
		}

		// Check file size
		// if ($_FILES["fileToUpload"]["size"] > 200000) {
		//     $error = "Sorry, your file is too large";
		//     $uploadOk = 0;
		// }
		//make sure file is pdf
		if ($fileType != "pdf"){
			$error = "Only PDF files allowed";
			$uploadOk = 0;
		}

		$temp = explode("/", $target_file);
		$new_file_name = $temp[0] . "/" . $_SESSION['uid'] . ".pdf";	//automatically replaces - can reupload
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
	    	//$failure = "Sorry, your file was not uploaded.";
	    } else {
		    if (copy($_FILES["fileToUpload"]["tmp_name"], $new_file_name)) {
		        $confirmation = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

		        header("Location:testingSubmitThesisFile.php");
	      		exit;
		    } else {
		        $confirmation = "Sorry, there was an error uploading your file.";
		        //print_r($_FILES);
		    }
		}
	}


?>

<html>
  <head>
  <title>
  Submit Thesis
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

	    <li><a class="active" href="student.php">Advising Home</a></li>
	    <li style="float:right"><a href="logout.php">Log Out</a></li>
	    </ul>


		<form method="post" enctype="multipart/form-data">
			<h3><b>Submit Thesis</b></h3>
			<i>Select a PDF to upload.<br>
			<input type="file" name="fileToUpload" id="fileToUpload"><br>
			<input type="submit" name="submit" value="Upload Thesis" class="btn">



		</form>


    <?php
    echo
    '
      <h3>Thesis Submission:</h3>
      <a href= "Upload/'.$_SESSION['uid'].'.pdf" target="_blank">
      View Uploaded Transcript</a><br>
    ';
// echo $_SESSION['uid'];
// $form1 = mysqli_query($conn,"INSERT INTO form1(num, university_id, subject, course_num) VALUES ($count, $university_id, '$first_value', $secval);");
$university_id = $_SESSION['uid'];
$FileName = $_SESSION['uid'] . '.pdf';

// $insertingThesis = mysqli_query($db, "INSERT into thesis(university_id, FileName, FilePath) values  ($_SESSION['uid'], null, null)");
$ThesisInsert = mysqli_query($conn,"INSERT INTO thesis(university_id, FileName, FilePath) VALUES ($university_id, '$FileName', 'Upload');");

    // echo $insertingThesis;
    // if ( $ThesisInsert === TRUE ) {
    //           echo "Thesis successfully inserted.";
    //           //header("Location: viewThesisFile.php");
    // }
    // else {
    //           echo "error: <br>" .mysqli_error($db);
    // }
    //
    // $sql = mysqli_query($conn, "UPDATE thesis SET FilePath ='Upload', FileName ='$university_id.'pdf'' WHERE university_id=".$university_id);
    //
    //       if ( $sql === TRUE ) {
    //                 echo "Thesis successfully submitted.";
    //                 //header("Location: viewThesisFile.php");
    //       }
    //       else {
    //                 echo "error: <br>" .mysqli_error($db);
    //       }
    ?>
    </body>
</html>
