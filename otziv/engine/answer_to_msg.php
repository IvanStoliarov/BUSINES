<?php
require 'db_connect.php';

mysqli_query($connection, "INSERT INTO `MAILS` (FROM_ID, TO_ID, TEXT, TYPE, STATUS) VALUES ('".$_SESSION['logged_user']['ID']."', '".$_GET['to_id']."', '".$_GET['message_body']."', '2', '2')");

?>