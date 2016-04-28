$ = jQuery;

var search = {
	// value of search box
	input : $ ( ".home__search__input" ).val (),
	// all products to search
	products : $ ( '.product' ),
	// this is where the products title gets stored
	productName : "",
	// selector used to find the category titles (for showing and hiding)
	catTitle : '.home__cat__title',

	// hides/shows products and titles depending on search.input
	hideShow : function ()
	{
		// hides all category titles, these will be shown again if necessary later
		$ ( search.catTitle ).each ( function ()
		{
			$ ( this ).hide ();
		} );

		search.input = $ ( ".home__search__input" ).val ().toLowerCase ();

		search.products.each ( function ()
		{
			search.productName = $ ( this ).find ( '.product__title' ).text ().toLowerCase ();

			if ( search.productName.indexOf ( search.input ) )
			{
				$ ( this ).hide ();
			}
			else
			{
				$ ( this ).show ();
				// finds the parent .products and goes to the search.catTitle before it
				$ ( this ).parent ().prev ().show ();
			}
		} );

		console.log ( search.input );
	}
}

// TODO: Make correct titles show
