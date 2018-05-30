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

	if((isset($_SESSION['logged_user'])&&(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['STATUS']==3))||(isset($_SESSION['logged_user'])&&(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['STATUS']==5))){
		
        if(isset($_POST['payment_id_to_submit'])){
            $from_login=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `PAYMENTS` WHERE ID='".$_POST['payment_id_to_submit']."'"))['FROM_ID'];
            $amount=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `PAYMENTS` WHERE ID='".$_POST['payment_id_to_submit']."'"))['AMOUNT'];
            
            mysqli_query($connection, "UPDATE `PAYMENTS` SET STATUS='2' WHERE ID='".$_POST['payment_id_to_submit']."'");
            mysqli_query($connection, "INSERT INTO `MAILS` (TO_ID, MESSAGE_TEXT, DATE, TYPE, STATUS) VALUES ('".$from_login."', 'Вывод с баланса ".$amount." руб. выполнен', '".date('Y-m-d H:i:s')."', '1', '2')");
        }
		?>
		<h2 style="margin: auto; top: 100px; position: relative; text-align: center; color: #e0e0e0;">Платежи</h2>
		<div class="wrapper_show_settings">
				<div>
                    <?php
                    $result=mysqli_query($connection, "SELECT * FROM `PAYMENTS` WHERE STATUS='1' AND PAYMENT_TYPE='2'");
                    while($res=mysqli_fetch_assoc($result)){
                        ?>

                        <div class="show_payments_div">
                            <form id="submit_payment_<?php echo $res['ID'] ?>" method="post"></form>
                            <input type="hidden" value="<?php echo $res['ID'] ?>" name="payment_id_to_submit" form="submit_payment_<?php echo $res['ID'] ?>">
                            <span class="from"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['FROM_ID']."'"))['LOGIN'] ?></span>
                            <span class="payment_amount"><?php echo $res['AMOUNT'] ?> руб.</span>
                            <span class="payment_service"><?php if($res['PAYMENT_SERVICE']==1){ echo 'Яндекс деньги'; }elseif($res['PAYMENT_SERVICE']==2){ echo 'QIWI'; } ?>-<?php echo $res['WALLET'] ?></span>
                            <span class="payment_type"><?php if($res['PAYMENT_TYPE']==1){ echo 'оплата заказа'; }elseif($res['PAYMENT_TYPE']==2){ echo 'вывод'; }elseif($res['PAYMENT_TYPE']==3){ echo 'пополнение'; } ?></span>
                            <button type="submit" form="submit_payment_<?php echo $res['ID'] ?>" class="done_button">выплачено</button>
                        </div>
                    <hr>

                        <?php
                    }
                    ?>
					
				</div>
                
		<?php 	
	}else{
		?>
		<div class="not_admin_warning">Вы не авторизованы или не являетесь админом/модератором !<br><a class="to_login_link" href="../login.php?from=../admin/settings.php">Авторизоваться</a></div>
		<?php
	}

	?>
	<style type="text/css">
        .from{
            float: left;
            left: 10px;
            position: absolute;
        }
        .payment_amount{
            left: 20%;
            position: absolute;
            top: 10;
        }
        .payment_service{
            position: absolute;
            right: 40%;
        }
        .payment_type{
            position: absolute;
            right: 23%;
        }
        .done_button{
            position: absolute;
            right: 10px;
            bottom: -14px;
        }
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
			max-width: 900px;
			padding: 20px;
			top: 150px;
			background-color: white;
		}
		.show_payments_div{
			left: 0;
			width: 100%;
			background: white;
			border-radius: 4px;
			padding: 10px;
			position: relative;
			margin-bottom: 10px;
		}
		.admin_menu_item:hover{
			background-color: white;
			color: white;
		}
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../slick/slick.min.js"></script>
	<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/js.js"></script>

</body>
</html>