<?php 
get_header();
the_post(); 
$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$fullwidth = get_post_meta($post->ID, '_individual_fullwidth', true);
?>

<section class="blog-intro" <?php if($thumbnail != '') echo 'style="background-image: url(\'' . esc_url($thumbnail) . '\')"'?>>
  <header>
    <p class="post-title"><?php the_title();?></p>
    <p class="post-date"><?php echo sprintf(esc_html__('by %s on %s', 'SCRN'), get_the_author_link(), get_the_date() );?></p>
  </header>
  <div class="blog-nav blog-nav-left"><?php previous_post_link('%link', __('Previous post', 'SCRN') );?> </div>
  <div class="blog-nav blog-nav-right"><?php next_post_link('%link', __('Next post', 'SCRN') );?></div>
</section>
<div class="container">
    <div class="row row-centered">
        <div class="col-lg-8 col-centered col-md-12">
            <section class="blog-post">
                <?php the_content();?>
                <?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','SCRN').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                <div class="tags">
                    <?php the_tags('<span>' . esc_html__('Tags: ', 'SCRN') . '</span>' . '<div class="tag">', '</div> <div class="tag">', '</div><br />'); ?> 
                </div>
                 <?php 
                edit_post_link(); 
                echo '<br />';
                ?>
            </section> <!-- end post -->
        </div>
    </div>

    <?php comments_template('', true); ?>
</div>
<?php get_footer();?>