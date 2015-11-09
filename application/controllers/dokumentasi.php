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

	public function index()
	{
		$this->load->model("ypki");

		$data = $this->session->all_userdata();

		$data['html_title'] = "Halaman ini masih dalam tahap penyelesaian - ypki.or.id";
		$data['instansi'] = "ypki";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("under_construction");
		$this->load->view("footer");
	}
}