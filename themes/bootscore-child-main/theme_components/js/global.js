/* global jQuery */

/**
 *
 * Smooth scrolling to anchor links
 *
 * Idea from: https://stackoverflow.com/questions/49173297/bootstrap-4-smooth-scrolling-working-on-nav-link-but-not-on-other-anchor-eleme/49173734
 */
jQuery(".anchorlink").click(function () {
    var sectionTo = jQuery(this).attr("href");
    jQuery("html, body").animate(
      {
        scrollTop: jQuery(sectionTo).offset().top
      },
      1100
    );
    event.preventDefault();
    event.stopPropagation();
});
  

jQuery(function($) {
  //caches a jQuery object containing the header element
  var header = $("#nav-main");
  $(window).scroll(function() {
      var scroll = $(window).scrollTop();
      console.log("scroll? ", scroll)
      if (scroll >= 400) {
          header.removeClass('navbar-transparent').addClass('navbar-dark');
      } else {
          header.removeClass('navbar-dark').addClass('navbar-transparent');
      }
  });
});