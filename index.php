<?php include 'include/header.php';?>
<?php
  if($login==""){
  if(isset($_GET['halaman'])){
    $hal = $_GET['halaman'];
    switch($hal){
      case 'login';
        include 'include/auth/login.php';
      break;
      case 'registrasi';
        include 'include/auth/registrasi.php';
      break;
      case 'lupapassword';
        include 'include/auth/lupa_password.php';
      break;
      case 'passwordbaru';
        include 'include/auth/password_baru.php';
      break;
      case 'shop';
        include 'include/pembeli/shop.php';
      break;
      default:
        echo "<meta http-equiv='refresh' content='0; url=?halaman=login'>";
    }
  }else{
    include 'include/content.php';
  }
}else{
  if(isset($_GET['halaman'])){
    $hal = $_GET['halaman'];
    switch($hal){
      case 'login';
        include 'include/auth/login.php';
      break;
      case 'registrasi';
        include 'include/auth/registrasi.php';
      break;
      case 'lupapassword';
        include 'include/auth/lupa_password.php';
      break;
      case 'cart';
        include 'include/pembeli/cart.php';
      break;
      case 'detail';
        include 'include/pembeli/detail.php';
      break;
      case 'checkout';
        include 'include/pembeli/checkout.php';
      break;
      case 'profil';
        include 'include/pembeli/profil.php';
      break;
      case 'pesanan';
        include 'include/pembeli/pesanan.php';
      break;
      case 'detail_pesanan';
        include 'include/pembeli/detail_pesanan.php';
      break;
      case 'riwayat_pesanan';
        include 'include/pembeli/riwayat_pesanan.php';
      break;
      case 'shop';
        include 'include/pembeli/shop.php';
      break;
      case 'cek';
        include 'include/pembeli/cek.php';
      break;
      default:
        echo "<meta http-equiv='refresh' content='0; url=$index'>";
    }
  }else{
    include 'include/content.php';
  }
}
?>
<?php include 'include/footer.php';?>