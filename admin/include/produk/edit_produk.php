    <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_produk natural join tbl_kategori WHERE id_produk='$id'");
            $row = mysqli_fetch_array($query);
            $nama_produk = $row['nama_produk'];
            $jumlah_produk = $row['jumlah_produk'];
            $harga_produk = $row['harga_produk'];
            $nama_kategori = $row['nama_kategori'];
            $gambar_produk = $row['gambar_produk'];
            $deskripsi = $row['deskripsi'];
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
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori : <strong><?=$nama_kategori;?></strong></label>
                      <select name="id_kategori" class="form-control" required="" autofocus>
                          <option disabled="" selected="">Pilih Kategori</option>
                          <?php
                            $query = mysqli_query($conn,"SELECT * FROM tbl_kategori");
                            while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                $id_kategori = $row['id_kategori'];
                                $nama_kategori = $row['nama_kategori'];
                          ?>
                          <option value="<?=$id_kategori?>" <?php if($id_kategori==$row['id_kategori']){echo "selected";}?>><?=$nama_kategori;?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Produk</label>
                      <input type="text" name="nama_produk" class="form-control" value="<?=$nama_produk;?>"  required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah</label>
                      <input type="number" name="jumlah" class="form-control" value="<?=$jumlah_produk;?>"  required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Harga</label>
                      <input type="number" name="harga" class="form-control" value="<?=$harga_produk;?>"  required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Deskripsi</label>
                      <input type="text" name="deskripsi" class="form-control" value="<?=$deskripsi;?>" placeholder="deskripsi.." required="">
                    </div>
                    <div class="form-group">
                      <label>Gambar Produk</label><br>
                      <img src="include/produk/gambar_produk/<?=$gambar_produk;?>" width="100" alt="">
                      <input type="text" name="gambar_produk_lama" class="form-control" value="<?=$gambar_produk;?>" Hidden>
                      <input type="file" name="gambar_produk" class="form-control">
                    </div>
                </div>
                <div class="box-footer">
                    <a href="?halaman=produk" class="btn btn-default">Kembali</a>
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
      $nama_produk = $_POST['nama_produk'];
      $jumlah = $_POST['jumlah'];
      $harga = $_POST['harga'];
      $deskripsi = $_POST['deskripsi'];
      $rand = rand();
      // $ekstensi = array('png','jpg');
      $filename1 = $_FILES['gambar_produk']['name'];
      $ukuran1 = $_FILES['gambar_produk']['size'];
      $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

      
        if($ukuran1 < 1044070){
            if($_FILES['gambar_produk']['name']==NULL){
              $gambar = $_POST['gambar_produk_lama'];
            }else{
              $gambar = $rand.'_'.$filename1;
              copy($_FILES['gambar_produk']['tmp_name'], 'include/produk/gambar_produk/'.$rand.'_'.$filename1);
            }
            
            
            $query = mysqli_query($conn,"UPDATE tbl_produk SET nama_produk='$nama_produk',jumlah_produk='$jumlah',harga_produk='$harga',gambar_produk='$gambar',deskripsi='$deskripsi' WHERE id_produk='$id'");
            if($query){
                echo "<script>
                      swal('Berhasil!', 'Data berhasil diubah.', 'success',{
                        buttons: true}).then( () => {
                          location.href = '?halaman=produk'});
                      </script>";
            }else{
                echo "<script>
                      swal('Gagal!', 'Data gagal diubah.', 'error',{
                        buttons: true}).then( () => {
                          location.href = '?halaman=produk'});
                      </script>";
            }
        }else{
            echo "<script>
                swal('Gagal!', 'Ukuran gambar terlalu besar', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=edit_produk&id=$id'});
                </script>";
        }
      

      
    }
  ?>