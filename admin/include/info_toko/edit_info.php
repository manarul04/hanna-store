    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM info_toko WHERE id='$id'");
            $row = mysqli_fetch_array($query);
            $nama_toko = $row['nama_toko'];
            $nohp = $row['no'];
            $fb = $row['fb'];
            $ig = $row['ig'];
            $alamat = $row['alamat'];
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
              <h3 class="box-title">Edit Info Toko</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Toko</label>
                      <input type="text" name="nama_toko" value="<?=$nama_toko;?>" class="form-control" placeholder="Nama Toko.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">No. HP</label>
                      <input type="number" name="no" value="<?=$nohp;?>" class="form-control" placeholder="No. HP.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Facebook</label>
                      <input type="text" name="fb" value="<?=$fb;?>" class="form-control" placeholder="Instagram.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Instagram</label>
                      <input type="text" name="ig" value="<?=$ig;?>" class="form-control" placeholder="Instagram.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Alamat</label>
                      <input type="text" name="alamat" value="<?=$alamat;?>" class="form-control" placeholder="Alamat.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" value="<?=$email;?>" class="form-control" placeholder="Email.." required="" autofocus="">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="?halaman=info_toko" class="btn btn-default">Kembali</a>
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
        $nama_toko = $_POST['nama_toko'];
        $no = $_POST['no'];
        $fb = $_POST['fb'];
        $ig = $_POST['ig'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];

      $query = mysqli_query($conn,"UPDATE info_toko SET nama_toko='$nama_toko', no='$no', fb='$fb',ig='$ig',alamat='$alamat',email='$email' WHERE id='$id'");
      if($query){
          echo "<script>
                swal('Berhasil!', 'Ubah Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=info_toko'});
                </script>";
      }else{
          echo "<script>
                swal('Gagal!', 'Ubah Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_info&id=$id'});
                </script>";
      }
    }
  ?>