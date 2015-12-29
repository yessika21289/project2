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
//		$this->load->model("ypki");
//		$this->load->library("calendar");
//
//		$data = $this->session->all_userdata();
//
//		$data['html_title'] = "Visi Misi - Yayasan Perguruan Kristen Indonesia";
//		$data['instansi'] = "ypki";
//
//		$visi = $this->ypki->getProfil('visi_misi', $data['instansi']);
//		$tujuan_sekolah = $this->ypki->getProfil('tujuan_sekolah', $data['instansi']);
//		$visi = $visi[0];
//		$tujuan_sekolah = $tujuan_sekolah[0];
//		$visi->visi = parse($visi->visi);
//		$visi->misi = parse($visi->misi);
//		$tujuan_sekolah->tujuan_sekolah = parse($tujuan_sekolah->tujuan_sekolah);
//
//		$data['visi'] = $visi;
//		$data['tujuan_sekolah'] = $tujuan_sekolah;
//
//		$this->load->view("header", $data);
//		$this->load->view("navigator");
//		$this->load->view("content_visi");
//		$this->load->view("footer");
	}

	public function visi_misi()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Visi Misi - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$visi = $this->ypki->getProfil('visi_misi', $data['instansi']);
		$visi = $visi[0];
		$visi->visi = parse($visi->visi);
		$visi->misi = parse($visi->misi);

		$data['profil'] = 'visi_misi';
		$data['judul_profil'] = 'Visi & Misi';
		$data['visi'] = $visi;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function tujuan_sekolah()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Tujuan Sekolah - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$tujuan_sekolah = $this->ypki->getProfil('tujuan_sekolah', $data['instansi']);
		$tujuan_sekolah = parse($tujuan_sekolah[0]->tujuan_sekolah);

		$data['profil'] = 'tujuan_sekolah';
		$data['judul_profil'] = 'Tujuan Sekolah';
		$data['tujuan_sekolah'] = $tujuan_sekolah;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function nilai_kristiani()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Nilai Kristiani - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$nilai_kristiani = $this->ypki->getProfil('nilai_kristiani', $data['instansi']);
		$nilai_kristiani = parse($nilai_kristiani[0]->nilai_kristiani);

		$data['profil'] = 'nilai_kristiani';
		$data['judul_profil'] = 'Nilai Kristiani';
		$data['nilai_kristiani'] = $nilai_kristiani;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function motto()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Motto - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$motto = $this->ypki->getProfil('motto', $data['instansi']);
		$motto = parse($motto[0]->motto);

		$data['profil'] = 'motto';
		$data['judul_profil'] = 'Motto';
		$data['motto'] = $motto;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function arti_logo()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Arti Logo - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$arti_logo = $this->ypki->getProfil('arti_logo', $data['instansi']);
		$arti_logo = parse($arti_logo[0]->arti_logo);

		$data['profil'] = 'arti_logo';
		$data['judul_profil'] = 'Arti Logo';
		$data['arti_logo'] = $arti_logo;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function sejarah_singkat()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Sejarah Singkat - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$sejarah_singkat = $this->ypki->getProfil('sejarah_singkat', $data['instansi']);
		$sejarah_singkat = parse($sejarah_singkat[0]->sejarah_singkat);

		$data['profil'] = 'sejarah_singkat';
		$data['judul_profil'] = 'Sejarah Singkat';
		$data['sejarah_singkat'] = $sejarah_singkat;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}

	public function struktur_organisasi()
	{
		$this->load->model("ypki");
		$this->load->library("calendar");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Struktur Organisasi - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$struktur_organisasi = $this->ypki->getProfil('struktur_organisasi', $data['instansi']);
		$struktur_organisasi = parse($struktur_organisasi[0]->struktur_organisasi);

		$data['profil'] = 'struktur_organisasi';
		$data['judul_profil'] = 'Struktur Organisasi';
		$data['struktur_organisasi'] = $struktur_organisasi;

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_profil");
		$this->load->view("footer");
	}
}