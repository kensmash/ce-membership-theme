/* global jQuery */

/**
 *
 * Smooth scrolling to anchor links
 *
 * Idea from: https://stackoverflow.com/questions/49173297/bootstrap-4-smooth-scrolling-working-on-nav-link-but-not-on-other-anchor-eleme/49173734
 */
jQuery(".anchorlink").click(function (event) {
    var sectionTo = jQuery(this).attr("href");
    jQuery("html, body").animate(
      {
        scrollTop: jQuery(sectionTo).offset().top
      },
      2000
    );
    event.preventDefault();
    event.stopPropagation();
});
  

