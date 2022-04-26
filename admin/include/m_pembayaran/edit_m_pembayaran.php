    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_metode_pembayaran WHERE id_metode_pembayaran='$id'");
            $row = mysqli_fetch_array($query);
            $nama_metode = $row['nama_metode'];
            $no_metode = $row['no_metode'];
            $nama_penerima_pem = $row['nama_penerima_pem'];
            $gambar_pem = $row['gambar_pem'];
        }
    ?>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Rekening Toko</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Rekening Toko</label>
                      <input type="text" name="nama" class="form-control" value="<?=$nama_metode;?>" placeholder="Rekening Toko.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Penerima Pembayaran</label>
                      <input type="text" name="nama_penerima_pem" class="form-control" value="<?=$nama_penerima_pem;?>" placeholder="Nama Penerima Pembayaran.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Tujuan</label>
                      <input type="number" name="no_tujuan" class="form-control" value="<?=$no_metode;?>" placeholder="Nomor Tujuan.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar Rekening Toko</label><br>
                      <img src="include/m_pembayaran/gambar_pembayaran/<?=$gambar_pem;?>" width="50" alt="GAMBAR">
                      <input type="file" name="gambar_pem" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="?halaman=m_pembayaran" class="btn btn-default">Kembali</a>
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
      $no_tujuan = $_POST['no_tujuan'];
      $nama_penerima = $_POST['nama_penerima_pem'];
      $rand = rand();
      $ekstensi = array('png','jpg');
      $filename1 = $_FILES['gambar_pem']['name'];
      $ukuran1 = $_FILES['gambar_pem']['size'];
      $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

      if(!in_array($ext1,$ekstensi)){
            echo "<script>
                swal('Gagal!', 'Ekstensi gambar jpg dan png', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_m_pembayaran&id=$id'});
                </script>";
      }else{
        if($ukuran1 < 1044070){
          if($gambar_pem==$filename1){
              $gambar = $filename1;
              move_uploaded_file($_FILES['gambar_pem']['tmp_name'], 'include/m_pembayaran/gambar_pembayaran/'.$filename1);
          }else{
            $gambar = $rand.'_'.$filename1;
            move_uploaded_file($_FILES['gambar_pem']['tmp_name'], 'include/m_pembayaran/gambar_pembayaran/'.$rand.'_'.$filename1);
          }
          $query = mysqli_query($conn,"UPDATE tbl_metode_pembayaran SET nama_metode='$nama',no_metode='$no_tujuan',nama_penerima_pem='$nama_penerima',gambar_pem='$gambar' WHERE id_metode_pembayaran='$id'");
          if($query){
              echo "<script>
                    swal('Berhasil!', 'Ubah Berhasil', 'success',{
                      buttons: true}).then( () => {
                        location.href = '?halaman=edit_m_pembayaran&id=$id'});
                    </script>";
          }else{
              echo "<script>
                    swal('Gagal!', 'Ubah Gagal', 'error',{
                      buttons: true}).then( () => {
                        location.href = '?halaman=edit_m_pembayaran&id=$id'});
                    </script>";
          }

        }else{
            echo "<script>
                swal('Gagal!', 'Ukuran gambar terlalu besar', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_m_pembayaran&id=$id'});
                </script>";
        }
      }

      
    }
  ?>