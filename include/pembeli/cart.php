    <?php
        $id_pembeli = $_SESSION['idu'];
    ?>

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th class="p-name">Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th><i class="ti-close"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($conn,"SELECT a.id_produk,a.gambar_produk,a.nama_produk,a.harga_produk,b.quantity,b.id_detail_keranjang,b.status from tbl_keranjang c join tbl_detail_keranjang b on c.id_keranjang = b.id_keranjang join tbl_produk a on b.id_produk=a.id_produk where c.id_pembeli='$id_pembeli' and b.status='belum'");
                                    while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                        $nama_produk = $row['nama_produk'];
                                        $harga_produk = $row['harga_produk'];
                                        $id_detail_keranjang = $row['id_detail_keranjang'];
                                        $quantity = $row['quantity'];
                                        $status = $row['status'];
                                        $id_produk = $row['id_produk'];
                                        $gambar_produk = $row['gambar_produk'];
                                        $total = $harga_produk * $quantity;


                                ?>
                                <tr>
                                    <td class="cart-pic first-row"><img src="admin/include/produk/gambar_produk/<?=$gambar_produk;?>" width="100" alt=""></td>
                                    <td class="cart-title first-row">
                                        <h5><?=$nama_produk;?></h5>
                                    </td>
                                    <td class="p-price first-row"><?=rupiah($harga_produk);?></td>
                                    <td class="p-price first-row"><?=$quantity;?></td>
                                    <form method="post">
                                    <td class="total-price first-row"><?=rupiah($total);?></td>
                                    <td class="close-td first-row">
                                        <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modal-hapus<?=$id_produk;?>"><i class="ti-close"></i></a>
                                    </td>
                                    <div class="modal fade" id="modal-hapus<?=$id_produk;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post">
                                                        <input type="hidden" name="id" value="<?=$id_produk;?>">
                                                    <h4><strong>Apakah anda yakin menghapus data ini?</strong></h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    <button type="submit" name="hapus" class="btn btn-primary">Ya</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="cart-buttons">
                                <!-- <a href="#" class="primary-btn continue-shop">Continue shopping</a>
                                <button type="submit" name="ubah" class="primary-btn up-cart">Update cart</button> -->
                            </div>
                            </form>
                            <!-- <div class="discount-coupon">
                                <h6>Discount Codes</h6>
                                <form action="#" class="coupon-form">
                                    <input type="text" placeholder="Enter your codes">
                                    <button type="submit" class="site-btn coupon-btn">Apply</button>
                                </form>
                            </div> -->
                        </div>
                        <div class="col-lg-4 offset-lg-4">
                            <div class="proceed-checkout">
                                <ul>
                                    <?php
                                        $query = mysqli_query($conn,"SELECT sum(quantity*harga_produk) as total_bayar from detail_keranjang where status='belum' and id_pembeli='$id_pembeli'");
                                        $row = mysqli_fetch_array($query);
                                        $total = $row['total_bayar'];
                                    ?>
                                    <li class="subtotal">Subtotal <span><?=rupiah($total);?></span></li>
                                    <li class="cart-total">Total <span><?=rupiah($total);?></span></li>
                                </ul>
                                <a href="?halaman=checkout" class="proceed-btn">PROCEED TO CHECK OUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <?php
        if(isset($_POST['ubah'])){
            $new_quantity = $_POST['new_quantity'];
            if($new_quantity > $quantity){
                echo "<script>
                    swal('Gagal!', 'Quantity Melebihi Batas Jumlah Produk', 'error',{
                        buttons: true}).then( () => {
                        location.href = '?halaman=cart'});
                    </script>";
            }else{
                $query2 = mysqli_query($conn,"UPDATE tbl_detail_keranjang SET quantity='$new_quantity' WHERE id_detail_keranjang='$id_detail_keranjang'");
                if($query==TRUE && $query2==TRUE){
                    echo "<script>
                        swal('Berhasil!', 'Ubah Cart Berhasil', 'success',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=cart'});
                        </script>";
                }else{
                    echo "<script>
                        swal('Gagal!', 'Add Cart Gagal', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=cart'});
                        </script>";
                }
            }
        }
    ?>

    <?php
        if(isset($_POST['hapus'])){
            $id_produk = $_POST['id'];
            $query = mysqli_query($conn,"DELETE  FROM tbl_detail_keranjang WHERE id_produk='$id_produk' and status='Belum'");
            if($query){
                echo "<meta http-equiv='refresh' content='0; url=?halaman=cart'>";
            }
        }
    ?>