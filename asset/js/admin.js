$(document).ready(function(){

	jQuery("span.timeago").timeago();

	var berita = false;
	var agenda = false;
	var firman = false;
	var album 	= false;

	if($(".page-type").val() == "agenda") agenda = true;
	if($(".page-type").val() == "berita") berita = true;
	if($(".page-type").val() == "firman") firman = true;
	if($(".page-type").val() == "album") album = true;

	/*
		ADMIN SCRIPT
	*/

	$(".list-berita .list-group").hide();
	$(".list-berita .vsb").show();

	$(".list-berita span.hapus").click(function(){
		var id = $(this).attr("id").substr(1);

		var judul = $("span#j"+id).html();
		$(".modal-body .judul").html(judul);

		var link = $(".href").html();
		if(berita) link += "admin/berita/hapus/"+id;
		else if(agenda) link += "admin/agenda/hapus/"+id;
		else if(album) link += "admin/album/hapus/"+id;

		$(".modal-footer .link_hapus").attr("href",link);
	});

	$(".berita-select").change(function(){
		var tahun = $(this).val();
		$(".list-berita .list-group").hide();
		$(".list-berita .y"+tahun).show();
	});

	$(".firman-select").change(function(){
		var tahun = $(this).val();
		$(".list-firman .list-group").hide();
		$(".list-firman .y"+tahun).show();
	});

	$(".list-firman .list-group").hide();
	$(".list-firman .vsb").show();

	$(".list-firman span.hapus").click(function(){
		var id = $(this).attr("id").substr(1);

		var tanggal = $("span#t"+id).html();
		$(".modal-body .tanggal").html(tanggal);

		var link = $(".href").html();
		if(firman) link += "admin/firman/hapus/"+id;

		$(".modal-footer .link_hapus").attr("href",link);
	});


	/*
		END OF ADMIN SCRIPT
	*/

	var bbJudul = false;
	var bbGambar = false;
	var bbTanggal = false;

	$(".error-judul").hide();
	$(".error-gambar").hide();
	$(".error-link").hide();
	$(".error-tanggal").hide();

	if ($("#form-berita-baru .input-gambar").attr("value"))
	{
		bbGambar = true;
	}

	if ($("#form-berita-baru .input-judul").val() != "")
	{
		bbJudul = true;
	}

	if (berita && $("#form-berita-baru .input-judul").val()!="" && $("#form-berita-baru .input-gambar").attr("value") != "")
	{
		$("#form-berita-baru .input-submit").removeAttr("disabled");
	}

	if (agenda && $("#form-berita-baru .input-judul").val()!="" && $("#form-berita-baru .input-tanggal").val() != "")
	{
		$("#form-berita-baru .input-submit").removeAttr("disabled");
	}
	if (album && $("#form-album-baru .input-judul").val()!="")
	{
		$("#form-album-baru .input-submit").removeAttr("disabled");
	}

	$("#form-berita-baru .input-judul").focusout(function(){
		if ($(this).val() == "")
		{
			bbJudul = false;
			$(this).parent().addClass("has-error");
			$(".error-judul").show();
		}
		else
		{
			bbJudul = true;
			$(this).parent().removeClass("has-error");
			$(".error-judul").hide();
		}
		if(berita && bbJudul && bbGambar)
			$("#form-berita-baru .input-submit").removeAttr("disabled");
		else if(agenda && bbJudul && bbTanggal)
			$("#form-berita-baru .input-submit").removeAttr("disabled");
		else
			$("#form-berita-baru .input-submit").attr("disabled","");
	});

	$("#form-berita-baru .input-tanggal").focusout(function(){
		if ($(this).val() == "")
		{
			bbTanggal = false;
			$(this).parent().addClass("has-error");
			$(".error-tanggal").show();
		}
		else
		{
			bbTanggal = true;
			$(this).parent().removeClass("has-error");
			$(".error-tanggal").hide();
		}
		if(bbJudul && bbTanggal)
			$("#form-berita-baru .input-submit").removeAttr("disabled");
		else
			$("#form-berita-baru .input-submit").attr("disabled","");
	});

	$("#form-album-baru .input-judul").focusout(function(){
		if ($(this).val() == "")
		{
			$(this).parent().addClass("has-error");
			$(".error-judul").show();
			$("#form-album-baru .input-submit").attr("disabled","");
		}
		else
		{
			$(this).parent().removeClass("has-error");
			$(".error-judul").hide();
			$("#form-album-baru .input-submit").removeAttr("disabled");
		}
	});

	$("#form-berita-baru .input-gambar").change(function(){
		if ($(this).val() == "")
		{
			bbGambar = false;
			$(this).parent().addClass("has-error");
			$(".error-gambar").show();
		}
		else
		{
			bbGambar = true;
			$(this).parent().removeClass("has-error");
			$(".error-gambar").hide();
		}
		if(bbJudul && bbGambar)
			$("#form-berita-baru .input-submit").removeAttr("disabled");
		else
			$("#form-berita-baru .input-submit").attr("disabled","");
	});

	$("#form-berita-baru .input-link").change(function(){
		if ($(this).val() == "")
		{
			bbGambar = false;
			$(this).parent().addClass("has-error");
			$(".error-link").show();
		}
		else
		{
			bbGambar = true;
			$(this).parent().removeClass("has-error");
			$(".error-link").hide();
		}
		if(bbJudul && bbGambar)
			$("#form-berita-baru .input-submit").removeAttr("disabled");
		else
			$("#form-berita-baru .input-submit").attr("disabled","");
	});

	//$("#form-berita-baru .form-input-gambar").hide();
	//$("#form-berita-baru .form-input-link").hide();

	$("#form-berita-baru .ganti-gambar").click(function(){

		$("#form-berita-baru .form-select-gambar").css("display","inherit");
		$("#form-berita-baru .input-gambar").val("");
		$("#form-berita-baru .input-link").val("");
		$(this).parent().hide();
		$(this).hide();
		bbGambar = false;
		$("#form-berita-baru .input-submit").attr("disabled","");

	});

	$("#form-berita-baru .form-select-gambar input").change(function(){

		if($(this).val() == "1")
		{
			$("#form-berita-baru .form-input-gambar").show();
			$("#form-berita-baru .form-input-link").hide();
			$("#form-berita-baru .input-link").val("");
		}
		else if($(this).val() == "2")
		{
			$("#form-berita-baru .form-input-gambar").hide();
			$("#form-berita-baru .input-gambar").val("");
			$("#form-berita-baru .form-input-link").show();
		}

	});



});

function showFirman(tgl, i) {
	//var base_url = window.location.origin;
	//var available_firman = $.get(base_url+'/admin/getFirman/'+tgl);
	//console.log(available_firman);
}