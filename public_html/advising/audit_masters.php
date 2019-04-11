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

    /* store university ID in $user */
    $user = $_SESSION['login_user'];

    /* FIRST CHECK: did student fill out a form 1?     */
    $sql_1 = "SELECT * FROM form1 WHERE university_id =" .$user.";";
    $result = mysqli_query($db, $sql_1);

    if(empty($result)){
        echo "Student did not complete a form 1. Returning...<br />";
        $cleared = 0;
    }
    else if (!empty($result)) {
        echo "student completed form 1!<br />";
    }

    /***************************************************/
    /* SECOND CHECK: completed required courses?       */
    /***************************************************/

    if(array_search(6212, $classes) !== FALSE){
        echo "course 1 reqt met! <br />";
    }
    else{
        /* DID NOT MEET COURSE 1 REQT */
        echo "course 1 reqt not met. <br />";
        $cleared = 0;
    }

    if(array_search(6221, $classes) !== FALSE){
        echo "course 2 reqt met! <br />";
    }
    else{
        /* DID NOT MEET COURSE 2 REQT */
        echo "course 2 reqt not met. <br />";
        $cleared = 0;
    }

    if(array_search(6461, $classes) !== FALSE){
        echo "course 3 reqt met! <br />";
    }
    else{
        /* DID NOT MEET COURSE 3 REQT */
        echo "course 3 reqt not met. <br />";
        $cleared = 0;
    }

    /***************************************************/
    /* THIRD CHECK: no more than 2 grades below B      */
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

    if($grades_below_b > 2){
        /* MORE THAN TWO GRADES BELOW B */
        echo "More than two grades below B. Returning...<br />";
        $cleared = 0;
    }

    /***************************************************/
    /* FOURTH CHECK: overall gpa > 3.0                 */
    /***************************************************/
    $sql = "SELECT GPA FROM student WHERE university_id = ".$user.";";
    $result_4 = mysqli_query($db,$sql);

    if(!empty($result_4)){
        $gpa = $result_4->fetch_assoc();
        if($gpa['GPA'] < (float)3.0){
            /* DID NOT MEET GPA REQT */
            echo "GPA below 3.0. Returning...<br />";
            $cleared = 0;
        }
    }
    else{
	    echo "Could not access GPA information. Returning... <br />";
	    echo $db->error;
        $cleared = 0;
    }

    /***************************************************/
    /* FIFTH CHECK: overall credits > 30               */
    /***************************************************/

    $credits_sum = $db->query("SELECT sum(credits) as sum_of_credits from transcript where university_id =".$user);
    $credits_sum = $credits_sum->fetch_assoc();
    $credits_sum = $credits_sum['sum_of_credits'];

    // $sql = "SELECT total_credits FROM student WHERE university_id = '.$user.';";
    // $result_5 = mysqli_query($db,$sql);

    if(!empty($credits_sum)){
        if($credits_sum < 30){
            /* DID NOT MEET CREDIT MINIMUM */
            echo "Did not meet minimum credit requirement. Returning...<br />";
            $cleared = 0;
        }
    }
    else{
        echo "Could not retreive credit information. Returning... <br />";
        $cleared = 0;
    }

    /***************************************************/
    /* SIXTH CHECK: no more than 2 non-csci classes    */
    /* as a part of the 30 credit minimum              */
    /***************************************************/

    $sql = "SELECT subject FROM transcript WHERE university_id = ".$user.";";
    $result_6 = mysqli_query($db,$sql);

    $class_subj = array();
    if(!empty($result_6)){
        while($row = $result_6->fetch_assoc()){
            $class_subj[] = $row;
        }
    }
    else{
        echo "Could not receive course subject data. Returning... <br />";
        $cleared = 0;
    }

    $num_noncsci_arr = array_count_values($class_subj);
    $num_noncsci = $num_noncsci_arr['ECE'] + $num_noncsci_arr['MATH'];
    if($num_noncsci > 2){
        /* MORE THAN 2 NON CSCI CLASSES */
        echo "More than two classes in minimum credits are non-csci. Returning...<br />";
        $cleared = 0;
        //return
    }

    /**************************************************/
    /* IF WE MADE IT TO THIS POINT, CLEAR FOR GRAD!!! */
    /**************************************************/
    if($cleared === 1){
        $sql = "UPDATE student SET clear_for_grad = 1 WHERE university_id =".$user.";";
        mysqli_query($db, $sql);
        echo "Cleared for graduation!";
    }

?>
