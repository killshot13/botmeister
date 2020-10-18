<?php

if(!class_exists("Botmeister"))
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

        } // END public function __construct()

        /**
         * Hook into the WordPress activate hook
         */
        public static function activate()
        {
            // Do something
        }

        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate()
        {
            // Do something
        }
    } // END class Botmeister
} // END if(!class_exists("Botmeister"))

if(class_exists('Botmeister'))
{
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Botmeister', 'activate'));
    register_deactivation_hook(__FILE__, array('Botmeister', 'deactivate'));

    // instantiate the plugin class
    $plugin = new Botmeister();
} // END if(class_exists('Botmeister'))
