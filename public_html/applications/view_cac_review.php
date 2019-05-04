
<?php
  session_start();  

  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //get the applicant the GS wants to update
  $applicants = mysqli_query($conn, "SELECT * FROM users WHERE role='A'");
  while ($row = $applicants->fetch_assoc()) {
    if (isset($_POST[$row['userID']])) {
      $_SESSION['applicantID'] = $row['userID'];
      $fname = $row['fname'];
      $lname = $row['lname'];
      $name = $fname." ".$lname;
    }
  }

  //set up reviewerID
  $q = "SELECT reviewerID, rating FROM app_review WHERE reviewerRole = 'CAC' AND uid= " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $q) or die ("get reviewerID failed");
  $value = mysqli_fetch_object($result);
  $_SESSION['rating'] =  $value->rating;
  $_SESSION['reviewerID'] = $value->reviewerID;

  if (!$_SESSION['applicantID'])
    echo "Error: Applicant not found</br>";


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

  // $sql = "SELECT institution FROM rec_letter WHERE uid = " .$_SESSION['applicantID'];
  // $result = mysqli_query($conn, $sql) or die ("************* REC LETTER SQL FAILED *************");
  // $value = mysqli_fetch_object($result);
  // $university = $value->institution;

  //Review info:
  // $sql = "SELECT rating, generic, credible FROM rec_review WHERE reviewerID = ".$_SESSION['reviewerID']. " AND uid = " .$_SESSION['applicantID'];
  // $result = mysqli_query($conn, $sql) or die ("************* retrieve rec review SQL FAILED *************");
  // $value = mysqli_fetch_object($result);
  // $rating = $value->rating;
  // $generic = $value->generic;
  // $credible = $value->credible;
  // if($generic == 1){
  //   $generic = "Yes";
  // } else {
  //   $generic = "No";
  // }
  // if($credible == 1){
  //   $credible = "Yes";
  // } else {
  //   $credible = "No";
  // }

  $sql = "SELECT comments, deficiency, rating, advisor FROM app_review WHERE reviewerID = ".$_SESSION['reviewerID']. " AND uid = " .$_SESSION['applicantID'];
  $result = mysqli_query($conn, $sql) or die ("************* retrieve app review SQL FAILED *************");
  $value = mysqli_fetch_object($result);
  $comments = $value->comments;
  $deficiency = $value->deficiency;
  $action = $value->rating;
  $advisor = $value->advisor;
  
  
?>

<html>
 <head>
  <title>
    View Review
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
    <li><a href="home.php">Back</a></li>
    <li><a class="active" href="view_cac_review.php">View CAC Review</a></li>
    <li style="float:right"><a href="logout.php">Log Out</a></li>
    </ul>

    <?php 
      if ($_SESSION['rating'] == NULL){
        die("<h2> The CAC has not reviewed this applicant </h2>");
      }
    ?>

    <h1> CAC Review </h1>
    <!-- Rec letter -->
    <h2>Recommendation Letter </h2>

    <?php
      //show all recommendation letters
      
      $sql = "SELECT rec_letter".".fname, rec_letter.lname, rec_letter.institution, rec_letter.recommendation, rec_review.rating, rec_review.generic, rec_review.credible FROM rec_letter, rec_review WHERE rec_letter.uid = " .$_SESSION['applicantID']. " AND rec_letter.recID = rec_review.recID AND reviewerID = " . $_SESSION['reviewerID'];
      $result = mysqli_query($conn, $sql) or die ("rec letter reviews query failed");

      $num = 1;
      while($row = mysqli_fetch_assoc($result)) {
        echo "<b>Author:</b> <u>".$row['fname']." ".$row['lname']."</u><br>";
        echo "<b>From: </b> <u>".$row['institution']."</u> <br>";
        echo "<b>Letter: </b><br>";
        echo '<textarea readonly rows="15" cols="80" style="font-size: 16px;">'.$row['recommendation'].'</textarea>';
        echo "<br><br>";

       
        echo "<b>Rating: </b><u>".$row['rating']."</u><br>";
        
        $generic="";
        $credible="";
        if($row['generic'] == 1) 
          $generic = "Yes";
        else
          $generic = "No";
        if($row['credible'] == 1) 
          $credible = "Yes";
        else
          $credible = "No";
        
        echo "<b>Generic: </b><u>".$generic."</u><br>";
        echo "<b>Credible:  </b><u>".$credible."</u><br>";
      }
    ?>

    <h2>CAC Decision </h2>
    <b>Decision: </b> <u> <?php echo $action; ?> </u> <br>
    (1=Reject, 2=Borderline admit, 3=Admit without aid, 4=Admit with aid)<br>
    <b>Recommended Deficiency Courses: </b> <u> <?php echo $dificiency; ?> </u> <br>
    <b>Recommended Advisor: </b> <u> <?php echo $advisor; ?> </u> <br>
    <b>CAC Comments: </b> <br>
    <textarea rows="10" cols="71" style="font-size: 18px;" name="comments" form="mainform"><?php echo $comments; ?> </textarea>
    <hr>
      


    <h1>Application </h1>
    <!-- General info -->
    <b>Applicant Name: </b> <u> <?php echo $name; ?> </u> <br><br>
    <b>Student Number: </b> <u> <?php echo $_SESSION['applicantID']; ?> </u> <br><br>
    <b>Semester and Year of Application: </b> <u> <?php echo $semester." ".$year; ?> </u> <br><br>
    <b>Applying for Degree: </b> <u> <?php echo $degreeType; ?> </u> <br><br>

    <b>Areas of Interest: </b> <u> <?php echo $aoi; ?> </u> <br>
    <b>Experience: </b> <u> <?php echo $experience; ?> </u> <br><br>

    <!-- Academic info -->
    <h2>Summary of Credentials </h2>
    <b>GRE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Verbal: </b>
    <u> <?php echo $verbal; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Quantitative: </b>
    <u> <?php echo $quant; ?> </u><br>
    <b>Year of Exam: </b> <u> <?php echo $greYear; ?> </u> <br>
    <b>GRE Advanced &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Score: </b>
    <u> <?php echo $advScore; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Subject: </b>
    <u> <?php echo $subject; ?> </u><br>
    <b>TOEFL Score: </b> <u> <?php echo $toefl; ?> </u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <b>Year of Exam: </b> <u> <?php echo $advYear; ?> </u> 

     <!-- Prior Degrees -->
    <h2>Prior Degrees </h2> 
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
    <br><br>

    


    <!-- RETURN (unset reviewerID session variables) -->



  </body>
</html>
