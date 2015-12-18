<div id="content">
	
	<div class="row" id="judul-daftar">
		<div class="col-xs-12">
			<span>Dokumentasi <?php echo strtoupper($instansi);?></span>
		</div>
	</div>
	<?php
	if(isset($list_dokumentasi)){
		foreach($list_dokumentasi as $dokumentasi){
			$dir = 'asset/album/'.$dokumentasi->directory;
			if (is_dir($dir)){
				if ($dh = opendir($dir)){
					while (($file = readdir($dh)) !== false){
						if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store'){
							$image_src = base_url().'/'.$dir.'/'.$file;
							break;
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
			echo '<div class="dokumentasi-outer-border">';
			echo '<a href="/'.$instansi.'/dokumentasi/'.$dokumentasi->directory.'">';
			echo '<div class="dokumentasi-inner-border">';
			echo '<div class="dokumentasi-list-image-wrapper">';
			echo '<img src="'.$image_src.'" '.$size.'/><br/>';
			echo '</div>';
			echo '</div>';
			echo '<h3><strong>'.$dokumentasi->judul.'</strong></h3>';
			echo '</a>';
			echo '</div>';
		}
	}
	else{
		echo '<a href="/'.$instansi.'/dokumentasi"><< Kembali ke Daftar Dokumentasi</a>';
		echo '<h2>'.$judul.'</h2>';
		echo '<div class="gallery" id="images_preview">';
		$dir = 'asset/album/'.$directory;
		if (is_dir($dir)){
			if ($dh = opendir($dir)){
				while (($file = readdir($dh)) !== false){
                    $count=0;
					if($file != '' && $file != '.' && $file != '..' && $file != '.DS_Store'){
						$count++;
						$image_src = base_url().$dir.'/'.$file;
						echo '
                            <div class="reorder_ul reorder-photos-list" style="width:285px; height: 335px; float:left">
                              <div id="image_li_'.$count.'" class="ui-sortable-handle">
                                  <a href="javascript:void(0);" style="float:none;" class="image_link"><img src="'.$image_src.'" alt=""></a>
                                </div>
                            </div>
                            ';
					}
		    	}
		    	closedir($dh);
		  	}
		}
		echo '</div>';
		echo '<a href="/'.$instansi.'/dokumentasi"><< Kembali ke Daftar Dokumentasi</a>';
		echo '<br/><br/>';
	}
	?>
</div>