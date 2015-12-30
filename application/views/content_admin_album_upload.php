<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    <?php
                        if (isset($berita_edit))
                            echo "Ubah Dokumentasi";
                        else
                            echo "Dokumentasi";
                    ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-file-text"></i>  <a href="<?php echo base_url()?>admin/album">Dokumentasi</a>
                    </li>
                    <li class="active">
                        <?php
                            if (isset($berita_edit))
                                echo "<i class='fa fa-pencil'></i> Ubah Dokumentasi";
                            else
                                echo "<i class='fa fa-plus'></i> Dokumentasi Baru";
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
                  <strong>Sukses!</strong> Dokumen baru berhasil ditambahkan. <a href="<?php echo $read_link; ?>" target="lihatBerita">Lihat Dokumen</a>
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

        <div class="row">        
            
            <div class="col-xs-12">
                
                <form id="form-album-baru" role="form" method="post" action="<?php echo base_url().'admin/album/upload_image';?>" enctype="multipart/form-data">

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

                    <!-- <div class="form-group">
                        <label>Nama Album</label>
                            <input name="judul" class="form-control input-judul" value="<?php echo $judul; ?>">
                            <p class="text-right help-block error-judul">* nama album tidak boleh kosong</p>
                    </div>
 -->
                    <!-- <input type="hidden" name="instansi" value="<?php echo $instansi; ?>"> -->
                    
                    

                    <!-- ================================UPLOAD IMAGES============================== -->

                    <div>
                        <div class="upload_div">
                            
                            <input type="hidden" name="directory" id="directory" value="<?php echo $album['directory'];?>"/>
                            <input type="hidden" name="image_form_submit" value="1"/>
                            <h4>Judul Dokumentasi: <?php echo $album['judul'];?></h4>
                                <label>Pilih Gambar</label>
                                <input type="file" name="images[]" id="images" multiple >
                            <div class="uploading none">
                                <label>&nbsp;</label>
                                <img src="<?php echo base_url().'asset/img/uploading.gif';?>"/>
                            </div>
                        
                        </div>
                        
                        <div class="gallery" id="images_preview">
                        <?php
                            $dir = "asset/album/".$album['directory'];

                            if (is_dir($dir)){
                              if ($dh = opendir($dir)){
                                $count=0;
                                while (($file = readdir($dh)) !== false){
                                  if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store'){
                                    $count++;
                                    $image_src = base_url().'/'.$dir.'/'.$file;
                                    /*$size = getimagesize($image_src);
                                    $width = $size[0];
                                    $height = $size[1];

                                    if($width>=$height){
                                      $style = "width:250px; height:auto;";
                                    }
                                    else{
                                      $style = "height:300px;";
                                    }*/
                                    echo '
                                    <div class="reorder_ul reorder-photos-list" style="width:285px; height: 335px; float:left">
                                      <div id="image_li_'.$count.'" class="ui-sortable-handle">
                                          <a href="javascript:void(0);" style="float:none;" class="image_link"><img src="'.$image_src.'" alt=""></a>
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

                    <!-- =========================================================================== -->

                    <!-- <div class="text-right">
                        <button type="button" class="btn btn-default">Cancel</button>
                        <?php
                            /*if (isset($album_edit))
                                echo "<button type='submit' class='btn btn-primary input-submit' disabled name='update'>Ubah Nama Album Berita</button>";
                            else
                                echo "<button type='submit' class='btn btn-primary input-submit' disabled name='submit'>Buat Album</button>";*/
                        ?>
                    </div> -->
                </form>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<input type="hidden" class="page-type" value="album" />