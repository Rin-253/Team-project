<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="gioithieu.css">
</head>
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
              <li><a href="indexuser.php">Trang chủ</a></li>
              <li><a href="gioithieu.php">Giới thiệu</a></li>
              <!-- Mục Sản phẩm và mục con -->
              <li>
                <a href="#">Danh mục <img src="../icon/chevron.png" ></a>
                    <ul class="submenu">
                      <?php
                              while($t=mysqli_fetch_array($s)){
                      ?>
                          <li>
                            <a href="tranggiay.php?id_dm=<?php echo $t['id_dm']?>">
                              <?php echo $t['tendm']?></a>
                          </li>
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
     

    <div class="gioithieu">
        <a href="indexuser.php"><img src="../icon/arrow.png" ></a>
          <div class="shop-info">
           <h1>LEANNEL</h1>
          <p>"Chinh phục phong cách - Bước chân thế hệ mới"</p>
          </div>
          <div class="shop-stats">
           <p>🤍 Yêu thích: <span>2,4k</span></p>
           <p>⭐ Đánh giá: <span>4.8</span> | 5 (<span>1,8k</span> Đánh giá)</p>
           <p>💬 Tỉ lệ phản hồi Chat: <span>100%</span> (Trong vòng vài tiếng)</p>
           <p>🚩 Địa chỉ : 18C , Cửa Đông , Hanoi , Vietnam</p>
           <p>📞 Hotline : 023674832 </p>
           <p>🕓 Thời gian mở cửa : 7h30-21h</p>
          </div>
          <div class="description">
           <p >&ensp; Shop Giày Dép  - Thương hiệu giày dép độc quyền được hàng triệu khách hàng tìm 
            và tin dùng trong suốt 7 năm qua cho đến thời điểm hiện tại. 
            Mẫu mã, màu sắc đa dạng hợp thời trang và luôn cập nhật xu hướng mới nhất,
             đặc biệt quan tâm về chất lượng sản phẩm tạo độ thoải mái và êm ái nhất khi khách hàng sử dụng.</p>
             <p> &ensp;Đội ngũ gồm những bạn trẻ đam mê, nhiệt huyết với cái đẹp, tận tình tận tâm với từng vị khách.</p>
          </div>
          <div class="products">
           <h2 style="padding: 10px;"> Sản phẩm (210)</h2>
          </div>
          <div class="footer">
           <p>Link của Shop: <a href="shopee.vn/leann07.vn">Mua ngay</a></p>
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