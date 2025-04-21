<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/dangnhap.css">
</head>
<body>
  <?php
  // tạo 1 phiên làm việc mới
    session_start();
    // gọi tới trang control.php
    include('../Trang_admin/dm/control.php');
  //  kết nối tới CSDL
    $conn=connect();
     // kiểm tra xem có tồn tại biến $_POST['dn'] không
    if(isset($_POST['dn'])){
      $tk= $_POST['email'];
      $p=md5($_POST['password']);
      // kiểm tra xem  tài khoản và mật khẩucó trùng khớp trong CSDL không
      $sql= " SELECT * FROM userad WHERE username='$tk'
              AND pass='$p' LIMIT 1";
              //    thực thi câu lệnh
      $row= mysqli_query($conn,$sql);
      //    kiểm tra xem có tồn tại tài khoản trong CSDL không
      $count =mysqli_num_rows($row);
      // nếu tồn tại tài khoản thì đăng nhập thành công
      // ngược lại -> thông báo nhập lại
        if($count>0){
          $_SESSION['dn']=true;
          // Lưu giá trị biến $tk vào Session
          $_SESSION['dn']=$tk;
          header("Location: ../Trang_admin/ql_user.php");
        }
        else{
          echo "<script>alert('Tài khoản hoặc 
                mật khẩu không đúng. 
                Vui lòng nhập lại!');</script>";
          header('location:dangnhap.php');

        }
    }
  
  ?>


    <header>
        <!-- Logo -->
        <a href="#" class="logo">logo</a>
        <div class="group">
          <!-- Navigation menu -->
          <ul class="navigation">
            <li><a href="../Trang_admin/Trang_chuadmin.php">Trang chủ</a></li>

            <li><a href="#">Đăng nhập</a></li>
            
              
          </ul>
          <!-- Thanh menu -->
          <span class="icon">
              <!-- Thanh 3 gạch cho menu -->
              <img src="../../../Trang_chu/icon/menu.png" 
              class="menuToggle" style="width: 30px;">
          </span>
      </div>
      
    </header>
      
        <div class="signin-box">
            <a href="../Trang_admin/ql_user.php"><img src="../../../image/nut_tro_ve.jpg" ></a>
            <h2>Sign in</h2>
           <form action="dangnhap.php" method="POST" autocomplete="off">
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="password">Password</label><br>
                <input type="password" id="password" name="password" required><br><br>
               
               <input type="submit" name="dn" value="Log In">
            </form>
        </div>

    <script src="../../../script.js"></script>
    <script>src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"</script>
</body>
</html>