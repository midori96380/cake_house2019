<?php
require_once("../is_login.php");
require('../../function/connection.php'); 
if(isset($_POST['AddForm']) && $_POST['AddForm'] == "INSERT"){//判斷式判斷如果AddForm回傳的值是INSERT，就執行下面的程式
if(!file_exists('../../uploads/news')){   //if判斷式，判斷若是沒有uploads的資料夾，就創建一個(1.要設置路徑；2.新增資料夾使用mkdir)
  mkdir('../../uploads/news',0755,true);  //0755是可編輯權限的(僅可讀寫的狀態)，0777(開全部權限)則有資安問題
}
  if(isset($_FILES['picture']['name'])){
    $filename = $_FILES['picture']['name'];
    $file_path="../../uploads/news/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = 'lanlancat1.jpg';
  }

  $sql= "INSERT INTO news  (picture, published_at, title, content, created_at) VALUES ( :picture, :published_at, :title, :content, :created_at)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);          //上方已經將picture的變數名修改成$filename並且暫存，所以帶入值要修改成$filename
  $sth ->bindParam(":published_at", $_POST['published_at'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
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
          <h1 class="mb-4">最新消息管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">最新消息管理</li>
            <li class="breadcrumb-item active">新增一筆</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="created.php" enctype="multipart/form-data"><!--圖片上傳一定要加上這個屬性，不然圖片上不去-->
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10 text-left"><!--text-left要放在引號之中-->
                 <!--想新增事項：上傳圖片時不是只出現檔案文字，是直接出現照片-->
                <input type="file" class="form-control-file" id="picture" name="picture"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">發佈日期</label>
              <div class="col-10">
                <input type="text" class="form-control" id="published_at" name="published_at"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
              <div class="col-10">
                <textarea class="form-control" id="content" name="content"></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否進行新增？')){return false;};">確認</button>
            <input type="hidden" name="created_at" value="<?php echo date('y-m-d H:i:s') ?>">   <!--type="hidden"將這行隱藏(創建的日期)-->
            <input type="hidden" name="AddForm" value="INSERT">
            <input type="hidden" name="picture" value="<?php echo $_POST['picture']; ?>">
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
// //summernote的function
//   $('#content').summernote();
// });

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