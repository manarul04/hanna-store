    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-jasa-pengiriman">
            + Tambah Jasa Pengiriman
          </button><br><br>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jasa Pengiriman</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Jasa Pengiriman</th>
                  <th>Gambar</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM tbl_jasa_pengiriman order by id_jasa_pengiriman desc");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $nama_jasa = $row['nama_jasa'];
                    $gambar_jasa = $row['gambar_jasa'];
                    $id = $row['id_jasa_pengiriman'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_jasa;?></td>
                  <td><img src="include/jasa_pengiriman/gambar_jasa/<?=$gambar_jasa;?>" width="50"></td>
                  <td>
                    <a href="?halaman=edit_jasa_pengiriman&id=<?=$id;?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <input type="hidden" class="delete_id_jasa_pengiriman" value="<?=$id;?>">
                    <a href="javascript:void(0)" class="delete_jasa_pengiriman btn btn-danger btn-sm">Hapus</a>
                  </td>
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
        <div class="modal fade" id="modal-jasa-pengiriman">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Jasa Pengiriman</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Jasa Pengiriman</label>
                      <input type="text" name="nama" class="form-control" placeholder="Nama Jasa Pengiriman.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Gambar</label>
                      <input type="file" name="ktp" class="form-control" required="">
                    </div>
                  </div>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" name="simpan" class="btn btn-primary">Save changes</button>
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
    $rand = rand();
    $ekstensi = array('png','jpg');
    $filename1 = $_FILES['ktp']['name'];
    $ukuran1 = $_FILES['ktp']['size'];
    $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);
      if(!in_array($ext1,$ekstensi)){
            echo "<script>
                swal('Gagal!', 'Ekstensi gambar jpg dan png', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=jasa_pengiriman'});
                </script>";
      }else{
        if($ukuran1 < 1044070){
            $ktp = $rand.'_'.$filename1;
            move_uploaded_file($_FILES['ktp']['tmp_name'], 'include/jasa_pengiriman/gambar_jasa/'.$rand.'_'.$filename1);
            $query = mysqli_query($conn,"INSERT INTO tbl_jasa_pengiriman (nama_jasa,gambar_jasa) VALUES ('$nama','$ktp')");
            if($query){
              echo "<script>
                swal('Berhasil!', 'Simpan Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=jasa_pengiriman'});
                </script>";
            }else{
              echo "<script>
                swal('Gagal!', 'Simpan Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=jasa_pengiriman'});
                </script>";
            }
        
        }else{
          echo "<script>
                swal('Gagal!', 'Ukuran gambar terlalu besar', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=jasa_pengiriman'});
                </script>";
        }
      }
      
    }
  
    
?>