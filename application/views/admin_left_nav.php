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
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-album"><i class="fa fa-fw fa-image"></i> Album <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="drop-album" class="<?php echo (isset($active_album) || isset($active_album_baru)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/album/baru">Album Baru</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/album">Lihat Semua Album</a>
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
            <li class="<?php echo (isset($active_tentang)) ? 'active' : ''?>">
                <a href="javascript:;" data-toggle="collapse" data-target="#drop-tentang">
                    <i class="fa fa-fw fa-bookmark"></i>
                        Tentang Kami
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="drop-tentang"
                    class="<?php echo (isset($active_tentang)) ? 'collapse in' : 'collapse'?>">
                    <li>
                        <a href="<?php echo base_url()?>admin/tentang_kami/visi_misi">Visi & Misi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/tentang_kami/tujuan_sekolah">Tujuan Sekolah</a>
                    </li>
                    <?php if($instansi == 'ypki'): ?>
                        <li>
                            <a href="<?php echo base_url()?>admin/tentang_kami/nilai_kristiani">Nilai Kristiani</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>admin/tentang_kami/motto">Motto</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>admin/tentang_kami/arti_logo">Arti Logo</a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo base_url()?>admin/tentang_kami/sejarah_singkat">Sejarah Singkat</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()?>admin/tentang_kami/struktur_organisasi">Struktur Organisasi</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url()?>admin/kontak"><i class="fa fa-phone-square"></i> Info Kontak</a>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->