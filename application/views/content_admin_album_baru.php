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
                            echo "Album Baru";
                    ?>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-file-text"></i>  <a href="<?php echo base_url()?>admin/album">Album</a>
                    </li>
                    <li class="active">
                        <?php
                            if (isset($berita_edit))
                                echo "<i class='fa fa-pencil'></i> Ubah Berita";
                            else
                                echo "<i class='fa fa-plus'></i> Album Baru";
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
                        <label>Nama Album</label>
                            <input name="judul" class="form-control input-judul" value="<?php echo $judul; ?>">
                            <p class="text-right help-block error-judul">* nama album tidak boleh kosong</p>
                    </div>

                    
                    <div class="text-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <?php
                            if (isset($berita_edit))
                                echo "<button type='submit' class='btn btn-primary input-submit' disabled name='update'>Ubah Berita</button>";
                            else
                                echo "<button type='submit' class='btn btn-primary input-submit' disabled name='submit'>Buat Berita</button>";
                        ?>
                    </div>

                    <!-- ================================UPLOAD IMAGES============================== -->
                    <script type="text/javascript" src="<?php echo base_url().'asset/js/jquery.form.js';?>"></script>
                    <script type="text/javascript">
                    $(document).ready(function(){
                        $('#images').on('change',function(){
                            $('#multiple_upload_form').ajaxForm({
                                target:'#images_preview',
                                beforeSubmit:function(e){
                                    $('.uploading').show();
                                },
                                success:function(e){
                                    $('.uploading').hide();
                                },
                                error:function(e){
                                }
                            }).submit();
                        });
                    });
                    </script>
                    <div style="margin-top:50px;">
                        <div class="upload_div">
                        <form method="post" name="multiple_upload_form" id="multiple_upload_form" enctype="multipart/form-data" action="<?php echo base_url().'admin/album/upload';?>">
                            <input type="hidden" name="image_form_submit" value="1"/>
                                <label>Choose Image</label>
                                <input type="file" name="images[]" id="images" multiple >
                            <div class="uploading none">
                                <label>&nbsp;</label>
                                <img src="<?php echo base_url().'asset/img/uploading.gif';?>"/>
                            </div>
                        </form>
                        </div>
                        
                        <div class="gallery" id="images_preview"></div>
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