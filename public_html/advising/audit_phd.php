<?php
    session_start();
    /*************************************************/
    /* only let logged in users access, and protects */
    /* this page so that only students can access.   */
    /* else, redirects to login page                 */
    /*************************************************/
    if($_SESSION['login_user'] && $_SESSION['role'] == 'student'){

    }
    else{
        echo $_SESSION['login_user'].$_SESSION['role'];
        header("Location: login.php");
    }

    /* connect to database */
    $servername = "localhost";
    $username = "BLT";
    $password = "Blt1234!";
    $dbname = "BLT";
    $db = new mysqli($servername, $username, $password, $dbname);

    /*****************************************************/
    /* This value starts as 1, but if any of the checks  */
    /* to graduate fail, it gets changed to 0 which will */
    /* indicate to the grad secretary that the audit did */
    /* not complete successfully                         */
    /*****************************************************/
    $cleared = 1;

    $user = $_SESSION['login_user'];

    /* FIRST CHECK: did student fill out a form 1?     */
    $sql_1 = "SELECT * FROM form1 WHERE university_id =" .$user.";";
    $result = mysqli_query($db, $sql_1);

    if(empty($result)){
        echo "Student did not complete a form 1. Returning...<br />";
        $cleared = 0;
        //header("Location: applytograduate.php");
    }
    else if (!empty($result)) {
        echo "student completed form 1!<br />";
    }

    /***************************************************/
    /* FIRST CHECK: no more than 1 grade below B       */
    /***************************************************/
    $sql = "SELECT final_grade FROM transcript WHERE university_id = ".$user.";";
    $result_3 = mysqli_query($db,$sql);

    if (!empty($result_3)) {
        while($row = $result_3->fetch_assoc()){
           $final_grades[] = $row;
        }
    }
    else{
        echo "Could not fetch final grades. Returning... <br />";
        $cleared = 0;
    }

    foreach($final_grades as $grades){
        if("{$grades[final_grade]}" === 'C'){
            $grades_below_b = $grades_below_b + 1;
        }
        else if("{$grades[final_grade]}" === 'D'){
            $grades_below_b = $grades_below_b + 1;
        }
        else if("{$grades[final_grade]}" === 'F'){
            $grades_below_b = $grades_below_b + 1;
        }
    }

    if($grades_below_b > 1){
        /* MORE THAN TWO GRADES BELOW B */
        echo "More than one grade below B. Returning...<br />";
        $cleared = 0;
    }

    /***************************************************/
    /* SECOND CHECK: overall gpa > 3.5                 */
    /***************************************************/
    $sql = "SELECT GPA FROM student WHERE university_id = ".$user.";";
    $result_4 = mysqli_query($db,$sql);

    if(!empty($result_4)){
        $gpa = $result_4->fetch_assoc();
        if($gpa['GPA'] < (float)3.5){
            /* DID NOT MEET GPA REQT */
            echo "GPA below 3.5. Returning...<br />";
            $cleared = 0;
        }
    }
    else{
	    echo "Could not access GPA information. Returning... <br />";
	    echo $db->error;
        $cleared = 0;
    }

    /***************************************************/
    /* THIRD CHECK: overall credits > 36               */
    /***************************************************/

    $credits_sum = $db->query("SELECT sum(credits) as sum_of_credits from transcript where university_id =".$user);
    $credits_sum = $credits_sum->fetch_assoc();
    $credits_sum = $credits_sum['sum_of_credits'];

    if(!empty($credits_sum)){
        if($credits_sum < 36){
            /* DID NOT MEET CREDIT MINIMUM */
            echo "Did not meet minimum credit requirement. Returning...<br />";
            $cleared = 0;
        }
    }
    else{
        echo "Could not retreive credit information. Returning... <br />";
        $cleared = 0;
    }

    /**************************************************/
    /* FOURTH CHECK: did the student's thesis get     */
    /*               approved?                        */
    /**************************************************/
    $sql = "SELECT thesis FROM student WHERE university_id = '.$user.';";
    $result_6 = mysqli_query($db,$sql);

    if(!empty($result_6)){
        if($result_6 !== 1){
            echo "Student's thesis has not been approved by the GS yet.";
            $cleared = 0;
        }
    }
    else{
        echo "Could not access thesis information. Returning... <br />";
        echo $db->error;
        $cleared = 0;
    }

    /**************************************************/
    /* IF WE MADE IT TO THIS POINT, CLEAR FOR GRAD!!! */
    /**************************************************/
    if($cleared === 1){
        $sql = "UPDATE student SET clear_for_grad = 1 WHERE university_id =".$user.";";
        echo "Cleared for graduation!";
        header("Location: student.php");
    }

?>