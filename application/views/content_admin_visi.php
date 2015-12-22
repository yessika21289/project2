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
                        $ctujuan = $visi[0]->tujuan_sekolah;
                        if($instansi == "ypki") {
                            $cnilai_kristiani = $visi[0]->nilai_kristiani;
                            $cmotto = $visi[0]->motto;
                            $carti_logo = $visi[0]->arti_logo;
                        }
                    ?>

                    <div class="form-group">
                        <label>Visi</label>
                        <textarea name="visi" class="form-control input-konten" rows="10"><?php echo $cvisi; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Misi</label>
                        <textarea name="misi" class="form-control input-konten" rows="10"><?php echo $cmisi; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Tujuan Sekolah</label>
                        <textarea name="tujuan_sekolah" class="form-control input-konten" rows="10"><?php echo $ctujuan; ?></textarea>
                    </div>

                    <?php if($instansi == "ypki"): ?>
                        <div class="form-group">
                            <label>Nilai Kristiani</label>
                            <textarea name="nilai_kristiani" class="form-control input-konten" rows="10"><?php echo $cnilai_kristiani; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Motto</label>
                            <textarea name="motto" class="form-control input-konten" rows="10"><?php echo $cmotto; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Arti Logo</label>
                            <textarea name="arti_logo" class="form-control input-konten" rows="10"><?php echo $carti_logo; ?></textarea>
                        </div>
                    <?php endif; ?>

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