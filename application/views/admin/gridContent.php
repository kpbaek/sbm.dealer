<?php
    $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
    $this->output->set_header('Pragma: no-cache');
    $this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
	<title>Grid Content</title>
	
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/carbo/jquery-ui-1.8.16.custom.css" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>css/carbo.grid.css" rel="stylesheet" type="text/css" media="all" />
    <!--[if lt IE 7]><link href="<?php echo base_url(); ?>css/carbo.grid.ie6.css" rel="stylesheet" type="text/css" media="all" /><![endif]-->
    <link href="<?php echo base_url(); ?>css/carbo.form.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo base_url(); ?>css/960.css" rel="stylesheet" type="text/css" />
<!--   
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript"></script> 
-->
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js" type="text/javascript"></script>
	
	<script src="<?php echo base_url(); ?>js/jquery.bbq.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.form.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jquery.timepicker.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/carbo.grid.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/carbo.form.js" type="text/javascript"></script>
	
	</head>
	


<div id="content">
    <div class="container_12">
        <div class="grid_12">
            <?php if (isset($page)) $this->load->view($page); ?>
        </div>
        <div class="clear"></div>
    </div>
</div>