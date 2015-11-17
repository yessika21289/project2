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

        <?php
        if (isset($submit_confirm))
        {
        if ($submit_confirm == 1)
        {
            ?>
            <div class="row">
                <div class="col-xs-10">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Sukses!</strong> Firman baru berhasil ditambahkan. <a href="<?php echo $read_link; ?>">Lihat Firman</a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
        }
        else if($submit_confirm == 0)
        {
        ?>
        <div class="col-xs-10">
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <strong>Gagal!</strong> Terjadi kesalahan. Firman baru gagal ditambahkan
            </div>
        </div>
    </div>
    <!-- /.row -->
    <?php
    }
    }
    else if (isset($update_confirm))
    {
    if ($update_confirm == 1)
    {
        ?>
        <div class="row">
            <div class="col-xs-10">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <strong>Sukses!</strong> Firman berhasil diubah. <a href="<?php echo $read_link; ?>">Lihat Firman</a>
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
            <strong>Gagal!</strong> Terjadi kesalahan. Firman tidak dapat diubah
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

        <form id="form-firman-baru" role="form" method="post" action="" enctype="multipart/form-data">

            <?php
            $konten = "";
            $tanggal = "";
            $ins = $instansi;
            $id = "";

            if (isset($firman_edit))
            {
                $id = $firman_edit->id;
                $judul = $firman_edit->nama;
                $konten = $firman_edit->deskripsi;
                $tanggal = $firman_edit->tanggal;
                echo "<input type='hidden' name='id' value='".$id."'>";
            }
            ?>

            <?php for($i=1; $i<=7; $i++): ?>
                <div style="overflow: auto;">
                    <div class="form-group" style="float: right; margin-left: 20px;">
                        <label>Firman Tuhan</label>
                        <textarea id="<?php echo "firman_".$i; ?>" class="editor" name="<?php echo "konten_".$i ?>" class="form-control input-konten" rows="3"><?php echo $konten; ?></textarea>
                    </div>
                    <div class="form-group"">
                        <label>Tanggal</label>
                        <input type="date" name="<?php echo "tanggal_".$i ?>" class="form-control input-tanggal" value="<?php echo $tanggal; ?>" style="width:155px;" onfocusout="showFirman(this.value, <?php echo $i; ?>)" />
                        <p class="text-right help-block error-tanggal">* tanggal tidak boleh kosong</p>
                    </div>

                </div>
                <hr style="height: 12px; border: 0; box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5);">
                <div class="form-group">
                    <input type="hidden" name="instansi" class="form-control input-instansi" value="<?php echo $ins; ?>" />
                </div>

            <?php endfor; ?>
        <div class="text-right">
            <!--                    <button type="reset" class="btn btn-default">Reset</button>-->
            <?php
            if (isset($firman_edit))
                echo "<button type='submit' class='btn btn-primary input-submit' name='update'>Ubah Firman</button>";
            else
                echo "<button type='submit' class='btn btn-primary input-submit' name='submit'>Buat Firman</button>";
            //                ?>
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