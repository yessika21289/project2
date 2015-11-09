    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <a href="<?php echo base_url()?>admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-berita"><i class="fa fa-fw fa-file-text"></i> Berita <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-berita" class="collapse">
                    <li>
                        <a href="<?php echo base_url()?>admin/berita/baru">Berita Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/berita">Lihat Semua Berita</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-agenda"><i class="fa fa-fw fa-calendar"></i> Agenda <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-agenda" class="collapse">
                    <li>
                        <a href="<?php echo base_url()?>admin/agenda/baru">Agenda Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/agenda">Lihat Semua Agenda</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-gambar"><i class="fa fa-fw fa-image"></i> Gambar <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-gambar" class="collapse">
                    <li>
                        <a href="<?php echo base_url()?>admin/gambar/baru">Gambar Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/gambar">Lihat Semua Gambar</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/firman"><i class="fa fa-fw fa-heart"></i> Firman Tuhan</a>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/visi"><i class="fa fa-fw fa-bookmark"></i> Visi & Misi</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Dashboard <small>Statistics Overview</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            	<div class="huge"><?php echo $jumlah_berita; ?></div>
                                <div>total Berita</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url()?>admin/berita">
                        <div class="panel-footer">
                            <span class="pull-left">lihat semua berita</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-calendar fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $jumlah_agenda; ?></div>
                                <div>total agenda</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url()?>admin/agenda">
                        <div class="panel-footer">
                            <span class="pull-left">lihat semua agenda</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-image fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">124</div>
                                <div>total gambar</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">lihat semua gambar</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-heart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">&nbsp;</div>
                                <div>firman Tuhan hari ini</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">ubah konten firman Tuhan</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow panel-purple">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bookmark fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">&nbsp;</div>
                                <div>visi & misi</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url()?>admin/visi">
                        <div class="panel-footer">
                            <span class="pull-left">ubah konten visi & misi</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <span class="badge">just now</span>
                                <i class="fa fa-fw fa-calendar"></i> Calendar updated
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">4 minutes ago</span>
                                <i class="fa fa-fw fa-comment"></i> Commented on a post
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">23 minutes ago</span>
                                <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">46 minutes ago</span>
                                <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">1 hour ago</span>
                                <i class="fa fa-fw fa-user"></i> A new user has been added
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">2 hours ago</span>
                                <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">yesterday</span>
                                <i class="fa fa-fw fa-globe"></i> Saved the world
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">two days ago</span>
                                <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                            </a>
                        </div>
                        <div class="text-right">
                            <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
