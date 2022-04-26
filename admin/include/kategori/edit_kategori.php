    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_kategori WHERE id_kategori='$id'");
            $row = mysqli_fetch_array($query);
            $nama_kategori = $row['nama_kategori'];
        }
    ?>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Kategori</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama kategori</label>
                      <input type="text" name="nama_kategori" class="form-control" value="<?=$nama_kategori;?>" placeholder="Nama Lengkap.." required="" autofocus="">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="?halaman=kategori" class="btn btn-default">Kembali</a>
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
      $nama_kategori = $_POST['nama_kategori'];

      $query = mysqli_query($conn,"UPDATE tbl_kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id'");
      if($query){
          echo "<script>
                swal('Berhasil!', 'Ubah Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_kategori&id=$id'});
                </script>";
      }else{
          echo "<script>
                swal('Gagal!', 'Ubah Gagal', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_kategori&id=$id'});
                </script>";
      }
    }
  ?>