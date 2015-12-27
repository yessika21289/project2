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

        <div class="row">

            <div class="col-xs-10">

                <form id="form-berita-baru" role="form" method="post" action="" enctype="multip art/form-data">

                    <?php
                        foreach ($fasilitas as $key => $deskripsi) {
                            $fas[$fasilitas[$key]->jenis] = $fasilitas[$key]->deskripsi;
                        }
                        $sekolah = (!empty(trim($fas['sekolah']))) ? trim($fas['sekolah']) : '';
                        $ruang_belajar = (!empty(trim($fas['ruang_belajar']))) ? trim($fas['ruang_belajar']) : '';
                        $laboratorium = (!empty(trim($fas['laboratorium']))) ? trim($fas['laboratorium']) : '';
                        $perpustakaan = (!empty(trim($fas['perpustakaan']))) ? trim($fas['perpustakaan']) : '';
                        $olahraga = (!empty(trim($fas['olahraga']))) ? trim($fas['olahraga']) : '';
                        $komputer = (!empty(trim($fas['komputer']))) ? trim($fas['komputer']) : '';
                        $fasilitas_lain = (!empty(trim($fas['fasilitas_lain']))) ? trim($fas['fasilitas_lain']) : '';
                        $multimedia = (!empty(trim($fas['multimedia']))) ? trim($fas['multimedia']) : '';
                        $aula = (!empty(trim($fas['aula']))) ? trim($fas['aula']) : '';
                    ?>

                    <div class="form-group">
                        <label>Sekolah</label>
                        <textarea name="sekolah" class="form-control input-konten editor" rows="10"><?php echo $sekolah; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ruang Belajar</label>
                        <textarea name="ruang_belajar" class="form-control input-konten editor" rows="10"><?php echo $ruang_belajar; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Laboratorium</label>
                        <textarea name="laboratorium" class="form-control input-konten editor" rows="10"><?php echo $laboratorium; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Perpustakaan</label>
                        <textarea name="perpustakaan" class="form-control input-konten editor" rows="10"><?php echo $perpustakaan; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas Olahraga</label>
                        <textarea name="olahraga" class="form-control input-konten editor" rows="10"><?php echo $olahraga; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Lab Komputer</label>
                        <textarea name="komputer" class="form-control input-konten editor" rows="10"><?php echo $komputer; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas Lain</label>
                        <textarea name="fasilitas_lain" class="form-control input-konten editor" rows="10"><?php echo $fasilitas_lain; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ruang Multimedia</label>
                        <textarea name="multimedia" class="form-control input-konten editor" rows="10"><?php echo $multimedia; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Ruang Aula / Pertemuan</label>
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