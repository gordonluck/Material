<?php
function theme_gzip() {
    if (strstr($_SERVER['REQUEST_URI'],'/js/tinymce'))
        return false;
    if((ini_get('zlib.output_compression')=='On'||ini_get('zlib.output_compression_level')<0)||ini_get('output_handler')=='ob_gzhandler')
        return false;
    if (extension_loaded('zlib')&&!ob_start('ob_gzhandler'))
        ob_start();
}
add_filter('show_admin_bar', '__return_false');
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
remove_action( 'wp_head', 'feed_links', 2 ); 
remove_action( 'wp_head', 'feed_links_extra', 3 ); 
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' ); 
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action( 'publish_future_post','check_and_publish_future_post',10, 1 );
remove_action( 'wp_head', 'noindex', 1 );
remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' ); 
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
remove_action( 'rest_api_init', 'wp_oembed_register_route');
remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);

remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
remove_filter( 'oembed_response_data',   'get_oembed_response_data_rich',  10, 4);

remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
remove_action( 'wp_head', 'wp_oembed_add_host_js');
add_action('widgets_init', 'my_remove_recent_comments_style');
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style'));
} 
function remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
    return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
function disable_emojis_tinymce( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}
class Disable_Google_Fonts {
    public function __construct() {
    add_filter( 'gettext_with_context', array( $this, 'disable_open_sans' ), 888, 4 );
    }
    public function disable_open_sans( $translations, $text, $context, $domain ) {
    if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
    $translations = 'off';
    }
    return $translations;
    }
}
$disable_google_fonts = new Disable_Google_Fonts;