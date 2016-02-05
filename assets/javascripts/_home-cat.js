function catSelect ( el )
{

	// button appearance
	document.querySelector( '.home-cat-selector .active' ).classList.remove( 'active' );
	el.classList.add( 'active' );


	// identify button & tab
	var toShow = (el.getAttribute( 'data-tab' ));

	// hide / show divs
	var e = document.querySelectorAll( ".home-cat-container .home-cat" );
	Array.prototype.forEach.call( e , function ( el )
	{
		el.style.display = "none";
	} );

	var n = document.querySelectorAll( ".home-cat-container ." + toShow );
	Array.prototype.forEach.call( n , function ( el )
	{
		el.style.display = "block";
	} );
}