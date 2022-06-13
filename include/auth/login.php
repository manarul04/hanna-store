    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="login-form">
                        <h2>Login</h2>
                        <form method="post">
                            <div class="group-input">
                                <label for="username">Username *</label>
                                <input type="text" name="username" id="username" required="" autofocus>
                            </div>
                            <div class="group-input">
                                <label for="pass">Password *</label>
                                <input type="password" name="password" id="pass" required="">
                            </div>
                            <input type="checkbox" onclick="togglePassword('pass')"> Tampilkan Password</input>
                                
                            <div >
                                <button type="submit" name="login" class="site-btn login-btn">Masuk</button>
                                
                            </div>
                        </form>
                        <div class="switch-login">
                            <a href="?halaman=registrasi" class="or-login">Buat Akun</a> <br>
                            <a href="?halaman=lupapassword" class="or-login">Lupa Password</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    <?php
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = mysqli_query($conn,"SELECT * FROM tbl_pengguna WHERE username='$username' AND password='$password' AND is_verified=1");
            $cek_login = mysqli_num_rows($query);
            $data = mysqli_fetch_array($query);

            if($cek_login>0){
                $_SESSION['hak_akses'] = $data['hak_akses'];
                $hak_akses = $_SESSION['hak_akses'];

                if($hak_akses=="Admin"){
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['hak_akses'] = $data['hak_akses'];
                    echo "<script>
                        swal('Berhasil!', 'Login Berhasil', 'success',{
                            buttons: true}).then( () => {
                            location.href = 'admin/'});
                        </script>";
                }elseif($hak_akses=="Pembeli"){
                    $_SESSION['nama'] = $data['nama'];
                    $_SESSION['username'] = $data['username'];
                    $_SESSION['idu'] = $data['idu'];
                    $_SESSION['password'] = $data['password'];
                    $_SESSION['hak_akses'] = $data['hak_akses'];
                    echo "<script>
                        swal('Berhasil!', 'Login Berhasil', 'success',{
                            buttons: true}).then( () => {
                            location.href = '$index'});
                        </script>";
                }
            }else{
                echo "<script>
                    swal('Gagal!', 'Usernama Password tidak cocok atau email anda belum diverifikasi', 'error',{
                        buttons: true}).then( () => {
                        location.href = '?halaman=login'});
                    </script>";
            }
        }
    ?>