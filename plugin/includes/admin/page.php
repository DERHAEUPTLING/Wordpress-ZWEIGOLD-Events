<?php
/**
 * Admin Page Output for ZWEIGOLD Events
 */
function zweigold_options_page_html() {
	if (!current_user_can('manage_options')) {
		return;
	}

	if (isset($_GET['settings-updated'])) {
		add_settings_error('zweigold_messages', 'zweigold_message', __('Settings Saved', ZWEIGOLD_EVENTS_TD), 'updated');
	}

	settings_errors('zweigold_messages');
	?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

		

		<form action="options.php" method="post">
			<?php
			settings_fields('zweigold');
			do_settings_sections('zweigold');
			submit_button(__('Einstellungen speichern', ZWEIGOLD_EVENTS_TD));
			?>
		</form>
		<hr />

    <h2><?php esc_html_e('Shortcode Usage', ZWEIGOLD_EVENTS_TD); ?></h2>
		<p><?php esc_html_e('Verwende den Shortcode, um die Eventliste auszugeben:', ZWEIGOLD_EVENTS_TD); ?> <strong>[zweigold_eventlist]</strong></p>

	</div>
	<?php
}
