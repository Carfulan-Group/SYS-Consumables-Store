/**
 * Created by Sam on 05/05/2016.
 */

var lightbox = {
	box : document.querySelector ( '.lightbox' ),
	isOpen : false,

	open : function ()
	{
		this.box.style.top = "0";
		this.isOpen        = true
	},

	close : function ()
	{
		this.box.style.top = "100%"
		this.isOpen        = false
	},

	toggle : function ()
	{
		if ( this.isOpen == false )
		{
			this.open ()
		}
		else
		{
			this.close ()
		}
	}
};