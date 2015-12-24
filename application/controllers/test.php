<?php

class Test extends CI_Controller {

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
		$today = date('Y-m-d');
		$data['firman'] = $this->ypki->getFirmanToday($today);
		$data['instansi'] = "ypki";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_home", $data['firman']);
		$this->load->view("footer");
	}
}