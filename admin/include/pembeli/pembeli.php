    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-pembeli" >
            + Tambah Pembeli
          </button><br><br> -->
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Admin</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Pembeli</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM tbl_pengguna WHERE hak_akses='Pembeli' ORDER BY idu DESC");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $nama_pembeli = $row['nama'];
                    $username = $row['username'];
                    $password = $row['password'];
                    $email = $row['email'];
                    $hak_akses = $row['hak_akses'];
                    $idu = $row['idu'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_pembeli;?></td>
                  <td><?=$username;?></td>
                  <td><?=$password;?></td>
                  <td>
                    <a href="?halaman=edit_pembeli&id=<?=$idu;?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?=$idu;?>">
                      Hapus
                    </button>
                    <a href="?halaman=detail_pembeli&id=<?=$idu;?>" class="btn btn-info btn-sm">Detail</a>
                  </td>
                  <div class="modal fade" id="modal-hapus<?=$idu;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="id" value="<?=$idu;?>">
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
        <div class="modal fade" id="modal-pembeli">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Pembeli</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form">
                  <div class="box-body">
                    <?php $date = date('YmdHis')?>
                    <input type="hidden" name="idu" class="form-control" value="<?=$date;?>">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Lengkap</label>
                      <input type="text" name="nama_pembeli" class="form-control" id="exampleInputEmail1" placeholder="Nama Lengkap.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jekel</label>
                      <select name="jekel" class="form-control" required="">
                        <option disabled="" selected="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <textarea name="alamat" cols="30" rows="5" class="form-control" placeholder="Alamat.." required=""></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Username.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password.." required="">
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
      $idu = $_POST['idu'];
      $nama_pembeli = $_POST['nama_pembeli'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $alamat = $_POST['alamat'];
      $jekel = $_POST['jekel'];
      $hak_akses = "Pembeli";

      $query = mysqli_query($conn,"INSERT INTO tbl_pengguna (idu,nama,username,password,email,hak_akses) VALUES ('$idu','$nama_pembeli','$username','$password','$email','$hak_akses')");
      
      if($query){
        $query2 = mysqli_query($conn,"INSERT INTO tbl_pembeli (id_pembeli,idu,nama_pembeli,alamat,jenis_kelamin) VALUES('$idu','$idu','$nama_pembeli','$alamat','$jekel')");
        if($query2){
          echo "<script>
                swal('Berhasil!', 'Simpan Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=pembeli'});
                </script>";
        }else{
          echo "<script>
              swal('Gagal!', 'Simpan Gagal', 'error',{
                buttons: true}).then( () => {
                  location.href = '?halaman=pembeli'});
              </script>";
        }
      }else{
        echo "<script>
              swal('Gagal!', 'Simpan Gagal', 'error',{
                buttons: true}).then( () => {
                  location.href = '?halaman=admin'});
              </script>";
      }

    }elseif(isset($_POST['hapus'])){
      $id = $_POST['id'];
      $query = mysqli_query($conn,"DELETE FROM tbl_pengguna WHERE idu='$id'");
      if($query){
        echo "<script>
                swal('Berhasil!', 'Data berhasil dihapus', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=pembeli'});
                </script>";
      }
    }
  ?>

