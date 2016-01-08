<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Pesan
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i>  <a href="<?php echo base_url()?>admin/pesan">Pesan</a>
                    </li>
                    <li class="active">
                        <i class='fa fa-pencil'></i> Pesan
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="row">        
            
            <div class="col-xs-10">
                
                <form id="form-berita-baru" role="form" method="post" action="" enctype="multipart/form-data">

                    <?php
                        $judul = "";
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
                        /*if($gagal === 0) {
                            echo '<div class="col-xs-10">
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <strong>Gagal!</strong> Terjadi kesalahan. Agenda baru gagal ditambahkan/diubah.
                                    </div>
                                </div>';

                            $judul = $post['judul'];
                            $konten = $post['konten'];
                            $tanggal = $post['tanggal'];
                            $ins = $post['instansi'];
                        }*/
                    ?>

                    <div class="form-group">
                        <label>Nama Pengirim</label>:
                        <?php echo $pesan->nama;?><br/>
                        <label>Email</label>:
                        <?php echo $pesan->email;?><br/>
                        <label>Telepon</label>:
                        <?php echo $pesan->telepon;?><br/>
                        <label>Waktu</label>:
                        <?php echo date('D, d M Y, H:i',$pesan->waktu);?><br/>
                        <label>Pesan</label>:<br/>
                        <?php echo nl2br($pesan->message);?>
                    </div>

                    <div class="text-right">
                        <button type="cancel" class="btn btn-default" onclick="window.location.href='/admin/pesan';return false;">Back</button>
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