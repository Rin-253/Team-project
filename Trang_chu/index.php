<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Điều Hướng</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>


/* Thêm các quy tắc CSS khác nếu cần */
</style>
<body>
  <?php 
  //gọi tới trang control.php
      include('../Admin/module/Trang_admin/dm/control.php');
      //khởi tạo 1 đối tượng của lớp data_dm()
      $get_data =new data_dm();
      //gọi tới hàm select_dm() để hiển thị danh mục
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
                    <!-- lấy ra danh mục -->
                    <?php
                      while($row=mysqli_fetch_array($s)){
                    ?>
                    <li><a href="../San_pham/tranggiay.php?id_dm=<?php echo $row['id_dm']?>">
                    <?php echo $row['tendm']?></a></li>
              
                   <?php
                    }
                   ?>
                  </ul>
              </li>
              
              <li><a href="lienhe.php">Liên hệ</a></li>
              <li><a href="../Dang_nhapuser/loginuser.php">Đăng nhập/Đăng ký</a></li>
                  
              
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
    <button class="cart-button">
      <img class="cart-icon" src="../icon/shopping-cart.png" alt="Giỏ hàng">
      <span class="cart-count"></span>
      
    </button>
    <div class="khungbanner">
      <h1>"Chân thấm thoát cảm giác, giày Sucula chính là lựa chọn!"</h1>
      <div class="images">
        <div class="img-khungbanner">
          <img src="../image/8.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/9.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/1.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/2.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/3.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/4.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/10.jpg" alt="">
          
        </div>
        <div class="img-khungbanner">
          <img src="../image/7.jpg" alt="">
          
        </div>
      </div>
      
      
      
    </div>
    <div class="text_hot">
      <h3>SẢN PHẨM HOT</h3>
     </div>
    <div class="main">
      <div class="container_hot">
      <?php
          //kết nối tới database
          $conn=mysqli_connect('localhost','root','','admin');
          //lấy ra tất cả sản phẩm
          $sql= "SELECT * FROM sanpham LIMIT 5";
          $result=mysqli_query($conn,$sql);
          foreach($result as $i){
        ?>
      <div class="product-container_hot">
        <a href="../San_pham/giaymot.php?masp=<?php echo $i['masp']?>">
        <div class="product-image">
          <img src="../Admin/module/Trang_admin/sp/upload/<?php echo $i['anh']?>">
        </div>
        <div class="product-name"><?php echo $i['tensp']?> </div>
        <div class="product-price"><?php echo $i['gb']?></div></a>
      </div>
        <?php
          }
          ?>

      </div>
     </div>
      


     </div>
     <div class="container_loiich">
      <div class="item">
          <img src="../icon/shipped.png" alt="Miễn phí vận chuyển">
          <p>Miễn phí vận chuyển
          <br>(Vận chuyển miễn phí đơn hàng trị giá trên 500.000 VND)</p>
      </div>
      <div class="item">
          <img src="../icon/chat.png" alt="Hỗ trợ ">
          <p>Hỗ trợ online 24/24</p>
      </div>
  
      <div class="item">
          <img src="../icon/gift-box-with-a-bow.png" alt="quà tặng">
          <p>Quà tặng (Khuyến mại lớn mỗi thứ 7/CN)</p>
      </div>
  </div>
  
  
     
      
   

    <footer>
      <div class="container_footer1">
        <div class="text_footer1">
          <p class="contact_info"><strong>Liên hệ:</strong> 05577847378<br></br>
            <strong>Địa chỉ:</strong> Tàng 4, UKB, Bắc Ninh<br><br>
            <strong>Phone:</strong> 190 015 08<br><br>
            <strong>Email:</strong> sucula@gmail.com<br></p>
          
        </div>
      </div>
    
      <div class="container_footer2">
    
        <strong>@  </strong> Bản quyền thuộc về Sucula
      </div>
      </div>
    </footer>

    <script src="../script.js"></script>
</body>
</html>
