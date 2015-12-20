<div id="content">
	<div id="content-left">

		<div id="content-visi">
			<?php if($instansi == "ypki") { ?>
			<div id="nav-visi">
				<a href="<?php echo base_url() ?>visi"><span class="visi-m">Visi - Misi</span></a>&nbsp|&nbsp
				<a href="<?php echo base_url() ?>visi/nilai_kristiani"><span class="visi-n">Nilai Kristiani</span></a>&nbsp|&nbsp
				<a href="<?php echo base_url() ?>visi/motto"><span class="visi-t">Motto</span></a>&nbsp|&nbsp
				<a href="<?php echo base_url() ?>visi/arti_logo"><span class="visi-a">Arti Logo</span></a>
			</div>

			<?php } ?>
			<hr>
			<?php if(!empty($visi)): ?>
			<h1 class="title">VISI</h1>
			<p class="desc">
				<?php echo $visi->visi; ?>
			</p>
				<hr>
			<h1 class="title">MISI</h1>
			<p class="desc">
				<?php echo $visi->misi; ?>
			</p>
				<hr>
			<h1 class="title">TUJUAN SEKOLAH</h1>
			<p class="desc">
				<?php echo $visi->tujuan_sekolah; ?>
			</p>
			<?php endif; ?>

			<?php if(!empty($nilai_kristiani)): ?>
				<h1 class="title">NILAI KRISTIANI</h1>
				<p class="desc">
					<?php echo $nilai_kristiani; ?>
				</p>
			<?php endif; ?>

			<?php if(!empty($motto)): ?>
				<h1 class="title">MOTTO</h1>
				<p class="desc">
					<?php echo $motto; ?>
				</p>
			<?php endif; ?>

			<?php if(!empty($arti_logo)): ?>
				<h1 class="title">ARTI LOGO</h1>
				<p class="desc">
					<?php echo $arti_logo; ?>
				</p>
			<?php endif; ?>
		</div>

	</div>
	<div id="content-right">

		<?php $this->load->view("div_login") ?>

		<?php $this->load->view("div_berita") ?>

		<?php $this->load->view("div_agenda") ?>		

	</div>

	<div class="clear"></div>

</div>