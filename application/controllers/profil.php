<?php

function parse($konten)
{
	// BBcode array
	$find = array(
	'~\[b\](.*?)\[/b\]~s',
	'~\[i\](.*?)\[/i\]~s',
	'~\[u\](.*?)\[/u\]~s',
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

class Profil extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if (isset($_POST['key']))
        {
        	redirect(base_url()."search/key/".$_POST['key']);
        }
   	}

	public function index()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Visi Misi - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$visi = $this->ypki->getTentangKami('visi_misi', $data['instansi']);
		$tujuan_sekolah = $this->ypki->getTentangKami('tujuan_sekolah', $data['instansi']);
		$visi = $visi[0];
		$tujuan_sekolah = $tujuan_sekolah[0];
		$visi->visi = parse($visi->visi);
		$visi->misi = parse($visi->misi);
		$tujuan_sekolah->tujuan_sekolah = parse($tujuan_sekolah->tujuan_sekolah);

		$data['visi'] = $visi;
		$data['tujuan_sekolah'] = $tujuan_sekolah;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_visi");
		$this->load->view("footer");
	}

	public function nilai_kristiani()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Nilai Kristiani - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$nilai_kristiani = $this->ypki->getTentangKami('nilai_kristiani', $data['instansi']);
		$nilai_kristiani = parse($nilai_kristiani[0]->nilai_kristiani);

		$data['nilai_kristiani'] = $nilai_kristiani;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_visi");
		$this->load->view("footer");
	}

	public function motto()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Nilai Kristiani - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$motto = $this->ypki->getTentangKami('motto', $data['instansi']);
		$motto = parse($motto[0]->motto);

		$data['motto'] = $motto;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_visi");
		$this->load->view("footer");
	}

	public function arti_logo()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Nilai Kristiani - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$arti_logo = $this->ypki->getTentangKami('arti_logo', $data['instansi']);
		$arti_logo = parse($arti_logo[0]->arti_logo);

		$data['arti_logo'] = $arti_logo;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_visi");
		$this->load->view("footer");
	}
}