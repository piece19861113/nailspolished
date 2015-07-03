$(function() {
	//$('a[href*=#]:not([href=#],[href=#myCarousel])').click(function() {
	$('a[href=#be-home-main-area]').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
					scrollTop: target.offset().top
				}, 800);
				return false;
			}
	    }
	});
	$(document).on( 'scroll', function(){
	    if ($(window).scrollTop() > 100) {
	        $('.scroll-top-wrapper').addClass('show');
	    } else {
	        $('.scroll-top-wrapper').removeClass('show');
	    }
	});
	$('.scroll-top-wrapper').on('click', scrollToTop);
	
	
	/* $('.navbar .dropdown').on('show.bs.dropdown', function(e){
	    $(this).find('.dropdown-menu').first().stop(true, true).slideDown(400);
	  });
	 
	  // ADD SLIDEUP ANIMATION TO DROPDOWN //
	  $('.navbar .dropdown').on('hide.bs.dropdown', function(e){
	    $(this).find('.dropdown-menu').first().stop(true, true).slideUp(400);
	  });*/
	
});
function scrollToTop() {
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $('body');
    offset = element.offset();
    offsetTop = offset.top;
    $('html, body').animate({scrollTop: offsetTop}, 500, 'linear');
}
function be_dba_address_clone(obj) {
	if(obj.checked) {
		var ids = ['address', 'city', 'state', 'zip'];
		for(var i in ids) {
			$('#be-user-register-salon-billing_' + ids[i]).val($('#be-user-register-salon-mailing_' + ids[i]).val());
		}
	}
}
var beLocalStorage = {
    set: function(name, data) {
        window.localStorage.setItem(name, JSON.stringify(data));
    },

    get: function(name) {
        return JSON.parse(window.localStorage.getItem(name));
    },

    destroy: function(name) {
        return window.localStorage.removeItem(name);
    },

    clear: function() {
        return window.localStorage.clear();
    },

    has: function(name) {
        return name in window.localStorage;
    }
};