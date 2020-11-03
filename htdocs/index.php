<?php
include "connection.php";
// $vid="";
// $vname="";
// $vprovince="";
// $vcontact="";

if(isset($_POST["button_add"])){
    $qry = mysqli_query($con,"insert into table_product values('','".$_POST["cat_name"]."','".$_POST["cat_province"]."','".$_POST["cat_contact"]."','".$_FILES["cat_picture"]["name"]."')") or die ("Cannot query with database");
    if($qry){
        $target_dir = "picture/";
        $target_file = $target_dir . basename($_FILES["cat_picture"]["name"]);
        $imageFileType = pathinfo(pathinfo($target_file,PATHINFO_EXTENSION));
        if(move_uploaded_file($_FILES["cat_picture"]["tmp_name"], $target_file)){
        }
        else{
            "Upload failed";

        }
    }
}
    

else if(isset($_POST["button_edit"])){
    echo "button edit is running";
}
if(isset($_GET["delete"])){
    $qry =mysqli_query($con,"delete from table_product where cat_id='".$_GET["delete"]."'");
    if($qry){
        unlink("picture/".$_GET["picture"]);
    }
}


    
?>

<!doctype html>
<html>
<head>
<meta chaset="utf-8">
<title>finding lost cats </title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">ข้อมูลแมวหายทั้งหมด<br>แชทบอทสนับสนุนการตามหาแมว</a>
    
  </div>
</nav>
</head>
<body>
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">
<table class="table">

    
    
    <tr><td>สายพันธุ์แมว</td><td>
  </button>
  <select name="cat_name" id="cars">
  <option value="อเมริกันช็อตแฮร์">อเมริกันช็อตแฮร์</option>
  <option value="แมวดำ">แมวดำ</option>
  <option value="แมวขาวดำ">แมวขาวดำ</option>
  <option value="ขาวมณี">ขาวมณี</option>
  <option value="เมนคูน">เมนคูน</option>
  <option value="แมวส้ม">แมวส้ม</option>
  <option value="เปอร์เซีย">เปอร์เซีย</option>
  <option value="สก็อตติทโฟล์ด">สก็อตติทโฟล์ด</option>
  <option value="สีสวาท">สีสวาท</option>
  <option value="แมวสามสี">แมวสามสี</option>
</select>
    </td></tr>
    <tr><td>ที่อยู่</td><td><input type="text" name="cat_province" placeholder="ตัวอย่าง ต.xxx อ.xxx จ.xxx"/></td></tr>
    <tr><td>การติดต่อ</td><td><input type="text" name="cat_contact"placeholder="ตัวอย่าง เบอร์ 08xxxxxxxx"/></td></tr>
  
    <tr><td>รูปแมว</td><td><input type="file" name="cat_picture"/></td></tr>
    <tr><td colspan="2"><input type="submit" name="button_add" value="Add"/>
    
  </table>
  

</form>
  </form>
  <table class="table">
  <tr><th>ลำดับ</th><th>พันธุ์แมว</th><th>ที่อยู่</th><th>การติดต่อ</th><th>รูป</th></tr>
    <?php
        $qry = mysqli_query($con,"select * from table_product");
            while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
            echo '<tr><td>'.$row["cat_id"].'</td>';
            echo '<td>'.$row["cat_name"].'</td>';
            echo '<td>'.$row["cat_province"].'</td>';
            echo '<td>'.$row["cat_contact"].'</td>';
            echo '<td><img src="picture/'.$row["cat_picture"].'" style="width:300px;height:300px;"/></td>';
            echo '<td><a href="?delete='.$row["cat_id"].'&picture='.$row["cat_picture"].'">Delete</td></tr>';
        }
    ?>
  </table>
  </body>
</html>