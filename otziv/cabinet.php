<?php
require "engine/db_connect.php";

$video_on_page_counter=0;
$logged_user=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"));
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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="animate.css-master/animate.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Кабинет</title>
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
				<div class="col-md-5"></div>
				<div class="col-md-4">
					<ul class="header__menu d-flex justify-content-between">
						<li class="menu__item">
							<a id="performers_adder" style="position: relative;" href="<?php if(isset($_SESSION['logged_user'])){ echo '../order_confirm.php'; }else{ echo '#'; } ?>" class="menu__link"><img id="contacts_counter" src="img/add-contact.png" alt="Contact" class="user__red"><span style="visibility: <?php if(count($_SESSION['choosen_performers'])!=0){ echo 'visible'; }else{ echo 'hidden'; } ?>; position: absolute; left: 19px; top: 15px; color: white; text-decoration: none;" id="counter" class="kol__message"><?php echo count($_SESSION['choosen_performers']) ?></span></a>
								<div id="performers_adder_desc" style="position: fixed; background-color: grey; background-color: rgba(127,127,127, 0.6); opacity: 0.95; padding: 10px; border-radius: 2px; color: white; display: none; text-align: center;">
								<?php
								if(!isset($_SESSION['logged_user'])){
									echo 'Для того чтобы оформить ваш заказ<br>вы должны <a style="text-decoration: none; color: green;" href="../login.php?from=index.php">авторизоваться</a>';
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
						<li class="menu__item">	
							<a href="#" class="menu__link menu__link_active">
								<div class="menu__line"></div>
								<div class="menu__line"></div>
								<div class="menu__line menu__line_down"></div>
							</a>
						</li>
					</ul>
				</div>
				<div class="menu__mobile">
					<ul class="menu__list" id="menu">
						<li class="menu__item_m">
							<a href="#ex6" class="menu__link_m menu__link_m_f">Быстрый заказ</a>
						</li>
						<div class="line__red"></div>
						<li class="menu__item_m">
							<a href="cabinet.php" class="menu__link_m" id="to_cabinet"><img src="img/user1.png" alt="User" class="user__red" id="cabinet"> <span id="cabinet" class="link__red">Мои заказы</span></a>
						</li>
					</ul>
					<img src="img/error.png" alt="cancel" class="img__cancel">
				</div>
			</div>
		</div>
	</header>

	<?php
	if(isset($_SESSION['logged_user'])&&$logged_user=$_SESSION['logged_user']){
	?>
	<main class="main">
		<div class="container">
			<div class="row">
				<div class="col-md-2">
					<form enctype="multipart/form-data" id="renew_avatar_frm" method="post" action="engine/avatar_upload.php"></form>
					<img src="<?php
					if(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['exAVATAR']==""){
						if(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['HAS_AVATAR']==1){
							echo '../img/'.$_SESSION['logged_user']['ID'].'_avatar'.mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['AVATAR_TYPE'];
						}else{
							echo '../img/noavatar.png';
						}
					}else{
						echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['exAVATAR'];
					}
					?>" alt="man" class="user__icon" id="logged_user_avatar">
					<div id="renew_avatar_div" style="position: relative; top: -90px; font-size: small; opacity: 0.9; width: 103.5%; background-color: rgba(101,101,101, 0.8); padding-bottom: 20px; visibility: hidden; padding-top: 10px; padding-left: 5px; margin: 0;">
						<input form="renew_avatar_frm" id="avatar_input" type="file" name="file" style="width: 100%; white-space: pre-wrap;">
						<button style="display: none;" id="renew_avatar_btn" form="renew_avatar_frm"></button>
					</div>
					<div style="position: relative; top: -65px;">
						<h2 class="user__name"><?php echo $logged_user['LOGIN'] ?></h2>
						<div class="user__line"></div>
						<p class="user__mail" style="word-wrap: break-word;"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['EMAIL'] ?></p>
						<div class="user__line"></div>
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
                        <a href="../payment_page_cashin.php" style="text-decoration: none;"><button style="background: #2091ad; color: white; margin:2px; border: none; border-radius: 3px; width: 115px;" id="cashin_button">пополнить</button></a>
                        <a href="../payment/cashout.php" style="text-decoration: none;"><button style="background: #9e4438; color: white; margin:2px; border: none; border-radius: 3px; width: 115px;" id="cashout_button">вывести</button></a>
					</div>
				</div>
				<div class="col-md-7 cabinet__center">
					<div class="lenta">
						<a onclick="document.title='Мои заказы'" href="#12" class="show_client_ready_orders lenta__orders lenta__link" id="my_orders"><img src="img/team.png" alt="team" class="orders__img lenta__img"><?php
						if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE CLIENT_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='2'"))>0){
							?><span id="orders_to_accept_counter" class="kol__message" style="position: absolute; top: 2.2%; left: 16.75%;"><?php
							echo mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE CLIENT_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='2'"));
							?></span>
						<?php }
						?>
						мои заказы</a>
						<div class="lenta__line"></div>
						<a onclick="document.title='Я-исполнитель'" href="#9" class="show_orders_for_me lenta__executor lenta__link" id="i_am_performer"><img src="img/user2.png" alt="user" class="executor__img lenta__img"><?php
						if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='1'"))>0){
							?><span class="kol__message" style="position: absolute; top: 2.2%; left: 44.5%;"><?php
							echo mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='1'"));
							?></span><?php 
						}
						?>я - исполнитель</a>
						<div class="lenta__line"></div>
						<a onclick="document.title='Сообщения'" id="my_messages" href="#7" class="show_mesages lenta__massage lenta__link"><img src="img/message.png" alt="message" class="message__img lenta__img"><?php
						if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `MAILS` WHERE TO_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='2' AND TYPE='2'"))>0){
							?><span id="messages_counter" class="kol__message" style="position: absolute; top: 2.2%; left: 71.5%;"><?php
							echo mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `MAILS` WHERE TO_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='2' AND TYPE='2'"));
							?></span><?php 
						}
						?>сообщения</a>
					</div>

					<div class="select__executor">
						<h2 class="select__executor_title">
							Выбранные исполнители
						</h2>
						<?php

						//Если нажата кнопка удаления работающего исполнителя то удаляем его
						if(isset($_POST['to_delete_order_id'])){
							mysqli_query($connection, "DELETE FROM `ORDERS` WHERE ID='".$_POST['to_delete_order_id']."'");
						}

						//Выводим активные заказы этого заказчика
						$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE CLIENT_ID='".$logged_user['ID']."' AND STATUS='1'");
						while($res=mysqli_fetch_assoc($result)){
						  ?>
						  	<form style="display: none;" id="working_performers_getter_frm_<?php echo $res['ID'] ?>" method="POST">
						  		<input form="working_performers_getter_frm_<?php echo $res['ID'] ?>" type="hidden" name="to_delete_order_id" value="<?php echo $res['ID'] ?>">
						  	</form>
						  	<div style="position: relative; width: auto; max-width: 200px;" class="select__block">
								<span class="select__block_text"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'] ?></span>
								<button form="working_performers_getter_frm_<?php echo $res['ID'] ?>" style="visibility: hidden;"><img style="right: 4px; position: absolute; top: 4px; bottom: 4px; visibility: visible;" src="img/rounded-delete-button-with-minus.png" alt="cancel" class="select__cancel"></button>
							</div><?php
						}
						

						?>
						

						<div class="select__line"></div>
						<a href="ispolniteli.php" class="select__more_executor">больше исполнителей</a>
						<a href="#ex6" class="select__but_tarif">купить тариф</a>
					</div>
					<?php

					$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE CLIENT_ID='".$logged_user['ID']."' AND STATUS='3'");
					while($res=mysqli_fetch_assoc($result)){
						?>

						<div class="tarif__plan">
							<h2 class="tarif__plan_title">
								<?php if($res['TARIF_ID']!=0){ echo 'Тарифный план - '; }else{ echo 'Без тарифного плана '; } ?><a href="#" class="tarif__plan_title_btn"><?php if($res['TARIF_ID']!=0){ echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `TARIFS` WHERE ID='".$res['TARIF_ID']."'"))['NAME']; } ?></a>
							</h2>
							<p style="right: 30px; position: absolute;" class="tarif__plan_paid">
								Оплачен <?php echo $res['CREATE_DATE'] ?>
							</p>
							<p class="tarif__plan_selecter_exe">
								Исполнитель: <span class="selected__name">
									<?php

									$check_first_performer=true;
										if($check_first_performer){
											echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'];
										}else{
											echo ", ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'];
										}
										$check_first_performer=false;

									?>
								</span>
							</p>
							<div class="select__line select__line1"></div>
							<p class="tarif__plan_done">
								Выполнено <?php echo $res['DONE_DATE'] ?>
							</p>
							<?php $get_perf_login=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN']; ?>
							<a style="right: 30px; position: absolute;" href="https://www.ssyoutube.com/watch?v=<?php echo $res['ORDER_VIDEO_URL'] ?>" download="<?php echo $res['NAME']."_".$get_perf_login.$res['ORDER_VIDEO_TYPE'] ?>" class="tarif__plan_download"><span class="tarif__plan_download_span">Скачать</span><img src="img/download.png" alt="download" class="tarif__plan_img_dow"></a>
						</div>
						
						<?php
					}

					?>
					
					<div class="view__more">
						<div class="view__more_line"></div>
						<a href="#" class="view__more_btn">
							<p class="view__more_text">смотреть ещё</p>
							<img src="img/down-arrow.png" alt="down" class="view__more_down">
						</a>
					</div>
				</div>
				<div class="col-md-3">
					<a href="#ex6" class="order__btn">заказать отзыв </a>
					<a href="#2" class="become__btn">стать исполнителем </a>
					<div class="order__line"></div>
					<div class="account__management">
						<img src="img/controls.png" alt="" class="account__management_img">
						<h2 class="account__management_title">
							Управление аккаунтом
						</h2>
						<form id="renew_account_data" method="get" action="../engine/renew_account_data.php">
							<label for="renew_email">E-mail</label>
							<input required id="renew_email" form="renew_account_data" required class="contractor__desc_date_i" type="text" name="email" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['EMAIL'] ?>">
							<label for="renew_promo_url">Youtube-ID промо ролика</label>
							<input required id="renew_promo_url" form="renew_account_data" required class="contractor__desc_date_i" type="text" name="promo_url" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['PROMO_URL'] ?>">
							<label for="renew_birth_date">Дата рождения</label>
							<input id="renew_birth_date" type="date" name="birth_date" form="renew_account_data" class="contractor__desc_date_i" value="<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'")) ?>">
							<button class="contractor__btn" style="width: 100%; position: relative;" form="renew_account_data" type="submit">сохранить</button>
						</form>
					</div>
                    <?php
                    $show_promo = false;
                    if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."' AND (STATUS='2' OR STATUS='4')"))>0){
                        $show_promo = true;
                    }    
                    ?>
					<div class="my__promo" <?php if($show_promo){ echo 'style="display: block;"'; }else{ echo 'style="display: none;"'; } ?>>
						<h2 class="my__promo_title">
							Моё промо
						</h2>
						<iframe id="video_<?php echo ++$video_on_page_counter ?>" width="235" height="150" class="my__promo_movie" frameborder="0" allow="encrypted-media" allowfullscreen src="https://www.youtube.com/embed/<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['PROMO_URL'] ?>?rel=0&amp;controls=0">
						</iframe>
					</div>
					<div class="message__block">
						<form action="../engine/send_external_message.php" method="POST" id="send_message_to_manager">
							<input form="send_message_to_manager" type="hidden" name="message_type" value="to_manager">
							<textarea form="send_message_to_manager" class="message__block_text" placeholder="Написать менеджеру" name="to_manager_text"></textarea>
							<button form="send_message_to_manager" class="message__block_btn"><img src="img/send.png" alt="send" class="message__block_img"></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>

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
					<br>
                    <?php if($result['PHONE']!=""){ ?>
					<img src="img/phone-call.png" alt="phone" class="footer__img_call">
					<a style="text-decoration: none; color: white;" href="call:<?php echo str_replace(" ", "", $result['PHONE']) ?>"><p class="footer__phone"><?php echo $result['PHONE'] ?></p></a>
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
				Выбрать стандартный тариф...
		</p>
			<select id="tarif_select" class="contractor__desc_category_pol order__video_select" name="tarif_id" form="create_order_frm">
				<?php
				$tarif_query=mysqli_query($connection, "SELECT * FROM `TARIFS");
				if(mysqli_num_rows($tarif_query)>0){
					?><option value="0" selected>Без тарифа</option><?php
					while($current_tarif=mysqli_fetch_assoc($tarif_query)){
						?><option value="<?php echo $current_tarif['ID'] ?>"><?php echo $current_tarif['NAME'] ?> - <?php echo $current_tarif['PRICE'] ?> р.</option><?php
					}
				}else{
					?><option id="no_tarif_option" value="0" selected>Без тарифа</option><?php
				}
				?>
				
				
			</select>
		</div>
		<div class="order__video_block">
			<p class="contractor__desc_category">
				либо укажите необходимое количество отзывов:
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
<?php }else{echo '<div class="warning-not-logged-in">Вы не авторизованы! <a href="../login.php?from=../cabinet.php">Войти</a></div>'; }?>

<div class="hidden">
<div id="7" style="padding-top:20%;">
<?php
$result=mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `MAILS` WHERE TO_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='2' AND TYPE='2'");
if(mysqli_num_rows($result)!=0){
	while ($res=mysqli_fetch_assoc($result)){ ?>
	
	<div class="mail_box">
		<h5 class="from_whom">От <?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['FROM_ID']."'"))['LOGIN'] ?><span class="mail_date"><?php echo $res['DATE'] ?></span></h5><img class="mail_exit_btn" style="position:absolute; right:10px; top:10px;" src="img/exit.png">
		<hr>
		<form id="answer_message" method="post" action="../engine/send_message.php"></form>
		<p class="mail_text"><?php echo $res['MESSAGE_TEXT'] ?></p>
        <input class="message_id" form="answer_message" type="hidden" name="message_id" value="<?php echo $res['ID'] ?>">
		<input form="answer_message" type="hidden" name="from" value="../cabinet.php">
		<input form="answer_message" type="hidden" name="to_id" value="<?php echo $res['FROM_ID'] ?>" class="message_from_id">
		<textarea form="answer_message" style="width: 98.3%; margin: 5px;" name="message_body" class="message_body_to_send"></textarea>
		<button class="send_answer_btn contractor__btn" style="width: 15%; height: 3%; right: -41.5%; position: relative; bottom: 0; color: white">ответить</button>
	</div><br>

<?php }
}else{
	echo '<div class="warning-not-logged-in" style="position: relative; top: 17%; margin: auto;">У вас нет сообщений!</div>';
}

?>
</div>
</div>

<div class="hidden">
	<div id="9" class="show_performers_orders">
		<?php
		$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='1'");
		if(mysqli_num_rows($result)!=0){
			while($res=mysqli_fetch_assoc($result)){
				?>
				<div style="height: 280px; margin: 10px auto 10px auto;" class="mail_box">
					<h5 class="from_whom">Заказчик-<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['CLIENT_ID']."'"))['LOGIN'] ?><span class="mail_date"><?php echo $res['CREATE_DATE'] ?></span></h5>
					<hr>
					<div style="position: relative;">
						<div style="position: absolute; left: 0; max-width: 65%; word-wrap: break-word;">
								<?php echo $res['DESCRIPTION'] ?><br><hr>
								Вставьте youtube ссылку готового ролика, как показано ниже.<br>
								<span style="font-style: italic;">https://www.youtube.com/watch?v=qeU4D1SaFQA</span>
						</div>
					<div class="upload_sector">
						<form id="upload_order_video" class="upload_order_video" method="post" action="engine/upload_order_video.php">
							<input form="upload_order_video"  type="hidden" name="order_id" value="<?php echo $res['ID'] ?>">
							<p style="width: 25%; height: 5%; right: -29.5%; position: relative; bottom: 0;" class="contractor__desc_category contractor__desc_date">
								youtube ссылка готового ролика
							</p>
							<input style="width: 25%; height: 5%; right: 11.5%; position: relative; bottom: 0;"  form="upload_order_video" type="text" name="order_video_url" id="order_video_url" class="contractor__desc_date_i">
						</form>
					</div>
					<button class="contractor__btn" style="width: 15%; height: 5%; right: -41.5%; position: relative; bottom: 0;" form="upload_order_video">отправить</button>
				</div>
				</div>
				<?php
			}
		}else{
			echo '<div class="warning-not-logged-in" style="position: relative; top: 17%; margin: auto;">Для вас пока нет заказов!</div>';
		}
		
		?>
	</div>
</div>

<div class="hidden">
	<div id="12" class="show_client_ready_orders">
		<?php
		$result=mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `ORDERS` WHERE CLIENT_ID='".$_SESSION['logged_user']['ID']."' AND STATUS='2'");
		if(mysqli_num_rows($result)!=0){
			$_SESSION['client_ready_orders']=array();
			while ($res=mysqli_fetch_assoc($result)) {
				$_SESSION['client_ready_orders'][]=$res['ID'];
				?>
				<div class="client_ready_order_div">
					<h5 class="performer_name">Исполнитель - <a href="user.php?ID=<?php echo $res['PERFORMER_ID'] ?>"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$res['PERFORMER_ID']."'"))['LOGIN'] ?></a><span class="order_done_date"><?php echo $res['DONE_DATE'] ?></span></h5>
					<iframe class="ready_order_video" width="270" height="270" frameborder="0" allow="encrypted-media" allowfullscreen controls src="https://www.youtube.com/embed/<?php echo $res['ORDER_VIDEO_URL'] ?>?rel=0&amp;controls=0">
					</iframe>
					<p style="position: absolute; right: 2%; width: 65%; bottom: 20%; top: 15%;">
						<?php echo $res['DESCRIPTION'] ?>
					</p>
					<a class="accept_order_btn contractor__btn" style="width: 15%; height: 5%; right: 2%; position: absolute; bottom: 5%;">подтвердить</a>
					<a class="reject_order_btn contractor__btn" style="width: 15%; height: 5%; right: 19%; position: absolute; bottom: 5%; background: red; color: white;">переделать</a>
				</div>
				<?php
			}
		}else{
			echo '<div class="warning-not-logged-in" style="position: relative; top: 17%; margin: auto;">Для вас пока нет готовых заказов!</div>';
		}
		
		?>
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

	<!-- Присваиваю JS переменным значения PHP переменных -->
	<script type="text/javascript">
		var tarif_quantities = [];
		var logged_in = false;
		var logged_user_id = <?php echo $_SESSION['logged_user']['ID'] ?>;
		var videoPlayer = [];
		var meme = [];
		var client_ready_orders = [];
        
        

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
	</script>

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

    <script type="text/javascript">
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
    </script>
    
</body>
</html>