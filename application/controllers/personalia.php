<?php

class Personalia extends CI_Controller {

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

		$data['html_title'] = "Personalia - YPKI";
		$data['instansi'] = "ypki";

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

	public function _remap($directory = "")
	{
		$this->index($directory);
	}
}