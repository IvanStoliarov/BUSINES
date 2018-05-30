<?
session_start();
$connection = mysqli_connect("localhost", "root", "qweqwe123", "OT");

$result=mysqli_fetch_assoc(mysqli_query(mysqli_connect("localhost", "root", "qweqwe123", "OT"), "SELECT * FROM `ADMIN` WHERE ID='1'"));

$hash = sha1($_POST['notification_type'].'&'.
$_POST['operation_id'].'&'.
$_POST['amount'].'&'.
$_POST['currency'].'&'.
$_POST['datetime'].'&'.
$_POST['sender'].'&'.
$_POST['codepro'].'&'.
$result['YAMONEY_SECRET'].'&'.
$_POST['label']);





if ( $_POST['sha1_hash'] != $hash or $_POST['codepro'] === true or $_POST['unaccepted'] === true ) exit('error');



// ЗДЕСЬ ЗАПИСЬ В БД ИНФОРМАЦИИ О ПЛАТЕЖЕ //

        $tarif_id=0;
            if(isset($_SESSION['post']['tarif_id'])){
                $tarif_id=$_SESSION['post']['tarif_id'];
            }
            if($tarif_id==0&&!isset($_SESSION['post']['orders_quantity'])){
                $first_checker=true;
                foreach ($_SESSION['choosen_performers'] as $value) {
                    $sum=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$value."'"))['PRICE'];
                    mysqli_query($connection, "INSERT INTO `ORDERS` (PERFORMER_ID, CLIENT_ID, PRICE, STATUS, TARIF_ID, DESCRIPTION) VALUES ('".$value."', '".$_SESSION['logged_user']['ID']."', '".$sum."', '1', '".$tarif_id."', '".$_SESSION['post']['text']."')");
                    mysqli_query($connection, "INSERT INTO `MAILS` (STATUS, TYPE, TO_ID, FROM_ID, MESSAGE_TEXT, DATE) VALUES ('2', '1', '".$value."', '".$_SESSION['logged_user']['ID']."', 'Вы выбраны исполнителем пользователем ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".date('Y-m-d H:i:s')."')");
                }
            }elseif($tarif_id!=0&&!isset($_SESSION['post']['orders_quantity'])){
                $selected_tarif=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `TARIFS` WHERE ID='".$tarif_id."'"));
                $select_best_query=mysqli_query($connection, "SELECT * FROM `USERS` WHERE (STATUS='2' OR STATUS='4') ORDER BY (GRANTED_ORDERS-DENIED_ORDERS) DESC LIMIT 0, ".$selected_tarif['ORDERS_QUANTITY']);
                while($res=mysqli_fetch_assoc($select_best_query)){
                    mysqli_query($connection, "INSERT INTO `ORDERS` (PERFORMER_ID, CLIENT_ID, PRICE, STATUS, TARIF_ID, DESCRIPTION) VALUES ('".$res['ID']."', '".$_SESSION['logged_user']['ID']."', '".($selected_tarif['PRICE']/$selected_tarif['ORDERS_QUANTITY'])."', '1', '".$tarif_id."', '".$_SESSION['post']['text']."')");
                    mysqli_query($connection, "INSERT INTO `MAILS` (STATUS, TYPE, TO_ID, FROM_ID, MESSAGE_TEXT, DATE) VALUES ('2', '1', '".$res['ID']."', '".$_SESSION['logged_user']['ID']."', 'Вы выбраны исполнителем пользователем ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".date('Y-m-d H:i:s')."')");
                }
            }elseif(isset($_SESSION['post']['orders_quantity'])&&($tarif_id==0)){
                $select_best_query=mysqli_query($connection, "SELECT * FROM `USERS` WHERE (STATUS='2' OR STATUS='4') ORDER BY (GRANTED_ORDERS-DENIED_ORDERS) DESC LIMIT 0, ".$_SESSION['post']['orders_quantity']);
                while ($res=mysqli_fetch_assoc($select_best_query)) {
                    mysqli_query($connection, "INSERT INTO `ORDERS` (PERFORMER_ID, CLIENT_ID, PRICE, STATUS, TARIF_ID, DESCRIPTION) VALUES ('".$res['ID']."', '".$_SESSION['logged_user']['ID']."', '".$res['PRICE']."', '1', '0', '".$_SESSION['post']."')");
                    mysqli_query($connection, "INSERT INTO `MAILS` (STATUS, TYPE, TO_ID, FROM_ID, MESSAGE_TEXT, DATE) VALUES ('2', '1', '".$res['ID']."', '".$_SESSION['logged_user']['ID']."', 'Вы выбраны исполнителем пользователем ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".date('Y-m-d H:i:s')."')");
                }
            }elseif(isset($_SESSION['post']['orders_quantity'])&&($tarif_id!=0)){
                $selected_tarif=mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `TARIFS` WHERE ID='".$tarif_id."'"));
                $select_best_query=mysqli_query($connection, "SELECT * FROM `USERS` WHERE (STATUS='2' OR STATUS='4') ORDER BY (GRANTED_ORDERS-DENIED_ORDERS) DESC LIMIT 0, ".$_SESSION['post']['orders_quantity']);
                while($res=mysqli_fetch_assoc($select_best_query)){
                    mysqli_query($connection, "INSERT INTO `ORDERS` (PERFORMER_ID, CLIENT_ID, PRICE, STATUS, TARIF_ID, DESCRIPTION) VALUES ('".$res['ID']."', '".$_SESSION['logged_user']['ID']."', '".($selected_tarif['PRICE']/$selected_tarif['ORDERS_QUANTITY'])."', '1', '".$tarif_id."', '".$_SESSION['post']['text']."')");
                    mysqli_query($connection, "INSERT INTO `MAILS` (STATUS, TYPE, TO_ID, FROM_ID, MESSAGE_TEXT, DATE) VALUES ('2', '1', '".$res['ID']."', '".$_SESSION['logged_user']['ID']."', 'Вы выбраны исполнителем пользователем ".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['LOGIN']."', '".date('Y-m-d H:i:s')."')");
                }
            }
        mysqli_query($connection, "UPDATE `USERS` SET BALANCE='".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['BALANCE']-$_SESSION['post']['price_from_balance']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
        mysqli_query($connection, "INSERT INTO `PAYMENTS` (AMOUNT, PAYMENT_SERVICE, PAYMENT_TYPE) VALUES ('".$_SESSION['post']['sum']."', '1', '1')");

        unset($_SESSION['post']);
        unset($_SESSION['choosen_performers']);

?>

<script type="text/javascript">
    window.location.href='../../../cabinet.php';
</script>