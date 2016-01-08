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
                    <li class="active">
                        <i class="fa fa-envelope"></i> Pesan
                    </li>
                </ol>
            </div>
        <!-- /.row -->
            <?php
            /*$submit_confirm = !empty($this->session->flashdata('submit_confirm')) ? $this->session->flashdata('submit_confirm') : '';
            $update_confirm = !empty($this->session->flashdata('update_confirm')) ? $this->session->flashdata('update_confirm') : '';
            $delete_confirm = !empty($this->session->flashdata('delete_confirm')) ? $this->session->flashdata('delete_confirm') : '';
            $new_agenda = !empty($this->session->flashdata('new_agenda')) ? $this->session->flashdata('new_agenda') : '';
            $read_link = !empty($this->session->flashdata('read_link')) ? $this->session->flashdata('read_link') : '';

            if (isset($submit_confirm) && ($submit_confirm === 1 || $submit_confirm === 0))
            {
                if ($submit_confirm == 1)
                {
                    echo '<div class="row">
                        <div class="col-xs-10">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Sukses!</strong> Pesan baru berhasil dikirim.
                            </div>
                        </div>
                    </div>';
                }
            }
            else if (isset($update_confirm)  && ($update_confirm === 1 || $update_confirm === 0))
            {
                if ($update_confirm == 1)
                {
                    echo '<div class="row">
                            <div class="col-xs-10">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <strong>Sukses!</strong> Agenda berhasil diubah. <a href="'.$read_link.'">Lihat agenda</a>
                                </div>
                            </div>
                        </div>';
                }
                else if($update_confirm == 0)
                {
                    echo '<div class="col-xs-10">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Gagal!</strong> Terjadi kesalahan. Agenda tidak dapat diubah
                            </div>
                        </div>
                    </div>';
                }
            }
            elseif (isset($delete_confirm))
            {
                if ($delete_confirm === 1)
                {
                    echo '<div class="row">
                        <div class="col-xs-10">
                            <div class="alert alert-success alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <strong>Sukses!</strong> Agenda berhasil dihapus
                            </div>
                        </div>
                    </div>';
                }
                else if($delete_confirm === 0)
                {
                    echo '<div class="col-xs-10">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                              <strong>Gagal!</strong> Terjadi kesalahan. Agenda gagal dihapus
                            </div>
                        </div>
                    </div>';
                }
            }*/
        ?>

        <?php
            $tahun_cek = array();
            $tahun = array();
            
            foreach ($pesan as $key => $value)
            {
                $y = date('Y',$value->waktu);
                if(!isset($tahun_cek[$y]))
                {
                    $tahun_cek[$y] = 1;
                    array_push($tahun, $y);
                }
            }

            arsort($tahun);
        ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Pilih tahun</label>
                    <select class="berita-select form-control">
                        <?php
                            foreach ($tahun as $key => $value)
                            {
                                if(date('Y') == $value)
                                    echo "<option selected>$value</option>";
                                else
                                    echo "<option>$value</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="list-berita">
                    <?php

                        foreach ($tahun as $key => $value)
                        {
                            $list = $this->ypki->getPesanByTahun($value, $instansi);

                            if(date('Y') == $value)
                                echo "<ul class='list-group y".$value." vsb'>";
                            else
                                echo "<ul class='list-group y".$value."'>";

                            $m = 12;
                            $found = false;
                            foreach ($list as $k => $v)
                            {
                                $bulan = date('n', $v->waktu);
                                while($m!=intval($bulan))
                                {
                                    $m--;
                                    $found = false;
                                    if($m==0) break;
                                }
                                
                                switch ($m) {
                                    case 12:$nama_bulan="Desember";break;
                                    case 11:$nama_bulan="November";break;
                                    case 10:$nama_bulan="Oktober";break;
                                    case 9:$nama_bulan="September";break;
                                    case 8:$nama_bulan="Agustus";break;
                                    case 7:$nama_bulan="Juli";break;
                                    case 6:$nama_bulan="Juni";break;
                                    case 5:$nama_bulan="Mei";break;
                                    case 4:$nama_bulan="April";break;
                                    case 3:$nama_bulan="Maret";break;
                                    case 2:$nama_bulan="Februari";break;
                                    case 1:$nama_bulan="Januari";break;
                                }

                                if(!$found)
                                {
                                    $jumlah = $this->ypki->getJumlahPesanByBulan($bulan, $instansi);

                                    echo "<li class='list-group-item active'><span class='badge'>".$jumlah."</span>".$nama_bulan."</li>";
                                    $found = true;
                                }

                                /*if($v->id == $new_agenda) echo "<li class='list-group-item' style='background-color: #dff0d8;'>";
                                else echo "<li class='list-group-item'>";*/
                                echo "<li class='list-group-item'>";

                                echo "<div class='row'>";
                                echo "<div class='col-xs-9'>";
                                echo "<span class='date'>".date('d',$v->waktu)."/".$bulan."</span>";
                                if ($instansi == "ypki")
                                    echo "  <span class='label label-default label-".$v->instansi."'>".$v->instansi."</span>";
                                echo "<span id='j".$v->id."'> ".$v->nama."</span>";
                                echo "</div>";
                                echo "<div class='col-xs-1'>";
                                echo "<a href='".base_url()."admin/pesan/baca/".$v->id."' title='ubah'>";
                                echo "<span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "</div>";
                                echo "<div class='col-xs-1'>";
                                echo "<span title='hapus' class='glyphicon glyphicon-remove hapus' id='r".$v->id."' data-toggle='modal' data-target='#myModal'></span>";
                                echo "</div>";
                                echo "</div></li>";
                                
                            }
                            echo "</ul>";
                        }
                    ?>
                    <!-- Modal -->
                    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
                          </div>
                          <div class="modal-body">
                            Anda yakin untuk menghapus agenda <span class="judul">JUDUL BERITA</span> ?
                          </div>
                          <div class="modal-footer">
                            <a class="link_hapus" href=""><button type="button" class="btn btn-primary">Ya</button></a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div> -->
                </div>
            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<input type="hidden" class="page-type" value="agenda" />