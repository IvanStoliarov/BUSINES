<?php
require 'db_connect.php';

$result=mysqli_query($connection, "UPDATE `MAILS` SET STATUS='1' WHERE TO_ID='".$_SESSION['logged_user']['ID']."' AND TYPE='1'");

?>