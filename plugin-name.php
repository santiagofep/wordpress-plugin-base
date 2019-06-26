
<?php
/**
 * Plugin Name: Plugin name
 * Plugin URI:  https:woo.moship.io
 * Description: Description of the plugin
 * Version:     1.0.0
 * Author:      moship
 * Author URI:  https:woo.moship.io
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: plugin-name
 * Domain Path: /languages
 *  
 * WC requires at least: 2.2
 * WC tested up to: 2.3
 * 
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    /**
     * Never worry about cache again!
     */
    function plugin_name_public_assets($hook)
    {
        $js_ver  = date("ymd-Gis", filemtime(plugin_dir_path(__FILE__) . 'assets/dist/main.js'));
        wp_enqueue_script('plugin_name_main', plugins_url('assets/dist/main.js', __FILE__), array(jquery), $js_ver);
        wp_localize_script(
            'plugin_name_main',
            'plugin_name_object',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
            )
        );
    }
    add_action('wp_enqueue_scripts', 'plugin_name_public_assets');
    /**
     * Register text domain
     */
    function plugin_name_load_plugin_textdomain()
    {
        load_plugin_textdomain('plugin-name', FALSE, basename(dirname(__FILE__)) . '/languages/');
    }
    add_action('plugins_loaded', 'plugin_name_load_plugin_textdomain');
}
