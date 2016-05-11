/**
 * Created by Sam on 10/05/2016.
 */

class ClickHider {
	hideElement:string;
	triggerElement:string;
	trigger:string;

	constructor ( hideElement, triggerElement)
	{
		this.hideElement = hideElement;
		this.triggerElement = triggerElement;
	}

	hide ()
	{
		var thisButNotThis = this;
		$ ( this.triggerElement ).on ( 'click', function ()
		{
			$ ( thisButNotThis.hideElement ).hide ();
		} );
	}
}