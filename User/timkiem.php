<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="indexuser.css">
</head>
<style>

.timkiem {

        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        
    }
    .product-container_hot{
      margin-top: 100px;
   
    }
</style>
<body>
    <?php 
      include('../Admin/module/Trang_admin/dm/control.php');
      $get_data =new data_dm();
      $s = $get_data->select_dm();
      ?>
         <header>
        <!-- Logo -->
        <a href="#" class="logo">logo</a>
        <div class="group">
          <!-- Navigation menu -->
          <ul class="navigation">
              <li><a href="index.php">Trang chủ</a></li>
              <li><a href="gioithieu.php">Giới thiệu</a></li>
              <!-- Mục Sản phẩm và mục con -->
              <li>
                  <a href="#">Danh mục <img src="../icon/chevron.png" ></a>
                  <ul class="submenu">
                    <?php
                      while($row=mysqli_fetch_array($s)){
                    ?>
                    <li><a href="tranggiay.php?id_dm=<?php echo $row['id_dm']?>">
                    <?php echo $row['tendm']?></a></li>
              
                   <?php
                    }
                   ?>
                  </ul>
              </li>
              
              
              <li><a href="lienhe.php">Liên hệ</a></li>
              <hr>
             
              <li>
              <?php
              session_start();
                  // hiển thị tên dăng nhập 
                  if (!empty($_SESSION['taikhoan'])) {
                    // Nếu người dùng đã đăng nhập, hiển thị tên người dùng và nút "Thoát"
                      echo "<span class='nav-link'>Hello: " . $_SESSION['taikhoan'];
                  } else {
                  // Nếu chưa đăng nhập, hiển thị nút "Đăng nhập"
                    echo "<a class='nav-link' href='../Dang_nhapuser/loginuser.php'><b>ĐĂNG NHẬP</b></a>";
                  }
                ?>  
              </li>
            
            <li>
              <?php 
              // xóa session login
              if (isset($_SESSION['taikhoan'])){
                  unset($_SESSION['taikhoan']); 
              }
              
              ?>
              <strong><a href="../Trang_chu/index.php">Đăng xuất</a></strong>
            </li>
          </ul>
              
                  
              
       
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>         
   
    <!-- Thanh tìm kiếm -->
    <div class="searchBox">
        <form action="timkiem.php" method="POST">
          <input type="text" name="search" placeholder="Tìm kiếm..." >
          <!-- Thêm icon tìm kiếm -->
          <button name="tk">
          <img src="../icon/search (1).png"  alt="Search icon">
          </button></input>  
        </form> 
    </div>
        <div class="timkiem">
        <?php
         //gọi đến hàm connect() kết nối đến database 
              $conn=connect();
              //khi nhập từ khóa vào ô tìm kiếm
              //gán tukhoa bằng biến $search
              if($_POST['search']){
                $search=$_POST['search'];
              }else{
                $search='';
              }
              ?>
              <h2>Kết quả tìm kiếm: <?php echo $search?></h2><br>
              <?php
              // câu lệnh tìm kiếm theo tên sản phẩm
              $sql="SELECT * FROM sanpham 
                WHERE tensp like '%".$search."%'";
                // thực thi câu lệnh tìm kiếm
              $p=mysqli_query($conn,$sql);
              //nếu có kết quả thì hiển thị kết quả
              if(isset($_POST['tk'])){
              while($i=mysqli_fetch_array($p)){
             ?>   
            
                
                <div class="product-container_hot">
                    <a href="giaymot.php?masp=<?php echo $i['masp']?>">
                    <div class="product-image">
                    <img src="../Admin/module/Trang_admin/sp/upload/<?php echo $i['anh']?>">
                    </div>
                    <div class="product-name"><?php echo $i['tensp']?> </div>
                    <div class="product-price"><?php echo $i['gb']?></div></a>
                </div>
            <?php
              }
            }else echo "KHÔNG TÌM THẤY SẢN PHẨM";
            ?>  
        </div>

</body>
</html>