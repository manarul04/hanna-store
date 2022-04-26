    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-produk">
            + Tambah Produk
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
                  <th>Nama Produk</th>
                  <th>Stok</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM tbl_produk order by id_produk desc");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $nama_produk = $row['nama_produk'];
                    $jumlah_produk = $row['jumlah_produk'];
                    $harga_produk = $row['harga_produk'];
                    $id = $row['id_produk'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_produk;?></td>
                  <td><?=$jumlah_produk;?></td>
                  <td><?=rupiah($harga_produk);?></td>
                  <td>
                    <a href="?halaman=edit_produk&id=<?=$id;?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?=$id;?>">
                      Hapus
                    </button>
                    <a href="?halaman=detail_produk&id=<?=$id;?>" class="btn btn-info btn-sm">Detail</a>
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
        <div class="modal fade" id="modal-produk">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Produk</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Kategori</label>
                      <select name="id_kategori" class="form-control">
                          <option disabled="" selected="">Pilih Kategori</option>
                          <?php
                            $query = mysqli_query($conn,"SELECT * FROM tbl_kategori");
                            while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                                $id_kategori = $row['id_kategori'];
                                $nama_kategori = $row['nama_kategori'];
                          ?>
                          <option value="<?=$id_kategori?>"><?=$nama_kategori;?></option>
                          <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Produk</label>
                      <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk.." required="" autofocus="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Jumlah</label>
                      <input type="number" name="jumlah" class="form-control" placeholder="Jumlah.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Harga</label>
                      <input type="number" name="harga" class="form-control" placeholder="Harga.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Deskripsi</label>
                      <input type="text" name="deskripsi" class="form-control" placeholder="Keterangan.." required="">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Gambar Produk</label>
                      <input type="file" name="gambar_produk" class="form-control" required="">
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
      $nama_produk = $_POST['nama_produk'];
      $jumlah = $_POST['jumlah'];
      $harga = $_POST['harga'];
      $id_kategori = $_POST['id_kategori'];
      $deskripsi = $_POST['deskripsi'];
      $rand = rand();
      $ekstensi = array('png','jpg');
      $filename1 = $_FILES['gambar_produk']['name'];
      $ukuran1 = $_FILES['gambar_produk']['size'];
      $ext1 = pathinfo($filename1, PATHINFO_EXTENSION);

      if(!in_array($ext1,$ekstensi)){
              echo "<script>
                swal('Gagal!', 'Ekstensi gambar jpg dan png', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=produk'});
                </script>";
      }else{
        if($ukuran1 < 1044070){
          $gambar = $rand.'_'.$filename1;
          move_uploaded_file($_FILES['gambar_produk']['tmp_name'], 'include/produk/gambar_produk/'.$rand.'_'.$filename1);
          $query = mysqli_query($conn,"INSERT INTO tbl_produk (nama_produk,jumlah_produk,harga_produk,id_kategori,gambar_produk,deskripsi) VALUES ('$nama_produk','$jumlah','$harga','$id_kategori','$gambar','$deskripsi')");
      
          if($query){
              echo "<script>
                    swal('Berhasil!', 'Data berhasil disimpan.', 'success',{
                      buttons: true}).then( () => {
                        location.href = '?halaman=produk'});
                    </script>";
          }else{
              echo "<script>
                  swal('Gagal!', 'Data gagal disimpan.', 'error',{
                    buttons: true}).then( () => {
                      location.href = '?halaman=produk'});
                  </script>";
          }

        }else{
              echo "<script>
                swal('Gagal!', 'Ukuran gambar terlalu besar', 'error',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=produk'});
                </script>";
        }
      }
    }elseif(isset($_POST['hapus'])){
      $id = $_POST['id'];
      $query = mysqli_query($conn,"DELETE FROM tbl_produk WHERE id_produk='$id'");
      if($query){
        echo "<script>
                swal('Berhasil!', 'Data berhasil dihapus', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=produk'});
                </script>";
      }
    }
  ?>

