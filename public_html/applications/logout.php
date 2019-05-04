<?php
    session_start();
    if($_SESSION['role'] == "CAC" || $_SESSION['role'] == "FR"){
	    session_unset();
	    header("Location: http://gwupyterhub.seas.gwu.edu/~sloanej/SJL/public_html/registration/login.php");
	    exit();

	}
	else{
		session_unset();
		header("Location: login.php");
		exit();
	}
?>