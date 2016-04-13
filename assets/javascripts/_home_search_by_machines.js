var $ = jQuery;

function filterByMachine ( select )
{
	var value = "", classes = "";

	value = $ ( select ).val ().toLowerCase ().replace ( / /g, "-" );
	if ( value == 0 )
	{
		$ ( '.product' ).show ();
	}
	else
	{
		$ ( '.product' ).hide ();
		$ ( '.product' ).each ( function ()
		{
			classes = $ ( this ).attr ( 'class' );
			if ( classes.indexOf ( value ) > - 1 )
			{
				$ ( this ).show ();
			}
		} );
	}
}