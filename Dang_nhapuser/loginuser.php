<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="loginuser.css">
</head>
<style>


/* Thêm các quy tắc CSS khác nếu cần */
</style>
<body>

    <!-- Đăng ký-->

    <div class="tendangky">
        <a href="loginuser.php">Đăng nhập<hr></a>
        <a href="sign_up.php">Đăng ký</a>
    </div>  

    <div class="bangdk">
           
            <form id="signup-form" method="POST" action="loginuser.php">
                <br><br>
                <div class="form_group">
                    Số điện thoại
                    <input type="text"  name="sdt" placeholder="0123456789" required />
                </div>
               
                <div class="form-group">
                    Mật khẩu
                    <input type="password"  name="pass" placeholder="*********" required />
                </div><br><br>
                <br>
                
                <br><div class="form-group">
                    <button type="submit" name="dn"style="  width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;">Đăng nhập</button>
                </div>
            </form>
            <?php
            // session_start() sẽ đăng ký phiên làm việc của người dùng trên Server, 
            //từ đó Server sẽ tạo ra một ID riêng không trùng lặp 
            //để nhận diện cho client hiện tại.
            session_start();
            //Kết nối tới database
            include('control.php');
              if(isset($_POST['dn'])){
                //Lấy dữ liệu nhập vào
                $tk= $_POST['sdt'];
                //mã hóa password
                $p=md5($_POST['pass']);

                //Kiểm tra tên đăng nhập có tồn tại không
                $s ="SELECT sdt, pass FROM userdk WHERE sdt='$tk'";
                $query = mysqli_query($conn, $s);
                if (mysqli_num_rows($query) == 0) {
                    echo "Tên đăng nhập hoặc mật khẩu không đúng. 
                    Vui lòng kiểm tra lại.
                    <a href='sign_up.php'>ĐĂNG KÝ</a>";
                    exit;
                }
                //Lấy mật khẩu trong database ra
                $row = mysqli_fetch_array($query);
                //So sánh 2 mật khẩu có trùng khớp hay không
                if($p != $row['pass']){
                  echo "Mật khẩu không đúng. Vui lòng nhập lại.
                  <a href='sign_up.php'></a>";
                  exit;
                }
                $_SESSION['taikhoan']=true;
                //Lấy thông tin người dùng
                    $_SESSION['taikhoan']=$tk;
                    echo "<script>alert('Đăng nhập thành công!');
                      window.location='../User/indexuser.php';</script>";
              }
              
            ?>
  
     
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

 <script src="../script.js"></script>
</body>
</html>
