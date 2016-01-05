<?php

function utf8_urldecode($str)
{
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
}

function getTanggal($created, $task = "berita")
{
	$hasil = "";

	$tanggal = "";
	$tanggal .= substr($created, 0,4);
	$tanggal .= substr($created, 5,2);
	$tanggal .= substr($created, 8,2);
	if($task == "berita")
	{
		$tanggal .= substr($created, 11,2);
		$tanggal .= substr($created, 14,2);	
	}

	if($task == "berita") $datetime = DateTime::createFromFormat('YmdHi', $tanggal);
	else if($task == "agenda") $datetime = DateTime::createFromFormat('Ymd', $tanggal);
	
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

	if($task == "berita") $hasil .= " ".$datetime->format('Y')." ".$datetime->format('H:i')." WIB";
	else if($task == "agenda") $hasil .= " ".$datetime->format('Y');

	return $hasil;
}

function parse($konten)
{
	// BBcode array
	$find = array(
	'~\[b\](.*?)\[/b\]~s',
	'~\[i\](.*?)\[/i\]~s',
	'~\[u\](.*?)\[/u\]~s',
	'~\[s\](.*?)\[/s\]~s',
	'~\[sup\](.*?)\[/sup\]~s',
	'~\[sub\](.*?)\[/sub\]~s',
	'~\[color=(.*?)\](.*?)\[/color\]~s',
	'~\[quote\](.*?)\[/quote\]~s',
	'~\[url=((?:ftp|https?)://.*?)\](.*?)\[/url\]~s',
	'~\[list\](.*?)\[/list\]~s',
	'~\[list=1\](.*?)\[/list\]~s',
	'~\[\*\](.*?)\[/\*\]~s'
	);

	// HTML tags to replace BBcode
	$replace = array(
	'<b>$1</b>',
	'<i>$1</i>',
	'<span style="text-decoration:underline;">$1</span>',
	'<span style="text-decoration:line-through;">$1</span>',
	'<sup>$1</sup>',
	'<sub>$1</sub>',
	'<span style="color:$1;">$2</span>',
	'<blockquote>$1</blockquote>',
	'<a href="$1">$2</a>',
	'<ul>$1</ul>',
	'<ol>$1</ol>',
	'<li>$1</li>'
	);

	// Replacing the BBcodes with corresponding HTML tags
	$konten = preg_replace($find,$replace,$konten);
	$konten = str_replace(chr(10), "<br/>", $konten);
	return $konten;
}

class Smaki extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if (isset($_POST['key']))
        {
        	redirect(base_url()."smaki/search/key/".$_POST['key']);
        }
   	}

	public function index()
	{
		$this->load->model("ypki");
		
		$today = date('Y-m-d');
		$data['firman'] = $this->ypki->getFirmanToday($today);
		$data['html_title'] = "SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_home");
		$this->load->view("footer");
	}

	public function profil($task)
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['instansi'] = "smaki";

		$profil = $this->ypki->getProfil($task, $data['instansi']);

		if($task == 'visi_misi') {
			$data['html_title'] = "Visi Misi - SMA Kristen Indonesia";
			$data['profil'] = 'visi_misi';
			$visi = $profil[0];
			$visi->visi = parse($visi->visi);
			$visi->misi = parse($visi->misi);
			$data['visi'] = $visi;
		}
		if($task == 'tujuan_sekolah') {
			$data['html_title'] = "Tujuan Sekolah - SMA Kristen Indonesia";
			$data['judul_profil'] = 'Tujuan Sekolah';
		}
		if($task == 'sejarah_singkat') {
			$data['html_title'] = "Sejarah Singkat - SMA Kristen Indonesia";
			$data['judul_profil'] = 'Sejarah Singkat';
		}
		if($task == 'struktur_organisasi') {
			$data['html_title'] = "Struktur Organisasi - SMA Kristen Indonesia";
			$data['judul_profil'] = 'Struktur Organisasi';
		}

		if($task != 'visi_misi') {
			$profil = parse($profil[0]->$task);
			$data['profil'] = $task;
			$data[$task] = $profil;
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function berita($cmd = NULL, $page = NULL, $bulan = NULL, $tanggal = NULL, $judul = NULL)
	{
		if($cmd == NULL )
    	{
    		$data = $this->session->all_userdata();
			$this->load->model('ypki');
			
			$data['instansi'] = "smaki";
			$data['limit'] = 8;

			if($page == NULL || $page == "index")
				$data['berita'] = $this->ypki->getLastBerita($data['limit'], NULL, $data['instansi']);
			else
				$data['berita'] = $this->ypki->getLastBerita($data['limit'], $page, $data['instansi']);

			foreach ($data['berita'] as $key => $value)
			{
				$value->konten = parse($value->konten);
			}

			$data['html_title'] = "Berita - SMA Kristen Indonesia";

			$this->load->view("header", $data);
			$this->load->view("navigator");
			$this->load->view("content_berita");
			$this->load->view("footer");
    	}
    	else if($cmd == "page")
    	{
    		$this->berita(NULL, $page);
    	}
    	else if($cmd == "baca")
    	{
    		$data = $this->session->all_userdata();
			$this->load->model('ypki');
			
			$data['instansi'] = "smaki";
			
			$date=$page."/".$bulan."/".$tanggal;
			$judul=utf8_urldecode($judul);

			$berita = $this->ypki->getBerita($date,$judul);
			
			if (empty($berita))
			{
				show_404();
			}
			else
			{
				$data['berita'] = $berita[0];
				$data['berita']->konten = parse($data['berita']->konten);
				//$data['berita']->konten = nl2br($data['berita']->konten);
				$data['berita']->created = getTanggal($data['berita']->created);
				$data['label'] = $this->ypki->getLabel($berita[0]->id);

				$data['html_title'] = $data['berita']->judul." - SMA Kristen Indonesia";
				
				$this->load->view("header", $data);
				$this->load->view("navigator");
				$this->load->view("content_baca_berita");
				$this->load->view("footer");
			}
    	}
    	else
    	{
    		show_404();
    	}
	}	

	public function agenda($cmd = NULL, $prefix = NULL, $page = NULL, $tanggal = NULL, $judul = NULL)
	{
		if($cmd == NULL )
    	{
    		$data = $this->session->all_userdata();
			$this->load->model('ypki');
			
			$data['instansi'] = "smaki";

			$data['html_title'] = "Agenda - SMA Kristen Indonesia";
			$data['condition'] = "now";
			$data['limit'] = 8;

			$data['today'] = date("Y-m");

			if($page == NULL || $page == "index")
				$data['berita'] = $this->ypki->getAgendaNow($data['today'], $data['limit'], NULL, $data['instansi']);
			else
				$data['berita'] = $this->ypki->getAgendaNow($data['today'], $data['limit'], $page, $data['instansi']);

			foreach ($data['berita'] as $key => $value)
			{
				$value->deskripsi = parse($value->deskripsi);
			}

			$this->load->view("header", $data);
			$this->load->view("navigator");
			$this->load->view("content_agenda");
			$this->load->view("footer");
    	}
    	else if($cmd == "page")
    	{
    		$this->agenda(NULL, $page);
    	}
    	else if($cmd == "prev")
    	{
    		if($prefix == "page" || $prefix == NULL)
			{
				$data = $this->session->all_userdata();
				$this->load->model('ypki');
				
				$data['instansi'] = "smaki";

				$data['html_title'] = "Agenda - SMA Kristen Indonesia";
				$data['condition'] = "prev";
				$data['limit'] = 8;

				$data['today'] = date("Y-m");

				if($page == NULL || $page == "index")
					$data['berita'] = $this->ypki->getAgendaPrev($data['today'], $data['limit'], NULL, $data['instansi']);
				else
					$data['berita'] = $this->ypki->getAgendaPrev($data['today'], $data['limit'], $page, $data['instansi']);

				foreach ($data['berita'] as $key => $value)
				{
					$value->deskripsi = parse($value->deskripsi);
				}

				$this->load->view("header", $data);
				$this->load->view("navigator");
				$this->load->view("content_agenda");
				$this->load->view("footer");	
			}
			else
			{
				show_404();
			}
		}
		else if($cmd == "next")
    	{
    		if($prefix == "page" || $prefix == NULL)
			{
				$data = $this->session->all_userdata();
				$this->load->model('ypki');
				
				$data['instansi'] = "smaki";

				$data['html_title'] = "Agenda - SMA Kristen Indonesia";
				$data['condition'] = "next";
				$data['limit'] = 8;

				$data['today'] = date("Y-m");

				if($page == NULL || $page == "index")
					$data['berita'] = $this->ypki->getAgendaNext($data['today'], $data['limit'], NULL, $data['instansi']);
				else
					$data['berita'] = $this->ypki->getAgendaNext($data['today'], $data['limit'], $page, $data['instansi']);

				foreach ($data['berita'] as $key => $value)
				{
					$value->deskripsi = parse($value->deskripsi);
				}

				$this->load->view("header", $data);
				$this->load->view("navigator");
				$this->load->view("content_agenda");
				$this->load->view("footer");	
			}
			else
			{
				show_404();
			}
		}
		else if($cmd == "baca")
		{
			$data = $this->session->all_userdata();
			$this->load->model('ypki');
			$data['instansi'] = "smaki";
			
			$date=$prefix."+".$page."+".$tanggal;
			$judul=utf8_urldecode($judul);

			$berita = $this->ypki->getAgenda($date,$judul);

			if (empty($berita))
			{
				show_404();
			}
			else
			{
				$data['berita'] = $berita[0];
				$data['berita']->judul = $judul;
				$data['berita']->konten = parse($data['berita']->deskripsi);
				//$data['berita']->konten = nl2br($data['berita']->konten);
				$data['berita']->created = getTanggal($data['berita']->tanggal, "agenda");
				
				$data['html_title'] = $data['berita']->nama." - SMA Kristen Indonesia";
				
				$this->load->view("header", $data);
				$this->load->view("navigator");
				$this->load->view("content_baca_agenda");
				$this->load->view("footer");
			}
		}
    	else
    	{
    		show_404();
    	}
	}	

	public function dokumentasi($directory = "")
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		if($directory == "")
			$data['list_dokumentasi'] = $this->ypki->getAllAlbum("smaki");
		else{
			$data['directory'] = $directory;
			$data['judul'] = $this->ypki->getJudulAlbumByDirectory($directory,"smaki");
		}

		$data['html_title'] = "Dokumentasi - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_dokumentasi");
		$this->load->view("footer");
		
	}
	
	public function kontak()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Kontak - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$kontak = $this->ypki->getKontak($data['instansi']);
		if(!empty($kontak)) {
			$kontak = $kontak[0];
			$kontak->alamat = parse($kontak->alamat);
			$data['kontak'] = $kontak;
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_kontak");
		$this->load->view("footer");
	}

	public function fasilitas()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Fasilitas - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$fasilitas = $this->ypki->getFasilitas($data['instansi']);
		if(!empty($fasilitas)) {
            foreach ($fasilitas as $key => $deskripsi) {
                $fas[$fasilitas[$key]->jenis] = $fasilitas[$key]->deskripsi;
				$aktif[$fasilitas[$key]->jenis] = $fasilitas[$key]->aktif;
            }

            $data['fasilitas']['sekolah'] = (isset($fas['sekolah']) && $aktif['sekolah']) ? trim($fas['sekolah']) : '';
            $data['fasilitas']['ruang_belajar'] = (isset($fas['ruang_belajar']) && $aktif['ruang_belajar']) ? trim($fas['ruang_belajar']) : '';
            $data['fasilitas']['laboratorium'] = (isset($fas['laboratorium']) && $aktif['laboratorium']) ? trim($fas['laboratorium']) : '';
            $data['fasilitas']['perpustakaan'] = (isset($fas['perpustakaan']) && $aktif['perpustakaan']) ? trim($fas['perpustakaan']) : '';
            $data['fasilitas']['olahraga'] = (isset($fas['olahraga']) && $aktif['olahraga']) ? trim($fas['olahraga']) : '';
            $data['fasilitas']['komputer'] = (isset($fas['komputer']) && $aktif['komputer']) ? trim($fas['komputer']) : '';
            $data['fasilitas']['fasilitas_lain'] = (isset($fas['fasilitas_lain']) && $aktif['fasilitas_lain']) ? trim($fas['fasilitas_lain']) : '';
            $data['fasilitas']['multimedia'] = (isset($fas['multimedia']) && $aktif['multimedia']) ? trim($fas['multimedia']) : '';
            $data['fasilitas']['aula'] = (isset($fas['aula']) && $aktif['aula']) ? trim($fas['aula']) : '';
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_fasilitas");
		$this->load->view("footer");
	}

	public function kurikulum()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Kurikulum - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$kurikulum = $this->ypki->getKurikulum($data['instansi']);
		
		if(!empty($kurikulum)) {
            foreach ($kurikulum as $key => $deskripsi) {
                $kur[$kurikulum[$key]->jenis] = $kurikulum[$key]->deskripsi;
				$aktif[$kurikulum[$key]->jenis] = $kurikulum[$key]->aktif;
            }

			$data['kurikulum']['pelajaran'] = (isset($kur['pelajaran']) && $aktif['pelajaran'] == 1) ? trim($kur['pelajaran']) : '';
            $data['kurikulum']['intrakurikuler'] = (isset($kur['intrakurikuler']) && $aktif['intrakurikuler'] == 1) ?
				trim($kur['intrakurikuler']) : '';
            $data['kurikulum']['ekstrakurikuler'] = (isset($kur['ekstrakurikuler']) && $aktif['ekstrakurikuler'] == 1) ?
				trim($kur['ekstrakurikuler']) : '';
            $data['kurikulum']['asrama'] = (isset($kur['asrama']) && $aktif['asrama'] == 1) ? trim($kur['asrama']) : '';
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_kurikulum");
		$this->load->view("footer");
	}

	public function personalia()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Personalia - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$personalia = $this->ypki->getPersonalia($data['instansi']);
		
		if(!empty($personalia)) {
            foreach ($personalia as $key => $deskripsi) {
                $person[$personalia[$key]->jenis] = $personalia[$key]->deskripsi;
				$aktif[$personalia[$key]->jenis] = $personalia[$key]->aktif;
			}
			$data['personalia']['pimpinan'] = (isset($person['pimpinan']) && $aktif['pimpinan'] == 1) ? trim($person['pimpinan']) : '';
			$data['personalia']['pengajar'] = (isset($person['pengajar']) && $aktif['pengajar'] == 1) ? trim($person['pengajar']) : '';
			$data['personalia']['tenaga_pendidik'] = (isset($person['tenaga_pendidik']) && $aktif['tenaga_pendidik'] == 1) ? trim($person['tenaga_pendidik']) : '';
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_personalia");
		$this->load->view("footer");
	}

	public function kesiswaan()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Kesiswaan - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$kesiswaan = $this->ypki->getKesiswaan($data['instansi']);
		
		if(!empty($kesiswaan)) {
            foreach ($kesiswaan as $key => $deskripsi) {
                $siswa[$kesiswaan[$key]->jenis] = $kesiswaan[$key]->deskripsi;
				$siswa[$kesiswaan[$key]->jenis] = $kesiswaan[$key]->aktif;
            }
            $data['kesiswaan']['administrasi'] = (isset($siswa['administrasi']) && $aktif['administrasi'] == 1) ? trim($siswa['administrasi']) : '';
            $data['kesiswaan']['osis'] = (isset($siswa['osis']) && $aktif['osis'] == 1) ? trim($siswa['osis']) : '';
			$data['kesiswaan']['siswa'] = (isset($siswa['siswa']) && $aktif['siswa'] == 1) ? trim($siswa['siswa']) : '';
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_kesiswaan");
		$this->load->view("footer");
	}

	public function program()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Program Penerimaan Peserta Didik Baru - SMA Kristen Indonesia";
		$data['instansi'] = "smaki";

		$program = $this->ypki->getProgram($data['instansi']);
		$data['instansi_program'] = $this->ypki->getAllProgram();
		if(!empty($program)) {
			$program = $program[0];
			$data['program']['smaki'] = $program->aktif;
			$program->program = parse($program->program);
			$data['program'] = $program;
		}

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_program");
		$this->load->view("footer");
	}

	public function search($cmd, $key, $page = NULL)
	{
		if ($cmd == NULL) {
			redirect(base_url()."smaki");
		}
		else if ($cmd == "label") {
			if ($key==NULL)
				redirect(base_url());

			$key = utf8_urldecode($key);

			$this->load->model('ypki');
			$data = $this->session->all_userdata();

			$data['instansi'] = "smaki";
			
			$data['all_berita'] = $this->ypki->getBeritaByLabel($key, NULL, NULL, $data['instansi']);
			$data['limit'] = 8;

			if($page == NULL)
				$berita = $this->ypki->getBeritaByLabel($key, $data['limit'], NULL, $data['instansi']);
			else
				$berita = $this->ypki->getBeritaByLabel($key, $data['limit'], $page, $data['instansi']);

			foreach ($berita as $k => $value)
			{
				$value->konten = parse($value->konten);
			}

			$data['berita'] = $berita;
			$data['show_type'] = "label";
			$data['html_title'] = "Berita dengan label \"".$key."\" - SMA Kristen Indonesia";

			$this->load->view("header", $data);
			$this->load->view("navigator");
			$this->load->view("content_berita");
			$this->load->view("footer");
		}
		else if($cmd == "key")
		{
			if ($key==NULL)
				redirect(base_url()."/smaki");

			$key = utf8_urldecode($key);

			$this->load->model('ypki');
			$data = $this->session->all_userdata();

			$data['instansi'] = "smaki";

			$data['all_berita'] = $this->ypki->getBeritaByKeyword($key, NULL, NULL, $data['instansi']);

			$data['limit'] = 8;

			if($page == NULL)
				$berita = $this->ypki->getBeritaByKeyword($key, $data['limit'], NULL, $data['instansi']);
			else
				$berita = $this->ypki->getBeritaByKeyword($key, $data['limit'], $page, $data['instansi']);

			foreach ($berita as $k => $value)
			{
				$value->konten = parse($value->konten);
			}

			$data['berita'] = $berita;
			$data['show_type'] = "keyword";
			$data['html_title'] = "Berita dengan kata kunci \"".$key."\" - SMA Kristen Indonesia";

			$this->load->view("header", $data);
			$this->load->view("navigator");
			$this->load->view("content_berita");
			$this->load->view("footer");
		}
		else {
			show_404();
		}
	}
}