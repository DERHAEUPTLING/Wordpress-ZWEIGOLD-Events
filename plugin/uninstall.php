<?php
/**
 * Uninstall script for ZWEIGOLD Events
 * Wird automatisch ausgeführt, wenn das Plugin über das WP Backend gelöscht wird.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$option_key = 'zweigold_options';

// Multisite: alle Blogs bereinigen
if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	$site_ids = get_sites( [ 'fields' => 'ids' ] );
	foreach ( $site_ids as $site_id ) {
		switch_to_blog( $site_id );
		delete_option( $option_key );
		restore_current_blog();
	}
} else {
	delete_option( $option_key );
}
