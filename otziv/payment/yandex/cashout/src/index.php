<?php
session_start();
$connection = mysqli_connect("localhost", "root", "qweqwe123", "OT");

define ('CLIENT_ID', 'ee3f3f4374d04e9bbb4bdb851ac1e323');
define ('REDIRECT_URI', 'http://otziv.video/payment/yandex/cashout/src/index.php');
define ('CLIENT_SECRET', 'xqjGtj3kKTUcIu5dUOX386Vw');


require_once(dirname(__FILE__) . '/lib/YandexMoney.php');

$code = $_GET['code'];
if (!isset($code)) { //Посылаем человека на страницу подтверждения получения токена приложением
    $scope = 
        "account-info " .
        "payment-p2p " .
        "payment-shop";

    $authUri = YandexMoney::authorizeUri(CLIENT_ID, REDIRECT_URI, $scope);
    header('Location: ' . $authUri);
    exit();
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Yandex.Money PHP SDK sample app</title>
</head>
<body>
<div>
    <h3>Yandex.Money PHP - TEST GetToken</h3>

    <?php

        $ym = new YandexMoney(CLIENT_ID, './ym.log'); //Создание экземпляра класса YandexMoney для Работы с API
        $receiveTokenResp = $ym->receiveOAuthToken($code, REDIRECT_URI, CLIENT_SECRET);

        print "<p>";
        if ($receiveTokenResp->isSuccess()) {
            $token = $receiveTokenResp->getAccessToken();
            print "Received token: " . $token; // Вывод: Токена
        } else {
            print "Error: " . $receiveTokenResp->getError();
            die();
        }
        print "</p>";

        $resp = $ym->accountInfo($token);

        print "<p>";
            echo 'Identified: '; if($resp->getIdentified()){echo 'Yes';}else{echo 'No';}; echo '</br>'; // Вывод: Идентификации
            echo 'Account: '.$resp->getAccount().'</br>'; // Вывод: Номера счета
            echo 'Balance(RUB): '.$resp->getBalance(); // Вывод: Баланса
        print "</p>";
    ?>
</div>
</body>
</html>
