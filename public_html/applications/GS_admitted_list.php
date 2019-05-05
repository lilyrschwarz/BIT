<?php
  session_start(); 
  
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
?>

<html>
  <head>
  <title>
    GS Homepage
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
        padding: 2px;
        margin: 2px 0;
        border: none;
        width: 13%;
        border-radius: 1px;
        cursor: pointer;
        font-size: 7px;
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
    <li><a href="GS_home.php">Homepage</a></li>
    <li><a class="active" href="GS_admitted_list.php">View Admitted Students</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

    <h2 style='text-align: center;'>Admitted Students List</h2>
    <!-- <h4 style='text-align: center;'>When an applicant's documents have been received, mark them as such here</h4> -->


    <br>
    <form align='center' method='post'>

	    &nbsp;<input name='search' type='text' placeholder=" Enter name or uid" size='33'>&nbsp;
	    <input name='submit' type='submit' value='Search / Apply Filters' class='btn'>
	    <br><br>

	    <center>
	    <select name="semester">
	    <option value ="D" disabled selected value> -- filter by semester -- </option>
	    <option value="FA">Fall</option>
	    <option value="SP">Spring</option>
	    <option value="SU">Summer</option>
	    </select>
	    <select name="year">
	    <option value ="D" disabled selected value> -- filter by year -- </option>
	    <option value="2019">2019</option>
	    <option value="2020">2020</option>
	    <option value="2021">2021</option>
	    <option value="2022">2022</option>
	    <option value="2023">2023</option>
	    <option value="2024">2024</option>
	    <option value="2025">2025</option>
	    <option value="2026">2026</option>
	    <option value="2027">2027</option>
	    <option value="2028">2028</option>
	    <option value="2029">2029</option>
	    <option value="2030">2030</option>
	    </select>
	    <select name="degree_type">
	    <option value ="D" disabled selected value> -- filter by degree program -- </option>
	    <option value="MS">Masters</option>
	    <option value="PHD">PhD</option>
	    </select>
	    </center>
	</form>
    <br>

    
    <?php

    //search field entered
    if (isset($_POST['submit']) && !empty($_POST['search'])) {

   		if (!isset($_POST['semester']) && !isset($_POST['year']) && !isset($_POST['degree_type'])/*no filters set*/){
   			if (is_numeric($_POST['search'])){
   				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review WHERE app_review"."."."uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("no filter set on search error: <br>" + mysqli_error($conn));
   			}
   			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review WHERE app_review"."."."uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("no filter set on search error: <br>" + mysqli_error($conn));
			}
	    }
		if (isset($_POST['semester'])/*semsester filter*/){
			if (is_numeric($_POST['search'])){
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("semester filter set on search error");
			}
			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("semester filter set on search error");
			}
	    }
		if (isset($_POST['year'])/*year filter*/){
			if (is_numeric($_POST['search'])){
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND year=".$_POST['year']." AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("year filter set on search error");
			}
			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND year=".$_POST['year']." AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("year filter set on search error");
			}
	    }
		if (isset($_POST['degree_type'])/*degree filter*/){
			if (is_numeric($_POST['search'])){
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("degree filter set on search error");
			}
			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("degree filter set on search error");
			}
	    }
		if (isset($_POST['semester']) && isset($_POST['year'])/*semsester and year*/){
			if (is_numeric($_POST['search'])){
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND year=".$_POST['year']." AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("semester and year filter set on search error");
			}
			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND year=".$_POST['year']." AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("semester and year filter set on search error");
			}
	    }
		if (isset($_POST['semester']) && isset($_POST['year']) && isset($_POST['degree_type'])/*semsester, year, and degree*/){
			if (is_numeric($_POST['search'])){
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND year=".$_POST['year']." AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("semester, year, and degree filter set on search error");
			}
			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND year=".$_POST['year']." AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("semester, year, and degree filter set on search error");
			}
	    }
		if (isset($_POST['year']) && isset($_POST['degree_type'])/*year and degree*/){
			if (is_numeric($_POST['search'])){
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND year=".$_POST['year']." AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (app_review.uid = " .$_POST['search'].")") or die ("year and degree filter set on search error");
			}
			else{
				$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND year=".$_POST['year']." AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9) AND (fname LIKE '%".$_POST['search']."%' OR lname LIKE '%".$_POST['search']."%')") or die ("year and degree filter set on search error");
			}
	    }
    }
    //search field not entered
    else if (isset($_POST['submit']) && empty($_POST['search'])) {

        if (!isset($_POST['semester']) && !isset($_POST['year']) && !isset($_POST['degree_type'])/*no filters set*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review WHERE app_review"."."."uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("no filter set error");
	    }
		if (isset($_POST['semester'])/*semsester filter*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("semester filter set error: " + mysqli_error($conn));
	    }
		if (isset($_POST['year'])/*year filter*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND year=".$_POST['year']." AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("year filter set error: " + mysqli_error($conn));
	    }
		if (isset($_POST['degree_type'])/*degree filter*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("degree filter set error: <br>" + mysqli_error($conn));
	    }
		if (isset($_POST['semester']) && isset($_POST['year'])/*semsester and year*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND year=".$_POST['year']." AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("semester and year filter set error");
	    }
		if (isset($_POST['semester']) && isset($_POST['year']) && isset($_POST['degree_type'])/*semsester, year, and degree*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND semester='".$_POST['semester']."' AND year=".$_POST['year']." AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("semester, year, and degree filter set error");
	    }
		if (isset($_POST['year']) && isset($_POST['degree_type'])/*year and degree*/){
	      $result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review, academic_info WHERE academic_info"."."."uid=userID AND year=".$_POST['year']." AND degreeType='".$_POST['degree_type']."' AND app_review.uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("year and degree filter set error");
	    }
    }
    else{
    	$result = mysqli_query($conn, "SELECT DISTINCT userID, fname, lname, status FROM users, app_review WHERE app_review"."."."uid=userID AND role='A' and (status = 6 OR status = 7 OR status = 9)") or die ("nothing pressed error");
    }

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
		  </tr>";

		// show each applicant with a button to the review page
		while ($row = mysqli_fetch_assoc($result)) {

			$q = "SELECT status FROM app_review WHERE uid = " .$row['userID'];
			$r = mysqli_query($conn, $r) or die("acceptance query failed");
			$v = mysqli_fetch_object($r);
			$status	= $v->status;

			$acceptance = "";
			if($status == 9)
				$acceptance = "ACCEPTED ADMISSION";
			
			echo 
			"<tr>

			<td>".$row['fname']."</td>
			<td>".$row['lname']."</td>
			
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

			<td>".$acceptance."</td>

			</tr>";
		}
	}
	// if there were no matches, tell them
	else {
		echo "<center> Zero Results </center>";
	}
  ?>







  </body>
</html>

