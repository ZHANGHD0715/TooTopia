"use strict";

+function($) {

	var $window = $(window);
	var $header = $('#masthead');
	var $main = $('#main');
	var fixHeaderClass = 'fixedHeader';
	var topLengthToStartFixed = 450;

	$window.on(' scroll ', function(){

		var scrollTop = $window.scrollTop();
		
		if ( topLengthToStartFixed > 350 && !$header.hasClass(fixHeaderClass) ) {
			$main.css('margin-top', '100px');
			$header.hide();
			$header.fadeIn(1500);
			$header.addClass(fixHeaderClass);

		} 

		if ( topLengthToStartFixed <= 350 && $header.hasClass(fixHeaderClass) ) {
			$main.css('margin-top', '0');
			$header.removeClass('fixedHeader');
		}

	});

}(jQuery);