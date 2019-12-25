<?php
//判斷user是否存在
session_start();    //每個需要存取的php都要加上session_start，才能運行

require_once("../function/connection.php");
//從資料庫中進行提取資料，login是提取admin中的account與password，有限定的資料，所以要使用WHERE做搜尋，另account、password是字串，所以要再多給他一個引號
$query = $db->query("SELECT * From admin WHERE account='".$_POST['account']."' AND password='".$_POST['password']."'");
$user = $query->fetch(PDO::FETCH_ASSOC);    //只提取一筆，用fetch
if(isset($user) && $user['account'] !=null){
    $_SESSION['user'] = $user;
    header('Location: news/list.php');
}else{
    header("Location: login.php?MSG=error");
}

?>