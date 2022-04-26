
    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <div class="select-option">
                                    <!-- <select class="sorting">
                                        <option value="">Default Sorting</option>
                                    </select> -->
                                    
                                </div>
                            </div>
                            <!-- <div class="col-lg-5 col-md-5 text-right">
                                <p>Show 01- 09 Of 36 Product</p>
                            </div> -->
                        </div>
                    </div>
                    <div class="product-list">
                        <div class="row">
                        <?php
                            $query = mysqli_query($conn,"SELECT * from produk");
                            while($produk=mysqli_fetch_array($query)){
                        ?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="product-item">
                                    <div class="pi-pic">
                                        <!-- <img src="img/products/product-1.jpg" alt=""> -->
                                        <img src="admin/include/produk/gambar_produk/<?=$produk['gambar_produk'];?>" width="50" alt="">
                                        
                                        <ul>
                                            <li class="quick-view"><a href="#" data-toggle="modal" data-target="#exampleModal<?=$produk['id_produk'];?>"><i class="icon_info"></i></a></li>
                                            <li class="w-icon active"><a href="?halaman=detail&id=<?=$produk['id_produk'];?>">+ Keranjang</a></li>
                                        </ul>
                                    </div>
                                    <div class="pi-text">
                                        <div class="catagory-name"><?=$produk['nama_kategori'];?></div>
                                        <a href="#">
                                            <h5><?=$produk['nama_produk'];?></h5>
                                        </a>
                                        <div class="product-price">
                                        Rp <?=$produk['harga_produk'];?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?=$produk['id_produk'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
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
                                                            <div class="order-total" style="padding-bottom: 0px;">
                                                                <ul class="order-table">
                                                                    <li><?=$produk['nama_produk'];?></li>
                                                                    <div class="row" style="margin-top:30px">
                                                                        <div class="col-lg-4">
                                                                            <img src="admin/include/produk/gambar_produk/<?=$produk['gambar_produk'];?>" width="170" alt="">
                                                                            
                                                                        </div>
                                                                        <div class="col-lg-8">
                                                                            <h2><?=$produk['nama_produk'];?></h2>
                                                                            <span class="label label-primary">Kategori: <?=$produk['nama_kategori'];?></span>
                                                                            <span class="label label-primary">Stok: <?=$produk['jumlah_produk'];?></span>
                                                                            <h4 class="text-warning"><?=$produk['harga_produk'];?></h4>
                                                                            <?=$produk['deskripsi'];?>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a class="btn btn-warning" href="?halaman=detail&id=<?=$produk['id_produk'];?>"><i class="icon_bag_alt"></i> Keranjang</a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->
        