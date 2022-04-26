    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_jasa_pengiriman WHERE id_jasa_pengiriman='$id'");
            $row = mysqli_fetch_array($query);
            $nama_jasa = $row['nama_jasa'];
            $gambar_jasa = $row['gambar_jasa'];
        }
    ?>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Jasa Pengiriman</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jasa Pengiriman</label>
                      <input type="text" name="nama" class="form-control" value="<?=$nama_jasa;?>" placeholder="Nama Jasa Pengiriman.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label><br>
                      <img src="include/jasa_pengiriman/gambar_jasa/<?=$gambar_jasa;?>" width="100">
                      <input type="file" name="gambar" class="form-control" required="">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="?halaman=jasa_pengiriman" class="btn btn-default">Kembali</a>
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  <?php
    if(isset($_POST['ubah'])){
      $nama = $_POST['nama'];
      $gambar = $_POST['gambar'];

          $query = mysqli_query($conn,"UPDATE tbl_jenis_pembayaran SET nama_jasa='$nama',gambar_jasa='$gambar' WHERE id_jasa_pengiriman='$id'");
            if($query){
                echo "<script>
                        swal('Berhasil!', 'Ubah Berhasil', 'success',{
                        buttons: true}).then( () => {
                            location.href = '?halaman=edit_jasa_pengiriman&id=$id'});
                        </script>";
            }else{
                echo "<script>
                        swal('Gagal!', 'Ubah Gagal', 'error',{
                        buttons: true}).then( () => {
                            location.href = '?halaman=edit_jasa_pengiriman&id=$id'});
                        </script>";
            }
      
    }
  ?>