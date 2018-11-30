<?php 
get_header();
the_post(); 
$thumbnail = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$style = get_post_meta($post->ID, '_page_style', true);
?>
 <section class="bg <?php if($style == 2) echo 'dark-bg';?>">
    <header>
        <h2><?php the_title();?></h2>
        <?php 
        $subheader = get_post_meta($post->ID, '_page_subheader', true);
        if($subheader != '') {
            echo '<p>' . esc_html($subheader) . '</p>';
        }
        ?>
    </header>

    <div class="container">
        <div class="row">
            <div class="single-post col-sm-12">
                <div style="text-align: center">
                    <?php if(has_post_thumbnail() ) { ?>
                        <a href="<?php the_permalink();?>">
                            <?php
                            $thumb = aq_resize($thumbnail, 960, 300, true);
                            if($thumb == '' && $fullwidth != 2) {
                                //trying to resize it to smaller dimensions
                                $thumb = aq_resize($thumbnail, 700, 250, true);
                            }
                            if($thumb == '') {
                                //too small image, we keep the original one
                                $thumb = $thumbnail;
                            }
                            ?>
                            <img src="<?php echo $thumb;?>" class="scale-with-grid" alt="<?php the_title();?>" />
                        </a>
                    <?php } ?>
                </div>
                <?php the_content();?>
                <?php 
                edit_post_link(); 
                echo '<br />';
                ?>
            </div> <!-- end post -->
        </div>
    </div>
</section>
<?php get_footer();?>