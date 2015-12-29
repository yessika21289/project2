<div id="navigator">
	<div id="top-navigator">
		
		<div id="logo">
			<a href="<?php echo base_url(); ?>">
				<img src="<?php echo base_url().'asset/img/logo.png'; ?>" alt="logo" title="yayasan perguruan kristen indonesia" />
			</a>
		</div>

		<div id="title">
			<a href="<?php echo base_url(); ?>">
				YAYASAN PERGURUAN KRISTEN INDONESIA
				<div class="sub">MAGELANG</div>
			</a>
		</div>

		<div id="search">
			<?php if ($instansi == "ypki"){ ?>
				<form class="form-inline" action="<?php echo base_url()?>search/key" role="form" method="post">	
			<?php }else{ ?>
				<form class="form-inline" action="<?php echo base_url().$instansi.'/search/key'; ?>" role="form" method="post">	
			<?php } ?>
				<div class="form-group">
				    <div class="input-group">
				    	<label class="sr-only" for="searchKeyword">Keyword</label>
				    	<input type="text" class="form-control" id="searchKeyword" name="key" placeholder="Cari">
				    	<div id="btn-search" class="input-group-addon btn btn-success">
				    		<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				    	</div>
				    </div>
				</div>
			</form>
		</div>

		<div class="clear"></div>
	</div>

	<div id="navigator-bar">

		<?php
			$this->load->model("ypki");
			$instansi_program = $this->ypki->getAllProgram();
		?>
		<div class="dropdown">
			<button class="dropdown-toggle" id="drop-ypki" data-hover="dropdown">
					<span>YPKI<br/>MAGELANG</span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="drop-ypki">
				<li class="dropdown-header" role="presentation">Profil</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/visi_misi'; ?> ">Visi & Misi</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/tujuan_sekolah'; ?> ">Tujuan Sekolah</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/nilai_kristiani'; ?> ">Nilai Kristiani</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/motto'; ?> ">Motto</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/arti_logo'; ?> ">Arti Logo</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/sejarah_singkat'; ?> ">Sejarah Singkat</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'profil/struktur_organisasi'; ?> ">Struktur Organisasi</a>
					</li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'berita'; ?> ">Berita</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'agenda'; ?> ">Agenda Kegiatan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'personalia'; ?> ">Personalia</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'dokumentasi'; ?> ">Dokumentasi</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kontak'; ?> ">Hubungi Kami</a></li>
			</ul>
		</div>	

		<div class="dropdown">
			<button class="dropdown-toggle" id="drop-kbtk" data-hover="dropdown">
				<span>KB & TK<br/>TUNAS KASIH</span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="drop-kbtk">
				<?php if(isset($instansi_program['kbtk']) && $instansi_program['kbtk'] == 1): ?>
					<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/program'; ?> ">
							Penerimaan <br/> Peserta Didik Baru</a>
					</li>
				<?php endif; ?>
				<li class="dropdown-header" role="presentation">Profil</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/profil/visi_misi'; ?> ">Visi & Misi</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/profil/tujuan_sekolah'; ?> ">Tujuan Sekolah</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/profil/sejarah_singkat'; ?> ">Sejarah Singkat</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/profil/struktur_organisasi'; ?> ">Struktur Organisasi</a>
					</li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/berita'; ?> ">Berita</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/agenda'; ?> ">Agenda Kegiatan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/fasilitas'; ?> ">Fasilitas</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/kurikulum'; ?> ">Kurikulum</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/personalia'; ?> ">Personalia</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/kesiswaan'; ?> ">Kesiswaan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/dokumentasi'; ?> ">Dokumentasi</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'kbtk/kontak'; ?> ">Hubungi Kami</a></li>
			</ul>
		</div>	

		<div class="dropdown">
			<button class="dropdown-toggle" id="drop-sdki" data-hover="dropdown">
				<span>SDKI<br/>&nbsp</span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="drop-sdki">
				<?php if(isset($instansi_program['sdki']) && $instansi_program['sdki'] == 1): ?>
					<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/program'; ?> ">
							Penerimaan <br/> Peserta Didik Baru</a>
					</li>
				<?php endif; ?>
				<li class="dropdown-header" role="presentation">Profil</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/profil/visi_misi'; ?> ">Visi & Misi</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/profil/tujuan_sekolah'; ?> ">Tujuan Sekolah</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/profil/sejarah_singkat'; ?> ">Sejarah Singkat</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/profil/struktur_organisasi'; ?> ">Struktur Organisasi</a>
					</li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/berita'; ?> ">Berita</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/agenda'; ?> ">Agenda Kegiatan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/fasilitas'; ?> ">Fasilitas</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/kurikulum'; ?> ">Kurikulum</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/personalia'; ?> ">Personalia</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/kesiswaan'; ?> ">Kesiswaan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/dokumentasi'; ?> ">Dokumentasi</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'sdki/kontak'; ?> ">Hubungi Kami</a></li>
			</ul>
		</div>	

		<div class="dropdown">
			<button class="dropdown-toggle" id="drop-smpki" data-hover="dropdown">
				<span>SMPKI<br/>&nbsp</span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="drop-smpki">
				<?php if(isset($instansi_program['smpki']) && $instansi_program['smpki'] == 1): ?>
					<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/program'; ?> ">
							Penerimaan <br/> Peserta Didik Baru</a>
					</li>
				<?php endif; ?>
				<li class="dropdown-header" role="presentation">Profil</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/profil/visi_misi'; ?> ">Visi & Misi</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/profil/tujuan_sekolah'; ?> ">Tujuan Sekolah</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/profil/sejarah_singkat'; ?> ">Sejarah Singkat</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/profil/struktur_organisasi'; ?> ">Struktur Organisasi</a>
					</li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/berita'; ?> ">Berita</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/agenda'; ?> ">Agenda Kegiatan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/fasilitas'; ?> ">Fasilitas</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/kurikulum'; ?> ">Kurikulum</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/personalia'; ?> ">Personalia</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/kesiswaan'; ?> ">Kesiswaan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/dokumentasi'; ?> ">Dokumentasi</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smpki/kontak'; ?> ">Hubungi Kami</a></li>
			</ul>
		</div>	

		<div class="dropdown">
			<button class="dropdown-toggle" id="drop-smaki" data-hover="dropdown">
				<span>SMAKI<br/>BERASRAMA</span>
			</button>
			<ul class="dropdown-menu" role="menu" aria-labelledby="drop-smaki">
				<?php if(isset($instansi_program['smaki']) && $instansi_program['smaki'] == 1): ?>
					<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/program'; ?> ">
							Penerimaan <br/> Peserta Didik Baru</a>
					</li>
				<?php endif; ?>
				<li class="dropdown-header" role="presentation">Profil</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/profil/visi_misi'; ?> ">Visi & Misi</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/profil/tujuan_sekolah'; ?> ">Tujuan Sekolah</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/profil/sejarah_singkat'; ?> ">Sejarah Singkat</a>
					</li>
					<li class="dropdown-profil" role="presentation">
						<a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/profil/struktur_organisasi'; ?> ">Struktur Organisasi</a>
					</li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/berita'; ?> ">Berita</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/agenda'; ?> ">Agenda Kegiatan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/fasilitas'; ?> ">Fasilitas</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/kurikulum'; ?> ">Kurikulum</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/personalia'; ?> ">Personalia</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/kesiswaan'; ?> ">Kesiswaan</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/dokumentasi'; ?> ">Dokumentasi</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href=" <?php echo base_url().'smaki/kontak'; ?> ">Hubungi Kami</a></li>
			</ul>
		</div>		

	</div>
</div>