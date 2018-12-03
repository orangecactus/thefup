<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html style="margin-top: 0 !important" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>

<div class="animsition">


    <?php if(is_home() || is_front_page() ) { 
        $bg_image = get_theme_mod('scrn_bgimage', '');
        if($bg_image == '') {
            $bg_image = get_template_directory_uri() . '/images/intro-bg.jpg';
        }
        ?>
        <section id="intro" class="intro-1 parallax-window" style="background-color:white;">
        
            <div class="intro-content">
            
                <?php 
                $logo = get_theme_mod('scrn_logo', '');
                $description = get_theme_mod('scrn_header_description', '');
                if($logo != '') { ?>
                    <img src="<?php echo esc_url($logo);?>" alt="<?php bloginfo('name');?>" />
                <?php } 
                else { 
                    $firsttext = get_theme_mod('scrn_header_firsttext', '');
                    $secondtext = get_theme_mod('scrn_header_secondtext', '');
                    ?>

                    <?php if($firsttext != '') { ?>
                        <h1><span class="big-h1"><?php echo esc_attr($firsttext);?></span>
                    <?php } ?>
                    <?php if($secondtext != '') { ?>
                        <br /><?php echo esc_attr($secondtext);?>
                    <?php } ?>
                    </h1>
                <?php } ?>
                <?php if($description != '') { ?>
                    <p><?php echo html_entity_decode(esc_attr($description));?></p>
                <?php } ?>

                <ul class="social-intro list-unstyled list-inline">
                    <?php
                    $facebook = get_theme_mod('scrn_social_facebook', '');
                    $twitter = get_theme_mod('scrn_social_twitter', '');
                    $dribbble = get_theme_mod('scrn_social_dribbble', '');
                    $gplus = get_theme_mod('scrn_social_gplus', '');
                    $linkedin = get_theme_mod('scrn_social_linkedin', '');
                    $instagram = get_theme_mod('scrn_social_instagram', '');
                    $behance = get_theme_mod('scrn_social_behance', '');
                    $vimeo = get_theme_mod('scrn_social_vimeo', '');
                    $youtube = get_theme_mod('scrn_social_youtube', '');
                    $tumblr = get_theme_mod('scrn_social_tumblr', '');
                    $github = get_theme_mod('scrn_social_github', '');
                    ?>

                    <?php if($facebook != '') { ?>
                        <li>
                            <a class="icn-facebook" target="_blank" href="<?php echo esc_url($facebook);?>"><i class="fa fa-facebook"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($twitter != '') { ?>
                        <li>
                            <a class="icn-twitter" target="_blank" href="<?php echo esc_url($twitter);?>"><i class="fa fa-twitter"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($dribbble != '') { ?>
                        <li>
                            <a class="icn-dribbble" target="_blank" href="<?php echo esc_url($dribbble);?>"><i class="fa fa-dribbble"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($gplus != '') { ?>
                        <li>
                            <a class="icn-g-plus" target="_blank" href="<?php echo esc_url($gplus);?>"><i class="fa fa-google-plus"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($linkedin != '') { ?>
                        <li>
                            <a class="icn-linkedin" target="_blank" href="<?php echo esc_url($linkedin);?>"><i class="fa fa-linkedin"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($instagram != '') { ?>
                        <li>
                            <a class="icn-instagram" target="_blank" href="<?php echo esc_url($instagram);?>"><i class="fa fa-instagram"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($behance != '') { ?>
                        <li>
                            <a class="icn-behance" target="_blank" href="<?php echo esc_url($behance);?>"><i class="fa fa-behance"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($vimeo != '') { ?>
                        <li>
                            <a class="icn-vimeo" target="_blank" href="<?php echo esc_url($vimeo);?>"><i class="fa fa-vimeo-square"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($youtube != '') { ?>
                        <li>
                            <a class="icn-youtube" target="_blank" href="<?php echo esc_url($youtube);?>"><i class="fa fa-youtube"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($tumblr != '') { ?>
                        <li>
                            <a class="icn-tumblr" target="_blank" href="<?php echo esc_url($tumblr);?>"><i class="fa fa-tumblr"></i></a>
                        </li>
                    <?php } ?>

                    <?php if($github != '') { ?>
                        <li>
                            <a class="icn-github" target="_blank" href="<?php echo esc_url($github);?>"><i class="fa fa-github"></i></a>
                        </li>
                    <?php } ?>
                 </ul>

            </div>
        </section>
    <?php } ?>

    <div class="js_fixedcontent">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <?php wp_nav_menu(array(
                            'theme_location' => 'top-menu',
                            'container' => '',
                            'fallback_cb' => 'show_top_menu',
                            'menu_class' => 'nav navbar-nav',
                            'echo' => true,
                            'walker' => new description_walker(),
                            'depth' => 0 )
                    );
                    ?>
                </div>
            </div>
        </nav>
    </div>