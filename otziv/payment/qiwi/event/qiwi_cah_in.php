<?php
session_start();
$connection = mysqli_connect("localhost", "root", "qweqwe123", "OT");

if ( isset($_POST['pay']) )  {


    // Отправляем GET запрос
	$query = file_get_contents( 'https://qiwigate.ru/api?api_key='.mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['QIWI_SECRET'].'&method=activate.eggs&eggs=' . $_POST['voucher'] );

    // Преобразуем JSON ответ в массив
	$json = json_decode( $query );

   
    // Если возникла ошибка завершаем скрипт и выводим текст ошибки
	if ( $json->status == 'error' ) exit( $json->message ); 
    
// ЗДЕСЬ ЗАПИСЬ В БД ИНФОРМАЦИИ О ПЛАТЕЖЕ //

        mysqli_query($connection, "INSERT INTO `PAYMENTS` (AMOUNT, PAYMENT_SERVICE, PAYMENT_TYPE) VALUES ('".$json->sum."', '1', '3')");
        mysqli_query($connection, "UPDATE `USERS` SET BALANCE='".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['BALANCE']+$json->sum."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
        
?>

<script type="text/javascript">
    window.location.href='../../../cabinet.php';
</script>