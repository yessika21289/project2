<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                        if (isset($berita_edit))
                            echo "Ubah Berita";
                        else
                            echo "Berita Baru";
                    ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-file-text"></i>  <a href="<?php echo base_url()?>admin/berita">Berita</a>
                    </li>
                    <li class="active">
                        <?php
                            if (isset($berita_edit))
                                echo "<i class='fa fa-pencil'></i> Ubah Berita";
                            else
                                echo "<i class='fa fa-plus'></i> Berita Baru";
                        ?>
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <?php
            if (isset($submit_confirm) && ($submit_confirm === 1 || $submit_confirm === 0))
            {
                if ($submit_confirm === 1)
                {
        ?>
        <div class="row">
            <div class="col-xs-10">
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Sukses!</strong> Berita baru berhasil ditambahkan. <a href="<?php echo $read_link; ?>" target="lihatBerita">Lihat berita</a> 
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
                }
                else if($submit_confirm === 0)
                {
        ?>
        <div class="col-xs-10">
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Gagal!</strong> Terjadi kesalahan. Berita baru gagal ditambahkan
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
                }
            }
            else if (isset($update_confirm) && ($update_confirm === 1 || $update_confirm === 0))
            {
                if ($update_confirm === 1)
                {
        ?>
        <div class="row">
            <div class="col-xs-10">
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Sukses!</strong> Berita berhasil diubah. <a href="<?php echo $read_link; ?>" target="lihatBerita">Lihat berita</a>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
                }
                else if($update_confirm === 0)
                {
        ?>
        <div class="col-xs-10">
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <strong>Gagal!</strong> Terjadi kesalahan. Berita tidak dapat diubah
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php
                }
            }
        ?>
<?php //print_r($submit_confirm);?>
        <div class="row">        
            
            <div class="col-xs-10">
                
                <form id="form-berita-baru" role="form" method="post" action="" enctype="multipart/form-data">

                    <?php
                        $judul = "";
                        $konten = "";
                        $gambar = "";
                        $link = "";
                        $label = "";
                        $id = "";
                        $tipe = "";

                        if (isset($berita_edit))
                        {
                            $id = $berita_edit->id;
                            $judul = $berita_edit->judul;
                            $konten = $berita_edit->konten;
                            $gambar = $berita_edit->gambar;
                            $tipe = $berita_edit->tipe_gambar;
                            $label = $berita_label;
                            echo "<input type='hidden' name='id' value='".$id."'>";
                        }
                    ?>

                    <div class="form-group">
                        <label>Judul Berita</label>
                            <input name="judul" class="form-control input-judul" value="<?php echo $judul; ?>">
                            <p class="text-right help-block error-judul">* judul tidak boleh kosong</p>
                    </div>

                    <div class="form-group">
                        <label>Konten Berita</label>
                        <textarea class="editor" name="konten" class="form-control input-konten" rows="10"><?php echo $konten; ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Gambar</label>

                        <!-- <div class="form-select-gambar" <?php if ($gambar!="") echo "style='display:none;'"; ?> >
                            <label class="radio-inline"><input type="radio" name="input-opt" value="1" selected>Upload Gambar</label>
                            <label class="radio-inline"><input type="radio" name="input-opt" value="2">Link</label>
                        </div> -->
                        <br/>

                        <?php
                            if ($gambar!="")
                            {
                                echo "<div class='preview-gambar'>";
                                if ($tipe == "foto")
                                    echo "<img src='".base_url()."asset/berita/".$gambar."' />";
                                else
                                    echo "<img src='".$gambar."' />";
                                echo "<div class='ganti-gambar'>ganti gambar</div>";
                                echo "</div>";
                                echo "<input type='hidden' name='nama_gambar' value='".$gambar."'>";
                            }
                        ?>

                        <div class="form-input-gambar">
                            <input type="file" name="gambar" accept="image/*" class="input-gambar" value="<?php echo $gambar; ?>"/>
                            <p class="help-block">Ukuran gambar : 600px X 360px.<br/>Sistem akan otomatis melakukan <i>cropping</i> bila ukuran gambar tidak sesuai.</p>
                            <p class="text-right help-block error-gambar">* anda harus memilih gambar</p>
                        </div>

                        <!-- <div class="form-input-link">
                            <input name="link" class="form-control input-link" value="<?php echo $link; ?>"/>
                            <p class="help-block">gambar yang disarankan berukuran 600x360 (atau memiliki resolusi 5:3)</p>
                            <p class="text-right help-block error-link">* anda harus memasukkan link gambar</p>
                        </div> -->


                    </div>

                    <div class="form-group">

                        <label>Label Berita</label> <span class="label label-info auto-label"><?php echo $instansi ?></span>
                        <input name="label" name="label" class="form-control input-label" value="<?php echo $label; ?>">
                        <p class="help-block">Pisahkan label dengan tanda koma. Disarankan tidak menggunakan spasi. Contoh: ypki,sekolah,pendidikan</p>
                    </div>

                    <input type="hidden" name="instansi" value="<?php echo $instansi; ?>">

                    <div class="text-right">
                        <button type="cancel" class="btn btn-default" onclick="window.location.href='/admin/berita';return false;">Cancel</button>
                        <?php
                            if (isset($berita_edit))
                                echo "<button type='submit' class='btn btn-primary input-submit' disabled name='update'>Ubah Berita</button>";
                            else
                                echo "<button type='submit' class='btn btn-primary input-submit' disabled name='submit'>Buat Berita</button>";
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

<input type="hidden" class="page-type" value="berita" />