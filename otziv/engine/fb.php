<?

if (!$_GET['code']) {
	exit('error code');
}

include 'config.php';

$token = json_decode(file_get_contents('https://graph.facebook.com/v2.9/oauth/access_token?client_id='.ID_fb.'&redirect_uri='.URL_fb.'&client_secret='.SECRET_fb.'&code='.$_GET['code']), true);

if (!$token) {
	exit('error token');
}

$data = json_decode(file_get_contents('https://graph.facebook.com/v2.9/me?client_id='.ID_fb.'&redirect_uri='.URL_fb.'&client_secret='.SECRET_fb.'&code='.$_GET['code'].'&access_token='.$token['access_token'].'&fields=id,name,email,gender,location'), true);

if (!$data) {
	exit('error data');
}

$data['avatar'] = 'https://graph.facebook.com/v2.9/'.$data['id'].'/picture?width=200&height=200';

if(mysqli_num_rows(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE exID='".$data['uid']."'"))) <= 0){
	//Пользователя не существует создаем и логиним
	mysqli_query($connection, "INSERT INTO `USERS` (NAME, exID, AVATAR, EMAIL, SEX) VALUES ('".$data['name']."','".$data['id']."','".$data['avatar']."','".$data['email']."','".$data['gender']."')");
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