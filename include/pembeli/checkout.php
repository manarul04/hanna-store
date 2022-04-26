    <?php
        $id_pembeli = $_SESSION['idu'];
        require_once("database-function.php");
    ?>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="checkout-section spad">
        <div class="container">
            <form method="post" class="checkout-form">
                <div class="row">
                    <div class="col-lg-6">
                        <h4>Biiling Details</h4>
                        <div class="row">
                            <div class="col-lg-12">
                            <label for="fir">Penerima<span>*</span></label>
                            <input type="text" name="penerima" id="fir" required="" autofocus/>
                            </div>
                            <div class="col-lg-12">
                            <label for="cun-name">No Wa</label>
                            <input type="number" name="no_wa" id="cun-name" required="" />
                            </div>
                            <div class="col-lg-12">
                            <label for="cun">Alamat<span>*</span></label>
                            <input type="text" name="alamat" required="" />
                            </div>
                            <div class="col-lg-12">
                            <label for="cun">Ongkir<span>*</span></label> 
                                <div class="row" id="response">
                                
                                <div class="col-sm-4" >
                                    <input type="text" class="form-control text-uppercase" id="kurir" name="kurir" readonly>
                                </div>
                                <div class="col-sm-5" >
                                    <input type="text" class="form-control" id="biaya" name="biaya" readonly required>
                                </div>
                                <div class="col-sm-3">
                                    <a href="#" class="primary-btn" data-toggle="modal" data-target="#cekOngkir" data-backdrop="static" data-keyboard="false">Cek</a>
                                </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-12">
                            <label for="cun">Rekening Toko<span>*</span></label>
                            <select name="metode_pem" class="form-control" required>
                                <option disabled="" selected="">Pilih</option>
                                <?php
                                    $query = mysqli_query($conn,"SELECT * FROM tbl_metode_pembayaran");
                                    while($row = mysqli_fetch_array($query)){
                                        $id_metode_pem = $row['id_metode_pembayaran'];
                                        $nama_metode = $row['nama_metode'];
                                        $gambar_pem = $row['gambar_pem'];
                                        
                                        ?>
                                        <option value="<?=$id_metode_pem;?>"><?=$nama_metode;?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                            </div>

                        </div>
                        </div>
                    <div class="col-lg-6">
                        <div class="place-order">
                            <h4>Your Order</h4>
                            <div class="order-total">
                                <ul class="order-table">
                                    <li>Product <span>Total</span></li>
                                    <?php
                                    $qt="0";
                                    $query = mysqli_query($conn,"SELECT * from detail_keranjang where id_pembeli='$id_pembeli' and status='belum'");
                                    $query2 = mysqli_query($conn,"select sum(quantity*harga_produk) as total_bayar from detail_keranjang where id_pembeli='$id_pembeli' and status='belum'");
                                    $row = mysqli_fetch_array($query2);
                                    $total_bayar = $row['total_bayar'];
                                    while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                        $nama_produk = $row['nama_produk'];
                                        $harga_produk = $row['harga_produk'];
                                        $id_detail_keranjang = $row['id_detail_keranjang'];
                                        $quantity = $row['quantity'];
                                        $id_keranjang = $row['id_keranjang'];
                                        $qt+=$quantity;
                                    ?>
                                    <li class="fw-normal"><?=$nama_produk;?> x <?=$quantity;?> <span><?=rupiah($harga_produk*$quantity);?></span></li>
                                    
                                    <?php
                                        }
                                        
                                    ?>
                                    <li class="fw-normal">Subtotal <span><?=rupiah($total_bayar);?></span></li>
                                    <script>
                                    function myFunction() {
                                        var biaya = document.getElementById("biaya");
                                        if(biaya.value!=""){
                                            document.getElementById("totalongkir").innerHTML = "Rp "+biaya.value.toLocaleString();
                                            var total = parseInt(biaya.value)+parseInt(<?=$total_bayar?>);
                                            document.getElementById("total").innerHTML = "Rp "+total.toLocaleString();
                                        }else{
                                            $("#cekOngkir").modal('show');
                                        }
                                        
                                    }
                                    </script>
                                    <li class="fw-normal" onclick="myFunction()">Ongkir <span id="totalongkir" ><p class="text-muted small"><i>Update</i></p></span></li>
                                    <li class="total-price" onclick="myFunction()">Total <span id="total"><p class="text-muted small"><i>Update</i></p></span></li>
                                </ul>
                                <div class="order-btn">
                                    <button type="submit" name="submit" class="site-btn place-btn">Konfirmasi Pesanan</button>
                                    <!-- <a href="<?=$index;?>" type="submit" name="submit" class="site-btn place-btn">Beli lagi</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    <!-- <?php
    function stok($q,$i){
        global $conn;
        $jumlah=0;
        $query = mysqli_query($conn,"SELECT * FROM tbl_produk where id_produk='$i'");
        $row = mysqli_fetch_array($query);
        $stok = $row['jumlah_produk'];

        $jumlah = $stok-$q;

        $update = mysqli_query($conn,"UPDATE tbl_produk SET jumlah_produk='$jumlah' where id_produk='$i'");
    }
    ?> -->
    <?php
        if(isset($_POST['submit'])){
            $query = mysqli_query($conn,"SELECT * from detail_keranjang where id_detail_keranjang='$id_detail_keranjang' and status='belum'");
                while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                $nama_produk = $row['nama_produk'];
                $idproduk = $row['id_produk'];
                $quantity = $row['quantity'];
                // echo $nama_produk;
                    // stok($quantity,$idproduk);
                    $query2 = mysqli_query($conn,"SELECT * FROM tbl_produk where id_produk='$idproduk'");
                    $row2 = mysqli_fetch_array($query2);
                    $stok = $row2['jumlah_produk'];

                    $jumlah = "0";
                    $jumlah = $stok-$quantity;

                    $update = mysqli_query($conn,"UPDATE tbl_produk SET jumlah_produk='$jumlah' where id_produk='$idproduk'");
                }

           
            $penerima = $_POST['penerima'];
            $no_wa = $_POST['no_wa'];
            $alamat = $_POST['alamat'];
            $ongkir = $_POST['biaya'];
            $total = $total_bayar+$ongkir;
            $id_pem = $_POST['metode_pem'];
            $tgl_pesanan = date("Y-m-d");
            
            
            $query = mysqli_query($conn,"UPDATE tbl_detail_keranjang SET status='checkout' WHERE id_keranjang='$id_keranjang'");
            if($query){
                 $query2 = mysqli_query($conn,"INSERT INTO tbl_pesanan (id_detail_keranjang,penerima,no_wa,alamat,id_metode_pembayaran,tgl_pesanan,ongkir,total) values ('$id_detail_keranjang','$penerima','$no_wa','$alamat','$id_pem','$tgl_pesanan','$ongkir','$total')");
                    echo "<script>
                        swal('Berhasil!', 'Pesanan berhasil dicheckout', 'success',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=pesanan'});
                        </script>";
                }else{
                    echo "<script>
                        swal('Gagal!', 'Pesanan gagal dicheckout', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=pesanan'});
                        </script>";
                }
        }
    ?>

<!-- Modal -->
<div class="modal fade" id="cekOngkir" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cek Ongkir</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="myFunction()">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                
                <div class="container">
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                        <form class="form-horizontal" id="ongkir" method="POST">
                            <!-- <div class="form-group">
                            <label class="control-label col-sm-3">Kota Asal:</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="kota_asal" name="kota_asal" >
                                </select>
                            </div>
                            </div> -->
                            <div class="form-group">
                            <label class="control-label col-sm-3">Kota Tujuan</label>
                            <div class="col-sm-12">          
                                <select class="form-control" id="kota_tujuan" name="kota_tujuan" required="">
                                <option></option>
                                </select>
                            </div>
                            </div>
                            <!-- <div class="form-group">
                            <label class="control-label col-sm-3">Kurir</label>
                            <div class="col-sm-12"> 
                                    <input type="text" class="form-control" id="berat" name="berat" value="<?=$qt?>" readonly>
                            </div> 
                            </div> -->
                            <div class="form-group">
                            <label class="control-label col-sm-3">Kurir</label>
                            <div class="col-sm-12">          
                                <select class="form-control" id="kurir" name="kurir" required="">
                                <option value="jne">JNE</option>
                                <option value="tiki">TIKI</option>
                                <option value="pos">POS INDONESIA</option>
                                </select>
                            </div>
                            </div>
                            <!-- <div class="form-group">
                            <label class="control-label col-sm-3">Berat (Kg)</label>
                            <div class="col-sm-12">          
                                <input type="text" class="form-control" id="berat" name="berat" required="">
                            </div>
                            </div> -->
                            <div class="form-group" id="response">      
                            </div>
                            <div class="form-group">        
                            <div class="col-sm-offset-3 col-sm-8">
                                
                            </div>
                            </div>
                        
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="myFunction()">Close</button>
                <button type="submit" class="btn btn-warning"><i class="icon_bag_alt"></i> Cek</button>
                
                <!-- <a class="btn btn-warning" href="?halaman=detail&id=<?=$produk['id_produk'];?>"><i class="icon_bag_alt"></i> Keranjang</a> -->
            </div>
            </form>
        </div>
    </div>
</div>


    