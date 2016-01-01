<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Tujuan Sekolah
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Profil
                    </li>
                    <li class="active">Tujuan Sekolah</li>
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
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span></button>
                            <strong>Sukses!</strong> Tujuan sekolah berhasil diubah.
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
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span></button>
                    <strong>Gagal!</strong> Terjadi kesalahan. Tujuan sekolah gagal diubah.
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
        }
        }
        ?>

        <div class="row admin">

            <div class="col-xs-10">

                <form id="form-berita-baru" role="form" method="post" action="" enctype="multipart/form-data">

                    <?php
                        $ctujuan = $profil[0]->tujuan_sekolah;
                    ?>

                    <div class="form-group">
                        <label>Tujuan Sekolah</label>
                        <textarea name="tujuan_sekolah" class="form-control input-konten" rows="10"><?php echo $ctujuan; ?></textarea>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Simpan</button>
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