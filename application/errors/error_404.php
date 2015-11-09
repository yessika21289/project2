<!DOCTYPE html>
<html lang="en">
<head>
<title>Maaf, halaman tidak tersedia</title>

<link rel="icon" href="<?php echo '/ypki/asset/img/favicon.ico'; ?>" />

<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

#container {
	padding: 50px 0px;
	margin-top: 50px;
	margin-left: auto;
	margin-right: auto;
	width: 960px;
	height: 100px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
	text-align: center;
}

span.judul {
	font-size: 30px;
}

button {
	border: 0 solid;
	background-color: rgb(64,179,223);
	color: #fff;
	padding: 5px;
	font-size: 20px;
	cursor: pointer;
}

</style>
</head>
<body>
	<div id="container">
		<span class="judul">Maaf, halaman ini tidak tersedia</span>
		<br/>
		<br/>
		<br/>
		<button onclick="goBack()">Halaman Sebelumnya</button>
		<a href="/ypki/"><button>Home</button></a>
	</div>
	<script>
		function goBack() {
		    window.history.back()
		}
	</script>
</body>
</html>