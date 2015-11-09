<?php echo doctype("html5"); ?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Yayasan Perguruan Kristen Indonesia" />
	<meta name="keywords" content="ypki, yayasan, perguruan, kristen, indonesia" />
	<title>
		<?php
			if (!isset($html_title))
				echo "Yayasan Perguruan Kristen Indonesia";
			else echo $html_title;
		?>
		
	</title>

	<link rel="icon" href="<?php echo base_url().'asset/img/favicon.ico'; ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/bootstrap.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/bootstrap-theme.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/style.css'; ?>">

	<script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'asset/js/script.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'asset/js/bootstrap.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.timeago.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.wysibb.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'asset/js/bootstrap-hover-dropdown.js'; ?>"></script>
	
</head>
<body>
	<div id="container">