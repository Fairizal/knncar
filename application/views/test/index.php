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

    <title>Testing Pemilihan Mobil</title>
  </head>
  <body>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>

  	<div class="container-fluid" style="background-color: #95daff">
	  	<div class="container" style="background-color: white; padding: 20px 20px 365px">
	    	<h3>Testing Pemilihan Mobil</h3>
	    	<p>Halaman untung testing pemilihan mobil.</p>
	    	<center><button class="btn btn-primary" onclick="$.fn.test()">Start Testing</button></center>
	    	<br>
	    	<div class="row">
	    		<div class="col-md-12">
	    			<center><h3>Akurasi Rekomendasi Mobil</h3></center>
	    			<div style="padding: 20px">
	    				<center><h1 id="akurasi">_____</h1></center>
	    			</div>
	    		</div>
	    	</div>
		</div>
  	</div>
    <script type="text/javascript">
    	$.fn.test = function() {
	        $('#submit').html('<div class="spinner-border text-light" role="status"><span class="sr-only"></span></div>');
	        $.ajax({
	            method: "POST",
	            url: "<?= base_url('test/index') ?>",
	            dataType: 'json',
	            success: function(data) {
	                if(data.status == true) {
	                	console.log(data)
	                	$('#submit').text('Cari');
	                    $('#akurasi').text(data.akurasi);
	                }
	            }
	        });
	    }
    </script>
  </body>
</html>