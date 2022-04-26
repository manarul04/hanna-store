    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-m-pembayaran">
            + Tambah Rekening Toko
          </button><br><br>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Produk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Rekening Toko</th>
                  <th>Nomor Tujuan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM tbl_metode_pembayaran order by id_metode_pembayaran desc");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $nama_metode = $row['nama_metode'];
                    $no_metode = $row['no_metode'];
                    $id = $row['id_metode_pembayaran'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_metode;?></td>
                  <td><?=$no_metode;?></td>
                  <td>
                    <a href="?halaman=edit_m_pembayaran&id=<?=$id;?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?=$id;?>">
                      Hapus
                    </button>
                  </td>
                  <div class="modal fade" id="modal-hapus<?=$id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="id" value="<?=$id;?>">
                            <center><h3 style="text-transform:uppercase"><strong>Apakah anda yakin hapus data ini?</strong></h3></center>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                          <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="modal fade" id="modal-m-pembayaran">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Rekening Toko</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Rekening Toko</label>
                      <input type="text" name="nama" class="form-control" placeholder="Nama Rekening Toko.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Penerima</label>
                      <input type="text" name="nama_penerima_pem" class="form-control" placeholder="Nama Penerima.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nomor Tujuan</label>
                      <input type="number" name="no_tujuan" class="form-control" placeholder="Nomor Tujuan.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label>
                      <input type="file" name="gambar_pem" class="form-control" required="">
                    </div>
                  </div>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <?php
    if(isset($_POST['simpan'])){
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
            $gambar = $rand.'_'.$filename1;
            move_uploaded_file($_FILES['gambar_pem']['tmp_name'], 'include/m_pembayaran/gambar_pembayaran/'.$rand.'_'.$filename1);
         $query = mysqli_query($conn,"INSERT INTO tbl_metode_pembayaran (nama_metode,no_metode,nama_penerima_pem,gambar_pem) VALUES ('$nama','$no_tujuan','$nama_penerima','$gambar')");
      
          if($query){
              echo "<script>
                    swal('Berhasil!', 'Simpan Berhasil', 'success',{
                      buttons: true}).then( () => {
                        location.href = '?halaman=m_pembayaran'});
                    </script>";
          }else{
              echo "<script>
                  swal('Gagal!', 'Simpan Gagal', 'error',{
                    buttons: true}).then( () => {
                      location.href = '?halaman=m_pembayaran'});
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
      

    }elseif(isset($_POST['hapus'])){
      $id = $_POST['id'];
      $query = mysqli_query($conn,"DELETE FROM tbl_metode_pembayaran WHERE id_metode_pembayaran='$id'");
      if($query){
        echo "<script>
                swal('Berhasil!', 'Data berhasil dihapus', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=m_pembayaran'});
                </script>";
      }
    }
  ?>

