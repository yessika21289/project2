<?php

class Admin extends MY_Controller {

	public function index($msg = NULL)
	{
		$tipe = $this->session->userdata('tipe');
		if(!empty($tipe))
			redirect('admin/dashboard');
		else{
			$data['msg'] = $msg;
			$this->load->view("header");
			$this->load->view("navigator_login");
			$this->load->view("content_login", $data);
			$this->load->view("footer");
		}
	}

	public function dashboard()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');
		$data['jumlah_berita'] = $this->ypki->getJumlahBerita($instansi);
		$data['jumlah_agenda'] = $this->ypki->getJumlahAgenda($instansi);
		$data['jumlah_firman'] = $this->ypki->getJumlahFirman($instansi);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin");
		$this->load->view("content_admin_footer");
	}

	public function log($page = NULL)
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		$data['limit'] = 15;
		
		if($page == NULL)
			$data['log'] = $this->ypki->getLog($instansi, $data['limit']);
		else
			$data['log'] = $this->ypki->getLog($instansi, $data['limit'], $page);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_log");
		$this->load->view("content_admin_footer");
	}

	public function visi()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$data['instansi'] = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updateVisi($data['instansi'], $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;				
			}
		}

		$data['visi'] = $this->ypki->getVisi($data['instansi']);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_visi");
		$this->load->view("content_admin_footer");	

		$this->session->unset_userdata('update_confirm');
	}

	public function berita($task = NULL)
	{
		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		$this->load->model('ypki');
		$data['berita'] = $this->ypki->getAllBerita($instansi);

		if(!isset($task) || $task == 'hapus')
			$data['active_berita'] = 1;
		else
			$data['active_berita_baru'] = 1;

		if(empty($task))
		{
			$this->load->view("content_admin_header", $data);
			$this->load->view("content_admin_berita");
		}
		else if($task=="baru")
		{
			$this->load->view("content_admin_header", $data);
			if (isset($_POST['submit']))
			{
				$insert = $this->ypki->addBerita($_POST, $_FILES["gambar"]);
				if($insert)
				{
					$id = $insert;

					$this->session->set_flashdata('submit_confirm', 1);

					$new = $this->ypki->getNewBerita();
					$new = $new[0];

					if($instansi != "ypki")
						$data['read_link'] = base_url().$instansi."/berita/baca/".substr($new->created,0,10)."/".urlencode($new->judul);
					else
						$data['read_link'] = base_url()."berita/baca/".substr($new->created,0,10)."/".urlencode($new->judul);

					$this->session->set_flashdata('read_link', $data['read_link']);
					$this->session->set_flashdata('new_berita', $new->id);
					redirect('admin/berita');
				}
				else
				{
					$this->session->set_flashdata('submit_confirm',0);
					$this->session->set_flashdata('post', $_POST);
					redirect('admin/berita/baru');
				}
			}

			if($this->session->flashdata('submit_confirm') == 0) {
				$data['post'] = $this->session->flashdata('post');
				$data['gagal'] = $this->session->flashdata('submit_confirm');
			}

			$this->load->view("content_admin_berita_baru", $data);
			$this->session->unset_userdata('submit_confirm');
		}
		else if($task=="ubah")
		{
			$id = $this->uri->segment(4);
			$data['submit_confirm'] = $this->session->flashdata('submit_confirm');
			$data['update_confirm'] = $this->session->flashdata('update_confirm');
			$data['read_link'] = $this->session->flashdata('read_link');
			$this->load->view("content_admin_header", $data);

			if (isset($_POST['update']))
			{
				if($this->ypki->updateBerita($_POST, $_FILES["gambar"]) == 1)
				{
					//$data['update_confirm'] = 1;

					$tanggal = $this->ypki->getCol("created","berita",$_POST['id']);
					$tanggal = $tanggal[0]->created;

					if($instansi != "ypki")
						$data['read_link'] = base_url().$instansi."/berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);
					else
						$data['read_link'] = base_url()."berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);


					$this->session->set_flashdata('update_confirm',1);
					$this->session->set_flashdata('read_link',$data['read_link']);
					$this->session->set_flashdata('new_berita', $_POST['id']);
					redirect('admin/berita');
				}
				else {
					$this->session->set_flashdata('submit_confirm', 0);
					$this->session->set_flashdata('post', $_POST);
					redirect('admin/berita/ubah/'.$_POST['id']);
				}
			}

			if($this->session->flashdata('submit_confirm') == 0) {
				$data['post'] = $this->session->flashdata('post');
				$data['gagal'] = $this->session->flashdata('submit_confirm');
			}

			$id = $this->uri->segment(4);
			$berita = $this->ypki->getBerita($id);
			$data['berita_edit'] = $berita[0];
			$data['berita_edit']->tipe_gambar = $this->ypki->getTipeGambar($data['berita_edit']->gambar);

			$data['berita_label'] = $this->ypki->getLabelString($id);
			$this->load->view("content_admin_berita_baru", $data);
			$this->session->unset_userdata('berita_edit');
			$this->session->unset_userdata('berita_label');
			$this->session->unset_userdata('update_confirm');
		}
		else if($task=="hapus")
		{
			$id = $this->uri->segment(4);
			if( $this->ypki->deleteBerita($id) )
			{
				$this->session->set_flashdata('delete_confirm', 1);
				//$data['delete_confirm'] = 1;
				redirect('admin/berita');
			}
			else
			{
				$this->session->set_flashdata('delete_confirm', 0);
				//$data['delete_confirm'] = 0;
				redirect('admin/berita');
			}

			//$this->load->view("content_admin_berita", $data);

			$this->session->unset_userdata('delete_confirm');
		}
		else
		{
			redirect(base_url()."admin/berita");
		}


		$this->load->view("content_admin_footer");
	}

	public function agenda($task = NULL)
	{
		$instansi = $this->session->userdata('instansi');
		$data = $this->session->all_userdata();

		$this->load->model('ypki');
		$data['agenda'] = $this->ypki->getAllAgenda($instansi);
		
		if(!isset($task) || $task == 'hapus')
			$data['active_agenda'] = 1;
		else
			$data['active_agenda_baru'] = 1;

		if(empty($task))
		{
			$this->load->view("content_admin_header", $data);
			$this->load->view("content_admin_agenda");	
		}
		else if($task=="baru")
		{
			$this->load->view("content_admin_header", $data);
			if (isset($_POST['submit']))
			{
				if($this->ypki->addAgenda($_POST) == 1)
				{
					$new = $this->ypki->getNewAgenda();
					$new = $new[0];

					$tanggal = substr($new->tanggal,0,4)."/".substr($new->tanggal,5,2)."/".substr($new->tanggal,8,2);

					if($instansi != "ypki")
						$data['read_link'] = base_url().$instansi."/agenda/baca/".$tanggal."/".urlencode($new->nama);
					else
						$data['read_link'] = base_url()."agenda/baca/".$tanggal."/".urlencode($new->nama);
					$this->session->set_flashdata('submit_confirm', 1);
					$this->session->set_flashdata('read_link', $data['read_link']);
					$this->session->set_flashdata('new_agenda', $new->id);
					redirect('admin/agenda');
				} else {
					$this->session->set_flashdata('submit_confirm', 0);
					$this->session->set_flashdata('post', $_POST);
					redirect('admin/agenda/baru');
				}
			}
			if($this->session->flashdata('submit_confirm') == 0) {
				$data['post'] = $this->session->flashdata('post');
				$data['gagal'] = $this->session->flashdata('submit_confirm');
			}
			$this->load->view("content_admin_agenda_baru", $data);
			$this->session->unset_userdata('submit_confirm');
		}
		else if($task=="ubah")
		{
			$this->load->view("content_admin_header", $data);
			if (isset($_POST['update']))
			{
				if($this->ypki->updateAgenda($_POST) == 1)
				{
					$tanggal = str_replace("-", "/", $_POST['tanggal']);

					if($instansi != "ypki")
						$data['read_link'] = base_url().$instansi."/agenda/baca/".$tanggal."/".urlencode($_POST['judul']);
					else
						$data['read_link'] = base_url()."agenda/baca/".$tanggal."/".urlencode($_POST['judul']);
					$this->session->set_flashdata('submit_confirm', 1);
					$this->session->set_flashdata('read_link', $data['read_link']);
					$this->session->set_flashdata('new_agenda', $_POST['id']);
					redirect('admin/agenda');
				}
				else {
					$this->session->set_flashdata('submit_confirm', 0);
					$this->session->set_flashdata('post', $_POST);
					redirect('admin/agenda/ubah/'.$_POST['id']);
				}
			}

			if($this->session->flashdata('submit_confirm') == 0) {
				$data['post'] = $this->session->flashdata('post');
				$data['gagal'] = $this->session->flashdata('submit_confirm');
			}

			$id = $this->uri->segment(4);
			$berita = $this->ypki->getAgenda($id);
			$data['berita_edit'] = $berita[0];
			$this->load->view("content_admin_agenda_baru", $data);
			$this->session->unset_userdata('berita_edit');
			$this->session->unset_userdata('update_confirm');
		}
		else if($task=="hapus")
		{
			$id = $this->uri->segment(4);
			if( $this->ypki->deleteAgenda($id) )
			{
				$this->session->set_flashdata('delete_confirm', 1);
				redirect('admin/agenda');
				//$data['delete_confirm'] = 1;
			}
			else
			{
				$this->session->set_flashdata('delete_confirm', 0);
				redirect('admin/agenda');
//				$data['delete_confirm'] = 0;
			}
			
			$this->session->unset_userdata('delete_confirm');
		}
		else
		{
			redirect(base_url()."admin/agenda");
		}


		$this->load->view("content_admin_footer");		
	}

	public function album($task = NULL, $directory = NULL)
	{
		$instansi = $this->session->userdata('instansi');
		$data = $this->session->all_userdata();

		$this->load->model('ypki'); 
		$data['album'] = $this->ypki->getAllAlbum($instansi);
		
		if(!isset($task) || $task == 'hapus')
			$data['active_album'] = 1;
		else
			$data['active_album_baru'] = 1;

		if(empty($task)){
			$this->load->view("content_admin_header", $data);
			$this->load->view("content_admin_album", $data);
			$this->load->view("content_admin_footer");
		}
		else if($task=="baru")
		{
			$this->load->view("content_admin_header", $data);
			$this->load->view("content_admin_album_baru");
			$this->load->view("content_admin_footer");
		}
		else if($task=="judul"){
			$judul_album = $_POST['judul'];
			$directory = str_replace(" ","_",strtolower($judul_album));
			if($this->ypki->addJudulAlbum($_POST, $directory)){
				mkdir('asset/album/'.$directory, 0777, true);
			}
			redirect('/admin/album/upload/'.$directory);
		}
		else if($task=="upload"){
			$data['album'] = $this->ypki->getAlbum($directory);
			$this->load->view("content_admin_header", $data);
			$this->load->view("content_admin_album_upload", $data);
			$this->load->view("content_admin_footer");
		}
		else if($task=="upload_image"){
			if($_POST['image_form_submit'] == 1)
			{
				$images_arr = array();
				foreach($_FILES['images']['name'] as $key=>$val){
					$image_name = $_FILES['images']['name'][$key];
					$tmp_name 	= $_FILES['images']['tmp_name'][$key];
					$size 		= $_FILES['images']['size'][$key];
					$type 		= $_FILES['images']['type'][$key];
					$error 		= $_FILES['images']['error'][$key];
					
					############ Remove comments if you want to upload and stored images into the "uploads/" folder #############
					$filex = explode('.',$image_name);
					$filex = array_reverse($filex);

					$waktu = date("YmdHis");

					$filename = $waktu.$key.'.'.$filex[0];
					
					$target_dir = "asset/album/".$_POST['directory']."/";
					//echo $target_dir;
					$target_file = $target_dir.$filename;
					if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_file)){
						//$images_arr[] = base_url().'/'.$target_file;
					}
					
					//display images without stored
					/*$extra_info = getimagesize($_FILES['images']['tmp_name'][$key]);
			    	$images_arr[] = "data:" . $extra_info["mime"] . ";base64," . base64_encode(file_get_contents($_FILES['images']['tmp_name'][$key]));*/
				}
			}
		}
		else if($task=="hapus")
		{
			$id = $this->uri->segment(4);
			$data['album'] = $this->ypki->getAlbumById($id);
			if( $this->ypki->deleteAlbum($id) )
			{
				$this->delTree('asset/album/'.$data['album']['directory']);
				$data['delete_confirm'] = 1;
			}
			else
			{
				$data['delete_confirm'] = 0;
			}

			//$this->load->view("content_admin_album", $data);
			redirect('admin/album');
			
			$this->session->unset_userdata('delete_confirm');
		}
	}

	public function delTree($dir) 
	{ 
	   	$files = array_diff(scandir($dir), array('.','..'));
	   	//print_r($files);
	    foreach ($files as $file) { 
	    	//print_r($file);
	      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
	    } 
	    return rmdir($dir); 
	 }


	public function firman($task = NULL)
	{
		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		$this->load->model('ypki');
		$data['firman'] = $this->ypki->getAllFirman($instansi);

		if(!isset($task) || $task == 'hapus')
			$data['active_firman'] = 1;
		else
			$data['active_firman_baru'] = 1;

		if (empty($task)) {
			$this->load->view("content_admin_header", $data);
			$this->load->view("content_admin_firman");
		}

		else if ($task == "baru") {
			$this->load->view("content_admin_header", $data);
			if (isset($_POST['submit'])) {
				if($_POST['firman_today'] == 1) $j = 1;
				else $j = 7;
				$instansi = $_POST['instansi'];
				$success = 0;
				for ($i = 1; $i <= $j; $i++) {
					$konten = $_POST['konten_' . $i];
					$tanggal = $_POST['tanggal_' . $i];
					if($this->ypki->addFirman($konten, $tanggal, $instansi)) $success += 1;
				}

				if($success >= 1) {
					//$data['submit_confirm'] = 1;
					$this->session->set_flashdata('submit_confirm', 1);
					$this->session->set_flashdata('new_firman', $this->ypki->getNewFirman($success));
					redirect('admin/firman');
				}
				else {
					$this->session->set_flashdata('submit_confirm', 0);
					$this->session->set_flashdata('post', $_POST);
					redirect('admin/firman/baru');
				}
			}
			if($this->session->flashdata('submit_confirm') == 0) {
				$data['post'] = $this->session->flashdata('post');
				$data['gagal'] = $this->session->flashdata('submit_confirm');
			}

			$this->load->view("content_admin_firman_baru", $data);
			$this->session->unset_userdata('submit_confirm');
		}
		else if ($task == "ubah") {
			$this->load->view("content_admin_header", $data);
			$data['submit_confirm'] = $this->session->flashdata('submit_confirm');
			$data['update_confirm'] = $this->session->flashdata('update_confirm');
			if(isset($_POST['update'])) {
				$update = array(
					'firman' => $_POST['konten_1']
				);

				$id = $_POST['id'];
				$this->db->where('id', $id);
				$update = $this->db->update('firman', $update);
				if($update == 1) {
					$this->session->set_flashdata('submit_confirm', 1);
					$this->session->set_flashdata('update_firman', $_POST['id']);
					redirect('admin/firman');
				}
				else {
					$this->session->set_flashdata('submit_confirm', 0);
					$this->session->set_flashdata('post', $_POST);
					redirect('admin/firman/ubah/'.$_POST['id']);
				}
			}

			if($this->session->flashdata('submit_confirm') == 0) {
				$data['post'] = $this->session->flashdata('post');
				$data['gagal'] = $this->session->flashdata('submit_confirm');
			}

			$id = $this->uri->segment(4);
			$firman = $this->ypki->getFirman($id);
			//$data['firman_edit'] = $firman[0];

			if(!empty($firman))	$data['firman_edit'] = $firman[0];

			$this->load->view('content_admin_firman_baru', $data);
		}
		else if ($task == 'hapus') {
			$id = $this->uri->segment(4);
			if($this->ypki->deleteFirman($id)) {
				$this->session->set_flashdata('delete_confirm', 1);
				redirect('admin/firman');
				//$data['delete_confirm'] = 1;
			}
			else {
				$this->session->set_flashdata('delete_confirm', 0);
				redirect('admin/firman');
				//$data['delete_confirm'] = 0;
			}
			//$this->load->view("content_admin_firman", $data);

			$this->session->unset_userdata('delete_confirm');
		}
		$this->load->view("content_admin_footer");
	}

	public function kontak()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updateKontak($instansi, $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;
			}
		}

		$data['kontak'] = $this->ypki->getKontak($instansi);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_kontak");
		$this->load->view("content_admin_footer");

		$this->session->unset_userdata('update_confirm');
	}

	public function fasilitas()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updateFasilitas($instansi, $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;
			}
		}

		$data['fasilitas'] = $this->ypki->getFasilitas($instansi);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_fasilitas");
		$this->load->view("content_admin_footer");

		$this->session->unset_userdata('update_confirm');
	}

	public function kurikulum()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updateKurikulum($instansi, $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;
			}
		}

		$data['kurikulum'] = $this->ypki->getKurikulum($instansi);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_kurikulum");
		$this->load->view("content_admin_footer");

		$this->session->unset_userdata('update_confirm');
	}

	public function personalia()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updatePersonalia($instansi, $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;
			}
		}

		$data['personalia'] = $this->ypki->getPersonalia($instansi);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_personalia");
		$this->load->view("content_admin_footer");

		$this->session->unset_userdata('update_confirm');
	}

	public function kesiswaan()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updateKesiswaan($instansi, $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;
			}
		}

		$data['kesiswaan'] = $this->ypki->getKesiswaan($instansi);

		$this->load->view("content_admin_header", $data);
		$this->load->view("content_admin_kesiswaan");
		$this->load->view("content_admin_footer");

		$this->session->unset_userdata('update_confirm');
	}
}