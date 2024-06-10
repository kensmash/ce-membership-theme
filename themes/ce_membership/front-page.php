<?php

/**
 * The template for displaying the home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CE_Membership
 */

get_header();
?>

<div id="content" class="site-content container-fluid bg-white px-0">

    <div id="primary" class="content-area">

      <div class="row px-0 g-0">

        <div class="col">

          <main id="main" class="site-main">

            <div class="entry-content">
              <?php the_content(); ?>
            </div>

          </main>

        </div>

      </div>

    </div>
    
  </div>

<?php
get_footer();