<?php

/**
 * Plugin Name:       WooneApi Permission
 * Plugin URI:        https://hellowebhelp.com/
 * Description:       We are developmented for wooneapi projects. supported by hellowebhelp.com
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Hello web help
 * Author URI:        https://Hellowebhelp.com/
 * License:           GPL v2 or later
 * License URI:       https://hellowebhelp.com
 * Text Domain:       HelloWebhelp
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://hellowebhelp.com/
 */

if (!defined('ABSPATH')) {
    exit;
}


final class wooneapi_permission
{

    private function __construct()
    {
        $this->wooneapi_css_js_linkup();

        add_action('plugins_loaded', [$this, 'markup_template']); // part 2 Call on "markup_template".

        include_once(plugin_dir_path(__FILE__) . 'includes/action/authentication.php'); //authentication
    }

    // A single instance
    public static function init()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }


    /*====================Part 2======================*/

    // css/js Linkup
    function wooneapi_css_js_linkup()
    {
        wp_enqueue_style('wooneapi_css_js_linkup', plugins_url('assets/admin/style.css', __FILE__));
    }

    //Initialize the plugin Template
    public function markup_template()
    {
        include_once(plugin_dir_path(__FILE__) . 'includes/setting.php');

        // Use NameSpace
        if (is_admin()) {
            new includes\setting\Menu_Page();
        } else {
            //
        }
       
    }

    /*==================== End Part 2======================*/
}


// wooneapi_permission for instance
function wooneapi_permission()
{
    return wooneapi_permission::init();
}

// Call function
wooneapi_permission();