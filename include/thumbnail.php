<ul>
<?php 
if(isset($_REQUEST["userfile"])){
foreach ($upload_data as $item => $value):
	$file_name = "";
	if($item=="file_name"){
		$file_name = $value;
	}
?>
		<img src="/uploads/"<?php echo $file_name;?> width="50" height="50">
<li><?php echo $item;?>: <?php echo $value;?></li>
<?php endforeach; 
}else{
?>
<?php 
}
?>
</ul>

test!

file_name: Tulips.jpg
file_type: image/jpeg
file_path: D:/dev/php/web/sbm/sbm.dealer/uploads/
full_path: D:/dev/php/web/sbm/sbm.dealer/uploads/Tulips.jpg
raw_name: Tulips
orig_name: Tulips.jpg
client_name: Tulips.jpg
file_ext: .jpg
file_size: 606.34
is_image: 1
image_width: 1024
image_height: 768
image_type: jpeg
image_size_str: width="1024" height="768"
Upload Another File!