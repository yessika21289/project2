<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Struktur Organisasi
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-bookmark"></i> Struktur Organisasi
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
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span></button>
                            <strong>Sukses!</strong> Struktur organisasi berhasil diubah.
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
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span></button>
                    <strong>Gagal!</strong> Terjadi kesalahan. Struktur organisasi gagal diubah.
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
                    $corganisasi = $tentang[0]->struktur_organisasi;
                    ?>

<!--                    <div class="form-group">-->
<!--                        <label>Struktur Organisasi</label>-->
<!--                        <textarea name="struktur_organisasi" class="form-control input-konten" rows="10">--><?php //echo $corganisasi; ?><!--</textarea>-->
<!--                    </div>-->

                    <div>
                        <div class="upload_div">
<!--                            <input type="hidden" name="directory" id="directory" value="struktur_organisasi"/>-->
                            <input type="hidden" name="image_form_submit" value="1"/>
                            <h4>Struktur Organisasi: <?php echo $instansi;?></h4>
                            <label>Pilih Gambar</label>
                            <input type="file" name="images[]" id="images" multiple >
                            <div class="uploading none">
                                <label>&nbsp;</label>
                                <img src="<?php echo base_url().'asset/img/uploading.gif';?>"/>
                            </div>

                        </div>

                        <div class="gallery" id="images_preview">
                            <?php
                            $dir = "asset/struktur_organisasi";

                            if (is_dir($dir)){
                                if ($dh = opendir($dir)){
                                    while (($file = readdir($dh)) !== false){
                                        if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store'){
                                            $image_src = base_url().'/'.$dir.'/'.$file;
                                            echo '
                                    <div class="reorder_ul reorder-photos-list" style="width:285px; height: 335px; float:left">
                                      <div id="image_li" class="ui-sortable-handle">
                                          <a href="javascript:void(0);" style="float:none;" class="image_link">
                                          <img src="'.$image_src.'" alt=""></a>
                                        </div>
                                    </div>
                                    ';
                                            //echo "" . $file . "<br>";
                                        }
                                    }
                                    closedir($dh);
                                }
                            }
                            ?>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type='submit' class='btn btn-primary input-submit' name='submit'>Simpan</button>;
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