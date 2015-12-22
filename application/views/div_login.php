<!-- <div id="div-login">

	<?php
		/*$tipe = $this->session->userdata('tipe');
		if (!empty( $tipe ))
		{
			echo "<div class='welcome'>";
			echo "Selamat datang, <span class='username'>".$this->session->userdata('username')."</span>";
			echo " di Website Yayasan Perguruan Kristen Indonesia ";
			echo "<div class='logout'><button>log out</button></div>";
			echo "</div>";*/
	?>
	<?php
		//}else{
	?>

	<div class="title">LOGIN</div>

	<form role="form" action=" <?php echo base_url()."login/process" ?> " method="post">
		<div class="form-group">
		    <div class="input-group">

		    	<input type="text" class="form-control" id="inputUsersname" name="username" placeholder="Username">
			    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
		    	<button type="submit" class="btn-login">LOGIN</button>

		    </div>
		</div>
	</form>

	<?php
		//}
	?>

</div> -->