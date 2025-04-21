
    <?php
        include('control.php');
        $conn=connect();
        //cấp bộ nhớ cho lớp data_dm() 
        $get_data = new data_dm();
        // xóa một bản ghi từ CSDL dựa trên đối số 'del' 
        //truyền vào đường dẫn

        $d = $get_data ->delete_dm($_GET['del']);
        //hiển thị thông báo khi xóa thành công

        if($d) echo "<script>alert('BẠN DÃ XÓA THÀNH CÔNG');
            window.location='select.php'</script>";
        else 
            echo "<script>alert('KHÔNG THỰC THI ĐƯỢC')</script>";
    ?>
