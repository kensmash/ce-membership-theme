(function($){
    
    var initializeBlock = function( $block ) {
        $(".hero-slider").slick({
          slidesToShow: 1,
          mobileFirst: true,
          focusOnSelect: true,
          autoplay: true,
          autoplaySpeed: 6000,
          pauseOnFocus: false, 
          pauseOnHover: true,
          prevArrow:
            "<span class='slick-prev'><i class='fa-solid fa-chevron-left' aria-hidden='true'></i></span>",
          nextArrow:
            "<span class='slick-next'><i class='fa-solid fa-chevron-right' aria-hidden='true'></i></span>",
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