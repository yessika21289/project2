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

		$kurikulum = $this->ypki->getPersonalia($data['instansi']);
		
		if(!empty($personalia)) {
            foreach ($personalia as $key => $deskripsi) {
                $person[$personalia[$key]->jenis] = $personalia[$key]->deskripsi;
            }
            $pimpinan = (isset($person['pimpinan'])) ? trim($person['pimpinan']) : '';
            $pengajar = (isset($person['pengajar'])) ? trim($person['pengajar']) : '';
            $tenaga_pendidik = (isset($person['tenaga_pendidik'])) ? trim($person['tenaga_pendidik']) : '';
            $siswa = (isset($person['siswa'])) ? trim($person['siswa']) : '';
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