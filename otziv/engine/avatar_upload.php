<?php
require 'db_connect.php';

function file_extension($file){
		if($file=="image/x-windows-bmp"){
			return ".bmp";
		}
		if($file=="image/jpeg" || $file="image/pjpeg"){
			return ".jpg";
		}
		if($file=="image/png"){
			return ".png";
		}
	}

if((isset($_FILES) && $_FILES['file']['error'] == 0)&&($_FILES['file']['type'] == "image/x-windows-bmp" || $_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/pjpeg" || $_FILES['file']['type'] == "image/png")&&($_FILES['file']['size']<=2000000)){
	$uploaddir = "../img/";
	$temp=$_SESSION['logged_user']['ID']."_avatar".file_extension($_FILES['file']['type']);
	$uploadfile = $uploaddir . $temp;
	//удаляем старый аватар
	if((mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['HAS_AVATAR']==1)&&(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['exAVATAR']=="")){
		$avatar_type=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['AVATAR_TYPE'];
		unlink('../img/'.$_SESSION['logged_user']['ID'].'_avatar'.$avatar_type);
	}
	//добавляем новый аватар
	move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
	mysqli_query($connection, "UPDATE `USERS` SET AVATAR_TYPE='".file_extension($_FILES['file']['type'])."', HAS_AVATAR='1' WHERE ID='".$_SESSION['logged_user']['ID']."'");
	mysqli_query($connection, "UPDATE `USERS` SET exAVATAR='' WHERE ID='".$_SESSION['logged_user']['ID']."'");
	?>
	<script type="text/javascript">
		window.location.href = "../cabinet.php";
	</script>
	<?php
}else{
	if(!($_FILES['file']['type'] == "image/x-windows-bmp" || $_FILES['file']['type'] == "image/jpeg" || $_FILES['file']['type'] == "image/pjpeg" || $_FILES['file']['type'] == "image/png")){
		echo "Не подходящий формат файла!";
	}elseif(!($_FILES['userfile']['size']<=2000000)){
		echo "Слишком большой файл (МАКСИМАЛЬНЫЙ РАЗМЕР 2Мб)";
	}else{
		echo "Фото профиля не загружено!";
	}
	echo "<br>Перенаправляем вас в личный кабинет";
	?>
	<script type="text/javascript">
		setTimeout(function(){window.location.href = "../cabinet.php";}, 3000);
	</script>
	<?php
}

?>