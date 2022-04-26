    <?php
      // jumlah pesanan
      $pesanan = mysqli_query($conn,"SELECT * FROM pesanan WHERE status='Belum' or status='Sudah bayar'");
      $jumlah_pesanan = mysqli_num_rows($pesanan);
      // jumlah pesanan selesai
      $pesanan_selesai= mysqli_query($conn,"SELECT * FROM pesanan WHERE status='Selesai'");
      $jumlah_pesanan_selesai = mysqli_num_rows($pesanan_selesai);
    ?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$jumlah_pesanan;?></h3>

              <p>Pesanan</p>
            </div>
            <div class="icon">
              <i class="fa fa-cart-arrow-down"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$jumlah_pesanan_selesai;?></h3>

              <p>Pesanan Selesai</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-circle"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <a href="" data-toggle="modal" data-target="#modal-produk"><h3>Cetak laporan <i class="fa fa-print"></i></h3></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    <div class="modal fade" id="modal-produk">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Produk</h4>
              </div>
              <div class="modal-body">
                <form method="post" role="form" enctype="multipart/form-data" action="include/cetak.php">
                  <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputPassword1">Periode LAPORAN</label>
                      <input type="month" name="periode" class="form-control" required="">
                    </div>
                  </div>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <button type="submit" name="simpan" class="btn btn-primary">Cetak</button>
                </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>