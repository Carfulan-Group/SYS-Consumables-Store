jQuery(document).ready(function($) {
	$('.home-cat-selector li').on('click', function(event) {
		
		// button appearance
		$('.home-cat-selector .active').removeClass('active');
		$(this).addClass('active');


		// identify button & tab
		$toShow = ($(this).data('tab'));

		// hide / show divs
		$('.home-cat-container .home-cat').hide();
		$('.home-cat-container .' + $toShow).show();
	});
});	