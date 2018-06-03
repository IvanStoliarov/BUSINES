<?php
session_start();
$connection = mysqli_connect("localhost", "root", "qweqwe123", "OT");
$_SESSION['post']=$_POST;

$result=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" />
	
        <link rel="stylesheet" type="text/css" href="../../../css/magnific-popup.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="../../../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../../css/style.css">
        <link rel="stylesheet" type="text/css" href="../../../css/main.css">

    </head>

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
    <body>
       <iframe class="yandex_iframe" src="https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%BD%D0%B0%20%D1%81%D0%B0%D0%B9%D1%82%D0%B5%20otziv.video&targets-hint=&default-sum=&button-text=12&payment-type-choice=on&hint=&successURL=http%3A%2F%2Fotziv.video%2Fpayment%2Fyandex%2Fevent%2FYandexMoneyCashin.php&quickpay=shop&account=<?php echo $result['YAMONEY_VALLET'] ?>" width="100%" height="222" frameborder="0" allowtransparency="true" scrolling="no"></iframe>

        <footer class="footer">
        <div class="container">
            <div class="row">
                    <?php
                    $result=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));
                    if(($result['PHONE']!="")||($result['EMAIL']!="")||($result['TELEGRAM']!="")||($result['WHATSAPP']!="")||($result['VIBER']!="")){
                    ?>
                <div class="col-md-3 animated footer_a">
                    <img src="../../../img/contact.png" alt="contact" class="footer__img_contact">
                    <h2 class="footer__contact">
                        контакты
                    </h2>
                    <div class="footer__line"></div>
                    <?php if($result['EMAIL']!=""){ ?>
                    <img src="../../../img/mail (1).png" alt="mail" class="footer__img_mail">
                    <p class="footer__mail"><a style="text-decoration: none; color: white; top: -23px; position: relative;" href="mailto:<?php echo $result['EMAIL'] ?>"><?php echo $result['EMAIL'] ?></a></p>
                    <?php } ?>
                    <ul class="footer__contact_social d-flex">
                        <?php if($result['TELEGRAM']!=""){ ?>
                        <li class="footer__contact_item">
                            <a href="#" class="footer__contact_link">
                                <img src="../../../img/telegram.png" alt="telegram" class="footer__contact_img">
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($result['WHATSAPP']!=""){ ?>
                        <li class="footer__contact_item">
                            <a href="#" class="footer__contact_link">
                                <img src="../../../img/whatsapp.png" alt="whatsapp" class="footer__contact_img">
                            </a>
                        </li>
                        <?php } ?>
                        <?php if($result['VIBER']!=""){ ?>
                        <li class="footer__contact_item">
                            <a href="#" class="footer__contact_link">
                                <img src="../../../img/viber.png" alt="viber" class="footer__contact_img">
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
                <div class="col-md-1"></div>
                <div class="col-md-4 animated footer_b">
                    <img src="../../../img/file.png" alt="message" class="footer__img_massage">
                    <h3 class="footer__message">
                        написать нам
                    </h3>
                    <form id="contact_form" method="POST" action="../engine/send_external_message.php">
                        <input type="hidden" name="message_type" value="contact_form">
                        <input form="contact_form" type="email" class="footer__form_email" name="email" placeholder="Ваш мейл">
                        <textarea form="contact_form" type="text" class="footer__form_text" name="text" placeholder="Текст сообщения"></textarea>
                        <button form="contact_form" class="footer__form_btn"><img src="../../../img/mail.png" alt="" class="footer__img_mailf"></button>
                    </form>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-3 animated footer_c">
                    <img src="../../../img/user.png" alt="user" class="footer__img_user">
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
                            <a href="../../../login.php" style="color: #dfe0e2; text-align: right; font-size: 18px; font-family: 'Open Sans', sans-serif; font-weight: 600; text-decoration: none;" ">Войти/зарегистрироваться</a>
                        </li>
                        <li class="footer__item">
                            <a href="../../../login.php" class="footer__link">Авторизация через соцсети</a>
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
            .payment_form{
                background-color: white;
                padding: 20px;
                margin: auto;
                max-width: 350px;
                top: 150px;
                position: relative;
                box-shadow: 4px 5px 8px #494949;
                border-radius: 8px;
                text-align: center;
            }
            body{
                background: grey;
            }
            input{
                margin: 4px;
                max-width: 270px;
            }
            .payment_service_header_logo{
                max-width: 250px;  
            }
            footer{
                position: relative;
                bottom: -250px;
            }
            .yandex_iframe{
                margin: auto;
                position: relative;
                top: 125px;
                width: 30%;
                left: 33%;
            }
        </style>
        
        <script
                  src="https://code.jquery.com/jquery-1.12.4.min.js"
                  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                  crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
                  integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0="
                  crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../../slick/slick.min.js"></script>
        <script type="text/javascript" src="../../../js/jquery.magnific-popup.min.js"></script>
        <script src="../../../js/js.js"></script>
        
    </body>
</html>