function catSelect ( el )
{

	// button appearance
	document.querySelector ( '.home-cat-selector .active' ).classList.remove ( 'active' );
	el.classList.add ( 'active' );

	// identify button & tab
	var toShow = (
		el.getAttribute ( 'data-tab' )
	);

	// hide / show divs
	var e = document.querySelectorAll ( ".home-cat-container .home-cat" );
	Array.prototype.forEach.call ( e, function ( el )
	{
		el.style.display = "none";
	} );

	var ct = document.querySelectorAll ( ".home-cat-container ." + toShow );
	Array.prototype.forEach.call ( ct, function ( el )
	{
		el.style.display = "block";
	} );
}

// the function below counts how many products there are and displays the number next to the "All" button
jQuery ( document ).ready ( function ( $ )
{
	var productCounter = 0;
	$ ( '.loop__product' ).each ( function ()
	{
		productCounter ++;
	} );

	$ ( '.home-cat-selector li:first' ).append ( " (" + productCounter + ")" )
} );