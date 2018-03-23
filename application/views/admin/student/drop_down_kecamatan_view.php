<?php        
	$style_kecamatan ='class="form-control" id="lstKecamatan" required';
	echo form_dropdown("lstKecamatan" , $listKecamatan, '', $style_kecamatan);
?>