<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Personalia
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Personalia
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
                                <strong>Sukses!</strong> Personalia berhasil diubah.
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
                            <strong>Gagal!</strong> Terjadi kesalahan. Personalia gagal diubah.
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
                        if(!empty($personalia)){
                            foreach ($personalia as $key => $deskripsi) {
                                $person[$personalia[$key]->jenis] = $personalia[$key]->deskripsi;
                            }
                            $pimpinan = (isset($person['pimpinan'])) ? trim($person['pimpinan']) : '';
                            $pengajar = (isset($person['pengajar'])) ? trim($person['pengajar']) : '';
                            $tenaga_pendidik = (isset($person['tenaga_pendidik'])) ? trim($person['tenaga_pendidik']) : '';
                            $siswa = (isset($person['siswa'])) ? trim($person['siswa']) : '';
                        }
                        else{
                            $pimpinan = '';
                            $pengajar = '';
                            $tenaga_pendidik = '';
                            $siswa = '';
                        }
                    ?>

                    <?php if($instansi == 'ypki'){?>
                    <div class="form-group">
                        <label>Staff Pimpinan</label>
                        <textarea name="pimpinan" class="form-control input-konten editor" rows="10"><?php echo $pimpinan; ?></textarea>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label>Staff Kependidikan / Pengajar</label>
                        <textarea name="pengajar" class="form-control input-konten editor" rows="10"><?php echo $pengajar; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Staff Tenaga Kependidikan</label>
                        <textarea name="tenaga_pendidik" class="form-control input-konten editor" rows="10"><?php echo $tenaga_pendidik; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Siswa</label>
                        <textarea name="siswa" class="form-control input-konten editor" rows="10"><?php echo $siswa; ?></textarea>
                    </div>

                    <br/><br/>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Ganti Personalia</button>
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