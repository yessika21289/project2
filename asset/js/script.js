$(document).ready(function(){

	jQuery("span.timeago").timeago();

	/*
		NAVIGATION SCRIPT	
	*/

	$("#btn-search").click(function() {

		$("#search form").submit();

	});

	$("button#drop-ypki").click(function() {

		var url = "/";    
		$(location).attr('href',url);

	});

	$("button#drop-smaki").click(function() {

		var url = "/smaki/";    
		$(location).attr('href',url);

	});

	$("button#drop-smpki").click(function() {

		var url = "/smpki/";    
		$(location).attr('href',url);

	});

	$("button#drop-sdki").click(function() {

		var url = "/sdki/";    
		$(location).attr('href',url);

	});

	$("button#drop-kbtk").click(function() {

		var url = "/kbtk/";    
		$(location).attr('href',url);

	});

	$("#div-login .logout button").click(function() {

		var url = "/logout/";    
		$(location).attr('href',url);

	});

	/*
		END OF NAVIGATION SCRIPT	
	*/	

	var fixmeTop = $('#navigator-bar').offset().top;
	$(window).scroll(function() {
	    var currentScroll = $(window).scrollTop();
	    if (currentScroll >= fixmeTop) {
	        $('#navigator-bar').css({
	            position: 'fixed',
	            top: '0',
	        });
	        $('#navigator-bar').css('z-index', 5);
	        $('#content').css('margin-top', 100);
	    } else {
	        $('#navigator-bar').css({
	            position: 'static'
	        });
	        $('#content').css('margin-top', 20);
	    }
	});

});

$(window).load(function(){
	$('.grid').masonry({
	  // options
	  itemSelector: '.grid-item',
	  columnWidth: 320
	});	
})

//dokumentasi image zoom
$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});