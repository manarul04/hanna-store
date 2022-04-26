    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-kategori">
            + Tambah kategori
          </button><br><br>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kategori</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama kategori</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM tbl_kategori");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $nama_kategori = $row['nama_kategori'];
                    $id_kategori = $row['id_kategori'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_kategori;?></td>
                  <td>
                    <a href="?halaman=edit_kategori&id=<?=$id_kategori;?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-hapus<?=$id_kategori;?>">
                      Hapus
                    </button>
                  </td>
                  <div class="modal fade" id="modal-hapus<?=$id_kategori;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="id" value="<?=$id_kategori;?>">
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
        <div class="modal fade" id="modal-kategori">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah kategori</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nama Kategori</label>
                      <input type="text" name="nama_kategori" class="form-control" id="exampleInputEmail1" placeholder="Nama Kategori.." required="" autofocus="">
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
      $nama_kategori = $_POST['nama_kategori'];

      $query = mysqli_query($conn,"INSERT INTO tbl_kategori (nama_kategori) VALUES ('$nama_kategori')");
      
      if($query){
          echo "<script>
                swal('Berhasil!', 'Simpan Berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=kategori'});
                </script>";
      }else{
        echo "<script>
              swal('Gagal!', 'Simpan Gagal', 'error',{
                buttons: true}).then( () => {
                  location.href = '?halaman=kategori'});
              </script>";
      }

    }elseif(isset($_POST['hapus'])){
      $id_kategori = $_POST['id'];
      $query = mysqli_query($conn,"DELETE FROM tbl_kategori WHERE id_kategori='$id_kategori'");
      if($query){
        echo "<script>
                swal('Berhasil!', 'Data berhasil dihapus', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=kategori'});
                </script>";
      }
    }
  ?>

