<?php
require 'db_connect.php';

mysqli_query($connection, "INSERT INTO `MAILS` (FROM_ID, TO_ID, MESSAGE_TEXT, STATUS, TYPE, DATE) VALUES ('".$_SESSION['logged_user']['ID']."', '".$_POST['to_id']."', '".$_POST['message_body']."', '2', '2', '".date('Y-m-d H:i:s')."')");

if(isset($_POST['from'])){
    ?>
    <script type="text/javascript">
		window.location.href="<?php echo $_POST['from'] ?>";
	</script>
        <?php
}else{
    ?>
    <script type="text/javascript">
		window.location.href="../cabinet.php";
	</script>
        <?php
}
?>

