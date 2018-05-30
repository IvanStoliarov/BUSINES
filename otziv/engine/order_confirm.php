<?php
require '../engine/db_connect.php';

if(isset($_GET['order_id_to_reject'])){
	mysqli_query($connection, "UPDATE `ORDERS` SET STATUS='1' WHERE ID='".$_GET['order_id_to_reject']."'");
	mysqli_query($connection, "INSERT INTO `MAILS` (TYPE, STATUS, MESSAGE_TEXT, FROM_ID, TO_ID) VALUES ('1', '2', 'Ваша работа отправлена на доработку заказчиком ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".$_SESSION['logged_user']['ID']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE ID='".$_GET['order_id_to_reject']."'"))['PERFORMER_ID']."')");
	mysqli_query($connection, "UPDATE `USERS` SET DENIED_ORDERS=('".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['order_id_to_reject']."'"))['DENIED_ORDERS']."'+1)");
}elseif(isset($_GET['order_id_to_accept'])){
	mysqli_query($connection, "UPDATE `ORDERS` SET STATUS='3' WHERE ID='".$_GET['order_id_to_accept']."'");
	mysqli_query($connection, "INSERT INTO `MAILS` (TYPE, STATUS, MESSAGE_TEXT, FROM_ID, TO_ID) VALUES ('1', '2', 'Ваша работа принята заказчиком ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".$_SESSION['logged_user']['ID']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE ID='".$_GET['order_id_to_accept']."'"))['PERFORMER_ID']."')");
	mysqli_query($connection, "UPDATE `USERS` SET GRANTED_ORDERS=('".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['order_id_to_accept']."'"))['GRANTED_ORDERS']."'+1), BALANCE='".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['order_id_to_accept']."'"))['BALANCE']+mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE ID='".$_GET['order_id_to_accept']."'"))['PRICE']."'");
}

?>