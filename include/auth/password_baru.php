<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hanna Collection</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link rel = "icon" href = "../../img/icon.png" type = "image/x-icon">
    <!-- Css Styles -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="../../css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../../css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../../css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../../css/style.css" type="text/css">
    <!-- select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/id.min.js"></script>  
    <script src="../../asset/js/app.js"></script>
    <!-- end select -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
<?php
require '../../config.php';
if(isset($_GET['email'])){
    $email = $_GET['email'];
    $token = $_GET['token'];
    $query = mysqli_query($conn,"SELECT * FROM `tbl_pengguna` where verif_code='$token' and email='$email';");
            $cek_data = mysqli_num_rows($query);
            $data = mysqli_fetch_array($query);

            if($cek_data>0){
                $username=$data['username'];
                $email=$data['email'];
            }else{
                echo "<script>
                    swal('Gagal!', 'Token Tidak Cocok', 'error',{
                        buttons: true}).then( () => {
                        location.href = '?halaman=login'});
                    </script>";
            }
   
}else{
    echo "<script>
                    swal('Gagal!', 'Token Tidak Ditemukan', 'error',{
                        buttons: true}).then( () => {
                        location.href = '?halaman=login'});
                    </script>";
}
?>
    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Reset Password</h2>
                        <form method="post">
                            <div class="group-input">
                                <!-- <label for="username">Email</label> -->
                                <input type="text" name="email" id="email" required="" placeholder="Email" value="<?=$email?>" disabled>
                            </div>
                            <div class="group-input">
                                <!-- <label for="username">Email</label> -->
                                <input type="text" name="password" id="password" required="" placeholder="Password Baru" autofocus>
                            </div>
                            <button type="submit" name="kirim" class="site-btn login-btn">Kirim</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    </footer>
    <?php
        if(isset($_POST['kirim'])){
            $password=$_POST['password'];
            $query = mysqli_query($conn,"UPDATE tbl_pengguna SET password='$password' WHERE email='$email'");
            echo "<script>
                        swal('Berhasil!', 'Login Berhasil', 'success',{
                            buttons: true}).then( () => {
                            location.href = '../../'});
                        </script>";
        }?>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="js/jquery-3.3.1.min.js"></script> -->
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/jquery-ui.min.js"></script>
    <script src="../../js/jquery.countdown.min.js"></script>
    <script src="../../js/jquery.nice-select.min.js"></script>
    <script src="../../js/jquery.zoom.min.js"></script>
    <script src="../../js/jquery.dd.min.js"></script>
    <script src="../../js/jquery.slicknav.js"></script>
    <script src="../../js/owl.carousel.min.js"></script>
    <script src="../../js/main.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
        
    </script>
</body> 