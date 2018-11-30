<?php 
add_action( 'wp_ajax_teo-contact-form', 'scrn_contact_form' );
add_action( 'wp_ajax_teo-contact-form', 'scrn_contact_form' );
 
function scrn_contact_form() {
    // get the submitted parameters
    $name = esc_html($_POST['name']);
    $email = esc_html($_POST['email']);
    $comment = esc_html($_POST['comment']);
    $msg = esc_attr('Name: ', 'scrn') . $name . PHP_EOL;
    $msg .= esc_attr('E-mail: ', 'scrn') . $email . PHP_EOL;
    $msg .= esc_attr('Message: ', 'scrn') . $comment;
    $to = get_bloginfo('admin_email');
    $sitename = get_bloginfo('name');
    $subject = '[' . $sitename . ']' . ' New Message';
    $headers = 'From: ' . $name . ' <' . $email . '>' . PHP_EOL;
    wp_mail($to, $subject, $msg, $headers);
}

add_action( 'scrn_migrate_data','scrn_migrate_olddata' );

function scrn_migrate_olddata() {
    $updated = get_option('update_option', '');
    if($updated != 'done') {
        $data = get_option('teo_data', '');
        if($data != '') {
            set_theme_mod('scrn_favicon', $data['favicon']['url']);
            set_theme_mod('scrn_logo', $data['logo']['url']);
            set_theme_mod('scrn_header_firsttext', $data['topheader_text']);
            set_theme_mod('scrn_header_secondtext', $data['topheader_smalltext']);
            set_theme_mod('scrn_header_description', $data['topheader_smallertext']);
            set_theme_mod('scrn_bgimage', $data['bg_image1']['url']);
            set_theme_mod('scrn_footer_shortcode', $data['contactform7']);
            set_theme_mod('scrn_footer_address', $data['location']);
            set_theme_mod('scrn_footer_phone', $data['phone']);
            set_theme_mod('scrn_footer_email', $data['email']);
            set_theme_mod('scrn_footer_description', $data['contact_description']);
            set_theme_mod('scrn_social_facebook', $data['facebook_url']);
            set_theme_mod('scrn_social_twitter', 'https://twitter.com/' . $data['twitter_username']);
            set_theme_mod('scrn_social_dribbble', $data['dribble_url']);
            set_theme_mod('scrn_social_gplus', $data['dribble_url']);
            set_theme_mod('scrn_social_linkedin', $data['linkedin_url']);
            set_theme_mod('scrn_social_instagram', $data['instagram_url']);
            set_theme_mod('scrn_social_vimeo', $data['vimeo_url']);
            set_theme_mod('scrn_social_youtube', $data['youtube_url']);
            set_theme_mod('scrn_social_tumblr', $data['tumblr_url']);
            update_option('scrn_updated_old', 'done');
        }
    }
}

wp_schedule_single_event( time() + 2, 'scrn_migrate_data' );

?>