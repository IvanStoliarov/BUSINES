<?php

include 'db_connect.php';

if(!$_GET['code']){
	exit('error code');
}

include 'vk_config.php';

$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.ID_vk.'&redirect_uri='.URL_vk.'&client_secret='.SECRET_vk.'&code='.$_GET['code']), true);

if(!$token){
	exit('error token');
}

$data = json_decode(file_get_contents('https://api.vk.com/method/users.get?user_id='.$token['user_id'].'&access_token='.$token['access_token'].'&fields=uid,first_name,last_name,photo_big,email'), true);

if(!$data){
	exit('error data');
}

$data = $data['response'][0];

if(mysqli_num_rows(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$data['uid']."'"))) <= 0){
	//Пользователя не существует создаем и логиним
	mysqli_query($connection, "INSERT INTO `USERS` (LOGIN,exID, AVATAR, EMAIL) VALUES ('".$data['first_name']."','".$data['uid']."','".$data['photo_big']."','".$data['email']."')");
	$_SESSION['logged_user']=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$data['uid']."'"));
	?><script>
		window.location.href = "../";
	</script><?php
}else{
	//Пользователь существует просто логиним
	$_SESSION['logged_user']=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$data['uid']."'"));
	?><script>
		window.location.href = "../";
	</script><?php
}

?>