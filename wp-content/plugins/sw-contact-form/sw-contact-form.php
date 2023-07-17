<?php

/**
 * @package sw_contact_form
 * @version 1.7.2
 */
/*
Plugin Name: SW CONTACT FORM
Plugin URI: http://wordpress.org/plugins/sw_contact_form/
Description: This plugin saves contact details of users so that they can get a callback on demand.
Author: Stately World
Version: 1.7.2

*/


define('SW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SW_PLUGIN_URL', plugin_dir_url(__FILE__));
// echo SW_PLUGIN_URL . 'js/script.js';die;

/* Admin interface to display data from DB */

// Loading WP_List_Table class file
// We need to load it as it's not automatically loaded by WordPress
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/* Extending Class */

class Sw_Contact_Form_List_Table extends WP_List_Table
{
    // define $table_data property
    private $table_data;

    // Define table columns
    function get_columns()
    {
        $columns = array(
            'cb'            => '<input type="checkbox" />',
            'name'          => __('Name', 'contactform-cookie-consent'),
            'mobile'         => __('Mobile', 'contactform-cookie-consent'),
            'email'   => __('Email', 'contactform-cookie-consent'),
            'time'   => __('Date', 'contactform-cookie-consent'),

        );
        return $columns;
    }
    // Bind table with columns, data and all

    function prepare_items()
    {
        //data
        if (isset($_POST['s'])) {
            $this->table_data = $this->get_table_data($_POST['s']);
        } else {
            $this->table_data = $this->get_table_data();
        }

        $columns = $this->get_columns();
        $hidden = (is_array(get_user_meta(get_current_user_id(), 'managetoplevel_page_contactform_list_tablecolumnshidden', true))) ? get_user_meta(get_current_user_id(), 'managetoplevel_page_contactform_list_tablecolumnshidden', true) : array();
        $sortable = $this->get_sortable_columns();
        $primary  = 'id';
        $this->_column_headers = array($columns, $hidden, $sortable, $primary);
        usort($this->table_data, array(&$this, 'usort_reorder'));


        /* pagination */
        $per_page = $this->get_items_per_page('elements_per_page', 10);
        $current_page = $this->get_pagenum();
        $total_items = count($this->table_data);

        $this->table_data = array_slice($this->table_data, (($current_page - 1) * $per_page), $per_page);

        $this->set_pagination_args(array(
            'total_items' => $total_items, // total number of items
            'per_page'    => $per_page, // items to show on a page
            'total_pages' => ceil($total_items / $per_page) // use ceil to round up
        ));
        $this->items = $this->table_data;
    }
    // Get table data
    private function get_table_data($search = '')
    {
        global $wpdb;

        $table = $wpdb->prefix . 'sw_contact_form_data';

        if (!empty($search)) {
            return $wpdb->get_results(
                "SELECT * from {$table} WHERE name Like '%{$search}%' OR mobile Like '%{$search}%' OR email Like '%{$search}%'",
                ARRAY_A
            );
        } else {
            return $wpdb->get_results(
                "SELECT * from {$table}",
                ARRAY_A
            );
        }
    }
    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'name':
            case 'email':
            case 'mobile':
            case 'time':
            default:
                return $item[$column_name];
        }
    }
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="element[]" value="%s" />',
            $item['id']
        );
    }
    protected function get_sortable_columns()
    {
        $sortable_columns = array(
            'name'  => array('name', false),
            'email' => array('email', false),
            'mobile'   => array('mobile', false),
            'time'   => array('time', true),
        );
        return $sortable_columns;
    }
    // Sorting function
    function usort_reorder($a, $b)
    {
        // If no sort, default to id
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'time';

        // If no order, default to asc
        $order = (!empty($_GET['order'])) ? $_GET['order'] : 'desc';

        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);

        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }
    // To show bulk action dropdown
    function get_bulk_actions()
    {
        $actions = array(
            'delete_all'    => __('Delete', 'sw_contact_form_data'),
            'draft_all' => __('Move to Draft', 'sw_contact_form_data')
        );
        return $actions;
    }
}

// Adding menu
function sw_add_contact_form_menu_items()
{
    global $contactform_sample_page;
    // add settings page
    $contactform_sample_page = add_menu_page(__('Black Pearl Leads', 'sw_contactform-admin-table'), __('Black Pearl Leads', 'sw_contactform-admin-table'), 'manage_options', 'contact_form_list_table', 'contact_form_list_init');

    add_action("load-$contactform_sample_page", "contactform_sample_screen_options");
}
add_action('admin_menu', 'sw_add_contact_form_menu_items');

// add screen options
function contactform_sample_screen_options()
{

    global $contactform_sample_page;
    global $table;

    $screen = get_current_screen();

    // get out of here if we are not on our settings page
    if (!is_object($screen) || $screen->id != $contactform_sample_page)
        return;

    $args = array(
        'label' => __('Elements per page', 'sw_contactform-admin-table'),
        'default' => 2,
        'option' => 'elements_per_page'
    );
    add_screen_option('per_page', $args);

    $table = new Sw_Contact_Form_List_Table();
}

// Plugin menu callback function
function contact_form_list_init()
{
    // Creating an instance
    $table = new Sw_Contact_Form_List_Table();

    echo '<div class="wrap"><h2>Black Pearl Leads</h2>';
    echo '<form method="post">';
    // Prepare table
    $table->prepare_items();
    // Search form
    $table->search_box('search', 'search_id');
    // Display table
    $table->display();
    echo '</div></form>';
}

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
    ob_start();
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
