<?php echo doctype("html5"); ?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Yayasan Pendidikan Kristen Indonesia</title>

	<link rel="icon" href="<?php echo base_url().'asset/img/favicon.ico'; ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/bootstrap.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/bootstrap-theme.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/style.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/sb-admin.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/font-awesome.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'asset/css/wbbtheme.css'; ?>">

	<script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.min.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'asset/js/admin.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'asset/js/bootstrap.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.timeago.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.wysibb.min.js'; ?>"></script>
	
</head>
<body>
	
	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <?php
                    $prefix = "";
                    if($instansi == "smaki") {
                        $prefix = "smaki/";
                        $title = "SMA Kristen Indonesia";
                    }
                    else if($instansi == "smpki") {
                        $prefix = "smpki/";
                        $title = "SMP Kristen Indonesia";
                    }
                    else if($instansi == "sdki") {
                        $prefix = "sdki/";
                        $title = "SD Kristen Indonesia";
                    }
                    else if($instansi == "kbtk") {
                        $prefix = "kbtk/";
                        $title = "KB / TK Tunas Kasih";
                    }
                    else{
                        $title = "Yayasan Perguruan Kristen Indonesia";
                    }
                ?>

                <span class="href"><?php echo base_url(); ?></span>

                <a class="navbar-brand" href="<?php echo base_url().$prefix; ?>"><?php echo $title;?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Tes Pesan</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Tes Pesan</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading"><strong>Tes Pesan</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $username; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo base_url().'logout'; ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>