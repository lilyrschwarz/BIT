<?php
   /*include("config.php");*/
  // session_unset();
  // session_destroy();
   //echo $_SESSION['login_user'];
   session_start();
   $servername = "localhost";
   $username = "BLT";
   $password = "Blt1234!";
   $dbname = "BLT";
   $db = mysqli_connect($servername, $username, $password, $dbname);
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      if(!$db){
        $error = "Couldn't access the server";
      }
      $myusername = $_POST['university_id'];
      $mypassword = $_POST['password'];
      $sql = "SELECT * FROM users WHERE university_id = ".$myusername." and password = '".$mypassword."';";
      $result = mysqli_query($db,$sql);
      //$row = mysqli_fetch_assoc($result);
      //$active = $row['active'];
      $count = mysqli_num_rows($result);
      // If result matched $myusername and $mypassword, table row must be 1 row
      if($count > 0 ) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         $role = mysqli_query($db, "select user_type from users where university_id =". $myusername);
        // if(mysqli_num_rows($role)>0){echo "successful ";}
        // else{echo mysqli_error($db);}
         $role = mysqli_fetch_assoc($role);
         $role = $role['user_type'];
         $_SESSION['role'] = $role;
         //echo $role;
          //switch login depending on user type
          $redirect = "login.php";
          switch($role)
          {
            case 'student':
              $redirect = 'student.php';
              break;
            case 'alumni':
              $redirect = 'alumni.php';
              break;
            case 'advisor':
              $redirect = 'advisor.php';
              break;
            case 'graduate_secretary':
              $redirect = 'gs.php';
              break;
            case 'systems_administrator':
              $redirect = 'admin.php';
              break;
          }
          //echo $redirect;
          header('Location: ' . $redirect);
         //die();
      }else {
      //  $error =  "Error:	"	.	$sql	.	"<br/>"	.	$count;
      //echo $sql;
        $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>



      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
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
         background-color: #4CAF50;
       }
      </style>

   </head>

   <body bgcolor = "#FFFFFF">
     <head>
        <title>Login Page</title>
        <ul>
        <li><a class="active" href="resetbutton.php">Reset</a></li>
      </ul><br/><br/>

      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Banweb++ Login</b></div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label>University ID  :</label><input type = "text" name = "university_id" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>

               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>
</html>
