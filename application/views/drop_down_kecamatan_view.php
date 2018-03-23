<?php        
	$style_kecamatan ='class="list-select" id="lstKecamatan" required';
	echo form_dropdown("lstKecamatan" , $listKecamatan, '', $style_kecamatan);
?>