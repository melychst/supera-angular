(function($) {
	
	'use strict';

	$(function()
	{
		$('.acardeon_item .descript_item').css('display', 'none');
				
		$('.acardeon_item').click(function () {

			if ( $(".descript_item", this ).css('display') == "none") {
				
				$('.acardeon_item .descript_item').slideUp(500);
				$(".title_item span i").removeClass('fa-minus');
				$(".title_item span i").addClass('fa-plus');
				
				$(".descript_item", this ).slideDown(500);
				$(".title_item span i",this).removeClass('fa-plus');
				$(".title_item span i",this).addClass('fa-minus');
				
			} else {
					$('.descript_item', this).slideUp(500);
					$(".title_item span i",this).removeClass('fa-minus');
					$(".title_item span i",this).addClass('fa-plus');
				}
		})
	});
 
}(jQuery));