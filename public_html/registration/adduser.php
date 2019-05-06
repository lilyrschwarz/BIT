<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <title>Create New User</title>
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
             <li><a class="active" href="manageusers.php">Back</a></li>
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
        if(!($_SESSION['type']=="admin")) {
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
        $username = "SJL";
        $password = "SJLoss1!";
        $dbname = "SJL";
        $connection = mysqli_connect($servername, $username, $password, $dbname);
        $query = "select usid from user;";	
        $result	= mysqli_query($connection, $query);

        // define variables and set to empty values
        $fnameErr = $lnameErr = $emailErr = $passwordErr = $typeErr = $uidErr = $isRevErr = $isAdvErr= $SSNErr= "";
        $uid = $fname = $lname = $email = $active = $type = $street = $city = $state = $zip = $phone = $submit = $isReviewer = $isAdvisor = $ssn = "";
        $AppType = "";
        $accountSuccess = TRUE;
        $customUID = FALSE;
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["fname"])) {
                $fnameErr = "Please enter a first name!";
                $accountSuccess = FALSE;
            } else {
                $fname = test_input($_POST["fname"]);
            }

            if (empty($_POST["lname"])) {
                $lnameErr = "Please enter a last name!";
                $accountSuccess = FALSE;
            } else {
                $lname = test_input($_POST["lname"]);
            }

            if (empty($_POST["email"])) {
                $emailErr = "Please enter an email!";
                $accountSuccess = FALSE;
            } else {
                $email = test_input($_POST["email"]);
            }

            if (empty($_POST["street"])) {
                $streetErr = "Please enter a street!";
                $accountSuccess = FALSE;
            } else {
                $street = test_input($_POST["street"]);
            }

            if (empty($_POST["city"])) {
                $cityErr = "Please enter a city!";
                $accountSuccess = FALSE;
            } else {
                $city = test_input($_POST["city"]);
            }

          
            if (empty($_POST["state"])) {
                $stateErr = "Please enter a state!";
                $accountSuccess = FALSE;
            } else {
                $state = test_input($_POST["state"]);
            }

          
            if (empty($_POST["zip"])) {
                $zipErr = "Please enter a zip code!";
                $accountSuccess = FALSE;
            } else {
                $zip = test_input($_POST["zip"]);
            }

          
            if (empty($_POST["phone"])) {
                $phoneErr = "Please enter a phone number!";
                $accountSuccess = FALSE;
            } else {
                $phone = test_input($_POST["phone"]);
            }
            if (empty($_POST["ssn"])) {
                $phoneErr = "Please enter a SSN!";
                $accountSuccess = FALSE;
            } else {
                $ssn = test_input($_POST["ssn"]);
            }

            if (empty($_POST["active"])) {
                $activeErr = "Indicate if the user is active!";
                $accountSuccess = FALSE;
            } else {
                $active = test_input($_POST["active"]);
            }
            if (empty($_POST["type"])) {
                $typeErr = "What type of user are you creating?";
                $accountSuccess = FALSE;
            } else {
                $type = test_input($_POST["type"]);
            }
             if (empty($_POST["isReviewer"])) {
                $isRevErr = "Reviewer? yes or no?";
                $accountSuccess = FALSE;
            } else {
                $isReviewer = test_input($_POST["isReviewer"]);
            } 

            if (empty($_POST["isAdvisor"])) {
                $isAdvErr = "Advisor? yes or no?";
                $accountSuccess = FALSE;
            } else {
                $isAdvisors = test_input($_POST["isAdvisor"]);
            }

            if (empty($_POST["uid"])) {
                $customUID = FALSE;
            } else {
                $uid = test_input($_POST["uid"]);
                $doesUIDexist = "select * from user where uid = ".$uid;
                $result	= mysqli_query($connection, $doesUIDexist);
                if (mysqli_num_rows($result) > 0) {
                    $uidErr = "UID is already taken. Try again.";
                    $accountSuccess = FALSE;
                } else {
                    $customUID = TRUE;
                }
            }

            if($_POST["type"] == "inst" && $_POST['isReviewer'] == "yes"){
                $AppType = "FR";
            }else if($_POST["type"] == "admin"){
                $AppType = "SA";
            }else if($_POST["type"] == "secr"){
                $AppType = "GS";
            }
            if($_POST["type"] == "MS"){
                $AdType = "Masters";
            }else if($_POST["type"] == "PHD"){
                $AdType = "PhD";
            }else if($_POST["type"] == "inst" && $_POST['isReviewer'] == "yes"){
                $AdType = "Advisor";
            }

            if($accountSuccess) {
                $_SESSION['loggedin'] = TRUE;
                $_SESSION['userid'] = $usid;
                $_SESSION['password'] = '123456';
                $query = "";
                if($customUID) {
                    $query = "insert into user (fname, lname, password, active, type, street, city, zip, phone, email, state, uid, isReviewer, isAdvisor) values ('".$fname."','".$lname."','123456','".$active."','".$type."','".$street."','".$city."','".$zip."','".$phone."','".$email."','".$state."', '".$uid."', '".$isReviewer."', '".$isAdvisor."')";	
                    $sql = "insert into users (role, fname, lname, password, email, userID) values ('" .$AppType. "', '" .$fname . "', '" .$lname. "', '123456', '" .$email. "', '" .$uid. "')";
                    $sql2 = "insert into personal_info (fname, lname, uid, street, city, state, zip, phone, ssn) values ('" .$fname. "' , '" .$lname. "', '" .$uid. "', '".$street."','".$city."','".$state."', '".$zip."','".$phone."','" .$ssn. "')";
                    
                    $result = mysqli_query($connection, $query) or die("Insert into REG with custom ID failed. ".mysqli_error($connection));

                    if($_POST["type"] == "MS" || $_POST["type"] == "PHD"){
                        $q = "insert into student (university_id, f_name, l_name, email, phone_num, program_type) values ('".$uid."','".$fame."','".$lname."','".$email."','".$phone."','".$AdType."')";
                        $r = mysqli_query($connection, $q) or die("Insert into Student with custom ID failed. ".mysqli_error($connection));
                    }
                    else if($_POST["type"] == "inst" && $_POST['isReviewer'] == "yes"){
                        $q2 = "insert into advisor (university_id, name) values ('".$uid."','".$lname."')";
                        $r2 = mysqli_query($connection, $q2) or die("Insert into Advisor with custom ID failed. ".mysqli_error($connection));
                    }

                    $result2 = mysqli_query($connection, $sql) or die ("**********Error: user insert query wih custom IDfailed***********");

                    $result3 = mysqli_query($connection, $sql2) or die ("**********Error: personal_info insert query with custom ID failed***********".mysqli_error($connection));

                } else {

               
                    $query = "insert into user (fname, lname, password, active, type, street, city, zip, phone, email, state) values ('".$fname."','".$lname."','123456','".$active."','".$type."','".$street."','".$city."','".$zip."','".$phone."','".$email."','".$state."')";	
                   
                    $sqli = "SELECT MAX(uid) AS uid FROM user";
                    $result = mysqli_query($connection, $sqli) or die ("get uid failed");
                    $value = mysqli_fetch_object($result);
                    $Nuid = $value->uid;

                    $sql = "insert into users (role, fname, lname, password, email, userID) values ('" .$AppType. "', '" .$fname . "', '" .$lname. "', '123456', '" .$email. "', '" .$Nuid. "')";
                    $sql2 = "insert into personal_info (fname, lname, uid, street, city, state, zip, phone, ssn) values ('" .$fname. "' , '" .$lname. "', '" .$Nuid. "', '".$street."','".$city."','".$state."', '".$zip."','".$phone."','" .$ssn. "')";
                   
                    $result = mysqli_query($connection, $query) or die("Insert into REG failed. ".mysqli_error($connection));

                    if($_POST["type"] == "MS" || $_POST["type"] == "PHD"){
                        $q = "insert into student (university_id, f_name, l_name, email, phone_num, program_type) values ('".$Nuid."','".$fame."','".$lname."','".$email."','".$phone."','".$AdType."')";
                        $r = mysqli_query($connection, $q) or die("Insert into Student failed. ".mysqli_error($connection));
                    }
                    else if($_POST["type"] == "inst" && $_POST['isReviewer'] == "yes"){
                        $q2 = "insert into advisor (university_id, name) values ('".$Nuid."','".$lname."')";
                        $r2 = mysqli_query($connection, $q2) or die("Insert into Advisor failed. ".mysqli_error($connection));
                    }

                    $result2 = mysqli_query($connection, $sql) or die ("**********Error: user insert query failed***********");

                    $result3 = mysqli_query($connection, $sql2) or die ("**********Error: personal_info insert query failed***********".mysqli_error($connection));
                }

                //$result	= mysqli_query($connection, $query) or die("Insert into REG failed. ".mysqli_error($connection));

                //$result2 = mysqli_query($connection, $sql) or die ("**********Error: user insert query failed***********");

                //$result3 = mysqli_query($connection, $sql2) or die ("**********Error: personal_info insert query failed***********".mysqli_error($connection));
                

                



                header("Location: manageusers.php");
                
            }
            
        }
    ?>

    <h2>Create a new user:</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" class="source-sans">

        First name: <input type="text" name="fname" value="<?php echo $fname;?>">
        <span class="error">
            <?php echo "*".$fnameErr;?></span>
        <br><br>
        Last name: <input type="text" name="lname" value="<?php echo $lname;?>">
        <span class="error">
            <?php echo "*".$lnameErr;?></span>
        <br><br>
        Email: <input type="text" name="email" value="<?php echo $email;?>">
        <span class="error">
            <?php echo "*".$emailErr;?></span>
        <br><br>
        Street: <input type="text" name="street" value="<?php echo $street;?>">
                <span class="error">
            <?php echo "*".$streetErr;?></span>

        <br><br>
        City: <input type="text" name="city" value="<?php echo $city;?>">
                <span class="error">
            <?php echo "*".$cityErr;?></span>

        <br><br>
        State: <input type="text" name="state" value="<?php echo $state;?>">
                <span class="error">
            <?php echo "*".$stateErr;?></span>

        <br><br>
        Zip Code: <input type="text" name="zip" value="<?php echo $zip;?>">
                <span class="error">
            <?php echo "*".$zipErr;?></span>

        <br><br>
        Phone: <input type="text" name="phone" value="<?php echo $phone;?>">
                <span class="error">
            <?php echo "*".$phoneErr;?></span>

        <br><br>

        SSN: <input type="text" name="ssn" value="<?php echo $ssn;?>">
                <span class="error">
            <?php echo "*".$SSNErr;?></span>

        <br><br>

        Active: <input type="text" name="active" value="<?php echo $active;?>">
        <span class="error">
            <?php echo "*".$activeErr;?></span>
        <br><br>
        Type: <input type="text" name="type" value="<?php echo $type;?>">
        <span class="error">
            <?php echo "*".$typeErr;?></span>
        <br><br>
        Custom UID (optional): <input type="number" name="uid" value="<?php echo $uid;?>">
        <span class="error">
            <?php echo $uidErr;?></span>
               <br><br>

        Is a Reviewer?: <input type="text" name="isReviewer" value="<?php echo $isReviewer;?>">
        <span class="error">
<!--             <?php echo $isRevErr;?></span>
 -->               <br><br>

        Is an Advisor?: <input type="text" name="isAdvisor" value="<?php echo $isAdvisor;?>">
        <span class="error">
<!--             <?php echo $isAdvErr;?></span>
 -->        <br><br>

        <input type="submit" name="submit" value="Add new user!">

        

    </form>
</body>

</html>