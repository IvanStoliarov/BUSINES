<?php
require 'db_connect.php';

    $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
    $user = json_decode($s, true);
    if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$user['identity']."-".$user['network']."'"))>0){
    	$_SESSION['logged_user']=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$user['identity']."'"));
    }else{
    	mysqli_query($connection, "INSERT INTO `USERS` (LOGIN, exID, PROMO_URL, exAVATAR, BIRTH_DATE) VALUES ('".$user['first_name']."', '".$user['identity']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['DEFAULT_PROMO_URL']."', '".$user['photo_big']."', '".str_replace('.', '-', $user['bdate'])."')");
    	$_SESSION['logged_user']=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$user['identity']."'"));
    }
    //$user['photo_big'] - аватарка
    //$user['bdate'] - дата рождения
    //$user['network'] - соц. сеть, через которую авторизовался пользователь
    //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
    //$user['first_name'] - имя пользователя
    //$user['last_name'] - фамилия пользователя          

?>
<script type="text/javascript">
    window.location.href='../cabinet.php';
</script>