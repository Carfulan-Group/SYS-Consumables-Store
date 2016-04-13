/**
 * Created by Sam on 13/04/2016.
 */

var products = {
	product : {
		dirtyName : "",
		cleanName : ""
	},

	getName : function ( product )
	{
		this.product.dirtyName = product.find ( 'h3' ).text ();
	},

	cleanName : function ()
	{
		products.product.cleanName = products.product.dirtyName
											 .split ( '(' )
											 .join ( '</h3><p class="product_title_extra">' )
											 .split ( ')' )
											 .join ( '</p>' );
	},

	replaceName : function ( product )
	{
		this.getName ( product );
		this.cleanName ();

		product.find ( 'h3' ).after ( "<h3>" + this.product.cleanName ).remove ();
	}
};

jQuery ( document ).ready ( function ( $ )
{
	$ ( '.products .product' ).each ( function ()
	{
		products.replaceName ( $ ( this ) )
	} );
} );