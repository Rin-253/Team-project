<!--  
xử lý dữ liệu
thêm các hàm: kết nối đến CSDL(mysql),
thêm, sửa, xóa, hiển thị danh mục.
-->



<?php

    // $conn;
    //hàm để kết nối đến database
    function connect(){
        //thiết lập một kết nối đến CSDL sử dụng mysqli_connect()
        //nếu connect lỗi -> thông báo lỗi và dừng chương trình

        $conn = mysqli_connect('localhost','root','','admin') 
        or die('Không thể kết nối!');
        //thiết lập các ký tự là 'utf8'
        mysqli_set_charset($conn, 'utf8');
        return $conn;
    }
    
    //tạo 1 lớp data_dm() để xử lý dữ liệu 
    class data_dm{

        //hàm insert_dm() để thêm mới danh mục
        //có 2 đối số $ma: mã danh mục, $ten: tên danh mục.
        public function insert_dm($ma,$ten){
            //gọi hàm connect() để kết nối đến CSDL
            $conn=connect();
            //tạo câu lệnh sql để thêm mới danh mục
            $sql="INSERT INTO danhmuc(madm,tendm)
            values('$ma', '$ten')"; 
            //thực hiện câu lệnh sql
            $run=mysqli_query($conn,$sql);
            //trả về kết quả của lệnh sql
            return $run;
        }

        //hàm select_dm() để lấy danh sách danh mục
        public function select_dm(){
            $conn=connect();
            $sql="SELECT * FROM danhmuc";
            $run=mysqli_query($conn,$sql);
            return $run;
        }

        //hàm delete_dm() để xóa danh mục theo id
        //1 đối số $id: id danh mục
        public function delete_dm($id){
            $conn=connect();
            $sql="DELETE FROM danhmuc WHERE id_dm=$id";
            $run=mysqli_query($conn,$sql);
            return $run;
        }

        //hàm select_id() để lấy danh mục theo id
        //1 đối số $id: id danh mục
        public function select_id($id){
            $conn=connect();
            $sql="SELECT * FROM danhmuc WHERE id_dm=$id";
            $run=mysqli_query($conn,$sql);
            return $run;
        }

        //hàm update_dm() để sửa một danh mục theo id
        //3 đối số $id: id danh mục, $ma: mã danh mục,
        // $ten: tên danh mục

        public function update_dm($id, $ma, $ten){
            $conn=connect();
            $sql="UPDATE  danhmuc SET madm ='$ma',tendm ='$ten' WHERE id_dm=$id";
            $run=mysqli_query($conn,$sql);
            return $run;
        }
        //hàm insert_contact() để thêm 1 liên hệ của người dùng
        //và database
        //gồm 5 đối số: tên, email, số điện thoại của người dùng
        //chủ để và nội dung người dùng muốn liên hệ với shop
        public function insert_contact($name,$email,$phone,$subject,$message){
            $conn=connect();
            // Insert into database
            $sql = "INSERT INTO lien_he (name, email, phone, subject,message)
            VALUES ('$name', '$email', '$phone','$subject','$message')";
            $run=mysqli_query($conn,$sql);
            return $run;
        }

    }

    
?>