<?php
/**
 * Testimonial Block template.
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
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
        <div class="card h-100 mb-4 rounded-3 shadow-sm" style="transform: scale(0.95);">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Community</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$4.99<small class="text-body-secondary fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Discord Community access</li>
              <li>Peer Critiques on Art and Scripts</li>
            </ul>
          </div>
          <div class="card-footer bg-white border-top-0">
            <a class="btn w-100 btn btn-lg btn-outline-primary" href="<?php echo site_url('membership-account/membership-checkout/?pmpro_level=3'); ?>" role="button">Sign up for free</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 mb-4 rounded-3 shadow-sm border-primary">
          <div class="card-header text-bg-primary border-primary py-3">
            <h4 class="my-0">Community Pro</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$29.99<small class="text-body-secondary fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
              <li>Discord Community access</li>
              <li>Pro Critiques on Art and Scripts</li>
              <li>Live Q&A Sessions</li>
              <li>Pro Office Hours</li>
              <li>Lessons and Q&As Videos</li>
              <li>The Business of Comic Book Publishing e-book</li>
              <li>10% site-wide discount</li>
            </ul>
          
          </div>
          <div class="card-footer bg-white border-top-0">
            <a class="btn w-100 btn btn-lg btn-primary" href="<?php echo site_url('membership-account/membership-checkout/?pmpro_level=4'); ?>" role="button">Sign up for free</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card h-100 mb-4 rounded-3 shadow-sm" style="transform: scale(0.95);">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Enterprise</h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <li>Discord Community access</li>
              <li>Pro Critiques on Art and Scripts</li>
              <li>Live Q&A Sessions</li>
              <li>Pro Office Hours</li>
              <li>Lessons and Q&As Videos</li>
              <li>The Business of Comic Book Publishing e-book</li>
              <li>10% site-wide discount</li>
              <li><b>Contact us for more info</b></li>
            </ul>
          </div>
          <div class="card-footer bg-white border-top-0">
            <a class="btn w-100 btn btn-lg btn-outline-primary" href="mailto:info@comicsexperience.com" role="button">Contact Us</a>
          </div>
        </div>
      </div>
    </div>

    <h2 class="display-6 text-center mb-4 pt-3">Compare plans</h2>

    <div class="table-responsive">
      <table class="table text-center">
        <thead>
          <tr>
            <th style="width: 34%;"></th>
            <th style="width: 22%;">Community</th>
            <th style="width: 22%;">Community Pro</th>
            <th style="width: 22%;">Enterprise</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row" class="text-start">Discord Community</th>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Peer Art and Script Critiques</th>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Pro Art and Script Critiques</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
        </tbody>

        <tbody>
          <tr>
            <th scope="row" class="text-start">Comics Experience Library</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Live Q&A Sessions</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Pro Office Hours</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Lessons and Q&A Videos</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">The Business of Comic Book Publishing e-book</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">10% store discount</th>
            <td></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
          </tr>
          <tr>
            <th scope="row" class="text-start">Group enrollments and benefits</th>
            <td></td>
            <td></td>
            <td>Contact us</td>
          </tr>
        </tbody>
      </table>
    </div>
</section>

</div><!-- .container -->