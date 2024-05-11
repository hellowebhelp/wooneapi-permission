<?php

//NameSpace
namespace includes\setting;

class Menu_Page
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'wooneapi']);
    }


    function wooneapi()
    {
        add_menu_page('Wooneapi Plugin', 'Wooneapi', 'manage_options', 'Wooneapi-dashboard', '', 'dashicons-smiley',);
        add_submenu_page('Wooneapi-page', 'Hello Web Help', 'noramal', 'manage_options', 'Wooneapi-dashboard', [$this, 'wooneapi_callback_1']);
       // add_submenu_page('booking-page', 'Booking Setting', 'Setting', 'manage_options', 'booking-setting', [$this, 'wooneapi_callback_2']);
    }


    //CallBack 1
    function wooneapi_callback_1()
    {
        include_once(plugin_dir_path(__FILE__) . 'admin/menu_page_1.php'); //LinkUp Template

        $menu_1 = new menu_page_1\menu_1();
        $menu_1->noramal();



    }

    //callBack 2
    function hellowebhelp_callback_2(){

        include_once(plugin_dir_path(__FILE__) . 'admin/menu_page_2.php'); //LinkUp Template
        $menu_2 = new menu_page_2\menu_2();
        $menu_2->setting();
    }
    

}
