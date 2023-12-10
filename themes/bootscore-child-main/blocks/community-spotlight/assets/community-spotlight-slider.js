(function($){
    
    var initializeBlock = function( $block ) {
        $(".spotlight-slider").slick({
          slidesToShow: 1,
          mobileFirst: true,
          focusOnSelect: true,
          centerMode: true,
          centerPadding: '60px',
          prevArrow:
            "<span class='slick-prev'><i class='fa-solid fa-chevron-left' aria-hidden='true'></i></span>",
          nextArrow:
            "<span class='slick-next'><i class='fa-solid fa-chevron-right' aria-hidden='true'></i></span>",
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