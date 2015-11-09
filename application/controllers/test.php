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
		
		$data['instansi'] = "ypki";

		$this->load->view("header", $data);
		$this->load->view("navigator");
		$this->load->view("content_home");
		$this->load->view("footer");
	}
}