<?php
  session_start(); 
  
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // get the applicant
  $applicants = mysqli_query($conn, "SELECT * FROM users WHERE role='A'");
  while ($row = $applicants->fetch_assoc()) {
    if (isset($_POST[$row['userID']])) {
        $_SESSION['applicantID'] = $row['userID'];
          $fname = $row['fname'];
          $lname = $row['lname'];
          $name = $fname." ".$lname;
      }
  }

  // //get name of applicant
  // $q = "SELECT fname, lname FROM users WHERE userID = " .$_SESSION['applicantID'];
  // $result = mysqli_query($conn, $q) or die ("get name failed");
  // $value = mysqli_fetch_object($result);
  // $fname = $value->fname;
  // $lname = $value->lname;//
?>


<html>
  <head>
  <title>
    Faculty Reviews
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
  

  <ul>
  <li><a href="home.php">Back</a></li>
  <li><a class="active" href="view_cac_review.php">Faculty Reviews</a></li>
  <li style="float:right"><a href="logout.php">Log Out</a></li>
  </ul>
  <body align='center'>


    <h2> Faculty Reviews for <?php echo $fname." ".$lname;?></h2>
    
  	<?php
  		$q = "SELECT reviewerID, fname, lname FROM app_review, users WHERE reviewerRole = 'FR' AND reviewerID = userID AND uid = " .$_SESSION['applicantID'];
  		$result = $result = mysqli_query($conn, $q);

  		if (mysqli_num_rows($result) > 0){
          echo "<table style=width:20% border='1' align='center'; style='border-collapse: collapse';>";
	        echo "<tr>";
	        echo "<th>Reviewer</th>";
	        echo "<th></th>";
	        echo "</tr>";
	        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION['reviewerID'] = $row['reviewerID'];
	          echo "<tr>";
	          echo "<td>" . $row['fname']." ".$row['lname'] . "</td>";
	          echo 
            "<td> 
            <form align='center' action='view_faculty_review.php' method='post'>
            <input type='submit' name='".$row['reviewerID']."' value='View Review'>
            </form>
            </td>";
	          echo "</tr>";
	        }
	        echo "</table>";
	        // Free result set
	        mysqli_free_result($result);
  		}
      else{
        echo "<center> <i> No faculty reviews yet </i></center>";
      }

  	?>
    
   
  </body>
</html>
