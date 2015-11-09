<div id="content">
	<div id="content-left">

		<div id="content-visi">
			<?php if($instansi == "ypki") { ?>
			<div id="nav-visi">
				<span class="visi-m">Visi - Misi</span>&nbsp|&nbsp
				<span class="visi-n">Nilai Kristiani</span>&nbsp|&nbsp
				<span class="visi-a">Arti Logo</span>
			</div>
			<?php } ?>
			<h1 class="title">VISI</h1>
			<p class="desc">
				<?php echo $visi->visi; ?>
			</p>
			<br/>
			<h1 class="title">MISI</h1>
			<p class="desc">
				<?php echo $visi->misi; ?>
			</p>
		</div>

	</div>
	<div id="content-right">

		<?php $this->load->view("div_login") ?>

		<?php $this->load->view("div_berita") ?>

		<?php $this->load->view("div_agenda") ?>		

	</div>

	<div class="clear"></div>

</div>