<?php
session_start();
if($_SESSION['uid'] && $_SESSION['type'] == 'admin'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~selingonal/SJL/public_html/registration/menu.php");
}

$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";

//If they somehow got here without logging in, politely send them away

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
          font-family: sans-serif;
      }

      li a:hover:not(.active) {
          background-color: #111;
      }

      .active {
          background-color: #4CAF50;
      }
  </style>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<title>User Lookup</title>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
    <body>
        <ul>
          <li><a class="active" href="admin.php">Home</a></li>
          <li><a href="create_user.php">Create User</a></li>
          <li><a href="lookup.php">Lookup ID</a></li>
          <li><a href="logout.php">Logout</a></li>
      </ul><br/></br>
        <p>Enter User ID to view info</p>

        <form action="" method="post">
            <input type="text" name="search">
            <input type="submit" name="submit" value="Search">
        </form>

        <div class="w3-container">
        <h2>User Information</h2>
        <div class="w3-responsive">
        <table class="w3-table-all">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone Number</th>
            </tr>
            <?php
                $search_value=$_POST["search"];
                $con=new mysqli($servername,$username,$password,$dbname);
                if($con->connect_error){
                    echo 'Connection Failed: '.$con->connect_error;
                } else{
                    /* determine what kind of user the university_id belongs to */

                    $course_array = $con->query("SELECT * FROM student where university_id =". $search_value);

                    if (!empty($course_array)) {
                        //foreach($course_array as $key=>$value)
                        while($row = $course_array->fetch_assoc()) {

            ?>
                        <tr>
                            <td><?php echo $row["f_name"]; ?></td>
                            <td><?php echo $row["l_name"]; ?></td>
                            <td><?php echo $row["email"]; ?></td>
                            <td><?php echo $row["address"]; ?></td>
                            <td><?php echo $row['phone_num']; ?></td>
                        </tr>

                <?php
                    }
                }
            }
                ?>
        </table>
    </div>
    </div>
    </body>
</html>
