<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="<?php echo base_url() ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <title>Rekomendasi Pemilihan Mobil</title>
  </head>
  <body>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

  	<div class="container-fluid" style="background-color: #95daff">
	  	<div class="container" style="background-color: white; padding: 20px 20px 115px">
	    	<h3>Rekomendasi Pemilihan Mobil</h3>
	    	<p>Selamat datang di Rekomendasi Pemilihan Mobil. Website yang tepat untuk mencari rekomendasi pilihan mobil terbaik. Disini anda bisa mendapatkan pilihan mobil terbaik sesuai dengan kategori yang anda inginkan.</p>
	    	<p>Cukup masukkan kategori mobil yang anda inginkan dibawah ini. Kemudian klik tolmbol Cari. Setelah proses pencarian selesai. Maka hasil rekomendasi akan muncul dibawah.</p>
	    	<div class="row">
	    		<div class="col-md-6">
    			 	<div class="mb-3 row">
				    	<label for="tujuan" class="col-sm-2 col-form-label">Tujuan</label>
				    	<div class="col-sm-10">
				      		<select class="form-select" aria-label="Default select example" id="tujuan">
							  	<option selected value="0">Pilih Tujuan Mobil</option>
							  	<option value="1">Sport</option>
							  	<option value="2">Keluarga</option>
							  	<option value="3">Van</option>
							  	<option value="4">SUV</option>
							  	<option value="5">Mini Bus</option>
							  	<option value="6">Sedan</option>
							</select>
				    	</div>
				  	</div>
				  	<div class="mb-3 row">
				    	<label for="harga" class="col-sm-2 col-form-label">Harga</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="harga" placeholder="Masukkan harga yang anda inginkan">
				    	</div>
				  	</div>
				  	<div class="mb-3 row">
				    	<label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="tahun" placeholder="Masukkan tahun yang anda inginkan">
				    	</div>
				  	</div>
	    		</div>
	    		<div class="col-md-6">
    			 	<div class="mb-3 row">
				    	<label for="penumpang" class="col-sm-2 col-form-label">Penumpang</label>
				    	<div class="col-sm-10">
				      		<input type="text" class="form-control" id="penumpang" placeholder="Masukkan kapasitas penumpang yang anda inginkan">
				    	</div>
				  	</div>
				  	<div class="mb-3 row">
				    	<label for="transmisi" class="col-sm-2 col-form-label">Transmisi</label>
				    	<div class="col-sm-10">
				      		<select class="form-select" aria-label="Default select example" id="transmisi">
							  	<option selected value="0">Pilih Transmisi Yang Anda Inginkan</option>
							  	<option value="1">Manual</option>
							  	<option value="2">Otomatis</option>
							  	<option value="3">CVT</option>
							  	<option value="4">Hybrid</option>
							</select>
				    	</div>
				  	</div>
	    		</div>
	    	</div>
	    	<center><button class="btn btn-primary" onclick="$.fn.save()" id="submit">Cari</button></center>
	    	<br>
	    	<div class="row">
	    		<div class="col-md-12">
	    			<center><h3>Berikut Hasil Rekomendasi Mobil</h3></center>
	    			<div style="padding: 20px">
	    				<center><h1 id="mobil">_____</h1></center>
	    			</div>
	    		</div>
	    	</div>
		</div>
  	</div>
    <script type="text/javascript">
    	$.fn.save = function() {
	        var tujuan = $('#tujuan').val();
	        var harga = $('#harga').val();
	        var tahun = $('#tahun').val();
	        var penumpang = $('#penumpang').val();
	        var transmisi = $('#transmisi').val();
	        if (tujuan == "0") {
	        	alert('Pilih Tujuan Mobil');
	        } else if (harga == "") {
	        	alert('Isi Harga Mobil');
	        } else if (tahun == "") {
	        	alert('Isi Tahun Mobil');
	        } else if (penumpang == "") {
	        	alert('Isi Kapasitas Penumpang Mobil');
	        } else if (transmisi == "0") {
	        	alert('Pilih Transmisi Mobil');
	        } else {
	    		$('#submit').html('<div class="spinner-border text-light" role="status"><span class="sr-only"></span></div>');
		        $.ajax({
		            method: "POST",
		            url: "<?= base_url('site/index') ?>",
		            data: { 
		                tujuan: tujuan, 
		                harga: harga,
		                tahun: tahun, 
		                penumpang: penumpang, 
		                transmisi: transmisi, 
		            },
		            dataType: 'json',
		            success: function(data) {
		                if(data.status == true) {
		                	// console.log(data)
		                	$('#submit').text('Cari');
		                    $('#mobil').text(data.hasil);
		                }
		            }
		        });
	        }
	    }
    </script>
  </body>
</html>