<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Điều Hướng</title>
    <link rel="stylesheet" href="../San_pham/style.css">
    <script src="../script.js"></script>
</head>
<style>


/* Thêm các quy tắc CSS khác nếu cần */
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
              <li><a href="../Trang_chu/index.php">Trang chủ</a></li>
              <li><a href="../Trang_chu/gioithieu.php">Giới thiệu</a></li>
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
              
              <li><a href="../Trang_chu/lienhe.php">Liên hệ</a></li>
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
        <form action="../Trang_chu/timkiem.php" method="POST">
          <input type="text" name="search" placeholder="Tìm kiếm..." >
          <!-- Thêm icon tìm kiếm -->
          <button name="tk">
          <img src="../icon/search (1).png"  alt="Search icon">
          </button></input>  
        </form> 
    </div>
    <button class="cart-button">
    <a href="../San_pham/gio_hang.php">
            <img class="cart-icon" src="../icon/shopping-cart.png" alt="Giỏ hàng">
      </a>
      
      
    </button>

     
  <div class="contaniner_banner">
    <img src="../imagegiay/banner.png">
    
  </div>
     
   <div style="width: 1200px;height:60px; background-color:rgb(237, 218, 192);
   margin-top:30px; margin-left:10%">
    <b> <p style="padding: 5px; text-align: center;">Giày Nike chính hãng, 
    đa dạng kiểu dáng, bền đẹp, giá luôn tốt nhất.
     Tất cả sản phẩm đều được nhập khẩu và phân phối chính hãng.
      30 ngày đổi hàng, bảo hành 6 tháng, miễn phí giao hàng toàn quốc. </p></b>
   </div>
   <div class="main">
    <div class="container-hot">
        <?php
        //kết nối tới CSDL 
            $conn=connect();
            $sql= "";
            //lấy ra danh sách sản phẩm theo danh mục
            if(isset($_GET['id_dm'])){
              $id_dm = $_GET['id_dm'];
              $sql= "SELECT * FROM sanpham,danhmuc
              WHERE sanpham.id_dm=danhmuc.id_dm
              AND sanpham.id_dm='$id_dm'";
            }else{
              $sql= "SELECT * FROM sanpham";
            }
            //thực thi câu lệnh truy vấn
            $result=mysqli_query($conn,$sql);
            foreach($result as $i){
        ?>
        <!-- lấy ra mã, tên, ảnh, giá sản phẩm -->
      <div class="product-container">
        <a href="giaymot.php?masp=<?php echo $i['masp']?>">
        <div class="product-image">
        <img src="../Admin/module/Trang_admin/sp/upload/<?php echo $i['anh']?>">
        </div>
        <div class="product-name"><?php echo $i['tensp']?> </div>
        <div class="product-price"><?php echo $i['gb']?></div></a>
       </a>
       
      </div>
        <?php
          }
          ?>
     
     
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

      
    </footer>
    <script src="script.js"></script>
</body>
</html>
