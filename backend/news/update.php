
<?php
require_once("../is_login.php");
require_once("../../function/connection.php");
//updated是要更新單一筆資料，所以呼叫資料表顯示資料時，只用fetch，而不用fetchAll
//$query = $db->query("SELECT * From news WHERE newsID=".$_GET['newsID']);
//$one_news = $query->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] !=null){ //若是沒有加上&& $_FILES['picture']['name'] !=null，當今天沒有新增圖片時，圖片就不會出現
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/news/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = $_POST['old_picture'];      //若是沒有新增圖片，就回傳舊的圖片
  }


  $sql= "UPDATE news SET picture=:picture, published_at=:published_at, title=:title, content=:content, updated_at=:updated_at WHERE newsID=:newsID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":published_at", $_POST['published_at'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":newsID", $_POST['newsID'], PDO::PARAM_INT);
  $sth ->execute();
 
  header('Location: list.php');
}else{
  $query = $db->query("SELECT * FROM news WHERE newsID =".$_GET['newsID']);
  $one_news = $query->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="mb-4">最新消息管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">最新消息管理</li>
            <li class="breadcrumb-item active">資料更新系統</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php" enctype="multipart/form-data">
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10 text-left">
                <img class='mb-2' src="../../uploads/news/<?php echo $one_news['picture']; ?>"  width='200' alt="">
                 <input type="hidden" id='old_picture' value="<?php echo $one_news['picture']; ?>">   <!--在picture裡給一個隱藏屬性是old_picture -->
                <input type="file" class="form-control-file" id="inputmailh" name="picture"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">發佈日期</label>
              <div class="col-10">
                <input type="text" class="form-control" id="published_at" name="published_at" value="<?php echo $one_news['published_at']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">標題</label>
              <div class="col-10">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $one_news['title']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">內容</label>
              <div class="col-10">
                <textarea class="form-control" id="content" name="content"><?php echo $one_news['content']; ?></textarea> </div>
            </div>
            <a class="btn btn-info" href="list.php">回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否進行更新？')){return false;};">確認</button>
            <input type="hidden" name="updated_at" value="<?php echo date('y-m-d H:i:s') ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="newsID" value="<?php echo $_GET['newsID'] ?>"><!--為了更新成功，要將newsID一起寫入才能更新-->

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
//tinymce文字編輯器(套用時要將這個編輯器相關的js與css檔放置相關目錄裡並進行讀取，再在function中打上相應的程式，才會有作用)
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
</script>

</html>