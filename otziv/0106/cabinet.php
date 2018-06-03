<?php
require "engine/db_connect.php";
mysqli_set_charset($connection, 'utf8');

//действия над заказами
if(isset($_GET['to_reject_order'])){
	mysqli_query($connection, "UPDATE `ORDERS` SET STATUS='1' WHERE ID='".$_GET['order_id']."'");
	mysqli_query($connection, "INSERT INTO `MAILS` (TYPE, STATUS, MESSAGE_TEXT, FROM_ID, TO_ID) VALUES ('1', '2', 'Ваша работа отправлена на доработку заказчиком ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".$_SESSION['logged_user']['ID']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE ID='".$_GET['order_id']."'"))['PERFORMER_ID']."')");
	mysqli_query($connection, "UPDATE `USERS` SET DENIED_ORDERS=('".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['order_id_to_reject']."'"))['DENIED_ORDERS']."'+1)");
}elseif(isset($_GET['to_accept_order'])){
	mysqli_query($connection, "UPDATE `ORDERS` SET STATUS='3' WHERE ID='".$_GET['order_id']."'");
	mysqli_query($connection, "INSERT INTO `MAILS` (TYPE, STATUS, MESSAGE_TEXT, FROM_ID, TO_ID) VALUES ('1', '2', 'Ваша работа принята заказчиком ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".$_SESSION['logged_user']['ID']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE ID='".$_GET['order_id']."'"))['PERFORMER_ID']."')");
	mysqli_query($connection, "UPDATE `USERS` SET GRANTED_ORDERS=('".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['order_id']."'"))['GRANTED_ORDERS']."'+1), BALANCE='".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['order_id']."'"))['BALANCE']+mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE ID='".$_GET['order_id']."'"))['PRICE']."'");
}

//SEARCHING FORMS DATA
if(isset($_POST['to_save_account_changes'])){
	mysqli_query($connection, "UPDATE `USERS` SET EMAIL='".$_POST['email']."', SEX='".$_POST['gender']."', BIRTH_DATE='".$_POST['birth_date']."' WHERE ID='".$_SESSION['logged_user']['ID']."', YAMONEY_WALLET='".$_POST['yamoney_wallet']."'");
}

$video_on_page_counter=0;
$logged_user=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"));
function calculateAge($birth_date){
	$birth_date_from_db=$birth_date;
	$age="SELECT * FROM `USERS` WHERE ID='".$ID."'";
	
	if($birth_date_from_db!=""&&$birth_date_from_db!=NULL){
		$time_from_db=strtotime($birth_date_from_db);
		$current_month_of_year_count=date('n');
		$birthday_month_of_year_count=date('n', $time_from_db);

		if($current_month_of_year_count<$birthday_month_of_year_count){
			$must_implement_age=false;
		}elseif($current_month_of_year_count<$birthday_month_of_year_count){
			$must_implement_age=true;
		}else{
			$current_day_of_month=date('j');
			$birthday_day_of_month=date('j', $time_from_db);

			if($current_day_of_month<$birthday_day_of_month){
				$must_implement_age=false;
			}else{
				$must_implement_age=true;
			}
		}

		$age=date('Y')-date('Y', $time_from_db);

		if(!$must_implement_age){
			$age--;
		}

		return $age;
	}else{
		return "";
	}
}
function getAvatarLink($ID){
			if(mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `USERS` WHERE ID='".$ID."'"))['exAVATAR']==""){
						if(mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `USERS` WHERE ID='".$ID."'"))['HAS_AVATAR']==1){
						  $link='../img/'.$ID.'_avatar'.mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `USERS` WHERE ID='".$ID."'"))['AVATAR_TYPE'];
						}else{
						  $link='../img/noavatar.png';
						}
					}else{
					   $link=mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `USERS` WHERE ID='".$ID."'"))['exAVATAR'];
					}
			return $link;
		}

if(isset($_GET['succes_performer'])){
		if($_GET['succes_performer']==1){
			mysqli_query($connection, "INSERT INTO `MAILS` (TO_ID, MESSAGE_TEXT, TYPE, STATUS, DATE) VALUES ('".$_SESSION['logged_user']['ID']."', 'Поздравляем, вы теперь исполнитель!', '1', '2', '".date('Y-m-d H:i:s')."')");
		}else{
			mysqli_query($connection, "INSERT INTO `MAILS` (TO_ID, MESSAGE_TEXT, TYPE, STATUS, DATE) VALUES ('".$_SESSION['logged_user']['ID']."', 'Ошибка регистрации исполнителя!', '1', '2', '".date('Y-m-d H:i:s')."')");
		}
	}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/jcarousel.responsive.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Заказать качественные видео-отзывы для Вашего бизнеса.</title>
</head>

<body>

    <header class="header" id="ex1">
		<div class="container">
			<nav class="header__nav">
				<a style="text-decoration: none;" href="../">
					<img src="img/logo.png" alt="Otziv video" class="logo animated rubberBand">
				</a>
				<ul class="header__menu d-flex">
					<li class="menu__item">
						<div id="contacts_helper" style="position: fixed; background-color: rgba(127, 127, 127, 0.6); opacity: 0.95; padding: 10px; border-radius: 50%; color: white; text-align: center; visibility: hidden; right: 38%;">Нажмите чтобы оформить заказ <img src="img/point_right.png" height="25px"></div>
						<a id="performers_adder" style="position: relative;" href="<?php if(isset($_SESSION['logged_user'])){ echo '../order_confirm.php'; }else{ echo '#'; } ?>" class="menu__link"><img id="contacts_counter" src="img/add-contact.png" alt="Contact" class="user__red"><span style="visibility: <?php if(count($_SESSION['choosen_performers'])!=0){ echo 'visible'; }else{ echo 'hidden'; } ?>; position: absolute; left: 19px; top: 15px; color: white; text-decoration: none;" id="counter" class="kol__message"><?php echo count($_SESSION['choosen_performers']) ?></span></a>
							<div id="performers_adder_desc" style="position: fixed; background-color: grey; background-color: rgba(127,127,127, 0.6); opacity: 0.95; padding: 10px; border-radius: 2px; color: white; display: none; text-align: center;">
							<?php
							if(!isset($_SESSION['logged_user'])){
								echo 'Для того чтобы оформить ваш заказ<br>вы должны <a style="text-decoration: none; color: green;" href="../login.php?from=index.php">авторизоваться</a>';
							}elseif(count($_SESSION['choosen_performers'])<=0){
								echo 'Для того чтобы оформить заказ<br>вы должны <a style="text-decoration: none; color: green;" href="../login.php?from=index.php">выбрать исполнителей</a>';
							}else{
								$is_first=true;
								$desc_string="";
								foreach ($_SESSION['choosen_performers'] as $value) {
									$res=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$value."'"))['LOGIN'];
									if($is_first){
										$desc_string=$desc_string.'Выбранные исполнители: '.$res;
										$is_first=false;
									}else{
										$desc_string=$desc_string.', '.$res;
									}
								}
								echo $desc_string;
							}
							?>
							</div>
					</li>
					<li class="menu__item">
						<a href="#" class="menu__link" id="notifications_button" style="position: relative;"><img src="img/info.png" alt="Info" class="user__red">
							<?php
							$result = mysqli_query($connection, "SELECT * FROM `MAILS` WHERE STATUS='2' AND TYPE='1' AND TO_ID='".$_SESSION['logged_user']['ID']."'");
							if(mysqli_num_rows($result)!=0){
								?>
								<span style="visibility: <?php if(mysqli_num_rows($result)!=0){ echo 'visible'; }else{ echo 'hidden'; } ?>; position: absolute; left: 18px; top: 15px; color: white; text-decoration: none;" id="notification-counter" class="kol__message"><?php echo mysqli_num_rows($result) ?></span>
								<?php
							}
							?>
						</a>
						<?php if(mysqli_num_rows($result)!=0){ ?>
							<div id="show_notifications" style="position: fixed; background-color: grey; background-color: rgba(127,127,127, 0.6); opacity: 0.95; padding: 10px; border-radius: 2px; color: white; display: none; text-align: center; max-width: 450px; text-align: left;">
								<?php
								while ($res=mysqli_fetch_assoc($result)) {
									?>
									<div class="notification_block" style="padding: 6px; background: white; border-radius: 4px; margin: 5px; color: black; position: relative;">
										<div class="notification_id" style="display:none"><?php echo $res['ID'] ?></div>
										<div style="word-wrap: break-word; left: 0; top: 0;"><?php echo $res['MESSAGE_TEXT'] ?></div><div style="font-size: smaller; right: 0; top: 0; margin-left: 7px; color: #1a7c18;"><?php echo $res['DATE'] ?></div>
									</div>
									<?php
								}
								?>
							</div>
						<?php }else{
							?>
							<div id="show_notifications" style="position: fixed; background-color: grey; background-color: rgba(127,127,127, 0.6); opacity: 0.95; padding: 10px; border-radius: 2px; color: white; display: none; text-align: center; max-width: 450px; text-align: left;">
								У вас пока нет уведомлений
							</div>
							<?php
						} ?>
					</li>
					<li class="menu__item">
						<?php if(isset($_SESSION['logged_user'])){ ?>
							<a id="exit_button" href="cabinet.php" class="menu__link"><img height="32px" width="32px;" style="border-radius: 50%;" src="<?php if(isset($_SESSION['logged_user'])){ echo getAvatarLink($_SESSION['logged_user']['ID']); } ?>" alt="Info" class="user__red"></a>
							<div id="exit_div" style="position: fixed; background-color: grey; background-color: rgba(127,127,127, 0.6); opacity: 0.95; padding: 10px; border-radius: 2px; color: white; display: none; text-align: center; max-width: 250px;">
								<a style="text-decoration: none; color: white;" href="../login.php">Выйти</a>
							</div>
						<?php }else{ ?>
							<a href="../login.php" class="menu__link" ><img src="img/web-log-in.png" alt="Exit" class="user__red"></a>
						<?php } ?>	
					</li>
				</ul>
					<div class="menu__switch">
						<a class="menu__switch-active" href="#">Главная</a>
						<a href="#">Каталог</a>
					</div>

				<!-- <div class="menu__mobile">
					<ul class="menu__list" id="menu">
						<li class="menu__item_m">
							<a href="#ex1" class="menu__link_m">Видео-отзывы</a>
						</li>
						<li class="menu__item_m">
							<a href="#ex3" class="menu__link_m">Видео-отзывы</a>
						</li>
						<li class="menu__item_m">
							<a href="#ex4" class="menu__link_m">Почему мы?</a>
						</li>
						<li class="menu__item_m">
							<a href="#ex6" class="menu__link_m menu__link_m_f">Быстрый заказ</a>
						</li>
						<div class="line__red"></div>
						<li class="menu__item_m">
							<a href="cabinet.php" class="menu__link_m" id="to_cabinet"><img src="img/user1.png" alt="User" class="user__red" id="cabinet"> <span id="cabinet" class="link__red">Мои заказы</span></a>
						</li>
					</ul>
					<img src="img/error.png" alt="cancel" class="img__cancel">
				</div> -->
			</nav>
		</div>
	</header>


	<div class="container cabinet">
		<div class="row">
			<aside class="col-lg-3 profile ">
				<div class="userpic">
					<form enctype="multipart/form-data" id="renew_avatar_frm" method="post" action="engine/avatar_upload.php"></form>
					<img id="logged_user_avatar" src="<?php echo getAvatarLink($logged_user['ID']) ?>" alt="userpic">
					<div id="renew_avatar_div" style="position: relative; top: -90px; font-size: small; opacity: 0.9; width: 103.5%; background-color: rgba(101,101,101, 0.8); padding-bottom: 20px; visibility: hidden; padding-top: 10px; padding-left: 5px; margin: 0;">
						<input form="renew_avatar_frm" id="avatar_input" type="file" name="file" style="width: 100%; white-space: pre-wrap;">
						<button style="display: none;" id="renew_avatar_btn" form="renew_avatar_frm"></button>
					</div>
				</div>
				<div class="username">
					<?php echo $logged_user['LOGIN'] ?>
				</div>
				<hr>
				<p id="show_balance" class="user__phone" style="word-wrap: break-word;">Баланс: <?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['BALANCE'] ?> руб.</p>
                        <?php
                        $totally_frozen_sum=0;
                        $result=mysqli_query($connection, "SELECT * FROM `PAYMENTS` WHERE (FROM_ID='".$_SESSION['logged_user']['ID']."' OR TO_ID='".$_SESSION['logged_user']['ID']."') AND STATUS='1' AND PAYMENT_TYPE='2'");
                        if(mysqli_num_rows($result)!=0){
                            while($res=mysqli_fetch_assoc($result)){
                               $totally_frozen_sum+=$res['AMOUNT']; 
                            }
                            ?>
                            <div style="color: #f79f9f; font-size:small;">
                                <?php echo $totally_frozen_sum ?> руб. будут выведены после проверки модератором.
                            </div><br>
                            <?php
                        }
                        ?>
                        <a href="../payment/yandex/form/YandexMoneyCashin.php" style="text-decoration: none;"><button style="background: #2091ad; color: white; margin:2px; border: none; border-radius: 3px; width: 115px;" id="cashin_button">пополнить</button></a>
                        <a href="../payment/cashout.php" style="text-decoration: none;"><button style="background: #9e4438; color: white; margin:2px; border: none; border-radius: 3px; width: 115px;" id="cashout_button">вывести</button></a>
				<div class="privatinfo">
					<hr> личная информация
				</div>
				<div class="accaunt__settings">
					<img src="img/controls.png" alt="accaunt__settings">
					<h5>Управление аккаунтом</h5>
					<form class="settings__form" method="post">
						<input name="email" type="email" placeholder="Email" <?php if(isset($logged_user['EMAIL'])){ echo 'value="'.$logged_user['EMAIL'].'"'; } ?>>
						<select name="gender" <?php if(isset($logged_user['SEX'])&&$logged_user['SEX']==1){ echo 'value="1"'; } ?>>
							<option value="1">Мужской</option>
							<option value="2">Женский</option>
						</select>
						<input name="birth_date" type="date" placeholder="День рождения" value="<?php echo $logged_user['BIRTH_DATE'] ?>">
						<input name="yamoney_wallet" type="text" placeholder="яндекс кошелёк" <?php if(isset($logged_user['YAMONEY_WALLET'])){ echo 'value="'.$logged_user['YAMONEY_WALLET'].'"'; } ?>>
                        <input type="submit" name="to_save_account_changes" class="settings__btn-submit">
					</form>
                    <img class="settings__btn" src="img/down.png" alt="down">
				</div>
				<?php
				if($logged_user['PROMO_URL']!=""&&($logged_user['STATUS']==2||$logged_user['STATUS']==4)){
					?>
					<div class="myPortfolio forPerformer">
						<div class="myPortfolio__title">Мое промо</div>
						<iframe width="260px" src="<?php echo 'https://www.youtube.com/embed/'.$logged_user['PROMO_URL'] ?>" poster="img/video-poster2.png"></iframe>
					</div>
					<?php
				}
				?>
			</aside>
			<main class="col-lg-7">
				<div class="status__form">
					<div class="status">
						<div class="status__customer activeStatus">
							<div class="customer__wrapper">
								<img src="img/customer_icon.png" alt="customer icon">
								<div class="status__title">Я - заказчик</div>
							</div>
						</div>
						<div class="status__performer">
							<div class="performer__wrapper">
								<img src="img/perfomer_icon.png" alt="performer icon">
								<div class="status__title">Я - исполнитель</div>
							</div>
						</div>
					</div>
					<div class="forCustomer selectedPerfomers">
						<h5>Выбранные исполнители</h5>
						<div class="performers">
						<?php
						//Если нажата кнопка удаления работающего исполнителя то удаляем его
						if(isset($_POST['to_delete_order'])){
							mysqli_query($connection, "DELETE FROM `ORDERS` WHERE ID='".$_POST['to_delete_order_id']."'");
							mysqli_query($connection, "INSERT INTO `PAYMENTS` (AMOUNT, TO_ID, WALLET, PAYMENT_SERVICE, PAYMENT_TYPE, STATUS) VALUES ('".$_POST['to_delete_order_price']."', '".$logged_user['ID']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `PAYMENTS` WHERE ORDER_ID='".$_POST['to_delete_order_id']."'"))['WALLET']."', '".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `PAYMENTS` WHERE ORDER_ID='".$_POST['to_delete_order_id']."'"))['PAYMENT_SERVICE']."', '2', '1')");
							mysqli_query($connection, "INSERT INTO `MAILS` (TO_ID, MESSAGE_TEXT, DATE, TYPE, STATUS) VALUES ('".$logged_user['ID']."', 'Вы отменили заказ средства будут возвращены!', '".date('Y-m-d G:i:s')."', '1', '1')");
						}

						//Выводим активные заказы этого заказчика
						$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE CLIENT_ID='".$logged_user['ID']."' AND STATUS='1'");
						while($res=mysqli_fetch_assoc($result)){
							?>
							<form style="display: none;" id="working_performers_getter_frm_<?php echo $res['ID'] ?>" method="POST">
								<input type="hidden" name="to_delete_order_price" form="working_performers_getter_frm_<?php echo $res['ID'] ?>" value="<?php echo $res['PRICE'] ?>">
								<input form="working_performers_getter_frm_<?php echo $res['ID'] ?>" type="hidden" name="to_delete_order_id" value="<?php echo $res['ID'] ?>">
							</form>
							<div class="performer">
								<a href="user.php?<?php echo $res['PERFORMER_ID'] ?>" class="performer__name"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'] ?></a>
								<button name="to_delete_order" form="working_performers_getter_frm_<?php echo $res['ID'] ?>" style="background: none; border: none;"><div class="performer-del">-</div></button>
							</div>
							<?php
						}
						?>	
						</div>
						<div class="selectedPerfomers__line"></div>
						<div class="selectedPerfomers__buttons">
							<button style="visibility: hidden;" class="morePerformers">оформить</button>
							<a style="text-decoration: none;" href="ispolniteli.php"><button class="buyTrifle">больше исполнителей</button></a>
						</div>
					</div>
					
						<?php
						$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE STATUS='3' AND CLIENT_ID='".$logged_user['ID']."'");
						while($res=mysqli_fetch_assoc($result)){
							?>
							<div class="forCustomer order order_type1">
								<div>
									<div class="order__title"><?php echo $res['NAME'] ?></div>
									<div class="order__description">
											<?php
											echo $res['DESCRIPTION']
											?>
									</div>
									<div class="order__performer">Выбранный исполнитель: <span class="order__performer-name"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'] ?></span></div>
									<div class="order__line"></div>
									<div class="order__status">Выполнено <?php echo $res['DONE_DATE'] ?></div>
									<div class="order__download">
										<a href="https://www.ssyoutube.com/watch?v=<?php echo $res['ORDER_VIDEO_URL'] ?>" download="img/download.png"><img src="img/download.png" alt="download"></a>
										<a href="https://www.ssyoutube.com/watch?v=<?php echo $res['ORDER_VIDEO_URL'] ?>" download="img/download.png">Скачать</a>
									</div>
								</div>
								<div>
									<div class="order__paymentStatus">Оплачен <?php echo substr($res['CREATE_DATE'], 0, 10) ?></div>
									<div class="order_video">
										<iframe width="269" height="197" src="<?php echo 'https://www.youtube.com/embed/'.$res['ORDER_VIDEO_URL'] ?>" poster="img/video-poster2.png"></iframe>
									</div>
								</div>
							</div>
							<?php
						}

						$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE STATUS='2' AND CLIENT_ID='".$logged_user['ID']."'");
						while($res=mysqli_fetch_assoc($result)){
							?>
							<form method="get">
								<div class="forCustomer order order_type2">
									<div>
										<input type="hidden" name="order_id" value="<?php echo $res['ID'] ?>">
										<div class="order__title"><?php echo $res['NAME'] ?></div>
										<div class="order__description">
												<?php
												echo $res['DESCRIPTION']
												?>
										</div>
										<div class="order__performer">Выбранный исполнитель: <span class="order__performer-name"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'] ?></span></div>
										<div class="order__line"></div>
										<div class="order__buttons">
											<button type="submit" name="to_reject_order" class="reject_order_btn order__cancel">отклонить </button>
											<button type="submit" name="to_accept_order" class="accept_order_btn order__accept">принять</button>
										</div>
									</div>
									<div>
										<div class="order__paymentStatus">Оплачен <?php echo substr($res['CREATE_DATE'], 0, 10) ?></div>
										<div class="order_video">
											<iframe width="269" height="197" src="<?php echo 'https://www.youtube.com/embed/'.$res['ORDER_VIDEO_URL'] ?>" poster="img/video-poster2.png"></iframe>
										</div>
									</div>
								</div>
							</form>
							<?php
						}
						?>
					<div class="forCustomer lookMore">
						<a href="#">смотреть ещё</a>
						<img src="img/down-arrow.png" alt="look more">
					</button>
				</div>
                    <div class="forPerformer instructions">
                        <a href="reclam.php">Просмотреть инструкции</a>
                        <a href="reclam.php">
                            <img src="img/movie-clapper-open.png" alt="movie">
                        </a>
                    </div>
                    <?php
                    $result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$logged_user['ID']."' AND STATUS='1'");
                    while($res=mysqli_fetch_assoc($result)){
                    	?>
                    	<div class="forPerformer project-type1 order_to_compleate_box">
	                        <div>
	                            <h5 class="project__title order_video_to_upload_name"><?php echo $res['NAME'] ?></h5>
	                            <hr class="project__line">
	                            <div class="projec__description">
	                                <p class="description__text order_video_to_upload_description">
	                                    <?php
	                                    echo $res['DESCRIPTION']
	                                    ?>
	                                </p>
	                                <img class="description__toggle" src="img/down.png" alt="down">
	                            </div>
	                            <div class="projec__bottom">
	                                
	                            </div>
	                        </div>
	                        <div class="project__download" >
	                        	<input class="upload_order_video_url" type="text" name="upload_order_video_url" placeholder="Ссылка на готовый ролик">
	                            <a class="upload_order_video_button" href="#">загрузить видео</a>
	                        </div>
	                    </div>
	                    <div class="upload_order_video_id" style="display: none;"><?php echo $res['ID'] ?></div>
                    	<?php
                    }

                    $result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$logged_user['ID']."' AND STATUS='2'");
                    while($res=mysqli_fetch_assoc($result)){
                    	?>
                    	<div class="forPerformer project-type2">
	                        <div>
	                            <div class="project__title"><?php echo $res['NAME'] ?></div>
	                            <hr class="project__line">
	                            <div class="projec__description">
	                                <p class="description__text">
	                                    <?php
	                                    echo $res['DESCRIPTION']
	                                    ?>
	                                </p>
	                               <img class="description__toggle" src="img/down.png" alt="down">
	                            </div>
	                            <div class="project__status">
	                                <img src="img/loading.png" alt="loading">
	                                в процессе утверждения
	                            </div>
	                        </div>
	                        <div>
	                        	<iframe width="256" src="<?php echo 'https://www.youtube.com/embed/'.$res['ORDER_VIDEO_URL'] ?>" poster="img/video-poster2.png"></iframe>
	                        </div>
	                    </div>
                    	<?php
                    }
                    ?>
				</div>
            </main>
			<aside class="col-lg-2 aside__buttons">
				<button class="orderComment" href="#ex6">заказать отзыв </button>
				<button class="bePerformer" href="#2">стать исполнителем  </button>
			</aside>

            <div class="col-lg-9 offset-lg-3 carousel ">
                <hr>
                <h5 class="carousel__title">мои видео:</h5>
                <div class="jcarousel">
                    <ul>
                    	<?php
                    	$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$logged_user['ID']."' AND STATUS='3'");
                    	while($res=mysqli_fetch_assoc($result)){
                    		?>
                    		<li>
                    			<iframe src="<?php echo 'https://www.youtube.com/embed/'.$res['ORDER_VIDEO_URL'] ?>" poster="img/video-poster2.png"></iframe>
	                            <div class="slide__info">
	                                <div class="order__name"><?php echo $res['NAME'] ?></div>
	                                <div class="order__date"><?php echo $res['DONE_DATE'] ?></div>
	                            </div>
	                        </li>
                    		<?php
                    	}
                    	?>
                    </ul>
                </div>

                <div class="carousel__btns">
                    <div class="carousel__btn jcarousel-control-prev" href="#carouselExampleControls"><img src="img/left-btn.png" alt="left"></div>
                    <div class="carousel__btn jcarousel-control-next " href="#carouselExampleControls" ><img src="img/right-btn.png" alt="right"></div>
                </div>
            </div>
        </div>
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
						<div id="uLogin" data-ulogin="display=panel;theme=flat;fields=first_name,last_name,photo_big,bdate;providers=vkontakte,facebook,twitter;hidden=;redirect_uri=http%3A%2F%2Fotziv.video%2Fengine%2Fauthorisation_success.php;mobilebuttons=0;"></div>
					</ul>
				</div>
			</div>
		</div>
	</footer>

	<div class="hidden"><?php

	if(isset($_SESSION['logged_user'])){
		if(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['STATUS']==1){?>
			<div class="contractor" id="2">
						<h2 class="contractor__title">
						стать исполнителем
						</h2>
						<p class="contractor__desc">
					Для того, чтобы  стать исполнителем, Вы должны заполнить данную форму.
						</p>
					<form id="become_performer" method="POST" action="../engine/promo_upload.php">
					<div class="contractor__left">
						<div class="contractor__block">
							<p class="contractor__desc_category">
								Пол:
							</p>
							<select form="become_performer" id="sex_selector" name="sex" class="contractor__desc_category_pol">
								 <option value="1">М</option>
								 <option value="2">Ж</option>
							</select>
						</div>
						<div class="contractor__block">
							<p class="contractor__desc_category contractor__desc_date">
								Дата рождения
							</p>
							<input id="birth_date" required type="date" name="date" value="25" class="contractor__desc_date_i" form="become_performer">
						</div>
					</div>
					<div class="contractor__block">
						<p class="contractor__desc_category contractor__desc_date">
							youtube ссылка вашего промо ролика
						</p>
						<input required type="text" name="youtube_url" class="contractor__desc_date_i" form="become_performer">
					</div>
					<button form="become_performer" class="contractor__btn">отправить</button>
				</form>
				<a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a>
			</div>
		<?php }else{
			?><div class="contractor" id="2"><h2 class="contractor__title"><?php echo $_SESSION['logged_user']['LOGIN'] ?>, вы уже являетесь исполнителем!</h2><a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a><div><?php
		}
	}else{ ?>
		<div class="contractor" id="2"><h2 class="contractor__title">Для того, чтобы стать исполнителем вы должны <a href="../signup.php" target="_blank">зарегистрироваться</a> или <a href="../login.php?from=../cabinet.php" target="_blank">войти</a></h2><a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a><div>
	<?php }
	?>

	<div class="hidden">
		<div style="height: auto;" class="order__video" id="ex6">
			<h2 class="order__video_title">
				Заказать видеоотзывы
			</h2>
			<form action="../order_confirm.php" method="POST" id="create_order_frm">
			<div class="order__video_block">
				<p class="contractor__desc_category">
					Укажите необходимое количество отзывов:
				</p>
				<div class="number">
	   			<span class="minus"><img src="img/up.png" alt="up" class="order__video_up"></span>
	    		<input id="set_orders_quantity_input" name="orders_quantity" type="text" class="order__video_number" value="1" form="create_order_frm" />
	    		<span class="plus"><img src="img/down.png" alt="down" class="order__video_down"></span>
				</div>
			</div>
			<?php
			if(!isset($_SESSION['logged_user'])){
			?>
			<p class="order__video_war">
				<img src="img/info2.png" alt="info" class="order__video_war_img">
				Внимание!
			</p>
			<p class="order__video_text">
				Для того, чтобы заказать видеоотзывы, 
				Вы должны <a href="../signup.php?from=../cabinet.php" class="order__video_text_link">зарегистрироваться</a> или <a href="../login.php?from=../cabinet.php" class="order__video_text_link">войти</a> 
				в личный кабинет!
			</p>
			<?php
			}
			if(isset($_SESSION['logged_user'])){
				?>
				<button form="create_order_frm" class="order__video_btn">Перейти к оформлению заказа</button>
				<?php
			}
			?>
			</form>
			<a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a>
		</div>
		
	</div>


	<style type="text/css">
	.warning-not-logged-in{
		background-color: white;
		padding: 20px;
		margin: auto;
		max-width: 250px;
		top: 150px;
		position: relative;
		box-shadow: 4px 5px 8px #494949;
		border-radius: 8px;
	}
	.warning-not-logged-in:hover{
		box-shadow: 8px 9px 15px #494949;
	}
	.mail_box{
		margin: auto;
		position: relative;
		max-width: 60%;
		height: auto;
		padding: 10px;
		background-color: white;
		border-radius: 6px;
	}
	.from_whom{
		left: 0;
		top: 0;
	}
	.mail_date{
		right: 40px;
		top: 10px;
		position: absolute;
	}
	.mail_text{
		top: 30px;
		left: 0;
		white-space: pre-wrap;
		width: 100%;
	}
	.contractor__file_label_1{
		position: relative;
		width: 70%;
		height: 50%;
		right: -700px;
	}
	.upload_sector{
		position: relative;
		top: 40%;
		left: 360px;
		text-align: center;
	}
	.order_text{
		width: 50%;
		top: 30px;
		left: 0;
		white-space: pre-wrap;
	}
	.show_performers_orders{
		position: relative;
		top: 200px;
	}
	.performer_name{
		left: 0;
		top: 0;
	}
	.order_done_date{
		right: 10px;
		top: 10px;
		position: absolute;
	}
	.ready_order_video{
		right: 0;
		position: relative;
	}
	.show_client_ready_orders{
		top: 200px;
	}
	.client_ready_order_div{
		margin: 20px auto;
		position: relative;
		max-width: 60%;
		height: auto;
		padding: 10px;
		background-color: white;
		border-radius: 6px;

	}
</style>
	
	<script src="//ulogin.ru/js/ulogin.js"></script>
    	<script
			  src="https://code.jquery.com/jquery-1.12.4.min.js"
			  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
			  crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
			  integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0="
			  crossorigin="anonymous"></script>
	<script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.jcarousel.min.js"></script>
    <script src="js/jcarousel.responsive.js"></script>
    <script src="js/js.js"></script>
    <script src="js/main1.js"></script>

    <script type="text/javascript">
    	setInterval(function(){
			var contacts_counter = $("#counter").text();
			if(contacts_counter!=""&&contacts_counter>0){
				$("#contacts_helper").css("visibility", "visible");
			}else{
				$("#contacts_helper").css("visibility", "hidden");
			}
			previous=contacts_counter;
		}, 500)

    	var current_performer_id = [];
    	var selected_performers_counter = 0;
    	$('#logged_user_avatar').mouseenter(function(){
		    $('#renew_avatar_div').css('visibility', 'visible');
		   })

		   $('#renew_avatar_div').mouseenter(function(){
		    $(this).css('visibility', 'visible');
		   })

		   $('#logged_user_avatar').mouseleave(function(){
		    $('#renew_avatar_div').css('visibility', 'hidden');
		   })

		   $('#renew_avatar_div').mouseleave(function(){
		    $(this).css('visibility', 'hidden');
		   })

		   $('#avatar_input').change(function(){
		      $('#renew_avatar_btn').click();
		   })

        $('.mail_exit_btn').on('click', function(){
            var mail_box_index = $('.mail_exit_btn').index(this);
            $('.mail_box').eq(mail_box_index).fadeOut('150');
            var message_id = $('.message_id').eq(mail_box_index).attr('value');
            $.ajax({
            type: 'get',
            url: '../engine/read_notification_and_message.php',
            data: {
              'notification_id':message_id,
            },
            contentType: false,
            cache: false,
          });
            $('#messages_counter').text($('#messages_counter').text()-1);
            if($('#messages_counter').text()==""||$('#messages_counter').text()==0){
                $('#messages_counter').css('visibility', 'hidden');
                $('body').append('<div class="warning-not-logged-in" style="position: relative; top: 17%; margin: auto;">У вас нет сообщений!</div>');
                setTimeout(function(){
                	window.location.href='../cabinet.php';
                }, 333);
            }
        })
        $('.orderComment').magnificPopup();
	   $('.bePerformer').magnificPopup();

		var tarif_quantities = [];
		var logged_in = false;
		var logged_user_id = <?php echo $_SESSION['logged_user']['ID'] ?>;
		var videoPlayer = [];
		var meme = [];
		var client_ready_orders = [];
        
		<?php
		foreach ($_SESSION['choosen_performers'] as $value) {
			?>
			current_performer_id.push('<?php echo $value ?>');
			selected_performers_counter++;
			<?php
		}
		?>        

		<?php
		foreach ($_SESSION['client_ready_orders'] as $value) {
			?>
			client_ready_orders.push(<?php echo $value ?>);
			<?php
		}
		?>

		<?php
		$result=mysqli_query($connection, "SELECT * FROM `TARIFS`");
		while($res=mysqli_fetch_assoc($result)){
			?>
			tarif_quantities.push('<?php echo $res['ORDERS_QUANTITY'] ?>');
			<?php
		}
		?>

		<?php
		if(isset($_SESSION['logged_user'])){
			?>
			logged_in = true;
			<?php
		}
		?>

		<?php for($i=0; $i<$video_on_page_counter; $i++) {
			?>
			videoPlayer.push(document.getElementById('video_<?php echo ($i+1) ?>'));

			// Play / pause.
		    videoPlayer['<?php echo $i ?>'].addEventListener('click', function () {
		        if (videoPlayer['<?php echo $i ?>'].paused == false) {
		            videoPlayer['<?php echo $i ?>'].pause();
		            videoPlayer['<?php echo $i ?>'].firstChild.nodeValue = 'Play';
		        } else {
		            videoPlayer['<?php echo $i ?>'].play();
		            videoPlayer['<?php echo $i ?>'].firstChild.nodeValue = 'Pause';
		        }
		    });
			<?php
		} ?>

		<?php foreach ($_SESSION['choosen_performers'] as $value) {
			?>
			meme.push('<?php echo $value ?>');
			<?php
		} ?>
		$(".notification_close_button").on('click', function(){
			var this_notification_box_index = $(".notification_close_button").index(this);
			var notification_id = $(".notification_close_button").siblings(".notification_id").eq(this_notification_box_index).text();
			$.ajax({
            type: 'get',
            url: 'engine/read_notification_and_message.php',
            data: {
              'notification_id':notification_id,
            },
            contentType: false,
            cache: false,
          });
			$(".notification_close_button").parent(".notification_block").eq(this_notification_box_index).remove();
			var notifications_counter = $("#notification-counter").text();
			notifications_counter--;
			if(notifications_counter==0){
				$("#notification-counter").css("visibility", "hidden");
				$("#show_notifications").text("У вас пока нет уведомлений");
			}else{
				$("#notification-counter").text(notifications_counter);
			}
		})
		$(".upload_order_video_button").on('click', function(){
			event.preventDefault();
			var this_upload_order_video_button_index = $(".upload_order_video_button").index(this);
			var order_id = $(".upload_order_video_id").eq(this_upload_order_video_button_index).text();
			var order_video_url = $(".upload_order_video_url").eq(this_upload_order_video_button_index).attr("value");
			var description = $(".order_video_to_upload_description").eq(this_upload_order_video_button_index).text();
			var name = $(".order_video_to_upload_name").eq(this_upload_order_video_button_index).text();
			var index_of_wacth = order_video_url.indexOf('watch?v=');
			var short_order_video_url = order_video_url.substr(index_of_wacth+8);

			if(order_video_url!=""){
				var div_string_to_append = '<div style="display: flex;" class="forPerformer project-type2"><div><div class="project__title">'+name+'</div><hr class="project__line"><div class="projec__description"><p class="description__text">'+description+'</p><img class="description__toggle" src="img/down.png" alt="down"></div><div class="project__status"><img src="img/loading.png" alt="loading"> в процессе утверждения</div></div><div><iframe width="256" src="https://www.youtube.com/embed/'+short_order_video_url+'" poster="img/video-poster2.png"></iframe></div></div>';
				$(".order_to_compleate_box").eq(this_upload_order_video_button_index).parent().append($(div_string_to_append));
				$.ajax({
			        type: 'get',
			        url: '../engine/upload_order_video.php',
			        data: {
			          'order_video_url':order_video_url,
			          'order_id':order_id
			        },
			        contentType: false,
			        cache: false,
			      });
				$(".order_to_compleate_box").eq(this_upload_order_video_button_index).remove();
				$(".upload_order_video_id").eq(this_upload_order_video_button_index).remove();
			}else{
				alert('Вставьте ссылку на ролик!');
			}
		})
    </script>

    <script type="text/javascript" src="//consultsystems.ru/script/36596/" async charset="utf-8"></script>
</body>