<!DOCTYPE html>
<html>
  <head>
    <title> Transcript </title>
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
             <li><a class="active" href="menu.php">Menu</a></li>
             <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
                <br>

    <h3> Search for Student Transcripts </h3>
    <hr>
    <form action="viewTransAdmin.php" method="post">
      Enter student ID: <input type="text" name="uid">
      <input type="submit" name="search" value="Search"> <br>
    </form>
      <?php 
        session_start();
        // Send to login page if user is not logged in
         if(!$_SESSION['loggedin']) {
             header("Location: login.php");
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
        
        // Declare empty variables for uid validation
        $uid = "";
        $uidErr = $tempErr = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
          if (empty($_POST["uid"])) {
                $uidErr = "Please enter a UID";
            } else {
                $uid = test_value($_POST["uid"]);
                // TODO: validate UID --> verify by database
            }
        }
        // Search database for courses that match with input uid
        $query = "select C.credits, C.section, C.name, C.courseno, C.day, C.tme, C.instructor, C.crn, C.location FROM course C, transcript T where '".$uid."'=T.uid AND T.crn=C.crn;";
        $result = mysqli_query($conn, $query);

        // Echo all courses associated with input uid
        if(isset($_POST['search'])){
          if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
              echo print_r($row) . "<br>";
            }
          } else {
            $tempErr = "No courses registered";
            echo $tempErr;
          }
        }

        // Function to validate uid input
        function test_value($input) {
            $input = htmlspecialchars($input);
            $input = stripslashes($input);
            $input = trim($input);
            return $input;
        }

      ?>

  </body>
</html>
