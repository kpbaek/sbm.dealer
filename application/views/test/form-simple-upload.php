<?php require_once "/application/third_party/phpuploader/include_phpuploader.php" ?>
<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>PHP Upload - Simple Upload with Progress</title>
	<link href="demo.css" rel="stylesheet" type="text/css" />
<style>
body { 
text-align: center; 
margin-top:20px;
} 

button {font-family:Arial,Verdana;}
.demo { 
text-align: left; 
width: 650px;
border:solid 5px #CBCAC6;
background-color:#f9f9f9;
padding: 10px 20px 20px 20px; 
font-family:Segoe UI, Arial,Verdana,Helvetica,sans-serif;
font-size: 80%;
margin: 0 auto; 
} 
table.Grid
{
	border-width: 5px;
	border-style: none;
	background-color: White;
	border-color: gray;
	font-family:Segoe UI, Arial,Verdana,Helvetica,sans-serif;
	font-size: 90%;
}

table.Grid TD, table.Grid TH
{
	padding: 4px 6px 4px 6px;
	border: solid 1px #E1E1E1;
	vertical-align: top;
}

table.Grid TH
{
	background-color: #E1E1E1;
	font-weight: normal;
	color: #505050;
}
</style>
</head>
<body>
	<div class="demo">
        <h2>Simple Upload with Progress</h2>
        <p> A basic sample demonstrating the use of the Upload script (Allowed file types: <span style="color:red">jpg, gif, png, zip</span>).
		<p>
		<?php
			$uploader=new PhpUploader();
			
			$uploader->MultipleFilesUpload=false;
			$uploader->InsertText="Upload File (Max 10M)";
			
			$uploader->MaxSizeKB=1024000;	
			$uploader->AllowedFileExtensions="jpeg,jpg,gif,png,zip";
			
			//Where'd the files go?
			//$uploader->SaveDirectory="/myfolder";
			
			$uploader->Render();
		?>
		</p>	
		
	<script type='text/javascript'>
	function CuteWebUI_AjaxUploader_OnTaskComplete(task)
	{
		alert(task.FileName + " is uploaded!");
	}
	</script>		
	</div>
</body>
</html>
