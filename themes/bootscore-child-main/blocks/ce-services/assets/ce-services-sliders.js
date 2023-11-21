(function($){
    
    var initializeBlock = function( $block ) {
        $(".ce-services-cards").slick({
          slidesToShow: 2,
          arrows: false,
          mobileFirst: true,
          focusOnSelect: true,
          asNavFor: ".ce-services-descriptions",
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 4,
              },
            },
          ],
        });

        $(".ce-services-descriptions").slick({
          slidesToShow: 1,
          mobileFirst: true,
          arrows: false,
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