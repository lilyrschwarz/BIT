<?php

$conn = mysqli_connect("localhost", "BLT", "Blt1234!", "BLT");
if (!$conn) die("Connection failed: ".mysqli_connect_error());

$dir = 'Upload/';
foreach(glob($dir.'*.*') as $v){
    unlink($v);
}

$file = fopen("advising.sql", "r") or die ("File does not exist.");
$contents = fread($file, filesize("advising.sql"));

$queries = explode(';', $contents);

foreach ($queries as $q) {
 $result = mysqli_query($conn, $q);
 if (!result)
   die ("Query failed: ".mysqli_error());
}

fclose($file);

$file = fopen("insert.sql", "r") or die ("File does not exist.");
$contents = fread($file, filesize("insert.sql"));

$queries = explode(';', $contents);

foreach ($queries as $q) {
 $result = mysqli_query($conn, $q);
 if (!result)
   die ("Query failed: ".mysqli_error());
}

fclose($file);

header("Location: login.php");
   die();
 ?>
