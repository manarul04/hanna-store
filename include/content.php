    <?php
        error_reporting(0);
        $hak_akses = $_SESSION['hak_akses'];
    ?>
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="img/hero-1.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Tas</span>
                            <h1>Harga Terjangkau</h1>
                            <p>Kami menghadirkan tas dengan harga Terjangkau</p>
                            <a href="?halaman=shop" class="primary-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                    <div class="off-card">
                        <h2>Promo </h2>
                    </div>
                </div>
            </div>
            <div class="single-hero-items set-bg" data-setbg="img/hero-2.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Tas</span>
                            <h1>Kualitas Oke</h1>
                            <p>Produk yang kami kirim sudah melalui ujicoba dan pengecekan untuk menjamin kualitas</p>
                            <a href="?halaman=shop" class="primary-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                    <!-- <div class="off-card">
                        <h2>Sale <span>50%</span></h2>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
 
    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="filter-control">
                        <ul>
                            <li class="active">PRODUK</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel">
                        <?php
                            $query = mysqli_query($conn,"SELECT * FROM tbl_produk NATURAL JOIN tbl_kategori");
                            while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                $nama_produk = $row['nama_produk'];
                                $nama_kategori = $row['nama_kategori'];
                                $id = $row['id_produk'];
                                $gambar_produk = $row['gambar_produk'];
                                $harga_produk = $row['harga_produk'];
                                $jumlah_produk = $row['jumlah_produk'];
                        ?>
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="admin/include/produk/gambar_produk/<?=$gambar_produk;?>" width="50" alt="">
                               
                                <ul>
                                    
                                    <li class="w-icon active"><a href="?halaman=detail&id=<?=$id?>">+ Keranjang</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name"><?=$nama_kategori;?></div>
                                <a href="#">
                                    <h5><?=$nama_produk;?></h5>
                                </a>
                                <!-- <div class="product-price">
                                    Stok : <?=$jumlah_produk;?>
                                </div> -->
                                <div class="product-price">
                                    <?=rupiah($harga_produk);?>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                            }
                        ?>
                    </div>
                    <center><a href="?halaman=shop" class="primary-btn" style="margin-top:20px">Belanja Sekarang</a></center>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
  
   