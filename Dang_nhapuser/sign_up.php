<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="sign_up.css">
</head>
<style>
span{
  color:red;
}

/* Thêm các quy tắc CSS khác nếu cần */
</style>
<body>

    <!-- Đăng ký-->

    <div class="tendangky">
        <a href="loginuser.php">Đăng nhập</a>
        <a href="sign_up.php">Đăng ký<hr></a>
    </div>  
    <!-- tạo form đăng ký của người dùng -->
    <div class="bangdk">
            Trở thành thành viên Sucula để nhận ưu đãi độc quyền
             và thanh toán nhanh hơn
            <form id="signup-form" method="post" action="sign_up.php">
                <br><br>
                <div class="form_group">
                    Số điện thoại*
                    <input type="text" id="sdt" name="sdt" placeholder="0123456789" required />
                </div>
                <div class="form-group">
                    Họ và tên*
                    <input type="text" id="name" name="ten" placeholder="Nguyen van A" required />
                </div><br>
                <div class="form-group">
                    Mật khẩu*
                    <input type="password" id="password" name="pass"placeholder="*********" required />
                </div><br>
                <div class="form-group">
                    Email*
                    <input type="text" id="email" name="email" placeholder="NguyenvanA@gmail.com" required />
                </div><br><br>
                
                <br><div class="form-group">
                    <button type="submit" name="dk" style="  width: 100%;
                    padding: 10px;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;">Đăng ký</button>
                </div>
            </form>
      </div>
      <?php
      
      // gọi đến trang control.php
        include('control.php');
        $get_data=new data_user();
        
        // hàm check tên đăng nhập xem có hợp lệ k
        function isValidUsername($name) {
          if (strlen($name) > 20) 
            return false;
        
          return true;
        }
        // hàm check số điện thoại xem có hợp lệ k 
        function isValidPhoneNumber($sdt) {
          return preg_match('/^[0-9]{10}$/', $sdt);
        }

        // hàm check mật khẩu xem có hợp lệ k
        function isValidPassword($pass) {
          return preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9]).{6,10}$/', $pass);
        }

        // hàm check email xem có hợp lệ k
        function isValidEmail($email) {
          return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
        if(isset($_POST['dk'])){
          $name=$_POST['ten'];
          $sdt=$_POST['sdt'];
        $pass=$_POST['pass'];
        $email=$_POST['email'];

          //kiểm tra xem tên đăng nhập đã có người dùng chưa
          $result = $get_data->ht_ten($_POST['ten']);
         
          //nếu tên đăng nhập đã tồn tại thì báo lỗi
          if (mysqli_num_rows($result) > 0){
                  echo "Tên đăng nhập này đã có người dùng. 
                  Vui lòng chọn tên đăng nhập khác.";
                  exit;
          }
          // check tên đăng nhập xem có hợp lệ k 
          elseif (!isValidUsername($name)) {
            echo "Tên đăng nhập không được vượt quá 20 ký tự";
          }
          // check số điện thoại xem có hợp lệ k 
          elseif (!isValidPhoneNumber($sdt)) {
            echo "Số điện thoại phải đủ 10 số và là kiểu số";
          }

          // check password xem có hợp lệ k
          elseif (!isValidPassword($pass)) {
            echo  "Mật khẩu phải từ 6-10 ký tự và gồm ký tự và số";
          }

          // check email xem có hợp lệ k
          elseif (!isValidEmail($email)) {
            echo "Email không đúng định dạng";
          }
          else{

          //thêm mới thông tin user vào bảng userdk
          $in = $get_data->them($_POST['sdt'],$_POST['ten'],
                md5($_POST['pass']),$_POST['email']);
          //thực thi câu lệnh thêm thông tin người dùng 
          //vào bảng userdk. Nếu nhập đủ thông tin -> thông báo 
          //thành công. Nếu không đưa ra thông báo 'vui lòng đăng ký lại'
          if($in)
            echo "<script>alert('Đăng ký thành công');
              window.location='loginuser.php';</script>";
          else
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
