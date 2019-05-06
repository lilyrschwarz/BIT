<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <title>Create A New (Online) Course!</title>
    <link rel = "stylesheet" type="text/css" href="style.css"/>
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
        }

        li a:hover:not(.active) {
        background-color: #111;
        }

        .active {
          background-color: #990000;
        }

    </style>
</head>

<body>
    <ul>
             <li><a class="active" href="menu.php">Menu</a></li>
             <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
    <?php

        session_start();
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //If they somehow got here without logging in, politely send them away
        if(!$_SESSION['loggedin']) {
            header("Location: login.php");
            die();
        }

        //send to menu page if they don't have sufficient permissions
        if(!($_SESSION['type']=="regis")) {
            header("Location: menu.php");
            die();
        }

        $type = $_SESSION['type'];
        $role = "";
        if(!$type=="admin") {
            header("Location: login.php");
        } 
        //connect to database
        $servername = "localhost";
        $username = "SELECT_team_name"; 
        $password = "Password123!"; 
        $dbname = "SELECT_team_name";
        $connection = mysqli_connect($servername, $username, $password, $dbname);
        $query = "select usid from user;";	
        $result	= mysqli_query($connection, $query);

       

        // define variables and set to empty values
        $nameErr = $deptErr = $coursenoErr = $creditsErr = $instructorErr = "";
        $name = $dept = $courseno = $credits = $instructor = "";
        $accountSuccess = TRUE;
        $customUID = FALSE;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["name"])) {
                $fnameErr = "Please enter a course title!";
                $accountSuccess = FALSE;
            } else {
                $name = test_input($_POST["name"]);
            }

            if (empty($_POST["dept"])) {
                $lnameErr = "Please enter a department!";
                $accountSuccess = FALSE;
            } else {
                $dept = test_input($_POST["dept"]);
            }

            if (empty($_POST["courseno"])) {
                $emailErr = "Please enter a course number!";
                $accountSuccess = FALSE;
            } else {
                $courseno = test_input($_POST["courseno"]);
            }

            if (empty($_POST["credits"])) {
                $streetErr = "Please enter the credit value!";
                $accountSuccess = FALSE;
            } else {
                $credits = test_input($_POST["credits"]);
            }

            if (empty($_POST["instructor"])) {
                $cityErr = "Please enter an instructor!";
                $accountSuccess = FALSE;
            } else {
                $instructor = test_input($_POST["instructor"]);
            }


           if($accountSuccess) {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['userid'] = $usid;
                $_SESSION['password'] = '123456';
                $query = "insert into course (name, dept, courseno, credits, instructor, semester, year) values (".$name.",".$dept.",".$courseno.",".$credits.",".$instructor.", 'Spring', 2019)";           
                $result = mysqli_query($connection, $query) or die(mysqli_error());
                header("Location: menu.php");
                
            }

            
        }
    ?>

    <h2 class="rubik">Create a new course:</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="source-sans">

        Title: <input type="text" name="name" value="<?php echo $name;?>">
        <span class="error">
            <?php echo "*".$nameErr;?></span>
        <br><br>

        Department: <input type="text" name="dept" value="<?php echo $dept;?>">
        <span class="error">
            <?php echo "*".$deptErr;?></span>
        <br><br>

        Number: <input type="number" name="courseno" value="<?php echo $courseno;?>">
        <span class="error">
            <?php echo "*".$coursenoErr;?></span>
        <br><br>

        Credits: <input type="number" name="credits" value="<?php echo $credits;?>">
                <span class="error">
            <?php echo "*".$creditsErr;?></span>

        <br><br>

        Instructor UID: <input type="number" name="instructor" value="<?php echo $instructor;?>">
                <span class="error">
            <?php echo "*".$instructorErr;?></span>

        <br><br>

        <input type="submit" name="submit" value="Create new course!">

        

    </form>
</body>

</html>