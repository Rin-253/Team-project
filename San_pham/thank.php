
<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thanks Page</title>

        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="giay2.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
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
                      <a href="../User/tranggiay.php?id_dm=<?php echo $row['id_dm']?>">
                          <?php echo $t['tendm']?></a>
                      </li>
                      <?php
                        }
                      ?>
                  </ul>
              </li>
              
              
              <li><a href="../User/lienhe.php">Liên hệ</a></li>
              <hr>
              <li><a href="../User/lichsu.php">Lịch sử mua hàng</a></li>
              <li><strong><a href="../User/info.php">Tài khoản</a></strong></li>
                  
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../icon/menu.png" class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
</header>

    <button class="cart-button">
      <a href="gio_hang.php">
        <img class="cart-icon" src="../icon/shopping-cart.png" alt="Giỏ hàng"></a>
      <span class="cart-count"></span>
      
    </button>
        <h1 class="text-center">Thank you page</h1>
        <div class="container" style="margin-left:400px;margin-top:200px;">
            <div class="row">
                <div class="col-md-10 text-center">
                   <h2>
                     <b> Cảm ơn bạn đã đặt hàng tại Shop.
                     <br>
                    đơn hàng của bạn sẽ được xử lý và thông tin đến bạn
                    <br>
                    xin cảm ơn !</b><br>
                   </h2>
                   <a style="text-decoration:none;margin:0 auto" 
                    href="gio_hang.php"><h3>Quay về giỏ hàng</h3></a>
                </div>
               
            </div>
            
        </div>
        <!--Query là một thư viện JavaScript mã nguồn mở giúp đơn giản hóa việc phát triển các ứng dụng web. 
        Nó cung cấp các phương thức để thao tác với DOM, xử lý sự kiện, tạo hiệu ứng động, 
        gọi Ajax để gửi và nhận dữ liệu từ máy chủ, thao tác với CSS và nhiều hơn nữa.  -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!--  Bootstrap JavaScript là một thư viện mã nguồn mở, đa nền tảng cho phép 
        bạn thêm các chức năng khác nhau vào trang web của mình. Nó được xây dựng trên jQuery 
        và cung cấp một loạt các tiện ích, -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
