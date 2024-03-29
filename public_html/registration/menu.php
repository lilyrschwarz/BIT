<!DOCTYPE html>

<head>
    <title>BIT Main Menu</title>
    <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
    <link rel = "stylesheet" type="text/css" href="style.css"/>
    <style>
        input[type=submit] {
            background-color: #990000;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            width: 70%;
        }
        input[type=submit]:hover {
            background-color: #990000;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
            width: 80%;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
        }
    </style>
</head>

<body class="gray-bg">
    <?php

        session_start();
       // echo $_SESSION['role'];
        //connect to database
        $servername = "localhost";
        $username = "SJL";
        $password = "SJLoss1!";
        $dbname = "SJL";
        $connection = mysqli_connect($servername, $username, $password, $dbname);

        //If they somehow got here without logging in, politely send them away
        if (!$_SESSION['loggedin']) {
            header("Location: login.php");
            die();
        }

        //determine what type of user is currently logged in
        $type = $_SESSION['type'];
        $_SESSION['id'] = $_SESSION['uid'];
        //$_SESSION['role'];
        $isAdvisor = $_SESSION['isAdvisor'];
        $isReviewer = $_SESSION['isReviewer'];

        $nrole = "";

        if ($type == "admin") {
            $nrole = "Admin";
            $_SESSION['role'] = "SA";
        } else if ($type == "MS") {
            $nrole = "Masters Student";
        } else if ($type == "PHD") {
            $nrole = "PhD Student";
        } else if ($type == "inst") {
            $nrole = "Instructor";
            //$_SESSION['role'] = "FR";
            if($type == "inst" && $isReviewer == "yes"){
                //$query = ;
                $result = mysqli_query($db, "select role from users where userID =".$_SESSION['uid']);
                $rll = mysqli_fetch_object($result);
                $rll2 = $rll->role;

                if($rll2 == "FR"){
                    $_SESSION['role'] = "FR";
                }else if($rll2 == "CAC"){
                    $_SESSION['role'] = "CAC";

                }
            }
             
        } else if ($type == "secr") {
            $nrole = "Secretary";
            $_SESSION['role'] = "GS";
        }  else if($type == "alum"){
            $nrole = "Alumni";

        }else if($type == "regis"){
            $nrole = "Registrar";
        }
        else {
            header("Location: login.php");
            die();
        }
//echo $rll2;
        $advrole = mysqli_query($db, "select user_type from loginusers where university_id =". $_SESSION["uid"]);
        $advrole = mysqli_fetch_assoc($advrole);
        $advrole = $advrole['user_type'];
        $_SESSION['advrole'] = $advrole;
        $extra = "";
        echo "<div style=\"text-align: center;\"><div style=\"display: inline-block; width: 80%;\">";
        if($isAdvisor == "yes"){
            if($isReviewer == "yes"){
                 $extra = ", Advisor, and Reviewer";
            }else{
              $extra = " and Advisor";
            }
        }else if($isReviewer == "yes"){
            if($isAdvisor == "yes"){
                $extra = ", Advisor, and Reviewer";
            }else{
               $extra = " and Reviewer";
            }
        }

        echo "Welcome, " . $_SESSION['fname'] . ". You are logged in with " . $nrole . $extra. $rll2." privileges.<br><br>";
        $nextItem = true;


        if($type == "alum"){
            $editInfoPrompt = "Edit Profile";
            $editInfoAction = "edit-info-reg.php";
            echo "<div><form action=\"" . $editInfoAction . "\"><input type=\"submit\" value=\"" . $editInfoPrompt . "\"/></form></div>";
            $transAction = "viewtrans.php";
            $transPrompt = "View My Transcript";
            $_SESSION["studuid"] = $_SESSION["uid"];
            echo "<div><form action=\"" . $transAction . "\"><input type=\"submit\" value=\"" . $transPrompt . "\"/></form></div>";
            //echo "<div><form action=\"logout.php\"><input type=\"submit\" value=\"Logout\"/></form></div>";

        }

       // echo $type;
        //EDIT PROFILE
        $editInfoPrompt = "";
        if ($type == "admin") {
            $editInfoPrompt = "Edit Profiles";
            $editInfoAction = "edit-info-admin.php";
        } else if ($type == "MS" || $type == "PHD" || $type == "inst" || $type == "secr" || $type == "regis") {
                  //  echo $_SESSION['role'];
            echo $type;
            $editInfoPrompt = "Edit Profile";
            $editInfoAction = "edit-info-reg.php";
            //echo $type;
        }else {
            $nextItem = false;
        }
        if ($nextItem) {
            echo "<div><form action=\"" . $editInfoAction . "\"><input type=\"submit\" value=\"" . $editInfoPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }
        //echo $type;
        //VIEW SCHEDULE
        $schedulePrompt = "";
        if ($type == "admin") {
            $scheduleAction = "view-schedule-admin.php";
            $schedulePrompt = "View Schedules";
        } else if ($type == "MS" || $type == "PHD") {
            $scheduleAction = "view-schedule-reg.php";
            $schedulePrompt = "View My Schedule";
        } else if ($type == "inst") {
            $scheduleAction = "view-schedule-inst.php";
            $schedulePrompt = "View My Schedule";
        } else if ($type == "secr" || $type == "alum") {
            $nextItem = false;
        }else{
           $nextItem = false;
        }

        if ($nextItem) {
            echo "<div><form action=\"" . $scheduleAction . "\"><input type=\"submit\" value=\"" . $schedulePrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }

        //TRANSCRIPTS
        $transPrompt = "";
        if (($type == "admin" || $type == "secr" || $type == "inst" || $type == "regis")) {
            $transAction = "viewTransAdmin.php";
            $transPrompt = "View Transcripts";
        } else if ($type == "MS" || $type == "PHD") {
            $transAction = "viewtrans.php";
            $transPrompt = "View My Transcript";
            $_SESSION["studuid"] = $_SESSION["uid"];
        }else {
            $nextItem = false;
        }

        if ($nextItem) {
            echo "<div><form action=\"" . $transAction . "\"><input type=\"submit\" value=\"" . $transPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }

        //ADD/DROP
        $addPrompt = "";
        $addAction = "";
        if ($type == "admin") {
            $addAction = "add-drop-admin.php";
            $addPrompt = "Edit Student Schedules (Add/Drop)";
        } else if ($type == "MS" || $type == "PHD") {
            $activeQuery = "select active from user where uid=" . $_SESSION["uid"];
            $activeOrNot = mysqli_fetch_assoc(mysqli_query($connection, $activeQuery))["active"];
            $holdQuery = "select advising_hold from user where uid=". $_SESSION["uid"];
            $holdRes = mysqli_fetch_assoc(mysqli_query($connection, $holdQuery))["advising_hold"];

            if ($activeOrNot == "yes") {
                if($holdRes == "yes"){
                    $addAction = "viewAdvHold.php";
                    $_SESSION["studuid"] = $_SESSION["uid"];
                    $addPrompt = "Fill in Advising Form";
                }else{
                    $addAction = "add-drop.php";
                    $_SESSION["studuid"] = $_SESSION["uid"];
                    $addPrompt = "Add/Drop Classes";
                }
            } else {
                $nextItem = false;
                echo "To register for classes, you must be active. Contact a system admin to change your status.";
            }

        } else if ($type == "secr" || $type == "inst" || $type == "alum" || $type == "regis" ) {
            $nextItem = false;
        } else {
            die("Error with add/drop user type logic");
        }

        if ($nextItem) {
            echo "<div><form action=\"" . $addAction . "\"><input type=\"submit\" value=\"" . $addPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }

        //EDIT GRADES
        $editPrompt = "";
        if ($type == "admin" || $type == "secr") {
            $editAction = "edit-grades-admin.php";
            $editPrompt = "Edit Grades";
        } else if ($type == "inst") {
            $editAction = "edit-grades-inst.php";
            $editPrompt = "Edit Grades";
        } else if($type == "regis"){
            $editAction = "edit-grades-regis.php";
            $editPrompt = "Edit Grades";
        }else if ($type == "MS" || $type == "PHD" || $type == "alum") {
            $nextItem = false;
        }

        if ($nextItem) {
            echo "<div><form action=\"" . $editAction . "\"><input type=\"submit\" value=\"" . $editPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }

        //ROSTERS
        $rostPrompt = "";
        if ($type == "admin" || $type == "secr") {
            $rostAction = "view-rosters.php";
            $rostPrompt = "View Course Rosters";
        } else {
            $nextItem = false;
        }

        if ($nextItem) {
            echo "<div><form action=\"" . $rostAction . "\"><input type=\"submit\" value=\"" . $rostPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }



        $advPrompt = "";
        if ($type == "admin") {

            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/admin.php";
            $advPrompt = "Visit the Advising System";
        }else if ($type == "secr") {
           //
            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/gs.php";
            $advPrompt = "Visit the Advising System";
        }else if ($type == "MS" || $type == "PHD") {
            //echo "WE ARE A STUDENT";
            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/student.php";
            $advPrompt = "Visit the Advising System";
        }else if ($type == "inst" && $isAdvisor == "yes") {
            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/advising/advisor.php";
            $advPrompt = "Visit the Advising System";
        } 
        
        else{
                        $nextItem = false;

        }
        if ($nextItem) {
            echo "<div><form action=\"" . $advAction . "\"><input type=\"submit\" value=\"" . $advPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }

        $advPrompt = "";
        if ($type == "admin") {
            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/system_admin_page.php";
            $advPrompt = "Visit the Admissions System";
        }else if ($type == "secr") {
            
            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/home.php";
            $advPrompt = "Visit the Admissions System";
        }else if ($type == "inst" && $isReviewer == "yes") {
            $advAction = "http://gwupyterhub.seas.gwu.edu/~sp19DBp2-SJL/applications/home.php";
            $advPrompt = "Review Applicants";
            
        } else {
            $nextItem = false;
        }

        if ($nextItem) {
            echo "<div><form action=\"" . $advAction . "\"><input type=\"submit\" value=\"" . $advPrompt . "\"/></form></div>";
        } else {
            $nextItem = true;
        }

        //ADD NEW USERS
        if ($type == "admin") {
            echo "<div><form action=\"manageusers.php\"><input type=\"submit\" value=\"Manage Users\"/></form></div>";
        }
        if($type == "admin" || $type == "secr"){
            echo "<div><form action=\"searchStudentsBy.php\"><input type=\"submit\" value=\"Search through students\"/></form></div>";
        }
        if($type == "MS" || $type == "PHD"){
            echo "<div><form action=\"research.php\"><input type=\"submit\" value=\"Read about Research!\"/></form></div>";
        }
        if($type == "regis"){
           //echo "<div><form action=\"createCourse.php\"><input type=\"submit\" value=\"Create a New Online Course\"/></form></div>";
            //echo "<div><form action=\"edit-grades-regis.php\"><input type=\"submit\" value=\"Edit All Grades\"/></form></div>"
        }
        //LOGOUT
        echo "<div><form action=\"logout.php\"><input type=\"submit\" value=\"Logout\"/></form></div>";

        echo "</div></div>";

    ?>
</body>

</html>
