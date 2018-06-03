<?php
	require "engine/db_connect.php";
	include "engine/vk_config.php";
	include "engine/fb_config.php";
	unset($_SESSION['logged_user']);
	mysqli_set_charset($connection, 'utf8');
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
		<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,photo_big,bdate;providers=vkontakte,facebook;hidden=;redirect_uri=http%3A%2F%2Fotziv.video%2Fengine%2Fauthorisation_success.php;mobilebuttons=0;"></div>
	</div>

	<footer class="footer">
		<div class="container">
			<div class="row">
					<?php
					$result=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));
					if(($result['PHONE']!="")||($result['EMAIL']!="")||($result['TELEGRAM']!="")||($result['WHATSAPP']!="")||($result['VIBER']!="")){
					?>
				<div class="col-md-3 animated footer_a">
					<img src="img/contact.png" alt="contact" class="footer__img_contact">
					<h2 class="footer__contact">
						контакты
					</h2>
					<div class="footer__line"></div>
					<?php if($result['EMAIL']!=""){ ?>
					<img src="img/mail (1).png" alt="mail" class="footer__img_mail">
					<p class="footer__mail"><a style="text-decoration: none; color: white; top: -23px; position: relative;" href="mailto:<?php echo $result['EMAIL'] ?>"><?php echo $result['EMAIL'] ?></a></p>
					<?php } ?>
					<ul class="footer__contact_social d-flex">
						<?php if($result['TELEGRAM']!=""){ ?>
						<li class="footer__contact_item">
							<a href="#" class="footer__contact_link">
								<img src="img/telegram.png" alt="telegram" class="footer__contact_img">
							</a>
						</li>
						<?php } ?>
						<?php if($result['WHATSAPP']!=""){ ?>
						<li class="footer__contact_item">
							<a href="#" class="footer__contact_link">
								<img src="img/whatsapp.png" alt="whatsapp" class="footer__contact_img">
							</a>
						</li>
						<?php } ?>
						<?php if($result['VIBER']!=""){ ?>
						<li class="footer__contact_item">
							<a href="#" class="footer__contact_link">
								<img src="img/viber.png" alt="viber" class="footer__contact_img">
							</a>
						</li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
				<div class="col-md-1"></div>
				<div class="col-md-4 animated footer_b">
					<img src="img/file.png" alt="message" class="footer__img_massage">
					<h3 class="footer__message">
						написать нам
					</h3>
					<form id="contact_form" method="POST" action="../engine/send_external_message.php">
						<input type="hidden" name="message_type" value="contact_form">
						<input form="contact_form" type="email" class="footer__form_email" name="email" placeholder="Ваш мейл">
						<textarea form="contact_form" type="text" class="footer__form_text" name="text" placeholder="Текст сообщения"></textarea>
						<button form="contact_form" class="footer__form_btn"><img src="img/mail.png" alt="" class="footer__img_mailf"></button>
					</form>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-3 animated footer_c">
					<img src="img/user.png" alt="user" class="footer__img_user">
					<h3 class="footer__user">
						пользователю
					</h3>
					<div class="footer__line footer__line_right"></div>
					<ul class="footer__menu">
						<li class="footer__item">
							<a href="#2" class="footer__link">Стать исполнителем</a>
						</li>
						<li class="footer__item">
							<a href="#ex6" class="footer__link">Заказать отзыв</a>
						</li>
						<li class="footer__item footer__item_a">
							<a href="../login.php" style="color: #dfe0e2; text-align: right; font-size: 18px; font-family: 'Open Sans', sans-serif; font-weight: 600; text-decoration: none;" ">Войти/зарегистрироваться</a>
						</li>
						<li class="footer__item">
							<a href="../login.php" class="footer__link">Авторизация через соцсети</a>
						</li>
					</ul>
					<ul class="footer__menu_social d-flex justify-content-end">
						<script src="//ulogin.ru/js/ulogin.js"></script>
						<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,photo_big,bdate;providers=vkontakte,facebook,twitter;hidden=;redirect_uri=http%3A%2F%2Fotziv.video%2Fengine%2Fauthorisation_success.php;mobilebuttons=0;"></div>
					</ul>
				</div>
			</div>
		</div>
	</footer>

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
		footer{
			position: relative;
			bottom: -250px;
		}
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/js.js"></script>

</body>
</html>