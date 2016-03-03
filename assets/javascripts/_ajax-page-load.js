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
