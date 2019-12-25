
<?php
require_once("../is_login.php");
require_once("../../function/connection.php");

if(isset($_POST['EditForm']) && $_POST['EditForm'] == "UPDATE"){
  if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] !=null){ //若是沒有加上&& $_FILES['picture']['name'] !=null，當今天沒有新增圖片時，圖片就不會出現
    $filename = $_FILES['picture']['name'];
    $file_path = "../../uploads/products/".$_FILES['picture']['name'];
    move_uploaded_file($_FILES['picture']['tmp_name'], $file_path);
  }else{
    $filename = $_POST['old_picture'];      //若是沒有新增圖片，就回傳舊的圖片
  }


  $sql= "UPDATE products SET picture=:picture, name=:name, price=:price, description=:description, updated_at=:updated_at WHERE productID=:productID";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_STR);
  $sth ->bindParam(":description", $_POST['description'], PDO::PARAM_STR);
  $sth ->bindParam(":updated_at", $_POST['updated_at'], PDO::PARAM_STR);
  $sth ->bindParam(":productID", $_POST["productID"], PDO::PARAM_INT);
  $sth ->execute();
 
  header('Location: list.php?product_categoryID='.$_POST['product_categoryID']);
}else{
  $query = $db->query("SELECT * FROM products WHERE productID=".$_GET['productID']);
  $one_product = $query->fetch(PDO::FETCH_ASSOC);
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
          <h1 class="mb-4">產品更新管理</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"> <a href="#"><i class="fa fa-home"></i> 主控台</a> </li>
            <li class="breadcrumb-item active">產品更新管理</li>
            <li class="breadcrumb-item active">資料更新系統</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-right">
          <form id="c_form-h" class="" method="post" action="update.php" enctype="multipart/form-data">
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">圖片</label>
              <div class="col-10 text-left">
                <img class='mb-2' src="../../uploads/products/<?php echo $one_product['picture']; ?>"  width='200' alt="">
                 <input type="hidden" name='old_picture' value="<?php echo $one_product['picture']; ?>"> 
                <input type="file" class="form-control-file" id="inputmailh" name="picture"> </div>
            </div>
            <div class="form-group row"> <label for="inputmailh" class="col-2 col-form-label">產品名稱</label>
              <div class="col-10">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $one_product['name']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">價錢</label>
              <div class="col-10">
                <input type="text" class="form-control" id="price" name="price" value="<?php echo $one_product['price']; ?>"> </div>
            </div>
            <div class="form-group row">
              <label for="inputpasswordh" class="col-2 col-form-label">描述</label>
              <div class="col-10">
                <textarea class="form-control" id="description" name="description"><?php echo $one_product['description']; ?></textarea> </div>
            </div>
            
            <a class="btn btn-info" href="list.php?product_categoryID=<?php echo $_GET['product_categoryID'];?>">回上一頁</a>
            <button type="submit" class="btn btn-success" onclick="if(!confirm('是否進行更新？')){return false;};">確認</button>
            <input type="hidden" name="updated_at" value="<?php echo date('y-m-d H:i:s') ?>">
            <input type="hidden" name="EditForm" value="UPDATE">
            <input type="hidden" name="productID" value="<?php echo $_GET['productID'] ?>">
            <input type="hidden" name="product_categoryID" value="<?php echo $_GET['product_categoryID'] ?>"> <!--此隱藏欄位是為了讓頁面跳回list而存在的(因為此為兩層式架構)-->

          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include_once('../layouts/footer.php'); ?>
</body>
<script>

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