<?php
	$kota_asal = "209";
	$kota_tujuan = $_POST['kota_tujuan'];
	$kurir = $_POST['kurir'];
	$berat = 1*1000;

	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "http://api.rajaongkir.com/starter/cost",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "origin=".$kota_asal."&destination=".$kota_tujuan."&weight=".$berat."&courier=".$kurir."",
	  CURLOPT_HTTPHEADER => array(
	    "content-type: application/x-www-form-urlencoded",
	    "key: b8258902929077c18ebdb53d2a2961db"
	  ),
	));
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	$data= json_decode($response, true);
	$kurir=$data['rajaongkir']['results'][0]['name'];
	$layanan=$data['rajaongkir']['results'][0]['costs'][0]['service'];
	$biaya=$data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
	$kotaasal=$data['rajaongkir']['origin_details']['city_name'];
	$idasal=$data['rajaongkir']['origin_details']['city_id'];
	$provinsiasal=$data['rajaongkir']['origin_details']['province'];
	$kotatujuan=$data['rajaongkir']['destination_details']['city_name'];
	$provinsitujuan=$data['rajaongkir']['destination_details']['province'];
	$berat=$data['rajaongkir']['query']['weight']/1000;

?>
		
		<div class="col-sm-4" >
			<input type="text" class="form-control text-uppercase" id="kurir" name="kurir" value="<?=$_POST['kurir']?> " readonly>
        </div>
		<div class="col-sm-5" >
			<input type="text" class="form-control" id="biaya" name="biaya" value="<?=$biaya?> " readonly>
        </div>
		<div class="col-sm-3">
            <a href="#" class="primary-btn" data-toggle="modal" data-target="#cekOngkir">Cek</a>
        </div>
		<script>
		<?php $ongkir=$biaya?>
        	
        
		  

		