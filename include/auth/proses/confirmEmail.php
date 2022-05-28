<?php
    require('../../../config.php');

    if(isset($_GET['code'])){
        $code = $_GET['code'];
        $sql = "SELECT * FROM tbl_pengguna where verif_code = '$code'";
        $query = mysqli_query($conn,$sql);
        if(mysqli_num_rows($query) > 0){
            $user = mysqli_fetch_assoc($query);
            $id = $user['idu'];
            $sql =  "UPDATE tbl_pengguna set is_verified=1 where idu=$id";
            $query = mysqli_query($conn,$sql);
            if($query){
                echo "<script type='text/javascript'>alert('VERIFIKASI Email Berhasil !');
            window.location.href = 'http://localhost/hanna-store/?halaman=login'; //Will take you to Google.</script>";
            }else{
                echo "<script type='text/javascript'>alert('VERIFIKASI Email Gagal !');
            window.location.href = 'http://localhost/hanna-store/?halaman=login'; //Will take you to Google.</script>";
            }
        }else {
            echo "CODE TIDAK DITEMUKAN ATAU TIDAK VALID";
        }
    }else {
        echo "code ga nih";
    }

?>