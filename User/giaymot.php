
<!-- hiển thị chi tiết thông tin sản phẩm -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Điều Hướng</title>
    <link rel="stylesheet" href="../San_pham/style.css">
    <link rel="stylesheet" href="../San_pham/giay2.css">
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
              <li><a href="indexuser.php">Trang chủ</a></li>
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
    <button class="cart-button">
      <a href="../San_pham/gio_hang.php">
            <img class="cart-icon" src="../icon/shopping-cart.png" alt="Giỏ hàng">
      </a>
      <span class="cart-count"></span>  
    </button>
    <!-- hiển thị chi tiết sản phẩm  -->
    <?php
          //kết nối tới CSDL từ URL dm/control.php
          $conn=connect();
          //lấy tất cả thông tin sản phẩm theo mã sản phẩm
          $sql= "SELECT * FROM sanpham,danhmuc
          WHERE sanpham.id_dm = danhmuc.id_dm
          AND masp='".$_GET['masp']."'";
          $result=mysqli_query($conn,$sql);
          foreach($result as $i){
        ?>
    <div style="display: flex; padding-top:120px ">
      <div class="slideshow-container">
        <!-- hiển thị ảnh sản phẩm -->
          <div class="slides" >
            <img src="../Admin/module/Trang_admin/sp/upload/<?php echo $i['anh']?>">
          </div>
          <button class="prev">&#10094;</button>
          <button class="next">&#10095;</button>
          <div style="padding-top: 40px;"><p><center>Hotline giải đáp 24/7
            <b>0932.433.160</b> <br>
            (Zalo, 7h30 – 21h cả T7, CN)</center></p></div>

          <div style="display: block;">
            <form action="add_to_cart1.php" method="post">
              <input type="hidden" name="product_id" value="<?php echo $i['id_sp']?>">
              <button type="submit"  style="margin-top: 400px;margin-left:50px;
            background-color:crimson;height:70px;width:250px"><h2 >
              <center >THÊM VÀO GIỎ HÀNG</center></h2>  </button>
           </form>
         
           </div>
              
            </div>
        <div style="margin-left: 70px; margin-top:20px;line-height: 1.3; ">
        <!-- hiển thị tên, giá, mã, tình trạng, danh mục sản phẩm -->
          <h1><b> <?php echo $i['tensp']?> </b></h1>
           <br><br>
          <p><b>Giá sản phẩm:</b> <?php echo $i['gb']?></p> <br>
          <p> <b>Mã sản phẩm: </b> <?php echo $i['masp']?>  <br> <br>
              <b><b>Đã bán: </b></b> 25 <br> <br>
             
          </p>
          <p> <b>Danh mục: </b> <?php echo $i['tendm']?> </p> <br>
          <div style="border-style: solid; background-color:rgb(224, 236, 175)">
            <div style="display: flex; ">
             
                <b style="padding: 15px;">Mua càng nhiều, ưu đãi càng lớn <br>
                      (Ưu đãi có thể kết thúc sớm) <br></b>
              </div>
            <div style="padding: 15px;">  Freeship khi mua 2 đôi <br>
              Tặng tất theo sản phẩm(Tùy đôi) <br>
              Mua 5 đôi tặng 1 đôi <br>
              Mã giảm giá <br>
              Giảm 30K - Nhập mã giảm giá <br> TyHisneaker - 
              Áp dụng cho  đơn hàng lần 2.</div>
              </div>

              
              <div>

              </div>
      </div>
      
   </div>
    
   
    

    <div style="display: flex;">
      <div style="padding-top:200px; padding-left:150px"><h2>THÔNG SỐ SẢN PHẨM</h2> <br> <br>
      <P><b>SIZE:</b>  &emsp;&emsp;&ensp;&ensp;&ensp; &emsp; &ensp;36,37,38,39,40</P> <br>
      <p><u>------------------------------------------------------------</u></p> <br>
      <p><b>QUÀ TẶNG:</b>&emsp;&emsp; &ensp;     Full box + tax + bill</p> <br>
      <p><u>------------------------------------------------------------</u></p> <br>
      <p><b>THƯƠNG HIỆU:</b>&ensp;&nbsp;           Jordan 1, Nike</p> <br>
      <p><u>------------------------------------------------------------</u></p> <br>
      <p><b>LOẠI HÀNG:</b>   &emsp; &ensp;           Like auth</p> <br>
      <p><u>------------------------------------------------------------</u></p> <br> <br>
      <!--Nội dung sản phẩm -->
      <h2><b>MÔ TẢ SẢN PHẨM</b></h2>  <br> <br>
      <p style="text-align: left;"> 
          <?php echo $i['nd']?>
          <br>+ NOTE: hàng có số lượng
          <br> <br>
          <ul style="border-style: solid; background-color:rgb(254, 254, 254); padding:15px">
                ✔️CAM KẾT HÀNG CHÍNH HÃNG 100%  <br>
                📦ĐẦY ĐỦ PHỤ KIỆN : TAG VÀ BOX <br>
                👍ĐƯỢC KIỂM TRA HÀNG TRƯỚC KHI THANH TOÁN <br>
               🔄️ ĐỔI HÀNG TRONG VÒNG 5 NGÀY <br>
               🚚 MIỄN PHÍ SHIP VỚI CÁC ĐƠN HÀNG TỪ 399K ( TRONG NỘI THÀNH HÀ NỘI VÀ THÀNH PHỐ HCM)</ul>
      </p>
      </div>
      <?php
          }
      ?>


<script>
    let slideIndex = 0;
    showSlides();
    
    document.querySelector('.prev').addEventListener('click', function() {
      slideIndex -= 1;
      showSlides();
    });
    
    document.querySelector('.next').addEventListener('click', function() {
      slideIndex += 1;
      showSlides();
    });
    
    function showSlides() {
      let slides = document.querySelectorAll('.slides img');
      
      // Ẩn tất cả các slide
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';  
      }
      
      // Nếu slideIndex lớn hơn số lượng slides, quay lại slide đầu tiên
      if (slideIndex >= slides.length) {slideIndex = 0;}    
      // Nếu slideIndex nhỏ hơn 0, chuyển đến slide cuối cùng
      if (slideIndex < 0) {slideIndex = slides.length - 1;}
      
      // Hiển thị slide hiện tại
      slides[slideIndex].style.display = 'block';  
    }
    </script>


      <div style="padding-left: 70px;">
        
        <h2 style="padding-top: 200px;">THÔNG TIN HỮU ÍCH</h2> <br> <br>
        <a href="https://tyhisneaker.com/phoi-do-voi-giay-nike-air-force-1-low-brooklyn-cream-giay-nike-am-duong/">
          <div style="display: flex; width:500px; padding: left 50px;"> 
            <div style="height: 100px; weight: 100px;">
            <img  src="../imagegiay/a3.jpg" alt="">
          </div>
            <p style="width: 350px; padding-left:15px"> 
            Phối đồ với Giày Nike Air Force 1 Low Brooklyn Cream – Giày Nike âm Dương</p>
          </div>
        </a>  
          <br> 
        <a href="https://tyhisneaker.com/tieu-de-bai-viet-1/">
          <div style="display: flex; width:500px; padding: left 50px;"> 
          <div style="height: 100px; weight: 100px;">
          <img  src="../imagegiay/a6.jpg" alt=""></div>
           <p style="width: 350px; padding-left:15px">Đánh giá giày Jordan 1 Zoom Air PSG Paris Saint</p></div>
        </a>  
        <br>
        <a href="https://tyhisneaker.com/tieu-de-bai-viet-5/">
          <div style="display: flex; width:500px; padding: left 50px;"> 
          <div style="height: 100px; weight: 100px;">
          <img  src="../imagegiay/a5.jpg" alt=""></div>
           <p style="width: 350px; padding-left:15px">Xu hướng giày sneaker 2024 cho nam và nữ</p></div>
        </a>  
          <br>
          <a href="https://tyhisneaker.com/top-10-anh-phoi-do-phong-cach-co-dien-voi-giay-jordan-1-low-paris/">
            <div style="display: flex; width:600px; padding: left 50px;"> 
            <div style="height: 100px; weight: 100px;">
            <img  src="../imagegiay/a3.jpg" alt=""></div>
             <p style="width: 350px; padding-left:15px">Top 10+ Ảnh Phối đồ phong cách cổ điển 
             với Giày Jordan 1 low Paris</p></div>
          </a>  
          <br> 
        <a href="https://tyhisneaker.com/giay-prophere-co-bao-nhieu-gia//">
          <div style="display: flex; width:500px; padding: left 50px;"> 
          <div style="height: 100px; weight: 100px;">
          <img  src="../imagegiay/a5.jpg" alt=""></div>
           <p style="width: 350px; padding-left:15px">Giày Adidas Prophere có giá bao nhiêu 
           và cách phối đồ thời trang</p></div>
        </a>  
        <br>
        <a href="https://tamanh.net/phoi-do-voi-giay-nike.html">
          <div style="display: flex; width:500px; padding: left 50px;"> 
          <div style="height: 100px; weight: 100px;">
          <img  src="../imagegiay/a6.jpg" alt=""></div>
           <p style="width: 350px; padding-left:15px">15+ Cách phối đồ với giày Nike 
           nam nữ đẹp cá tính cực chất</p></div>
        </a>  
      </div>

    </div>

    <div style="padding-top: 50PX; padding-left:150px;"> <br>
      <h2>CÁCH CHỌN SIZE GIÀY</h2> <br> <br>
      <div style="display:flex"><img style="width: 800px;height:550px;" 
      src="../imagegiay/size.jpg" alt="">
        <p style="padding-left: 50PX;width:450px">
        <b>Lưu ý</b>: Shop có các mẫu Sneaker Bigsize từ 44 - 45 -46 - 47 - 48 - 49 
        cho anh em chân to giá chênh lệch 30 - 50k so với size chuẩn. 
        Vui lòng nhắn tin Fanpage hoặc Zalo để check size. 
          <br> Xin cảm ơn.</p>
      </div>
    </div>

    <div style="margin-left: 130px; line-height:40px">
      <p ><h2 style="padding-top: 60PX;">Những lý do bạn nên mua giày sneaker tại Tyhi Sneaker</h2> <br>
        <ul style="padding-top: -10px;">
          <li>  Giày chuẩn hàng Trung bản chuẩn nhất, cao cấp nhất thị trường.</li>
          <li> Kiểm tra hàng mới thanh toán, đổi trả size nhanh chóng.</li>
          <li>Mẫu giày Trends, đẹp, đủ mẫu, đủ size.</li>
          <li>Ship COD toàn quốc nhanh chóng.</li>
           <li>Bảo hành lên đến 6 tháng.</li>
          <li>Freeship cho đơn 2 đôi hoặc đơn thứ 2; Mua 5 đôi tặng 1 đôi.</li>
        </ul></p>
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

    <script src="script.js"></script>
</body>
</html>
