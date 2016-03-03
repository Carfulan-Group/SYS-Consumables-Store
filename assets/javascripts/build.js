/*!
 * Layzr.js 1.4.2 - A small, fast, modern, and dependency-free library for lazy loading.
 * Copyright (c) 2015 Michael Cavalea - http://callmecavs.github.io/layzr.js/
 * License: MIT
 */

!function(t,i){"function"==typeof define&&define.amd?define([],i):"object"==typeof exports?module.exports=i():t.Layzr=i()}(this,function(){"use strict";function t(t){this._lastScroll=0,this._ticking=!1,t=t||{},this._optionsContainer=document.querySelector(t.container)||window,this._optionsSelector=t.selector||"[data-layzr]",this._optionsAttr=t.attr||"data-layzr",this._optionsAttrRetina=t.retinaAttr||"data-layzr-retina",this._optionsAttrBg=t.bgAttr||"data-layzr-bg",this._optionsAttrHidden=t.hiddenAttr||"data-layzr-hidden",this._optionsThreshold=t.threshold||0,this._optionsCallback=t.callback||null,this._retina=window.devicePixelRatio>1,this._srcAttr=this._retina?this._optionsAttrRetina:this._optionsAttr,this._nodes=document.querySelectorAll(this._optionsSelector),this._handlerBind=this._requestScroll.bind(this),this._create()}return t.prototype._requestScroll=function(){this._lastScroll=this._optionsContainer===window?window.pageYOffset:this._optionsContainer.scrollTop+this._getOffset(this._optionsContainer),this._requestTick()},t.prototype._requestTick=function(){this._ticking||(requestAnimationFrame(this.update.bind(this)),this._ticking=!0)},t.prototype._getOffset=function(t){return t.getBoundingClientRect().top+window.pageYOffset},t.prototype._getContainerHeight=function(){return this._optionsContainer.innerHeight||this._optionsContainer.offsetHeight},t.prototype._create=function(){this._handlerBind(),this._optionsContainer.addEventListener("scroll",this._handlerBind,!1),this._optionsContainer.addEventListener("resize",this._handlerBind,!1)},t.prototype._destroy=function(){this._optionsContainer.removeEventListener("scroll",this._handlerBind,!1),this._optionsContainer.removeEventListener("resize",this._handlerBind,!1)},t.prototype._inViewport=function(t){var i=this._lastScroll,e=i+this._getContainerHeight(),o=this._getOffset(t),n=o+this._getContainerHeight(),s=this._optionsThreshold/100*window.innerHeight;return n>=i-s&&e+s>=o&&!t.hasAttribute(this._optionsAttrHidden)},t.prototype._reveal=function(t){var i=t.getAttribute(this._srcAttr)||t.getAttribute(this._optionsAttr);t.hasAttribute(this._optionsAttrBg)?t.style.backgroundImage="url("+i+")":t.setAttribute("src",i),"function"==typeof this._optionsCallback&&this._optionsCallback.call(t),t.removeAttribute(this._optionsAttr),t.removeAttribute(this._optionsAttrRetina),t.removeAttribute(this._optionsAttrBg),t.removeAttribute(this._optionsAttrHidden)},t.prototype.updateSelector=function(){this._nodes=document.querySelectorAll(this._optionsSelector)},t.prototype.update=function(){for(var t=this._nodes.length,i=0;t>i;i++){var e=this._nodes[i];e.hasAttribute(this._optionsAttr)&&this._inViewport(e)&&this._reveal(e)}this._ticking=!1},t});

var layzr = new Layzr({
  threshold: 70
});

// // Stuff to do as soon as the DOM is ready.
// jQuery(document).ready(function ($) {
//
//     $('body').on( "click" , "a" , function(event) {
//         // stop browser from following link
//         event.preventDefault();
//
//         var page = {
//             oldLink : window.location.href,
//             oldTitle : document.title,
//             newLink : $(this).attr("href"),
//
//             getNewContent : function (item) {
//                 var getContent = "",
//                     getTitle = "",
//                     tempDiv = $("<div />");
//
//                 tempDiv.load( this.newLink , function () {
//                     getContent = tempDiv.find(".ajax_container");
//                     getTitle = tempDiv.find("title");
//                 });
//
//                 items = {
//                     content : getContent,
//                     title : getTitle
//                 }
//
//                 return items[item];
//             }
//         };
//
//
//         document.title = page.getNewContent("title");
//         // $('.ajax_container').html(page.getNewContent("content"));
//
//         window.alert(page.getNewContent("content"));
//
//         // $('.ajax_container').html( page.newContent("content") );
//
//         // $('meta[name=description]').remove();
//         // $('head').append( '<meta name="description" content="this is new">' );
//
//     });
//
// });

function catSelect ( el )
{

	// button appearance
	document.querySelector( '.home-cat-selector .active' ).classList.remove( 'active' );
	el.classList.add( 'active' );


	// identify button & tab
	var toShow = (el.getAttribute( 'data-tab' ));

	// hide / show divs
	var e = document.querySelectorAll( ".home-cat-container .home-cat" );
	Array.prototype.forEach.call( e , function ( el )
	{
		el.style.display = "none";
	} );

	var n = document.querySelectorAll( ".home-cat-container ." + toShow );
	Array.prototype.forEach.call( n , function ( el )
	{
		el.style.display = "block";
	} );
}
function itemSearch ( el )
{
	var input = el.value.toLowerCase() ,
		product = document.querySelectorAll( '.product' ) ,
		title = document.querySelectorAll( '.home-cat-container h2' );

	if ( ! input ) { // show all products and titles if search is empty
		Array.prototype.forEach.call( product , function ( el )
		{
			el.style.display = "block";
		} );

		Array.prototype.forEach.call( title , function ( el )
		{
			el.style.display = "block";
		} );
	} else {
		Array.prototype.forEach.call( product , function ( el )
		{
			var h3Content = el.querySelector( "h3" ).innerHTML.toLowerCase();

			if ( h3Content.indexOf( input ) ) {
				el.style.display = "none";
			}
			else {
				el.style.display = "block";
			}
		} );

		Array.prototype.forEach.call( title , function ( el )
		{
			el.style.display = "none";
		} );

	}

}

 //// Author: Sam Mckay
 //// Version: 1.3
 //// Licence: GNU (feel free to pimp)
 //// Github: https://github.com/sammckay10
 //
 //
 //var addEvent = function(object, type, callback) { // Adds listener for calling the function on resize
 //    if (object == null || typeof(object) == 'undefined') return;
 //    if (object.addEventListener) {
 //        object.addEventListener(type, callback, false);
 //    } else if (object.attachEvent) {
 //        object.attachEvent("on" + type, callback);
 //    } else {
 //        object["on"+type] = callback;
 //    };
 //};
 //
 //
 //window.onload = function() {
 //
 //var element =  document.querySelector('.masonry');
 //if (typeof(element) != 'undefined' && element != null) {
 //
 //	var item = document.querySelector(".masonry").getElementsByClassName("item");
 //        len = item !== null ? item.length : 0,
 //        i = 0,
 //        y = 1;
 //	    for(i; i < len; i++) {
 //	        item[i].className += " item-"+y;
 //	        y++;
 //	    };
 //
 //		function masonry() {
 //			var item = document.querySelector(".masonry").getElementsByClassName("item");
 //			var counter = 0;
 //			Array.prototype.forEach.call(item, function(el){
 //				counter++;
 //				var columns = 3, // Number of columns
 //					gap = 15, // The spacing between rows in px
 //					number = counter + columns,
 //					outer = el.offsetHeight,
 //					inner = el.querySelector(".inner").offsetHeight,
 //					difference = (outer - inner) - gap,
 //					plusItem = ( document.querySelector(".item-" + number));
 //
 //					plusItem.style.top = "-" + difference + "px";
 //					plusItem.style.marginBottom = "-" + difference + "px";
 //			});
 //		};
 //
 //		var masonryFixCounter = 0;
 //
 //		function masonryFixFunction() {
 //			if ( masonryFixCounter == 10 ){
 //				clearInterval(masonryFix);
 //			} else {
 //				masonryFixCounter++;
 //				masonry();
 //			}
 //		}
 //
 //		var masonryFix = setInterval(masonryFixFunction, 500);
 //
 //}; // if masonry exists
 //
 //}; // window on load

jQuery(document).ready(function($) {
	$('#burger').click(function() {
		$('#main-menu ul').toggleClass('mobile-menu-open');
		$(this).toggleClass('cooked');
		$('#shade').toggle();
	});

	$('#shade').click(function() {
		$('#main-menu ul').removeClass('mobile-menu-open');
		$('#burger').removeClass('cooked');
		$('#shade').hide();
	});

	$(window).resize(function() {
		if ($(window).width() < 993) {
			$('#main-menu ul').removeClass('mobile-menu-open');
			$('#burger').removeClass('cooked');
		}
		else {
			$('#main-menu ul').addClass('mobile-menu-open');
			$('#burger').removeClass('cooked');
		}
	});
});