<?php
	require "../engine/db_connect.php";
	include "../engine/vk_config.php";
	include "../engine/fb_config.php";
	if(!isset($_GET['page'])){
		$_GET['page']=1;
	}
	if(isset($_POST['to_delete_user_id'])){
		$result=mysqli_query($connection, "SELECT * FROM `USERS`");
		while($res=mysqli_fetch_assoc($result)){
			if($res['ID']==$_POST['to_delete_user_id']){
				mysqli_query($connection, "DELETE FROM `USERS` WHERE ID='".$_POST['to_delete_user_id']."'");
			}
		}
		unset($_POST['to_delete_user_id']);
	}
    if(isset($_POST['to_make_moderator_user_id'])){
		$result=mysqli_query($connection, "SELECT * FROM `USERS`");
		while($res=mysqli_fetch_assoc($result)){
			if($res['ID']==$_POST['to_make_moderator_user_id']){
				mysqli_query($connection, "UPDATE `USERS` SET STATUS='5' WHERE ID='".$res['ID']."'");
			}
		}
		unset($_POST['to_make_moderator_user_id']);
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
	<title>Админ панель: Пользователи</title>
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
		?>
		<!-- Все ок ввыводим админку -->
		<h2 style="margin: auto; top: 100px; position: absolute; text-align: center; color: #e0e0e0; right: 800px;">Пользователи</h2>
		<div class="wrapper_show_users">
			<?php
			$limit=($_GET['page']-1)*10;
							$query_first_part="SELECT * FROM `USERS` WHERE (STATUS<>'3')";
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
							if(isset($_GET['user'])&&isset($_GET['performer'])){
								$query_first_part=$query_first_part." AND (STATUS='4' OR STATUS='1' OR STATUS='2') AND ID<>'".$_SESSION['logged_user']['ID']."'";
							}elseif(isset($_GET['user'])){
								$query_first_part=$query_first_part." AND (STATUS='1')";
							}elseif(isset($_GET['performer'])){
								$query_first_part=$query_first_part." AND (STATUS='2')";
							}
							if(isset($_GET['search-text'])){
								$query_first_part=$query_first_part." AND LOGIN LIKE '%".$_GET['search-text']."%'";
							}
                            $result=mysqli_query($connection, "SELECT * FROM `USERS`");
                            while($res=mysqli_fetch_assoc($result)){
                                if(isset($_POST['user_price_'.$res['ID']])&&$_POST['user_price_'.$res['ID']]!=""){
                                    mysqli_query($connection, "UPDATE `USERS` SET PRICE='".$_POST['user_price_'.$res['ID']]."' WHERE ID='".$res['ID']."'");
                                }
                            }
                            $users_counter_for_prices=0;
							$result=mysqli_query($connection, $query_first_part." ORDER BY ID DESC LIMIT ".$limit.", 10;");
							while($performer = mysqli_fetch_assoc($result)){

							  ?>
                                <form method="post" id="save_settings"></form>
							  	<div class="user_div" <?php if($performer['STATUS']==5){ echo 'style="background: #e6d18e;"'; } ?>>
									<div class="user_name"><?php echo $performer['LOGIN'] ?></div>
									<form id="delete_user_<?php echo $performer['ID'] ?>" method="POST"></form>
                                    <form id="make_moderator_<?php echo $performer['ID'] ?>" method="POST"></form>
									<input type="hidden" name="to_delete_user_id" form="delete_user_<?php echo $performer['ID'] ?>" value="<?php echo $performer['ID'] ?>">
                                    <input type="hidden" name="to_make_moderator_user_id" form="make_moderator_<?php echo $performer['ID'] ?>" value="<?php echo $performer['ID'] ?>">
                                    <label style="position: absolute; right:37%; width: 50px;" for="user_price_<?php echo ++$users_counter_for_prices ?>">Цена</label>
                                    <input style="position: absolute; right:30%; width: 50px;" id="user_price_<?php echo $users_counter_for_prices ?>" type="text" name="user_price_<?php echo $performer['ID'] ?>" form="save_settings" value="<?php echo $performer['PRICE'] ?>">
									<button style="position: absolute; right: 17%;" form="delete_user_<?php echo $performer['ID'] ?>" type="submit">удалить</button>
                                    <button class="make_moderator_button" style="position: absolute; right: 51%; background: #22db4e; border-radius: 4px; border-width: 0; display:none;" form="make_moderator_<?php echo $performer['ID'] ?>" type="submit">сделать модератором</button>
									<div class="user_status"><?php 
										if($performer['STATUS']==1){
											echo "Заказчик";
										}elseif($performer['STATUS']==2||$performer['STATUS']==4){
											echo "Исполнитель";
										}elseif($performer['STATUS']==5){
                                            echo "Модератор";
                                        }
									 ?></div>
									<a class="to_user_page" href="../user.php?ID=<?php echo $performer['ID'] ?>">Подробно</a>
								</div>
							  <?php
    
							}
						
			?>
            <button class="save_settings" form="save_settings" type="submit">Сохранить</button>
			<?php
			$num_rows_query=$query_first_part;
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
					if(isset($_GET['user'])){
						$optional_get_queries=$optional_get_queries."&user=".$_GET['user'];
					}
					if(isset($_GET['performer'])){
						$optional_get_queries=$optional_get_queries."&performer=".$_GET['performer'];
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
								?><a href="index.php?page=<?php echo ($_GET['page']+1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="index.php?page=<?php echo ($_GET['page']+2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+2 ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="index.php?page=<?php 
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
							<a href="index.php?page=<?php echo ($_GET['page']-2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-2 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="index.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="index.php?page=<?php echo ($_GET['page']).$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="index.php?page=<?php 
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
						<a href="index.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="index.php?page=<?php echo $_GET['page'].$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="index.php?page=<?php echo ($_GET['page']+1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+1 ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="index.php?page=<?php 
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
						<a href="index.php?page=<?php echo '1'.$optional_get_queries ?>" class="pages">1</a>
						<p class="dots">. . .</p>
						<a href="index.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="index.php?page=<?php echo $_GET['page'].$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="index.php?page=<?php echo ($_GET['page']+1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']+1 ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="index.php?page=<?php 
									echo (($num_rows-($num_rows%10))/10+1).$optional_get_queries;
									?>" class="pages">
									<?php 
									echo ($num_rows-($num_rows%10))/10+1;
									?></a><?php
							}
						}elseif((($num_rows-($num_rows%10))/10+1)==($_GET['page']+1)){?>
							<div class="row">
							<div class="col-12 col-md-9">
							<a href="index.php?page=<?php echo ($_GET['page']-2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-2 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="index.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="index.php?page=<?php echo ($_GET['page']).$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							}
							if((($num_rows-($num_rows%10))/10+1)>3){
								?><p class="dots">. . .</p>
									<a href="index.php?page=<?php 
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
						<a href="index.php?page=<?php echo '1'.$optional_get_queries ?>" class="pages">1</a>
						<p class="dots">. . .</p>
						<a href="index.php?page=<?php echo ($_GET['page']-2).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-2 ?></a>
							<?php if((($num_rows-($num_rows%10))/10+1)>1){
								?><a href="index.php?page=<?php echo ($_GET['page']-1).$optional_get_queries ?>" class="pages"><?php echo $_GET['page']-1 ?></a><?php
							} 
							if((($num_rows-($num_rows%10))/10+1)>2){
								?><a href="index.php?page=<?php echo ($_GET['page']).$optional_get_queries ?>" class="pages"><?php echo $_GET['page'] ?></a><?php
							}
							}
						}
					}
				}
			 ?>
		</div>
		</div>
		<?php 	
	}else{
		?>
		<div class="not_admin_warning">Вы не авторизованы или не являетесь админом!<br><a class="to_login_link" href="../login.php">Авторизоваться</a></div>
		<?php
	}

	?>
	<?php if(isset($_SESSION['logged_user'])&&(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['STATUS']==3)){ ?>
	<div class="col-md-4">
					<div class="search">
						<form id="search-form" action="index.php" method="GET">
							<input type="text" name="search-text" placeholder="<?php if(isset($_GET['search-text'])){echo $_GET['search-text'];}else{echo "Поиск пользователя";} ?>" class="search__input">
							<button form="search-form" class="search__img"><img style="position: relative; top: -100px;" src="../img/search.png" alt="search" ></button>
						</form>
						<form id="filter" action="index.php" method="GET">
							<h4 class="category__name">
								Возраст пользователя
							</h4>
							
								<input id="checkbox1" type="checkbox" name="teen" class="category__chexbox" <?php if(isset($_GET['teen'])){echo "checked";} ?>>
								<label for="checkbox1" class="category__label">16 - 25 гг</label>
							
								<input id="checkbox2" type="checkbox" name="young" class="category__chexbox" <?php if(isset($_GET['young'])){echo "checked";} ?>>
								<label for="checkbox2" class="category__label">25 - 35гг</label>
								
								<input id="checkbox3" type="checkbox" name="old" class="category__chexbox" <?php if(isset($_GET['old'])){echo "checked";} ?>>
								<label for="checkbox3" class="category__label">35+</label>

							<h4 class="category__name">
								Пол
							</h4>
								<input id="checkbox4" type="checkbox" name="sex_male" class="category__chexbox" <?php if(isset($_GET['sex_male'])){echo "checked";} ?>>
								<label for="checkbox4" class="category__label">М</label>
							
								<input id="checkbox5" type="checkbox" name="sex_female" class="category__chexbox" <?php if(isset($_GET['sex_female'])){echo "checked";} ?>>
								<label for="checkbox5" class="category__label">Ж</label>

								<h4 class="category__name">
								Статус
							</h4>
								<input id="checkbox6" type="checkbox" name="performer" class="category__chexbox" <?php if(isset($_GET['performer'])){echo "checked";} ?>>
								<label for="checkbox6" class="category__label">Исполнитль</label>
							
								<input id="checkbox7" type="checkbox" name="user" class="category__chexbox" <?php if(isset($_GET['user'])){echo "checked";} ?>>
								<label for="checkbox7" class="category__label">Заказчик</label>
							

							<button form="filter" class="cetegory__btn_left">Показать</button>
							<button form="reset-form" class="cetegory__btn_right">Сбросить</button>
						</form>
						<form style="display: none;" id="reset-form" action="index.php">
						</form>
					</div>
				</div>
			<?php } ?>
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
			min-width: 1280px;
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
		.wrapper_show_users{
			position: absolute;
			margin: auto auto 30px 15%;
			box-shadow: 4px 5px 8px #494949;
			max-width: 700px;
			padding: 20px;
			top: 150px;
			background-color: white;
			right: 540px;
			width: 700px;
		}
		.user_div{
			left: 0;
			width: 100%;
			background-color: #ebebeb;
			border-radius: 4px;
			padding: 10px;
			position: relative;
			height: 50px;
			margin-bottom: 10px;
		}
		.user_name{
			left: 10px;
			top: 0;
			position: absolute;
		}
		.user_status{
			right: 10px;
			top: 0;
			position: absolute;
		}
		.to_user_page{
			text-decoration: none;
			bottom: 5px;
			right: 10px;
			position: absolute;
			font-size: small;
		}
		.col-md-4{
			width: auto;
			position: fixed;
			right: 160px;
			top: 100px;
		}
		.admin_menu_item:hover{
			background-color: white;
			color: white;
		}
        .save_settings{
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
	</style>

	<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js" integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../slick/slick.min.js"></script>
	<script type="text/javascript" src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/js.js"></script>
                                
    <script type="text/javascript">
        var is_changed = false;
        var is_first = true;
        <?php
        for($i=1; $i<=$users_counter_for_prices; $i++){
            ?>
            $('#user_price_<?php echo $i ?>').on('input keyup', function(){
                var my_int = parseInt(($('#user_price_<?php echo $i ?>').attr('value')), 10);
                $('#user_price_<?php echo $i ?>').attr('value', my_int);
                if(is_first){
                    is_changed = true;
                    is_first = false;
                }
                if(is_changed){
                    is_changed = false;
                    alert('Чтобы изменения вступили в силу нажмите кнопку справа снизу!');
                }
            })
            <?php
        }
        ?>
        $('.user_div').mouseenter(function(){
            var user_div_index = $('.user_div').index(this);
            $('.make_moderator_button').eq(user_div_index).css('display', 'block');
        })
        $('.user_div').mouseleave(function(){
            var user_div_index = $('.user_div').index(this);
            $('.make_moderator_button').eq(user_div_index).css('display', 'none');
        })
    </script>

</body>
</html>