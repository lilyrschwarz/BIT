<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Select a Class</title>
        <style>
            input[type=text] {
                width: 70%;
                padding: 5px 15px;
                margin: 8px 0;
                border-radius: 10px;
                border: 1px solid;
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
        <link rel="icon" type="image/png" href="images/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="images/favicon-16x16.png" sizes="16x16" />
        <link rel = "stylesheet" type="text/css" href="style.css"/>
    </head>
	<body class="gray-bg">
        <ul>
             <li><a class="active" href="menu.php">Menu</a></li>
             <li style="float:right"><a href="logout.php">Log Out</a></li>
        </ul>
        <br>
        <?php
            session_start();
            $dept = $_POST['coursedept'];

            //Ensure user is logged in
            $loggedin = $_SESSION['loggedin'];
            if(!$loggedin) {
                header("Location: login.php");
                die();
            }

            //send to menu page if they don't have sufficient permissions
            if(!($_SESSION['type']=="secr" || $_SESSION['type']=="admin")) {
                header("Location: view-rosters.php");
                die();
            }

            //Connect to database
            $search = $_POST['search'];
            $servername = "localhost";
            $username = "SJL";
            $password = "SJLoss1!";
            $dbname = "SJL";
            $connection = mysqli_connect($servername, $username, $password, $dbname);
            if (!$connection) {
                die("Couldn't connect: ".mysqli_error());
            }         

            // Limit courses displayed to one department
            echo '<div style="float: right;">';
            echo "<div style=\"display: inline-block;\">";
            $query = "select distinct dept from course";
            $result = mysqli_query($connection, $query);
    
            // Create a drop down menu with list of departments
            echo '<form action="view-rosters.php" method="post">';
            echo '<select name="coursedept" style="width: 200px; height: 50px;">';
            echo '<option>Select a department</option>';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<option value="'.$row['dept'].'">'.$row['dept'].'</option>';
            }
            echo '</select>';
            echo '<input type="submit" value="Go" style="height: 50px;">';
            echo '</form>';
            echo "</div></div>";

            // No departments selected? Prompt user to pick one
            if(empty($dept) || $dept=='Select a department') {
                echo "<div style=\"text-align: center;\" class=\"gray-text\">";
                echo "It looks like you haven't picked a department!</div>";
                die();
            }

            //Search box
            echo "<div style=\"text-align: center;\">";
            echo "<form method=\"post\" action=\"add-drop.php\"><input type=\"text\" name=\"search\" placeholder=\"Search for course by name...\"/><input type=\"submit\" value=\"Search\"/>";
            echo '<input type="hidden" value="'.$dept.'" name="coursedept">';
            echo "</form></div>";
            echo "<br><br>";

            //Display all courses or the search results
            if (is_null($search)) {

                //no search terms - select all courses from current year
                $query = "select crn, dept, courseno, name, credits, day, tme, prereq1, prereq2, lname from course, user where semester = 'spring' and year = '2019' and tme is not null and course.instructor=user.uid and dept='".$dept."' order by dept, courseno";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    //Display CRN, department, course number, name, credits, day, and time
                    echo "<thead><tr><th>CRN</th><th>Dept</th><th>Number</th><th>Name</th><th>Credits</th><th>Day</th><th>Time</th><th>Prerequisite 1</th><th>Prerequisite 2</th><th>Instructor</th></tr></thead>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["crn"] . "</td>";
                        echo "<td>" . $row["dept"] . "</td>";
                        echo "<td>" . $row["courseno"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["credits"] . "</td>";
                        echo "<td>" . $row["day"] . "</td>";
                        echo "<td>" . $row["tme"] . "</td>";
                        echo "<td>" . $row["prereq1"] . "</td>";
                        echo "<td>" . $row["prereq2"] . "</td>";
                        echo "<td>" . $row["lname"] . "</td>";

                        echo "<td>";
                        echo "<form action=\"viewroster.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"crn\" value=\"" . $row["crn"] . "\">";
                        echo "<input type=\"submit\" value=\"View Course Roster\"/>";
                        echo "</form>";
                        echo "</td>";

                        echo "</tr>";
                    }
                    echo "</table>";

                } else {
                    //If nothing came back from the query, there was a problem
                    die("Bad query: ".mysqli_error());
                }
            } else {
                //There WERE search terms, so display same info as above but for only the relevant courses
                $query = "select crn, dept, courseno, name, credits, day, tme, prereq1, prereq2, lname from course, user where semester = 'spring' and year = '2019' and name like '%".$search."%' and tme is not null and course.instructor=user.uid and dept='".$dept."' order by dept, courseno";
                $result = mysqli_query($connection, $query);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    //Display CRN, department, course number, name, credits, day, and time
                    echo "<thead><tr><th>CRN</th><th>Dept</th><th>Number</th><th>Name</th><th>Credits</th><th>Day</th><th>Time</th><th>Prerequisite 1</th><th>Prerequisite 2</th><th>Instructor</th></tr></thead>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["crn"] . "</td>";
                        echo "<td>" . $row["dept"] . "</td>";
                        echo "<td>" . $row["courseno"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["credits"] . "</td>";
                        echo "<td>" . $row["day"] . "</td>";
                        echo "<td>" . $row["tme"] . "</td>";
                        echo "<td>" . $row["prereq1"] . "</td>";
                        echo "<td>" . $row["prereq2"] . "</td>";
                        echo "<td>" . $row["lname"] . "</td>";

                        echo "<td>";
                        echo "<form action=\"viewroster.php\" method=\"post\">";
                        echo "<input type=\"hidden\" name=\"crn\" value=\"" . $row["crn"] . "\">";
                        echo "<input type=\"submit\" value=\"View Course Roster\"/>";
                        echo "</form>";
                        echo "</td>";

                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Your search returned no results.";
                }
            }
            //close sql connection
            mysqli_close($connection);
        ?>
	</body>
</html>
