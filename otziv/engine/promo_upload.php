<?php
require "db_connect.php";
		
		if(isset($_POST['sex'])&&isset($_POST['date'])&&isset($_POST['youtube_url'])){
            $url=stristr($_POST['youtube_url'], "watch?v");
            $url=str_replace("watch?v=", "", $url);
			//вносим в БД пол и дату рождения
			mysqli_query($connection, "UPDATE `USERS` SET SEX='".$_POST['sex']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
			mysqli_query($connection, "UPDATE `USERS` SET BIRTH_DATE='".$_POST['date']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
			mysqli_query($connection, "UPDATE `USERS` SET STATUS='4' WHERE ID='".$_SESSION['logged_user']['ID']."'");
			mysqli_query($connection, "UPDATE `USERS` SET PROMO_URL='".$url."' WHERE ID='".$_SESSION['logged_user']['ID']."'");

			?>
			<script type="text/javascript">
				window.location.href = "../cabinet.php?succes_performer=1";
			</script>
			<?php
		}elseif(!isset($_POST['sex'])){
			?>
			<script type="text/javascript">
				alert('Вы не выбрали пол!');
			</script>
			<script type="text/javascript">
				window.location.href = "../cabinet.php?succes_performer=0";
			</script>
			<?php
		}elseif(!isset($_POST['date'])){
			?>
			<script type="text/javascript">
				alert('Вы не выбрали дату рождения!');
			</script>
			<script type="text/javascript">
				window.location.href = "../cabinet.php?succes_performer=0";
			</script>
			<?php
		}elseif(!isset($_POST['youtube_url'])){
			?>
			<script type="text/javascript">
				alert('Ошибка в youtube ссылке!');
			</script>
			<script type="text/javascript">
				window.location.href = "../cabinet.php?succes_performer=0";
			</script>
			<?php
		}else{
			?>
			<script type="text/javascript">
				alert('Произошла какая-то ошибка!');
			</script>
			<script type="text/javascript">
				window.location.href = "../cabinet.php?succes_performer=0";
			</script>
			<?php
		}

?>