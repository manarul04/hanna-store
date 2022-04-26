<?php
    session_start();
    require 'config.php';
    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
        
?>
<?php
$hidden="Hidden";
$login="";
    if(isset($_SESSION['hak_akses'])!=null)  {
        $hak_akses = $_SESSION['hak_akses'];
        $nama = $_SESSION['nama'];
        $id_pembeli = $_SESSION['idu'];
        $hidden="";
        $login="Hidden";
    }
    
?>
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
    <link rel = "icon" href = "img/icon.png" type = "image/x-icon">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- select -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-beta.0/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/i18n/id.min.js"></script>  
    <script src="asset/js/app.js"></script>
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
        $query = mysqli_query($conn,"SELECT * FROM info_toko");
        $info = mysqli_fetch_array($query);
    ?>
    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        <?=$info['email']?>
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        <?=$info['no']?>
                    </div>
                </div>
                <div class="ht-right">
                    <a href="?halaman=login" class="login-panel" <?=$login?>><i class="fa fa-user" ></i>Login</a>
                    <a href="logout.php" class="login-panel" <?=$hidden?>><i class="fa fa-user" ></i>Logout</a>
                    <div class="top-social">
                        <a href="<?=$info['fb']?>" target="_blank"><i class="ti-facebook"></i></a>
                        <a href="<?=$info['ig']?>" target="_blank"><i class="ti-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-10">
                        <div class="logo">
                            <a href="<?=$index;?>">
                                <img src="img/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="cart-icon" <?=$hidden?>>
                                <?php
                                    $query = mysqli_query($conn,"SELECT * FROM tbl_detail_keranjang natural join tbl_keranjang where status='belum' and id_pembeli='$id_pembeli'");
                                    $jumlah_belum_checkout = mysqli_num_rows($query);
                                ?>
                                <a href="javascript:void(0)">
                                    <i class="icon_bag_alt"></i>
                                    <span><?=$jumlah_belum_checkout;?></span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <?php
                                                    $query = mysqli_query($conn,"SELECT a.gambar_produk,a.nama_produk,a.harga_produk,b.quantity,b.id_detail_keranjang,b.status from tbl_keranjang c join tbl_detail_keranjang b on c.id_keranjang = b.id_keranjang join tbl_produk a on b.id_produk=a.id_produk where c.id_pembeli='$id_pembeli' and b.status='belum'");
                                                    while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                                        $nama_produk = $row['nama_produk'];
                                                        $harga_produk = $row['harga_produk'];
                                                        $id_detail_keranjang = $row['id_detail_keranjang'];
                                                        $quantity = $row['quantity'];
                                                        $gambar_produk = $row['gambar_produk'];
                                                        $status = $row['status'];
                                                ?>
                                                <tr>
                                                    <td class="si-pic"><img src="admin/include/produk/gambar_produk/<?=$gambar_produk;?>" width="65" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p><?=rupiah($harga_produk);?> x <?=$quantity;?></p>
                                                            <h6><?=$nama_produk;?></h6>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <?php
                                            $query = mysqli_query($conn,"SELECT sum(quantity*harga_produk) as total_bayar from detail_keranjang where status='belum' and id_pembeli='$id_pembeli'");
                                            $row = mysqli_fetch_array($query);
                                            $total_bayar = $row['total_bayar'];
                                        ?>
                                        <span>total:</span>
                                        <h5><?=rupiah($total_bayar);?></h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="?halaman=cart" class="primary-btn view-card">Lihat Keranjang</a>
                                        <a href="?halaman=checkout" class="primary-btn checkout-btn">Check Out</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li ><a href="<?=$index;?>">Home</a></li>
                        <li><a href="?halaman=shop">Produk</a></li>
                        <li <?=$hidden?>><a href="#">Belanjaku</a>
                            <ul class="dropdown">
                                <li><a href="?halaman=cart">Keranjang</a></li>
                                <li><a href="?halaman=pesanan">Pesanan</a></li>
                            </ul>
                        </li>
                        <li <?=$hidden?>><a href="?halaman=profil">Profil</a></li>
                    </ul>
                    
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->
    <!-- Modal -->
    <div class="modal fade" id="kontrol<?=$id_pesanan;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesananmu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form method="post" class="checkout-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="place-order">
                                        <div class="order-total">
                                            <ul class="order-table">
                                                <li>Product <span>Total</span></li>
                                                <?php
                                                $query = mysqli_query($conn,"SELECT b.id_keranjang,a.nama_produk,a.harga_produk,b.quantity,b.id_detail_keranjang,b.status from tbl_keranjang c join tbl_detail_keranjang b on c.id_keranjang = b.id_keranjang join tbl_produk a on b.id_produk=a.id_produk where c.id_pembeli='$id_pembeli' and b.status='checkout'");
                                                $query2 = mysqli_query($conn,"select sum(quantity*harga_produk) as total_bayar from detail_keranjang where id_pembeli='$id_pembeli' and status='checkout'");
                                                $row = mysqli_fetch_array($query2);
                                                $total_bayar = $row['total_bayar'];
                                                while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                                    $nama_produk = $row['nama_produk'];
                                                    $harga_produk = $row['harga_produk'];
                                                    $id_detail_keranjang = $row['id_detail_keranjang'];
                                                    $quantity = $row['quantity'];
                                                    $id_keranjang = $row['id_keranjang'];
                                                    $total = $harga_produk * $quantity;

                                                ?>
                                                <li class="fw-normal"><?=$nama_produk;?> x <?=$quantity;?> <span><?=rupiah($total);?></span></li>
                                                <?php
                                                    }
                                                ?>
                                                <li class="fw-normal">Subtotal <span><?=rupiah($total_bayar);?></span></li>
                                                <li class="total-price">Total <span><?=rupiah($total_bayar);?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
                </div>
            </div>
        </div>

