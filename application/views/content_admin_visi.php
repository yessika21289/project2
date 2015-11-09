    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
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
            <li class="active">
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
                    Visi & Misi
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Visi & Misi
                    </li>
                </ol>
            </div>
        <!-- /.row -->

        <?php
            if (isset($update_confirm))
            {
                if ($update_confirm == 1)
                {
        ?>
        <div class="row">
            <div class="col-xs-10">
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Sukses!</strong> Visi & Misi berhasil diubah
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
                }
                else if($update_confirm == 0)
                {
        ?>
        <div class="col-xs-10">
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Gagal!</strong> Terjadi kesalahan. Misi & Visi gagal diubah
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
                }
            }
        ?>

        <div class="row">        
            
            <div class="col-xs-10">
                
                <form id="form-berita-baru" role="form" method="post" action="" enctype="multipart/form-data">

                    <?php
                        $cvisi = $visi[0]->visi;
                        $cmisi = $visi[0]->misi;                        
                    ?>

                    <div class="form-group">
                        <label>Visi</label>
                        <textarea name="visi" class="form-control input-konten" rows="10"><?php echo $cvisi; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Misi</label>
                        <textarea name="misi" class="form-control input-konten" rows="10"><?php echo $cmisi; ?></textarea>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Ganti Visi & Misi</button>;
                    </div>

                </form>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<input type="hidden" class="page-type" value="visi" />