<?php
/*
Plugin Name: Jadeprints Photos
Plugin URI: https://github.com/otepas/jp_photos
Description: Create photo custom post
Version: 1.0
Author: Carlos Mateo
Author URI: http://www.jadeprints.com
License: GPL2
*/
/*
Copyright 2015  Carlos Mateo

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('JP_Photos'))
{
	class WP_Photos
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$jp_photos_settings = new JP_Photos_Settings();

			// Register custom post types
			require_once(sprintf("%s/post-types/photo-post.php", dirname(__FILE__)));
			$photo_post = new Photo_Post_Template();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		}

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		}

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		}

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_plugin_template">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	}
} 

if(class_exists('JP_Photos'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('JP_Photos', 'activate'));
	register_deactivation_hook(__FILE__, array('JP_Photos', 'deactivate'));

	// instantiate the plugin class
	$jp_photos = new JP_Photos();

}
