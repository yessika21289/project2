<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Fasilitas - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php if(!empty($fasilitas)): ?>
        <br/><br/>
        <dl>
        <?php
        foreach ($fasilitas as $jenis => $deskripsi) {
            switch ($jenis) {
                case 'olahraga':
                    $dt = 'FASILITAS OLAHRAGA';
                    break;
                case 'komputer':
                    $dt = 'LAB KOMPUTER';
                    break;
                case 'multimedia':
                    $dt = 'RUANG MULTIMEDIA';
                    break;
                case 'aula':
                    $dt = 'RUANG AULA / PERTEMUAN';
                    break;
                default:
                    $dt = strtoupper(str_replace("_", " ", $jenis));
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