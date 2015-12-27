<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Program Penerimaan Peserta Didik Baru - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php
        if(!empty($program)) {
            echo $program->program;
        }
        ?>
    </div>



    <div id="content-right">

        <?php $this->load->view("div_login") ?>

        <?php $this->load->view("div_berita") ?>

        <?php $this->load->view("div_agenda") ?>

    </div>

    <div class="clear"></div>

</div>