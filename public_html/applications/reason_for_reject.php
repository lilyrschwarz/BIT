<?php
  session_start();
  /*Important variable that will be used later to determine 
  if we're ready to move to the next page of the application */

  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $somethingEmpty = "";
  if (isset($_POST['submit'])){
    if(empty($_POST["reason"])){
      $somethingEmpty = "field required";
    }
    else{
      $sql = "UPDATE app_review SET reason = '" . $_POST["reason"]. "' WHERE reviewID = " .$_SESSION['reviewID']. "";
      $result = mysqli_query($conn, $sql) or die ("************* SQL FAILED *************");
    }

    $_SESSION['reviewID'] = "";
    header("Location:home.php"); 
    exit;
  }
?>

<html>
 <head>
  <title>
    Reject
  </title>
  
  <style>

    /*body{
      line-height: 1.6;
    }*/    
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
  </style>
  <link rel="stylesheet" href="style.css">
 </head>
  <span class="topright"><form method="post" action="logout.php"><input type="submit" name="submit" value="Logout"></form></span>
  
  <h2> Reason for rejecting applicant: </h2>

  <body>
    <!--app entity list -->
    <form id="mainform" method="post">

      A <input type="radio" name="reason" value="A" > Incomplete record <br>
      B <input type="radio" name="reason" value="B" > Does not meet minimum requirements <br>
      C <input type="radio" name="reason" value="C" > Problems with letters <br>
      D <input type="radio" name="reason" value="D" > Not competitive <br>
      E <input type="radio" name="reason" value="E" > Other reasons <br>

      <div class="bottomCentered"><input type="submit" name="submit" value="Submit Review">
      <span class="error"><?php echo $somethingEmpty;?></span></div>
    </form>
  </body>
</html>