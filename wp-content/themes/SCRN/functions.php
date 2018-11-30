<?php
add_action( 'after_setup_theme', 'scrn_setup' );
if ( ! function_exists( 'vp_setup' ) ){
	function scrn_setup(){
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        load_theme_textdomain('SCRN', get_template_directory() . '/languages');
        require get_template_directory() . '/lib/aqua_resizer.php';
        require get_template_directory() . '/lib/custom-functions.php';
		require get_template_directory() . '/lib/comments.php';
        require get_template_directory() . '/lib/class-tgm-plugin-activation.php';
        require get_template_directory() . '/lib/theme_customizer/settings.php';
        
        if(is_plugin_active('cmb2/init.php') ) {
            require get_template_directory() . '/lib/meta_boxes.php';
        }
	}
}

//Loading the CSS files into the theme
add_action('wp_enqueue_scripts', 'scrn_load_css');
if( !function_exists('scrn_load_css') ) {
	function scrn_load_css() {
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0');
        wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0');
        wp_enqueue_style( 'animsition', get_template_directory_uri() . '/css/animsition.min.css', array(), '1.0');
        wp_enqueue_style( 'animatecss', get_template_directory_uri() . '/css/animate.css', array(), '1.0');
        wp_enqueue_style( 'vanillabox', get_template_directory_uri() . '/css/vanillabox.css', array(), '1.0');
        wp_enqueue_style( 'bxslider', get_template_directory_uri() . '/css/jquery.bxslider.css', array(), '1.0');
		wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . '/style.css', array(), '1.0');

        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'animsition', get_template_directory_uri() . '/js/animsition.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'jquery.smoothscroll', get_template_directory_uri() . '/js/jquery.smoothscroll.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'jquery.fixedcontent', get_template_directory_uri() . '/js/jquery.fixedcontent.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'jquery.vide', get_template_directory_uri() . '/js/jquery.vide.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'jquery.mixitup', get_template_directory_uri() . '/js/jquery.mixitup.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'vanillabox', get_template_directory_uri() . '/js/jquery.vanillabox-0.1.7.min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', array('jquery'), '1.0', false);
        wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.min.js', array('jquery'), '1.0', false);
        wp_enqueue_script( 'matchHeight', get_template_directory_uri() . '/js/jquery.matchHeight-min.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js', array('jquery'), '1.0', true);
        wp_enqueue_script( 'scrn-js', get_template_directory_uri() . '/js/scrn.js', array('jquery'), '1.0', true);

        if ( is_singular() && get_option( 'thread_comments' ) )
            wp_enqueue_script( 'comment-reply' );

        $latitude = get_theme_mod('scrn_footer_latitude', '');
        $longitude = get_theme_mod('scrn_footer_longitude', '');

        $javascript = '
            google.maps.event.addDomListener(window, "load", init);
                var map;
                function init() {
                    var mapOptions = {
                        center: new google.maps.LatLng(' . $latitude . ',' . $longitude  . '),
                        zoom: 16,
                        zoomControl: false,
                        disableDoubleClickZoom: false,
                        mapTypeControl: false,
                        scaleControl: false,
                        scrollwheel: false,
                        panControl: false,
                        streetViewControl: false,
                        draggable : false,
                        overviewMapControl: false,
                        overviewMapControlOptions: {
                            opened: false,
                        },
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}],
                    }
                    var mapElement = document.getElementById("map");
                    var map = new google.maps.Map(mapElement, mapOptions);
                    var locations = [
                ["Apple store", "undefined", "undefined", "undefined", "undefined", 40.7635573, -73.9723018, "https://mapbuildr.com/assets/img/markers/default.png"]
                    ];
                    for (i = 0; i < locations.length; i++) {
                  if (locations[i][1] =="undefined"){ description ="";} else { description = locations[i][1];}
                  if (locations[i][2] =="undefined"){ telephone ="";} else { telephone = locations[i][2];}
                  if (locations[i][3] =="undefined"){ email ="";} else { email = locations[i][3];}
                       if (locations[i][4] =="undefined"){ web ="";} else { web = locations[i][4];}
                       if (locations[i][7] =="undefined"){ markericon ="";} else { markericon = locations[i][7];}
                        marker = new google.maps.Marker({
                            icon: markericon,
                            position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                            map: map,
                            title: locations[i][0],
                            desc: description,
                            tel: telephone,
                            email: email,
                            web: web
                        });
                link = "";     }

                }';

            if($latitude != '' && $longitude != '') {
                wp_add_inline_script('scrn-js', $javascript);
            }
	}
}

add_action('init', 'scrn_misc');
function scrn_misc() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails');
    add_theme_support( "title-tag" );
	
}
if ( ! isset( $content_width ) ) $content_width = 960;

function scrn_encEmail ($orgStr) {
    $encStr = "";
    $nowStr = "";
    $rndNum = -1;

    $orgLen = strlen($orgStr);
    for ( $i = 0; $i < $orgLen; $i++) {
        $encMod = rand(1,2);
        switch ($encMod) {
        case 1: // Decimal
            $nowStr = "&#" . ord($orgStr[$i]) . ";";
            break;
        case 2: // Hexadecimal
            $nowStr = "&#x" . dechex(ord($orgStr[$i])) . ";";
            break;
        }
        $encStr .= $nowStr;
    }
    return $encStr;
} 

function scrn_register_menus() {
	register_nav_menus( array( 'top-menu' => 'Top primary menu')
						);
}
add_action('init', 'scrn_register_menus');

class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth=0, $args=array(), $id=0)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           if($item->object == 'page')
           {
                $varpost = get_post($item->object_id);
                $attributes .= ' href="' . get_site_url() . '/#' . $varpost->post_name . '"';
           }
           else
                $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );
            $item_output .= $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
            }
}

add_action('widgets_init', 'scrn_sidebars');
function scrn_sidebars() {
	$args = array(
				'name'          => 'Right sidebar',
                'id'            => 'right-sidebar',
				'before_widget' => '<div id="%1$s" class="padding-bottom %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<p class="sidebar-title">',
				'after_title'   => '</p>' );
	register_sidebar($args);
}

add_action( 'tgmpa_register', 'scrn_register_required_plugins' );
function scrn_register_required_plugins() {
  $plugins = array(

        // This is an example of how to include a plugin pre-packaged with a theme.
        array(
            'name'               => 'SCRN Custom Post Types', // The plugin name.
            'slug'               => 'scrn-teothemes', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/scrn-teothemes.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'Visual Composer', // The plugin name.
            'slug'               => 'js_composer', // The plugin slug (typically the folder name).
            'source'             => get_template_directory() . '/plugins/codecanyon-242431-visual-composer-page-builder-for-wordpress-wordpress-plugin.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        // This is an example of how to include a plugin from a private repo in your theme.
        array(
            'name'               => 'CMB2', // The plugin name.
            'slug'               => 'cmb2', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

        array(
            'name'               => 'One click demo import', // The plugin name.
            'slug'               => 'one-click-demo-import', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),

    );

    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );

    tgmpa( $plugins, $config );
}

function ubertube_import_files() {
  return array(
    array(
      'import_file_name'           => 'Main Demo',
      'import_file_url'            => get_template_directory_uri() . '/lib/import/sample-content.xml',
      'import_customizer_file_url' => get_template_directory_uri() . '/lib/import/sample-customizer.dat',
      'import_notice'              => esc_html__( 'Please notice that some of the pictures may not show up.', 'ubertube' ),
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'ubertube_import_files' );

?>