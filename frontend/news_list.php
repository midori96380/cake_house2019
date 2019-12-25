<?php
require_once("../function/connection.php");
$query = $db->query("SELECT * From news Order By published_at DESC");
$news = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        Cake House : 帶給你最天然健康的幸福滋味
    </title>

    <meta name="keywords" content="">

    <?php require_once('template/head_files.php'); ?>



</head>

<body>
    <?php require_once('template/navbar.php'); ?>

    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <!-- *** LEFT COLUMN ***
		     _________________________________________________________ -->

                <div class="col-sm-9" id="blog-listing">

                    <ul class="breadcrumb">

                        <li><a href="#">首頁</a>
                        </li>
                        <li>最新消息</li>
                    </ul>
                    <!-- 最新消息更新，只保留一組class="post"做迴圈，迴圈要放在class="post"的上方，要將它整個包起來，才能運行，不然會出現error -->
                    <?php foreach ($news as $one_news) { ?>
                        <div class="post">
                            <!-- title、published_at、content都使用echo從後端資料庫叫出資料 -->
                            <h2><a href="news.php?newsID=<?php echo $one_news['newsID']; ?>"><?php echo $one_news['title']; ?></a></h2>

                            <hr>
                            <p class="date-comments">
                                <a href="news.php?newsID=<?php echo $one_news['newsID']; ?>"><i class="fa fa-calendar-o"></i><?php echo $one_news['published_at']; ?></a>

                            </p>
                            <!--  mb_strimwidth($data['content'],0,180,"...")是截短字串的程式，前面的數字0是表示從開頭第一個字開始，180是截斷的字元是180，"..."表示後面被截斷的字用"..."表示 -->
                            <!-- strip_tags($data['content']) 是將所有的字都轉成純文字，HTML會影響帶到的資料，怕會跑版，所以加上這行程式避免被HTML影響到 -->
                            <p class="intro"><?php echo mb_strimwidth(strip_tags($one_news['content']), 0, 180, "..."); ?></p>
                            <p class="read-more"><a href="news.php?newsID=<?php echo $one_news['newsID']; ?>" class="btn btn-primary">了解更多</a>
                            </p>
                        </div>

                    <?php } ?>


                    <ul class="pagination">
                        <li class="page-item">

                            <!-- 頁數超過1，上一頁可連結 -->
                            <a class="page-link" href="news_list.php">
                                <span>«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="news_list.php">1</a>
                        </li>

                        <li class="page-item">

                            <a class="page-link" href="news_list.php">
                                <span>»</span>
                                <span class="sr-only">Next</span>
                            </a>

                        </li>
                    </ul>



                </div>
                <!-- /.col-md-9 -->

                <!-- *** LEFT COLUMN END *** -->


                <div class="col-md-3">
                    <!-- *** BLOG MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">最新優惠</h3>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** BLOG MENU END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="../images/ad-banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>


            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <?php require_once('template/footer.php'); ?>






</body>

</html>