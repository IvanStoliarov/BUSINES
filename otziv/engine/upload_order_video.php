<?php
require "db_connect.php";
	
	function file_extension($file){
		if($file=="video/mp4"){
			return ".mp4";
		}
		if($file=="video/avi" || $file="video/msvideo"){
			return ".avi";
		}
	}

    $url=stristr($_POST['order_video_url'], "watch?v");
    $url=str_replace("watch?v=", "", $url);
	mysqli_query($connection, "UPDATE `ORDERS` SET ORDER_VIDEO_URL='".$url."' WHERE ID='".$_POST['order_id']."'");
	mysqli_query($connection, "UPDATE `ORDERS` SET STATUS='2' WHERE ID='".$_POST['order_id']."'");

?>
<script type="text/javascript">
	window.location.href='../cabinet.php';
</script>