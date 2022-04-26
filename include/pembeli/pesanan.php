    <?php
        error_reporting(0);
        $id_pembeli = $_SESSION['idu'];
    ?>

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    
                                    <th>ID Transaksi</th>
                                    <th>Penerima</th>
                                    <th>Alamat</th>
                                    <th>Resi</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $query = mysqli_query($conn,"SELECT * FROM `pesanan` where id_pembeli='$id_pembeli' GROUP by id_pesanan");
                                    while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                        $id_pesanan = $row['id_pesanan'];
                                        $id_detail_keranjang = $row['id_detail_keranjang'];
                                        $input = $row['input'];
                                        $deadline = $row['deadline'];
                                        $status = $row['status'];
                                ?>
                                <tr>
                                    
                                    <td><?=$id_pesanan;?></td>
                                    <td><?=$row['penerima'];?></td>
                                    <td><?=$row['alamat'];?></td>
                                    <td><?=$row['resi'];?></td>
                                    <td><?=number_format($row['total']);?></td>
                                    <?php
                                        if($status=="Belum"){
                                        $badge="danger";
                                        }elseif($status=="Sudah Bayar"){
                                        $badge="info";
                                        }elseif($status=="Diproses"){
                                        $badge="primary";
                                        }elseif($status=="Dikirim"){
                                        $badge="primary";
                                        }elseif($status=="Diterima"){
                                        $badge="success";
                                        }else{
                                        $badge="success";
                                        }
                                    ?>
                                    <td><span class="badge badge-<?=$badge;?>"><?=$status;?></span></td>
                                    <td>
                                        <?php
                                        $sekarang = date('Y-m-d ').substr($deadline,11);
                                            if($status=="Belum"){
                                                if($sekarang<$deadline){
                                                    ?>
                                                    <a href="javascript:void(0);" class="btn_pesanan btn btn-primary" data-toggle="modal" data-target="#exampleModal<?=$id_pesanan;?>">Bayar</a>
                                                <?php }else{?>
                                                    <a href="javascript:void(0);" class="btn_pesanan btn btn-secondary">Kadaluarsa</a>
                                                <?php } ?>
                                            
                                        
                                        <?php
                                            }elseif($status=="Dikirim"){
                                        ?>
                                        <a href="?halaman=pesanan&id=<?=$id_pesanan;?>" class="btn_pesanan btn btn-primary">Diterima</a>
                                        <?php
                                            }
                                        ?>
                                        <a href="?halaman=detail_pesanan&id=<?=$id_detail_keranjang;?>" class="btn btn-info">Detail</a>
                                        
                                        <?php
                                         
                                            if($status=="Belum" && $sekarang<$deadline){ echo "<p class='text-danger'>pembayaran diterima sebelum"." ".$deadline;}
                                        ?>
                                    </td>
                                    <!-- Modal -->"
                                    <div class="modal fade" id="exampleModal<?=$id_pesanan;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Rekening Toko</label>
                                                        <div style="text-align:center">
                                                        <p><?=$row['nama_metode'];?> <b><?=$row['no_metode'];?></b></p>
                                                        a/n: <?=$row['nama_penerima_pem'];?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id_pesanan" value="<?=$id_pesanan;?>">
                                                        <label for="exampleInputEmail1">Bukti Pembayaran</label>
                                                        <input type="file" name="bukti" class="form-control" required="">
                                                    </div>
                                            </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" name="konfirmasi" class="btn btn-primary">Konfirmasi</button>
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
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
    

    <?php
        if(isset($_POST['konfirmasi'])){
            $status = "Sudah bayar";
            $id = $_POST['id_pesanan'];
            $rand = rand();
            $ekstensi = array('jpg','jpeg','png');
            $filename1 = $_FILES['bukti']['name'];
            $ukuran1 = $_FILES['bukti']['size'];
            $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

            if(!in_array($ext1,$ekstensi)){
            echo "<script>
                        swal('Gagal!', 'File bukti pembayaran jpg, jpeg dan png', 'error',{
                        buttons: true}).then( () => {
                            location.href = '?halaman=pesanan'});
                        </script>";
            }else{
                if($ukuran1 < 1044070){
                    $bukti = $rand.'_'.$filename1;
                    move_uploaded_file($_FILES['bukti']['tmp_name'], 'include/pembeli/bukti/'.$rand.'_'.$filename1);
                    $query = mysqli_query($conn,"UPDATE tbl_pesanan SET status='$status', bukti='$bukti' WHERE id_pesanan='$id'");
                    if($query){
                        echo "<script>
                                swal('Berhasil!', 'Konfirmasi pembayaran berhasil', 'success',{
                                buttons: true}).then( () => {
                                    location.href = '?halaman=pesanan'});
                                </script>";
                    }else{
                        echo "<script>
                            swal('Gagal!', 'Konfirmasi pembayaran gagal', 'error',{
                                buttons: true}).then( () => {
                                location.href = '?halaman=pesanan'});
                            </script>";
                    }
                }else{
                    echo "<script>
                        swal('Gagal!', 'Ukuran file terlalu besar', 'error',{
                        buttons: true}).then( () => {
                            location.href = '?halaman=pesanan'});
                        </script>";
                }
            }
                
        }
    ?>

    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $status = "Selesai";
            $update = mysqli_query($conn,"UPDATE tbl_pesanan SET status='$status' WHERE id_pesanan='$id'");
            if($update){
                     echo  "<meta http-equiv='refresh' content='0; url=?halaman=pesanan'>";
                    }
        }
        
    ?>