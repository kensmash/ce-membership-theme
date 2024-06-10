/* global jQuery */
/**
 * File tab-linking.js.
 *
 * Allow external and internal linking to bootstrap tabs on pages
 *
 * Idea from: https://webdesign.tutsplus.com/tutorials/how-to-add-deep-linking-to-the-bootstrap-4-tabs-component--cms-31180
 */

//external linking
//solution from https://stackoverflow.com/questions/43068221/bootstrap-4-link-to-specific-tab
jQuery(function () {
  jQuery('a[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
    history.pushState({}, "", e.target.hash);
  });

  var hash = document.location.hash;
  var prefix = "tab_";
  if (hash) {
    jQuery('.nav-tabs a[href="' + hash.replace(prefix, "") + '"]').tab("show");
  }
});

//internal linking
//idea from https://www.codegrepper.com/code-examples/javascript/bootstrap+set+active+tab+javascript
//remember to add "tab-link" class to any hyperlink in tab that needs to go to another tab
jQuery(".tab-link").on("click", function (event) {
  // Prevent url change
  event.preventDefault();

  jQuery('.nav-tabs a[href="' + this.hash + '"]').tab("show");
});
