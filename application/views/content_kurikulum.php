<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Kurikulum - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php if(!empty($kurikulum)): ?>
        <br/><br/>
        <dl>
        <?php
        foreach ($kurikulum as $jenis => $deskripsi) {
            switch ($jenis) {
                case 'pelajaran':
                    $dt = 'JADWAL PELAJARAN';
                    break;
                case 'intrakurikuler':
                    $dt = 'INTRAKURIKULER / CLASSROOM LEARNING';
                    break;
                case 'ekstrakurikuler':
                    $dt = 'EKSTRAKURIKULER dan PENGEMBANGAN DIRI';
                    break;
                case 'asrama':
                    $dt = 'PROGRAM DAN KEGIATAN ASRAMA';
                    break;
            }
            echo "<dt class='type'>".$dt."</dt><br/>";
            echo "<dd>".$deskripsi."</dd>";
            echo "<br/>";
        }
        ?>
        </dl>
        <?php endif; ?>
    </div>



    <div id="content-right">

        <?php $this->load->view("div_login") ?>

        <?php $this->load->view("div_berita") ?>

        <?php $this->load->view("div_agenda") ?>

    </div>

    <div class="clear"></div>

</div>