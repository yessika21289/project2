<?php

function utf8_urldecode($str)
{
    $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
    return html_entity_decode($str,null,'UTF-8');;
}

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

class Search extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if (isset($_POST['key']))
        {
        	$str = $_POST['key'];
        	$str = str_replace(" ", "+", $str);
        	redirect(base_url()."search/key/".$str);
        }
   	}

	public function index()
	{
		redirect(base_url());
	}

	public function label($key, $page = NULL)
	{
		if ($key==NULL)
			redirect(base_url());

		$key = utf8_urldecode($key);

		$this->load->model('ypki');
		$data = $this->session->all_userdata();
		
		$data['all_berita'] = $this->ypki->getBeritaByLabel($key);
		$data['limit'] = 8;

		if($page == NULL)
			$berita = $this->ypki->getBeritaByLabel($key, $data['limit']);
		else
			$berita = $this->ypki->getBeritaByLabel($key, $data['limit'], $page);

		foreach ($berita as $k => $value)
		{
			$value->konten = parse($value->konten);
		}

		$data['instansi'] = "ypki";

		$data['berita'] = $berita;
		$data['show_type'] = "label";
		$data['html_title'] = "Berita dengan label \"".$key."\" - Yayasan Perguruan Kristen Indonesia";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_berita");
		$this->load->view("footer");
	}	

	public function key($key, $page = NULL)
	{
		if ($key==NULL)
			redirect(base_url());

		$key = utf8_urldecode($key);

		$this->load->model('ypki');
		$data = $this->session->all_userdata();

		$data['all_berita'] = $this->ypki->getBeritaByKeyword($key);

		$data['limit'] = 8;

		if($page == NULL)
			$berita = $this->ypki->getBeritaByKeyword($key, $data['limit']);
		else
			$berita = $this->ypki->getBeritaByKeyword($key, $data['limit'], $page);

		foreach ($berita as $k => $value)
		{
			$value->konten = parse($value->konten);
		}

		$data['instansi'] = "ypki";

		$data['berita'] = $berita;
		$data['show_type'] = "keyword";
		$data['html_title'] = "Berita dengan kata kunci \"".$key."\" - Yayasan Perguruan Kristen Indonesia";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_berita");
		$this->load->view("footer");
	}	
}