<?php

/*
 * Plugin Name: Jetpack Module List
 * Plugin URI: http://github.com/georgestephanis/jetpack-module-list/
 * Description: Get a list table with the Jetpack Modules to bulk enable/disable as desired.
 * Author: George Stephanis
 * Version: 0.1
 * Author URI: http://stephanis.info/
 */

add_action( 'jetpack_admin_menu', 'jetpack_module_list_page', 11 );
function jetpack_module_list_page() {
	jetpack_require_lib( 'admin-pages/class.jetpack-settings-page' );
	$jetpack_settings = new Jetpack_Settings_Page;
	$jetpack_settings->add_actions();

	$hook = add_submenu_page( 'jetpack', __( 'Jetpack Modules', 'jetpack' ), __( 'Modules', 'jetpack' ), 'jetpack_manage_modules', 'jetpack_modules', array( $jetpack_settings, 'render' ) );

	// This uses a `don't show if not connected` class so we need to add these manually.
	add_action( "load-$hook",                array( $jetpack_settings, 'admin_help'      ) );
	add_action( "load-$hook",                array( $jetpack_settings, 'admin_page_load' ) );
	add_action( "admin_head-$hook",          array( $jetpack_settings, 'admin_head'      ) );
	add_action( "admin_print_styles-$hook",  array( $jetpack_settings, 'admin_styles'    ) );
	add_action( "admin_print_scripts-$hook", array( $jetpack_settings, 'admin_scripts'   ) );
}
