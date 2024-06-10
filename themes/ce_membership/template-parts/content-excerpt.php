<?php
/**
 * Template part for displaying post excerpts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Bootscore
 * @version 6.0.0
 */

$isPodcast = get_query_var('podcast'); 
?>

<div id="post-<?php the_ID(); ?>" class="card mb-3">

    <div class="card-body">
        <div class="container">
            <div class="row">
            <div class="col-2 d-none d-lg-block">
                <?php if ( has_post_thumbnail() ) { // check if the post has a Featured Image assigned to it.
                    the_post_thumbnail('thumbnail', array( 'class'  => 'float-left mr-3' ));
                } else { ?>
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() ) ?>/assets/images/thumbnail-blog.png" class="float-left mr-3" style="width: 150px;" alt="CE logo">
                <?php } ?>
                </div>
                <div class="col-12 col-lg-10">
                <h5 class="card-title"><a href="<?php the_permalink();?>" rel="bookmark"><?php the_title(); ?></a></h5>
                    <?php if (!$isPodcast) { ?> 
                        <p class="card-text small text-black-50"> <?php bootscore_date(); ?></p> 
                    <?php } ?>
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
        
    </div>

</div>