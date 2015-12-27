<?php

function utf8_urldecode($str)
{
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
}

function getTanggal($created)
{
	$hasil = "";

	$tanggal = "";
	$tanggal .= substr($created, 0,4);
	$tanggal .= substr($created, 5,2);
	$tanggal .= substr($created, 8,2);
	$tanggal .= substr($created, 11,2);
	$tanggal .= substr($created, 14,2);

	$datetime = DateTime::createFromFormat('YmdHi', $tanggal);
	
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
	$hasil .= " ".$datetime->format('Y')." ".$datetime->format('H:i')." WIB";

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

class Berita extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if (isset($_POST['key']))
        {
        	redirect(base_url()."search/key/".$_POST['key']);
        }
   	}

	public function index($page = NULL)
	{
		$data = $this->session->all_userdata();
		$this->load->model('ypki');
		$this->load->model('program');
		$data['instansi_program'] = $this->program->getAllProgram();
		
		$data['instansi'] = "ypki";
		$data['limit'] = 8;

		if($page == NULL || $page == "index")
			$data['berita'] = $this->ypki->getLastBerita($data['limit']);
		else
			$data['berita'] = $this->ypki->getLastBerita($data['limit'], $page);

		foreach ($data['berita'] as $key => $value)
		{
			$value->konten = parse($value->konten);
		}

		$data['html_title'] = "Berita - Yayasan Perguruan Kristen Indonesia";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_berita");
		$this->load->view("footer");
	}

	public function page($page = NULL)
	{
		$this->index($page);
	}

	public function baca($tahun,$bulan,$tanggal,$judul)
	{
		$data = $this->session->all_userdata();
		$this->load->model('ypki');
		$this->load->model('program');
		$data['instansi_program'] = $this->program->getAllProgram();
		
		$data['instansi'] = "ypki";
		
		$date=$tahun."/".$bulan."/".$tanggal;

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

			$data['html_title'] = $data['berita']->judul." - Yayasan Perguruan Kristen Indonesia";
			
			$this->load->view("header", $data);
			$this->load->view("navigator");
			$this->load->view("content_baca_berita");
			$this->load->view("footer");
		}
	}

	
}