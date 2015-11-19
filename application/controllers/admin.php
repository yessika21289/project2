<?php

class Admin extends MY_Controller {

	public function index()
	{
		$this->load->model('ypki');

		$data = $this->session->all_userdata();
		$instansi = $this->session->userdata('instansi');
		$data['jumlah_berita'] = $this->ypki->getJumlahBerita($instansi);
		$data['jumlah_agenda'] = $this->ypki->getJumlahAgenda($instansi);

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
		$instansi = $this->session->userdata('instansi');

		if( isset($_POST['submit']) )
		{
			if($this->ypki->updateVisi($instansi, $_POST))
			{
				$data['update_confirm'] = 1;
			}
			else
			{
				$data['update_confirm'] = 0;				
			}
		}

		$data['visi'] = $this->ypki->getVisi($instansi);

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
		$this->load->view("content_admin_header", $data);

		if(empty($task))
		{
			$this->load->view("content_admin_berita");
		}
		else if($task=="baru")
		{
			if (isset($_POST['submit']))
			{
				/*if ($_POST['input-opt'] == 1)
				{*/
					$insert = $this->ypki->addBerita($_POST, $_FILES["gambar"]);
					if($insert)
					{
						$id = $insert;

						$data['submit_confirm'] = 1;
						$this->session->set_flashdata('submit_confirm', 1);

						$new = $this->ypki->getNewBerita();
						$new = $new[0];

						if($instansi != "ypki")
							$data['read_link'] = base_url().$instansi."/berita/baca/".substr($new->created,0,10)."/".urlencode($new->judul);
						else
							$data['read_link'] = base_url()."berita/baca/".substr($new->created,0,10)."/".urlencode($new->judul);

						$this->session->set_flashdata('read_link', $data['read_link']);
						redirect(base_url()."admin/berita/ubah/".$id);
					}
					else
					{
						$data['submit_confirm'] = 0;
					}

				/*}
				else if ($_POST['input-opt'] == 2)
				{
					if($this->ypki->addBeritaLinked($_POST))
					{
						$data['submit_confirm'] = 1;

						$new = $this->ypki->getNewBerita();
						$new = $new[0];

						if($instansi != "ypki")
							$data['read_link'] = base_url().$instansi."/berita/baca/".substr($new->created,0,10)."/".urlencode($new->judul);
						else
							$data['read_link'] = base_url()."berita/baca/".substr($new->created,0,10)."/".urlencode($new->judul);
					}
					else
					{
						$data['submit_confirm'] = 0;	
					}	
				}*/
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

			if (isset($_POST['update']))
			{
				/*iif (isset($_POST['input-opt']))
				{
					f ($_POST['input-opt'] == 1)
					{*/
						if($this->ypki->updateBerita($_POST, $_FILES["gambar"]) == 1)
						{
							$data['update_confirm'] = 1;

							$tanggal = $this->ypki->getCol("created","berita",$_POST['id']);
							$tanggal = $tanggal[0]->created;

							if($instansi != "ypki")
								$data['read_link'] = base_url().$instansi."/berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);
							else
								$data['read_link'] = base_url()."berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);


							$this->session->set_flashdata('update_confirm',1);
							$this->session->set_flashdata('read_link',$data['read_link']);
						}
						else
						{
							$data['update_confirm'] = 0;
							$this->session->set_flashdata('update_confirm',0);
						}

						redirect(base_url()."admin/berita/ubah/".$id);
					/*}
					else if ($_POST['input-opt'] == 2)
					{
						if($this->ypki->updateBeritaLinked($_POST))
						{
							$data['update_confirm'] = 1;

							$tanggal = $this->ypki->getCol("created","berita",$_POST['id']);
							$tanggal = $tanggal[0]->created;

							if($instansi != "ypki")
								$data['read_link'] = base_url().$instansi."/berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);
							else
								$data['read_link'] = base_url()."berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);
						}
						else
						{
							$data['update_confirm'] = 0;	
						}	
					}
				}
				else
				{
					if($this->ypki->updateBerita($_POST, $_FILES["gambar"]) == 1)
					{
						$data['update_confirm'] = 1;

						$tanggal = $this->ypki->getCol("created","berita",$_POST['id']);
						$tanggal = $tanggal[0]->created;

						if($instansi != "ypki")
							$data['read_link'] = base_url().$instansi."/berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);
						else
							$data['read_link'] = base_url()."berita/baca/".substr($tanggal,0,10)."/".urlencode($_POST['judul']);
					}
					else
					{
						$data['update_confirm'] = 0;	
					}	
				}*/
				
			}

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
				$data['delete_confirm'] = 1;
			}
			else
			{
				$data['delete_confirm'] = 0;
			}

			$this->load->view("content_admin_berita", $data);
			
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
		$data['berita'] = $this->ypki->getAllAgenda($instansi);
		
		if(!isset($task) || $task == 'hapus')
			$data['active_agenda'] = 1;
		else
			$data['active_agenda_baru'] = 1;

		$this->load->view("content_admin_header", $data);

		if(empty($task))
		{
			$this->load->view("content_admin_agenda");	
		}
		else if($task=="baru")
		{
			if (isset($_POST['submit']))
			{
				if($this->ypki->addAgenda($_POST) == 1)
				{
					$data['submit_confirm'] = 1;

					$new = $this->ypki->getNewAgenda();
					$new = $new[0];

					$tanggal = substr($new->tanggal,0,4)."/".substr($new->tanggal,5,2)."/".substr($new->tanggal,8,2);

					if($instansi != "ypki")
						$data['read_link'] = base_url().$instansi."/agenda/baca/".$tanggal."/".urlencode($new->nama);
					else
						$data['read_link'] = base_url()."agenda/baca/".$tanggal."/".urlencode($new->nama);
				}
				else
				{
					$data['submit_confirm'] = 0;	
				}
			}

			$this->load->helper(array('form', 'url'));

			$this->load->library('form_validation');

			$this->form_validation->set_rules('judul', 'Judul', 'required');
			$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('content_admin_agenda_baru', $data);
			}
			else
			{
				$this->load->view('formsuccess');
			}
			
//			$this->load->view("content_admin_agenda_baru", $data);
			$this->session->unset_userdata('submit_confirm');
		}
		else if($task=="ubah")
		{
			if (isset($_POST['update']))
			{
				if($this->ypki->updateAgenda($_POST) == 1)
				{
					$data['update_confirm'] = 1;

					$tanggal = str_replace("-", "/", $_POST['tanggal']);

					
					if($instansi != "ypki")
						$data['read_link'] = base_url().$instansi."/agenda/baca/".$tanggal."/".urlencode($_POST['judul']);
					else
						$data['read_link'] = base_url()."agenda/baca/".$tanggal."/".urlencode($_POST['judul']);
				}
				else
				{
					$data['update_confirm'] = 0;	
				}
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
				$data['delete_confirm'] = 1;
			}
			else
			{
				$data['delete_confirm'] = 0;
			}

			$this->load->view("content_admin_agenda", $data);
			
			$this->session->unset_userdata('delete_confirm');
		}
		else
		{
			redirect(base_url()."admin/agenda");
		}


		$this->load->view("content_admin_footer");		
	}

	public function album($task = NULL)
	{
		$instansi = $this->session->userdata('instansi');
		$data = $this->session->all_userdata();

		$this->load->model('ypki'); 
		$data['berita'] = $this->ypki->getAllAgenda($instansi);
		
		if(!isset($task) || $task == 'hapus')
			$data['active_album'] = 1;
		else
			$data['active_album_baru'] = 1;

		$this->load->view("content_admin_header", $data);
		if(empty($task))
		{
			$this->load->view("content_admin_album_baru");
		}
		else if($task=="upload"){
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
					
					$target_dir = "asset/album/";
					$target_file = $target_dir.$_FILES['images']['name'][$key];
					if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$target_file)){
						$images_arr[] = $target_file;
					}
					
					//display images without stored
					/*$extra_info = getimagesize($_FILES['images']['tmp_name'][$key]);
			    	$images_arr[] = "data:" . $extra_info["mime"] . ";base64," . base64_encode(file_get_contents($_FILES['images']['tmp_name'][$key]));*/
				}
				
				//Generate images view
				if(!empty($images_arr)){ $count=0;
					foreach($images_arr as $image_src){ $count++?>
						<ul class="reorder_ul reorder-photos-list">
			            	<li id="image_li_<?php echo $count; ?>" class="ui-sortable-handle">
			                	<a href="javascript:void(0);" style="float:none;" class="image_link"><img src="<?php echo $image_src; ?>" alt=""></a>
			               	</li>
			          	</ul>
				<?php }
				}
			}
		}
		$this->load->view("content_admin_footer");
	}
}

