<?php

/**
 * Plugin Name: ZWEIGOLD Events
 * Plugin URI: https://github.com/DERHAEUPTLING/Wordpress-ZWEIGOLD-Events
 * Description: Add eventlist from Agentur ZWEIGOLD from their API
 * Version: 1.0.0
 * Author: DER HÄUPTLING
 * Author URI: https://derhaeuptling.de/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ZWEIGOLD Events
 */


if (is_admin()) {
	require plugin_dir_path(__FILE__) . 'includes/admin.php';
	require plugin_dir_path(__FILE__) . 'includes/admin_template.php';
}


require plugin_dir_path(__FILE__) . 'includes/shortcode_eventlist.php';

