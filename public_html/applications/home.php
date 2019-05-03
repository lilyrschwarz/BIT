<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <title>APPS Home Page</title>

	<!-- CSS styling -->
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
	      background-color: #4CAF50;
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
    <li><a class="active" href="home.php">Home</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>
	<?php

        if (!isset($_SESSION['role'])) {
        	header("Location: login.php");
        	die();
    	}

        // connect to the database
		$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");

		// if no role is set, need to go all the way back to log in page
		if (!isset($_SESSION['role'])) {
	        header("Location: login.php");
	        die();
	    }

        // if user is an applicant, show their status
        if ($_SESSION['role'] == "A") {

        	// page header info
        	echo "<div ><h2 style='text-align: center;'>Applicant Home Page</h2>
        		<h4 style='text-align: center;'>Complete your application or view its status here</h4>";

        	// tell them their uid
        	echo "<h4 style='text-align:center'>Your UID is:</h4> <p style='color:red; text-align:center'>".$_SESSION['id']."</p>";

			// find status of the applicant
			$result = mysqli_query($conn, "SELECT uid, status FROM app_review WHERE uid=".$_SESSION['id']);
			$row = $result->fetch_assoc();
			
			echo "<p style='text-align: center;'><strong>Status: </strong>";

			// if their application is incomplete
			if (!isset($row['status']) || $row['status'] == 1) {
				echo "Application incomplete</p>";
				echo "<form align='center' action='app_personal_info.php' method='post'>
	    				<input type='submit' value='Start Application' class='btn'>
					  </form>";
			}

			// if transcript and rec letter are needed
			else if ($row['status'] == 2) {
				echo "Your application is pending</p>";
				echo "<p style='text-align: center;'>We are still waiting to receive your transcript and recommendation letter, please check back later.</p>";
				echo "<form align='center' action='confirmation.php' method='post'>
	    				<input type='submit' name='".$row['uid']."' value='Edit Application' class='btn'>
					  </form>"; 
			}

			// if just transcript is needed
			else if ($row['status'] == 3) {
				echo "Your application is pending</p>";
				echo "<p style='text-align: center;'>We are still waiting to receive your transcript, please check back later.</p>";
				echo "<form align='center' action='confirmation.php' method='post'>
	    				<input type='submit' name='".$row['uid']."' value='Edit Application' class='btn'>
					  </form>"; 
			}

			// if just rec letter is needed
			else if ($row['status'] == 4) {
				echo "Your application is pending</p>";
				echo "<p style='text-align: center;'>We are still waiting to receive your recommendation letter, please check back later.</p>";
				echo "<form align='center' action='confirmation.php' method='post'>
	    				<input type='submit' name='".$row['uid']."' value='Edit Application' class='btn'>
					  </form>"; 
			}

			// if their application is complete
			else if ($row['status'] == 5) {
				echo "Your application is complete!</p>";
				echo "<p style='text-align: center;'>Refer back to this page frequently to see when a decision has been made.</p>";
				echo "<form align='center' action='confirmation.php' method='post'>
	    				<input type='submit' name='".$row['uid']."' value='Edit Application' class='btn'>
					  </form>"; 
			}

			// if they were admitted
			else if ($row['status'] == 6 || $row['status'] == 7) {
				echo "Congratulations!</p>";
				echo "<p style='text-align: center;'>We are happy to inform you that you have been selected for admission to this school! </p>";

				// tell them if they have received aid
				if ($row['status'] == 7) {
					echo "<p style='text-align: center;'>You have also been selected for financial aid, please speak to our office about that.</p>";
				}
				echo 
				'
					<span class="center">
					<form method="post" action="acceptance_fee.php">
					<input type="submit" name="submit" value="Accept Admission" class="btn">
					</form></span>
				';
			}

			// if they were rejected
			else if ($row['status'] == 8) {
				echo "</p>";
				echo "<p style='text-align: center;'>We regret to inform you that you have not been chosen as a potential student for this school.</p>";
			}

			else 
				echo "Error: we could not find any information for this user</p><br/>";

		}// end-applicant view


		// if the user is a reviewer, show them the list of applicants
		else if ($_SESSION['role'] == "FR" || $_SESSION['role'] == "CAC") {

			// page header info
        	echo "<h2 style='text-align: center;'>Reviewer Home Page</h2>
        		<h4 style='text-align: center;'>View completed applications and review them here</h4>";

			// get all the applicants whose application is complete
			$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname FROM users, app_review WHERE status>4 AND userID=uid");

			// start table
			echo "<table border='1' align='center' style='border-collapse:collapse;'>
	            	<tr>
	                	<th>First Name</th>
		                <th>Last Name</th>
		                <th></th>
					</tr>";

			// show each applicant with a button to the review page
			for ($i=0; $i < $result->num_rows; $i++) {
				$row = $result->fetch_assoc();
				// the button will go to a different place based on role
				if ($_SESSION['role'] == "FR")
					$button = "<form action='application_form_review.php' method='post'>
		    						<input type='submit' name='".$row['userID']."' value='Review Application'>
						  		</form>";
				else 
					$button = "<form action='application_form_review_CAC.php' method='post'>
		    						<input type='submit' name='".$row['userID']."' value='Review Application'>
						  		</form>";

				echo "<tr>
                    	<td>".$row['fname']."</td>
	                    <td>".$row['lname']."</td>
	                    <td>".$button."</td>
	                </tr>";
			}
		}// end-reviewer view



		// if the user is a Grad Secretary, let them search for applicants, mark docs as received
		else if ($_SESSION['role'] == "GS") {

			// header information
			echo "<h2 style='text-align: center;'>Graduate Secretary Home Page</h2>
			<h4 style='text-align: center;'>When an applicant's documents have been received, mark them as such here</h4>";


			// search bar for the GS to find applicants
			echo "<form align='center' method='post' action='home.php'>
				<input name='search' type='text'>
				<input name='submit' type='submit' value='Search for applicant'>
				</form></br></br>";

			// get all the applicants who match search and have a finished application
			if (isset($_POST['submit'])) {

				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review WHERE uid=userID AND role='A' and status > 1 AND reviewerRole = 'FR' AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("GS Search Query Failed");

				// if there were matches, show them
				if ($result->num_rows > 0) {
					// start table
					echo "<table border='1' align='center'; style='border-collapse: collapse;'>
			        	<tr>
	        		        <th>First Name</th>
							<th>Last Name</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>";
					
					// show each applicant with a button to the review page
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>
	        		        		<td>".$row['fname']."</td>
					                <td>".$row['lname']."</td>
	                    			<td>
	                    				<form align='center' action='add_documents.php' method='post'>
	    								<input type='submit' name='".$row['userID']."' value='Check documents'>
	    								</form>
									</td>
									<td>
										<form align='center' action='list_reviews.php' method='post'>
										<input type='submit' name='".$row['userID']."' value='View faculty reviews'>
										</form>
									</td>
									<td>
										<form align='center' action='view_cac_review.php' method='post'>
										<input type='submit' name='".$row['userID']."' value='View CAC review'>
										</form>
									</td>
									<td>
										<form align='center' action='final_decision.php' method='post'>
										<input type='submit' name='".$row['userID']."' value='Update decision'>
										</form>
									</td>
				                </tr>";
					}
				}
				// if there were no matches, tell them
				else {
					echo "<center> Zero Results </center>";
				}
			}
			else{
					$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname FROM users, app_review WHERE status>1 AND userID=uid") or die("Table Query Failed");
					echo "<table border='1' align='center'; style='border-collapse: collapse;'>
			        	<tr>
	        		        <th>First Name</th>
							<th>Last Name</th>
							<th></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>";
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>
	        		        		<td>".$row['fname']."</td>
					                <td>".$row['lname']."</td>
	                    			<td>
	                    				<form align='center' action='add_documents.php' method='post'>
	    								<input type='submit' name='".$row['userID']."' value='Check documents'>
	    								</form>
									</td>
									<td>
										<form align='center' action='list_reviews.php' method='post'>
										<input type='submit' name='".$row['userID']."' value='View faculty reviews'>
										</form>
									</td>
									<td>
										<form align='center' action='view_cac_review.php' method='post'>
										<input type='submit' name='".$row['userID']."' value='View CAC review'>
										</form>
									</td>
									<td>
										<form align='center' action='final_decision.php' method='post'>
										<input type='submit' name='".$row['userID']."' value='Update decision'>
										</form>
									</td>
				                </tr>";
					}
			}
	
		}// end-Grad secretary view


		// if the user is a Systems admin
		else if ($_SESSION['role'] == 'SA') {
			header("Location: system_admin_page.php");
        	die();
		}
    ?>

</body>
</html>
