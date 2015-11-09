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
					Agenda YPKI
				</span>
			</div>
		</div>

		<div class="nav-agenda">

			<?php if ($condition != "prev"){ ?>
			<a href=" <?php echo base_url().$prefix."agenda/prev/" ?> "><< Agenda Lama</a> | 
			<?php } else { ?>
				<< Agenda Lama | 
			<?php } ?>

			<?php if ($condition != "now"){ ?>
				<a href=" <?php echo base_url().$prefix."agenda/" ?> ">Agenda Bulan ini</a> | 
			<?php } else { ?>
				Agenda Bulan ini | 
			<?php } ?>

			<?php if ($condition != "next"){ ?>
			<a href=" <?php echo base_url().$prefix."agenda/next/" ?> ">Agenda yang Akan Datang >></a>
			<?php } else { ?>
				Agenda yang Akan Datang >>
			<?php } ?>

		</div>

		<?php if(sizeof($berita) > 0) { ?>

		<div id="daftar-agenda">

			<?php

				foreach ($berita as $key => $value)
				{
					$tahun = substr($value->tanggal, 0,4);
					$bulan = substr($value->tanggal, 5,2);
					$tanggal = substr($value->tanggal, 8,2);

					$d1 = $tahun."/".$bulan."/".$tanggal;
					$d2 = $tanggal."/".$bulan."/".$tahun;
					
					$link = base_url().$prefix."agenda/baca/".$d1."/".urlencode($value->nama);

					
					echo "<div class='berita row'>";
					echo "<a href='".$link."'>";
					echo "<div class='col-xs-2'>";
					echo "<span class='tanggal'>".$d2."</span>";
					echo "</div>";
					echo "<div class='col-xs-10'>";
					if($instansi == "ypki")
						echo "<span class='label label-".$value->instansi."'>".$value->instansi."</span> ";
					echo "<span class='nama'>".$value->nama."</span>";
					echo "</div>";
					echo "</a></div>";
				}

			?>

		</div>
		
		<div class="row">
			<div id="pager-berita" class="col-xs-12 text-right">
				
				<?php
					
					$page = 1;
					
					if ($condition == "now" && $this->uri->segment($segment) != "")
					{
						$page = intval($this->uri->segment($segment));
					}
					else if ($condition == "prev" && $this->uri->segment($segment+1) != "")
					{
						$page = intval($this->uri->segment($segment+1));
					}
					else if ($condition == "next" && $this->uri->segment($segment+1) != "")
					{
						$page = intval($this->uri->segment($segment+1));
					}
					$total = $this->ypki->getJumlahAgendaNow($today, $instansi);	
					$home = "agenda";
					
					if($condition=="now")
						$link = "agenda/page/";
					else if($condition=="prev")
						$link = "agenda/prev/page/";
					else if($condition=="next")
						$link = "agenda/next/page/";
					
					if($total > 0)
					{
						
						$start = 1+(($page-1)*$limit);
						echo "<div class='status'>memperlihatkan agenda ".$start."-".($start+sizeof($berita)-1)." dari ".$total." agenda</div>";
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

		<?php }else{ ?>

			<span>Belum ada kegiatan yang tercatat</span>

		<?php } ?>
		
	</div>

	<div id="content-right">

		<?php $this->load->view("div_login") ?>

		<?php $this->load->view("div_berita") ?>

		<?php $this->load->view("div_agenda") ?>		

	</div>

	<div class="clear"></div>

</div>