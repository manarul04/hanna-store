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
                        <span>Profil</span>
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
                    <div class="col-lg-12">
                    <?php
                        $query = mysqli_query($conn,"SELECT * FROM tbl_pembeli  where idu=$id_pembeli");
                        $row = mysqli_fetch_array($query);
                    ?> 
                        <h4>Profil</h4>
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="fir">Nama<span>*</span></label>
                                <input type="text" name="nama" id="fir" required="" value="<?=$row['nama_pembeli'];?>" autofocus/>
                            </div>
                            <div class="col-lg-12">
                                <label for="cun-name">Alamat</label>
                                <input type="text" name="alamat" id="cun-name" value="<?=$row['alamat'];?>" required="" />
                            </div>
                            <div class="col-lg-12">
                                <label for="cun">Jenis Kelamin<span>*</span></label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="L" <?php if($row['jenis_kelamin']=="L"){echo 'selected';}?>>Laki-laki</option>
                                    <option value="P" <?php if($row['jenis_kelamin']=="P"){echo 'selected';}?>>Perempuan</option>
                                </select>
                            </div>
                            <?php
                                $query2 = mysqli_query($conn,"SELECT * FROM tbl_pengguna  where idu=$id_pembeli");
                                $row2 = mysqli_fetch_array($query2);
                            ?>
                            <div class="col-lg-12">
                                <label for="fir">username<span>*</span></label>
                                <input type="text" name="username" id="fir" required="" value="<?=$row2['username'];?>" />
                            </div>
                            <div class="col-lg-12">
                                <label for="fir">password<span>*</span></label>
                                <input type="text" name="password" id="fir" required="" value="<?=$row2['password'];?>" />
                            </div>
                        </div>
                        </div>
                        <div class="order-btn">
                            <button type="submit" name="submit" class="site-btn place-btn">Perbarui</button>
                        </div>
                </div>
            </form>
        </div>
    </section>
    
    <?php
        if(isset($_POST['submit'])){
            
            $nama = $_POST['nama'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $alamat = $_POST['alamat'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            
            $update = mysqli_query($conn,"UPDATE `tbl_pembeli` SET `nama_pembeli` = '$nama',`jenis_kelamin` = '$jenis_kelamin', `alamat` = '$alamat' WHERE `tbl_pembeli`.`id_pembeli` = '$id_pembeli';");
            if($update){
                 $update2 = mysqli_query($conn,"UPDATE `tbl_pengguna` SET `username` = '$username', `password` = '$password' WHERE `tbl_pengguna`.`idu` = '$id_pembeli';");
                    echo "<script>
                        swal('Berhasil!', 'Berhasil diupdate', 'success',{
                            buttons: true}).then( () => {
                            location.href = 'index.php'});
                        </script>";
                }else{
                    echo "<script>
                        swal('Gagal!', 'Gagal diupdate', 'error',{
                            buttons: true}).then( () => {
                            location.href = 'index.php'});
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


    