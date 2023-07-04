<?php

/**
 * Plugin Name: The Events Calendar Customization 
 * Plugin URI: https://statelyworld.com/plugins/sw-modal-popup/
 * Description: The Events Calendar Customization  by Gaurav J
 * Version: 1.10.3
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Gaurav Joshi
 * Author URI: https://statelyworld.com/gauravj
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://statelyworld.com/plugins/sw-modal-popup/
 * Text Domain: sw-modal-popup
 * Domain Path: /languages
 */

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

define('SW_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SW_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Proper way to enqueue scripts and styles.
 */
function wpdocs_theme_name_scripts()
{
    wp_enqueue_style('sw-modal-popup-style', SW_PLUGIN_URL . 'css/style.css', array(), rand(111, 9999), 'all');
    wp_enqueue_script('sw-modal-popup-script', SW_PLUGIN_URL . 'js/script.js', array(), rand(111, 9999), true);
    wp_enqueue_script('ajax-script', plugins_url('/js/my_query.js', __FILE__), array('jquery'));

    wp_localize_script('ajax-script', 'ajax_object',  array('ajax_url' => admin_url('admin-ajax.php')));

    wp_enqueue_style('sw-modal-popup-style', SW_PLUGIN_URL . 'css/style.css', array(), rand(111, 9999), 'all');
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts');


//[sw_modal_popup title="My Title"]
function sw_modal_popup_func($atts)
{
    ob_start();
?>
    <div class="video_wrapper">
        <!-- Trigger/Open The Modal -->
        <p class="video_title"><i class="fa fa-video-camera" aria-hidden="true"></i>
            <?php echo $atts['title']; ?></p>

        <!-- The Modal -->
        <div class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <?php echo do_shortcode('[sw_ajax_search_form]'); ?>
            </div>
        </div>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('sw_modal_popup', 'sw_modal_popup_func');


//[sw_ajax_search_form]
function sw_ajax_search_form_func($atts)
{
    ob_start();
?>
    <div class="sw_ajax_search_form_wrap">
        <h1 class="event_heading">SEARCH</h1>
        <hr style="
            width: 64px;
            height: 4px;
            background: red;
            border: 0px;
        ">
        <h2 class="event_sub_heading">Find Events</h2>
        <form class="form-inline event_search_form" action="/candidate29/wp-admin/admin-ajax.php" method="POST" class="filter" autocomplete="off">
            <div class="input_wrap">

                <select class="select_state" name="state" required></select>
            </div>
            <div class="input_wrap">
                <input type="text" name="region" value="" placeholder="Region">
            </div>
            <div class="input_wrap">
                <input type="submit" name="search" class="search" value="Search" placeholder="Region">
            </div>
            <input type="hidden" name="action" value="the_event_filter">
        </form>
        <div class="response_wrap">
            <img class="loder_img" src="/candidate29/wp-content/uploads/2023/05/1497.gif" style="display: block;margin: auto;">


            <div class="response">

            </div>

        </div>
    </div>
<?php

    return ob_get_clean();
}
add_shortcode('sw_ajax_search_form', 'sw_ajax_search_form_func');



add_action('wp_ajax_the_event_filter', 'the_event_filter_function');
add_action('wp_ajax_nopriv_the_event_filter', 'the_event_filter_function');

function the_event_filter_function()
{
    global $wpdb;
    if (isset($_POST['statesList'])) {
        $resultsStates = $wpdb->get_results("select meta_value as name , meta_value as value from $wpdb->postmeta WHERE meta_key = '_VenueProvince'", ARRAY_A);
        echo json_encode($resultsStates);
        die;
    } else {
        $args = ['posts_per_page' => -1, 'post_type' => 'tribe_venue', 'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => '_VenueProvince',
                'value' => sanitize_text_field($_POST['state']),
                'compare' => 'LIKE'
            ),
            array(
                'key' => '_VenueCity',
                'value' => sanitize_text_field($_POST['region']),
                'compare' => 'LIKE'
            ),
        )];

        // The Query
        $the_query = new WP_Query($args);

        // The Loop
        if ($the_query->have_posts()) {
            echo '<div class="tribe-events-calendar-list">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $results = $wpdb->get_results("select post_id, meta_key,meta_value from $wpdb->postmeta where meta_value = '" . $the_query->post->ID . "'", ARRAY_A);
                $postId = get_post($results[0]['post_id']);
                // _EventVenueID

                echo '<h4><a href="' . get_permalink($postId) . '">' . $postId->post_title . '</a></h4>';
                echo '<div>' . $postId->post_content . '</div>';
                echo '<div>City: ' . get_post_meta($the_query->post->ID, '_VenueCity', true) . '</div>';
                echo '<div>State: ' . get_post_meta($the_query->post->ID, '_VenueProvince', true) . '</div>';
            }
            echo '</div>';
        } else {
            echo '<div><h2 style="text-align:center;color:red;">' . "Event Not Found.." . '</h2></div>';
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        die;
    }
}

add_action('wp_footer', 'my_callback');
function my_callback()
{
    echo do_shortcode('[sw_modal_popup title="Find Events"]');
}

//[sw_modal_popup title="Find Events"]