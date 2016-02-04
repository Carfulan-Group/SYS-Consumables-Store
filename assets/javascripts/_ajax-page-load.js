jQuery( document ).ready( function ( $ )
	{

		var $main = $( 'main' ) ,
			$loading = $( '.loading' ) ,
			$url = $( '#header-logo' ).parent().attr( "href" );

		// loading animation
		$( document ).on( {
			ajaxStart: function ()
			{
				$loading.slideToggle( 100 );
			} ,
			ajaxStop: function ()
			{
				$loading.slideToggle( 100 );
			}
		} );

		function urlUpdate ( $oldLink , $theLink , $linkText )
		{
			window.history.pushState( $oldLink , $linkText , $theLink );
			document.querySelector( "main" ).innerHTML = e.state.html;
			document.title = e.state.$linkText;
		}

		//function activeMenuItem ()
		//{
		//	$('.current-menu-item').removeClass("current-menu-item");
		//
		//	var $newLink = window.location.href;
		//
		//	$("a").each(function ()
		//	{
		//		if ( $(this).attr("href").contains($newLink) )
		//			$(this).parent('li').addClass("current-menu-item");
		//	});
		//}

		$( 'a' ).on( "click" , function ( event )
		{
			event.preventDefault();

			var $oldLink = window.location.href ,
				$theLink = $( this ).attr( "href" ) ,
				$linkText = $( this ).html();

			if ( $theLink.match( 'consumables' ) ) {
				$( document ).scrollTop( 0 );
				$main.load( $theLink + " .ajax-container" );
				urlUpdate( $oldLink , $theLink , $linkText );
				//activeMenuItem();
			}
			else {
				window.location.replace( $theLink );
			}

		} );
	}
)
;


