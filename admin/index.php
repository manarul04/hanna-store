<?php include 'include/header.php';?>
<?php
  if(isset($_GET['halaman'])){
    $hal = $_GET['halaman'];
    switch($hal){
      case 'content';
        include 'include/content.php';
      break;
      case 'login';
        include 'include/login.php';
      break;
      case 'admin';
        include 'include/admin/admin.php';
      break;
      case 'edit_admin';
        include 'include/admin/edit_admin.php';
      break;
      case 'pembeli';
        include 'include/pembeli/pembeli.php';
      break;
      case 'edit_pembeli';
        include 'include/pembeli/edit_pembeli.php';
      break;
      case 'produk';
        include 'include/produk/produk.php';
      break;
      case 'edit_produk';
        include 'include/produk/edit_produk.php';
      break;
      case 'kategori';
        include 'include/kategori/kategori.php';
      break;
      case 'edit_kategori';
        include 'include/kategori/edit_kategori.php';
      break;
      case 'm_pembayaran';
        include 'include/m_pembayaran/m_pembayaran.php';
      break;
      case 'edit_m_pembayaran';
        include 'include/m_pembayaran/edit_m_pembayaran.php';
      break;
      case 'jasa_pengiriman';
        include 'include/jasa_pengiriman/jasa_pengiriman.php';
      break;
      case 'edit_jasa_pengiriman';
        include 'include/jasa_pengiriman/edit_jasa_pengiriman.php';
      break;
      case 'pesanan';
        include 'include/pesanan/pesanan.php';
      break;
      case 'detail_pesanan';
        include 'include/pesanan/detail_pesanan.php';
      break;
      case 'info_toko';
        include 'include/info_toko/info_toko.php';
      break;
      case 'edit_info';
        include 'include/info_toko/edit_info.php';
      break;
      case 'detail_produk';
        include 'include/produk/detail_produk.php';
      break;
      case 'detail_pembeli';
        include 'include/pembeli/detail_pembeli.php';
      break;
      case 'detail_admin';
        include 'include/admin/detail_admin.php';
      break;
      case 'cetak';
        include 'include/cetak.php';
      break;
      default:
        echo "<meta http-equiv='refresh' content='0; url=$admin'>";
    }
  }else{
    include 'include/content.php';
  }
?>
<?php include 'include/footer.php';?>