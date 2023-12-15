/* global jQuery */

jQuery(function($) {
    //caches a jQuery object containing the header element
    var header = $("#nav-main");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        //console.log("width? ", $(window).width())
        if ($(window).width() >= 1024) {
            if (scroll >= 400) {
                header.removeClass('bg-transparent').addClass('bg-dark');
            } else {
                header.removeClass('bg-dark').addClass('bg-transparent');
            }
        }
    });
  });