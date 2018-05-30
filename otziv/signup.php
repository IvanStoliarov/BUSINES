<?php
	require "engine/db_connect.php";
	include "engine/vk_config.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
	
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Авторизация</title>
</head>
<body>

	<header class="header" id="ex1">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a style="text-decoration: none;" href="../">
						<img src="img/logo.png" alt="Otziv video" class="logo animated rubberBand">
					</a>
				</div>
	</header>

	<div class="signup-form">
		<form method="POST">
			<?php

				$data = $_POST;
				if(isset($data['do_signup'])){
					
					//здесь регистрация

					$errors = array();
					if(trim($data['login']) == ''){
						$errors[] = 'Введите Email';
					}

					$errors = array();
					if(trim($data['email']) == ''){
						$errors[] = 'Введите Email';
					}

					if($data['password'] == ''){
						$errors[] = 'Введите пароль';
					}

					if($data['password_2'] != $data['password']){
						$errors[] = 'Пароли не совпадают';
					}

					if((mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE LOGIN='".$data['login']."'"))) > 0){
						$errors[] = 'Пользователь с таким логином уже существует!';
					}

					if((mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE EMAIL='".$data['email']."'"))) > 0){
						$errors[] = 'Пользователь с таким Email уже существует!';
					}

					function file_extension($file){
						if($file=="image/x-windows-bmp"){
							return ".bmp";
						}
						if($file=="image/jpeg"||$file=="image/pjpeg"){
							return ".jpg";
						}
						if($file=="image/png"){
							return ".png";
						}
					}

					if(empty($errors)){
						//Все хорошо регистрируем
						mysqli_query($connection, "INSERT INTO `USERS` (LOGIN, EMAIL, PASSWORD, STATUS, PROMO_URL) VALUES ('".$data['login']."', '".$data['email']."', '".password_hash($data['password'], PASSWORD_DEFAULT)."', '1', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['DEFAULT_PROMO_URL']."')");
						$_SESSION['logged_user']=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE LOGIN='".$data['login']."'"));
						?><script>
								window.location.href = "<?php if(isset($_GET['from'])){echo $_GET['from'];}else{echo '../cabinet.php';} ?>";
						</script><?php
					}else{
						echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
					}

				};

			?>
			
			<p>
				<strong>Логин</strong>
				<input class="ordinary_input" required type="text" name="login" value="<?php echo @$data['login']; ?>">
			</p>

			<p>
				<strong>Email</strong>
				<input class="ordinary_input" required type="text" name="email" value="<?php echo @$data['email']; ?>">
			</p>

			<p>
				<strong>Пароль</strong>
				<input class="ordinary_input" required type="password" name="password" value="<?php echo @$data['password']; ?>">
			</p>

			<p>
				<strong>Пароль еще раз</strong>
				<input class="ordinary_input" required type="password" name="password_2" value="<?php echo @$data['password_2']; ?>">
			</p>

			<p>
				<button type="submit" name="do_signup" class="do_signup_btn">Зарегистрироваться</button>
			</p>
		</form>
		<p><strong>Регистрация через социальные сети</strong></p>
		<script src="//ulogin.ru/js/ulogin.js"></script>
		<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,photo_big,bdate;providers=vkontakte,facebook,twitter;hidden=;redirect_uri=http%3A%2F%2Fotziv.video%2Fengine%2Fauthorisation_success.php;mobilebuttons=0;"></div>
	</div>

	<style type="text/css">
		div.signup-form{
			background-color: white;
			padding: 20px;
			margin: auto;
			max-width: 250px;
			top: 150px;
			position: relative;
			box-shadow: 4px 5px 8px #494949;
			border-radius: 8px;
		}
		body{
			background-color: grey;
		}
		input.ordinary_input{
			border-radius: 4px;
			border-width: 1px;
		}
		div.signup-form:hover{
			box-shadow: 8px 9px 15px #494949;
		}
		input.ordinary_input:hover{
			background-color: #e7e7e7;
		}
		.do_signup_btn{
			background-color: #42dfeb;
			border-radius: 3px;
			border-width: 0;
		}
		.do_signup_btn:hover{
			background-color: orange;
		}
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/js.js"></script>

</body>
</html>