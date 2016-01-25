jQuery(document).ready(function($) {
	
	// makes jquery contains selector case in-sensitive
	jQuery.expr[':'].Contains = function(a, i, m) {
	  return jQuery(a).text().toUpperCase()
	      .indexOf(m[3].toUpperCase()) >= 0;
	};
	jQuery.expr[':'].contains = function(a, i, m) {
	  return jQuery(a).text().toUpperCase()
	      .indexOf(m[3].toUpperCase()) >= 0;
	};

	$('.home-search input').keyup(function() {
		$input = $(this).val();
			if (! $input){
				$('.product').show();
				$('.home-cat-container h2').show();
			} else {
				$('.home-cat-container h2').hide();
				$('.product').hide();
				$('.product:contains("' + $input + '")').show();
			}
	});
});