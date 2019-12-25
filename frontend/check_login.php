<?php
session_start();
require_once("../function/connection.php");

$query = $db->query("SELECT * From members WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'");
$member = $query->fetch(PDO::FETCH_ASSOC);    //只提取一筆，用fetch
if(isset($member) && $member['account'] !=null){
    $_SESSION['member'] = $member;
    header('Location: customer-account.php');
}else{
    header("Location: login_error.php");
}
?>