<div id="content">
	<div id="content-left">
		<?php
			$this->load->view("carousel");
		?>

		<div id="firman">
			<div class="firman-img">
				<div class="thumbs">
					<img class="crop" src=" <?php echo base_url()."asset/img/firman.png" ?> " />
				</div>
			</div>
			<div class="firman-content">
				<span class="title">FIRMAN TUHAN HARI INI</span>
				<br/>
				<span class="content">
					<?php
						echo $firman;
					?>
				</span>
			</div>
		</div>

	</div>
	<div id="content-right">

		<?php $this->load->view("div_login") ?>

		<?php $this->load->view("div_berita") ?>

		<?php $this->load->view("div_agenda") ?>

	</div>

	<div class="clear"></div>
	
</div>