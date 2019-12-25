<!-- 此 php 程式是藉由呼叫connection.php來顯示 sql 新增的資料-->
<?php
require_once("../../function/connection.php");
$query = $db->query("SELECT * From customer_orders");
$customers = $query->fetchAll(PDO::FETCH_ASSOC);

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
          <h1 class="mb-4">顧客管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> Home</a> </li>
            <li class="breadcrumb-item active">Link</li>
            <li class="breadcrumb-item active">Link</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">姓名</th>
                <th scope="col">電話</th>
                <th scope="col">地址</th>
                <th scope="col">付費方式</th>
                <th scope="col">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($customers as $one_customer){ ?>
              <tr>
                <td><?php echo $one_customer['name']; ?></td>
                <td><?php echo $one_customer['phone']; ?></td>
                <td><?php echo $one_customer['address']; ?></td>
                <td><?php echo $one_customer['pay_method']; ?></td>
                <td contenteditable="true" draggable="true">
                  <a class="btn btn-info" href="#">編輯</a>
                  <a class="btn btn-info" href="#">刪除</a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>

</html>