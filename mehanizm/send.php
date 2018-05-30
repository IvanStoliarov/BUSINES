<?php
$selectedLiftingHeight = $_POST['LiftingHeight'];
$seletedcarrying = $_POST['carrying'];
$seletedProduct = $_POST['product'];
$name = $_POST['name'];
$tel = $_POST['tel'];
$email = $_POST['email'];

$selectedLiftingHeight = htmlspecialchars($selectedLiftingHeight);
$seletedcarrying = htmlspecialchars($seletedcarrying);
$seletedProduct = htmlspecialchars($seletedProduct);
$name = htmlspecialchars($name);
$tel = htmlspecialchars($tel);
$email = htmlspecialchars($email);

$seletedcarrying = urldecode($seletedcarrying);
$selectedLiftingHeight = urldecode($selectedLiftingHeight);
$seletedProduct = urldecode($seletedProduct);
$name = urldecode($name);
$tel = urldecode($tel);
$email = urldecode($email);

$selectedLiftingHeight = trim($selectedLiftingHeight);
$seletedcarrying = trim($seletedcarrying);
$seletedProduct = trim($seletedProduct);
$tel = trim($tel);
$email = trim($email);
$name = trim($name);


$to = 'Your@gmail.com';
$subject = 'Тема сообщения';
$message = "Продукт: $seletedProduct \r\n
           Грузоподъемность: $seletedcarrying  \r\n
           Высота: $selectedLiftingHeight  \r\n
           Name: $name \r\n
           Tel: $tel \r\n
           Email: $email   ";

mail($to , $subject, $message  ,"From: user@email \r\n");
header("Location: http://");
}?>


