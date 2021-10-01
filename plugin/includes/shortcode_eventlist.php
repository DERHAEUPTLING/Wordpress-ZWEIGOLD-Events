<?php


add_action('init', 'zweigold_eventlist_init');
function zweigold_eventlist_init() {

	/**
	 * booking widget
	 * [zweigold_eventlist offer="xxx"]
	 * @return iframe 
	 */
	
	add_shortcode('zweigold_eventlist', 'dh_zweigold_eventlist');
	function dh_zweigold_eventlist( $atts, $content, $tag ) {
		
		$options = get_option( 'zweigold_options' );
		$url =  esc_attr($options['zweigold_field_url']);
		$user = esc_attr($options['zweigold_field_user']);
		$pass = esc_attr($options['zweigold_field_pass']);

		$output= "<div 
			class='sc_zweigold_eventlist'
			data-url={$url}
			data-user={$user}
			data-pass={$pass}>events loading ...</div>";
		return $output;
	}
}

add_action('wp_enqueue_scripts', 'enqueued_assets');
function enqueued_assets() {
	wp_enqueue_script('script', plugin_dir_url(__DIR__) . 'assets/script.js', array(), false, true);
	wp_enqueue_style('style', plugin_dir_url(__DIR__) . 'assets/styles.css', array(), false);
}
