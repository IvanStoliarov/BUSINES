<?php
	require "../engine/db_connect.php";
	include "../engine/vk_config.php";
	include "../engine/fb_config.php";
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
	
	<link rel="stylesheet" type="text/css" href="../css/magnific-popup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<title>Админ панель: Настройки</title>
</head>
<body>
	
	<header class="header" id="ex1">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<a style="text-decoration: none;" href="../admin">
						<img src="../img/logo.png" alt="Otziv video" class="logo animated rubberBand">
					</a>
				</div>
				<?php if(isset($_SESSION['logged_user'])&&(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['STATUS']==3)){ ?>
				<a style="text-decoration: none; color: black;" href="../admin/index.php"><div class="admin_menu_item" style="right: 200px; position: absolute; top: 12px; padding: 10px; background-color: grey; border-radius: 5px;">Пользователи</div></a>
				<a style="text-decoration: none; color: black;" href="../admin/settings.php"><div class="admin_menu_item" style="right: 100px; position: absolute; top: 12px; padding: 10px; background-color: grey; border-radius: 5px;">Настройки</div></a>
				<?php } ?>
	</header>
	<?php

	if(isset($_SESSION['logged_user'])&&(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['STATUS']==3)){
		//Проверяю на наличие изменений в полях и вношу их в базу
		?>
		<!-- Все ок ввыводим админку -->
		<?php
		if(isset($_POST['save_changes'])){
			$admin_info=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));
			if(($_POST['phone']!="")&&($_POST['phone']!=$admin_info['PHONE'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET PHONE='".$_POST['phone']."'");
			}
			if(($_POST['email']!="")&&($_POST['email']!=$admin_info['EMAIL'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET EMAIL='".$_POST['email']."'");
			}
			if(($_POST['telegram']!="")&&($_POST['telegram']!=$admin_info['TELEGRAM'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET TELEGRAM='".$_POST['telegram']."'");
			}
			if(($_POST['whatsapp']!="")&&($_POST['whatsapp']!=$admin_info['WHATSAPP'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET WHATSAPP='".$_POST['whatsapp']."'");
			}
			if(($_POST['viber']!="")&&($_POST['viber']!=$admin_info['VIBER'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET VIBER='".$_POST['viber']."'");
			}
            if(($_POST['yamoney_vallet']!="")&&($_POST['yamoney_vallet']!=$admin_info['YAMONEY_VALLET'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET YAMONEY_VALLET='".$_POST['yamoney_vallet']."'");
			}
            if(($_POST['yamoney_secret']!="")&&($_POST['yamoney_secret']!=$admin_info['YAMONEY_SECRET'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET YAMONEY_SECRET='".$_POST['yamoney_secret']."'");
			}
            if(($_POST['qiwi_vallet']!="")&&($_POST['qiwi_vallet']!=$admin_info['QIWI_VALLET'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET QIWI_VALLET='".$_POST['qiwi_vallet']."'");
			}
            if(($_POST['qiwi_secret']!="")&&($_POST['qiwi_secret']!=$admin_info['QIWI_SECRET'])){
				mysqli_query($connection, "UPDATE `ADMIN` SET QIWI_SECRET='".$_POST['qiwi_secret']."'");
			}
			if(($_POST['old_password']!="")&&($_POST['new_password']!="")&&($_POST['new_password_2']!="")&&($_POST['new_password']==$_POST['new_password_2'])&&(password_verify($_POST['new_password'], mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['PASSWORD']))){
				mysqli_query($connection, "UPDATE `USERS` SET PASSWORD='".password_hash($_POST['new_password'], PASSWORD_DEFAULT)."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
			}elseif(($_POST['old_password']=="")&&(($_POST['new_password']!="")||($_POST['new_password_2']!=""))){
				?><script type="text/javascript">alert("Для изменения пароля введите старый!");</script><?php
			}elseif(($_POST['old_password']!="")&&(($_POST['new_password']=="")||($_POST['new_password_2']==""))){
				?><script type="text/javascript">alert("Для изменения пароля введите новый!");</script><?php
			}elseif($_POST['new_password']!=$_POST['new_password_2']){
				?><script type="text/javascript">alert("Введённые пароли не совпадают!");</script><?php
			}elseif(!password_verify($_POST['old_password'], mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['PASSWORD'])&&($_POST['old_password'])!=""){
				?><script type="text/javascript">alert("Вы ввели неправильный старый пароль!");</script><?php
			}
			$result=mysqli_query($connection, "SELECT * FROM `TARIFS`");
			while($res=mysqli_fetch_assoc($result)){
				if($_POST['tarif_'.$res['ID'].'_name']!=""){
					mysqli_query($connection, "UPDATE `TARIFS` SET NAME='".$_POST['tarif_'.$res['ID'].'_name']."' WHERE ID='".$res['ID']."'");
				}
				if($_POST['tarif_'.$res['ID'].'_price']!=""){
					mysqli_query($connection, "UPDATE `TARIFS` SET PRICE='".$_POST['tarif_'.$res['ID'].'_price']."' WHERE ID='".$res['ID']."'");
				}
				if($_POST['tarif_'.$res['ID'].'_quantity']!=""){
					mysqli_query($connection, "UPDATE `TARIFS` SET ORDERS_QUANTITY='".$_POST['tarif_'.$res['ID'].'_quantity']."' WHERE ID='".$res['ID']."'");
				}
			}
		}
		if(isset($_POST['default_promo_url'])&&($_POST['default_promo_url']!="")){
			$old_default_promo_url=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['DEFAULT_PROMO_URL'];
            $url=stristr($_POST['default_promo_url'], "watch?v");
            $url=str_replace("watch?v=", "", $url);
			$result=mysqli_query($connection, "SELECT * FROM `USERS` WHERE PROMO_URL='".$old_default_promo_url."'");
			while ($res=mysqli_fetch_assoc($result)) {
				mysqli_query($connection, "UPDATE `USERS` SET PROMO_URL='".$url."' WHERE ID='".$res['ID']."'");
			}
			mysqli_query($connection, "UPDATE `ADMIN` SET DEFAULT_PROMO_URL='".$url."'");
		}
		$admin_info=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));
		?>
		<h2 style="margin: auto; top: 100px; position: relative; text-align: center; color: #e0e0e0;">Настройки</h2>
		<div class="wrapper_show_settings">
			<form id="admin_settings" method="post">
				<div>
					<h5>Контактная информация</h5>
					<div class="show_settings_div">
						<input form="admin_settings" id="phone" type="text" name="phone" <?php if($admin_info['PHONE']!=""){echo 'value="'.$admin_info['PHONE'].'"';}else{echo 'placeholder="Информация отсутствует"';} ?> ><label for="phone">Телефон</label><br>
						<input form="admin_settings" id="email" type="text" name="email" <?php if($admin_info['EMAIL']!=""){echo 'value="'.$admin_info['EMAIL'].'"';}else{echo 'placeholder="Информация отсутствует"';} ?> ><label for="email">E-mail</label><br>
						<input form="admin_settings" id="telegram" type="text" name="telegram" <?php if($admin_info['TELEGRAM']!=""){echo 'value="'.$admin_info['TELEGRAM'].'"';}else{echo 'placeholder="Информация отсутствует"';} ?> ><label for="telegram">Телеграм</label><br>
						<input form="admin_settings" id="whatsapp" type="text" name="whatsapp" <?php if($admin_info['WHATSAPP']!=""){echo 'value="'.$admin_info['WHATSAPP'].'"';}else{echo 'placeholder="Информация отсутствует"';} ?> ><label for="whatsapp">Whatsapp</label><br>
						<input form="admin_settings" id="viber" type="text" name="viber" <?php if($admin_info['VIBER']!=""){echo 'value="'.$admin_info['VIBER'].'"';}else{echo 'placeholder="Информация отсутствует"';} ?> ><label for="viber">Viber</label>
					</div>
				</div>
				<hr>
				<div>
					<h5>Безопасность</h5>
					<div class="show_settings_div">
						<input form="admin_settings" id="old_password" type="password" name="old_password"><label for="old_password">Старый пароль</label><br>
						<input form="admin_settings" id="new_password" type="password" name="new_password"><label for="new_password">Новый пароль</label><br>
						<input form="admin_settings" id="new_password_2" type="password" name="new_password_2"><label for="new_password_2">Новый пароль ещё раз</label>
					</div>
				</div>
				<hr>
				<div>
					<h5>Тарифы</h5>
					<div class="show_settings_div">
						<?php
						$result=mysqli_query($connection, "SELECT * FROM `TARIFS`");
						while($res=mysqli_fetch_assoc($result)){
						?>
						<input form="admin_settings" class="tarif_name" type="text" name="tarif_<?php echo $res['ID'] ?>_name" value="<?php echo $res['NAME'] ?>"><input form="admin_settings" class="tarif_price" type="text" name="tarif_<?php echo $res['ID'] ?>_price" value="<?php echo $res['PRICE'] ?>"><input form="admin_settings" class="tarif_quantity" type="text" name="tarif_<?php echo $res['ID'] ?>_quantity" value="<?php echo $res['ORDERS_QUANTITY'] ?>"><br>
						<?php } ?>
					</div>
				</div>
				<hr>
                <div>
					<h5>Платёжная информация - Яндекс</h5>
					<div class="show_settings_div">
						<input form="admin_settings" id="default_promo_url" type="text" name="yamoney_vallet" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['YAMONEY_VALLET'] ?>"><label for="yamoney_vallet">Яндекс кошелёк</label><br>
                        <input form="admin_settings" id="default_promo_url" type="text" name="yamoney_secret" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['YAMONEY_SECRET'] ?>"><label for="yamoney_secret">Яндекс секрет</label>
					</div><br>
				</div>
                <hr>
                <div>
					<h5>Платёжная информация - QIWI</h5>
					<div class="show_settings_div">
						<input form="admin_settings" id="default_promo_url" type="text" name="qiwi_vallet" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['QIWI_VALLET'] ?>"><label for="qiwi_vallet">QIWI кошелёк</label><br>
                        <input form="admin_settings" id="default_promo_url" type="text" name="qiwi_secret" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['QIWI_SECRET'] ?>"><label for="qiwi_secret">QIWI секрет</label>
					</div><br>
				</div>
                <hr>
				<div>
					<h5>Дополнительно</h5>
					<div class="show_settings_div">
						<input form="admin_settings" id="default_promo_url" type="text" name="default_promo_url" value="<?php echo 'https://www.youtube.com/watch?v='.mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['DEFAULT_PROMO_URL'] ?>"><label for="default_promo_url">Промо-ролик по умолчанию</label>
					</div><br>
				</div>
			</form>
		</div>
		<input form="admin_settings" type="hidden" name="save_changes">
		<button class="save_changes" form="admin_settings">Сохранить</button>
		<?php 	
	}else{
		?>
		<div class="not_admin_warning">Вы не авторизованы или не являетесь админом!<br><a class="to_login_link" href="../login.php?from=../admin/settings.php">Авторизоваться</a></div>
		<?php
	}

	?>
	<style type="text/css">
		div.not_admin_warning{
			background-color: white;
			padding: 20px;
			margin: auto;
			max-width: 500px;
			top: 150px;
			position: relative;
			box-shadow: 4px 5px 8px #494949;
			border-radius: 8px;
			text-align: center;
		}
		body{
			background-color: grey;
			min-width: 1000px;
		}
		div.not_admin_warning:hover{
			box-shadow: 8px 9px 15px #494949;
		}
		.to_login_link{
			text-decoration: none;
			color: blue;
		}
		.to_login_link:hover{
			color: red;
			text-decoration: none;
		}
		.wrapper_show_settings{
			position: relative;
			margin: auto auto 30px auto;
			box-shadow: 4px 5px 8px #494949;
			max-width: 700px;
			padding: 20px;
			top: 150px;
			background-color: white;
		}
		.show_settings_div{
			left: 0;
			width: 100%;
			background-color: #ebebeb;
			border-radius: 4px;
			padding: 10px;
			position: relative;
			margin-bottom: 10px;
		}
		.admin_menu_item:hover{
			background-color: white;
			color: white;
		}
		input{
			margin-left: 10px;
			margin-top: 5px;
			width: 250px;
		}
		label{
			margin-left: 10px;
			margin-top: 5px;
		}
		.save_changes{
			position: fixed;
			right: 20px;
			bottom: 20px;
			border-radius: 6px;
			padding: 4px;
			background-color: #42dfeb;
			border-width: 0;
			font-size: x-large;
			box-shadow: 4px 5px 8px #494949;
		}
		.save_changes:hover{
			background-color: orange;
		}
		.tarif_name{
			max-width: 35%;
		}
		.tarif_price{
			max-width: 25%;
		}
		.tarif_quantity{
			max-width: 25%;
		}
		.add_new_tarif_btn{
			right: -10px;
			position: absolute;
			margin: 10px;
			top: -15px;
			border-radius: 4px;
			border-width: 1px;
			height: 30px;
			width: 200px;
			background-color: #dddddd;
			text-decoration: none;
			text-align: center;
		}
		.add_new_tarif_btn:hover{
			right: -10px;
			position: absolute;
			margin: 10px;
			top: -15px;
			border-radius: 4px;
			border-width: 1px;
			height: 30px;
			width: 200px;
			background-color: #dddddd;
			text-decoration: none;
			text-align: center;
		}
		h5{
			width: 100%;
			position: relative;
		}
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../slick/slick.min.js"></script>
	<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/js.js"></script>

</body>
</html>