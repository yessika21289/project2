<?php

class Dokumentasi extends CI_Controller {

	public function __construct()
	{
        parent::__construct();
        if (isset($_POST['key']))
        {
        	redirect(base_url()."search/key/".$_POST['key']);
        }
   	}

	public function index($directory = "")
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		if($directory == "")
			$data['list_dokumentasi'] = $this->ypki->getAllAlbum("ypki");
		else{
			$data['directory'] = $directory;
			$data['judul'] = $this->ypki->getJudulAlbumByDirectory($directory,"ypki");
		}

		$data['html_title'] = "Dokumentasi - YPKI";
		$data['instansi'] = "ypki";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_dokumentasi");
		$this->load->view("footer");
	}

	public function _remap($directory = "")
	{
		$this->index($directory);
	}
}