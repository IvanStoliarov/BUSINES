<?php
require 'db_connect.php';

$result=mysqli_query($connection, "UPDATE * FROM `MAILS` SET STATUS='1' WHERE TO_ID='".$_SESSION['logged_user']['ID']."' AND TYPE='1'");
mysqli_set_charset($connection, 'utf8');
?>
<script type="text/javascript">
	alert('<?php echo $result ?>');
</script>