    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Register</h2>
                        <form method="post">
                            <?php $date = date('YmdHis')?>
                            <input type="hidden" name="idu" class="form-control" value="<?=$date;?>">
                            <div class="group-input">
                                <label>Nama Lengkap *</label>
                                <input type="text" name="nama" required="" autofocus>
                            </div>
                            <div class="group-input">
                                <label>Jenis Kelamin *</label>
                                <select name="jekel" class="form-control">
                                    <option disabled="" selected="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="group-input">
                                <label>Alamat *</label>
                                <textarea name="alamat" class="form-control" cols="30" rows="5"></textarea>
                            </div>
                            <div class="group-input">
                                <label>Email *</label>
                                <input type="email" name="username" required="" autofocus>
                            </div>
                            <div class="group-input">
                                <label>Username *</label>
                                <input type="text" name="username" required="">
                            </div>
                            <div class="group-input">
                                <label>Password *</label>
                                <input type="text" name="password" required="">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Confirm Password *</label>
                                <input type="text" name="con-pass" required="">
                            </div>
                            <button type="submit" name="registrasi" class="site-btn register-btn">REGISTER</button>
                        </form>
                        <div class="switch-login">
                            <a href="?halaman=login" class="or-login">Or Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

    <?php
        if(isset($_POST['registrasi'])){
            $idu = $_POST['idu'];
            $nama = $_POST['nama'];
            $jekel = $_POST['jekel'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $con_pass = $_POST['con-pass'];
            $hak_akses = "Pembeli";

            // cek username
            $query = mysqli_query($conn,"SELECT * FROM tbl_pengguna WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            $cek_username = $row['username'];

            if($password!=$con_pass){
                echo "<script>
                        swal('Gagal!', 'Konfirmasi Password Gagal', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=registrasi'});
                        </script>";
            }elseif($username==$cek_username){
                echo "<script>
                        swal('Gagal!', 'Username Sudah Terdaftar', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=registrasi'});
                        </script>";
            }else{
                $query = mysqli_query($conn,"INSERT INTO tbl_pengguna (idu,nama,username,password,email,hak_akses) VALUES ('$idu','$nama','$username','$password','$email','$hak_akses')");
                $query2 = mysqli_query($conn,"INSERT INTO tbl_pembeli (id_pembeli,idu,nama_pembeli,jenis_kelamin,alamat) VALUES ('$idu','$idu','$nama','$jekel','$alamat')");
                
                if($query==TRUE && $query2==TRUE){
                    echo "<script>
                        swal('Berhasil!', 'Registrasi Berhasil', 'success',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=login'});
                        </script>";
                }else{
                    echo "<script>
                        swal('Gagal!', 'Registrasi Gagal', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=registrasi'});
                        </script>";
                }
            }
        }
    ?>