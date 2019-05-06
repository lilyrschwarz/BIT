<?php
   session_start();
if($_SESSION['uid'] && $_SESSION['type'] == 'admin'){

}
else{
  echo $_SESSION['uid'].$_SESSION['type'];
  header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}



    /* connect to database */
    $servername = "localhost";
    $username = "BLT";
    $password = "Blt1234!";
    $dbname = "BLT";
    $db = new mysqli($servername, $username, $password, $dbname);

    $role = $_POST['role'];

    if($role == 'student'){
        $uni_id = rand(10000000, 99999999);
        $pass = $_POST['pass'];
        $sql = "INSERT into users (user_type, university_id, password) values ('student', $uni_id, $pass);";
        mysqli_query($db, $sql) or die (mysqli_error());

        $sql_2 = "UPDATE student set f_name = '{$_POST['f_name']}', l_name = '{$_POST['l_name']}' where university_id = {$uni_id}";
        mysqli_query($db, $sql_2) or die(mysqli_error());

        echo "Username: ".$uni_id."</br>";
    }
    else if($role == 'alumni'){
        $uni_id = rand(10000000, 99999999);
        $pass = $_POST['pass'];

        $sql = "INSERT into users (user_type, university_id, password) values ('alumni', $uni_id, $pass);";
        mysqli_query($db, $sql) or die (mysqli_error());

        $sql_2 = "UPDATE alumni set f_name = '{$_POST['f_name']}', l_name = '{$_POST['l_name']}' where university_id = {$uni_id}";
        mysqli_query($db, $sql_2) or die(mysqli_error());

        echo "Username: ".$uni_id."</br>";
    }
    else if($role == 'advisor'){

        $uni_id = rand(10000000, 99999999);
        $pass = $_POST['pass'];
        $sql = "INSERT into users (user_type, university_id, password) values ('advisor', $uni_id, $pass);";
        mysqli_query($db, $sql) or die (mysqli_error());

        $sql_2 = "UPDATE advisor set name = '{$_POST['f_name']}' where university_id = {$uni_id}";
        mysqli_query($db, $sql_2) or die(mysqli_error());

    }
    else if($role == 'grad_sec'){
        $uni_id = rand(10000000, 99999999);
        $pass = $_POST['pass'];
        $sql = "INSERT into users (user_type, university_id, password) values ('graduate_secretary', $uni_id, $pass);";
        mysqli_query($db, $sql) or die (mysqli_error());

        echo "Username: ".$uni_id."</br>";
    }
    else if($role == 'admin'){
        $uni_id = rand(10000000, 99999999);
        $pass = $_POST['pass'];
        $sql = "INSERT into users (user_type, university_id, password) values ('systems_administrator', $uni_id, $pass);";
        mysqli_query($db, $sql) or die (mysqli_error());

        echo "Username: ".$uni_id."</br>";
    }


?>

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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>
<body>

    <ul>
    <li><a class="active" href="admin.php">Home</a></li>
    <li><a href="create_user.php">Create User</a></li>
    <li><a href="lookup.php">Lookup ID</a></li>
    <li><a href="logout.php">Logout</a></li>
    </ul><br/></br>

  <h2>Create User</h2>

  <form method="post">
    <label for="f_name">First Name:</label>
    <input type="text" name="f_name" /><br />
    <label for="l_name">Last Name:</label>
    <input type="text" name="l_name" /><br />
    <label for="pass">User's Password:</label>
    <input type="password" name="pass" /><br />
    Role:<select name = 'role'>
        <option value = 'student'>Student</option>
        <option value = 'alumni'>Alumni</option>
        <option value = 'advisor'>Advisor</option>
        <option value = 'grad_sec'>Graduate Secretary</option>
        <option value = 'admin'>Systems Administrator</option>
    </select></br>
    <?php echo "University ID: ".$uni_id."</br>";  ?>
    <br>
    <input type="submit" value="Submit" formaction="create_user.php"/>
  </form>
</body>
</html>
