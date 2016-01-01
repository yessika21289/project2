<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Kurikulum
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Kurikulum
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
                            <strong>Sukses!</strong> Kurikulum berhasil diubah.
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
                    <strong>Gagal!</strong> Terjadi kesalahan. Kurikulum gagal diubah.
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

                <form id="form-berita-baru" role="form" method="post" action="" enctype="multip art/form-data">

                    <?php
                        if(!empty($kurikulum)){
                            foreach ($kurikulum as $key => $deskripsi) {
                                $kur[$kurikulum[$key]->jenis] = $kurikulum[$key]->deskripsi;
                            }
                            $pelajaran = (isset($kur['pelajaran'])) ? trim($kur['pelajaran']) : '';
                            $intrakurikuler = (isset($kur['intrakurikuler'])) ? trim($kur['intrakurikuler']) : '';
                            $ekstrakurikuler = (isset($kur['ekstrakurikuler'])) ? trim($kur['ekstrakurikuler']) : '';
                            $asrama = (isset($kur['asrama'])) ? trim($kur['asrama']) : '';
                        }
                        else{
                            $intrakurikuler = '';
                            $ekstrakurikuler = '';
                            $asrama = '';
                        }
                    ?>
                    <div class="form-group">
                        <label>Jadwal Pelajaran</label>
                        <textarea name="pelajaran" class="form-control input-konten editor" rows="10"><?php echo $pelajaran; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Intrakurikuler / Classroom Learning</label>
                        <textarea name="intrakurikuler" class="form-control input-konten editor" rows="10"><?php echo $intrakurikuler; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ekstrakurikuler dan Pengembangan Diri</label>
                        <textarea name="ekstrakurikuler" class="form-control input-konten editor" rows="10"><?php echo $ekstrakurikuler; ?></textarea>
                    </div>
                    <?php if($instansi == 'smaki'){?>
                    <div class="form-group">
                        <label>Program dan Kegiatan Asrama</label>
                        <textarea name="asrama" class="form-control input-konten editor" rows="10"><?php echo $asrama; ?></textarea>
                    </div>
                    <?php }?>

                    <br/><br/>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Ganti Kurikulum</button>
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