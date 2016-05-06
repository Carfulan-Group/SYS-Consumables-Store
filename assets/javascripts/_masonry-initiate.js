// global

var grid = $ ( '.masonry__grid' );

function doMasonry ()
{
	var myColumnWidth = $ ( '.masonry__item' ).outerWidth () - 1;

	grid.masonry ( {
		itemSelector : '.masonry__item',
		transitionDuration : '0.3s',
		percentPosition : true,
		columnWidth : myColumnWidth
	} );

}

$ ( window ).resize ( function ()
{
	doMasonry ();
} );