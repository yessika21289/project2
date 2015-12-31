<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Info Kontak - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php if(!empty($kontak)):

            if(!empty($kontak->telepon1) && !empty($kontak->telepon2))
                $telepon = $kontak->telepon1.', '.$kontak->telepon2;
            else
                $telepon = !empty($kontak->telepon1) ? $kontak->telepon1 : $kontak->telepon2;

            if(!empty($kontak->alamat))
                echo '<span style="font-family: Arial; font-weight: bold; font-size: 15pt; color: #999; border-bottom: 1px groove;">ALAMAT</span>
                        <br/>'.$kontak->alamat.'<br/><br/>';
            if(!empty($telepon))
                echo '<i class="fa fa-phone"></i>' .$telepon. '<br/>';
            if(!empty($kontak->fax))
                echo '<i class="fa fa-fax"></i>' .$kontak->fax. '<br/>';
            if(!empty($kontak->email))
                echo '<i class="fa fa-envelope"></i>' .$kontak->email. '<br/>';
            if(!empty($kontak->website))
                echo '<i class="fa fa-globe"></i><a href="http://'.$kontak->website.'">' .$kontak->website. '</a><br/>';
        endif; ?>
    </div>



    <div id="content-right">

        <?php $this->load->view("div_login") ?>

        <?php $this->load->view("div_berita") ?>

        <?php $this->load->view("div_agenda") ?>

    </div>

    <div class="clear"></div>

</div>