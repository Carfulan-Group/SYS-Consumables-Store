jQuery ( document ).ready ( function ( $ )
{
	$ ( 'main' ).css ( 'opacity', '1' );
} );

(function ( $ )
{
	'use strict';
	var $body   = $ ( 'html, body' ),
		content = $ ( '#smoothstate' ).smoothState ( {
			// prefetches content before the user releases their finger (touchscreen)
			prefetch : true,
			allowFormCaching : false,
			forms : '',
			// Runs when a link has been activated
			onStart : {
				render : function ( url, $container )
				{
					// toggleAnimationClass() is a public method
					// for restarting css animations with a class
					$ ( 'main' ).css ( 'opacity', '0' );
					$ ( '.loading' ).show ();
					// Scroll user to the top
					$body.animate ( {
						scrollTop : 0
					} );
				}
			},
			onEnd : {
				render : function ( url, $container, $content )
				{
					$body.css ( 'cursor', 'auto' );
					$body.find ( 'a' ).css ( 'cursor', 'auto' );
					$container.html ( $content );
					// Trigger document.ready and window.load
					$ ( document ).ready ();
					$ ( window ).trigger ( 'load' );
				},
				onAfter : function ( url, $container, $content )
				{
					$ ( '.loading' ).hide ();
					$ ( 'main' ).css ( 'opacity', '1' );
				}
			}
		} ).data ( 'smoothState' );
	//.data('smoothState') makes public methods available
}) ( jQuery );
