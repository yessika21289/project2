<?php

class Login extends CI_Controller {

	/*public function index($msg = NULL)
	{
		$data['msg'] = $msg;
		$this->load->view("header");
		$this->load->view("navigator_login");
		$this->load->view("content_login", $data);
		$this->load->view("footer");
	}*/

	public function process()
	{
		$username = $this->security->xss_clean($this->input->post('username'));

		if (!empty($username))
		{
			$data = $this->session->all_userdata();
			$this->load->model('ypki');
			$result = $this->ypki->validate();

			if ($result)
			{
				redirect(base_url().'admin/dashboard');
			}
			else
			{
				$msg =
				"
					<div class='alert alert-danger' role='alert'>
						<strong>Login gagal!</strong>
				        <br/>Username/Password tidak cocok.
				    </div>  
				";
				$this->index($msg);
			}
		}
		else
		{
			redirect(base_url().'admin');	
		}
		
	}
}