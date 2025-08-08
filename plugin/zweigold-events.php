<?php

/**
 * Plugin Name: ZWEIGOLD Events
 * Plugin URI: https://github.com/DERHAEUPTLING/Wordpress-ZWEIGOLD-Events
 * Description: Add eventlist from Agentur ZWEIGOLD from their API
 * Version: 1.0.1
 * Author: DER HÄUPTLING
 * Author URI: https://derhaeuptling.de/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: zweigold-events
 */

// Define base path & url constants once.
if (!defined('ZWEIGOLD_EVENTS_PATH')) {
	define('ZWEIGOLD_EVENTS_PATH', plugin_dir_path(__FILE__));
}
if (!defined('ZWEIGOLD_EVENTS_URL')) {
	define('ZWEIGOLD_EVENTS_URL', plugin_dir_url(__FILE__));
}
if (!defined('ZWEIGOLD_EVENTS_VERSION')) {
	define('ZWEIGOLD_EVENTS_VERSION', '1.0.1');
}
if (!defined('ZWEIGOLD_EVENTS_TD')) {
	define('ZWEIGOLD_EVENTS_TD', 'zweigold-events');
}


if (is_admin()) {
	require plugin_dir_path(__FILE__) . 'includes/admin/settings.php';
	require plugin_dir_path(__FILE__) . 'includes/admin/page.php';
}


require plugin_dir_path(__FILE__) . 'includes/shortcodes/eventlist.php';

