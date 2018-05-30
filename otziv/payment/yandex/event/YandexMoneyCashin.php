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

        mysqli_query($connection, "INSERT INTO `PAYMENTS` (AMOUNT, PAYMENT_SERVICE, PAYMENT_TYPE) VALUES ('".$_POST['amount']."', '1', '3')");
        mysqli_query($connection, "UPDATE `USERS` SET BALANCE='".mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `USERS` WHERE ID='".$_SESSION['logged_user']['ID']."'"))['BALANCE']+$_POST['amount']."' WHERE ID='".$_SESSION['logged_user']['ID']."'");
        
?>

<script type="text/javascript">
    window.location.href='../../../cabinet.php';
</script>