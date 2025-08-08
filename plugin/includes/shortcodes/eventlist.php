<?php
/**
 * Shortcode: [zweigold_eventlist]
 * Outputs container div for JS-driven event list.
 */

if (!function_exists('zweigold_register_eventlist_shortcode')) {
	add_action('init', 'zweigold_register_eventlist_shortcode');
	function zweigold_register_eventlist_shortcode() {
		add_shortcode('zweigold_eventlist', 'zweigold_eventlist_shortcode_cb');
	}
}

function zweigold_eventlist_shortcode_cb($atts, $content = '', $tag = '') {
	$atts = shortcode_atts([
		// future attributes here
	], $atts, $tag);

	$options = get_option('zweigold_options');
	$url  = isset($options['zweigold_field_url'])  ? esc_url_raw($options['zweigold_field_url']) : '';
	$user = isset($options['zweigold_field_user']) ? sanitize_text_field($options['zweigold_field_user']) : '';
	$pass = isset($options['zweigold_field_pass']) ? sanitize_text_field($options['zweigold_field_pass']) : '';

	if (empty($url) || empty($user) || empty($pass)) {
		return '<div class="sc_zweigold_eventlist error">' . esc_html__('ZWEIGOLD configuration incomplete.', ZWEIGOLD_EVENTS_TD) . '</div>';
	}

	// Data attributes escaped for HTML context
	$div = sprintf(
		'<div class="sc_zweigold_eventlist" data-url="%s" data-user="%s" data-pass="%s">%s</div>',
		esc_attr($url),
		esc_attr($user),
		esc_attr($pass),
		esc_html__('Events loading ...', ZWEIGOLD_EVENTS_TD)
	);
	return $div;
}

// Enqueue front-end assets only if shortcode present
if (!function_exists('zweigold_eventlist_maybe_enqueue')) {
	add_action('wp_enqueue_scripts', 'zweigold_eventlist_maybe_enqueue');
	function zweigold_eventlist_maybe_enqueue() {
		global $post;
		if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'zweigold_eventlist')) {
			// __DIR__ points to .../includes/shortcodes, wir brauchen Root-Plugin-URL.
			$assets_url  = defined('ZWEIGOLD_EVENTS_URL') ? ZWEIGOLD_EVENTS_URL . 'assets/' : plugin_dir_url(dirname(__DIR__)) . 'assets/';
			$assets_path = defined('ZWEIGOLD_EVENTS_PATH') ? ZWEIGOLD_EVENTS_PATH . 'assets/' : plugin_dir_path(dirname(__DIR__)) . 'assets/';
			$js_version  = file_exists($assets_path . 'script.js') ? filemtime($assets_path . 'script.js') : ZWEIGOLD_EVENTS_VERSION;
			$css_version = file_exists($assets_path . 'styles.css') ? filemtime($assets_path . 'styles.css') : ZWEIGOLD_EVENTS_VERSION;
			wp_enqueue_script('zweigold-events-script', $assets_url . 'script.js', [], $js_version, true);
			wp_script_add_data('zweigold-events-script', 'defer', true);
			wp_enqueue_style('zweigold-events-style', $assets_url . 'styles.css', [], $css_version);
		}
	}
}
