<?php
//限制存取頁面(後台安全性做限制，每一個相連的php檔都要設定，才能夠避免資料直接被讀取)

session_start();    
//!isset($_SESSION['user'])表示user是空值；$_SESSION['user']['account'] == null 表示如果這個是空值
if(!isset($_SESSION['user']) && $_SESSION['user']['account'] == null){
    header('Location: ../login.php?MSG=please_login');

}

?>