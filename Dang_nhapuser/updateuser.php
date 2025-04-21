<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="sign_up.css">
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
              <li><a href="../User/indexuser.php">Trang chủ</a></li>
              <li><a href="../User/gioithieu.php">Giới thiệu</a></li>
              <!-- Mục Sản phẩm và mục con -->
              <li>
                  <a href="#">Danh mục <img src="../icon/chevron.png" ></a>
                  <ul class="submenu">
                  <?php
                          while($t=mysqli_fetch_array($s)){
                    ?>
                      <li>
                        <a href="../User/tranggiay.php?id_dm=<?php echo $t['id_dm']?>">
                          <?php echo $t['tendm']?></a>
                      </li>
                      <?php
                        }
                      ?>
                  </ul>
              </li>
              
              
              <li><a href="../User/lienhe.php">Liên hệ</a></li>
              <hr>
              
              <li><strong><a href="../User/info.php">Tài khoản</a></strong></li>
              <li>
            <?php 
              // xóa session login
              if (isset($_SESSION['taikhoan'])){
                  unset($_SESSION['taikhoan']); 
              }
              ?>  
            <strong><a href="../Trang_chu/index.php">Đăng xuất</a></strong></li>
                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
     
    <!-- icon giỏ hàng -->
    <button class="cart-button">
      <a href="../San_pham/gio_hang.php">
        <img class="cart-icon" src="../icon/shopping-cart.png" alt="Giỏ hàng">
      </a>
      <span class="cart-count"></span>
      
    </button>
    

    <!-- Đăng ký-->

    <div class="tendangky">


    </div>  
    <!-- hiển thị thông tin người dùng theo id ra 1 form
          để cập nhật thông tin người dùng-->
    <div class="bangdk">
            <caption style="margin: 0 auto">
            <b>CẬP NHẬT THÔNG TIN</b></caption>
             <?php
            //  gọi đến trang control.php
                include('control.php');
                $get_data = new data_user();
                //gọi đến hàm ht_id(): hiển thị thông tin người dùng
                // theo id: lấy từ đường dẫn (trang User/info.php)
                $g = $get_data ->ht_id($_GET['id_p']);
                while($i=mysqli_fetch_array($g)){
                
             ?>
            <form id="signup-form" method="post" action="updateuser.php">
                <br><br>
                <div class="form_group">
                    Số điện thoại*
                    <input type="text" id="sdt" name="sdt" 
                    placeholder="0123456789" required 
                    value="<?php echo $i['sdt']?>"/>
                </div>
                <div class="form-group">
                    Họ và tên*
                    <input type="text" id="name" name="ten" 
                    placeholder="Nguyen van A" required 
                    value="<?php echo $i['ten']?>"/>
                </div><br>
                <div class="form-group">
                    Mật khẩu
                    <input type="password" id="password" name="pass"
                    placeholder="*********" required 
                    value="<?php echo $i['pass']?>"/>
                </div><br>
                <div class="form-group">
                    Email*
                    <input type="text" id="email" name="email" 
                    placeholder="NguyenvanA@gmail.com" required 
                    value="<?php echo $i['email']?>"/>
                </div><br><br>
                
                <br><div class="form-group">
                    <button type="submit" name="update" style="  width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;">CẬP NHẬT</button>
                </div>
            </form>
            <?php
                }
            ?>
      </div>
      <!-- cập nhật tài khoản người dùng -->
      <?php
        // kiểm tra xem có nhấn vào nút update hay không?
        //nếu có thì update thông tin người dùng
        if(isset($_POST['update'])){

          //cập nhật  thông tin user vào bảng userdk
          $y= $get_data -> sua($_GET['id_p'],$_POST['sdt'],$_POST['ten'],
          md5($_POST['pass']),$_POST['email']);

          //thực thi câu lệnh sql
          if($y){
            echo "<script>alert('Cập nhật thành công');
            window.location='../User/info.php';</script>";
          }
          else{
            echo "<script>alert('KHÔNG THÀNH CÔNG!
                    Vui lòng đăng ký lại!!');</script>";
          }
        }
      ?>

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

    <script src="../script.js"></script>
</body>
</html>
