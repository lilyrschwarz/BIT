<?php
	/* NEEDS FORM VALIDATION*/
  session_start(); 
  
  // connect to mysql
  $conn = mysqli_connect("localhost", "SJL", "SJLoss1!", "SJL");
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  //fetch user info and transfer to main site
  $uid_old = $_SESSION['id'];
  $sql = "SELECT * FROM personal_info WHERE uid = " .$uid_old;
  $result = mysqli_query($conn, $sql) or die ("personal_info fetch failed");
  $value = mysqli_fetch_object($result);
  $fname = $value->fname;
  $lname = $value->lname;
  $street = $value->street;
  $city = $value->city;
  $state = $value->state;
  $zip = $value->zip;
  $phone = $value->phone;

  $sql = "SELECT email FROM users WHERE userID = " .$uid_old; 
  $result = mysqli_query($conn, $sql) or die ("users fetch failed");
  $value = mysqli_fetch_object($result);
  $email = $value->email;

  $sql = "SELECT degreeType FROM academic_info WHERE uid = " .$uid_old; 
  $result = mysqli_query($conn, $sql) or die ("type fetch failed");
  $value = mysqli_fetch_object($result);
  $type = $value->degreeType;

  //Insert into REG's "user" table
  $sql = "INSERT INTO user (fname, lname, street, city, state, zip, phone, email, password, active, type, advising_hold) VALUES ('" .$fname. "', '" .$lname. "', '" .$street. "', '" .$city. "', '" .$state. "', " .$zip. ", '" .$phone. "', '" .$email. "', '123456', 'yes', '".$type."', 'yes')";
  $result = mysqli_query($conn, $sql) or die ("insert into REGS failed");

  //get new uid
  $sql = "SELECT MAX(uid) AS uid FROM user";
  $result = mysqli_query($conn, $sql) or die ("get uid failed");
  $value = mysqli_fetch_object($result);
  $uid = $value->uid;

  //insert into advising's student table
  $sql = "INSERT INTO student (university_id, f_name, l_name, email, phone_num, program_type, advisor) VALUES (".$uid.", '".$fname."', '".$lname."', '".$email."', '".$phone."', '".$type."', 10)";
  $result = mysqli_query($conn, $sql) or die ("insert into student failed");

  //update status
  $sql = "UPDATE app_review SET status = 9 WHERE uid = " .$uid_old;
  $result = mysqli_query($conn, $sql) or die ("update status failed");

  session_destroy ();
?>

<html>
  <head>
  <title>
    Gain Admission
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
    .center{
      position: absolute;
      top: 50%;
      left: 50%;
      -moz-transform: translateX(-50%) translateY(-50%);
      -webkit-transform: translateX(-50%) translateY(-50%);
      transform: translateX(-50%) translateY(-50%);
    }
    .btn {
  background-color: #990000;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}
  </style>

  <link rel="stylesheet" href="style.css">
  </head>
  
  <body>
    
    <span class="center"><h3>
      Thank you you for your payment. You may now access our student services. Your new student ID is shown below. Remember this ID and use it to log into your student account. You were also given a temporary password. You can change this password after loging in initially.<br><br>

      Student ID: <?php echo " " . $uid;?><br>
      Temporary password: 123456

      <br><br>

      <form method="post" action="http://gwupyterhub.seas.gwu.edu/~sloanej/SJL/public_html/registration/login.php"> 
        <input type="submit" name="submit" value="Go To Student Services" class="btn">
      </form>

    </h3></span>

  </body>

</html>