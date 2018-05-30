<?php
require 'db_connect.php';

mysqli_query($connection, "UPDATE `USERS` SET PROMO_URL='".$_GET['promo_url']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
mysqli_query($connection, "UPDATE `USERS` SET EMAIL='".$_GET['email']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
if($_GET['birth_date']!='0000-00-00'&&$_GET['birth_date']!=''){
	mysqli_query($connection, "UPDATE `USERS` SET BIRTH_DATE='".$_GET['birth_date']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
}

?>
<script type="text/javascript">
	window.location.href='../cabinet.php';
</script>
