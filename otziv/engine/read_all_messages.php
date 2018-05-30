<?php
require 'db_connect.php';

mysqli_query($connection, "UPDATE * FROM `ORDERS` SET STATUS='1' WHERE TO_ID='".$_GET['to_id']."'");
?>