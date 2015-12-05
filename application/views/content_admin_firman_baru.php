<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                    if (isset($firman_edit))
                        echo "Ubah Firman";
                    else
                        echo "Firman Baru";
                    ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-file-text"></i>  <a href="<?php echo base_url()?>admin/firman">Firman</a>
                    </li>
                    <li class="active">
                        <?php
                        if (isset($firman_edit))
                            echo "<i class='fa fa-pencil'></i> Ubah Firman";
                        else
                            echo "<i class='fa fa-plus'></i> Firman Baru";
                        ?>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

<div class="row">

    <div class="col-xs-10">

        <form id="form-firman-baru" role="form" method="post" action="" enctype="multipart/form-data">

            <?php
            $konten = "";
            $tanggal = "";
            $ins = $instansi;
            $id = "";
            $j = 7;
            $disable = '';

            if (isset($firman_edit))
            {
                $id = $firman_edit->id;
                $post['konten_1'] = $firman_edit->firman;
                $post['tanggal_1'] = $firman_edit->created;
                $j = 1;
                $disable = "disabled";
                echo "<input type='hidden' name='id' value='".$id."'>";
            }
            if($gagal === 0) {
                echo '<div class="col-xs-10" style="float: none;">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Gagal!</strong> Terjadi kesalahan. Firman baru gagal ditambahkan/diubah.
                        </div>
                    </div>';
            }
            ?>

            <?php for($i=1; $i<=$j; $i++): ?>
                <div style="overflow: auto;">
                    <div class="form-group" style="float: right; margin-left: 2%; width:79%;">
                        <label>Firman Tuhan</label>
                        <textarea id="<?php echo "firman_".$i; ?>" name="<?php echo "konten_".$i; ?>" class="form-control input-konten" rows="5"><?php echo !empty($post['konten_'.$i]) ? $post['konten_'.$i] : ''; ?></textarea>
                    </div>
                    <div class="form-group"">
                        <label>Tanggal</label>
                        <input type="date" name="<?php echo "tanggal_".$i ?>" class="form-control input-tanggal" value="<?php echo !empty($post['tanggal_'.$i]) ? $post['tanggal_'.$i] : ''; ?>" style="width:19%;" onfocusout="showFirman(this.value, <?php echo $i; ?>)" <?php echo $disable; ?> />
                        <p class="text-right help-block error-tanggal" >* tanggal tidak boleh kosong</p>
                    </div>
                </div>
                <hr style="height: 12px; border: 0; box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);">
                <div class="form-group">
                    <input type="hidden" name="instansi" class="form-control input-instansi" value="<?php echo $ins; ?>" />
                </div>

            <?php endfor; ?>
        <div class="text-right">
            <!--<button type="reset" class="btn btn-default">Reset</button>-->
            <?php
                if (isset($firman_edit))
                    echo "<button type='submit' class='btn btn-primary input-submit' name='update'>Ubah Firman</button>";
                else
                    echo "<button type='submit' class='btn btn-primary input-submit' name='submit'>Buat Firman</button>";
            ?>
        </div>
        </form>

    </div>

</div>
<!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<input type="hidden" class="page-type" value="firman" />