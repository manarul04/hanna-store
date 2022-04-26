    <?php
        $id_pembeli = $_SESSION['idu'];
        if(isset($_GET['id'])){
            $id_detail_keranjang = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM pesanan where id_detail_keranjang='$id_detail_keranjang'");
            $query3 = mysqli_query($conn,"SELECT * FROM bayar where id_detail_keranjang='$id_detail_keranjang'");
            $row3 = mysqli_fetch_array($query3);
        }
    ?>

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form action="#" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Data Pembeli</h4>
                            <div class="order-total">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal pesanan</td>
                                            <td>:</td>
                                            <td><?=date("d-m-Y",strtotime($row3['tgl_pesanan']));?></td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td><?=$row3['penerima']?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Wa</td>
                                            <td>:</td>
                                            <td><?=$row3['no_wa']?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?=$row3['alamat']?></td>
                                        </tr>
                                        <tr>
                                            <td>Status</td>
                                            <td>:</td>
                                            <td><h3><?=$row3['status']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <h4>Bukti Pembayaran</h4>
                    <div class="order-total" style="text-align: center;">
                        <img src="include/pembeli/bukti/<?=$row3['bukti']?>" height="240px" alt="Belum Ada Bukti Pembayaran">
                    </div>   
                    </div>
                </div>
            </form><br>
            <form action="#" class="checkout-form">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="place-order">
                            <h4>Data Pesanan</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <?php 
                                        while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                            $nama_produk = $row['nama_produk'];
                                            $quantity = $row['quantity'];
                                            $harga_produk = $row['harga_produk'];
                                            $quantity = $row['quantity'];
                                        
                                    ?>
                                    <li class="fw-normal"><?=$nama_produk;?> x <?=$quantity;?> <span><?=rupiah($harga_produk);?></span></li>
                                    <?php
                                        }
                                    ?>
                                    <li class="fw-normal">Subtotal <span><?=rupiah($row3['total_bayar'])?></span></li>
                                    <li class="fw-normal">Ongkir <span><?=rupiah($row3['ongkir'])?></span></li>
                                    <li class="total-price">Total <span><?=rupiah($row3['total'])?></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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