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

class Kontak extends CI_Controller {

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

		$data = $this->session->all_userdata();

		$data['html_title'] = "Kontak - Yayasan Perguruan Kristen Indonesia";
		$data['instansi'] = "ypki";

		$this->load->library('form_validation');
		$this->form_validation->set_message('required','%s wajib diisi.');
		$this->form_validation->set_message('valid_email','%s harus valid.');
		$this->form_validation->set_message('numeric','%s harus angka.');
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('phone', 'Nomor telepon', 'numeric');
		$this->form_validation->set_rules('pesan', 'Pesan', 'required');

		if ($this->form_validation->run() == FALSE)
        {

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
        else
        {
			$pesan = $this->ypki->addPesan($data['instansi'], $_POST);

			if($pesan){
				$this->session->set_flashdata('pesan_terkirim',1);
			}
			else{
				$this->session->set_flashdata('pesan_terkirim',0);
			}
			redirect(base_url()."kontak");
        }
	}
}