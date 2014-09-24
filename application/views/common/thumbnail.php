<?php 
if(isset($upload_data)){
	$file_name = "";
	$raw_name = "";
	$file_ext = "";
	foreach ($upload_data as $item => $value):
		if($item=="file_name"){
			$file_name = $value;
		}else if($item=="raw_name"){
			$raw_name = $value;
		}else if($item=="file_ext"){
			$file_ext = $value;
		}
?>
<?php 
	endforeach; 
	echo "<img src='/uploads/". $raw_name . '_thumb' . $file_ext. "' width=50>";
}else{
?>
<?php 
}
?>
