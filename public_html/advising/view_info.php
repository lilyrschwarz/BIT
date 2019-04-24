<?php


session_start();
if($_SESSION['uid'] && $_SESSION['type'] == 'alumni'){

}
else{
  echo $_SESSION['uid'].$_SESSION['type'];
  header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$db = new mysqli($servername, $username, $password, $dbname);



?>
<!DOCTYPE html>
<html>
	<title>Alumni Info</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style>
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
</style>
	<body>

    <ul>
    <li><a class="active" href="alumni.php">Home</a></li>
    <li><a href="view_info.php">Current Enrolment</a></li>
    <li><a href="update_info.php">Transcript</a></li>
    <li><a href="alumni_transcript.php">Update Info</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul><br/></br>

		<div class="w3-container">
		<h2>Alumni Information</h2>
		<div class="w3-responsive">
		<table class="w3-table-all">
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Address</th>
				<th>Phone Number</th>
				<th>Program Type</th>
				<th>Advisor</th>
				<th>Grad Semester</th>
				<th>Grad Year</th>
			</tr>
			<?php

				$con=new mysqli($servername,$username,$password,$dbname);
				if($con->connect_error){
					echo 'Connection Failed: '.$con->connect_error;
				} else{
					/* determine what kind of user the university_id belongs to */

					$alumni_array = $con->query("SELECT * FROM alumni where university_id =". $_SESSION['login_user']);

					if (!empty($alumni_array)) {
						//foreach($course_array as $key=>$value)
						while($row = $alumni_array->fetch_assoc()) {

			?>
						<tr>
							<td><?php echo $row["f_name"]; ?></td>
							<td><?php echo $row["l_name"]; ?></td>
							<td><?php echo $row["email"]; ?></td>
							<td><?php echo $row["address"]; ?></td>
							<td><?php echo $row['phone_num']; ?></td>
							<td><?php echo $row['program_type']; ?></td>
							<td><?php echo $row['advisor']; ?></td>
							<td><?php echo $row['grad_semester']; ?></td>
							<td><?php echo $row['grad_year']; ?></td>
						</tr>

				<?php
					}
				}
			}
				?>
		</table>
		</div>
		</div>

	</body>
</html>
