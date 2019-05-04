<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Final Decision</title>
	<link rel="stylesheet" href="style.css">
</head>
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

<body>
	<ul>
    <li><a href="home.php">Back</a></li>
    <li><a class="active" href="view_cac_review.php">Final Decision</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

	<?php

		// if they aren't the GS, redirect them
		if ($_SESSION['role'] != 'GS') {
        	header("Location: home.php");
        	die();
    	}

		// connect to mysql
		$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// if something was already submitted
		if (isset($_POST['home'])) {
			header("Location: home.php");
        	die();
		}
		else if (isset($_POST['submit'])) {
			if ($_POST['decision'] == 'Reject') {
				$r = mysqli_query($conn, "UPDATE app_review SET status=8 WHERE uid=".$_SESSION['applicantID']);
				if (!$r)
					echo "Error: ".mysqli_error();
			}
			else if ($_POST['decision']=='Borderline Admit' || $_POST['decision']=='Admit Without Aid') {
				$r = mysqli_query($conn, "UPDATE app_review SET status=6 WHERE uid=".$_SESSION['applicantID']);
				if (!$r)
					echo "Error: ".mysqli_error();
			}
			else if ($_POST['decision'] == 'Admit With Aid') {
				$r = mysqli_query($conn, "UPDATE app_review SET status=7 WHERE uid=".$_SESSION['applicantID']);
				if (!$r)
					echo "Error: ".mysqli_error();
			}
			header("Location: home.php");
        	die();
		}

		// get the applicant the GS wants to update
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


		// header info
		echo "<h1>Final decision for ".$name."</h1>";

		echo "<h3> Recommended Action </h3>";
		// Get the decision made by the CAC 
		$q = "SELECT status FROM app_review WHERE uid=".$_SESSION['applicantID']." AND reviewerRole='CAC'";
		$result = mysqli_query($conn, $q);
		$row = $result->fetch_assoc();

		// if no decision made, give them the option of viewing the application
		if ($result->num_rows == 0 || $row['status'] < 4) {
			echo "<p>The CAC has not reviewed this application yet, but you may still view the application and make a final decision.</p></br>";

			// button to view the application
			echo "<form action='application_view_form.php' method='post'>
				<input type='submit' name='".$_SESSION['applicantID']."' value='View application'>
				</form></br>";
		}

		// if CAC has reviewed, show the final decision
		else {
			if ($row['status'] == 6) 
				echo "<p>The final decision made by the CAC: <u>Admit without aid</u></p>";
			else if ($row['status'] == 7) 
				echo "<p>The final decision made by the CAC: <u>Admit with aid</u></p>";
			else if ($row['status'] == 8) 
				echo "<p>The final decision made by the CAC: <u>Reject the student</u></p>";
			else 
				echo "<p>Error: The CAC made a review but an invalid decision is stored.</p>";
		}
	?>
      The average review of all faculty reviewers:
      <?php 
        $sql = "SELECT rating FROM app_review WHERE reviewerRole = 'FR' AND uid = " .$_SESSION['applicantID'];
        $result = mysqli_query($conn, $sql) or die ("average review query failed");
        $total = 0;
        $count = 0;
        while($row = mysqli_fetch_assoc($result)){
          $temp = (int) $row['rating'];
          $total += $temp;
          $count ++;
        }

        $review = "";
        if ($count == 0){
          $review = "THIS APPLICANT HAS NOT BEEN REVIEWED";
        }
        else{
          $average = $total / $count;
          $average = round($average);
        }
        
        
        if ($average == 1){
          $review = "Reject";
        }
        if ($average == 2){
          $review = "Borderline Admit";
        }
        if ($average == 3){
          $review = "Admit Without Aid";
        }
        if ($average == 4){
          $review = "Admit With Aid";
        }

        echo '<u>'.$review.'</u>';

      ?>
	<?php
		// now have the option to change the final decision
		echo "<br><br><h3>Update the final decision (not required):</h3>";
		echo "<form action='final_decision.php' method='post'>
				Reject:<input type='radio' name='decision' value='Reject'><br/>
				Borderline Admit:<input type='radio' name='decision' value='Borderline Admit'><br/>
				Admit Without Aid:<input type='radio' name='decision' value='Admit Without Aid'><br/>
				Admit With Aid:<input type='radio' name='decision' value='Admit With Aid'><br/>
				<br><input type='submit' name='submit' value='Submit' class='btn'><br/><br/>
			</form>";

	?>

</body>
</html>