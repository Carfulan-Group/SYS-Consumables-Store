/**
 * Created by Sam on 10/05/2016.
 */

// makes sure js is called on DOM ready
function pageLoad ()
{
	var $ = jQuery;
	// run functions within document ready
	$.ready ();
	// run the functions that happen on window load
	$ ( window ).trigger ( 'load' );
	// set up for lazy loading images
	new Layzr ( {
		threshold : 70
	} );
	// start masonry grid
	doMasonry ();
	// stop the logo from spinning
	$ ( '.loading' ).removeClass ( 'spin' );
	// fade in the main content
	$ ( '.fade' ).addClass ( 'fade--in' );
	// so people can hide shop wide notices
	var siteWideNotice = new ClickHider ( '.demo_store', '.demo_store' );
	siteWideNotice.hide ();
}

jQuery ( document ).ready ( function ( $ )
{
	// runs all of the functions that need to happen when the page loads
	pageLoad ( $ );

	// init SmoothState.js fort ajax page loads
	$ ( '#smoothstate' ).smoothState ( {
		// prefetches content before the user releases their finger (touchscreen)
		prefetch : true,
		cacheLength : 25,
		allowFormCaching : false,
		forms : '.this-is-a-class-that-is-not-used',

		// runs once the ajax request starts
		onStart : {
			render : function ()
			{
				$ ( '.fade' ).removeClass ( 'fade--in' );
				$ ( '.loading' ).addClass ( 'spin' );
				$ ( 'body' ).animate ( { scrollTop : 0 }, '1000' );
			}
		},

		// this runs once the new content has been added to the DOM
		onAfter : function ()
		{
			pageLoad ();
		}

	} ).data ( 'smoothState' )

} ); // jquery DOM ready
