<?php
  session_start(); 
  
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $incomplete_message = "";
  //update status
  if($_SESSION['completed_p1'] == true && $_SESSION['completed_p2'] == true && $_SESSION['completed_p3'] == true && $_SESSION['completed_p4'] == true && $_SESSION['completed_p5'] == true){
    if ($_SESSION['transcript_uploaded'] == true){
      $sql = "UPDATE app_review SET status = 4 WHERE uid = " .$_SESSION['id']. "";
      $result = mysqli_query($conn, $sql) or die ("**********UPDATE STATUS 4 MySQL Error***********");
      $sql = "UPDATE academic_info SET transcript = 1 WHERE uid = " .$_SESSION['id']. "";
      $result = mysqli_query($conn, $sql) or die ("**********transcript in academic info failed***********");
    }
    else{
      $sql = "UPDATE app_review SET status = 2 WHERE uid = " .$_SESSION['id']. "";
      $result = mysqli_query($conn, $sql) or die ("**********UPDATE STATUS 2 MySQL Error***********");
    }
  }
  else{
    $incomplete_message = "Your application is incomplete";
  }

  //get info
  $sql = "SELECT email FROM users WHERE userID = " .$_SESSION['id'];
  $result = mysqli_query($conn, $sql) or die ("************* EMAIL SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $email = $value->email;

  $sql = "SELECT * FROM personal_info WHERE uid = " .$_SESSION['id'];
  $result = mysqli_query($conn, $sql) or die ("************* PERSONAL INFO SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $street = $value->street;
  $city = $value->city;
  $state = $value->state;
  $zip = $value->zip;
  $phone = $value->phone;
  $ssn = $value->ssn;

  $sql = "SELECT * FROM academic_info WHERE uid= " .$_SESSION['id'];
  $result = mysqli_query($conn, $sql) or die ("************* ACADEMIC INFO SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $degreeType = $value->degreeType;
  $aoi = $value->AOI;
  $experience = $value->experience;
  $semester = $value->semester;
  $year = $value->year;

  $sql = "SELECT verbal, quant, year, advScore, subject, toefl, advYear FROM gre WHERE uid= " .$_SESSION['id'];
  $result = mysqli_query($conn, $sql) or die ("************* GRE SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $verbal = $value->verbal;
  $quant = $value->quant;
  $greYear = $value->year;
  $advScore = $value->advScore;
  $subject = $value->subject;
  $toefl = $value->toefl;
  $advYear = $value->advYear;

?>

<html>
  <head>
  <title>
    Application Form
  </title>
 
  <style>
    .field {
      position: absolute;
      left: 180px;
    }
    /*body{line-height: 1.6;}*/
    .bottomCentered{
       position: fixed;   
       text-align: center;
       bottom: 30px;
       width: 100%;
    }
    .error {color: #FF0000;}
    .topright {
      position: absolute;
      right: 10px;
      top: 10px;
    }

    .btn {
        background-color: #990000;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 25%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
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

  <link rel="stylesheet" href="style.css">
  </head>

  <body>

    <ul>
    <li><a href="app_personal_info.php">Personal Information</a></li>
    <li><a href="app_academic_info.php">Academic Information</a></li>
    <li><a href="app_prior_degrees.php">Prior Degrees</a></li>
    <li><a href="app_rec_letter.php">Recommendation Letters</a></li>
    <li><a href="app_transcript.php">Transcript</a></li>
    <li><a class="active" href="confirmation.php">Finish</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

    <h1> Confirmation </h1>
	
    <h2> Review Information </h2>
    <span class="error"> <?php echo $incomplete_message ?></span>
    <h3>Personal Information:</h3>
    Student Number:  <u> <?php echo $_SESSION['id']; ?> </u> <br>
    Address: <u> <?php echo $street. " " .$city. " " .$state. " " .$zip; ?> </u> <br>
    Phone number: <u> <?php echo $phone; ?> </u> <br>
    SSN: <u> <?php echo $ssn; ?> </u> <br>
    Email: <u> <?php echo $email; ?> </u> <br>
    <hr>

    <h3>Academic Information:</h3>
    Semester and Year of Application:  <u> <?php echo $semester." ".$year; ?> </u> <br><br>
    Applying for Degree:  <u> <?php echo $degreeType; ?> </u> <br><br>
    GRE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Verbal: 
    <u> <?php echo $verbal; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Quantitative: 
    <u> <?php echo $quant; ?> </u><br>
    Year of Exam:  <u> <?php echo $greYear; ?> </u> <br>
    GRE Advanced &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Score: 
    <u> <?php echo $advScore; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Subject: 
    <u> <?php echo $subject; ?> </u><br>
    TOEFL Score:  <u> <?php echo $toefl; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Year of Exam:  <u> <?php echo $advYear; ?> </u> <br><br>
    Areas of Interest:  <u> <?php echo $aoi; ?> </u> <br>
    Experience:  <u> <?php echo $experience; ?> </u> <br>
    <hr>

    <h3>Prior Degrees: </h3> 
    <?php
      //display prior degree info in a table format
      $sql = "SELECT * FROM prior_degrees WHERE uid= " .$_SESSION['id'];
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        echo "<table style=width:40%>";
        echo "<tr>";
        echo "<th>Degree</th>";
        echo "<th>GPA </th>";
        echo "<th>Year</th>";
        echo "<th>University</th>";
        echo "<th>Major</th>";
        echo "</tr>";
        while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['deg_type'] . "</td>";
          echo "<td>" . $row['gpa'] . "</td>";
          echo "<td>" . $row['year'] . "</td>";
          echo "<td>" . $row['university'] . "</td>";
          echo "<td>" . $row['major'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
      }
    ?>
    <br>
    <hr>

    <h3>Recommendation Letters:</h3> 
    <?php
        //show all recommendation letters
        $sql = "SELECT * FROM rec_letter WHERE uid= " .$_SESSION['id'];
        $result = mysqli_query($conn, $sql);
        $num = 1;
        while($row = mysqli_fetch_assoc($result)) {
          echo "Author: <u>".$row['fname']." ".$row['lname']."</u><br>";
          echo "From:  <u>".$row['institution']."</u> <br>";
        }
    ?>
    <hr>

    <?php
      if ($_SESSION['transcript_uploaded'] == true){
        echo 
        '
          <h3>Transcript:</h3> 
          <a href= "Transcripts/'.$_SESSION['id'].'.pdf" target="_blank">
          View Uploaded Transcript</a><br>
        ';
      }
    ?>

    <?php
      if (empty($incomplete_message)){
        echo 
        '
        <form id="mainform" method="post" action="home.php"> 
          <br>
          <input type="submit" name="submit" value="Return to Homepage" class="btn">
        </form>
        ';
      }
    ?>

  </body>
</html>
