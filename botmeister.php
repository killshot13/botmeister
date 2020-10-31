<?php
/**
 * @package Botmeister
 */
/*
 * Plugin Name
 *
 * package      Botmeister\PluginSlug
 * author       Michael Rehnert
 * copyright    2020 Safe This Home, LLC
 * license      GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name:       Botmeister
 * Plugin URI:        https://github.com/killshot13/botmeister
 * Description:       Uses an algorithm based on the TypingDNA API to destroy blog comment spam with amazing precision and accuracy.
 * Version:           0.1.0
 * Requires at least: 5.5.1
 * Requires PHP:      7.4.11
 * Author:            Michael Rehnert
 * Author URI:        https://safethishome.com
 * Text Domain:       plugin-slug
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/killshot13
 */

 /*
	BOTMEISTER: A WordPress plugin for combating comment spam generated
	on posts & articles by bots.

    Copyright (C) 2020  Safe This Home, LLC a/o Michael Rehnert

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/
if ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
    require __DIR__ . '/vendor/autoload.php';
}

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'BOTMEISTER_VERSION', '1.0.0' );
define( 'BOTMEISTER__MINIMUM_WP_VERSION', '4.0' );
define( 'BOTMEISTER__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BOTMEISTER_DELETE_LIMIT', 100000 );


if(!class_exists('Botmeister'))
{
	/**
     * class:   Botmeister
     * desc:    plugin class to allow reports be pulled from multipe GA accounts
     */
    class Botmeister
    {
        /**
         * Created an instance of the Botmeister class
         */
		public function __construct()
		{
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_menu', array(&$this, 'add_menu'));
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$Botmeister_Settings = new Botmeister_Settings();

			// Register custom post types
			require_once(sprintf("%s/post-types/post_type_template.php", dirname(__FILE__)));
			$Post_Type_Template = new Post_Type_Template();



			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));

			// Set up ACF
            add_filter('acf/settings/path', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", dirname(__FILE__));
            });
            add_filter('acf/settings/dir', function() {
                return sprintf("%s/includes/advanced-custom-fields-pro/", plugin_dir_url(__FILE__));
            });
            require_once(sprintf("%s/includes/advanced-custom-fields-pro/acf.php", dirname(__FILE__)));

            // Settings managed via ACF
            require_once(sprintf("%s/includes/settings.php", dirname(__FILE__)));
            $settings = new Botmeister_Settings(plugin_basename(__FILE__));

            // CPT for example post type
            require_once(sprintf("%s/includes/example-post-type.php", dirname(__FILE__)));
            $exampleposttype = new Botmeister_ExamplePostType();
		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate
	} // END class Botmeister
} // END if(!class_exists('Botmeister'))

if(class_exists('Botmeister'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Botmeister', 'activate'));
	register_deactivation_hook(__FILE__, array('Botmeister', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new Botmeister();
}	// END if(class_exists('Botmeister'))
