<?php
$name = $_POST['name'];
$tel = $_POST['tel'];
$email = $_POST['email'];

$name = htmlspecialchars($name);
$tel = htmlspecialchars($tel);
$email = htmlspecialchars($email);

$name = urldecode($name);
$tel = urldecode($tel);
$email = urldecode($email);

$tel = trim($tel);
$email = trim($email);
$name = trim($name);


$to = 'your@mail';
$subject = 'Тема сообщения';
$message = "Name: $name \r\n
           Tel: $tel \r\n
           Email: $email   ";
mail($to , $subject, $message  ,"From: user@mail \r\n");
header("Location: http://");
?>


