<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Firman Tuhan
                    <a href="<?php echo base_url()?>admin/firman/baru">
                        <button type="button" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Buat Firman Baru
                        </button>
                    </a>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="<?php echo base_url()?>admin">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file-text"></i> Firman Tuhan
                    </li>
                </ol>
            </div>
            <!-- /.row -->

            <?php

            $submit_confirm = !empty($this->session->flashdata('submit_confirm')) ? $this->session->flashdata('submit_confirm') : '';
            $update_confirm = !empty($this->session->flashdata('update_confirm')) ? $this->session->flashdata('update_confirm') : '';
            $delete_confirm = !empty($this->session->flashdata('delete_confirm')) ? $this->session->flashdata('delete_confirm') : '';
            $new_firman[] = !empty($this->session->flashdata('new_firman')) ? $this->session->flashdata('new_firman') : '';
            $update_firman = !empty($this->session->flashdata('update_firman')) ? $this->session->flashdata('update_firman') : '';

            if (isset($submit_confirm) && ($submit_confirm === 1 || $submit_confirm === 0))
            {
                if ($submit_confirm == 1) {
                    echo '<div class="row">
                        <div class="col-xs-10">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Sukses!</strong> Firman baru berhasil ditambahkan/diubah.
                            </div>
                        </div>
                    </div>';
                }
            }
            elseif (isset($delete_confirm))
            {
                if ($delete_confirm === 1)
                {
                    ?>
                    <div class="row">
                        <div class="col-xs-10">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Sukses!</strong> Firman berhasil dihapus.
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <?php
                }
                else if($delete_confirm === 0)
                {
                ?>
                <div class="col-xs-10">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Gagal!</strong> Terjadi kesalahan. Firman gagal dihapus
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php
            }
        }
        else if (isset($update_confirm)  && ($update_confirm === 1 || $update_confirm === 0))
        {
            if ($update_confirm == 1)
            {
                echo '<div class="row">
                    <div class="col-xs-10">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span
                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <strong>Sukses!</strong> Firman berhasil diubah.
                        </div>
                    </div>
                </div>';

            }
            else if ($update_confirm == 0)
            {
                echo '<div class="col-xs-10">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
                            <strong>Gagal!</strong> Terjadi kesalahan. Firman tidak dapat diubah
                        </div>
                    </div>';
            }
        }
        else if (isset($submit_confirm)) {
            if ($submit_confirm == 1) {
                echo '<div class="row">
                        <div class="col-xs-10">
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span
                                        aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Sukses!</strong> Firman berhasil ditambahkan.
                            </div>
                        </div>
                    </div>';
            } else if ($submit_confirm == 0) {
                echo '<div class="col-xs-10">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span
                                    class="sr-only">Close</span></button>
                            <strong>Gagal!</strong> Terjadi kesalahan. Firman tidak berhasil ditambahkan.
                        </div>
                    </div>';
            }
        }
        ?>

        <?php
        $tahun_cek = array();
        $tahun = array();

        foreach ($firman as $key => $value)
        {
            $y = substr($value->created,0,4);
            if(!isset($tahun_cek[$y]))
            {
                $tahun_cek[$y] = 1;
                array_push($tahun, $y);
            }
        }

        arsort($tahun);
        ?>

        <div class="row admin">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Pilih tahun</label>
                    <select class="firman-select form-control" style="width:100px;">
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
                <div class="list-firman">
                    <?php

                    foreach ($tahun as $key => $value)
                    {
                        $list = $this->ypki->getFirmanByTahun($value, $instansi);

                        if(date('Y') == $value)
                            echo "<ul class='list-group y".$value." vsb'>";
                        else
                            echo "<ul class='list-group y".$value."'>";

                        $m = 12;
                        $found = false;
                        foreach ($list as $k => $v)
                        {
                            $bulan = substr($v->created, 5,2);
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
                                $jumlah = $this->ypki->getJumlahFirmanByBulan($bulan, $instansi);

                                echo "<li class='list-group-item active'><span class='badge'>".$jumlah."</span>".$nama_bulan."</li>";
                                $found = true;
                            }

                            echo "<li class='list-group-item' ";
                            if(!empty($new_firman[0])) {
                                foreach ($new_firman[0] as $id) {
                                    if ($v->id == $id->id) echo "style='background-color: #c8e5bc;'";
                                }
                            }
                            if($v->id == $update_firman) echo "style='background-color: #c8e5bc;'";
                            echo ">";
                            echo "<div class='row'>";
                            echo "<div class='col-xs-2' style='width:105px;'>";
                            echo "<span class='date' id='t".$v->id."' >".substr($v->created,8,2)."/".$bulan."</span>&nbsp;&nbsp;&nbsp;&nbsp;";
                            if ($instansi == "ypki")
                                echo "<span class='label label-default label-".$v->instansi."'>".$v->instansi."</span>";
                            echo "</div>";
                            echo "<div class='col-xs-8'>";
                            echo "<span id='j".$v->id."'>".$v->firman."</span>";
                            echo "</div>";
                            echo "<div class='col-xs-1' style='text-align: center; margin-left:30px;'>";
                            echo "<a href='".base_url()."admin/firman/ubah/".$v->id."' title='ubah'>";
                            echo "<span class='glyphicon glyphicon-pencil'></span></a>";
                            echo "</div>";
                            echo "<div class='col-xs-1' style='text-align: center; margin-left:30px;'>";
                            echo "<span title='hapus' class='glyphicon glyphicon-remove hapus' id='r".$v->id."' data-toggle='modal' data-target='#myModal'></span>";
                            echo "</div>";
                            echo "</div></li>";

                        }
                        echo "</ul>";
                    }
                    ?>
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Hapus</h4>
                                </div>
                                <div class="modal-body">
                                    Anda yakin untuk menghapus firman tanggal <span class="tanggal">TANGGAL FIRMAN</span> ?
                                </div>
                                <div class="modal-footer">
                                    <a class="link_hapus" href=""><button type="button" class="btn btn-primary">Ya</button></a>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-6">
                <h2>10 Firman Terakhir</h2>
                <div class="last-firman">
                    
                    <?php

            /*$firman = $this->ypki->getLastFirman(10, NULL, $instansi);

            echo "<ul class='list-group'>";
            foreach ($firman as $key => $value)
            {
                echo "<li class='list-group-item'>";
                echo "<div class='row'>";
                echo "<div class='col-xs-9'>";
                echo "<span class='date'>".substr($value->created,8,2)."/".substr($value->created,5,2)."</span>";
                if ($instansi == "ypki")
                    echo "  <span class='label label-default label-".$value->instansi."'>".$value->instansi."</span>";
                echo "<span id='j".$value->id."'> ".$value->judul."</span>";
                echo "</div>";
                echo "<div class='col-xs-1'>";
                $link = substr($value->created,0,4)."/".substr($value->created,5,2)."/".substr($value->created,8,2)."/".urlencode($value->judul);
                echo "<a href='".base_url()."firman/baca/".$link."' title='lihat'>";
                echo "<span class='glyphicon glyphicon-eye-open'></span></a>";
                echo "</div>";
                echo "<div class='col-xs-1'>";
                echo "<a href='".base_url()."admin/firman/ubah/".$value->id."' title='ubah'>";
                echo "<span class='glyphicon glyphicon-pencil'></span></a>";
                echo "</div>";
                echo "<div class='col-xs-1'>";
                echo "<span title='hapus' class='glyphicon glyphicon-remove hapus' id='r".$value->id."' data-toggle='modal' data-target='#myModal'></span>";
                echo "</div>";
                echo "</div></li>";
            }
            echo "</ul>";*/

            ?>

                </div>
            </div> -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->



</div>
<!-- /#page-wrapper -->

<input type="hidden" class="page-type" value="firman" />