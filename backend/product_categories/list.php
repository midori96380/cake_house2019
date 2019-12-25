<!-- 此 php 程式是藉由呼叫connection.php來顯示 sql 新增的資料-->
<?php
require_once("../is_login.php");
require_once("../../function/connection.php");
$query = $db->query("SELECT * From product_categories");
$categorys = $query->fetchAll(PDO::FETCH_ASSOC);
$total_Rows = count($categorys);

// print_r($news);(此為一開始要確認資料是否有連動到connection.php及mysql時所設定要印出資料的程式碼)
?>

<!DOCTYPE html>
<html>

<head>
<?php include_once('../layouts/header.php'); ?>
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
          </ul>
        </div>
      </div>
      <div class="col-md-12 utility" style="margin-bottom:20px;">
      <a class="btn btn-info" href="created.php">新增一筆</a>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
       
                <th scope="col">產品分類名稱</th>
                <th width="30%">操作</th> <!--欄位寬度直接在標籤中進行增加-->
              </tr>
            </thead>
            <tbody>
            <?php if($total_Rows > 0){ ?>
              <?php foreach($categorys as $one_category){ ?>
              <tr>
                <td><?php echo $one_category['category']; ?></td>
                <td> 
                  <a class="btn btn-info" href="../products/list.php?product_categoryID=<?php echo $one_category['product_categoryID']; ?>">產品管理</a>  <!--這邊開始進行二階式架構，因此要跟著產品分類架構中的ID進行設定-->
                  <a class="btn btn-info" href="update.php?product_categoryID=<?php echo $one_category['product_categoryID']; ?>">編輯</a>
                  <a class="btn btn-info" href="delete.php?product_categoryID=<?php echo $one_category['product_categoryID']; ?>" onclick="if(!confirm('是否確定刪除此筆資料?刪除後無法回復')){return false;};">刪除</a>
                </td>
              </tr>
              <?php } ?>
            <?php }else{ ?>
              <tr>
              <td colspan="3">目前無資料，請新增一筆</td>
              </tr>
            <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>