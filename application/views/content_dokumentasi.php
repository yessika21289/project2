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
								if(strpos($file, 'cover') !== false){
									$image_src = base_url().'/'.$dir.'/'.$file;
								}
								elseif(strpos($file, 'thumb') !== false){
									$count_file++;
								}
							}
				    	}
				    	closedir($dh);
				  	}
				}
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
				echo '<img src="'.$image_src.'" /><br/>';
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
					if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store' &&
                       strpos($file, 'cover') === false && strpos($file, 'thumb') === false){
						$count++;
						$image_src_thumb = base_url().$dir.'/thumb_'.$file;
						$image_src_zoom = base_url().$dir.'/'.$file;
						echo '
                            <div class="grid-item">
	                            <a href="'.$image_src_zoom.'" data-toggle="lightbox" data-title="'.$judul.'" data-gallery="'.$judul.'">
	                            	<img src="'.$image_src_thumb.'" data-src="'.$file.'" alt="'.$judul.'">
	                            </a>
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