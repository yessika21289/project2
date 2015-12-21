<div id="content" xmlns="http://www.w3.org/1999/html">
    <div id="content-left">

        <div class='row' id='judul-daftar'>
            <div class='col-xs-12'>
				<span>
					Info Kontak - <?php echo strtoupper($instansi);?>
				</span>
            </div>
        </div>
        <?php if(!empty($kontak)): ?>
        <span style="font-family: Arial; font-weight: bold; font-size: 15pt; color: #999; border-bottom: 1px groove;">ALAMAT</span><br/>
        <?php echo $kontak->alamat; ?>

        <br/><br/>
        <i class="fa fa-phone"></i> <?php echo $kontak->telepon1.', '.$kontak->telepon2; ?><br/>
        <i class="fa fa-fax"></i> <?php echo $kontak->fax; ?><br/>
        <i class="fa fa-envelope"></i> <?php echo $kontak->email; ?><br/>
        <i class="fa fa-globe"></i> <?php echo $kontak->website; ?><br/>
        <?php endif; ?>
    </div>



    <div id="content-right">

        <?php $this->load->view("div_login") ?>

        <?php $this->load->view("div_berita") ?>

        <?php $this->load->view("div_agenda") ?>

    </div>

    <div class="clear"></div>

</div>