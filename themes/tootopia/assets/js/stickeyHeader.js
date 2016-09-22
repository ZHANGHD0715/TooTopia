"use strict";

+function($) {

	var $window = $(window);
	var $header = $('#masthead');
	var $main = $('#main');
	var fixHeaderClass = 'fixedHeader';
	var TOP_LENGTH = 350;

	var updateHeader = function () {
		var scrollTop = $window.scrollTop();
			
		if ( scrollTop > TOP_LENGTH && !$header.hasClass(fixHeaderClass) ) {
			$main.css('margin-top', '100px');
			$header.hide();
			$header.fadeIn(1000);
			$header.addClass(fixHeaderClass);

		} 

		if ( scrollTop <= TOP_LENGTH && $header.hasClass(fixHeaderClass) ) {
			$main.css('margin-top', '0');
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