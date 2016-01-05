<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Personalia - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php if(!empty($personalia)): ?>
        <br/><br/>
        <dl>
        <?php
        foreach ($personalia as $jenis => $deskripsi) {
            if ($deskripsi) {
                switch ($jenis) {
                    case 'pimpinan':
                        $dt = 'STAFF PIMPINAN';
                        break;
                    case 'pengajar':
                        $dt = 'STAFF KEPENDIDIKAN / PENGAJAR';
                        break;
                    case 'tenaga_pendidik':
                        $dt = 'STAFF TENAGA KEPENDIDIKAN';
                        break;
                }
                echo "<dt class='type'>" . $dt . "</dt><br/>";
                echo "<dd>" . $deskripsi . "</dd>";
                echo "<br/>";
            }
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