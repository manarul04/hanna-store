    <?php
        error_reporting(0);
        $id_pembeli = $_SESSION['idu'];
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_produk NATURAL JOIN tbl_kategori WHERE id_produk='$id'");
            $row = mysqli_fetch_array($query);
            $nama_produk = $row['nama_produk'];
            $nama_kategori = $row['nama_kategori'];
            $jumlah_produk = $row['jumlah_produk'];
            $harga_produk = $row['harga_produk'];
            $gambar_produk = $row['gambar_produk'];
            $id_produk = $row['id_produk'];
        }
    
    ?>
    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6">
                    <div class="blog-details-inner">
                        <div class="blog-detail-title">
                            <h2><?=$nama_produk;?></h2>
                            <p><?=$nama_kategori;?></p>
                        </div>
                        <center>
                            <div class="blog-small-pic">
                                <span class="cart-pic first-row"><img src="admin/include/produk/gambar_produk/<?=$gambar_produk;?>" width="250" alt=""></span>
                            </div>
                        </center><br>
                        <div class="blog-quote">
                            <p>“ Stok : <?=$jumlah_produk;?>”<br> “ Harga : <?=rupiah($harga_produk);?>”</p>
                        </div>
                        <form method="post">
                            <div class="group-input">
                                <label>Beli *</label>
                                <input type="number" name="quantity" class="form-control" required="" autofocus>
                            </div><br>
                            <button type="submit" name="simpan" class="btn btn-lg btn-primary">+ Add Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- Blog Details Section End -->
    
    <?php
        if(isset($_POST['simpan'])){
            $quantity = $_POST['quantity'];
            $total = $harga_produk * $quantity;
            $goblok = $jumlah_produk - $quantity;
            if($quantity > $jumlah_produk){
                echo "<script>
                    swal('Gagal!', 'Stok terbatas', 'error',{
                        buttons: true}).then( () => {
                        location.href = '?halaman=detail&id=$id'});
                    </script>";
            }else{
                $querycek = mysqli_query($conn,"SELECT * from tbl_keranjang where id_pembeli='$id_pembeli'");
                $row = mysqli_fetch_array($querycek);
                $idkeranjang = $row['id_keranjang'];
                $data = mysqli_num_rows($querycek);
                if($data<1){
                    $query = mysqli_query($conn,"INSERT INTO tbl_keranjang (id_pembeli) VALUES ('$id_pembeli')");
                    $querycek2 = mysqli_query($conn,"SELECT * from tbl_keranjang where id_pembeli='$id_pembeli'");
                    $row = mysqli_fetch_array($querycek2);
                    $idkeranjang = $row['id_keranjang'];
                }
                $querycek3 = mysqli_query($conn,"SELECT * from tbl_detail_keranjang join tbl_keranjang on tbl_detail_keranjang.id_keranjang = tbl_keranjang.id_keranjang where status='belum' and id_pembeli='$id_pembeli'");
                $row3 = mysqli_fetch_array($querycek3);
                $id_detail_keranjang = $row3['id_detail_keranjang'];
                $cek_keranjang = mysqli_num_rows($querycek3);

                $select_max = mysqli_query($conn,"SELECT max(id_detail_keranjang) as max from tbl_detail_keranjang");
                $row = mysqli_fetch_array($select_max);
                $max = $row['max']+1;
                if($max==null){
                    $max=1;
                }
                $quantity_update = mysqli_query($conn,"SELECT * FROM detail_keranjang WHERE id_produk='$id_produk' and status='belum' and id_pembeli='$id_pembeli'");
                $row = mysqli_fetch_array($quantity_update);
                $id_produk2 = $row['id_produk'];
                $quantity_lama = $row['quantity'];
                $hasil_quantity = $quantity + $quantity_lama;

                if($id_produk==$id_produk2){
                    $query2 = mysqli_query($conn,"UPDATE tbl_detail_keranjang SET quantity='$hasil_quantity' WHERE id_produk='$id_produk' and status='belum'");
                    $query2 = mysqli_query($conn,"UPDATE tbl_produk SET jumlah_produk='$goblok' WHERE id_produk='$id_produk'");
                }elseif($cek_keranjang<1){
                    $query2 = mysqli_query($conn,"INSERT INTO tbl_detail_keranjang (id_detail_keranjang,id_keranjang,quantity,id_produk) VALUES ('$max','$idkeranjang','$quantity','$id_produk')");
                }else{
                    $query2 = mysqli_query($conn,"UPDATE tbl_produk SET jumlah_produk='$goblok' WHERE id_produk='$id_produk'");
                    $query2 = mysqli_query($conn,"INSERT INTO tbl_detail_keranjang (id_detail_keranjang,id_keranjang,quantity,id_produk) VALUES ('$id_detail_keranjang','$idkeranjang','$quantity','$id_produk')");
                }
                if($query && $query2){
                    echo "<meta http-equiv='refresh' content='0; url=?halaman=cart'>";
                }else{
                    echo "<script>
                        swal('Gagal!', 'Add Cart Gagal', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=detail&id=$id'});
                        </script>";
                }
            }
        }
    ?>