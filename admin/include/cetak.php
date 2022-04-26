<?php
require '../../config.php';

  if (isset($_POST['simpan'])) {
      $tgl = $_POST['periode'];
	$bulan = substr($_POST['periode'],5);
    $tahun = substr($_POST['periode'],0,4);
}  
function namaBulan($bulan){
    switch($bulan){
        case '01' : $bulan="JANUARI";
        break;
        case '02' : $bulan="FEBRUARI";
        break;
        case '03' : $bulan="MARET";
        break;
        case '04' : $bulan="APRIL";
        break;
        case '05' : $bulan="MEI";
        break;
        case '06' : $bulan="JUNI";
        break;
        case '07' : $bulan="JULI";
        break;
        case '08' : $bulan="AGUSTUS";
        break;
        case '09' : $bulan="SEPTEMBER";
        break;
        case '10' : $bulan="OKTOBER";
        break;
        case '11' : $bulan="NOVEMBER";
        break;
        default : $bulan="DESEMBER";
    }
    
    
    
    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun
     
    return  $bulan;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>PRINT LAPORAN BULANAN</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">

    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <script src="vendor/bootstrap/js/bootstrap.min.js" ></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script> -->
    <!-- Custom CSS -->
    <link href="assets/css/style.min.css" rel="stylesheet">
	<style>
		@page { size: auto;  margin: 4mm; }
		table {
          border-collapse: collapse;
        }
        hr {
          border-top: solid 1px #000 !important;
        }
	</style>
		
</head>
<body>
    <?php 
            $queryToko = mysqli_query($conn,"SELECT * FROM info_toko");
            $q = mysqli_fetch_array($queryToko);
            $namaToko= $q['nama_toko'];
            $alamatToko= $q['alamat'];
            $emailToko= $q['email'];
    ?>
	<center>

        <!-- <h2></h2> -->
        <div style='font-size: 14pt; text-align: center'> <b><?=$namaToko?></b>
            <br><?=$alamatToko?>
            <br><?=$emailToko?>
        </div> 
        <hr style='height:2px;border-width:0;color:black;background-color:black'>
        <h4>
        <b>LAPORAN PESANAN BULAN <?=namaBulan($bulan)?> <?=$tahun?></b>
		</h4>
        <img src="../../img/logo.png" height="80px" style="position:absolute; top:0; left:0;" />
        <!-- <img src="images/img-01.png" height="130px" style="position:absolute; top:0; right:0;" />  -->

	</center>

    <center>
	<table border="1" style="width: 80%;">
		<tr>
			<th width="10%">No</th>
            <th width="30%">Tanggal</th>
			<th>Nama Penerima</th>
			<th width="30%">Jumlah</th>
		</tr>
		<?php 
		    $no = 1;
            $data = mysqli_query($conn,"SELECT * FROM pesanan where status='Selesai' tgl_pesanan like '$tgl%'");
            while($d = mysqli_fetch_array($data)){
		        ?>
                <tr>
                    <td style="text-align: center;"><?php echo $no++; ?></td>
                    <td style="text-align: center;"><?php echo $d['tgl_pesanan']; ?></td>
                    <td style="text-align: center;"><?php echo $d['penerima']; ?></td>
                    <td style="text-align: center;"><?php echo number_format($d['total']); ?></td>
                </tr>
		        <?php 
		    }
		?>
        <?php 
            $queryJumlah = mysqli_query($conn,"SELECT SUM(total) as jumlah FROM pesanan where tgl_pesanan like '$tgl%'");
            $j = mysqli_fetch_array($queryJumlah);
        ?>
        <tr>
            <td style="text-align: center;" colspan="3"><b>Total</b></td>
            <td style="text-align: center;"><b><?php echo number_format($j['jumlah']); ?></b></td>
        </tr>
		
		
    </table>
    
    
    </center>
	<script>
		window.print();
	</script>

</body>
</html>