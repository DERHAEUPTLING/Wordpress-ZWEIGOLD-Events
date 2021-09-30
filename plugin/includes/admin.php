<?php


/**
 * custom option and settings
 */
function zweigold_settings_init()
{
	// register a new setting for "zweigold" page
	register_setting('zweigold', 'zweigold_options');

	// sections
	add_settings_section(
		'zweigold_settings_section', // $id
		__('Agentur ZWEIGOLD Eventlist Setup', 'zweigold'), // $title
		'zweigold_settings_section_cb', // $callback
		'zweigold' // $page
	);

	// a section for a dropdown
	// add_settings_section(
	// 	'zweigold_section_developers',
	// 	__( 'The Matrix has you.', 'zweigold' ),
	// 	'zweigold_section_developers_cb',
	// 	'zweigold'
	// );

	// dropdown
	// add_settings_field(
	// 	'zweigold_field_pill', // as of WP 4.6 this value is used only internally
	// 	// use $args' label_for to populate the id inside the callback
	// 	__( 'Pill', 'zweigold' ),
	// 	'zweigold_field_pill_cb',
	// 	'zweigold',
	// 	'zweigold_section_developers',
	// 	[
	// 		'label_for' => 'zweigold_field_pill',
	// 		'class' => 'zweigold_row',
	// 		'zweigold_custom_data' => 'custom',
	// 	]
	// );

	add_settings_field(
		'zweigold_field_url', // use $args' label_for to populate the id inside the callback
		__('Your ZWEIGOLD api url', 'zweigold'),
		'zweigold_field_url_cb', // $page
		'zweigold', // $page
		'zweigold_settings_section',
		[
			'label_for' => 'zweigold_field_url'
		]
	);

	add_settings_field(
		'zweigold_field_user', // use $args' label_for to populate the id inside the callback
		__('Your ZWEIGOLD api user', 'zweigold'),
		'zweigold_field_user_cb', // $page
		'zweigold', // $page
		'zweigold_settings_section',
		[
			'label_for' => 'zweigold_field_user'
		]
	);

	add_settings_field(
		'zweigold_field_pass', // use $args' label_for to populate the id inside the callback
		__('Your ZWEIGOLD api password', 'zweigold'),
		'zweigold_field_pass_cb', // $page
		'zweigold', // $page
		'zweigold_settings_section',
		[
			'label_for' => 'zweigold_field_pass'
		]
	);
}

/**
 * register our zweigold_settings_init to the admin_init action hook
 */
add_action('admin_init', 'zweigold_settings_init');





/**
 * custom option and settings:
 * callback functions
 *
 * section callbacks can accept an $args parameter, which is an array.
 * $args have the following keys defined: title, id, callback.
 * the values are defined at the add_settings_section() function.
 */





// field url
function zweigold_field_url_cb($args)
{
	$options = get_option('zweigold_options');
?>
	<input type="text" id="<?php echo esc_attr($args['label_for']); ?>" name="zweigold_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo $options['zweigold_field_url']; ?>" required />
<?php
}

// field user
function zweigold_field_user_cb($args)
{
	$options = get_option('zweigold_options');
?>
	<input type="text" id="<?php echo esc_attr($args['label_for']); ?>" name="zweigold_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo $options['zweigold_field_user']; ?>" required />
<?php
}


// field pass
function zweigold_field_pass_cb($args)
{
	$options = get_option('zweigold_options');
?>
	<input type="text" id="<?php echo esc_attr($args['label_for']); ?>" name="zweigold_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo $options['zweigold_field_pass']; ?>" required />
<?php
}



/**
 * top level menu
 */
function zweigold_options_page()
{
	// add top level menu page
	add_menu_page(
		'zweigold',
		'ZWEIGOLD',
		'manage_options',
		'zweigold',
		'zweigold_options_page_html',
		'dashicons-tickets-alt',
		'59'
	);
}


/**
 * register our zweigold_options_page to the admin_menu action hook
 */
add_action('admin_menu', 'zweigold_options_page');
