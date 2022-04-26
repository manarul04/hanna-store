    <?php
      if(isset($_GET['id'])){
        $id_pesanan = $_GET['id'];
        $query = mysqli_query($conn,"SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan'");
        $query2 = mysqli_query($conn,"SELECT * FROM pesanan WHERE id_pesanan='$id_pesanan'");
        $row = mysqli_fetch_array($query);
        $nama_pembeli = $row['penerima'];
        $no_wa = $row['no_wa'];
        $alamat = $row['alamat'];
        $status = $row['status'];
        $bukti = $row['bukti'];
        $tgl_pesanan = $row['tgl_pesanan'];
        $ongkir = $row['ongkir'];
        $total = $row['total'];
      }
    ?>
    <section class="content">
      <div class="row">
         <div class="col-md-3">

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <p class="text-muted text-center">NAMA PEMBELI</p>
              <h3 class="profile-username text-center"><?=$nama_pembeli;?></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> No. Whatsapp</strong>

              <p class="text-muted">
                <?=$no_wa;?>
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted"><?=$alamat;?></p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Status</strong>
              <?php
                if($status=="Belum"){
              ?>
              <p><span class="badge bg-red"><?=$status;?></span></p>
              <?php
                }elseif($status=="Sudah bayar"){
              ?>
              <p><span class="badge bg-green"><?=$status;?></span></p>
              <?php
                }elseif($status=="Diterima"){
              ?>
              <p><span class="badge bg-blue"><?=$status;?></span></p>
              <?php
                }elseif($status=="Selesai"){
              ?>
              <p><span class="badge bg-primary"><?=$status;?></span></p>
              <?php
                }
              ?>
              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Bukti Bayar</strong>

              <p>
                <a data-fancybox="gallery" title="Lihat Bukti" href="../include/pembeli/bukti/<?=$bukti;?>"><img src="../include/pembeli/bukti/<?=$bukti;?>" width="100" alt=""></a>
              </p>

              <hr>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-9">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tanggal Pesanan <strong><?=tanggal_indonesia(date($tgl_pesanan));?></strong></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <th>#</th>
                  <th>Nama Produk</th>
                  <th>Harga Produk</th>
                  <th>Total Harga</th>
                </tr>
                <?php
                  $no = 1;
                  $query_total_bayar = mysqli_query($conn,"select sum(harga_produk*quantity) as total_bayar from pesanan where id_pesanan='$id_pesanan'");
                  $row_total_bayar = mysqli_fetch_array($query_total_bayar);
                  $total_bayar = $row_total_bayar['total_bayar'];
                  while($row2=mysqli_fetch_array($query2,MYSQLI_BOTH)){
                    $nama_produk = $row2['nama_produk'];
                    $quantity = $row2['quantity'];
                    $harga_produk = $row2['harga_produk'];
                    $total_harga = $harga_produk * $quantity;
                    
                ?>
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$nama_produk;?> X <?=$quantity;?></td>
                  <td>
                    <?=rupiah($harga_produk);?>
                  </td>
                  <td><?=rupiah($total_harga);?></td>
                </tr>
                <?php
                  }
                ?>
                <tfoot>
                  <tr>
                    <th colspan="3"><center>ONGKIR</center></th>
                    <th><?=$ongkir;?></th>
                  </tr>
                  <tr>
                    <th colspan="3"><center>TOTAL BAYAR</center></th>
                    <th><?=rupiah($total);?></th>
                  </tr>
                </tfoot>
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

    }
  ?>

