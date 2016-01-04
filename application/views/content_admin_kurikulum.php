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
                        $pelajaran_aktif = 0;
                        $intrakurikuler_aktif = 0;
                        $ekstrakurikuler_aktif = 0;
                        $asrama_aktif = 0;
                        if(!empty($kurikulum)){
                            foreach ($kurikulum as $key => $deskripsi) {
                                $kur[$kurikulum[$key]->jenis] = $kurikulum[$key]->deskripsi;
                                ${$kurikulum[$key]->jenis.'_aktif'} = $kurikulum[$key]->aktif;
                            }
                            $pelajaran = (isset($kur['pelajaran'])) ? trim($kur['pelajaran']) : '';
                            $intrakurikuler = (isset($kur['intrakurikuler'])) ? trim($kur['intrakurikuler']) : '';
                            $ekstrakurikuler = (isset($kur['ekstrakurikuler'])) ? trim($kur['ekstrakurikuler']) : '';
                            $asrama = (isset($kur['asrama'])) ? trim($kur['asrama']) : '';
                        }
                        else{
                            $pelajaran = '';
                            $intrakurikuler = '';
                            $ekstrakurikuler = '';
                            $asrama = '';
                        }
                    ?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="pelajaran_aktif" value="1"
                                <?php if($pelajaran_aktif == 1) echo "checked"; ?> />
                        Jadwal Pelajaran</label>
                        <textarea name="pelajaran" class="form-control input-konten editor" rows="10"><?php echo $pelajaran; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="intrakurikuler_aktif" value="1"
                                <?php if($intrakurikuler_aktif == 1) echo "checked"; ?> />
                        Intrakurikuler / Classroom Learning</label>
                        <textarea name="intrakurikuler" class="form-control input-konten editor" rows="10"><?php echo $intrakurikuler; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="ekstrakurikuler_aktif" value="1"
                                <?php if($ekstrakurikuler_aktif == 1) echo "checked"; ?> />
                        Ekstrakurikuler dan Pengembangan Diri</label>
                        <textarea name="ekstrakurikuler" class="form-control input-konten editor" rows="10"><?php echo $ekstrakurikuler; ?></textarea>
                    </div>
                    <?php if($instansi == 'smaki'){?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="asrama_aktif" value="1"
                                <?php if($asrama_aktif == 1) echo "checked"; ?> />
                        Program dan Kegiatan Asrama</label>
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