<?php
session_start();
//unset($_SESSION['Cart']); 將$_SESSION['Cart']紀錄清除
$is_existed = "false";  //一開始預設是還沒被加過的 

//判斷式一 -------如果商品重覆被加入，就跳出商品已經被加入的訊息--""判斷商品是否重複""
//要先確認$_SESSION是不是有存在，且如果$_SESSION真的存在的話要不等於空值
if (isset($_SESSION['Cart']) && $_SESSION['Cart'] != null) {
    //跑迴圈--當$i(產品數量)< $_SESSION['Cart']的數量時，就累加
    for ($i = 0; $i < count($_SESSION['Cart']); $i++) {
        //判斷--如果商品ID和$_SESSION['Cart']中的ID有重覆時，就跳出商品已加入購物車的訊息(跑迴圈時就要開始進行比對)
        if ($_POST['product_id'] == $_SESSION['Cart'][$i]['product_id']) { //[$i]--表示第幾個產品的productID
            //如果比對成功，$is_existed變成true，就會跳出頁面
            $is_existed = "true";
            goto_previousPage($is_existed);
        }
    }
}

if ($is_existed == "false") {  //判斷式二-----如果商品不存在，就將這個$temp的陣列加入到$_SESSION中---""判斷商品有沒有存在""
    //將接收到的資料存到$temp陣列中
    //用$temp接收productID
    //$temp是一個變數的陣列，因此名稱可以自訂
    $temp['product_id'] = $_POST['product_id'];
    $temp['product_name'] = $_POST['product_name'];
    $temp['pic'] = $_POST['pic'];
    $temp['price'] = $_POST['price'];
    $temp['quantity'] = $_POST['quantity'];

    //將$temp陣列印出來(確認資料有放入)
    //print_r($temp);

    //將陣列資料加入到$_SESSION Cart中
    //$_SESSION['Cart'---總欄位名稱][這個欄位就是上面price、name、ID等的欄位]
    $_SESSION['Cart'][] = $temp;
    goto_previousPage($is_existed);
}
//將存入$_SESSION的資料印出來
//print_r($_SESSION['Cart']);

//當一直點加入購物車的時候，$_SESSION就會一直"重複"存入商品，因此要給他一個判斷式，當商品重覆加入購物車時會跳出已經加入該商品的訊息


// goto_previousPage 的function
function goto_previousPage($is_existed)
{
    $location = $_SERVER['HTTP_REFERER']; //HTTP_REFERER--回到上一頁
    $location .= "&Existed=" . $is_existed; //"."等於連接的意思  用$is_existed這個參數判斷到底有沒有被加入過在這個$_SESSION裡面
    //echo $location . "<br>"; //叫出網址
    header(sprintf("Location: %s", $location));
}
