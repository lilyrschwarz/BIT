<!DOCTYPE html>
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


<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
	<ul>
	<li><a href="home.php">Back</a></li>
	<li><a class="active" href="add_documents.php">Check Documents</a></li>
	<li style="float:right"><a href="logout.php">Log Out</a></li>
	</ul>

	<title>Received Documents</title>

	<?php session_start(); 
		// if they aren't the GS, redirect them
		if ($_SESSION['role'] != 'GS') {
        	header("Location: home.php");
        	die();
    	}

    	// get the applicant the GS wants to update
    	$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
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

		// page header info
        echo "<h2 style='text-align: center;'>Mark documents as Received</h2>
        	<h4 style='text-align: center;'>Update transcript and recommendation letter for ".$name."</h4>";


        // determine if the documents have already been received
        $result = mysqli_query($conn, "SELECT transcript, recletter FROM academic_info WHERE uid=".$_SESSION['applicantID']);
        if (!$result) 
        	echo "Error retrieving application info: ".mysqli_error();

        $row = $result->fetch_assoc();
        $transcript = $row['transcript'];
        $recletter = $row['recletter'];


        // determine which buttons to include
        if ($transcript == 1 && $recletter == 1) {
        	echo "<p style='text-align:center;'>This applicant's documents have already been received.</p>";
        }
       	// rec letter not needed
        else if ($recletter == 1) {
        	$tr_button = "Has ".$name."'s transcript been recieved?	&nbsp
				Yes<input type='radio' name='transcript' value='yes' required>
				No<input type='radio' name='transcript' value='no'><br/>";
			$rec_button = "";
			$submit = "<input type='submit' name='submitdocs' value='Submit'>";
        }
        // transcript not needed
        else if ($transcript == 1) {
        	$tr_button = "";
        	$rec_button = "<br/>Has ".$name."'s recommendation letter been received?	&nbsp
				Yes<input type='radio' name='rec' value='yes' required>
				No<input type='radio' name='rec' value='no'> <br/>";
			$submit = "<input type='submit' name='submitdocs' value='Submit'>";
        }
        // if neither has been received, show both buttons
        else {
        	$tr_button = "Has ".$name."'s transcript been recieved?	&nbsp
				Yes<input type='radio' name='transcript' value='yes' required>
				No<input type='radio' name='transcript' value='no'><br/>";
			$rec_button = "<br/>Has ".$name."'s recommendation letter been received?	&nbsp
				Yes<input type='radio' name='rec' value='yes' required>
				No<input type='radio' name='rec' value='no'> <br/>";
			$submit = "<input type='submit' name='submitdocs' value='Submit'>";
        }
	?>

	<!-- form for GS to update documents -->
	<form align='center' action='add_documents.php' method='post'>
		<?php echo $tr_button;
		echo $rec_button;
		echo $submit;
		?>
		
	</form>


	<?php

		// if they have submitted their answers
		if (isset($_POST['submitdocs'])) {

			// get the transcript and rec letter answers
			if (isset($_POST['transcript'])) {
				if ($_POST['transcript'] == 'yes') 
					$tr = 1;
				else 
					$tr = 0;
			}
			else 
				$tr = $transcript; // if not changed, set it to what it alreay was

			if (isset($_POST['rec'])) {
				if ($_POST['rec'] == 'yes') 
					$rec = 1;
				else
					$rec = 0;
			}
			else 
				$rec = $recletter;

			// now figure out what the status should be
			$update_needed = true;
			if ($tr == 1 && $rec == 1)
				$status = 5; // done
			else if ($tr == 1)
				$status = 4; // waiting for rec
			else if ($rec == 1)
				$status = 3; // waiting for transcript
			else 
				$update_needed = false; // if answer was no, nothing changed

			// insert it into the database
			$q = "INSERT INTO academic_info (uid, transcript, recletter) VALUES (".$_SESSION['applicantID'].", ".$tr.", ".$rec.") ON DUPLICATE KEY UPDATE transcript=".$tr.", recletter=".$rec;
			$result = mysqli_query($conn, $q);
			if (!$result)
				die("Insert query failed: ".mysqli_error());


			// update the status 
			if ($update_needed) {
				$q = "UPDATE app_review SET status=".$status." WHERE uid=".$_SESSION['applicantID'];
				echo $q;
				$result = mysqli_query($conn, $q);
				if (!$result)
					die("Update query failed: ".mysqli_error());
			}

			// redirect to home
			header("Location: home.php");
        	die();
		}
	?>

</body>
</html>