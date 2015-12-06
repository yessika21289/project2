<?php
	$prefix = "";
	$ypki = true;
	
	if($instansi != "ypki")
	{
		$prefix = $instansi."/";
		$ypki = false;	
	}
?>

<div id="content">
	<div id="content-left">
		
		<div id="baca-berita">
			<div class="judul">
				<?php echo $berita->judul; ?>
			</div>
			<div class="tanggal">
				<?php echo $berita->created; ?>
			</div>
			<?php
				$tipe = $this->ypki->getTipeGambar($berita->gambar);
				if($tipe == "foto")
				{
			?>
				<img src="<?php echo base_url().'asset/berita/'.$berita->gambar; ?>" />
			<?php }else{ ?>
				<img src="<?php echo $berita->gambar; ?>" />
			<?php } ?>
			<div class="konten">
				<?php echo $berita->konten; ?>
			</div>
			<div class="label-berita">
				LABEL:
				<?php
					echo "<a href='".base_url().$prefix."search/label/".$berita->instansi."'><span class='label label-info'>".$berita->instansi."</span></a>";
					foreach ($label as $key => $value)
					{
						echo "<a href='".base_url().$prefix."search/label/".$value->nama."'><span class='label label-info'>".$value->nama."</span></a>";
					}
				?>
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