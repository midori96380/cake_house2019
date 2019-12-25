<?php
require_once("../is_login.php");
require('../../function/connection.php'); 
if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){//判斷式判斷如果AddForm回傳的值是INSERT，就執行下面的程式

  $sql= "INSERT INTO members  (level, account, name, phone, email, birthday, address, created_at) VALUES ( :level, :account, :name, :phone, :email, :birthday, :address, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":level", $_POST['level'], PDO::PARAM_INT);          
  $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_INT);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
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
          <h1 class="mb-4">會員管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">會員管理</li>
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="created.php" >
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">會員等級</label>
              <div class="col-10">
                <input type="text" class="form-control" id="level" name="level"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">帳號</label>
              <div class="col-10">
                <input type="text" class="form-control" id="account" name="account"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">姓名</label>
              <div class="col-10">
              <input type="text" class="form-control" id="name" name="name"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">電話</label>
              <div class="col-10">
              <input type="text" class="form-control" id="phone" name="phone"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">電子郵件</label>
              <div class="col-10">
              <input type="text" class="form-control" id="email" name="email"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">生日</label>
              <div class="col-10">
              <input type="text" class="form-control" id="birthday" name="birthday"> </div>
            </div>
            <div class="form-group row">
            <label for="inputpasswordh" class="col-2 col-form-label">地址</label>
              <div class="col-10">
              <input type="text" class="form-control" id="address" name="address"></div>
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
<script>
$(function(){
  $( "#birthday" ).datepicker({
    dateFormat: "yy-mm-dd"
});


tinymce.init({
  selector: 'textarea#content',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  ' bold italic backcolor | alignleft aligncenter ' +
  ' alignright alignjustify | bullist numlist outdent indent |' +
  ' removeformat | help',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tiny.cloud/css/codepen.min.css'
  ]
});
});
</script>

</html>