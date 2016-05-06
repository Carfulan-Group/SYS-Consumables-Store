var $ = jQuery;

function filterByMachine ( select )
{
	var classes = "",
		product = $ ( '.loop__product' ),
		value   = $ ( select ).val ().toLowerCase ().replace ( "|", "" ).replace ( / /g, "-" ).replace ( '--', '-' );

	console.log ( value );
	if ( value == 0 )
	{
		product.show ();
	}
	else
	{
		product.hide ();
		product.each ( function ()
		{
			classes = $ ( this ).attr ( 'data-machines' );
			if ( classes.indexOf ( value ) >= 0 )
			{
				$ ( this ).show ();
			}
		} );
	}

	grid.masonry ( 'layout' );

}