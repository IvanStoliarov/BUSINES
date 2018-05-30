<?php

require "engine/db_connect.php";

$video_on_page_counter=0;
$user=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['ID']."'"));
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width" />
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
	<link rel="stylesheet" type="text/css" href="slick/slick.css"/>

	<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
	<link rel="stylesheet" type="text/css" href="animate.css-master/animate.min.css">
	<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Пользователь</title>
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

	<main class="main">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="user__block">
						<div class="row">
							<div class="col-md-5">
								<iframe id="video_<?php echo $video_on_page_counter ?>" style="border-radius: 50%;" width="295" height="295" class="implementers__movie user__block_video" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen src="https://www.youtube.com/embed/<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['ID']."'"))['PROMO_URL'] ?>?rel=0&amp;controls=0">
								</iframe>
								<img src="img/pol_elips.png" alt="ellips" class="user__block_ellips">
							</div>
							<div class="col-md-3">
								<h2 class="user__block_title">
									<?php echo $user['LOGIN'] ?>
								</h2>
								<p class="user__block_green">
									+ <?php echo $user['GRANTED_ORDERS'] ?>
								</p>
								<p class="user__block_gray">
									- <?php echo $user['DENIED_ORDERS'] ?>
								</p>
								<p class="user__block_accepted">
									<?php echo $user['GRANTED_ORDERS'] ?> принятых
								</p>
								<p class="user__block_unaccepted">
									<?php echo $user['DENIED_ORDERS'] ?> непринятых
								</p>			
							</div>
							<div class="col-md-4">
								<div class="user__block_about_block">
									<h2 class="user__block_about">
										обо мне:
									</h2>
									<div class="user__block_description">
										<p class="user__block_year">
											 <?php
											 function calculate_age($birthday) {
												  $birthday_timestamp = strtotime($birthday);
												  $age = date('Y') - date('Y', $birthday_timestamp);
												  if (date('md', $birthday_timestamp) > date('md')) {
												    $age--;
												  }
												  return $age;
											 };
											 $age=calculate_age($user['BIRTH_DATE']);
											echo $age." ";
											if(($age%10)==1){
												echo "год";
											}elseif(($age%10)<5&&($age%10!=0)){
												echo "года";
											}else{
												echo "лет";
											}
											?>
										</p>
										<div class="user__block_line"></div>
										<p class="user__block_half">
											Пол: <?php
												if($user['SEX']==1){
													echo "М";
												}elseif($user['SEX']==2){
													echo "Ж";
												}
												?>
										</p>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-3">
					<a href="#ex6" class="order__btn">заказать отзыв</a>
					<a href="#77" class="become__btn">написать исполнителю</a>
				</div>
			</div>
			<?php if(mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$_GET['ID']."' AND STATUS='2'"))>0){ ?>
			<div class="row">
				<div class="col-12">
					<h2 class="user__work_title">
						Работы пользователя
					</h2>
				</div>
			</div>
			<?php }else{ ?>
					<h2 class="user__work_title">
						У этого пользователя пока нет готовых работ.
					</h2>
			<?php } ?>
			<div class="row">
				<div class="col-12">
					<div class="slickp-slider">
						
						<?php
						$result=mysqli_query($connection, "SELECT * FROM `ORDERS` WHERE PERFORMER_ID='".$_GET['ID']."' AND STATUS='2'");
						while($res=mysqli_fetch_assoc($result)){
						?>
						<div class="slide">
							<img src="img/slider_img.png" alt="" class="slide__img">
							<p class="slider__desc">
								<?php $res['NAME'] ?><br>
								<?php $res['DONE_DATE'] ?>
							</p>
						</div>
						<?php
						}
						?>
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

	<div class="hidden">
		<div id="77" class="send_message_box" style="position: relative;">
			<form method="post" action="../engine/send_message.php" id="send_message_form"></form>
			<label for="message_body">Ваше сообщение для <a href="../user.php?ID=<?php echo $_GET['ID'] ?>" style="text-decoration: none;"><?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_GET['ID']."'"))['LOGIN'] ?></a></label><br>
			<input form="send_message_form" type="hidden" name="to_id" value="<?php echo $_GET['ID'] ?>">
			<input type="hidden" name="from" value="../user.php?ID=<?php echo $_GET['ID'] ?>">
			<textarea form="send_message_form" style="width: 100%; height: 125px;" id="message_body" name="message_body"></textarea>
			<button form="send_message_form" id="send_message_btn" type="submit" class="contractor__btn" style="width: 15%; height: 3%; right: -370px; position: relative;" form="upload_order_video">отправить</button>
		</div>
	</div>

	<div class="hidden"><?php

	if(isset($_SESSION['logged_user'])){
		if((mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `USERS` WHERE (STATUS='2' OR STATUS='4') AND ID='".$_SESSION['logged_user']."'"))>0)){?>
			<div class="contractor" id="2">
						<h2 class="contractor__title">
						стать исполнителем
						</h2>
						<p class="contractor__desc">
					Для того, чтобы  стать исполнителем, Вы должны заполнить данную форму.
						</p>
					<form action="engine/promo_upload.php" enctype="multipart/form-data" method="POST">
					<div class="contractor__left">
						<div class="contractor__block">
							<p class="contractor__desc_category">
								Пол:
							</p>
							<select name="sex" class="contractor__desc_category_pol">
								 <option value="1">М</option>
								 <option value="2">Ж</option>
							</select>
						</div>
						<div class="contractor__block">
							<p class="contractor__desc_category contractor__desc_date">
								Дата рождения
							</p>
							<input required type="date" name="date" value="25" class="contractor__desc_date_i">
						</div>
					</div>
					<div class="contractor__right">
						<input required type="file" name="file" id="file" class="contractor__file inputfile">
						<label for="file" class="contractor__file_label">
							<img src="img/download-file.png" alt="download" class="contractor__img">
							<span class="contractor__file_label_span">Загрузите свое промо-видео. В нём Вы должны максимально подробно рассказать 
							о себе <br><span style="color: yellow;">(MP4 или AVI меньше 200Мб)</span></span>
						</label>
					</div>
					<button type="submit" class="contractor__btn">отправить</button>
				</form>
				<a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a>
			</div>
		<?php }else{
			?><div class="contractor" id="2"><h2 class="contractor__title"><?php echo $_SESSION['logged_user']['LOGIN'] ?>, вы уже являетесь исполнителем!</h2><a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a><div><?php
		}
	}else{ ?>
		<div class="contractor" id="2"><h2 class="contractor__title">Для того, чтобы стать исполнителем вы должны <a href="../signup.php" target="_blank">зарегистрироваться</a> или <a href="../login.php" target="_blank">войти</a></h2><a href="#" class="contractor__exit"><img src="img/exit.png" alt="exit" class="contractor__exit_img"></a><div>
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
			Вы должны <a href="../signup.php?from=../user.php?ID=<?php echo $_GET['ID'] ?>" class="order__video_text_link">зарегистрироваться</a> или <a href="../login.php?from=../user.php?ID=<?php echo $_GET['ID'] ?>" class="order__video_text_link">войти</a> 
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
		.send_message_box{
			margin: auto;
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
		var videoPlayer = [];
		var meme = [];

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

</body>
</html>