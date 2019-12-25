<nav class="navbar navbar-expand-md navbar-light">
    <div class="container"> <a class="navbar-brand text-primary" href="#">
        <i class="fa fa-birthday-cake fa-2x"></i>
        <b> Cake House</b>
      </a> <button class="navbar-toggler navbar-toggler-right border-0" type="button" data-toggle="collapse" data-target="#navbar4" style="">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar4">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="../page/update.php?pageID=1">關於我們管理</a> </li><!--pageID=1強制限定只有第一筆資料可以做修改(關於我們只會有一個)-->
          <li class="nav-item"> <a class="nav-link" href="../news/list.php">最新消息管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="../member/list.php">會員管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="../product_categories/list.php">產品分類管理</a> </li>
          <li class="nav-item"> <a class="nav-link" href="#">訂單管理</a> </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i>使用者</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink"><a href="../logout.php"><span class="dropdown-item-text">登出</span></a></div>
          </li>                                                                 <!--登出的連結要連到logout.php，再由logout.php做是否登出的判斷，這樣才能在login.php的頁面顯示"登出成功"(因判斷式的回傳值是MSG=logout)，若是直接連結login.php就無法回傳logout的值，就不會顯示登出成功的字-->
        </ul>
      </div>
    </div>
  </nav>