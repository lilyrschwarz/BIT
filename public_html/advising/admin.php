<?php



//If they somehow got here without logging in, politely send them away
session_start();
if($_SESSION['login_user'] && $_SESSION['role'] == 'systems_administrator'){

}
else{
  echo $_SESSION['login_user'].$_SESSION['role'];
  header("Location: login.php");
}
/*** LOGIN FUNCTIONALITY ABOVE****/
 ?>
<!DOCTYPE html>
<html>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <body class="w3-content">

        <!-- First Grid -->
        <div class="w3-row">
            <div class="  w3-container w3-center" >
                <div class="w3-padding-64">
                    <h1>Systems Adminstrator</h1>
                </div>
                <div class="w3-padding-64">
                    <a href="create_user.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">Create User</a>
                    <a href="lookup.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Lookup ID</a>
                    <a href="logout.php" class="w3-button  w3-block w3-hover-red w3-padding-16">Logout</a>

                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="w3-container  w3-padding-16">
            <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
        </footer>

    </body>
</html>
