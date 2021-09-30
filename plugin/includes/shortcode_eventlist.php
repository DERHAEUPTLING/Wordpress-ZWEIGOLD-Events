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
		// $sc = shortcode_atts( array(
		// 	'offer' => ''
		// 	), $atts );
		
		// if ($sc['offer'] === '' || $sc['offer'] === 'xxxxx') {
		// 	$output = 'Please add the offer ID to you shortcode. <br> like this:[zweigold_eventlist offer="11111"]';
		// 	return $output;
		// };
	
		?>
		<div class="sc_zweigold_eventlist" 
			data-url="<?= esc_attr($options['zweigold_field_url']) ?>"
			data-user="<?= esc_attr($options['zweigold_field_user']) ?>"
			data-pass="<?= esc_attr($options['zweigold_field_pass']) ?>"></div>
		<?php
	}
}

add_action( 'wp_enqueue_scripts', 'dh_script' );
function dh_script(){
  wp_enqueue_script( 'dh_script', plugin_dir_url( __DIR__ ) . 'assets/script.js',  array(), false, true );
}