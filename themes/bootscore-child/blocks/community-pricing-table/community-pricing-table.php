<?php
/**
 * Pricing Table Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Support custom "anchor" values.
$anchor = '';
if ( ! empty( $block['anchor'] ) ) {
    $anchor = 'id="' . esc_attr( $block['anchor'] ) . '" ';
}

// Create class attribute allowing for custom "className" and "align" values.
$class_name = 'container community-price';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
?>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="check" viewBox="0 0 16 16">
    <title>Check</title>
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  </symbol>
</svg>

<div <?php echo esc_attr( $anchor ); ?>class="<?php echo esc_attr( $class_name ); ?>" style="">

<section>
    <div class="row row-cols-1 row-cols-md-2 mb-3 mb-xl-4 text-center">
      <div class="col mb-4 mb-lg-0">
        <div class="card h-100 mb-4 rounded-3 border-success pricing-card">
          <div class="card-header text-bg-success border-success py-3">
            <h4 class="my-0">Community Pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29.99<small class="text-body-secondary fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Discord Community access</li>
              <li>Pro Critiques on Art and Scripts</li>
              <li>Live Q&A Sessions</li>
              <li>Pro Office Hours</li>
              <li>Lessons and Q&A Videos</li>
              <li>The Business of Comic Book Publishing e-book</li>
              <li>10% site-wide discount</li>
            </ul>
          
          </div>
          <div class="card-footer border-top-0">
            <a class="btn w-100 btn btn-lg btn-success my-2" href="<?php echo site_url('membership-account/membership-checkout/?pmpro_level=4'); ?>" role="button">Sign up for free</a>
          </div>
        </div>
      </div>
      <div class="col mb-4 mb-lg-0">
        <div class="card h-100 mb-4 rounded-3 pricing-card" style="">
          <div class="card-header py-3">
            <h4 class="my-0">Enterprise</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Discord Community access</li>
              <li>Pro Critiques on Art and Scripts</li>
              <li>Live Q&A Sessions</li>
              <li>Pro Office Hours</li>
              <li>Lessons and Q&A Videos</li>
              <li>The Business of Comic Book Publishing e-book</li>
              <li>10% site-wide discount</li>
              <li><b>Contact us for more info</b></li>
            </ul>
          </div>
          <div class="card-footer border-top-0">
            <a class="btn w-100 btn btn-lg btn-outline-primary my-2" href="mailto:info@comicsexperience.com" role="button">Contact Us</a>
          </div>
        </div>
      </div>
    </div>
</section>

</div><!-- .container -->