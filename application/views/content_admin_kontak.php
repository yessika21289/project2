<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Info Kontak
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Info Kontak
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
                            <strong>Sukses!</strong> Info kontak berhasil diubah.
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
                    <strong>Gagal!</strong> Terjadi kesalahan. Info kontak gagal diubah.
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
                        $calamat = (!empty($kontak[0]->alamat)) ? $kontak[0]->alamat : '';
                        $ctelp1 = (!empty($kontak[0]->telepon1)) ? $kontak[0]->telepon1 : '';
                        $ctelp2 = (!empty($kontak[0]->telepon2)) ? $kontak[0]->telepon2 : '';
                        $cfax = (!empty($kontak[0]->fax)) ? $kontak[0]->fax : '';
                        $cemail = (!empty($kontak[0]->email)) ? $kontak[0]->email : '';
                        $cwebsite = (!empty($kontak[0]->website)) ? $kontak[0]->website : '';
                    ?>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control input-konten" rows="10"><?php echo $calamat; ?></textarea>
                    </div>

                    <div class="form-group" style="float:left; margin-right: 30px;">
                        <label>Telepon 1</label>
                        <input type="text" class="form-control input-konten" name="telp1" value="<?php echo $ctelp1; ?>" style="width:250px;" />
                    </div>
                    <div class="form-group" style="float:left; margin-right: 30px;">
                        <label>Telepon 2</label>
                        <input type="text" class="form-control input-konten" name="telp2" value="<?php echo $ctelp2; ?>" style="width:250px;" />
                    </div>
                    <div class="form-group">
                        <label>Fax</label>
                        <input type="text" class="form-control input-konten" name="fax" value="<?php echo $cfax; ?>" style="width:250px;" />
                    </div>

                    <div class="form-group" style="float:left; margin-right: 30px;">
                        <label>Email</label>
                        <input type="text" class="form-control input-konten" name="email" value="<?php echo $cemail; ?>" style="width:250px;" />
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="text" class="form-control input-konten" name="web" value="<?php echo $cwebsite; ?>" style="width:250px;" />
                    </div>

                    <br/><br/>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Ganti Info Kontak</button>;
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