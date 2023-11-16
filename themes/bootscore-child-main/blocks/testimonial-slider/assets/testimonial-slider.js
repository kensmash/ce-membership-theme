(function($){
    
    var initializeBlock = function( $block ) {
        $(".testimonial-slider").slick({
          slidesToShow: 1,
          mobileFirst: true,
          focusOnSelect: true,
          prevArrow:
            "<button type='button' class='slick-prev'><i class='far fa-long-arrow-left' aria-hidden='true'></i></button>",
          nextArrow:
            "<button type='button' class='slick-next'><i class='far fa-long-arrow-right' aria-hidden='true'></i></button>",
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
              },
            },
          ],
        });
    }

    // Initialize each block on page load (front end).
    $(document).ready(function(){
      initializeBlock();
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview', initializeBlock );
    }

})(jQuery);