<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Fasilitas
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Fasilitas
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
                            <strong>Sukses!</strong> Fasilitas berhasil diubah.
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
                    <strong>Gagal!</strong> Terjadi kesalahan. Fasilitas gagal diubah.
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
                        $sekolah_aktif = '';
                        $ruang_belajar_aktif = '';
                        $laboratorium_aktif = '';
                        $perpustakaan_aktif = '';
                        $olahraga_aktif = '';
                        $komputer_aktif = '';
                        $fasilitas_lain_aktif = '';
                        $multimedia_aktif = '';
                        $aula_aktif = '';

                        if(!empty($fasilitas)) {
                            foreach ($fasilitas as $key => $deskripsi) {
                                $fas[$fasilitas[$key]->jenis] = $fasilitas[$key]->deskripsi;
                                ${$fasilitas[$key]->jenis.'_aktif'} = $fasilitas[$key]->aktif;
                            }
                            $sekolah = (isset($fas['sekolah'])) ? trim($fas['sekolah']) : '';
                            $ruang_belajar = (isset($fas['ruang_belajar'])) ? trim($fas['ruang_belajar']) : '';
                            $laboratorium = (isset($fas['laboratorium'])) ? trim($fas['laboratorium']) : '';
                            $perpustakaan = (isset($fas['perpustakaan'])) ? trim($fas['perpustakaan']) : '';
                            $olahraga = (isset($fas['olahraga'])) ? trim($fas['olahraga']) : '';
                            $komputer = (isset($fas['komputer'])) ? trim($fas['komputer']) : '';
                            $fasilitas_lain = (isset($fas['fasilitas_lain'])) ? trim($fas['fasilitas_lain']) : '';
                            $multimedia = (isset($fas['multimedia'])) ? trim($fas['multimedia']) : '';
                            $aula = (isset($fas['aula'])) ? trim($fas['aula']) : '';
                        }
                        else{
                            $sekolah = '';
                            $ruang_belajar = '';
                            $laboratorium = '';
                            $perpustakaan = '';
                            $olahraga = '';
                            $komputer = '';
                            $fasilitas_lain = '';
                            $multimedia = '';
                            $aula = '';
                        }
                    ?>

                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="sekolah_aktif" value="1"
                                <?php if($sekolah_aktif == 1) echo "checked"; ?> />
                            Sekolah</label>
                        <textarea name="sekolah" class="form-control input-konten editor" rows="10"><?php echo $sekolah; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="ruang_belajar_aktif" value="1"
                                <?php if($ruang_belajar_aktif == 1) echo "checked"; ?> />
                            Ruang Belajar</label>
                        <textarea name="ruang_belajar" class="form-control input-konten editor" rows="10"><?php echo $ruang_belajar; ?></textarea>
                    </div>
                    <?php if($instansi == "smpki" || $instansi == "smaki"){?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="laboratorium_aktif" value="1"
                                <?php if($laboratorium_aktif == 1) echo "checked"; ?> />
                            Laboratorium</label>
                        <textarea name="laboratorium" class="form-control input-konten editor" rows="10"><?php echo $laboratorium; ?></textarea>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="perpustakaan_aktif" value="1"
                                <?php if($perpustakaan_aktif == 1) echo "checked"; ?> />
                            Perpustakaan</label>
                        <textarea name="perpustakaan" class="form-control input-konten editor" rows="10"><?php echo $perpustakaan; ?></textarea>
                    </div>
                    <?php if($instansi == "sdki" || $instansi == "smpki" || $instansi == "smaki"){?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="olahraga_aktif" value="1"
                                <?php if($olahraga_aktif == 1) echo "checked"; ?> />
                            Fasilitas Olahraga</label>
                        <textarea name="olahraga" class="form-control input-konten editor" rows="10"><?php echo $olahraga; ?></textarea>
                    </div>
                    <?php }?>
                    <?php if($instansi == "sdki" || $instansi == "smpki" || $instansi == "smaki"){?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="komputer_aktif" value="1"
                                <?php if($komputer_aktif == 1) echo "checked"; ?> />
                            Lab Komputer</label>
                        <textarea name="komputer" class="form-control input-konten editor" rows="10"><?php echo $komputer; ?></textarea>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="fasilitas_lain_aktif" value="1"
                                <?php if($fasilitas_lain_aktif == 1) echo "checked"; ?> />
                            Fasilitas Lain</label>
                        <textarea name="fasilitas_lain" class="form-control input-konten editor" rows="10"><?php echo $fasilitas_lain; ?></textarea>
                    </div>
                    <?php if($instansi == "sdki" || $instansi == "smpki" || $instansi == "smaki"){?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="multimedia_aktif" value="1"
                                <?php if($multimedia_aktif == 1) echo "checked"; ?> />
                            Ruang Multimedia</label>
                        <textarea name="multimedia" class="form-control input-konten editor" rows="10"><?php echo $multimedia; ?></textarea>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="aula_aktif" value="1"
                                <?php if($aula_aktif == 1) echo "checked"; ?> />
                            Ruang Aula / Pertemuan</label>
                        <textarea name="aula" class="form-control input-konten editor" rows="10"><?php echo $aula; ?></textarea>
                    </div>

                    <br/><br/>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Ganti Fasilitas</button>
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