<?php
/**
 * Template part for displaying post excerpts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Comics_Experience_2019
 */

$isPodcast = get_query_var('podcast'); 
?>

<div id="post-<?php the_ID(); ?>" class="card mb-3">

    <div class=" card-body">
        <h5 class="card-title"><a href="<?php the_permalink();?><?php echo $queryString; ?>" rel="bookmark"><?php the_title(); ?></a></h5>
        <?php if (!$isPodcast) { ?> 
            <p class="card-text small text-black-50"> <?php bootscore_date(); ?></p> 
        
        <?php } 
        
            if ( has_post_thumbnail() ) { // check if the post has a Featured Image assigned to it.
                the_post_thumbnail('thumbnail', array( 'class'  => 'float-left mr-3' ));
            } else { ?>
        <img src="<?php echo esc_url( get_template_directory_uri() ) ?>/images/gui/thumbnail-blog.png" class="float-left mr-3" style="width: 150px;" alt="CE logo">
        <?php } ?>
        <?php the_excerpt(); ?>
    </div>

</div>