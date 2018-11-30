<?php 
get_header(); ?>    
    <?php 
    if ( ( $locations = get_nav_menu_locations() ) && isset($locations['top-menu']) ) {
        $menu = wp_get_nav_menu_object( $locations['top-menu'] );
        $include = array();
        if($menu) { 
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            if(isset($menu_items) && is_array($menu_items) ) {
                foreach($menu_items as $item) {
                    if($item->object == 'page')
                        $include[] = $item->object_id;
                }
            }
            $query = new WP_Query( array( 'post_type' => 'page', 'post__in' => $include, 'posts_per_page' => count($include), 'orderby' => 'post__in' ) );
        }
        else {
            $query = new WP_Query(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
        }
    }
    else {
        $query = new WP_Query(array( 'post_type' => 'page', 'posts_per_page' => 4, 'orderby' => 'menu_order', 'order' => 'ASC' ) );
    }
    $i = 1;
    while($query->have_posts() ) : $query->the_post(); 
        $template_file = get_post_meta($post->ID,'_wp_page_template',TRUE);
        $style = get_post_meta($post->ID, '_page_style', true);
        $slogantext = get_post_meta($post->ID, '_page_slogantext', true);
        $sloganimg = get_post_meta($post->ID, '_page_sloganimg', true);
    ?>
        <section class="bg <?php if($style == 2) echo 'dark-bg';?>" id="<?php echo $post->post_name;?>">
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

                    <?php global $more; $more = 0; the_content('');?>

            <?php
            //****** Blog page template *******//
            if($template_file == 'page-template-blog.php') {  
            $categories = get_post_meta($post->ID, '_blog_categories', true);
            $permalink = get_permalink();
            ?>

                <div class="row">
                    <?php
                    $args = array();
                    $args['post_type'] = 'post';
                    if(count($categories) > 0) {
                        $args['category__in'] = $categories;
                    }
                    $qquery = new WP_Query($args);
                    while($qquery->have_posts() ) : $qquery->the_post();
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
                                <p class="post-preview-date"><?php echo esc_html__('Posted on', 'SCRN') . ' '; the_time( get_option( 'date_format' ) ); ?></p>
                                <a class="post-preview-title" href="<?php the_permalink();?>"><?php the_title();?></a>

                                <p><?php echo wp_trim_words(strip_shortcodes($post->post_content), 15, null);?></p>
                                <a class="read-more" href="<?php the_permalink();?>"><?php _e('Read more', 'SCRN');?></a>
                            </div> <!-- end post -->
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>

            <div class="sixteen columns">
                <div style="text-align: center">
                    <a href="<?php echo $permalink;?>" class="btn btn-default"><?php _e('View all blog posts', 'SCRN');?></a>
                    </a>
                </div>
            </div>
            <?php }
            //****** Blog page template *******//
            ?>
                
            </div> <!-- end container -->
        </section> <!-- end bg -->
        
        <?php if($sloganimg != '') { ?>
            <section id="separator_<?php echo $i;?>" class="separator parallax-window" style="background-image: url('<?php echo esc_url($sloganimg);?>')">
                <p><?php if($slogantext != '') echo $slogantext;?></p>
            </section>
        <?php } ?>
    <?php $i++; endwhile; wp_reset_postdata(); ?>

    <section id="contact" class="dark-bg">
        <div class="container">
        
            <header>
                <h2><?php _e('Contact', 'SCRN');?></h2>
                <?php 
                $description = get_theme_mod('scrn_footer_description', '');
                if($description != '') {
                    echo '<p>' . esc_html($description) . '</p>';
                }
                ?>
            </header> <!-- end sixteen columns -->
                        
            <div class="row row-centered">
                <div class="col-md-8 col-sm-12 col-centered">
                <?php
                $address = get_theme_mod('scrn_footer_address', '');
                $phone = get_theme_mod('scrn_footer_phone', '');
                $email = get_theme_mod('scrn_footer_email', '');
                $contact_shortcode = get_theme_mod('footer_shortcode', '');
                $latitude = get_theme_mod('scrn_footer_latitude', '');
                $longitude = get_theme_mod('scrn_footer_longitude', '');

                if($address != '' || $phone != '' || $email != '') { ?>
                    <ul class="contact-info list-unstyled list-inline">
                    
                    <?php if($address != '') { ?>
                        <li>
                            <div class="content">
                                <i class="fa fa-home"></i>
                                <p><?php echo esc_attr($address);?></p>
                            </div> <!-- /.content -->
                        </li>
                    <?php } ?>

                    <?php if($phone != '') { ?>
                        <li>
                            <div class="content">
                                <i class="fa fa-home"></i>
                                <p><?php echo esc_attr($phone);?></p>
                            </div> <!-- /.content -->
                        </li>
                    <?php } ?>

                    <?php if($email != '') { ?>
                        <li>
                            <div class="content">
                                <i class="fa fa-home"></i>
                                <p><?php echo scrn_encEmail(sanitize_email($email) );?></p>
                            </div> <!-- /.content -->
                        </li>
                    <?php } ?>
                    </ul>
                <?php } ?>

                <?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
                $contactform7 = get_theme_mod('scrn_footer_shortcode', '');
                if(is_plugin_active('contact-form-7/wp-contact-form-7.php') && is_plugin_active('scrn-teothemes/index.php') && $contactform7 != '') { 
                    echo do_shortcode(html_entity_decode($contactform7) );
                } else { ?>
                    
                    <div class="done">
                        <?php _e('<b>Thank you!</b> I have received your message.', 'SCRN');?> 
                    </div>
                    
                    <form id="contactForm" method="post" action="">

                         <p><?php _e('Name', 'SCRN');?></p>
                        <input type="text" name="name" class="text" />
                            
                        <p><?php _e('E-mail', 'SCRN');?></p>
                        <input type="text" name="email" class="text" id="email" />

                        <p><?php _e('Message', 'SCRN');?></p>
                        <textarea rows="5" name="comment" class="text"></textarea>

                        <button class="btn btn-default" type="submit" id="submit"><?php _e('Send', 'SCRN');?></button>
                    </form>
                <?php } ?>
                        
                </div> <!-- end contact-form -->
            </div>             
        </div> <!-- end container -->

        <?php if($latitude != '' && $longitude != '') { ?>
            <!-- ************ google map ************ -->
            <div id='map'></div>
        <?php } ?>

    </section> <!-- end contact -->

    
    
<?php get_footer();?>