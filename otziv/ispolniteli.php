<?php

include "engine/db_connect.php";
if(!isset($_GET['page'])){
$_GET['page']=1;
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
	<title>Исполнители</title>
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

	<main class="main_isp">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="directory__executor">
						каталог исполнителей
					</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div class="directory">
						<?php
						//Выводим всех исполнителей
						if(isset($_GET['page'])){
							$limit=($_GET['page']-1)*10;
							$query_first_part="SELECT * FROM `USERS` WHERE (STATUS='2' OR STATUS='4')";
							if(isset($_SESSION['logged_user'])){
								$query_first_part=$query_first_part." AND ID<>'".$_SESSION['logged_user']['ID']."'";
							}
							if(isset($_GET['teen'])){
								$date = new DateTime();
								$date->modify('-25 year');
								if(isset($_GET['old'])||isset($_GET['young'])){
									$query_first_part=$query_first_part." AND (BIRTH_DATE > '".$date->format('Y-m-d')."'";
								}else{
									$query_first_part=$query_first_part." AND (BIRTH_DATE > '".$date->format('Y-m-d')."'";
								}
								$date = new DateTime();
								$date->modify('-16 year');
								$query_first_part=$query_first_part." AND BIRTH_DATE < '".$date->format('Y-m-d')."')";
							}
							if(isset($_GET['young'])){
								$date = new DateTime();
								$date->modify('-35 year');
								if(isset($_GET['teen'])){
									$query_first_part=$query_first_part." OR ( BIRTH_DATE > '".$date->format('Y-m-d')."'";
								}else{
									$query_first_part=$query_first_part." AND ( BIRTH_DATE > '".$date->format('Y-m-d')."'";
								}
								$date = new DateTime();
								$date->modify('-25 year');
								if(isset($_GET['teen'])){
									$query_first_part=$query_first_part." AND  BIRTH_DATE < '".$date->format('Y-m-d')."')";
								}else{
									$query_first_part=$query_first_part." AND  BIRTH_DATE < '".$date->format('Y-m-d')."')";
								}
							}
							if(isset($_GET['old'])){
								$date = new DateTime();
								$date->modify('-35 year');
								if(isset($_GET['teen'])||isset($_GET['young'])){
									$query_first_part=$query_first_part." AND (BIRTH_DATE < '".$date->format('Y-m-d')."')";
								}else{
									$query_first_part=$query_first_part." AND  BIRTH_DATE < '".$date->format('Y-m-d')."'";
								}
							}
							if(isset($_GET['sex_male'])){
								if(isset($_GET['sex_female'])){
									$query_first_part=$query_first_part." AND ( SEX='1'";
								}else{
									$query_first_part=$query_first_part." AND  SEX='1'";
								}
							}
							if(isset($_GET['sex_female'])){
								if(isset($_GET['sex_male'])){
									$query_first_part=$query_first_part." OR  SEX='2')";
								}else{
									$query_first_part=$query_first_part." AND  SEX='2'";
								}
							}
							if(isset($_GET['search-text'])){
								$query_first_part=$query_first_part." AND LOGIN LIKE '%".$_GET['search-text']."%'";
							}
							$result=mysqli_query($connection, $query_first_part." ORDER BY ID DESC LIMIT ".$limit.", 10;");
							while($performer = mysqli_fetch_assoc($result)){

							  ?><div style="position: relative;" class="directory__item">
								<div class="row">

									<div class="col-md-4">
										<iframe id="video_<?php echo ++$video_on_page_counter ?>" style="border-radius: 50%;" width="270" height="270" class="implementers__movie implementers__movie-directory" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen src="https://www.youtube.com/embed/<?php echo $performer['PROMO_URL'] ?>?rel=0&amp;controls=0">
										</iframe>
									</div>
									<div style="right: 35px; position: absolute;" class="col-md-4 implementers__right">
										<h3 class="implementer__name implementer__name-directory">
											<?php echo $performer['LOGIN'] ?>
										</h3>
										<div class="performer_block_id_getter" style="visibility: hidden;"><?php echo $performer['ID'] ?></div>
										<span class="implementer__experiened implementer__experiened-directory">
											+ <?php echo $performer['GRANTED_ORDERS'] ?>
										</span>
										<span class="implementer__experiened implementer__experiened-directory-gray">
											- <?php echo $performer['DENIED_ORDERS'] ?>
										</span>
										<p class="implementer__message_adopted implementer__message_adopted-directory">
											<?php echo $performer['GRANTED_ORDERS'] ?> принятых
										</p>
										<p class="implementer__message_unaccepted implementer__message_unaccepted-directory">
											<?php echo $performer['DENIED_ORDERS'] ?> непринятых
										</p>
										<div class="implementer_line implementer_line-directory"></div>
										
										<a href="user.php?ID=<?php echo $performer['ID'] ?>" class="implementers___btn1 implementers___btn1-directory implementers___btn2-directory">подробнее</a>
										<a href="user.php?ID=<?php echo $performer['ID'] ?>" class="implementers___btn2 implementers___btn2-directory performer_block_id_setter" <?php if(isset($_SESSION['choosen_performers'])){ if(in_array($performer['ID'], $_SESSION['choosen_performers'])){ echo 'style="background: red; color: white;"'; } } ?>>
											<?php
											if(isset($_SESSION['choosen_performers'])){
												if(in_array($performer['ID'], $_SESSION['choosen_performers'])){
													echo 'отменить';
												}else{
													echo 'заказать';
												}
											}else{
												echo 'заказать';
											}
											?>
										</a>
								</div>
								
								</div>
							</div><?php

							}
						}
						?>
					</div>
				</div>
				<div class="col-md-3">
					<a href="#2" class="directory__exepted_btn">стать исполнителем</a>
					<div class="search">
						<form id="search-form" action="ispolniteli.php" method="GET">
							<input type="text" name="search-text" placeholder="искать исполнителя" class="search__input">
							<button form="search-form" class="search__img"><img src="img/search.png" alt="search" ></button>
						</form>
						<form id="filter" action="ispolniteli.php" method="GET">
							<h4 class="category__name">
								Возраст исполнителя
							</h4>
							
								<input id="checkbox1" type="checkbox" name="teen" class="category__chexbox">
								<label for="checkbox1" class="category__label">16 - 25 гг</label>
							
								<input id="checkbox2" type="checkbox" name="young" class="category__chexbox">
								<label for="checkbox2" class="category__label">25 - 35гг</label>
								
								<input id="checkbox3" type="checkbox" name="old" class="category__chexbox">
								<label for="checkbox3" class="category__label">35+</label>

							<h4 class="category__name">
								Пол
							</h4>
								<input id="checkbox4" type="checkbox" name="sex_male" class="category__chexbox">
								<label for="checkbox4" class="category__label">М</label>
							
								<input id="checkbox5" type="checkbox" name="sex_female" class="category__chexbox">
								<label for="checkbox5" class="category__label">Ж</label>

							

							<button form="filter" class="cetegory__btn_left">Показать</button>
							<button form="reset-form" class="cetegory__btn_right">Сбросить</button>
						</form>
						<form style="display: none;" id="reset-form" action="ispolniteli.php">
						</form>
					</div>
				</div>
			</div>
			<?php
			$num_rows_query="SELECT * FROM `USERS` WHERE STATUS='2' OR STATUS='4'";
			$num_rows_result=mysqli_query($connection, $num_rows_query);
			$num_rows=mysqli_num_rows($num_rows_result);
			if(mysqli_num_rows($num_rows_result)>10){ 
				if(isset($_GET['page'])){
					$optional_get_queries="";
					if(isset($_GET['teen'])){
						$optional_get_queries=$optional_get_queries."&teen=".$_GET['teen'];
					}
					if(isset($_GET['young'])){
						$optional_get_queries=$optional_get_queries."&young=".$_GET['young'];
					}
					if(isset($_GET['old'])){
						$optional_get_queries=$optional_get_queries."&old=".$_GET['old'];
					}
					if(isset($_GET['sex_male'])){
						$optional_get_queries=$optional_get_queries."&sex_male=".$_GET['sex_male'];
					}
					if(isset($_GET['sex_female'])){
						$optional_get_queries=$optional_get_queries."&sex_female=".$_GET['sex_female'];
					}
					if(isset($_GET['search-text'])){
						$optional_get_queries=$optional_get_queries."&search-text=".$_GET['search-text'];
					}
					if($_GET['page']==1){
					?>
					<div class="row">
						<div class="col-12 col-md-9">
						<a href="" class="pages"><?php echo $_GET['page']?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']+1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']+2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+2 ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="../ispolniteli.php?page=<?php 
									echo (($num_rows-($num_rows%10))/10+1).$optional_get_queries;
									?>" class="pages">
									<?php 
									echo ($num_rows-($num_rows%10))/10+1;
									?></a><?php
							}
							?>
					<?php
					}elseif((($num_rows-($num_rows%10))/10+1)>=($_GET['page']+1)){
						if((($num_rows-($num_rows%10))/10+1)==($_GET['page']+1)){?>
							<div class="row">
							<div class="col-12 col-md-9">
							<a href="../ispolniteli.php?page=<?php echo ($_GET['page']-2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-2 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']).$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="../ispolniteli.php?page=<?php 
									echo (($num_rows-($num_rows%10))/10+1).$optional_get_queries;
									?>" class="pages">
									<?php 
									echo ($num_rows-($num_rows%10))/10+1;
									?></a><?php
							}
							}else{ 
						?>

						<div class="row">
						<div class="col-12 col-md-9">
						<a href="../ispolniteli.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="../ispolniteli.php?page=<?php echo $_GET['page'].$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']+1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+1 ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="../ispolniteli.php?page=<?php 
									echo (($num_rows-($num_rows%10))/10+1).$optional_get_queries;
									?>" class="pages">
									<?php 
									echo ($num_rows-($num_rows%10))/10+1;
									?></a><?php
							}}
							
					}elseif($_GET['page']>3){
						if((($num_rows-($num_rows%10))/10+1)>($_GET['page']+1)){
						?>
						<div class="row">
						<div class="col-12 col-md-9">
						<a href="../ispolniteli.php?page=<?php echo '1'.$optional_get_queries ?>" class="pages">1</a>
						<p class="dots">. . .</p>
						<a href="../ispolniteli.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="../ispolniteli.php?page=<?php echo $_GET['page'].$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']+1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+1 ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="../ispolniteli.php?page=<?php 
									echo (($num_rows-($num_rows%10))/10+1).$optional_get_queries;
									?>" class="pages">
									<?php 
									echo ($num_rows-($num_rows%10))/10+1;
									?></a><?php
							}
						}elseif((($num_rows-($num_rows%10))/10+1)==($_GET['page']+1)){?>
							<div class="row">
							<div class="col-12 col-md-9">
							<a href="../ispolniteli.php?page=<?php echo ($_GET['page']-2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-2 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']).$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="../ispolniteli.php?page=<?php 
									echo (($num_rows-($num_rows%10))/10+1).$optional_get_queries;
									?>" class="pages">
									<?php 
									echo ($num_rows-($num_rows%10))/10+1;
									?></a><?php
							}
						}else{
							?>
						<div class="row">
						<div class="col-12 col-md-9">
						<a href="../ispolniteli.php?page=<?php echo '1'.$optional_get_queries ?>" class="pages">1</a>
						<p class="dots">. . .</p>
						<a href="../ispolniteli.php?page=<?php echo ($_GET['page']-2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-2 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="../ispolniteli.php?page=<?php echo ($_GET['page']).$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							}
							}
						}
					}
				}
			 ?>
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
			Вы должны <a href=../signup.php?from=../ispolniteli.php" class="order__video_text_link">зарегистрироваться</a> или <a href="../login.php?from=../ispolniteli.php" class="order__video_text_link">войти</a> 
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
		}  } ?>
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