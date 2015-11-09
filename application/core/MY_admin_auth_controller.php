<?php

class MY_Controller extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        
        $tipe = $this->session->userdata('tipe');
		if (!empty($tipe))
		{
			
		}
		else
		{
			redirect(base_url());
		}
    }
}

?>