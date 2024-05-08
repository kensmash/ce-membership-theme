
(function($){
    
    var initializeBlock = function( $block ) {
        $(".ce-images-slider-cards").slick({
          slidesToShow: 2,
          slidesToScroll: 1,
          mobileFirst: true,
          focusOnSelect: true,
          asNavFor: '.ce-images-slider-card-modal',
          prevArrow:
          "<span class='slick-prev'><i class='fa-solid fa-chevron-left' aria-hidden='true'></i></span>",
          nextArrow:
          "<span class='slick-next'><i class='fa-solid fa-chevron-right' aria-hidden='true'></i></span>",
          responsive: [
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 4,
              },
            },
          ],
        });

        $('.ce-images-slider-card-modal').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          mobileFirst: true,
          asNavFor: '.ce-images-slider-cards',
          dots: false,
          centerMode: true,
          focusOnSelect: true,
          arrows: false,
        });

    }

    /* https://gist.github.com/holisticnetworking/23a9d10b8f09dce63cc71fa3c6cd1048 */

    // Initialize each block on page load (front end).
    $(document).ready(function(){
      initializeBlock();
    });

    // Initialize dynamic block preview (editor).
    if( window.acf ) {
        window.acf.addAction( 'render_block_preview', initializeBlock );
    }

})(jQuery);