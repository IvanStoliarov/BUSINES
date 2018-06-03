<?php
require "engine/db_connect.php";

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

	$video_on_page_counter=0;
$logged_user=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"));
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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/jcarousel.responsive.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Заказать качественные видео-отзывы для Вашего бизнеса.</title>
</head>

<body>
<div class="reclam__wrapper">
    <header class="header" id="ex1">
		<div class="container">
			<nav class="header__nav">
				<a style="text-decoration: none;" href="../">
					<img src="img/logo.png" alt="Otziv video" class="logo rubberBand">
				</a>
				<ul class="header__menu d-flex">
					<li class="menu__item">
						<div id="contacts_helper" style="position: fixed; background-color: rgba(127, 127, 127, 0.6); opacity: 0.95; padding: 10px; border-radius: 50%; color: white; text-align: center; visibility: hidden; right: 920px;">Нажмите чтобы оформить заказ <img src="img/point_right.png" height="25px"></div>
							<a id="performers_adder" style="position: relative;" href="<?php if(isset($_SESSION['logged_user'])){ echo '../order_confirm.php'; }else{ echo '#'; } ?>" class="menu__link"><img id="contacts_counter" src="img/add-contact.png" alt="Contact" class="user__red"><span style="visibility: <?php if(count($_SESSION['choosen_performers'])!=0){ echo 'visible'; }else{ echo 'hidden'; } ?>; position: absolute; left: 19px; top: 15px; color: white; text-decoration: none;" id="counter" class="kol__message"><?php echo count($_SESSION['choosen_performers']) ?></span></a>
							<div id="performers_adder_desc" style="position: fixed; background-color: rgba(127, 127, 127, 0.6); opacity: 0.95; padding: 10px; border-radius: 2px; color: white; text-align: center">
							<?php
							if(!isset($_SESSION['logged_user'])){
									echo 'Для того чтобы оформить ваш заказ<br>вы должны <a style="text-decoration: none; color: green;" href="../login.php?from=index.php">авторизоваться</a>';
								}elseif(count($_SESSION['choosen_performers'])<=0){
									echo 'Для того чтобы оформить ваш заказ<br>вы должны <a style="text-decoration: none; color: green;" href="../login.php?from=index.php">выбрать исполнителей</a>';
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
											<div style="word-wrap: break-word; left: 0; top: 20px; margin-top: 10px;"><?php echo $res['MESSAGE_TEXT'] ?></div><div style="font-size: smaller; right: 0; top: 0; margin-left: 7px; color: #1a7c18;"><?php echo $res['DATE'] ?></div>
											<img src="../img/exit.png" class="fas fa-times notification_close_button" style="position: absolute; float: right; right: 6px; top: 6px; height: 15px; width: 15px; cursor: pointer;"></i>
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
                    <a href="ispolniteli.php">Каталог</a>
                </div>
			</nav>
		</div>
	</header>

    <div class="container reclam">
        <main class="reclam__content">
            <h1>Зарабатывайте с помощью видеооотзывов!</h1>
            <p>Заниматься тем, что умеешь, и в чем действительно разбираешься – мечта каждого из нас. Мы предлагаем тебе уникальную возможность зарабатывать хорошие деньги на создании видео отзывов на любые товары и услуги. 
Присоединяйся! Именно тебя не хватает в нашей команде креативных авторов.
            </p>
            <p class="reclam__hint">
                Чтобы начать работу, Вам нужно создать промо-видео:
            </p>
            <a href="#2" class="reclam__btn">создать промо</a>
        </main>
    </div>

	<div class="earn">
		<div class="container">
			<h2 class="earn__title">Как зарабатывать?</h2>
			<p class="earn__text">
			</p>
			<div class="earn__scheme">
				<div class="scheme__top">
					<img class="step-1" src="img/step-1.png" alt="step 1">
					<img class="scheme__arrow" src="img/left-arrow.png" alt="arrow">
					<img class="step-2" src="img/step-2.png" alt="step 2">
					<img class="scheme__arrow" src="img/left-arrow.png" alt="arrow">
					<img class="step-3" src="img/step-3.png" alt="step 3">
				</div>
				<div class="scheme__lines">
					<div class="scheme__line"><span></span></div>
					<div class="scheme__line"><span></span></div>
					<div class="scheme__line"><span></span></div>
				</div>
				<div class="scheme__text">
					<div class="scheme__text-1">Снимите проморолик
						<img class="scheme__img-mobile" src="img/step-1.png" alt="step 1">
					</div>
					<div class="scheme__text-2">Залейте его на Ютуб
						<img class="scheme__img-mobile" src="img/step-2.png" alt="step 2">
					</div>
					<div class="scheme__text-3">Поместите ссылку в личном кабинете
						<img class="scheme__img-mobile" src="img/step-3.png" alt="step 3">
					</div>
				</div>
				<a class="reclam__btn" href="#2">создать промо-ролик</a>
			</div>
		</div>
	</div>

    <footer class="nfooter">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-6 nfooter__contacts">
					<img src="img/contact.png" alt="contacts">
					<h4>Контакты</h4>
					<hr class="mfooter-line">
					<div class="phone">
						<img src="img/phone-call.png" alt="phone">
						<a href="tel:+375296704337">+3 7529 670 43 37</a>
					</div>
					<div class="mail">
						<img src="img/mail%20(1).png" alt="mail">
						<a href="mailto:otzivvideo@gmail.com">otzivvideo@gmail.com</a>
					</div>
					<div class="social">
						<a href="#"><img src="img/telegram.png" alt="telegram"></a>
						<a href="#"><img src="img/whatsapp.png" alt="whatsapp"></a>
						<a href="#"><img src="img/viber.png" alt="viber"></a>
					</div>
				</div>
				<div class="col-lg-4 col-12 nfooter__mail">
					<img src="img/file.png" alt="write">
					<h4>написать нам</h4>
					<form id="contact_form" method="POST" action="../engine/send_external_message.php">
						<input type="hidden" name="message_type" value="contact_form">
						<input form="contact_form" type="email" class="footer__form_email" name="email" placeholder="Ваш мейл">
						<textarea form="contact_form" type="text" class="footer__form_text" name="text" placeholder="Текст сообщения"></textarea>
						<button form="contact_form" class="footer__form_btn"><img src="img/mail.png" alt="" class="footer__img_mailf"></button>
					</form>
				</div>
				<div class="col-lg-4 col-6 nfooter__forUser">
					<img src="img/user.png" alt="user">
					<h4>пользователю</h4>
					<hr class="mfooter-line">
					<a href="#">Стать исполнителем</a>
					<a href="#">Заказать отзыв</a>
					<a href="#">Войти/ зарегистрироваться</a>
					<h5>Авторизация через соцсети</h5>
					<div class="social__link">
						<a href="#"><img src="img/facebook.png" alt="facebook"></a>
						<a href="#"><img src="img/google-plus.png" alt="google"></a>
						<a href="#"><img src="img/vk.png" alt="vk"></a>
					</div>

				</div>
			</div>
		</div>
	</footer>
</div>
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
				$("#contacts_helper").css("visibility", "hidden");
			}else{
				$("#contacts_helper").css("visibility", "hidden");
			}
			previous=contacts_counter;
		}, 500)

    	var current_performer_id = [];
    	var selected_performers_counter = 0;

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
		$('.reclam__btn').magnificPopup();
    </script>

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

	<script type="text/javascript" src="//consultsystems.ru/script/36596/" async charset="utf-8"></script>
	<script src="js/main1.js"></script>

</body>