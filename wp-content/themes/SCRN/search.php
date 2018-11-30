<?php 
get_header();
?>
<section class="bg">
    <div class="container">
        <header>
            <h2><?php printf( __( 'Search Results for: %s', 'SCRN' ), get_search_query() ); ?></h2>
        </header>

        <div class="row">
            <?php
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
            endif;?>
        </div> 
    </div>
</section>
<?php get_footer();?>