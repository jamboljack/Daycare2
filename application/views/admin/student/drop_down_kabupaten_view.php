<?php        
	$style_kabupaten ='class="form-control" id="lstKabupaten" required';
	echo form_dropdown("lstKabupaten" , $listKabupaten, '', $style_kabupaten);
?>