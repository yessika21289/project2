    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="<?php echo base_url()?>admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="<?php echo (isset($active_berita) || isset($active_berita_baru)) ? 'active' : ''?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-berita"><i class="fa fa-fw fa-file-text"></i> Berita <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-berita" class="<?php echo (isset($active_berita) || isset($active_berita_baru)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/berita/baru">Berita Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/berita">Lihat Semua Berita</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo (isset($active_agenda) || isset($active_agenda_baru)) ? 'active' : ''?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-agenda"><i class="fa fa-fw fa-calendar"></i> Agenda <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-agenda" class="<?php echo (isset($active_agenda) || isset($active_agenda_baru)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/agenda/baru">Agenda Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/agenda">Lihat Semua Agenda</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-album"><i class="fa fa-fw fa-image"></i> Dokumentasi <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-album" class="<?php echo (isset($active_album) || isset($active_album_baru)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/album/baru">Dokumentasi Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/album">Lihat Semua Dokumentasi</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo (isset($active_firman) || isset($active_firman_baru)) ? 'active' : ''?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-firman"><i class="fa fa-fw fa-calendar"></i> Firman Tuhan <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-firman" class="<?php echo (isset($active_firman) || isset($active_firman_baru)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/firman/baru">Firman Tuhan Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/firman">Lihat Semua Firman Tuhan</a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo (isset($active_profil)) ? 'active' : ''?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-tentang">
                    <i class="fa fa-fw fa-bookmark"></i>
                        Profil
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="drop-tentang"
                    class="<?php echo (isset($active_profil)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/profil/visi_misi">Visi & Misi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/profil/tujuan_sekolah">Tujuan Sekolah</a>
                    </li>
                    <?php if($instansi == 'ypki'): ?>
                        <li>
                            <a href="<?php echo base_url()?>admin/profil/nilai_kristiani">Nilai Kristiani</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>admin/profil/motto">Motto</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>admin/profil/arti_logo">Arti Logo</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo base_url()?>admin/profil/sejarah_singkat">Sejarah Singkat</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/profil/struktur_organisasi">Struktur Organisasi</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/kontak"><i class="fa fa-phone-square"></i> Info Kontak</a>
            </li>
            <?php if($instansi != "ypki"){?>
            <li>
                <a href="<?php echo base_url()?>admin/fasilitas"><i class="fa fa-keyboard-o"></i> Fasilitas</a>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/kurikulum"><i class="fa fa-bars"></i> Kurikulum</a>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/kesiswaan"><i class="fa fa-user"></i> Kesiswaan</a>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/program"><i class="fa fa-book"></i> Penerimaan Peserta Didik Baru</a>
            </li>
            <?php }?>
            <li>
                <a href="<?php echo base_url()?>admin/personalia"><i class="fa fa-users"></i> Personalia</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->