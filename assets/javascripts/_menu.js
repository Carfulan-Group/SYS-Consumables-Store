jQuery ( document ).ready ( function ( $ )
{
	$ ( '#burger' ).click ( function ()
	{
		$ ( '#main-menu' ).find ( 'ul' ).toggleClass ( 'mobile-menu-open' );
		$ ( this ).toggleClass ( 'cooked' );
		$ ( '#shade' ).toggle ();
	} );

	$ ( '#shade' ).click ( function ()
	{
		$ ( '#main-menu' ).find ( 'ul' ).removeClass ( 'mobile-menu-open' );
		$ ( '#burger' ).removeClass ( 'cooked' );
		$ ( '#shade' ).hide ();
	} );

	$ ( window ).resize ( function ()
	{
		if ( $ ( window ).width () < 993 )
		{
			$ ( '#main-menu' ).find ( 'ul' ).removeClass ( 'mobile-menu-open' );
			$ ( '#burger' ).removeClass ( 'cooked' );
		}
		else
		{
			$ ( '#main-menu' ).find ( 'ul' ).addClass ( 'mobile-menu-open' );
			$ ( '#burger' ).removeClass ( 'cooked' );
		}
	} );
} );