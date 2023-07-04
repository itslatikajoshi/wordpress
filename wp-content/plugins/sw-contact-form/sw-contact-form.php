<?php

/**
 * @package sw_contact_form
 * @version 1.7.2
 */
/*
Plugin Name: SW CONTACT FORM
Plugin URI: http://wordpress.org/plugins/sw_contact_form/
Description: This plugin saves contact details of users so that they can get a callback on demand.To add the shortcode for using the plugin :[sw_contact_form]
Author: Stately World
Version: 1.7.2

*/


define('SW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SW_PLUGIN_URL', plugin_dir_url(__FILE__));
// echo SW_PLUGIN_URL . 'js/script.js';die;

/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts()
{
    wp_enqueue_style('sw_contact_form-style', SW_PLUGIN_URL . 'css/style.css', array(), rand(111, 9999), 'all');
    wp_enqueue_script('sw_contact_form-script', SW_PLUGIN_URL . 'js/script.js', array(), rand(111, 9999), true);

    wp_enqueue_script('sw_contact_form-script', plugins_url('/js/my_query.js', __FILE__), array('jquery'));
    wp_localize_script('sw_contact_form-script', 'ajax_object',  array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts');

//[sw_contact_form]
function sw_contact_form_func($atts)
{
    #ob_start();
    include 'form_template.php';
    return ob_get_clean();
}
add_shortcode('sw_contact_form', 'sw_contact_form_func');


global $sw_contact_form_db_version;
$sw_contact_form_db_version = '1.0';

function sw_contact_form_install()
{
    global $wpdb;
    global $sw_contact_form_db_version;

    $table_name = $wpdb->prefix . 'sw_contact_form_data';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		name tinytext NOT NULL,
		email varchar(55) DEFAULT '' NOT NULL,
		mobile varchar(55) DEFAULT '' NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);

    add_option('sw_contact_form_db_version', $sw_contact_form_db_version);
}

function sw_contact_form_install_data()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'sw_contact_form_data';

    $wpdb->insert(
        $table_name,
        array(
            'time' => current_time('mysql'),
            'name' => "Gaurav Joshi",
            'email' => "gauravjoshi.uk.in@gmail.com",
            'mobile' => "8556909577",
        )
    );
}


register_activation_hook(__FILE__, 'sw_contact_form_install');
register_activation_hook(__FILE__, 'sw_contact_form_install_data');


add_action('wp_ajax_sw_contact_form_filter', 'sw_contact_form_filter_function');
add_action('wp_ajax_nopriv_sw_contact_form_filter', 'sw_contact_form_filter_function');

function sw_contact_form_filter_function()
{

    global $wpdb;
    $table_name = $wpdb->prefix . 'sw_contact_form_data';

    if ($wpdb->insert(
        $table_name,
        array(
            'time' => current_time('mysql'),
            'name' => $_POST['data'][0]['value'],
            'email' => $_POST['data'][1]['value'],
            'mobile' => $_POST['data'][2]['value'],
        )
    )) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
    die;
}
