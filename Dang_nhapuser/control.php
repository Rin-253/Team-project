<!--
         xử lý dữ liệu
thêm các hàm: kết nối đến CSDL(mysql),
thêm, sửa, xóa, hiển thị thông tin user. -->

<?php
        //thiết lập một kết nối đến CSDL sử dụng mysqli_connect()
        //nếu connect lỗi -> thông báo lỗi và dừng chương trình

        $conn = mysqli_connect('localhost','root','','admin') 
        or die('Không thể kết nối!');
        //thiết lập các ký tự là 'utf8': để hiển thị được tiếng việt
        mysqli_set_charset($conn, 'utf8');

        //tạo 1 lớp data_user()
        class data_user{
                //hàm thêm thông tin người dùng
                //gồm 4 đối số: $sdt: số điện thoại, $ten: tên người dùng, $pass,
                // $email: thông tin người dùng cần thêm
                public function them($sdt,$ten,$pass,$email){
                        //gọi đến biến toàn cục $conn: kết nối database
                        global $conn;
                        //thêm thông tin người dùng vào bảng userdk
                        $sql= "INSERT INTO userdk (sdt,ten,pass,email) 
                        VALUES ('$sdt','$ten','$pass','$email')";
                        //thực thi câu lệnh $sql
                        $run=mysqli_query($conn,$sql);
                        return $run;
                }
                //hàm sửa thông tin người dùng
                //gồm 5 đối số: $id: id của người dùng ,
                //$sdt, $ten, $pass, $email: thông tin người dùng cần sửa
                public function sua($id,$sdt,$ten,$pass,$email){
                        global $conn;
                        //sửa thông tin người dùng từ bảng userdk dựa trên id
                        $sql= "UPDATE userdk SET sdt='$sdt',ten='$ten',
                                pass='$pass', email='$email' WHERE id_u=$id";
                        $run=mysqli_query($conn,$sql);
                        return $run;
                }
                //hàm xóa thông tin người dùng
                //dựa trên đối số $id:id người dùng cần xóa
                public function xoa($id){
                        global $conn;
                        //xóa thông tin người dùng từ bảng userdk dựa trên id
                        $sql= "DELETE FROM userdk WHERE id_u=$id"; 
                        $run=mysqli_query($conn,$sql);
                        return $run;
                }
                //hàm hiện thị thông tin người dùng
                public function ht(){
                        global $conn;
                        //hiển thị thông tin người dùng từ bảng userdk
                        $sql= "SELECT * FROM userdk"; 
                        $run=mysqli_query($conn,$sql);
                        return $run;
                }
                //hàm hiển thị thông tin người dùng
                //dựa trên đối số $id:id người dùng
                public function ht_id($id){
                        global $conn;
                        //hiển thị thông tin người dùng từ bảng userdk dựa trên id
                        $sql= "SELECT * FROM userdk WHERE  id_u=$id";
                        $run=mysqli_query($conn,$sql);
                        return $run;
                }
                //hàm hiển thị tên người dùng
                //dựa trên đối số $ten:tên người dùng cần sửa
                public function ht_ten($ten){
                        global $conn;
                        //hiển thị tên người dùng từ bảng userdk dựa trên id
                        $sql = "SELECT ten FROM userdk WHERE ten='$ten'";
                        $run=mysqli_query($conn,$sql);
                        return $run;
                }
        }
?>

