
<?php
require_once("../is_login.php");
require_once("../../function/connection.php");

if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  $sql= "UPDATE members SET level=:level, account=:account, name=:name, phone=:phone, email=:email, birthday=:birthday, address=:address, updated_at=:updated_at WHERE memberID=:memberID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":level", $_POST["level"], PDO::PARAM_STR);
  $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_INT);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
  $sth ->execute();
   header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM members WHERE memberID =".$_GET['memberID']);
  $one_member = $query->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="mb-4">會員管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">會員管理</li>
            <li class="breadcrumb-item active">資料更新系統</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php">

            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">等級</label>
              <div class="col-10">
                <input type="text" class="form-control" id="level" name="level" value="<?php echo $one_member['level']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">帳號</label>
              <div class="col-10">
                <input type="text" class="form-control" id="account" name="account" value="<?php echo $one_member['account']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">姓名</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $one_member['name']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">電話</label>
              <div class="col-10">
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $one_member['phone']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">電子郵件</label>
              <div class="col-10">
                <input type="text" class="form-control" id="email" name="email" value="<?php echo $one_member['email']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">生日</label>
              <div class="col-10">
                <input type="text" class="form-control" id="birthday" name="birthday" value="<?php echo $one_member['birthday']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">地址</label>
              <div class="col-10">
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $one_member['address']; ?>"> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否進行更新？')){return false;};">確認</button>
            <input type="hidden" name="updated_at" value="<?php echo date('y-m-d H:i:s') ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="memberID" value="<?php echo $_GET['memberID'] ?>">

          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>
<script>
$(function(){
  $( "#published_at" ).datepicker({
    dateFormat: "yy-mm-dd"
});
});

</script>
</html>