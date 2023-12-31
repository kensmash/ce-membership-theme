
(function($){
    
    var initializeBlock = function( $block ) {
        $(".ce-services-cards").slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          arrows: false,
          mobileFirst: true,
          focusOnSelect: true,
          asNavFor: ".ce-services-descriptions",
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 4,
              },
            },
          ],
        });

        $(".ce-services-descriptions").slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          mobileFirst: true,
          arrows: false,
          fade: true,
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