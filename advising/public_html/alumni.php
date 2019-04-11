<?php

/*** LOGIN FUNCTIONALITY BELOW****/
session_start();
if($_SESSION['login_user'] && $_SESSION['role'] == 'alumni'){

}
else{
  echo $_SESSION['login_user'].$_SESSION['role'];
  header("Location: login.php");
}
/*** LOGIN FUNCTIONALITY ABOVE****/


?>
<!DOCTYPE html>
<html>
    <title>Alumni</title>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href = "https://www.w3schools.com/w3css/4/w3.css">
    <body class = "w3-content">

        <!-- First Grid -->
        <div class = "w3-row">
            <div class = " w3 container w3-center">
                <div class = "w3-padding-64">
                    <h1>Alumni</h1>
                </div>
                <div class = "w3-padding-64">
                    <a href = "view_info.php" class = "w3-button  w3-block w3-hover-blue-grey w3-padding-16">View Personal Info</a>
                    <a href = "update_info.php" class = "w3-button  w3-block w3-hover-blue-grey w3-padding-16">Update Personal Info</a>
                    <a href="alumni_transcript.php" class = "w3-button  w3-block w3-hover-blue-grey w3-padding-16">View Old Transcript</a>
                    <a href="logout.php" class="w3-button  w3-block w3-hover-red w3-padding-16">Logout</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class = "w3-container  w3-padding-16">
            <p><a href = "https://www.w3schools.com/w3css/default.asp" target = "_blank"></a></p>
        </footer>

    </body>
</html>
