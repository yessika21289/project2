<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                    if (isset($berita_edit))
                        echo "Ubah Agenda";
                    else
                        echo "Agenda Baru";
                    ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-file-text"></i>  <a href="<?php echo base_url()?>admin/agenda">Agenda</a>
                    </li>
                    <li class="active">
                        <?php
                        if (isset($berita_edit))
                            echo "<i class='fa fa-pencil'></i> Ubah Agenda";
                        else
                            echo "<i class='fa fa-plus'></i> Agenda Baru";
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
                        <strong>Sukses!</strong> Agenda baru berhasil ditambahkan. <a href="<?php echo $read_link; ?>">Lihat agenda</a>
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
                <strong>Gagal!</strong> Terjadi kesalahan. Agenda baru gagal ditambahkan
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
                    <strong>Sukses!</strong> Agenda berhasil diubah. <a href="<?php echo $read_link; ?>">Lihat agenda</a>
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
            <strong>Gagal!</strong> Terjadi kesalahan. Agenda tidak dapat diubah
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
            $konten = "";
            $tanggal = "";
            $ins = $instansi;
            $id = "";

            if (isset($berita_edit))
            {
                $id = $berita_edit->id;
                $judul = $berita_edit->nama;
                $konten = $berita_edit->deskripsi;
                $tanggal = $berita_edit->tanggal;
                echo "<input type='hidden' name='id' value='".$id."'>";
            }
            ?>

            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control input-tanggal" value="<?php echo $tanggal; ?>">
                <p class="text-right help-block error-tanggal">* tanggal tidak boleh kosong</p>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="editor" name="konten" class="form-control input-konten" rows="10"><?php echo $konten; ?></textarea>
            </div>

            <div class="form-group">
                <input type="hidden" name="instansi" class="form-control input-instansi" value="<?php echo $ins; ?>">
            </div>

            <div class="text-right">
                <button type="reset" class="btn btn-default">Reset</button>
                <?php
                if (isset($berita_edit))
                    echo "<button type='submit' class='btn btn-primary input-submit' disabled name='update'>Ubah Agenda</button>";
                else
                    echo "<button type='submit' class='btn btn-primary input-submit' disabled name='submit'>Buat Agenda</button>";
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

<input type="hidden" class="page-type" value="agenda" />