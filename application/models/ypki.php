<?php

	class Ypki extends CI_Model{
		function __construct(){
			parent::__construct();
			$this->allowed_tags = '<p><div><br><span><strong><em><sub><sup><ul><ol><li><a><blockquote><iframe><img>';
		}

		public function validate(){
			$username = $this->security->xss_clean($this->input->post('username'));
			$password = $this->security->xss_clean($this->input->post('password'));

			$this->db->where('username', $username);
			
			$query = $this->db->get('user');

			if($query->num_rows == 1)
			{
				$row = $query->row();

				if($row->password == md5($password))
				{
					$data = array(
						'username' => $row->username,
						'tipe' => $row->tipe,
						'instansi' => $row->instansi,
						'validated' => true
						);

					$this->session->set_userdata($data);
					return 1;
				}
			}

			return 0;
		}

		public function getAllBerita($instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM berita ORDER BY created DESC";
			else
				$sqlstr = "SELECT * FROM berita WHERE instansi = '".$instansi."' ORDER BY created DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJumlahBerita($instansi = "ypki"){
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM berita";
			else
				$sqlstr = "SELECT * FROM berita WHERE instansi = '".$instansi."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getBerita($date,$judul = NULL){
			$judul = mysql_real_escape_string($judul);

			if($judul == NULL)
				$sqlstr = "SELECT * FROM berita WHERE id=".$date;
			else
				$sqlstr = "SELECT * FROM berita WHERE judul='".$judul."' AND MID(created,1,10) = '".$date."'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getLastBerita($limit, $page = NULL, $instansi = "ypki"){
			if($instansi == "ypki")
			{

				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM berita ORDER BY created DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM berita ORDER BY created DESC LIMIT ".$pos.",".$limit;
				}
			}
			else
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM berita WHERE instansi = '".$instansi."' ORDER BY created DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM berita WHERE instansi = '".$instansi."' ORDER BY created DESC LIMIT ".$pos.",".$limit;
				}	
			}

			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getBeritaByTahun($tahun, $instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM berita WHERE MID(created,1,4) = '".$tahun."' ORDER BY created DESC";
			else
				$sqlstr = "SELECT * FROM berita WHERE instansi = '".$instansi."' AND MID(created,1,4) = '".$tahun."' ORDER BY created DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getBeritaByLabel($label, $limit = NULL, $page = NULL, $instansi = "ypki"){

			if ($instansi == "ypki")
			{
				if($limit == NULL && $page == NULL)
				{
					$sqlstr = "SELECT DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita,label WHERE label.id = berita.id AND (label.nama = '".$label."' OR berita.instansi = '".$label."') ORDER BY berita.created DESC";				
				}
				else if($page == NULL)
				{
					$sqlstr = "SELECT DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita,label WHERE label.id = berita.id AND (label.nama = '".$label."' OR berita.instansi = '".$label."') ORDER BY berita.created DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT  DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita,label WHERE label.id = berita.id AND (label.nama = '".$label."' OR berita.instansi = '".$label."') ORDER BY berita.created DESC LIMIT ".$pos.",".$limit;
				}	
			}
			else
			{
				if($limit == NULL && $page == NULL)
				{
					$sqlstr = "SELECT DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita,label WHERE label.id = berita.id AND label.nama = '".$label."' AND berita.instansi = '".$instansi."' ORDER BY berita.created DESC";				
				}
				else if($page == NULL)
				{
					$sqlstr = "SELECT DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita,label WHERE label.id = berita.id AND label.nama = '".$label."' AND berita.instansi = '".$instansi."' ORDER BY berita.created DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT  DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita,label WHERE label.id = berita.id AND label.nama = '".$label."' AND berita.instansi = '".$instansi."' ORDER BY berita.created DESC LIMIT ".$pos.",".$limit;
				}		
			}
			
			$result = $this->db->query($sqlstr);

			$final = $result->result();
			
			return $final;
			
		}

		public function getBeritaByKeyword($key, $limit = NULL, $page = NULL, $instansi = "ypki"){
			$keys = explode(" ", $key);
			$sqlstr = "SELECT DISTINCT berita.id,berita.judul,berita.gambar,berita.konten,berita.created,berita.instansi FROM berita WHERE ";
			for ($i=0; $i < sizeof($keys) ; $i++)
			{ 
				if($i == 0)
					$sqlstr .= "(judul LIKE '%".$keys[$i]."%' OR konten LIKE '%".$keys[$i]."%'";
				else
					$sqlstr .= " OR judul LIKE '%".$keys[$i]."%' OR konten LIKE '%".$keys[$i]."%'";
			}

			if($instansi == "ypki") $sqlstr .= ") ORDER BY created DESC";
			else $sqlstr .= ") AND instansi='".$instansi."' ORDER BY created DESC";

			if($limit == NULL && $page == NULL)
			{
				
			}
			else if($page == NULL)
			{
				$sqlstr .= " LIMIT ".$limit;
			}
			else
			{
				$pos = ($page-1) * $limit;
				$sqlstr = " LIMIT ".$pos.",".$limit;
			}

			$result = $this->db->query($sqlstr);
			$row = $result->result();
			$final = array();

			foreach ($row as $key => $value)
			{
				$result = $this->getBerita($value->id);
				array_push($final, $result[0]);
			}
			return $final;
		}

		public function getJumlahBeritaByBulan($bulan, $instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM berita WHERE MID(created,6,2) = '".$bulan."'";
			else
				$sqlstr = "SELECT * FROM berita WHERE instansi = '".$instansi."' AND MID(created,6,2) = '".$bulan."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function addBerita($post, $files)
		{
			if(strpos($files["type"], "image") === false)
				return false;

			$post['judul'] = mysql_real_escape_string($post['judul']);

//			$post['konten'] = preg_replace('/[\xA0]/', ' ', $post['konten']);
//			$post['konten'] = preg_replace('/[\x80-\xFF]/', '', $post['konten']);
//			$post['konten'] = htmlspecialchars($post['konten']);
//			$post['konten'] = mysql_real_escape_string($post['konten']);
			$post['konten'] = trim(strip_tags($post['konten'], $this->allowed_tags));
			//$konten = nl2br($konten);

			if ( function_exists( 'date_default_timezone_set' ) )
				date_default_timezone_set('Asia/Jakarta');

			$waktu = date("YmdHis");

			$filex = explode('.',$files["name"]);
			$filex = array_reverse($filex);

			//$filex = substr($files["name"],strlen($files["name"])-4,4);

			$filename = $waktu.'.'.$filex[0];

			$upload = "./asset/berita/".$filename;

			$created = date("Y/m/d H:i:s");

			if(move_uploaded_file($files['tmp_name'], $upload))
			{
				//crop image---------------------------------------------------
				$size = getimagesize($upload);
				$img_width = $size[0];
				$img_height = $size[1];

				$config['image_library'] = 'gd2';
				$config['source_image']	= $upload;
				$config['maintain_ratio'] = FALSE;
				$config['x_axis']	= ($img_width - 600) / 2;
				$config['y_axis']	= ($img_height - 360) / 2;
				$config['width']	= 600;
				$config['height']	= 360;

				$this->load->library('image_lib', $config); 

				$this->image_lib->crop();

				//------------------------------------------------------------
				
				$sqlstr = "INSERT INTO gambar VALUES('','".$filename."','foto')";
				$result = $this->db->query($sqlstr);

				$sqlstr = "INSERT INTO berita VALUES('','".$post['judul']."','".$filename."','".$post['konten']."','".$created."','".$post['instansi']."')";
				$result = $this->db->query($sqlstr);

				$id = $this->getLastId("berita");

				if($post['label'] != "")
				{

					$label = $post['label'];
					$label = explode(",", $label);

					$sqlstr = "INSERT INTO label VALUES";
					$count = 0;

					foreach ($label as $key => $value)
					{
						if($count == 0)
							$sqlstr .= "(".$id.",'".trim($value)."')";
						else
							$sqlstr .= ",(".$id.",'".trim($value)."')";

						$count++;
					}
					$result = $this->db->query($sqlstr);	
				}

				return $id;
			}
			return false;
		}

		/*public function addBeritaLinked($post)
		{
			$sqlstr = "SELECT id FROM gambar WHERE nama = '".$post['link']."'";
			$result = $this->db->query($sqlstr);
			$row = $result->num_rows();

			if($row < 1) 
			{
				$sqlstr = "INSERT INTO gambar VALUES('','".$post['link']."','link')";
				$result = $this->db->query($sqlstr);
			}

			if ( function_exists( 'date_default_timezone_set' ) )
				date_default_timezone_set('Asia/Jakarta');

			$created = date("Y/m/d H:i:s");

			$post['judul'] = mysql_real_escape_string($post['judul']);

			$post['konten'] = preg_replace('/[\xA0]/', ' ', $post['konten']);
			$post['konten'] = preg_replace('/[\x80-\xFF]/', '', $post['konten']);
			$post['konten'] = htmlspecialchars($post['konten']);
			$post['konten'] = mysql_real_escape_string($post['konten']);

			$sqlstr = "INSERT INTO berita VALUES('','".$post['judul']."','".$post['link']."','".$post['konten']."','".$created."','".$post['instansi']."')";
			$result = $this->db->query($sqlstr);	

			if($post['label'] != "")
			{
				$id = $this->getLastId("berita");

				$label = $post['label'];
				$label = explode(",", $label);

				$sqlstr = "INSERT INTO label VALUES";
				$count = 0;

				foreach ($label as $key => $value)
				{
					if($count == 0)
						$sqlstr .= "(".$id.",'".$value."')";
					else
						$sqlstr .= ",(".$id.",'".$value."')";

					$count++;
				}
				$result = $this->db->query($sqlstr);	
			}

			return true;
		}*/

		public function updateBerita($post, $files)
		{
			$post['judul'] = mysql_real_escape_string($post['judul']);

			$konten = $post['konten'];
			/*$konten = preg_replace('/[\xA0]/', ' ', $konten);
			$konten = preg_replace('/[\x80-\xFF]/', '', $konten);
			$konten = htmlspecialchars($konten);
			$konten = mysql_real_escape_string($konten);*/
			$konten = trim(strip_tags($konten, $this->allowed_tags));
			//$konten = nl2br($konten);

			$waktu = date("YmdHis");

			$created = date("Y/m/d H:i:s");

			if ($files['size']>0)
			{
				if(strpos($files["type"], "image") === false)
					return false;

				$filex = substr($files["name"],strlen($files["name"])-4,4);
				$filename = $waktu.$filex;
				$upload = "./asset/img/".$filename;
				if(move_uploaded_file($files['tmp_name'], $upload))
				{
					$sqlstr = "INSERT INTO gambar VALUES('','".$filename."','foto')";
					$result = $this->db->query($sqlstr);
				}
				else
					return false;
			}
			else
			{
				$filename = $post['nama_gambar'];
			}

			$sqlstr = "UPDATE berita SET judul='".$post['judul']."', konten='".$konten."', gambar='".$filename."' WHERE id=".$post['id'];
			$result = $this->db->query($sqlstr);	

			$sqlstr = "DELETE FROM label WHERE id=".$post['id'];
			$result = $this->db->query($sqlstr);

			if($post['label'] != "")
			{
				$id = $post['id'];

				$label = $post['label'];
				$label = explode(",", $label);

				$sqlstr = "INSERT INTO label VALUES";
				$count = 0;
				foreach ($label as $key => $value)
				{
					if($count == 0)
						$sqlstr .= "(".$id.",'".trim($value)."')";
					else
						$sqlstr .= ",(".$id.",'".trim($value)."')";

					$count++;
				}
				$result = $this->db->query($sqlstr);	
			}

			return true;
		}

		/*public function updateBeritaLinked($post)
		{
			$post['judul'] = mysql_real_escape_string($post['judul']);

			$konten = $post['konten'];
			$konten = preg_replace('/[\xA0]/', ' ', $konten);
			$konten = preg_replace('/[\x80-\xFF]/', '', $konten);
			$konten = htmlspecialchars($konten);
			$konten = mysql_real_escape_string($konten);

			$sqlstr = "SELECT id FROM gambar WHERE nama = '".$post['link']."'";
			$result = $this->db->query($sqlstr);
			$row = $result->num_rows();

			if($row < 1) 
			{
				$sqlstr = "INSERT INTO gambar VALUES('','".$post['link']."','link')";
				$result = $this->db->query($sqlstr);
			}

			$sqlstr = "UPDATE berita SET judul='".$post['judul']."', konten='".$konten."', gambar='".$post['link']."' WHERE id=".$post['id'];
			$result = $this->db->query($sqlstr);	

			$sqlstr = "DELETE FROM label WHERE id=".$post['id'];
			$result = $this->db->query($sqlstr);

			if($post['label'] != "")
			{
				$id = $post['id'];

				$label = $post['label'];
				$label = explode(",", $label);

				$sqlstr = "INSERT INTO label VALUES";
				$count = 0;
				foreach ($label as $key => $value)
				{
					if($count == 0)
						$sqlstr .= "(".$id.",'".$value."')";
					else
						$sqlstr .= ",(".$id.",'".$value."')";

					$count++;
				}
				$result = $this->db->query($sqlstr);	
			}

			return true;
		}*/

		public function getNewBerita()
		{
			$sqlstr = "SELECT * FROM berita ORDER BY id DESC LIMIT 1";
			$result = $this->db->query($sqlstr);
			return $result->result();	
		}

		public function getTipeGambar($gambar)
		{
			$sqlstr = "SELECT tipe FROM gambar WHERE nama = '".$gambar."'";
			$result = $this->db->query($sqlstr);
			$row = $result->result();
			return $row[0]->tipe;	
		}

		public function getLastId($table)
		{
			$sqlstr = "SELECT id FROM ".$table." ORDER BY id DESC LIMIT 1";
			$result = $this->db->query($sqlstr);
			$row = $result->result();
			if(!empty($row)) return $row[0]->id;
			else return 0;
		}

		public function getLabel($id)
		{
			$sqlstr = "SELECT nama FROM label WHERE id = ".$id;
			$result = $this->db->query($sqlstr);	
			return $result->result();
		}

		public function getLabelString($id)
		{
			$sqlstr = "SELECT nama FROM label WHERE id = ".$id;
			$result = $this->db->query($sqlstr);
			$row = $result->result();

			$label = "";
			$count = 0;
			foreach ($row as $key => $value)
			{
				if($count==0)
					$label.=$value->nama;
				else
					$label.=",".$value->nama;
				$count++;
			}

			return $label;
		}

		public function deleteBerita($id)
		{
			$sqlstr = "DELETE FROM berita WHERE id=".$id;
			$result = $this->db->query($sqlstr);
			if($result)
				return true;
			else return false;
		}		

		public function getAllAgenda($instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda ORDER BY tanggal DESC";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' ORDER BY tanggal DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getAgendaByTahun($tahun, $instansi = "ypki"){
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,4) = '".$tahun."' ORDER BY tanggal DESC";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,4) = '".$tahun."' ORDER BY tanggal DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJumlahAgendaByBulan($bulan, $instansi = "ypki"){
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,6,2) = '".$bulan."'";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,6,2) = '".$bulan."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getLastAgenda($limit, $page = NULL, $instansi = "ypki"){
			if ($instansi == "ypki")
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda ORDER BY tanggal DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda ORDER BY tanggal DESC LIMIT ".$pos.",".$limit;
				}
			}
			else
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' ORDER BY tanggal DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' ORDER BY tanggal DESC LIMIT ".$pos.",".$limit;
				}	
			}
			

			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function addAgenda($post)
		{
			$psot['konten'] = strip_tags($post['konten'], $this->allowed_tags);
			$sqlstr = "INSERT INTO agenda VALUES('','".$post['judul']."','".$post['tanggal']."','".$post['konten']."','".$post['instansi']."')";
			$result = $this->db->query($sqlstr);

			return true;
		}

		public function getNewAgenda()
		{
			$sqlstr = "SELECT * FROM agenda ORDER BY id DESC LIMIT 1";
			$result = $this->db->query($sqlstr);
			return $result->result();	
		}

		public function updateAgenda($post)
		{
			$post['judul'] = mysql_real_escape_string($post['judul']);
			
			$sqlstr = "UPDATE agenda SET nama='".$post['judul']."', deskripsi='".$post['konten']."', tanggal='".$post['tanggal']."' WHERE id=".$post['id'];
			$result = $this->db->query($sqlstr);	

			return true;
		}

		public function getAgenda($date,$judul = NULL){

			$date = str_replace("/", "+", $date);

			$judul = mysql_real_escape_string($judul);

			if($judul == NULL)
				$sqlstr = "SELECT * FROM agenda WHERE id=".$date;
			else
				$sqlstr = "SELECT * FROM agenda WHERE nama='".$judul."' AND tanggal= '".$date."'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function deleteAgenda($id)
		{
			$sqlstr = "DELETE FROM agenda WHERE id=".$id;
			$result = $this->db->query($sqlstr);
			if($result)
				return true;
			else return false;
		}

		public function getJumlahAgenda($instansi = "ypki"){
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getNextEvents($date, $limit, $instansi = "ypki"){
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda WHERE tanggal >= '".$date."' ORDER BY tanggal DESC LIMIT ".$limit;
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND tanggal >= '".$date."' ORDER BY tanggal DESC LIMIT ".$limit;
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getAgendaNow($date, $limit, $page = NULL, $instansi = "ypki"){

			if($instansi == "ypki")
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) = '".$date."' ORDER BY tanggal ASC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) = '".$date."' ORDER BY tanggal ASC LIMIT ".$pos.",".$limit;
				}	
			}
			else
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) = '".$date."' ORDER BY tanggal ASC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) = '".$date."' ORDER BY tanggal ASC LIMIT ".$pos.",".$limit;
				}		
			}

			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJumlahAgendaNow($date, $instansi = "ypki"){

			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) = '".$date."'";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) = '".$date."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getAgendaPrev($date, $limit, $page = NULL, $instansi = "ypki"){

			if($instansi == "ypki")
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) < '".$date."' ORDER BY tanggal DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) < '".$date."' ORDER BY tanggal DESC LIMIT ".$pos.",".$limit;
				}	
			}
			else
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) < '".$date."' ORDER BY tanggal DESC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) < '".$date."' ORDER BY tanggal DESC LIMIT ".$pos.",".$limit;
				}	
			}

			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJumlahAgendaPrev($date, $instansi = "ypki"){

			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) < '".$date."'";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) = '".$date."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getAgendaNext($date, $limit, $page = NULL, $instansi = "ypki"){

			if($instansi == "ypki")
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) > '".$date."' ORDER BY tanggal ASC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) > '".$date."' ORDER BY tanggal ASC LIMIT ".$pos.",".$limit;
				}	
			}
			else
			{
				if ($page == NULL)
				{
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) > '".$date."' ORDER BY tanggal ASC LIMIT ".$limit;
				}
				else
				{
					$pos = ($page-1) * $limit;
					$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) > '".$date."' ORDER BY tanggal ASC LIMIT ".$pos.",".$limit;
				}	
			}

			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJumlahAgendaNext($date, $instansi = "ypki"){
			
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM agenda WHERE MID(tanggal,1,7) > '".$date."'";
			else
				$sqlstr = "SELECT * FROM agenda WHERE instansi = '".$instansi."' AND MID(tanggal,1,7) = '".$date."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getCol($col, $table, $id){
			
			$sqlstr = "SELECT ".$col." FROM ".$table." WHERE id = ". $id;
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getProfil($task, $instansi = "ypki"){
			$this->db->where('instansi', $instansi);
			if($task == 'visi_misi') $this->db->select('visi, misi');
			else $this->db->select($task);
			$query = $this->db->get('profil');
			return $query->result();
		}		

		public function updateProfil($task, $instansi = "ypki", $post){
			if($task == 'visi_misi') {
				$data = array(
					'visi' => $post['visi'],
					'misi' => $post['misi']
				);
			} else {
				$data = array(
					$task => $post[$task]
				);
			}
			$this->db->where('instansi', $instansi);
			$this->db->update('profil', $data);
			return true;
		}	

		public function getLog($instansi = "ypki", $page = NULL){
			
			if ($page == NULL)
			{
				$sqlstr = "SELECT * FROM log WHERE instansi = '".$instansi."' ORDER BY date DESC LIMIT ".$limit;
			}
			else
			{
				$pos = ($page-1) * $limit;
				$sqlstr = "SELECT * FROM log WHERE instansi = '".$instansi."' ORDER BY date DESC LIMIT ".$pos.",".$limit;
			}	
			$result = $this->db->query($sqlstr);
			return $result->result();
		}		

		public function addJudulAlbum($post, $directory){
			$created = date("Y/m/d H:i:s");
			$sqlstr = "INSERT INTO album VALUES('','".$post['judul']."','".$directory."','".$created."','".$post['instansi']."')";
			$result = $this->db->query($sqlstr);

			return true;
		}

		public function getAllAlbum($instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM album ORDER BY created DESC";
			else
				$sqlstr = "SELECT * FROM album WHERE instansi = '".$instansi."' ORDER BY created DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getAlbum($directory){
			$sqlstr = "SELECT * FROM album WHERE directory='".$directory."'";
			
			$result = $this->db->query($sqlstr);

			return $result->row_array();
		}

		public function getAlbumById($id){
			$sqlstr = "SELECT * FROM album WHERE id='".$id."'";
			
			$result = $this->db->query($sqlstr);

			return $result->row_array();
		}

		public function getAlbumByTahun($tahun, $instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM album WHERE MID(created,1,4) = '".$tahun."' ORDER BY created DESC";
			else
				$sqlstr = "SELECT * FROM album WHERE instansi = '".$instansi."' AND MID(created,1,4) = '".$tahun."' ORDER BY created DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJudulAlbumByDirectory($directory, $instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM album WHERE directory = '".$directory."' ORDER BY created DESC";
			else
				$sqlstr = "SELECT * FROM album WHERE instansi = '".$instansi."' AND directory = '".$directory."' ORDER BY created DESC";
			$result = $this->db->query($sqlstr);
			$row 	= $result->result();
			return $row[0]->judul;
		}

		public function getJumlahAlbumByBulan($bulan, $instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM album WHERE MID(created,6,2) = '".$bulan."'";
			else
				$sqlstr = "SELECT * FROM album WHERE instansi = '".$instansi."' AND MID(created,6,2) = '".$bulan."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function deleteAlbum($id)
		{
			$sqlstr = "DELETE FROM album WHERE id=".$id;
			$result = $this->db->query($sqlstr);
			if($result)
				return true;
			else return false;
		}

		public function getAllFirman($instansi = "ypki"){
			if ($instansi == "ypki")
				$sqlstr = "SELECT * FROM firman ORDER BY created DESC";
			else
				$sqlstr = "SELECT * FROM firman WHERE instansi = '".$instansi."' ORDER BY created DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function addFirman($konten, $tgl, $ins)
		{
			if(!empty($konten) && !empty($tgl)) {
                $data = array(
                    'firman' => $konten,
                    'created' => $tgl,
                    'instansi' => $ins
                );
                $this->db->insert('firman', $data);
                return true;
            }
            else return false;
		}

		public function getJumlahFirman($instansi = "ypki"){
			if($instansi == "ypki")
				$sqlstr = "SELECT * FROM firman";
			else
				$sqlstr = "SELECT * FROM firman WHERE instansi = '".$instansi."'";
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

		public function getNewFirman($id)
		{
			$sqlstr = "SELECT id FROM firman ORDER BY id DESC LIMIT ".$id;
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getFirmanByTanggal($tgl) {
			$query = 'SELECT firman FROM firman WHERE created = '.$tgl;
			$result = $this->db->query($query);
			return $result->result();
		}

        public function getFirmanByTahun($tahun, $instansi = "ypki"){
            if ($instansi == "ypki")
                $sqlstr = "SELECT * FROM firman WHERE MID(created,1,4) = '".$tahun."' ORDER BY created DESC";
            else
                $sqlstr = "SELECT * FROM firman WHERE instansi = '".$instansi."' AND MID(created,1,4) = '".$tahun."' ORDER BY created DESC";
            $result = $this->db->query($sqlstr);
            return $result->result();
        }

        public function getJumlahFirmanByBulan($bulan, $instansi = "ypki"){
            if ($instansi == "ypki")
                $sqlstr = "SELECT * FROM firman WHERE MID(created,6,2) = '".$bulan."'";
            else
                $sqlstr = "SELECT * FROM firman WHERE instansi = '".$instansi."' AND MID(created,6,2) = '".$bulan."'";
            $result = $this->db->query($sqlstr);
            return $result->num_rows();
        }

        public function getFirman($id){
            if(!empty($id)) {
                $query = $this->db->get_where('firman', array('id' => $id));
                return $query->result();
            }
        }

		public function getFirmanToday($today){
			if(!empty($today)) {
				$found = false;
				while(!$found){
					$query = 'SELECT firman, created FROM firman WHERE created = "'.$today.'" ORDER BY created DESC LIMIT 1';
					$result = $this->db->query($query);
					if(count($result->result()) == 0){
						$timestamp = strtotime($today . " - 1 day");
						$today = date("Y-m-d",$timestamp);
					}
					else{
						$found = true;
					}

				}
				return $result->result();
			}
		}

		public function deleteFirman($id)
		{
			$sqlstr = "DELETE FROM firman WHERE id=".$id;
			$result = $this->db->query($sqlstr);
			if($result)
				return true;
			else return false;
		}

		public function getKontak($instansi = "ypki"){

			$sqlstr = "SELECT * FROM kontak WHERE instansi = '". $instansi. "'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function updateKontak($instansi = "ypki", $post){
			$sqlstr = "SELECT * FROM kontak WHERE instansi = '".$instansi."'";
			$is_exist = $this->db->query($sqlstr);
			$is_exist = $is_exist->result();

			if($is_exist) {
				$sqlstr = "UPDATE kontak SET
							alamat = '" . $post['alamat'] . "',
							telepon1 = '" . $post['telp1'] . "',
							telepon2 = '" . $post['telp2'] . "',
							fax = '" . $post['fax'] . "',
							email = '" . $post['email'] . "',
							website = '" . $post['web'] . "'
						  WHERE instansi = '" . $instansi . "'";
				$result = $this->db->query($sqlstr);
			} else {
				$sqlstr = "INSERT INTO kontak
								VALUES('', '".$post['alamat']."', '".$post['telp1']."' ,'".$post['telp2']."',
								'".$post['fax']."', '".$post['email']."', '".$post['web']."', '".$instansi."')";
				$result = $this->db->query($sqlstr);
			}
			return true;
		}

		public function getFasilitas($instansi = "ypki"){

			$sqlstr = "SELECT * FROM fasilitas WHERE instansi = '". $instansi. "'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function updateFasilitas($instansi = "ypki", $post){
			$this->db->update('fasilitas', array('aktif' => 0), array('instansi' => $instansi));

			foreach ($post as $jenis => $deskripsi) {
				if($jenis != 'submit') {
					if (!preg_match('/_aktif/', $jenis)) {
						$is_exist = $this->db->get_where('fasilitas', array('jenis' => $jenis, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jenis);
							$this->db->update('fasilitas', array('deskripsi' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('fasilitas');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_kurikulum = array(
								'id' => $id,
								'jenis' => $jenis,
								'deskripsi' => $deskripsi,
								'aktif' => 0,
								'instansi' => $instansi
							);
							$this->db->insert('fasilitas', $insert_kurikulum);
						}
					} else {
						$jns = str_replace('_aktif', '', $jenis);
						$is_exist = $this->db->get_where('fasilitas', array('jenis' => $jns, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jns);
							$this->db->update('fasilitas', array('aktif' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('fasilitas');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_kurikulum = array(
								'id' => $id,
								'jenis' => $jns,
								'aktif' => $deskripsi,
								'instansi' => $instansi
							);
							$this->db->insert('fasilitas', $insert_kurikulum);
						}
					}
				}
			}
			return true;
		}

		public function getKurikulum($instansi = "ypki"){

			$sqlstr = "SELECT * FROM kurikulum WHERE instansi = '". $instansi. "'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function updateKurikulum($instansi = "ypki", $post){
			$this->db->update('kurikulum', array('aktif' => 0), array('instansi' => $instansi));

			foreach ($post as $jenis => $deskripsi) {
				if($jenis != 'submit') {
					if (!preg_match('/_aktif/', $jenis)) {
						$is_exist = $this->db->get_where('kurikulum', array('jenis' => $jenis, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jenis);
							$this->db->update('kurikulum', array('deskripsi' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('kurikulum');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_kurikulum = array(
								'id' => $id,
								'jenis' => $jenis,
								'deskripsi' => $deskripsi,
								'aktif' => 0,
								'instansi' => $instansi
							);
							$this->db->insert('kurikulum', $insert_kurikulum);
						}
					} else {
						$jns = str_replace('_aktif', '', $jenis);
						$is_exist = $this->db->get_where('kurikulum', array('jenis' => $jns, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jns);
							$this->db->update('kurikulum', array('aktif' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('kurikulum');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_kurikulum = array(
								'id' => $id,
								'jenis' => $jns,
								'aktif' => $deskripsi,
								'instansi' => $instansi
							);
							$this->db->insert('kurikulum', $insert_kurikulum);
						}
					}
				}
			}
			return true;
		}

		public function getPersonalia($instansi = "ypki"){

			$sqlstr = "SELECT * FROM personalia WHERE instansi = '". $instansi. "'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function updatePersonalia($instansi = "ypki", $post){
			$this->db->update('personalia', array('aktif' => 0), array('instansi' => $instansi));

			foreach ($post as $jenis => $deskripsi) {
				if($jenis != 'submit') {
					if (!preg_match('/_aktif/', $jenis)) {
						$is_exist = $this->db->get_where('personalia', array('jenis' => $jenis, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jenis);
							$this->db->update('personalia', array('deskripsi' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('personalia');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_personalia = array(
								'id' => $id,
								'jenis' => $jenis,
								'deskripsi' => $deskripsi,
								'aktif' => 0,
								'instansi' => $instansi
							);
							$this->db->insert('personalia', $insert_personalia);
						}
					} else {
						$jns = str_replace('_aktif', '', $jenis);
						$is_exist = $this->db->get_where('personalia', array('jenis' => $jns, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jns);
							$this->db->update('personalia', array('aktif' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('personalia');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_personalia = array(
								'id' => $id,
								'jenis' => $jns,
								'aktif' => $deskripsi,
								'instansi' => $instansi
							);
							$this->db->insert('personalia', $insert_personalia);
						}
					}
				}
			}
			return true;
		}

		public function getKesiswaan($instansi = "ypki"){

			$sqlstr = "SELECT * FROM kesiswaan WHERE instansi = '". $instansi. "'";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function updateKesiswaan($instansi = "ypki", $post){
			$this->db->update('kesiswaan', array('aktif' => 0), array('instansi' => $instansi));

			foreach ($post as $jenis => $deskripsi) {
				if($jenis != 'submit') {
					if (!preg_match('/_aktif/', $jenis)) {
						$is_exist = $this->db->get_where('kesiswaan', array('jenis' => $jenis, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jenis);
							$this->db->update('kesiswaan', array('deskripsi' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('kesiswaan');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_kesiswaan = array(
								'id' => $id,
								'jenis' => $jenis,
								'deskripsi' => $deskripsi,
								'aktif' => 0,
								'instansi' => $instansi
							);
							$this->db->insert('kesiswaan', $insert_kesiswaan);
						}
					} else {
						$jns = str_replace('_aktif', '', $jenis);
						$is_exist = $this->db->get_where('kesiswaan', array('jenis' => $jns, 'instansi' => $instansi));
						$is_exist = $is_exist->result();

						if ($is_exist) {
							$this->db->where('instansi', $instansi);
							$this->db->where('jenis', $jns);
							$this->db->update('kesiswaan', array('aktif' => $deskripsi));
						} else {
							$this->db->where('instansi', $instansi);
							$this->db->select_max('id');
							$last_id = $this->db->get('kesiswaan');
							$last_id = $last_id->result();
							$id = $last_id[0]->id + 1;

							$insert_kesiswaan = array(
								'id' => $id,
								'jenis' => $jns,
								'aktif' => $deskripsi,
								'instansi' => $instansi
							);
							$this->db->insert('kesiswaan', $insert_kesiswaan);
						}
					}
				}
			}
			return true;
		}

		public function getAllProgram() {
	        $program = array();
	        $query = $this->db->get('program');
	        $results = $query->result();
	        foreach($results as $result) {
	            $program[$result->instansi] = $result->aktif;
	        }
	        return $program;

	    }

	    public function getProgram($instansi) {
	        $this->db->where('instansi', $instansi);
	        $query = $this->db->get('program');
	        return $query->result();
	    }

	    public function addProgram($instansi, $post) {
	        $program_aktif = !empty($post['program_aktif']) ? $post['program_aktif'] : 0;
	        $this->db->insert('program',
	            array(
	                'program' => $post['program'],
	                'instansi' => $instansi,
	                'aktif' => $program_aktif
	            ));
	        return true;
	    }

	    public function updateProgram($instansi, $post) {
	        $program_aktif = !empty($post['program_aktif']) ? $post['program_aktif'] : 0;
	        $this->db->where('instansi', $instansi);
	        $this->db->update('program',
	            array(
	                'program' => $post['program'],
	                'aktif' => $program_aktif,
	            ));
	        return true;
	    }

	    public function addPesan($instansi, $post) {
	        $this->db->insert('pesan',
	            array(
	                'nama' => $post['nama'],
	                'email' => $post['email'],
	                'telepon' => $post['phone'],
	                'message' => $post['pesan'],
	                'instansi' => $instansi,
	                'waktu' => strtotime('now'),
	                'flag_read' => 0
	            ));
	        return true;
	    }

	    public function getPesan($instansi) {
	    	$this->db->where('flag_read', 0);
	    	$this->db->where('instansi', $instansi);
	    	$this->db->order_by('waktu', 'desc');
	        $query = $this->db->get('pesan');
	        return $query->result();
	    }

	    public function getAllPesan($instansi = "ypki"){
			$sqlstr = "SELECT * FROM pesan WHERE instansi = '".$instansi."' ORDER BY waktu DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getPesanById($id) {
	    	$this->db->where('id', $id);
	    	$this->db->order_by('waktu', 'desc');
	        $query = $this->db->get('pesan');
	        return $query->result();
	    }

		public function getPesanByTahun($tahun, $instansi = "ypki"){
			$sqlstr = "SELECT * FROM pesan WHERE instansi = '".$instansi."' AND FROM_UNIXTIME(waktu, '%Y') = '".$tahun."' ORDER BY waktu DESC";
			$result = $this->db->query($sqlstr);
			return $result->result();
		}

		public function getJumlahPesanByBulan($bulan, $instansi = "ypki"){
			$sqlstr = "SELECT * FROM pesan WHERE instansi = '".$instansi."' AND FROM_UNIXTIME(waktu, '%m') = ".$bulan;
			$result = $this->db->query($sqlstr);
			return $result->num_rows();
		}

	    public function updateAllPesanFlagRead($instansi, $flag = 1) {
	    	$this->db->where('instansi', $instansi);
	        $this->db->update('pesan',
	            array(
	                'flag_read' => $flag
	            ));
	        return true;
	    }
	}
	
?>