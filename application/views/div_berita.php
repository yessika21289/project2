<div id="berita">
	<div class="title">BERITA <?php echo strtoupper($instansi);?></div>

	<?php
		$berita = $this->ypki->getLastBerita(5, NULL, $instansi);
		$prefix = "";
		if($instansi != "ypki") $prefix = $instansi."/";
		
		foreach ($berita as $key => $value)
		{
			$tahun = substr($value->created, 0,4);
			$bulan = substr($value->created, 5,2);
			$tanggal = substr($value->created, 8,2);

			$d1 = $tahun."/".$bulan."/".$tanggal;
			$d2 = $tanggal."/".$bulan."/".$tahun;

			
			echo "<div class='berita-item'>";
			echo "<a href='".base_url().$prefix."berita/baca/".$d1."/".urlencode($value->judul)."'>";
			echo "<div class='row'>";
			echo "<div class='col-xs-6'>";
			echo "<span class='tanggal'>".$d2."</span> ";
			echo "</div>";
			echo "<div class='col-xs-6 text-right'>";
			echo "<span class='timeago badge badge-info' title='".$value->created."'>".$d2."</span><br/>";
			echo "</div></div>";
			echo "<div class='row row-bawah'>";
			if($instansi == "ypki")
				echo "<span class='label label-".$value->instansi."'>".$value->instansi."</span> ";
			echo "<span class='judul'>".strtoupper($value->judul)."</span><br/>";
			echo "</div>";
			echo "</a>";
			echo "</div>";
		}

	?>

	<div class="all-berita">
		<a href=" <?php echo base_url().$prefix."berita"; ?> ">
			<span>lihat semua berita</span>
		</a>
	</div>
</div>