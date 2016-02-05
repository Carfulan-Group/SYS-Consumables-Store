jQuery( document ).ready( function ( $ )
	{

		var $main = $( 'main' ) ,
			$loading = $( '.loading' ) ,
			$url = $( '#header-logo' ).parent().attr( "href" ) ,
			$title = document.title ,
			$titleEnding = $title.split( "|" )[ 1 ];


		// loading animation
		$( document ).on( {
			ajaxStart: function ()
			{
				$loading.show();
			} ,
			ajaxStop: function ()
			{
				$loading.hide();
			}
		} );

		function urlUpdate ( $oldLink , $theLink , $linkText )
		{
			window.history.pushState( $oldLink , $linkText + ' | ' + $titleEnding , $theLink );

			document.title = $linkText + " | " + $titleEnding;
		}

		function activeMenuItem ()
		{
			$( '.current-menu-item' ).removeClass( "current-menu-item" );

			var $newLink = window.location.href;

			$( "a" ).each( function ()
			{
				if ( $( this ).attr( "href" ) == $newLink )
					$( this ).parent( 'li' ).addClass( "current-menu-item" );
			} );
		}

		//function reloadScripts ()
		//{
		//
		//	console.log( "yo" );
		//	//$( 'script' ).each( function ()
		//	//{
		//	//	$source = $( this ).attr( "src" );
		//	//	$x = $source;
		//	//	$( this ).remove();
		//	//	//$( this ).attr( "src" , $source );
		//	//	$newScript = document.createElement( 'script' );
		//	//	$newScript.type = "text/javascript";
		//	//	$newScript.src = $x;
		//	//
		//	//	document.getElementsByTagName( "head" )[ 0 ].appendChild( $newScript );
		//	//} );
		//}

		$( 'a' ).on( "click" , function ( event )
		{

			event.preventDefault();

			var $oldLink = window.location.href ,
				$theLink = $( this ).attr( "href" ) ,
				$linkText = $( this ).html();

			if ( ! $( this ).find( "img" ).is( "#header-logo" ) ) {
			}
			else {
				$linkText = "My Consumables | " + $titleEnding;
			}

			if ( $theLink.match( $url ) ) {
				$( document ).scrollTop( 0 );
				$main.load( $theLink + " .ajax-container" );
				urlUpdate( $oldLink , $theLink , $linkText );
				activeMenuItem();
				//reloadScripts();
			}
			else {
				window.location.replace( $theLink );
			}

		} );


		window.onpopstate = function ()
		{
			$( 'main' ).load( location.href + " .ajax-container" );
			activeMenuItem();

			$linkText = $( '.current-menu-item a' ).html();
			document.title = $linkText + " | " + $titleEnding;
		};
	}
)
;
