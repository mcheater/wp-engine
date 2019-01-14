jQuery.noConflict();
 
jQuery( document ).ready(function( $ ) {

	var $container = $('#releaselistFront').masonry();
	// layout Masonry again after all images have loaded
	$container.imagesLoaded( function() {
	  $container.masonry({
		itemSelector: '.sixcolgrid',  
	  });
	});


});
 