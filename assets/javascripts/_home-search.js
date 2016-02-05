function itemSearch ( el )
{
	var input = el.value.toLowerCase() ,
		product = document.querySelectorAll( '.product' ) ,
		title = document.querySelectorAll( '.home-cat-container h2' );

	if ( ! input ) { // show all products and titles if search is empty
		Array.prototype.forEach.call( product , function ( el )
		{
			el.style.display = "block";
		} );

		Array.prototype.forEach.call( title , function ( el )
		{
			el.style.display = "block";
		} );
	}
	else {
		Array.prototype.forEach.call( product , function ( el )
		{
			var h3Content = el.querySelector( "h3" ).innerHTML.toLowerCase();

			if ( h3Content.indexOf( input ) ) {
				el.style.display = "none";
			}
			else {
				el.style.display = "block";
			}
		} );

		Array.prototype.forEach.call( title , function ( el )
		{
			el.style.display = "none";
		} );

	}

}