<div id="content">
	
	<div class="row" id="judul-daftar">
		<div class="col-xs-12">
			<span>Dokumentasi <?php echo strtoupper($instansi);?></span>
		</div>
	</div>
	<?php
	if(isset($list_dokumentasi)){
		if(count($list_dokumentasi) > 0){
			foreach($list_dokumentasi as $dokumentasi){
				$dir = 'asset/album/'.$dokumentasi->directory;
				if (is_dir($dir)){
					if ($dh = opendir($dir)){
						$image_src = "";
						$count_file = 0;
						while (($file = readdir($dh)) !== false){
							if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store'){
								if($image_src == ""){
									$image_src = base_url().'/'.$dir.'/'.$file;
								}
								$count_file++;
							}
				    	}
				    	closedir($dh);
				  	}
				}
				//print_r(getimagesize($image_src));
				$image_size = getimagesize($image_src);
				if($image_size[0] <= $image_size[1])
					$size = 'width="275"';
				else
					$size = 'height="215"';
				if($instansi == "ypki")
					echo '<a href="/dokumentasi/'.$dokumentasi->directory.'">';
				else
					echo '<a href="/'.$instansi.'/dokumentasi/'.$dokumentasi->directory.'">';
				echo '<div class="dokumentasi-inner-border">';
				echo '<div class="dokumentasi-list-title">';
				echo '<strong>'.$dokumentasi->judul.'</strong><br/>';
				echo '('.$count_file . ' foto)	';
				echo '</div>';
				echo '<div class="dokumentasi-list-image-wrapper">';
				echo '<img src="'.$image_src.'" '.$size.'/><br/>';
				echo '</div>';
				echo '</a>';
				echo '</div>';
			}
		}
		else{
			echo "Tidak ada dokumentasi.";
		}
	}
	else{
		echo '<a href="/'.$instansi.'/dokumentasi"><< Kembali ke Daftar Dokumentasi</a>';
		echo '<h2>'.$judul.'</h2>';
		echo '<div class="grid">';
		$dir = 'asset/album/'.$directory;
		if (is_dir($dir)){
			if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
                    $count=0;
					if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store'){
						$count++;
						$image_src = base_url().$dir.'/'.$file;
						echo '
                            <div class="grid-item">
                            	<img src="'.$image_src.'" alt="">
                            </div>
                            ';
					}
		    	}
		    	closedir($dh);
		  	}
		}
		echo '</div>';
		echo '<br/><a href="/'.$instansi.'/dokumentasi"><< Kembali ke Daftar Dokumentasi</a>';
		echo '<br/><br/>';
	}
	?>
</div>