    <?php
        if(isset($_GET['id'])){
            $idu = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_pengguna natural join tbl_admin WHERE idu='$idu'");
            $row = mysqli_fetch_array($query);
            $nama = $row['nama'];
            $tempat_lahir = $row['tempat_lahir'];
            $tgl_lahir = $row['tgl_lahir'];
            $jekel = $row['jenis_kelamin'];
            $alamat = $row['alamat'];
            $agama = $row['agama'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
            $no_telp = $row['no_telp'];
        }
    ?>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Admin</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Lengkap</label>
                      <input type="text" name="nama_admin" class="form-control" value="<?=$nama;?>" placeholder="Nama Lengkap.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" class="form-control" value="<?=$tempat_lahir;?>" placeholder="Tempat Lahir.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tanggal Lahir</label>
                      <input type="date" name="tgl_lahir" class="form-control" value="<?=$tgl_lahir;?>" required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jekel</label>
                      <select name="jekel" class="form-control" required="">
                        <option disabled="" selected="">Pilih Jenis Kelamin</option>
                        <option <?php if($jekel=="L"){ echo "selected";}?> value="L">Laki-Laki</option>
                        <option <?php if($jekel=="P"){ echo "selected";}?> value="P">Perempuan</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <textarea name="alamat" cols="30" rows="5" class="form-control" placeholder="Alamat.." required=""><?=$alamat;?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Agama</label>
                      <select name="agama" class="form-control" required="">
                        <option disabled="" selected="">Pilih Agama</option>
                        <option <?php if($agama=="Islam"){ echo "selected";}?> value="Islam">Islam</option>
                        <option <?php if($agama=="Kristen"){ echo "selected";}?> value="Kristen">Kristen</option>
                        <option <?php if($agama=="Katholik"){ echo "selected";}?> value="Katholik">Katholik</option>
                        <option <?php if($agama=="Hindu"){ echo "selected";}?> value="Hindu">Hindu</option>
                        <option <?php if($agama=="Budha"){ echo "selected";}?> value="Budha">Budha</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" class="form-control" value="<?=$email;?>" placeholder="Email.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">No. Telp</label>
                      <input type="number" name="no_telp" class="form-control" value="<?=$no_telp;?>" placeholder="No. Telp.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" name="username" class="form-control" value="<?=$username;?>" placeholder="Username.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" name="password" class="form-control" value="<?=$password;?>" placeholder="Password.." required="">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="?halaman=admin" class="btn btn-default">Kembali</a>
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
      $nama_admin = $_POST['nama_admin'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $tempat_lahir = $_POST['tempat_lahir'];
      $tgl_lahir = $_POST['tgl_lahir'];
      $jekel = $_POST['jekel'];
      $no_telp = $_POST['no_telp'];
      $alamat = $_POST['alamat'];
      $agama = $_POST['agama'];

      $query = mysqli_query($conn,"UPDATE tbl_pengguna SET nama='$nama_admin',username='$username',password='$password',email='$email' WHERE idu='$idu'");
      if($query){
        $query2 = mysqli_query($conn,"UPDATE tbl_admin SET nama_admin='$nama_admin',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',jenis_kelamin='$jekel',alamat='$alamat',agama='$agama',no_telp='$no_telp' WHERE idu='$idu'");
        if($query2){
          echo "<script>
                swal('Berhasil!', 'Ubah Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=admin'});
                </script>";
        }else{
          echo "<script>
                swal('Gagal!', 'Ubah Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_admin&id=$idu'});
                </script>";
        }
      }else{
          echo "<script>
                swal('Gagal!', 'Ubah Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_admin&id=$idu'});
                </script>";
      }
    }
  ?>