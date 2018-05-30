<?php
session_start();
$connection = mysqli_connect("localhost", "root", "qweqwe123", "OT");

$result=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `ADMIN` WHERE ID='1'"));

if(isset($_POST['payment_service'])&&isset($_POST['label'])&&isset($_POST['sum'])&&($_POST['label']!="")&&($_POST['sum']!="")){
    if(mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION.['logged_user']['ID']."'"))['BALANCE']<$_POST['sum']){
        ?>
        <script type="text/javascript">
            alert('У вас на балансе нет столько денег!');
        </script>
        <?php
    }else{
        mysqli_query($connection, "UPDATE `USERS` SET BALANCE='".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['BALANCE']-$_POST['sum']."'");
        mysqli_query($connection, "INSERT INTO `MAILS` (TO_ID, MESSAGE_TEXT, DATE, TYPE, STATUS) VALUES ('".$_SESSION['logged_user']['ID']."', 'Ваша заявка на вывод средств принята на рассмотрение', '".date('Y-m-d H:i:s')."', '1', '2')");
        mysqli_query($connection, "INSERT INTO `PAYMENTS` (AMOUNT, FROM_ID, WALLET, PAYMENT_SERVICE, PAYMENT_TYPE, STATUS) VALUES ('".$_POST['sum']."', '".$_SESSION['logged_user']['ID']."', '".$_POST['label']."', '".$_POST['payment_service']."', '2', '1')"); 
        ?>
        <script type="text/javascript">
            window.location.href='../cabinet.php';
        </script>
        <?php
    }
}

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
       <form class="payment_form" method="POST">
            <img class="payment_service_header_logo" src="../../../img/yamoney_header_photo.png"><br>
            <label id="helper" for="select_payment_service">выберите платёжную систему</label>
            <select id="select_payment_service" name="payment_service">
                <option value="1">Яндекс деньги</option>
                <option value="2">Qiwi кошелёк</option>
            </select><br>
            <input type="text" name="label" placeholder="Номер кошелька" <?php if(isset($_POST['label'])){ echo $_POST['label']; } ?>><br> 
            <input id="payment_amount" type="text" name="sum" placeholder="Сумма" <?php if(isset($_POST['sum'])){ echo $_POST['sum']; } ?>><br>
            <input type="submit" value="Оплатить"> 
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
            var current_balance = '<?php echo mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['BALANCE'] ?>';
            $('#payment_amount').on('click', function(){
                if($('#payment_amount').attr('value')==""){
                    $('#payment_amount').attr('value', '0');
                }
            })
            $('#payment_amount').on('keyup', function(){
                if($('#payment_amount').attr('value')==""){
                    $('#payment_amount').attr('value', '0');
                }
                $('#payment_amount').attr('value', parseInt($('#payment_amount').attr('value'), 10));
                if($('#payment_amount').attr('value')>current_balance){
                    $('#payment_amount').attr('value', current_balance);
                    alert('У вас на балансе только '+current_balance+' руб.');
                }
            })
            $('#select_payment_service').on('change', function(){
                if($('#select_payment_service').attr('value')==1){
                    $('.payment_service_header_logo').eq(0).attr('src', '../../../img/yamoney_header_photo.png');
                    $('#helper').hide('100');
                }else{
                    $('.payment_service_header_logo').eq(0).attr('src', '../../../img/qiwi_header_logo.png');
                    $('#helper').hide('100');
                }
            })
        </script>
        
    </body>
</html>
