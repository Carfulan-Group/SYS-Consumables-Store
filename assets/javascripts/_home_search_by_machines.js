var $ = jQuery;

function filterByMachine ( select )
{
	var value = "", classes = "";

	value = $ ( select ).val ().toLowerCase ().replace ( / /g, "-" );
	if ( value == 0 )
	{
		$ ( '.loop__product' ).show ();
	}
	else
	{
		$ ( '.loop__product' ).hide ();
		$ ( '.loop__product' ).each ( function ()
		{
			classes = $ ( this ).attr ( 'data-machines' );
			if ( classes.indexOf ( value ) > - 1 )
			{
				$ ( this ).show ();
			}
		} );
	}

	grid.masonry ( 'layout' );

}