<?php
	require "engine/db_connect.php";
	include "engine/vk_config.php";
	include "engine/fb_config.php";
	unset($_SESSION['logged_user']);
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

	<div class="login-form">
		<form method="POST" class="login-form">
			
			<?php

				$data = $_POST;

				if(isset ($data['do_login'])){
					$errors = array();

					if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE LOGIN='".$data['login']."' OR EMAIL='".$data[login]."'")) <= 0){
						$errors[] = 'Пользователь не найден!';
					}else{
						//Пользователь существует, проверяем пароль
						if(password_verify($data['password'], mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE EMAIL='".$data['login']."' OR LOGIN='".$data['login']."'"))['PASSWORD'])){
							//Все хорошо, логиним пользователя
    						$_SESSION['logged_user'] = mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE LOGIN='".$data['login']."' OR EMAIL='".$data['login']."'"));
							?><script>
								window.location.href = "<?php if(isset($_GET['from'])){echo $_GET['from'];}else{echo '../cabinet.php';} ?>";
							</script><?php
						}else{
							$errors[] = 'Пароль неверный!';
						}
					}

					if(!empty($errors)){
						echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
					}

				}
			?>

			<p>
				<p><strong>Логин</strong></p>
				<input type="text" name="login" value="<?php echo @$data['login']; ?>">
			</p>

			<p>
				<p><strong>Пароль</strong></p>
				<input type="password" name="password" value="<?php echo @$data['password']; ?>">
			</p>

			<p>
				<button type="submit" name="do_login">Войти</button>
			</p>
			<p>Еще не зарегистрированы? <a href="signup.php">Зарегистрироваться</a></p>
		</form>
		<p><strong>Вход через социальные сети</strong></p>
		<script src="//ulogin.ru/js/ulogin.js"></script>
		<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,photo_big,bdate;providers=vkontakte,facebook,twitter;hidden=;redirect_uri=http%3A%2F%2Fotziv.video%2Fengine%2Fauthorisation_success.php;mobilebuttons=0;"></div>
	</div>

	<style type="text/css">
		div.login-form{
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
		input{
			border-radius: 4px;
			border-width: 1px;
		}
		div.login-form:hover{
			box-shadow: 8px 9px 15px #494949;
		}
		input:hover{
			background-color: #e7e7e7;
		}
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/js.js"></script>

</body>
</html>