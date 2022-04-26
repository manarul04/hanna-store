    <?php
        if(isset($_GET['id'])){
            $id_produk = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_produk where id_produk='$id_produk'");
            $row = mysqli_fetch_array($query);
        }
    ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail Produk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama Produk</th>
                  <th>:</th>
                  <th><?=$row['nama_produk'];?></th>
                </tr>  
                <tr>
                  <th>Stok</th>
                  <th>:</th>
                  <th><?=$row['jumlah_produk'];?></th>
                </tr>
                <tr>
                  <th>Harga</th>
                  <th>:</th>
                  <th><?=rupiah($row['harga_produk']);?></th>
                </tr>
                <tr>
                  <th>Foto Produk</th>
                  <th>:</th>
                  <th><img src="include/produk/gambar_produk/<?=$row['gambar_produk'];?>" width="100" alt=""></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
                <div class="box-footer">
                    <a href="?halaman=produk" class="btn btn-default">Kembali</a>
                </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

