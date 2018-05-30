<?php
	require '../engine/db_connect.php';
	unset($_SESSION['choosen_performers']);
	$_SESSION['choosen_performers']=$_GET['perf'];
?>