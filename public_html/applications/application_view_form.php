<?php
  session_start();

  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  

  ////////////////////////////////////////////////////
  //RETRIEVE INFORMATION
  ////////////////////////////////////////////////////
  // get the applicant the GS wants to update
  $applicants = mysqli_query($conn, "SELECT * FROM users WHERE role='A'");
  while ($row = $applicants->fetch_assoc()) {
    if (isset($_POST[$row['userID']])) {
      $_SESSION['applicantID'] = $row['userID'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $name = $fname." ".$lname;
    }
  }
  if (!$_SESSION['applicantID'])
    echo "Error: Applicant not found</br>";


  //IF THIS STUDENT HAS ALREADY BEEN REVIEWED BY THIS REVIEWER, TELL THE USER TO GO BACK
  $sql = "SELECT rating FROM app_review WHERE reviewerID = " .$_SESSION['id']. " AND uid = " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("already reviewed test failed");
  if (mysqli_num_rows($result) != 0){
    die('<h2> You have already reviewed this student <h2> <br><br>
        <form id="mainform" method="post" action="home.php">
        <input type="submit" name="submit" value="Back to Home">');
  }

  
  $sql = "SELECT degreeType, AOI, experience, semester, year FROM academic_info WHERE uid= " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* ACADEMIC INFO SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $degreeType = $value->degreeType;
  $aoi = $value->AOI;
  $experience = $value->experience;
  $semester = $value->semester;
  $year = $value->year;

  $sql = "SELECT verbal, quant, year, advScore, subject, toefl, advYear FROM gre WHERE uid= " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* GRE SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $verbal = $value->verbal;
  $quant = $value->quant;
  $greYear = $value->year;
  $advScore = $value->advScore;
  $subject = $value->subject;
  $toefl = $value->toefl;
  $advYear = $value->advYear;

  $sql = "SELECT institution FROM rec_letter WHERE uid = " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* REC LETTER SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $university = $value->institution;
  /////////////////////////////////////////////////////////////

  
?>

<html>
 <head>
  <title>
    View Application
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
        width: 40%;
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
 
 <ul>
  <li><a href="GS_home.php">Back</a></li>
  <li><a class="active" href="application_form_review.php">View Application</a></li>
  <li style="float:right"><a href="logout.php">Log Out</a></li>
 </ul>
  
  <h1> Application for <?php echo $name; ?></h1>

  <body>
    <b>Name: </b> <u> <?php echo $name; ?> </u> <br><br>
    <b>Student Number: </b> <u> <?php echo $_SESSION['applicantID']; ?> </u> <br><br>
    <b>Semester and Year of Application: </b> <u> <?php echo $semester." ".$year; ?> </u> <br><br>
    <b>Applying for Degree: </b> <u> <?php echo $degreeType; ?> </u> <br>
    <hr>

    <h3>Summary of Credentials </h3>
    <b>GRE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Verbal: </b>
    <u> <?php echo $verbal; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Quantitative: </b>
    <u> <?php echo $quant; ?> </u><br>
    <b>Year of Exam: </b> <u> <?php echo $greYear; ?> </u> <br>
    <b>GRE Advanced &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Score: </b>
    <u> <?php echo $advScore; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Subject: </b>
    <u> <?php echo $subject; ?> </u><br>
    <b>TOEFL Score: </b> <u> <?php echo $toefl; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Year of Exam: </b> <u> <?php echo $advYear; ?> </u> <hr>

    <h3>Prior Degrees </h3> 
    <?php
      //display prior degree info in a table format
      $sql = "SELECT * FROM prior_degrees WHERE uid= " .$_SESSION['applicantID'];
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0){
        echo "<table style=width:40%>";
        echo "<tr>";
        echo "<th>Degree</th>";
        echo "<th>GPA </th>";
        //Add Major
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

    <b>Areas of Interest: </b> <u> <?php echo $aoi; ?> </u> <br>
    <b>Experience: </b> <u> <?php echo $experience; ?> </u> <hr>

    <h3>Recommendation Letters </h3>
      <?php
        //show all recommendation letters
        $sql = "SELECT * FROM rec_letter WHERE uid= " .$_SESSION['applicantID'];
        $result = mysqli_query($conn, $sql);
        $num = 1;
        while($row = mysqli_fetch_assoc($result)) {
          echo "<b>Author:</b> <u>".$row['fname']." ".$row['lname']."</u><br>";
          echo "<b>From: </b> <u>".$row['institution']."</u> <br>";
          echo "<b>Letter: </b><br>";
          echo '<textarea readonly rows="15" cols="80" style="font-size: 18px;background: transparent;">'.$row['recommendation'].'</textarea>';
          echo "<br><br>";
        }
      ?>

      <?php
        //link if transcript is uploaded
        $q = "SELECT transcript_uploaded FROM academic_info WHERE uid = ".$_SESSION['applicantID'];
        $r = mysqli_query($conn, $q);
        $v = mysqli_fetch_object($r);
        $transcript_test = $v->transcript_uploaded;

        if ($transcript_test ==  1){
          echo 
          '
            <h3>Transcript:</h3> 
            <a href= "Transcripts/'.$_SESSION['applicantID'].'.pdf" target="_blank">
            View  Transcript</a><br><br>
          ';
        }
        
      ?>
      <br>
     
  </body>
</html>
