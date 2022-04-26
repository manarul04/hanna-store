    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pesanan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Id Pesanan</th>
                  <th>Pembeli</th>
                  <th>Alamat</th>
                  <th>Resi</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $query = mysqli_query($conn,"SELECT * FROM pesanan GROUP BY id_pesanan");
                  while($row=mysqli_fetch_array($query,MYSQLI_BOTH)){
                    $id_pesanan = $row['id_pesanan'];
                    $penerima = $row['penerima'];
                    $status = $row['status'];
                    $bukti = $row['bukti'];
                    $no_resi = $row['resi'];
                    $alamat = $row['alamat'];
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$id_pesanan;?></td>
                  <td><?=$penerima;?></td>
                  <td><?=$alamat;?></td>
                  <td><?=$no_resi;?></td>
                  <?php
                    if($status=="Belum"){
                      $badge="red";
                    }elseif($status=="Sudah Bayar"){
                      $badge="yellow";
                    }elseif($status=="Diproses"){
                      $badge="aqua";
                    }elseif($status=="Dikirim"){
                      $badge="blue";
                    }elseif($status=="Diterima"){
                      $badge="teal";
                    }else{
                      $badge="green";
                    }
                  ?>
                  <td><span class="badge bg-<?=$badge;?>"><?=$status;?></span></td>
                  <td>
                    <?php
                    $konfirmasi="Konfirmasi";
                    $display="";
                    $noresi="hidden";
                      if($status=="Sudah bayar"){
                        $konfirmasi="Diproses";
                      }elseif($status=="Diproses"){
                        $konfirmasi="Dikirim";
                        $noresi="text";
                      }else{
                        $display='style="display:none"';
                      }
                    ?>
                    <button type="button" <?=$display?> class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-konfirmasi<?=$id_pesanan;?>" >
                      <?=$konfirmasi?>
                    </button>
                   
                    <a href="?halaman=detail_pesanan&id=<?=$id_pesanan;?>" class="btn btn-info btn-sm">Detail</a>
                    <a href="?halaman=pesanan&hapus=<?=$id_pesanan;?>" class="btn btn-danger btn-sm">Hapus</a>
                  </td>
                  <div class="modal fade" id="modal-konfirmasi<?=$id_pesanan;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" name="id" value="<?=$id_pesanan;?>">
                            <input type="hidden" name="status" value="<?=$konfirmasi;?>">
                            
                            <center><h3 style="text-transform:uppercase"><strong>Apakah anda yakin konfirmasi data ini?</strong></h3></center>
                            <div class="form-group">
                            <label >Resi</label>
                            <input type="<?=$noresi?>" name="resi" class="form-control" placeholder="resi..">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                          <button type="submit" name="confirm" class="btn btn-primary">Konfirmasi</button>
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
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <?php
    if(isset($_POST['confirm'])){
      $id_pesanan = $_POST['id'];
      $resi = $_POST['resi'];
      $status = $_POST['status'];
      $query = mysqli_query($conn,"UPDATE tbl_pesanan SET status='$status',resi='$resi' WHERE id_pesanan='$id_pesanan'");
      if($query){
        echo "<script>
                swal('Berhasil!', 'Konfirmasi data berhasil', 'success',{
                  buttons: true}).then( () => {
                    location.href = '?halaman=pesanan'});
                </script>";
      }
    }

    if(isset($_GET['hapus'])){
      $id = $_GET['hapus'];
      
      $query = mysqli_query($conn,"DELETE FROM tbl_pesanan WHERE id_pesanan='$id'");
      if($query){
          echo "<script>
                  swal('Berhasil!', 'Data berhasil dihapus', 'success',{
                  buttons: true}).then( () => {
                      location.href = '?halaman=pesanan'});
                  </script>";
      }
  }
  ?>

