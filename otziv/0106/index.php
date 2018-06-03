<?php require 'engine/db_connect.php';
		$video_on_page_counter=0;
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
     mysqli_set_charset($connection, 'utf8');           
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<title>Заказать качественные видео-отзывы для Вашего бизнеса.</title>
</head>
<body>
	
	<header class="header" id="ex1">
		<div class="container">
			<nav class="header__nav">
				<a style="text-decoration: none;" href="../">
					<img src="img/logo.png" alt="Otziv video" class="logo  rubberBand">
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

	<section class="header__down">
		<div class="container">
			<div class="row">
				<div class="col-lg-1"></div>
				<div class="col-md-6 col-lg-5">
					<h1 class="header__title">
						Видео-отзывы для Вашего бизнеса
					</h1>
					<h2 class="header__tagline">
						Лучше 1 раз увидеть, чем 100 раз услышать!
					</h2>
					<p class="header__text">
						Или прочитать...
					</p>
					<p class="header__desc">
						Видео отзывы – это уникальный механизм для 
						быстрого развития вашего бизнеса, увеличения 
						клиентской базы и конверсии сайта, демонстрация 
						вашего успешного опыта работы. 
					</p>
					<a href="../ispolniteli.php" class="header__btn">заказать</a>
				</div>
				<div class="col-md-6 col-lg-5">
					<img src="img/film.png" alt="" class="header__film">
					
					<iframe width="350" class="header__yuotube" height="280" src="https://www.youtube.com/embed/<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"))['DEFAULT_PROMO_URL'] ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</section>

	<section class="implementers">
        <div class="container messadeBlock">
            <h3 class="messadeBlock__title">лучшие исполнители</h3>
            <div class="row">
                <div class="col-xl-6 col-lg-8">
                    <div class="messageWindow">
                        <div class="messageWindow__video">
                            <iframe id="video_<?php echo ++$video_on_page_counter ?>" width="270" height="270" class="video implementers__movie" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen src="https://www.youtube.com/embed/<?php echo $select_best_array['0']['PROMO_URL'] ?>?rel=0&amp;controls=0">
                            </iframe>
                        </div>
                        <div class="messageWindow__right">
                            <div class="nickName">Никнейм Никнейм</div>
                            <div class="messageStatus">
                                <div class="messageStatus__icons">
                                    <div class="messageStatus__icon icon__inbox">+6</div>
                                    <div class="messageStatus__icon icon__unaccepted">+0</div>
                                </div>
                                <div class="messageStatus__text">
                                    <div class="text__inbox">6 принятых</div>
                                    <div class="text__unaccepted"> 0 неприянтых</div>
                                </div>
                            </div>
                            <hr>
                            <p class="message__text">
                                This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis</p>
                            <div class="messageBtns">
                                <a href="#">Подробнее</a>
                                <button class="messageBtn">Заказать</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-4 smallVideos">
                    <a href="#" class="implementers___link implementers___link1">
                        <img src="//img.youtube.com/vi/<?php echo $select_best_array['0']['PROMO_URL'] ?>/maxresdefault.jpg" style="border-radius: 50%;" width="170" height="170" class="implementers___person" frameborder="0" allow="encrypted-media" allowfullscreen>
                        </img>
                    </a>
                    <a href="#" class="implementers___link implementers___link2">
                        <img src="//img.youtube.com/vi/<?php echo $select_best_array['1']['PROMO_URL'] ?>/maxresdefault.jpg" style="border-radius: 50%;" width="170" height="170" class="implementers___person" frameborder="0" allow="encrypted-media" allowfullscreen>
                        </img>
                    </a>
                    <a href="#" class="implementers___link implementers___link3">
                        <img src="//img.youtube.com/vi/<?php echo $select_best_array['2']['PROMO_URL'] ?>/maxresdefault.jpg" style="border-radius: 50%;" width="170" height="170" class="implementers___person" frameborder="0" allow="encrypted-media" allowfullscreen>
                        </img>
                    </a>

                    <a href="#" class="implementers___link implementers___link4">
                        <img src="//img.youtube.com/vi/<?php echo $select_best_array['3']['PROMO_URL'] ?>/maxresdefault.jpg" style="border-radius: 50%;" width="170" height="170" class="implementers___person" frameborder="0" allow="encrypted-media" allowfullscreen>
                        </img>
                    </a>
                    <a href="#" class="implementers___link implementers___link5">
                        <img src="//img.youtube.com/vi/<?php echo $select_best_array['4']['PROMO_URL'] ?>/maxresdefault.jpg" style="border-radius: 50%;" width="170" height="170" class="implementers___person" frameborder="0" allow="encrypted-media" allowfullscreen>
                        </img>
                    </a>
                    <a href="#" class="implementers___link implementers___link6">
                        <img src="//img.youtube.com/vi/<?php echo $select_best_array['5']['PROMO_URL'] ?>/maxresdefault.jpg" style="border-radius: 50%;" width="170" height="170" class="implementers___person" frameborder="0" allow="encrypted-media" allowfullscreen>
                        </img>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="ispolniteli.php" class="implementers__btn_list">
                        <img src="img/map.png" alt="map" class="implementers__map">
                        <span class="implementers__btn_text">смотреть весь каталог исполнителей</span>
                    </a>
                </div>
            </div>

        </div>
	</section>

	<section class="advantage__2" id="ex3">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="advantage__2__title ">
						что вам дают видео отзывы?
					</h2>
				</div>	
			</div>
			<div class="row justify-content-around">
				<div class="col-md-3  advantage__2_a">
					<img src="img/analytics.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Подъем конверсии сайта
					</h3>
				</div>
				<div class="col-md-3  advantage__2_a">
					<img src="img/group.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Появление новых клиен- <br>	
						тов
					</h3>
				</div>
				<div class="col-md-3  advantage__2_a">
					<img src="img/rate.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Повышение узнаваемости вашего бренда
					</h3>
				</div>
				<div class="col-md-3  advantage__2_a">
					<img src="img/growth.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Рост уровня продаж
					</h3>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-3  advantage__2_a">
					<img src="img/profits.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Увеличение прибыли
					</h3>
				</div>
				<div class="col-md-3  advantage__2_a">
					<img src="img/teamwork.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Рост доверия клиентов
					</h3>
				</div>
				<div class="col-md-3  advantage__2_a">
					<img src="img/monitor.png" alt="advantage" class="advantage__2__img">
					<h3 class="advantage__2__desc">
						Улучшение позиций <br> вашего сайта
					</h3>
				</div>
			</div>
		</div>
	</section>

	<section class="plan" id="ex4">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="plan__title ">
						Почему мы?
					</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-4  plan_a">
					<img src="img/image3.png" alt="service" class="plan__img">
					<div class="plan__line"></div>
					<p class="plan__text">
						Мы создаем ценные материалы с 
						учетом ваших потребностей и 
						возможностей вашего бизнеса.
					</p>
				</div>
				<div class="col-md-4  plan_a">
					<img src="img/image4.png" alt="service" class="plan__img">
					<div class="plan__line"></div>
					<p class="plan__text">
						Для создания видео отзывов мы 
						подбираем обычных людей, специально 
						для вашей целевой аудитории.
					</p>
				</div>
				<div class="col-md-4  plan_a">
					<img src="img/image5.png" alt="service" class="plan__img">
					<div class="plan__line"></div>
					<p class="plan__text">
						Создаем качественную съемку, 
						которое дает видеозаписям четкое 
						изображение и хороший звук.
					</p>
				</div>
				<div class="col-md-4  plan_a">
					<img src="img/image6.png" alt="service" class="plan__img">
					<div class="plan__line"></div>
					<p class="plan__text">
						Сценарии и тексты 
						отзывов для исполнителей 
						у нас пишут профессиональные авторы.
					</p>
				</div>
				<div class="col-md-4  plan_a">
					<img src="img/image7.png" alt="service" class="plan__img">
					<div class="plan__line"></div>
					<p class="plan__text">
						Оказываем техподдержку по размещению отзывов на сайт.
					</p>
				</div>
			</div>
		</div>
	</section>

	<footer class="footer">
		<div class="container">
			<div class="row">
					<?php
					$result=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));
					if(($result['PHONE']!="")||($result['EMAIL']!="")||($result['TELEGRAM']!="")||($result['WHATSAPP']!="")||($result['VIBER']!="")){
					?>
				<div class="col-md-3  footer_a">
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
				<div class="col-md-4  footer_b">
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
				<div class="col-md-3  footer_c">
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
				Укажите необходимое количество отзывов:
			</p>
			<div class="number">
   			<span class="minus"><img src="img/up.png" alt="up" class="order__video_up"></span>
    		<input id="set_orders_quantity_input" name="orders_quantity" type="text" class="order__video_number" value="1" form="create_order_frm" />
    		<span class="plus"><img src="img/down.png" alt="down" class="order__video_down"></span>
			</div>
		</div>
		<br>
		<?php
		if(!isset($_SESSION['logged_user'])){
		?>
		<p class="order__video_war">
			<img src="img/info2.png" alt="info" class="order__video_war_img">
			Внимание!
		</p>
		<p class="order__video_text">
			Для того, чтобы заказать видеоотзывы, 
			Вы должны <a href="../signup.php?from=../" class="order__video_text_link">зарегистрироваться</a> или <a href="../login.php?from=../" class="order__video_text_link">войти</a> 
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

	<!-- Присваиваю JS переменным значения PHP переменных -->
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
		var tarif_quantities = [];
		var logged_in = false;
		var videoPlayer = [];
		var meme = [];

		<?php
		foreach ($_SESSION['choosen_performers'] as $value) {
			?>
			current_performer_id.push('<?php echo $value ?>');
			selected_performers_counter++;
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
	</script>
</div>
	<style type="text/css">
		.implementers___btn2, .implementers___btn1{
			bottom: -70px;
			left: 20px;
			position: relative;
		}
		.implementers{
			margin-bottom: 0;
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
	<script src="js/main1.js"></script>



	<script type="text/javascript" src="//consultsystems.ru/script/36596/" async charset="utf-8"></script>
</body>
</html>