jQuery ( document ).ready ( function ( $ )
{
	$ ( 'main' ).css ( 'opacity', '1' );
} );

jQuery ( document ).ready ( function ()
{
	$ ( '#smoothstate' ).smoothState ( {
		// prefetches content before the user releases their finger (touchscreen)
		prefetch : true,
		allowFormCaching : false,
		forms : '',

		// runs once the ajax request starts
		onStart : {
			render : function ()
			{
				$ ( 'main' ).css ( 'opacity', '0' );
				$ ( '.loading' ).show ();
			}
		},

		// stuff to run once the new content has been loaded and added to the DOM

		onAfter : function ()
		{
			$ ( document ).ready ();
			$ ( window ).trigger ( 'load' );
			$ ( '.loading' ).hide ();
			$ ( 'main' ).css ( 'opacity', '1' );
		}

	} ).data ( 'smoothState' )

} ); // jquery DOM ready
