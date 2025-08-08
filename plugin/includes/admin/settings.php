<?php
/**
 * Admin Settings Registration for ZWEIGOLD Events
 */

// Register settings & fields
function zweigold_settings_init() {
	register_setting('zweigold', 'zweigold_options', [
		'sanitize_callback' => 'zweigold_events_sanitize_options'
	]);

	add_settings_section(
		'zweigold_settings_section',
		__('Einstellungen - API Zugangsdaten:', ZWEIGOLD_EVENTS_TD),
		'zweigold_settings_section_cb',
		'zweigold'
	);

	add_settings_field(
		'zweigold_field_url',
		__('API url', ZWEIGOLD_EVENTS_TD),
		'zweigold_field_url_cb',
		'zweigold',
		'zweigold_settings_section',
		['label_for' => 'zweigold_field_url']
	);

	add_settings_field(
		'zweigold_field_user',
		__('API user', ZWEIGOLD_EVENTS_TD),
		'zweigold_field_user_cb',
		'zweigold',
		'zweigold_settings_section',
		['label_for' => 'zweigold_field_user']
	);

	add_settings_field(
		'zweigold_field_pass',
		__('API password', ZWEIGOLD_EVENTS_TD),
		'zweigold_field_pass_cb',
		'zweigold',
		'zweigold_settings_section',
		['label_for' => 'zweigold_field_pass']
	);
}
add_action('admin_init', 'zweigold_settings_init');

function zweigold_settings_section_cb($args) { ?>
	<p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Bitte trage hier die ZWEIGOLD API-Zugangsdaten ein:', ZWEIGOLD_EVENTS_TD); ?></p>
<?php }

// Field callbacks
function zweigold_field_url_cb($args) {
	$options = get_option('zweigold_options'); ?>
	<input type="url" id="<?php echo esc_attr($args['label_for']); ?>" name="zweigold_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo esc_attr($options['zweigold_field_url'] ?? ''); ?>" required />
<?php }

function zweigold_field_user_cb($args) {
	$options = get_option('zweigold_options'); ?>
	<input type="text" id="<?php echo esc_attr($args['label_for']); ?>" name="zweigold_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo esc_attr($options['zweigold_field_user'] ?? ''); ?>" required />
<?php }

function zweigold_field_pass_cb($args) {
	$options = get_option('zweigold_options'); ?>
	<input type="password" id="<?php echo esc_attr($args['label_for']); ?>" name="zweigold_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo esc_attr($options['zweigold_field_pass'] ?? ''); ?>" required autocomplete="new-password" />
<?php }

// Admin menu
function zweigold_options_page() {
	add_menu_page(
		'ZWEIGOLD Events', // page title (oben auf der Seite)
		'ZWEIGOLD',       // menu title (Seitenleiste)
		'manage_options',
		'zweigold',
		'zweigold_options_page_html',
		'dashicons-tickets-alt',
		59
	);
}
add_action('admin_menu', 'zweigold_options_page');

// Sanitize options
function zweigold_events_sanitize_options($input) {
	$clean = [];
	$clean['zweigold_field_url']  = isset($input['zweigold_field_url']) ? esc_url_raw(trim($input['zweigold_field_url'])) : '';
	$clean['zweigold_field_user'] = isset($input['zweigold_field_user']) ? sanitize_text_field($input['zweigold_field_user']) : '';
	$clean['zweigold_field_pass'] = isset($input['zweigold_field_pass']) ? sanitize_text_field($input['zweigold_field_pass']) : '';
	return $clean;
}
