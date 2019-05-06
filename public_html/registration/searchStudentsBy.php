<!DOCTYPE html>

<head>
    <title>BIT Main Menu</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
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

<body class="gray-bg">
    <ul>
             <li><a class="active" href="menu.php">Menu</a></li>
             <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>
    <br>
    <?php
        echo "<center>";
        session_start();
       // echo $_SESSION['role'];
        //connect to database
        $servername = "localhost";
        $username = "SJL";
        $password = "SJLoss1!";
        $dbname = "SJL";
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        //If they somehow got here without logging in, politely send them away
        if (!$_SESSION['loggedin']) {
            header("Location: login.php");
            die();
        }

        

        echo "Search For a Student through the following methods: ";

        echo "<br>";

        $SearchByUID = "Search By UID";
        $SearchByUIDAction = "viewAllStudentsU.php";
        echo "<div><form action=\"" . $SearchByUIDAction . "\"><input type=\"submit\" value=\"" . $SearchByUID . "\"/></form></div>";
        $SearchByUID = "Search By Program Type";
        $SearchByUIDAction = "viewAllStudentsM.php";
        echo "<div><form action=\"" . $SearchByUIDAction . "\"><input type=\"submit\" value=\"" . $SearchByUID . "\"/></form></div>";
        $SearchByUID = "Search By Active Type";
        $SearchByUIDAction = "viewAllStudentsA.php";
        echo "<div><form action=\"" . $SearchByUIDAction . "\"><input type=\"submit\" value=\"" . $SearchByUID . "\"/></form></div>";
        
        echo "</center>";

    ?>
</body>

</html>
