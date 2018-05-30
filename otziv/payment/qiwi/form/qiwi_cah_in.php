<?php
session_start();
$connection = mysqli_connect("localhost", "root", "qweqwe123", "OT");

$result=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width" />
	
        <link rel="stylesheet" type="text/css" href="../../../css/magnific-popup.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
        <link rel="stylesheet" href="../../../font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    </head>
    <body>
       <form class="payment_form" action="../../../payment/qiwi/event/qiwi_cash_in.php" method="post">
           <img class="payment_service_header_logo" src="../../../img/qiwi_header_logo.png"><br>
            <p><input type="text" name="login" placeholder="Логин"></p>
            <p><input type="text" name="voucher" placeholder="Ваучер"></p>
            <p><input type="submit" name="pay"></p>
        </form>

        <style type="text/css">
            .payment_form{
                background-color: white;
                padding: 20px;
                margin: auto;
                max-width: 350px;
                top: 150px;
                position: relative;
                box-shadow: 4px 5px 8px #494949;
                border-radius: 8px;
                text-align: center;
            }
            body{
                background: grey;
            }
            input{
                margin: 4px;
                max-width: 270px;
            }
            .payment_service_header_logo{
                max-width: 250px;  
            }
        </style>
        
        <script
                  src="https://code.jquery.com/jquery-1.12.4.min.js"
                  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
                  crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"
                  integrity="sha256-HmfY28yh9v2U4HfIXC+0D6HCdWyZI42qjaiCFEJgpo0="
                  crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../../slick/slick.min.js"></script>
        <script type="text/javascript" src="../../../js/jquery.magnific-popup.min.js"></script>
        <script src="../../../js/js.js"></script>
        
        <script type="text/javascript">
            var amount = <?php echo $_SESSION['post']['price'] ?>;
            
            $('#payment_amount').on('keyup', function(){
                alert('Сумма к оплате ('+amount+' руб) . Её нельзя поменять!');
                $('#payment_amount').attr('value', amount);
            })
        </script>
        
    </body>
</html>