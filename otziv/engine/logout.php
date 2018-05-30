<?php
	require "db_connect.php";

	unset($_SESSION['logged_user']);

	header('Location: /');
?>