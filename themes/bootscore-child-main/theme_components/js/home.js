/* global jQuery */

jQuery(function($) {
    //caches a jQuery object containing the header element
    var header = $("#nav-main");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        //console.log("scroll? ", scroll)
        if (scroll >= 400) {
            header.removeClass('navbar-transparent').addClass('bg-dark');
        } else {
            header.removeClass('bg-dark').addClass('navbar-transparent');
        }
    });
  });