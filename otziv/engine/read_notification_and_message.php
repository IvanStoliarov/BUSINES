<?php
require 'db_connect.php';

mysqli_query($connection, "UPDATE `MAILS` SET STATUS='1' WHERE ID='".$_GET['notification_id']."'");
?>