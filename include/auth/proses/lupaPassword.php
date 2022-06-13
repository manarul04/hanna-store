<?php
    require ('../../../config.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    require '../../../PHPMailer/src/Exception.php';
    require '../../../PHPMailer/src/OAuth.php';
    require '../../../PHPMailer/src/PHPMailer.php';
    require '../../../PHPMailer/src/POP3.php';
    require '../../../PHPMailer/src/SMTP.php';

    // $idu = $_POST['idu'];
    $email = $_POST['email'];

            

    $sql = "SELECT * FROM tbl_pengguna where email='$email'";
    $queryv = mysqli_query($conn,$sql);
    $data = mysqli_fetch_array($queryv);
        $token = $data['verif_code'];
    if(mysqli_num_rows($queryv) < 1){
        
        echo "<script>
                        swal('Gagal!', 'Email Tidak Terdaftar', 'error',{
                            buttons: true}).then( () => {
                            location.href = '?halaman=login'});
                        </script>";
        // echo '<script>alert("Email tidak terdaftar");
        // history.back();
        // </script>';
        // header("location:login");
    }else {
        echo "<script>
        swal('Berhasil!', 'Link Reset Password Sudah Terkirim ke $email', 'success',{
            buttons: true}).then( () => {
            location.href = '?halaman=login'});
        </script>";
        // $sql = "INSERT INTO tbl_pengguna (idu,username,nama,email,password,verif_code,hak_akses)VALUES('$idu','$username','$nama','$email','$password','$code','Pembeli')";
        // $query = mysqli_query($conn,$sql);

        // $query2 = mysqli_query($conn,"INSERT INTO tbl_pembeli (id_pembeli,idu,nama_pembeli,jenis_kelamin,alamat) VALUES ('$idu','$idu','$nama','$jekel','$alamat')");

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // SMTP::DEBUG_OFF = off (for production use)
        // SMTP::DEBUG_CLIENT = client messages
        // SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption mechanism to use - STARTTLS or SMTPS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = 'guestsk001@gmail.com';

        //Password to use for SMTP authentication
        $mail->Password = 'hadpujxzfjirohel';

        //Set who the message is to be sent from
        $mail->setFrom('no-reply@hanna-store.com', 'Hanna Store');

        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($email, $nama);

        //Set the subject line
        $mail->Subject = 'Reset Password - Hanna Store';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $body = "Hi, ".$nama."<br>Reset Password Anda dengan klik link berikut : : <br> http://localhost/hanna-store/include/auth/password_baru.php?email=$email&token=$token";
        $mail->Body = $body;
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Verification Account';

        //send the message, check for errors
        if (!$mail->send()) {
            echo 'Mailer Error: '. $mail->ErrorInfo;
        } else {
            // echo 'Register sukses silahkan VERIFIKASI Email Terlebih dahulu !';
            echo "<script type='text/javascript'>alert('Link Reset Password Sudah dikirim ke email');
            window.location.href = 'http://localhost/hanna-store/?halaman=login'; //Will take you to Google.</script>";
            
            //Section 2: IMAP
            //Uncomment these to save your message in the 'Sent Mail' folder.
            #if (save_mail($mail)) {
            #    echo "Message saved!";
            #}
        }

    }





?>