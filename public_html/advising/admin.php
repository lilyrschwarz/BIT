<?php



//If they somehow got here without logging in, politely send them away
session_start();
if($_SESSION['uid'] && $_SESSION['type'] == 'admin'){

}
else{
  echo $_SESSION['uid'].$_SESSION['type'];
  header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}
/*** LOGIN FUNCTIONALITY ABOVE****/
 ?>
<!DOCTYPE html>
<html>
    <title>Admin</title>
    <meta charset="UTF-8">
    <meta name="viewport">
    <link rel = "stylesheet" type="text/css" href="style.css"/>
    <style>
        input[type=submit] {
            background-color: #990000;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            width: 70%;
        }
        input[type=submit]:hover {
            background-color: #990000;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            width: 80%;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
    </style>


    <body class="gray-bg">
    <!-- <body class="w3-content"> -->

    <!-- First Grid -->
    <!-- <div class="w3-row"> -->
      <!-- <div class="  w3-container w3-center" >
        <div class="w3-padding-64"> -->
    <div style="text-align: center"><div style=display: inline-block; width: 80%>
      <h1>Advising Systems Adminstrator</h1>

        <!-- First Grid -->
        <!-- <div class="w3-row">
            <div class="  w3-container w3-center" >
                <div class="w3-padding-64">
                </div>
                <div class="w3-padding-64">
                    <a href="create_user.php" class="w3-button  w3-block w3-hover-blue-grey w3-padding-16">Create User</a>
                    <a href="lookup.php" class="w3-button  w3-block w3-hover-dark-grey w3-padding-16">Lookup ID</a>
                    <a href="logout.php" class="w3-button  w3-block w3-hover-red w3-padding-16">Logout</a>

                </div>
            </div>
        </div> -->
        <div>
          <form action="searchForm1Admin.php">
            <input type="submit" value="View a Student's Form 1">
          </form
        </div>
        <div>
          <form action="viewThesisFileAdmin.php">
            <input type="submit" value="View/Approve PhD Thesis">
          </form
        </div>
        <div>
          <form action="http://gwupyterhub.seas.gwu.edu/~lilyrschwarz/SJL/public_html/registration/menu.php">
            <input type="submit" value="Main Menu">
          </form
        </div>

        <div>
          <form action="logout.php">
            <input type="submit" value="Logout">
          </form
        </div>

        <!-- Footer -->
        <footer class="w3-container  w3-padding-16">
            <p><a href="https://www.w3schools.com/w3css/default.asp" target="_blank"></a></p>
        </footer>

    </body>
</html>
