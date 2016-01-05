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

        <div class="row admin">

            <div class="col-xs-10">

                <form id="form-berita-baru" role="form" method="post" action="" enctype="multip art/form-data">

                    <?php
                        if(!empty($kesiswaan)){
                            foreach ($kesiswaan as $key => $deskripsi) {
                                $siswa[$kesiswaan[$key]->jenis] = $kesiswaan[$key]->deskripsi;
                                ${$kesiswaan[$key]->jenis.'_aktif'} = $kesiswaan[$key]->aktif;
                            }
                            $administrasi = (isset($siswa['administrasi'])) ? trim($siswa['administrasi']) : '';
                            $osis = (isset($siswa['osis'])) ? trim($siswa['osis']) : '';
                            $siswa = (isset($siswa['siswa'])) ? trim($siswa['siswa']) : '';
                        }
                        else{
                            $pelajaran = '';
                            $administrasi = '';
                            $osis = '';
                            $siswa = '';
                        }
                    ?>

                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="administrasi_aktif" value="1"
                                <?php if($administrasi_aktif == 1) echo "checked"; ?> />
                            Administrasi</label>
                        <textarea name="administrasi" class="form-control input-konten editor" rows="10"><?php echo $administrasi; ?></textarea>
                    </div>
                    <?php if($instansi == 'smpki' || $instansi == 'smaki'){?>
                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="osis_aktif" value="1"
                                <?php if($osis_aktif == 1) echo "checked"; ?> />
                            OSIS</label>
                        <textarea name="osis" class="form-control input-konten editor" rows="10"><?php echo $osis; ?></textarea>
                    </div>
                    <?php }?>

                    <div class="form-group">
                        <label style="font-weight: bold;"><input type="checkbox" name="siswa_aktif" value="1"
                                <?php if($siswa_aktif == 1) echo "checked"; ?> />
                            Siswa</label>
                        <textarea name="siswa" class="form-control input-konten editor" rows="10"><?php echo $siswa; ?></textarea>
                    </div>

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