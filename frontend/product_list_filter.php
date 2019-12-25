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
    <!-- 資料集區段 -->
    <?php                                                               //php的連接要用"."
    $query = $db->query("SELECT * From products WHERE product_categoryID=" . $_GET['categoryID'] . " Order By created_at DESC");
    $products = $query->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <!-- End 資料集區段 -->
    <!-- *** NAVBAR END *** -->

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><a href="../index.php">首頁</a>
                        </li>
                        <li><a href="product_list.php">產品介紹
                        </li>
                        <li>><a href="product_list_filter.php">產品分類
                        </li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">產品分類</h3>
                        </div>

                        <div class="panel-body">
                            <ul class="nav nav-pills nav-stacked category-menu">
                                <?php foreach ($categories as $one_category) {
                                    $query = $db->query("SELECT * From products WHERE product_categoryID=" . $one_category['product_categoryID']);
                                    $product_name = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $total_product = count($product_name);
                                ?>
                                    <li>
                                        <a href="product_list_filter.php?categoryID=<?php echo $one_category['product_categoryID']; ?>"><?php echo $one_category['category']; ?><span class="badge pull-right"><?php echo $total_product ?></span></a>
                                    </li>
                                    <!-- href要將資料帶出(ID要設對，不然抓不到)，後面是要顯示資料表的資料 -->
                                <?php } ?>
                            </ul>

                        </div>
                    </div>




                    <!-- *** MENUS AND FILTERS END *** -->

                    <div class="banner">
                        <a href="#">
                            <img src="../images/ad-banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                </div>

                <div class="col-md-9">

                    <div class="row">
                        <div class="col-sm-12">
                            <?php foreach ($products as $one_product) { ?>
                                <div class="col-sm-3">
                                    <div class="product">
                                        <div class="flip-container">
                                            <div class="flipper">
                                                <div class="front">
                                                    <a href="product.php?productID=<?php echo $one_product['productID']; ?>">
                                                        <img src="../uploads/products/<?php echo $one_product['picture']; ?>" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                                <div class="back">
                                                    <a href="product.php?productID=<?php echo $one_product['productID']; ?>">
                                                        <img src="../uploads/products/<?php echo $one_product['picture']; ?>" alt="" class="img-responsive">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <a href="product.php?productID=<?php echo $one_product['productID']; ?>" class="invisible">
                                            <img src="../uploads/products/<?php echo $one_product['picture']; ?>" alt="" class="img-responsive">
                                        </a>
                                        <div class="text">
                                            <h3><a href="product.php?productID=<?php echo $one_product['productID'] ?>"><?php echo $one_product['name']; ?></a></h3>
                                            <p class="price">$NT <?php echo $one_product['price']; ?></p>
                                        </div>
                                        <!-- /.text -->

                                        <div class="ribbon new">
                                            <div class="theribbon">NEW</div>
                                            <div class="ribbon-background"></div>
                                        </div>

                                        <!-- /.ribbon -->
                                        <div class="ribbon sale">
                                            <div class="theribbon">SALE</div>
                                            <div class="ribbon-background"></div>
                                        </div>


                                    </div>
                                    <!-- /.product -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <?php require_once('template/footer.php'); ?>





</body>

</html>