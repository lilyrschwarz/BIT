<!DOCTYPE html>

<head>
    <title>Sign in</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <link rel = "stylesheet" type="text/css" href="style.css"/>
</head>

<body class="gray-bg">
    <?php

        session_start();

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        //connect to database
        $servername = "localhost";
        $username = "SJL";
        $password = "SJLoss1!";
        $dbname = "SJL";
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        // define variables and set to empty values
        $uidErr = $passwordErr = "";
        $uid = $password = "";
        $accountSuccess = true;
        if($_SESSION["loggedin"]) {
            header("Location: menu.php");
            die();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["uid"])) {
                $uidErr = "Please enter your University ID!";
                $accountSuccess = false;
            } else {
                $uid = test_input($_POST["uid"]);
            }

            if (empty($_POST["password"])) {
                $passwordErr = "Please enter your password!";
                $accountSuccess = false;
            } else {
                $password = test_input($_POST["password"]);
            }

            $query = "select password from user where uid=" . $uid;
            $result = mysqli_query($connection, $query);
            //echo $query."<br>";
            //echo $result."<br>";
            if (mysqli_num_rows($result) > 0 && $accountSuccess) {
                $row = mysqli_fetch_assoc($result);
                if ($row["password"] != $password) {
                    $accountSuccess = false;
                    $passwordErr = "Password doesn't match ID.";
                }
            } else if ($accountSuccess) {
                $accountSuccess = false;
                $passwordErr = "Invalid credentials. Please try again.";
            }

            //No errors - log user in and save credentials as well as role to the session variables
            if ($accountSuccess) {
                $_SESSION["loggedin"] = true;
                $_SESSION["uid"] = $uid;
                $_SESSION["password"] = $password;
                $query = "select type, isAdvisor, isReviewer from user where uid=" . $uid;
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $_SESSION["type"] = $row["type"];
                $_SESSION["isReviewer"] = $row["isReviewer"];
                $_SESSION["isAdvisor"] = $row["isAdvisor"];

                $query = "select fname from user where uid=" . $uid;
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
                $_SESSION["fname"] = $row["fname"];
                $query = "select role from users where userID=". $uid;
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $_SESSION['role'] = $row['role'];
                header("Location: menu.php");
                die();
            } else {
                $_SESSION["loggedin"] = false;
            }
        }
    ?>
    <div style="text-align: center;" class="gray-bg">
       <div class="crimson-bg box">
            <h2 class="karla">Sign into BITWeb</h2>
            <h4 class="karla">The Bhagi Institute of Technology Web System</h4>
            <div style="display: inline-block;">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

                    <input type="text" name="uid" value="<?php echo $uid; ?>" placeholder="UID">
                    <span class="error">
                        <?php echo "<br>" . $uidErr; ?></span>
                    <br><br>
                    <input type="password" name="password" value="<?php echo $password; ?>" placeholder = "Password">
                    <span class="error">
                        <?php echo "<br>" . $passwordErr; ?></span>
                    <br><br>
                <input type="submit" name="submit" value="Sign in">
                </form>
            </div>
            <br>
            <br>
            <div style="display: inline-block;">
                <form action="reset-database.php">
                    <input type="submit" value="RESET DATABASE">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
