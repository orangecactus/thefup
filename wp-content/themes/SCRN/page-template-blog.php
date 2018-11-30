<?php
/* 
Template name: Blog page template
*/
get_header();
global $scrn;
the_post(); 
$nrposts = get_post_meta($post->ID, '_blog_nrposts', true);
$style = get_post_meta($post->ID, '_page_style', true);
$categories = get_post_meta($post->ID, '_blog_categories', true);
?>

 <section class="bg <?php if($style == 2) echo 'dark-bg';?>" id="blog">
    <div class="container">
       <header>
            <h2><?php the_title();?></h2>
            <?php 
            $subheader = get_post_meta($post->ID, '_page_subheader', true);
            if($subheader != '') {
                echo '<p>' . esc_html($subheader) . '</p>';
            }
            ?>
        </header>

        <!-- start sixteen columns -->
        <div class="row">
            <?php
            $args['posts_per_page'] = $nrposts;
            if(count($categories) > 0)
                $args['category__in'] = $categories;
            $paged = is_front_page() ? get_query_var( 'page' ) : get_query_var( 'paged' );
            $args['paged'] = $paged;
            query_posts($args);
            $i = 1;
            if(have_posts()) : while(have_posts()) : the_post();
                $thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );?>
                 <div class="col-sm-4">
                    <?php if(has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink();?>">
                            <?php
                            $thumb = aq_resize($thumbnail, 400, 232, true);
                            if($thumb == '') {
                                $thumb = $thumbnail;
                            }
                            ?>
                            <img src="<?php echo $thumb;?>" class="scale-with-grid" alt="<?php the_title();?>" />
                        </a>
                    <?php } ?>
                    <div class="post-preview">
                        <p class="post-preview-date"><?php the_date();?></p>
                        <a class="post-preview-title" href="<?php the_permalink();?>"><?php the_title();?></a>

                        <p><?php echo wp_trim_words(strip_shortcodes($post->post_content), 15, null);?></p>
                        <a class="read-more" href="<?php the_permalink();?>"><?php _e('Read more', 'SCRN');?></a>
                    </div> <!-- end post -->
                </div>
            <?php endwhile; 
            get_template_part('includes/pagination');
            endif; wp_reset_query();?>
        </div> <!-- end sixteen columns -->

    </div>
</section>
<?php get_footer();?>