<?php
	$prefix = "";
	$ypki = true;
	$segment = 3;
	if($instansi != "ypki")
	{
		$prefix = $instansi."/";
		$ypki = false;
		$segment++;
	}
?>

<div id="content">
	<div id="content-left">

		<div class='row' id='judul-daftar'>
			<div class='col-xs-12'>
				<span>
					<?php
						if(isset($show_type))
						{
							if($show_type == "label")
							{
								echo "Berita dengan label \"".urldecode($this->uri->segment($segment))."\"";
							}
							else if($show_type == "keyword")
							{
								echo "Berita dengan kunci \"".urldecode($this->uri->segment($segment))."\"";
							}
						}
						else
						{
							if ($ypki)
								echo "Berita YPKI";
							else
								echo "Berita ".strtoupper($instansi);
						}
					?>
				</span>
			</div>
		</div>

		<div id="daftar-berita">

			<?php

				foreach ($berita as $key => $value)
				{
					$tahun = substr($value->created, 0,4);
					$bulan = substr($value->created, 5,2);
					$tanggal = substr($value->created, 8,2);

					$d1 = $tahun."/".$bulan."/".$tanggal;
					
					$hasil = "";

					$datetime = DateTime::createFromFormat('Y/m/d', $d1);
					
					$hari = $datetime->format('D');
					switch ($hari) {
						case 'Mon': $hasil .= "Senin";break;
						case 'Tue': $hasil .= "Selasa";break;
						case 'Wed': $hasil .= "Rabu";break;
						case 'Thu': $hasil .= "Kamis";break;
						case 'Fri': $hasil .= "Jumat";break;
						case 'Sat': $hasil .= "Sabtu";break;
						case 'Sun': $hasil .= "Minggu";break;
						default: break;
					}
					$hasil .= ", ".$datetime->format('d')." ";

					$bulan = $datetime->format('m');
					switch ($bulan) {
						case 1: $hasil .= "Januari";break;
						case 2: $hasil .= "Februari";break;
						case 3: $hasil .= "Maret";break;
						case 4: $hasil .= "April";break;
						case 5: $hasil .= "Mei";break;
						case 6: $hasil .= "Juni";break;
						case 7: $hasil .= "Juli";break;
						case 8: $hasil .= "Agustus";break;
						case 9: $hasil .= "September";break;
						case 10: $hasil .= "Oktober";break;
						case 11: $hasil .= "November";break;
						case 12: $hasil .= "Desember";break;
						default: break;
					}
					$hasil .= " ".$datetime->format('Y');

					$link = base_url().$prefix."berita/baca/".$d1."/".urlencode($value->judul);

					echo "<div class='berita row'>";
					echo "<div class='col-xs-3'>";
					echo "<a href='".$link."'>";

					$tipe = $this->ypki->getTipeGambar($value->gambar);
					if($tipe == "foto")
						echo "<img src='".base_url()."/asset/berita/".$value->gambar."' />";
					else if($tipe == "link")
						echo "<img src='".$value->gambar."' />";
					echo "</a></div>";
					echo "<div class='col-xs-9'>";
					echo "<a href='".$link."'>";

					echo "<span class='judul'>".$value->judul."</span></a><br/>";

					$konten = $value->konten;

					$konten = explode("<br/>", $konten);
					$konten = $konten[0];

					if(strlen($konten) > 500)
					{
						$konten = substr($konten, 0,500);
						$konten .= "...";
					}

					echo "<span class='konten'>".$konten."</span>";
					echo "<div class='row'><div class='col-xs-12 text-right'>";
					if($instansi == "ypki")
						echo "<span class='label label-".$value->instansi."'>".$value->instansi."</span> ";
					echo "<span class='tanggal'>".$hasil."</span></div></div>";
					echo "</div>";
					echo "</div>";
				}

				if (isset($all_berita))
				{
					if (sizeof($all_berita) == 0)
					{
						echo "<div class='not-found'>Tidak ada berita yang cocok.</div>";
					}
				}

			?>

		</div>
		
		<div class="row">
			<div id="pager-berita" class="col-xs-12 text-right">
				
				<?php
					
					$page = 1;
					
					if(isset($show_type))
					{
						$total = sizeof($all_berita);		
						if($show_type == "label")
						{
							$home = $prefix."search/label/".$this->uri->segment($segment);
							$link = $prefix."search/label/".$this->uri->segment($segment)."/";	
							if ($this->uri->segment($segment+1) != "")
							{
								$page = intval($this->uri->segment($segment+1));
							}
						}
						else if($show_type == "keyword")
						{
							$home = $prefix."search/key/".$this->uri->segment($segment);
							$link = $prefix."search/key/".$this->uri->segment($segment)."/";	
							if ($this->uri->segment($segment+1) != "")
							{
								$page = intval($this->uri->segment($segment+1));
							}
						}
					}
					else
					{
						if ($this->uri->segment($segment) != "")
						{
							$page = intval($this->uri->segment($segment));
						}
						$total = $this->ypki->getJumlahBerita($instansi);	
						$home = "berita";
						$link = "berita/page/";
					}
					
					if($total > 0)
					{
						$start = 1+(($page-1)*$limit);
						echo "<div class='status'>memperlihatkan berita ".$start."-".($start+sizeof($berita)-1)." dari ".$total." berita</div>";
						echo "<ul class='pagination'>";

						$page_count = ceil($total/$limit);
						//$page_count = 60;

						if ($page == 1)
							echo "<li class='disabled'><span><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Next</span></span></li>";
						else
							echo "<li><a href='".base_url().$prefix.$link.($page-1)."'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";

						$preGap = false;
						$posGap = false;

						for ($i=1; $i <= $page_count ; $i++)
						{
							if($i == 1 || $i == $page_count) 
							{
								if ($i == $page)
									echo "<li class='active'><span>".$i."</span></li>";
								else
								{
									if($i == 1)
										echo "<li><a href='".base_url().$prefix.$home."'>".$i."</a></li>";	
									else
										echo "<li><a href='".base_url().$prefix.$link.$i."'>".$i."</a></li>";	
								}
									
							}
							else if($i >= $page-2 && $i <= $page+2)
							{
								if ($i == $page)
									echo "<li class='active'><span>".$i."</span></li>";
								else
									echo "<li><a href='".base_url().$prefix.$link.$i."'>".$i."</a></li>";
							}
							else
							{
								if($i <= $page-2 && $page >= 5 && !$preGap)
								{
									echo "<span class='gap'> ... </span>";
									$preGap = true;
								}
								else if($i >= $page+2 && $page <= $page_count-4 && !$posGap)
								{
									echo "<span class='gap'> ... </span>";
									$posGap = true;
								}	
							}
							
						}
						
						if ($page == $page_count || $page_count == 1 )
							echo "<li class='disabled'><span><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></span></li>";
						else
							echo "<li><a href='".base_url().$prefix.$link.($page+1)."'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span></a></li>";

						echo "</ul>";
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