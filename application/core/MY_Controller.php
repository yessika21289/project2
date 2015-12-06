<?php

class MY_Controller extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $tipe = $this->session->userdata('tipe');
		if (!empty($tipe) || $_SERVER['REQUEST_URI'] == '/admin') //keep access the page except the /admin/.....
		{

		}
		else
		{
			redirect(base_url());
		}
    }
}

?>