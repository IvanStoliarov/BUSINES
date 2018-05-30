<?php require 'engine/db_connect.php' ?>
<!DOCTYPE html>
<html lang="ru">
<html>
<head>
	<title>Подтверждение заказа</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width" />
	
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
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

	<div class="confirmation_page_wrapper">
		<h2>Данные заказа</h2>
		<h5>Выбранные исполнители</h5>
		<div class="show_selected"><?php
		//Берем логины выбранных исполнителей из БД
		foreach ($_SESSION['choosen_performers'] as $value) {
			echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$value."'"))['LOGIN']." ";
		}
		?></div><br><hr>
		<h5>Описание заказа</h5>
		<div class="order_desc">
			<textarea style="width: 100%; position: relative;" name="text" class="order__video_text_pole" placeholder="Опишите максимально подробно задание для исполнителей"></textarea>
		</div>
		<button class="go_to_payment_button">Оплатить</button>
	</div>

	<style type="text/css">
		.confirmation_page_wrapper{
			background-color: white;
			max-width: 40%;
			height: 60%;
			box-shadow: 8px 9px 15px #494949;
			top: 150px;
			position: relative;
			margin: auto;
			border-radius: 6px;
			padding: 20px;
		}
		body{
			background-color: grey;
		}
		.go_to_payment_button{
			right: 20px;
			bottom: 20px;
			position: absolute;
			margin: 4px;
			background-color: #42dfec;
			border-width: 0;
			border-radius: 4px;
			padding: 12px;
		}
		.go_to_payment_button:hover{
			background-color: orange;
		}
		.show_selected{
			padding-left: 35px;
			position: relative;
			border-width: 1px;
			border-color: grey;
		}
		.order_desc{
			position: relative;
			right: 100px;
			left: 0px;
			max-width: 100%;
			width: auto;
		}
	</style>

	<script
			  src="https://code.jquery.com/jquery-1.12.4.min.js"
			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
			  crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
			  integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0="
			  crossorigin="anonymous"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/js.js"></script>

</body>
</html>