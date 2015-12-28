<?php

class MY_Controller extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $tipe = $this->session->userdata('tipe');
        
		if (!empty($tipe) || $_SERVER['REQUEST_URI'] == '/admin' || $_SERVER['REQUEST_URI'] == '/admin/login_process') //keep access the page except the /admin/.....
		{

		}
		else
		{
			redirect(base_url());
		}
    }
}

?>