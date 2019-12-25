<?php
require_once("../is_login.php");
require('../../function/connection.php'); 
if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){//判斷式判斷如果AddForm回傳的值是INSERT，就執行下面的程式
  $sql= "INSERT INTO product_categories (category, created_at) VALUES ( :category, :created_at)";
  $sth = $db ->prepare($sql);      
  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":created_at", $_POST['created_at'], PDO::PARAM_STR);
  $sth ->execute();


  header('Location: list.php');
}
?>

<!DOCTYPE html>
<html>

<head>
<?php include_once('../layouts/header.php'); ?>
<link rel="stylesheet" href="../../js/jquery-ui/jquery-ui.min.css">
<!-- <link rel="stylesheet" href="../../js/summernote/summernote-bs4.css"> -->



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
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="created.php">
          
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">產品分類</label>
              <div class="col-10">
                <input type="text" class="form-control" id="category" name="category"></div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否進行新增？')){return false;};">確認</button>
            <input type="hidden" name="created_at" value="<?php echo date('y-m-d H:i:s') ?>">   <!--type="hidden"將這行隱藏(創建的日期)-->
            <input type="hidden" name="AddForm" value="INSERT">
          
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>


</html>