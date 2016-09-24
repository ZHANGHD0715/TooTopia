/**
 * stickeyheader.js
 *
 * Handles header's position to be fixed when scroll.
 */

"use strict";

+function($) {

	var $window = $(window),
	    $header = $('#masthead'),
	    $main = $('#main'),
	    fixedHeaderClass = 'fixedHeader',
	    TOP_LENGTH = 300,
	    FADE_TIME = 1000;

	if ( !$header ) 
		return;

	var updateHeader = function () {
		var scrollTop = $window.scrollTop();
			
		if ( scrollTop > TOP_LENGTH && !$header.hasClass(fixedHeaderClass) ) {
			$main.addClass('has-fixed-header');
			$header.hide();
			$header.fadeIn(FADE_TIME);
			$header.addClass(fixedHeaderClass);

		} 

		if ( scrollTop <= TOP_LENGTH && $header.hasClass(fixedHeaderClass) ) {
			$main.removeClass('has-fixed-header');
			$header.removeClass('fixedHeader');
		}
	}

	// 使用节流函数
	var throttle = function() {
		var firsttime = true,
			fixedHeaderTimer;

		return function () {

			if (firsttime) {
				updateHeader();
				firsttime = false;
				return;
			}

			if (fixedHeaderTimer) {
				return false;
			}

			fixedHeaderTimer = setTimeout(function(){

				clearTimeout(fixedHeaderTimer);
				fixedHeaderTimer = null;
				updateHeader();

			}, 300);

		}
	}
	
	$window.on(' scroll ', throttle());

}(jQuery);