!function($){var e=function(e){$(".spotlight-slider").slick({slidesToShow:1,mobileFirst:!0,focusOnSelect:!0,centerPadding:"0",prevArrow:"<span class='slick-prev'><i class='fa-solid fa-chevron-left' aria-hidden='true'></i></span>",nextArrow:"<span class='slick-next'><i class='fa-solid fa-chevron-right' aria-hidden='true'></i></span>",responsive:[{breakpoint:768,settings:{slidesToShow:2}},{breakpoint:1024,settings:{centerMode:!0,slidesToShow:3}}]})};$(document).ready((function(){e()})),window.acf&&window.acf.addAction("render_block_preview",e)}(jQuery);