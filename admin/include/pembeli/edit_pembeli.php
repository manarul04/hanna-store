    <?php
        if(isset($_GET['id'])){
            $idu = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_pengguna natural join tbl_pembeli WHERE idu='$idu'");
            $row = mysqli_fetch_array($query);
            $nama = $row['nama'];
            $jekel = $row['jenis_kelamin'];
            $alamat = $row['alamat'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];
        }
    ?>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Pembeli</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Lengkap</label>
                      <input type="text" name="nama_pembeli" class="form-control" value="<?=$nama;?>" placeholder="Nama Lengkap.." required="" autofocus="">
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
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" class="form-control" value="<?=$email;?>" placeholder="Email.." required="">
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
                    <a href="?halaman=pembeli" class="btn btn-default">Kembali</a>
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
      $nama_pembeli = $_POST['nama_pembeli'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $email = $_POST['email'];
      $jekel = $_POST['jekel'];
      $alamat = $_POST['alamat'];

      $query = mysqli_query($conn,"UPDATE tbl_pengguna SET nama='$nama_pembeli',username='$username',password='$password',email='$email' WHERE idu='$idu'");
      if($query){
        $query2 = mysqli_query($conn,"UPDATE tbl_pembeli SET nama_pembeli='$nama_pembeli',jenis_kelamin='$jekel',alamat='$alamat' WHERE idu='$idu'");
        if($query2){
          echo "<script>
                swal('Berhasil!', 'Ubah Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=pembeli'});
                </script>";
        }else{
          echo "<script>
                swal('Gagal!', 'Ubah Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_pembeli&id=$idu'});
                </script>";
        }
      }else{
          echo "<script>
                swal('Gagal!', 'Ubah Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_pembeli&id=$idu'});
                </script>";
      }
    }
  ?>