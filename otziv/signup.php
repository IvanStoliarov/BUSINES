<?php
	require "engine/db_connect.php";
	include "engine/vk_config.php";
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

					if((mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE LOGIN='".strtolower($data['login'])."'"))) > 0){
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
						mysqli_query($connection, "INSERT INTO `USERS` (LOGIN, EMAIL, PASSWORD, STATUS, PROMO_URL) VALUES ('".strtolower($data['login'])."', '".$data['email']."', '".password_hash($data['password'], PASSWORD_DEFAULT)."', '1', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['DEFAULT_PROMO_URL']."')");
						$_SESSION['logged_user']=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE LOGIN='".strtolower($data['login'])."'"));
						?><script>
							setTimeout(function(){
								window.location.href = "<?php if(isset($_GET['from'])){echo $_GET['from'];}else{echo '../cabinet.php';} ?>";
							}, 1500);
						</script><?php
					}else{
						echo '<div style="color: red;">' . array_shift($errors) . '</div><hr>';
					}

				};

			?>
			
			<p>
				<strong>Логин</strong>
				<input id="login_input" class="ordinary_input" required type="text" name="login" value="<?php echo @$data['login']; ?>">
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
		footer{
			position: relative;
			bottom: -263px;
		}
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/js.js"></script>

	<script type="text/javascript">
		var userLoginsInDb = [];
		var selected_performers_counter = 0;

		<?php
		$result_old_users_query=mysqli_query($connection, "SELECT * FROM `USERS`");

		while($res=mysqli_fetch_assoc($result_old_users_query)){
			?>
			userLoginsInDb.push('<?php echo $res['LOGIN'] ?>');
			<?php
		}
		?>

		$("#login_input").keyup(function(){

			var currentLoginValue = $("#login_input").attr("value");

			currentLoginValue = currentLoginValue.toLowerCase();

			currentLoginValue = currentLoginValue.replace('а', 'a');
			currentLoginValue = currentLoginValue.replace('б', 'b');
			currentLoginValue = currentLoginValue.replace('в', 'v');
			currentLoginValue = currentLoginValue.replace('г', 'q');
			currentLoginValue = currentLoginValue.replace('д', 'd');
			currentLoginValue = currentLoginValue.replace('е', 'e');
			currentLoginValue = currentLoginValue.replace("ё", 'e');
			currentLoginValue = currentLoginValue.replace('ж', 'j');
			currentLoginValue = currentLoginValue.replace('з', 'z');
			currentLoginValue = currentLoginValue.replace('и', 'i');
			currentLoginValue = currentLoginValue.replace('й', 'y');
			currentLoginValue = currentLoginValue.replace('к', 'k');
			currentLoginValue = currentLoginValue.replace('л', 'l');
			currentLoginValue = currentLoginValue.replace('м', 'm');
			currentLoginValue = currentLoginValue.replace('н', 'n');
			currentLoginValue = currentLoginValue.replace('о', 'o');
			currentLoginValue = currentLoginValue.replace('п', 'p');
			currentLoginValue = currentLoginValue.replace('р', 'r');
			currentLoginValue = currentLoginValue.replace('с', 's');
			currentLoginValue = currentLoginValue.replace('т', 't');
			currentLoginValue = currentLoginValue.replace('у', 'u');
			currentLoginValue = currentLoginValue.replace('ф', 'f');
			currentLoginValue = currentLoginValue.replace('х', 'h');
			currentLoginValue = currentLoginValue.replace('ц', 'c');
			currentLoginValue = currentLoginValue.replace('ч', 'ch');
			currentLoginValue = currentLoginValue.replace('ш', 'sh');
			currentLoginValue = currentLoginValue.replace('щ', 'sh');
			currentLoginValue = currentLoginValue.replace('ъ', '');
			currentLoginValue = currentLoginValue.replace('ы', 'i');
			currentLoginValue = currentLoginValue.replace('ь', '');
			currentLoginValue = currentLoginValue.replace('э', 'e');
			currentLoginValue = currentLoginValue.replace('ю', 'yu');
			currentLoginValue = currentLoginValue.replace('я', 'ya');

			currentLoginValue = currentLoginValue.replace('А', 'a');
			currentLoginValue = currentLoginValue.replace('Б', 'b');
			currentLoginValue = currentLoginValue.replace('В', 'v');
			currentLoginValue = currentLoginValue.replace('Г', 'q');
			currentLoginValue = currentLoginValue.replace('Д', 'd');
			currentLoginValue = currentLoginValue.replace('Е', 'e');
			currentLoginValue = currentLoginValue.replace("Ё", 'e');
			currentLoginValue = currentLoginValue.replace('Ж', 'j');
			currentLoginValue = currentLoginValue.replace('З', 'z');
			currentLoginValue = currentLoginValue.replace('И', 'i');
			currentLoginValue = currentLoginValue.replace('Й', 'y');
			currentLoginValue = currentLoginValue.replace('К', 'k');
			currentLoginValue = currentLoginValue.replace('Л', 'l');
			currentLoginValue = currentLoginValue.replace('М', 'm');
			currentLoginValue = currentLoginValue.replace('Н', 'n');
			currentLoginValue = currentLoginValue.replace('О', 'o');
			currentLoginValue = currentLoginValue.replace('П', 'p');
			currentLoginValue = currentLoginValue.replace('Р', 'r');
			currentLoginValue = currentLoginValue.replace('С', 's');
			currentLoginValue = currentLoginValue.replace('Т', 't');
			currentLoginValue = currentLoginValue.replace('У', 'u');
			currentLoginValue = currentLoginValue.replace('Ф', 'f');
			currentLoginValue = currentLoginValue.replace('Х', 'h');
			currentLoginValue = currentLoginValue.replace('Ц', 'c');
			currentLoginValue = currentLoginValue.replace('Ч', 'ch');
			currentLoginValue = currentLoginValue.replace('Ш', 'sh');
			currentLoginValue = currentLoginValue.replace('Щ', 'sh');
			currentLoginValue = currentLoginValue.replace('Ъ', '');
			currentLoginValue = currentLoginValue.replace('Ы', 'i');
			currentLoginValue = currentLoginValue.replace('Ь', '');
			currentLoginValue = currentLoginValue.replace('Э', 'e');
			currentLoginValue = currentLoginValue.replace('Ю', 'yu');
			currentLoginValue = currentLoginValue.replace('Я', 'ya');

			var vxojdeniya = 0;

			userLoginsInDb.forEach(function(item, i, arr) {
			  if(item==currentLoginValue||item==currentLoginValue+'_'+vxojdeniya){
			  	vxojdeniya++;
			  }
			});

			if(vxojdeniya>0){
				alert('Пользователь с логином "'+currentLoginValue+'" существует!\nВозможен логин "'+currentLoginValue+'_'+vxojdeniya+'"');
				$("#login_input").attr("value", currentLoginValue+'_'+vxojdeniya);
			}else{
				$("#login_input").attr("value", currentLoginValue);
			}

		})
	</script>

</body>
</html>