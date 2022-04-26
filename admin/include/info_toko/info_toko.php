    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-kategori">
            + Tambah
          </button><br><br> -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Info Toko</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Toko</th>
                  <th>No. HP</th>
                  <th>Facebook</th>
                  <th>Instagram</th>
                  <th>Alamat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM info_toko");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $nama_toko = $row['nama_toko'];
                    $nohp = $row['no'];
                    $fb = $row['fb'];
                    $ig = $row['ig'];
                    $alamat = $row['alamat'];
                    $email = $row['email'];
                    $id = $row['id'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_toko;?></td>
                  <td><?=$nohp;?></td>
                  <td><?=$fb;?></td>
                  <td><?=$ig;?></td>
                  <td><?=$alamat;?></td>
                  <td><?=$email;?></td>
                  <td>
                    <a href="?halaman=edit_info&id=<?=$id;?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <input type="hidden" class="delete_info_toko" value="<?=$id;?>">
                    <!-- <a href="javascript:void(0)" class="btn_delete_info_toko btn btn-danger btn-sm">Hapus</a> -->
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
        <div class="modal fade" id="modal-kategori">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Info Toko</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Toko</label>
                      <input type="text" name="nama_toko" class="form-control" placeholder="Nama Toko.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">No. HP</label>
                      <input type="number" name="no" class="form-control" placeholder="No. HP.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Facebook</label>
                      <input type="text" name="fb" class="form-control" placeholder="Instagram.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Instagram</label>
                      <input type="text" name="ig" class="form-control" placeholder="Instagram.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" name="alamat" class="form-control" placeholder="Alamat.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Email.." required="" autofocus="">
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
        $query = mysqli_query($conn,"SELECT * FROM info_toko");
        $jml = mysqli_num_rows($query);
        if($jml=="1"){
            echo "<script>
                swal('Gagal!', 'Data info sudah ada tidak bisa menambahkan', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=info_toko'});
                </script>";
        }else{
        $nama_toko = $_POST['nama_toko'];
        $no = $_POST['no'];
        $fb = $_POST['fb'];
        $ig = $_POST['ig'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];

      $query = mysqli_query($conn,"INSERT INTO info_toko (nama_toko,no,fb,ig,alamat,email) VALUES ('$nama_toko','$no','$fb','$ig','$alamat','$email')");
      
      if($query){
          echo "<script>
                swal('Berhasil!', 'Simpan Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=info_toko'});
                </script>";
      }else{
        echo "<script>
              swal('Gagal!', 'Simpan Gagal', 'error',{
                buttons: true}).then( () => {
                  location.href = '?halaman=info_toko'});
              </script>";
      }
    }
    }
  ?>

