    <?php
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
                                    <th>No.</th>
                                    <th>Kode Pesanan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    $query = mysqli_query($conn,"SELECT distinct a.id_pesanan, a.id_detail_keranjang, a.status FROM tbl_pesanan a join tbl_detail_keranjang b on a.id_detail_keranjang=b.id_detail_keranjang join tbl_keranjang c on b.id_keranjang=c.id_keranjang where c.id_pembeli='$id_pembeli' and a.status='Selesai'");
                                    while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                        $id_pesanan = $row['id_pesanan'];
                                        $id_detail_keranjang = $row['id_detail_keranjang'];
                                        $status = $row['status'];
                                ?>
                                <tr>
                                    <td><?=$no++;?></td>
                                    <td><?=$id_pesanan;?></td>
                                    <td><?=$status;?></td>
                                    <td>
                                        <a href="?halaman=detail_pesanan&id=<?=$id_detail_keranjang;?>" class="btn btn-info">Detail</a>
                                    </td>
                                    <!-- Modal -->
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
            $status = "Menunggu";
            $id = $_POST['id_pesanan'];
            $rand = rand();
            $ekstensi = array('png','jpg','jpeg');
            $filename1 = $_FILES['bukti']['name'];
            $ukuran1 = $_FILES['bukti']['size'];
            $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

            if(!in_array($ext1,$ekstensi)){
            echo "<script>
                swal('Gagal!', 'Ekstensi jpeg, jpg dan png', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=pesanan});
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