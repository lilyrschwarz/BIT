<?php
/*** LOGIN FUNCTIONALITY BELOW****/
//connect to database
session_start();

if($_SESSION['uid'] && $_SESSION['type'] == 'MS' || $_SESSION['type'] == 'PHD'){

}
else{
    echo $_SESSION['uid'].$_SESSION['type'];
    header("Location: http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/registration/menu.php");
}


$servername = "localhost";
$username = "SJL";
$password = "SJLoss1!";
$dbname = "SJL";
$conn = mysqli_connect($servername, $username, $password, $dbname);



$form1 = null;



// Create connection



$program_type = $conn->query("SELECT program_type from student where university_id =".$_SESSION['login_user']);

$thesis_url = $conn->query("SELECT FileName, FilePath from thesis where university_id =".$_SESSION['login_user']);
while ($row2 = mysqli_fetch_array($thesis_url )) {
$url = $row2['FilePath'].$row2['FileName'];
//var_dump($url);
}

$classesResult = $conn->query("select C.courseno, C.dept FROM course C, transcript T where '".$_SESSION['studuid']."'=T.uid AND T.crn=C.crn");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$subject = $_POST['dept'] ?? '';
$course_num = $_POST['courseno'] ?? '';
$university_id = $_SESSION['uid'];

//$order = mysqli_query($conn,"update form1 set course1sub = '$course1sub', course1num = '$course1num', course2sub = '$course2sub', course2num = '$course2num', course3sub = '$course3sub', course3num = '$course3num', course4sub = '$course4sub', course4num = '$course4num', course5sub = '$course5sub', course5num = '$course5num', course6sub = '$course6sub', course6num = '$course6num', course7sub = '$course7sub', course7num = '$course7num', course8sub = '$course8sub', course8num = '$course8num', ////course9sub = '$course9sub', course9num = '$course9num', course10sub = '$course10sub', course10num = '$course10num', course11sub = '$course11sub', course11num = '$course11num', course12sub = '$course12sub', course12num = '$course12num' where university_id =". $_SESSION['login_user']);
//}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<!--  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="style.css" />-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <style>
    /*tbody tr:nth-child(odd) {
        background-color: #ff33cc;
    }

    tbody tr:nth-child(even) {
        background-color: #e495e4;
    }

    h2 {
      color: #5689DF;
    }*/

    .center{
      text-align: center;
    }

    .topright {
        position: absolute;
        right: 10px;
        top: 20px;
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

      ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #333;
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
  font-family: sans-serif;

}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #990000;
}
</style>
<ul>
<li><a class="active" href="student.php">Advising Home</a></li>

          <li style="float:right"><a href="logout.php"  >Logout</a></li></ul><br/></br>
</ul><br/></br>
<style>



@import url(http://fonts.googleapis.com/css?family=Droid+Serif);
div.container{
width: 960px;
height: 610px;
margin:50px auto;
font-family: 'Droid Serif', serif;
}
div.main{
width: 308px;
margin-top: 35px;
float:left;
border-radius: 5px;
Border:2px solid #999900;
padding:0px 50px 20px;
}
p{
margin-top: 5px;
margin-bottom: 5px;
color:green;
font-weight: bold;
}
h2{
background-color: #FEFFED;
padding: 25px;
margin: 0 -50px;
text-align: center;
border-radius: 5px 5px 0 0;
}
hr{
margin: 0 -50px;
border: 0;
border-bottom: 1px solid #ccc;
margin-bottom:25px;
}
span{
font-size:13.5px;
}
label{
color: #464646;
text-shadow: 0 1px 0 #fff;
font-size: 14px;
font-weight: bold;
}
.heading{
font-size: 17px;
}
b{
color:red;
}
input[type=checkbox]{
margin-bottom:10px;
margin-right: 10px;
}
input[type=submit]{
padding: 10px;
text-align: center;
font-size: 18px;
background: linear-gradient(#ffbc00 5%, #ffdd7f 100%);
border: 2px solid #e5a900;
color: #ffffff;
font-weight: bold;
cursor: pointer;
text-shadow: 0px 1px 0px #13506D;
width: 100%;
border-radius: 5px;
margin-bottom: 15px;
}
input[type=submit]:hover{
background: linear-gradient(#ffdd7f 5%, #ffbc00 100%);
}
</style>

</head>

<body class="gray-bg">
<div class="container">
<div class="main">
<h2>Form 1</h2>
<form method="post">
<label class="heading">Pick a Maximum of 12:</label></br></br>
<?php while($class =	mysqli_fetch_assoc($classesResult)){ ?>
  <input name="check_list[<?php echo $class["dept"]; ?>][]" value=<?php echo $class["courseno"]; ?> type="checkbox" class="auto"/><?php echo $class["dept"]; ?> <label><?php echo $class["courseno"]; ?> </label> <br>

<?php } ?>
<input type="submit" name="submit" value="Submit">

<!-- Including PHP Script ----->
<?php include 'checkbox_value.php';?>
<?php
if(isset($_POST['submit'])){
  $count = 0;

  $delete = mysqli_query($conn, "DELETE FROM form1 WHERE university_id =".$university_id);

  foreach($_POST['check_list'] as $first_value=>$tmpArray) {

      foreach($tmpArray as $second_value) {

          echo $first_value." ".$second_value."<br>";;
          $count++;
          $secval = (int) $second_value;
          $form1 = mysqli_query($conn,"INSERT INTO form1(num, university_id, subject, course_num) VALUES ($count, $university_id, '$first_value', $secval);");

          $form1_update = mysqli_query($conn,"UPDATE form1 set subject = '$first_value', course_num = '$secval' where num = '$count' and university_id= '$university_id';");

            // var_dump($secval);

//echo mysqli_error();

      }
    }
    if($count>12){
      echo "You can only submit up to 12 courses";
      header('Location: ' . $form1.php);
      die();
    }

    if ($form1) {

        //  echo '<br>Input data is successful';
          header("Location: viewform1.php");


    }
    else{
      //echo "error updating".$conn->error;
    }

}




 ?>




</form>
</div>
</div>
</body>
</html>
