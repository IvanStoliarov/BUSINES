<?php
require "engine/db_connect.php";


$_SESSION['post']=$_POST;


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" />
	
        <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>

        <form id="granted_payment" method="POST">
            <input type="hidden" name="check_granted_payment" form="granted_payment">
        </form>

        <div class="select_payment_method_div">
            <h2 class="choose_payment_method_header">Выберите платёжную систему</h2>
            <a href="payment/yandex/form/YandexMoneyCashin.php"><img class="payment_logo" src="img/yamoney_logo.png"></a>
            <a href="payment/qiwi/form/qiwi_cah_in.php"><img class="payment_logo" src="img/qiwi_logo.png"></a>
        </div>
        
        <style type="text/css">
            .payment_logo{
                width: 225px;
                height: 225px;
                border-radius: 3px;
            }
            .payment_logo:hover{
                background: grey;
                box-shadow: 2px 2px 2px 2px #6d80a0;
            }
            .select_payment_method_div{
                top: 200px;
                margin: auto;
                position: relative;
                max-width: 60%;
                text-align: center;
                float: none;
            }
            a{
                text-decoration: none;
            }
            a:hover{
                text-decoration: none;
            }
        </style>
        
        <script
                  src="https://code.jquery.com/jquery-1.12.4.min.js"
                  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                  crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
                  integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0="
                  crossorigin="anonymous"></script>
        <script type="text/javascript" src="slick/slick.min.js"></script>
        <script type="text/javascript" src="js/jquery.magnific-popup.min.js"></script>
        <script src="js/js.js"></script>
        
    </body>
</html>