
<?php
require_once("../is_login.php");
require_once("../../function/connection.php");

if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){

  $sql= "UPDATE product_categories SET category=:category, updated_at=:updated_at WHERE product_categoryID=:product_categoryID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":product_categoryID", $_POST['product_categoryID'], PDO::PARAM_INT);
  $sth ->execute();
  header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM product_categories WHERE product_categoryID =".$_GET['product_categoryID']);
  $one_category = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>

<head>
<?php include_once('../layouts/header.php'); ?>
<link rel="stylesheet" href="../../js/jquery-ui/jquery-ui.min.css">



</head>

<body>
<?php include_once('../layouts/nav.php'); ?>

  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="mb-4">產品分類管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">產品分類管理</li>
            <li class="breadcrumb-item active">分類更新系統</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php">
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">產品分類</label>
              <div class="col-10">
                <input type="text" class="form-control" id="category" name="category" value="<?php echo $one_category['category']; ?>"> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否進行更新？')){return false;};">確認</button>
            <input type="hidden" name="updated_at" value="<?php echo date('y-m-d H:i:s') ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="product_categoryID" value="<?php echo $_GET['product_categoryID']; ?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>