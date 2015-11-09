<div id="content">
	<div id="content-left">
		
		<div id="baca-berita">
			<div class="judul">
				<?php echo $berita->judul; ?>
			</div>
			<div class="tanggal">
				<?php echo $berita->created; ?>
			</div>
			
			<div class="konten">
				<?php echo $berita->konten; ?>
			</div>
			
		</div>

	</div>
	<div id="content-right">

		<?php $this->load->view("div_login") ?>

		<?php $this->load->view("div_berita") ?>

		<?php $this->load->view("div_agenda") ?>		

	</div>

	<div class="clear"></div>

</div>