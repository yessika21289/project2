<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Kesiswaan
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Kesiswaan
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
                                <strong>Sukses!</strong> Kesiswaan berhasil diubah.
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
                            <strong>Gagal!</strong> Terjadi kesalahan. Kesiswaan gagal diubah.
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
                        if(!empty($kesiswaan)){
                            foreach ($kesiswaan as $key => $deskripsi) {
                                $siswa[$kesiswaan[$key]->jenis] = $kesiswaan[$key]->deskripsi;
                            }
                            $pelajaran = (isset($siswa['pelajaran'])) ? trim($siswa['pelajaran']) : '';
                            $administrasi = (isset($siswa['administrasi'])) ? trim($siswa['administrasi']) : '';
                            $osis = (isset($siswa['osis'])) ? trim($siswa['osis']) : '';
                        }
                        else{
                            $pelajaran = '';
                            $administrasi = '';
                            $osis = '';
                        }
                    ?>

                    <div class="form-group">
                        <label>Jadwal Pelajaran</label>
                        <textarea name="pelajaran" class="form-control input-konten editor" rows="10"><?php echo $pelajaran; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Administrasi</label>
                        <textarea name="administrasi" class="form-control input-konten editor" rows="10"><?php echo $administrasi; ?></textarea>
                    </div>
                    <?php if($instansi == 'smpki' || $instansi == 'smaki'){?>
                    <div class="form-group">
                        <label>OSIS</label>
                        <textarea name="osis" class="form-control input-konten editor" rows="10"><?php echo $osis; ?></textarea>
                    </div>
                    <?php }?>

                    <br/><br/>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Ganti Kesiswaan</button>
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