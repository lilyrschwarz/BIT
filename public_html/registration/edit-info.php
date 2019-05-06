<!DOCTYPE html>

<head>
    <title>Grades</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
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
             <li><a class="active" href="edit-info-admin.php">Back</a></li>
             <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
  <h3> Records & Information </h3>
  <hr>
    <?php
        session_start();

        if(!$_SESSION['loggedin']) {
            header("Location: login.php");
            die();
        }
        //send to menu page if they don't have sufficient permissions
        if(!(($_SESSION['type']=="secr") || ($_SESSION['type']=="admin"))) {
          header("Location: menu.php");
          die();
        }
        // Connect to database
        $servername = "localhost";
        $username = "SJL";
        $password = "SJLoss1!";
        $dbname = "SJL"; 
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if(!$conn){
          die("Connection failed: " . mysqli_connect_error());
        }

        $query = "select * FROM user where uid='".$_POST["studuid"]."';";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result)>0){

          while($row = mysqli_fetch_assoc($result)){
          echo '<form action="edit-info.php" method="post"><br>';
          echo 'First name: <input type="text" name="fname" value="'.$row['fname'].'"><br>';
          echo 'Last name: <input type="text" name="lname" value="'.$row['lname'].'"><br>';
          echo 'Street: <input type="text" name="street" value="'.$row['street'].'"><br>';
          echo 'City: <input type="text" name="city" value="'.$row['city'].'"><br>';
          echo 'State: <input type="text" name="state" value="'.$row['state'].'"><br>';
          echo 'Zipcode: <input type="number" name="zip" value="'.$row['zip'].'"><br>';
          echo 'Phone: <input type="number" name="phone" value="'.$row['phone'].'"><br>';
          echo 'Email: <input type="text" name="email" value="'.$row['email'].'"><br>';
          echo 'Active: <input type="text" name="active" value="'.$row['active'].'"><br>';
          echo 'Type: <input type="text" name="type" value="'.$row['type'].'"><br>';
          echo 'Password: <input type="text" name="password"><br>';
          echo '<input type="submit" name="update" value="Update">';
          echo "</form>";
          }
        }
        else if(isset($_POST['update'])){
          if(!(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
            echo 'The email address you provided is invalid.';
          } else {
            // If update button is hit, update all fields
            $updateQuery = "update user SET fname='".$_POST[fname]."', lname='".$_POST[lname]."',
            street='".$_POST[street]."', city='".$_POST[city]."', state='".$_POST[state]."', zip='".$_POST[zip]."',
            phone='".$_POST[phone]."', email='".$_POST[email]."', active='".$_POST[active]."', type='".$_POST[type]."'
            where uid='".$_SESSION["searchID"]."';";
            $updateResult = mysqli_query($conn, $updateQuery);
            // TODO: Test successful update...
            if(!empty($_POST["password"])){
              $updatePassword = "update user SET password='".$_POST['password']."' where uid='".$_POST['uid']."';";
              $passResult = mysqli_query($conn, $updatePassword);

              echo 'Password successfully changed <br>';
            }

            echo 'Update complete';
          }
        }

    ?>
</body>

</html>
