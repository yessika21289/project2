<div id="content">
	<div id="content-left">

		<div id="content-profil">
			<?php if($profil == 'visi_misi'): ?>
				<h1 class="title">VISI</h1>
				<p class="desc">
					<?php echo $visi->visi; ?>
				</p>
					<hr>
				<h1 class="title">MISI</h1>
				<p class="desc">
					<?php echo $visi->misi; ?>
				</p>
			<?php else: ?>
				<h1 class="title"><?php echo $judul_profil; ?></h1>
				<p class="desc">
					<?php echo ${$profil}; ?>
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