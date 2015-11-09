<div id="agenda">
	<div class="title">NEXT EVENTS</div>
	
		<?php

			if ( function_exists( 'date_default_timezone_set' ) )
				date_default_timezone_set('Asia/Jakarta');

			$today = date("Y-m-d");

			$agenda = $this->ypki->getNextEvents($today,5,$instansi);

			$prefix = "";
			if($instansi != "ypki") $prefix = $instansi."/";

			if (sizeof($agenda) == 0)
			{
				echo "<span>Belum ada kegiatan untuk agenda yang akan datang.</span>";
			}
			else
			{
				foreach ($agenda as $key => $value) {
					$tahun = substr($value->tanggal, 0,4);
					$bulan = substr($value->tanggal, 5,2);
					$tanggal = substr($value->tanggal, 8,2);

					$d1 = $tahun."/".$bulan."/".$tanggal;
					$d2 = $tanggal."/".$bulan;

					echo "<a href='".base_url().$prefix."agenda/baca/".$d1."/".urlencode($value->nama)."'>";
					echo "<div class='agenda-item'>";
					echo "<div class='row'>";
					echo "<div class='col-xs-2'>";
					echo "<span class='tanggal'>".$d2."</span> ";
					echo "</div>";
					echo "<div class='col-xs-10'>";
					if($instansi == "ypki")
						echo "<span class='label label-".$value->instansi."'>".$value->instansi."</span>";
					echo "<span class='judul'>".strtoupper($value->nama)."</span><br/>";
					echo "</div></div>";
					echo "</div></a>";
				}	
			}

		?>
	

	<div class="all-agenda">
		<a href=" <?php echo base_url().$prefix."agenda"; ?> ">
			<span>lihat semua agenda</span>
		</a>
	</div>
</div>