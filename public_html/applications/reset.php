<?php

	// make connection to database
	$conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
	if (!$conn) die("Connection failed: ".mysqli_connect_error());

	// open the sql file and read from it
	$file = fopen("phasetwo.sql", "r") or die ("File does not exist.");
	$contents = fread($file, filesize("phasetwo.sql"));
	
	// separate each query 
	$queries = explode(';', $contents);

	// run each query 
	foreach ($queries as $q) {
		$result = mysqli_query($conn, $q);
		if (!result)
			die ("Query failed: ".mysqli_error());
	}

	// close the file
	fclose($file);

	// open the sql file and read from it
	$file = fopen("population.sql", "r") or die ("File does not exist.");
	$contents = fread($file, filesize("population.sql"));
	
	// separate each query 
	$queries = explode(';', $contents);

	// run each query 
	foreach ($queries as $q) {
		$result = mysqli_query($conn, $q);
		if (!result)
			die ("Query failed: ".mysqli_error());
	}

	// close the file
	fclose($file);


	// go back to original page
	header("Location: login.php");
    	die();
?>
