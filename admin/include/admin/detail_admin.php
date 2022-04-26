<?php
        if(isset($_GET['id'])){
            $idu = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_admin natural join tbl_pengguna where idu='$idu'");
            $row = mysqli_fetch_array($query);
        }
    ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail Admin</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>:</th>
                  <th><?=$row['nama_admin'];?></th>
                </tr>  
                <tr>
                  <th>TTL</th>
                  <th>:</th>
                  <th><?=$row['tempat_lahir'];?>, <?=date("d-m-Y",strtotime($row['tgl_lahir']));?></th>
                </tr>
                <tr>
                  <th>Jenis kelamin</th>
                  <th>:</th>
                  <th><?=$row['jenis_kelamin'];?></th>
                </tr>
                <tr>
                  <th>Alamat</th>
                  <th>:</th>
                  <th><?=$row['alamat'];?></th>
                </tr>
                <tr>
                  <th>Agama</th>
                  <th>:</th>
                  <th><?=$row['agama'];?></th>
                </tr>
                <tr>
                  <th>No. Telp</th>
                  <th>:</th>
                  <th><?=$row['no_telp'];?></th>
                </tr>
                <tr>
                  <th>Email</th>
                  <th>:</th>
                  <th><?=$row['email'];?></th>
                </tr>
                <tr>
                  <th>Username</th>
                  <th>:</th>
                  <th><?=$row['username'];?></th>
                </tr>
                <tr>
                  <th>Password</th>
                  <th>:</th>
                  <th><?=$row['password'];?></th>
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
                    <a href="?halaman=admin" class="btn btn-default">Kembali</a>
                </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

