<?php
require 'db_connect.php';
mail(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN`"))['EMAIL'], 'Контактная форма-'.$_GET['email'], $_GET['text'], );
?>