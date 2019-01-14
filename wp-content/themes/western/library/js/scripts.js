/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// IE8 ployfill for GetComputed Style (for Responsive Script below)
if (!window.getComputedStyle) {
	window.getComputedStyle = function(el, pseudo) {
		this.el = el;
		this.getPropertyValue = function(prop) {
			var re = /(\-([a-z]){1})/g;
			if (prop == 'float') prop = 'styleFloat';
			if (re.test(prop)) {
				prop = prop.replace(re, function () {
					return arguments[2].toUpperCase();
				});
			}
			return el.currentStyle[prop] ? el.currentStyle[prop] : null;
		}
		return this;
	}
}

// as the page loads, call these scripts
jQuery(document).ready(function($) {

	/*
	Responsive jQuery is a tricky thing.
	There's a bunch of different ways to handle
	it, so be sure to research and find the one
	that works for you best.
	*/

	/* getting viewport width */
	var responsive_viewport = $(window).width();

	/* if is below 481px */
	if (responsive_viewport < 481) {

	} /* end smallest screen */

	/* if is larger than 481px */
	if (responsive_viewport > 481) {

	} /* end larger than 481px */

	/* if is above or equal to 768px */
	if (responsive_viewport >= 768) {

		/* load gravatars */
		$('.comment img[data-gravatar]').each(function(){
			$(this).attr('src',$(this).attr('data-gravatar'));
		});

	}

	/* off the bat large screen actions */
	if (responsive_viewport > 1030) {

	}

	var input = document.createElement("input");
  if(('placeholder' in input)==false) {
		$('[placeholder]').focus(function() {
			var i = $(this);
			if(i.val() == i.attr('placeholder')) {
				i.val('').removeClass('placeholder');
				if(i.hasClass('password')) {
					i.removeClass('password');
					this.type='password';
				}
			}
		}).blur(function() {
			var i = $(this);
			if(i.val() == '' || i.val() == i.attr('placeholder')) {
				if(this.type=='password') {
					i.addClass('password');
					this.type='text';
				}
				i.addClass('placeholder').val(i.attr('placeholder'));
			}
		}).blur().parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var i = $(this);
				if(i.val() == i.attr('placeholder'))
					i.val('');
			})
		});
	}

	$(document).ready(function(){
		if ($('input:radio[name="message_radio"]').is(':checked')) {
    	if ($('input:radio[name="message_radio"]:checked').val() == 'story') {
    		$('.story_fieldset').slideDown();
    	}
    	else {
    		$('.event_fieldset').slideDown();
    	}
    }
	});

	$('input:radio[name="message_radio"]').change(function(){
    if ($(this).val() == 'story') {
    	$('.event_fieldset').slideUp();
    	$('.story_fieldset').slideDown();
    }
    else {
    	$('.story_fieldset').slideUp();
    	$('.event_fieldset').slideDown();
    }
  });

	function getSlider() {
	    setTimeout(function () {
	        startSlider();
	    }, 500);
	}

	getSlider();

	function startSlider() {
		$('.flexslider').flexslider({
	      animation: "slide",
	      pauseOnAction: true,
	      pauseOnHover: true,
	      slideshowSpeed: 6000,
	     	start: function(slider){
	            $('.flexslider').resize();
	        }
	    });
	}

	$("#accordion").accordion({
    	active: false,
		heightStyle: "content",
		collapsible: true,
		icons: false,
		navigation: true
   	});
    $(".ui-accordion-header").click(function(){
        $(this).blur();
	});


	$(".flip").click(function() {
    	$(".panel").slideToggle("slow");
  	});

  	var width = $(".single-feature img").width();
	if (width < 400) {
		$(".single-wrapper").css({'float':'right', 'margin-left': '10px', 'max-width':'400px'});
	}
	else {
		$(".single-wrapper").css({'width':width, 'margin' : '0 auto'});
	}

	clearForms();

	enquire.register("screen and (max-width:768px)", {

	   	match : function() {
	   		$largemenu = $( '#menu-top-navigation' );
	   		$respondmenu = $( '<ul id="responsive-main"><li><a class="drop" href="#">MENU</a><div class="clear"></div></li></ul>' );
	   		$( $largemenu ).replaceWith( $respondmenu );
	   		$('.drop').after($largemenu);
	   		$('#menu-top-navigation').css('display', 'none');
	   		$('#responsive-main li').click(function () {
		        $('ul', this).slideToggle(100);
		        return false;
		    });
		    $('#responsive-main li ul li a').click(function () {
		        window.location = this.href;
		    });
	   	},

	    unmatch : function() {
	    	$largemenu = $( '#menu-top-navigation' );
	    	$respondmenu = $( '#responsive-main');
	    	$( $respondmenu ).replaceWith( $largemenu );
	    	$( '#menu-top-navigation' ).css('display', 'block');
	    },

	});

}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
	var doc = w.document;
	if( !doc.querySelector ){ return; }
	var meta = doc.querySelector( "meta[name=viewport]" ),
		initialContent = meta && meta.getAttribute( "content" ),
		disabledZoom = initialContent + ",maximum-scale=1",
		enabledZoom = initialContent + ",maximum-scale=10",
		enabled = true,
		x, y, z, aig;
	if( !meta ){ return; }
	function restoreZoom(){
		meta.setAttribute( "content", enabledZoom );
		enabled = true; }
	function disableZoom(){
		meta.setAttribute( "content", disabledZoom );
		enabled = false; }
	function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
		if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );

//swap tab image
intImage = 2;
state="up";
function swapImage() {
switch (intImage) {
case 1:
document.flip1.src = "http://www.uwo.ca/web_standards/img/tab/tab-closed.gif"
intImage = 2;
state="up";
return(false);
case 2:
document.flip1.src = "http://www.uwo.ca/web_standards/img/tab/tab-open.gif"
intImage = 1;
state="down";
return(false);
}
}

function rOut() {
if (state == "up"){
    document.flip1.src = "http://www.uwo.ca/web_standards/img/tab/tab-closed.gif"
} else {
    document.flip1.src = "http://www.uwo.ca/web_standards/img/tab/tab-open.gif"
}
}

function rOver() {
if (state == "up"){
    document.flip1.src = "http://www.uwo.ca/web_standards/img/tab/tab-open.gif"
} else {
    document.flip1.src = "http://www.uwo.ca/web_standards/img/tab/tab-closed.gif"
}
}

function clearForms() {
  var i;
  for (i = 0; (i < document.forms.length); i++) {
    document.forms[i].reset();
  }
}
