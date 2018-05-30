<?php
require 'db_connect.php';

if(isset($_POST['message_type'])&&($_POST['message_type']=="contact_form")){
	mail(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['EMAIL'], "Отзыв видео: ".$_POST['email'], $_POST['text']);
}elseif(isset($_POST['message_type'])&&($_POST['message_type']=="to_manager")){
	mail(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['EMAIL'], "Отзыв видео: менеджеру от ".$_SESSION['logged_user']['LOGIN'], $_POST['to_manager_text']);
}


?>