"use strict";

+function($) {

	var $searchBtn = $('.navbar-search');
	var $searchForm = $('#masthead #searchform');
	var $searchFormInput = $('#masthead #searchform [type="text"]');

	var toggleSearchForm = function () {
		$searchForm.slideToggle(300, function(){
			$searchFormInput.focus();
		});
	}

	$searchBtn.on('click', toggleSearchForm);

}(jQuery);