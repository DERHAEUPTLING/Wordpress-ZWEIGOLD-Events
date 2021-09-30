<?php

/**
 * top level menu:
 * callback functions
 */
function zweigold_options_page_html()
{
	// check user capabilities
	if (!current_user_can('manage_options')) {
		return;
	}

	// add error/update messages

	// check if the user have submitted the settings
	// wordpress will add the "settings-updated" $_GET parameter to the url
	if (isset($_GET['settings-updated'])) {
		// add settings saved message with the class of "updated"
		add_settings_error('zweigold_messages', 'zweigold_message', __('Settings Saved', 'zweigold'), 'updated');
	}

	// show error/update messages
	settings_errors('zweigold_messages');
?>
	<div class="wrap">
		<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

		<h2>Shortcode Usage</h2>
		<p>Use this ShortCode to lay out the Eventlist: <strong>[zweigold_eventlist]</strong>
		</p>

		<br>
		<br>
		<br>
		
		<?php
		// Settings 
		function regiondo_settings_section_cb($args)
		{
		?>
			<p id="<?php echo esc_attr($args['id']); ?>">
				<?php esc_html_e('Enter the Agentur ZWEIGOLD api credentials.', 'zweigold'); ?></p>
		<?php
		}
		?>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "zweigold"
			settings_fields('zweigold');
			// output setting sections and their fields
			// (sections are registered for "zweigold", each field is registered to a specific section)
			do_settings_sections('zweigold');
			// output save settings button
			submit_button('Save Settings');

			// $options = get_option( 'zweigold_options' );
			// echo '<pre>' . print_r($options, true) . '</pre>';

			?>
		</form>
	</div>
<?php
}
