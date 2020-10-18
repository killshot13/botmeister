<?php
if(!class_exists('Botmeister_Settings_ACF'))
{
    class Botmeister_Settings_ACF
    {
        const SLUG = "custom-plugin-options";

        /**
         * Construct the plugin object
         */
        public function __construct($plugin)
        {
            // register actions
            acf_add_options_page(array(
                'page_title' => __('Custom Plugin', 'custom'),
                'menu_title' => __('Custom Plugin', 'custom'),
                'menu_slug' => self::SLUG,
                'capability' => 'manage_options',
                'redirect' => false
            ));

            add_action('init', array(&$this, "init"));
            add_action('admin_menu', array(&$this, 'admin_menu'), 20);
            add_filter("plugin_action_links_$plugin", array(&$this, 'plugin_settings_acf_link'));
        } // END public function __construct

        /**
         * Add options page
         */
        public function admin_menu()
        {
            // Duplicate link into properties mgmt
            add_submenu_page(
                self::SLUG,
                __('Settings_ACF', 'custom'),
                __('Settings_ACF', 'custom'),
                'manage_options',
                self::SLUG,
                1
            );
        }

        /**
         * Add settings_acf fields via ACF
         */
        function init()
        {
            if(function_exists('register_field_group'))
            {
                // More goes here
            }
        }

        /**
         * Add the settings_acf link to the plugins page
         */
        public function plugin_settings_acf_link($links)
        {
            $settings_acf_link = sprintf('<a href="admin.php?page=%s">Settings_ACF</a>', self::SLUG);
            array_unshift($links, $settings_acf_link);
            return $links;
        } // END public function plugin_settings_acf_link($links)
    } // END class Botmeister_Settings_ACF
} // END if(!class_exists('Botmeister_Settings_ACF'))
