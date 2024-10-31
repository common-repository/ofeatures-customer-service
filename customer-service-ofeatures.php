<?php
/*
  Plugin Name: Live Chat, Click To Call, Ticket System, Feedback, Contact Form & more - oFeatures Customer Service
  Plugin URI: http://ofeatures.com/plugins
  Description: A set of widgets such as Live Chat, Click to Call, Ticket System, Feedback, Contact Form and Guestbook on a mobile friendly Customer Service platform
  Version: 1.3
  Author: oFeatures
  Author URI: http://ofeatures.com
  License: GPL
 */


//Cofig 
$plugin_name = "ofeatures-customer-service";
$settings_label = "oFeatures Customer Service";

//Core
include(dirname(__FILE__) . '/ofeatures-wp-core/feature-config.php');
include(dirname(__FILE__) . '/ofeatures-wp-core/support-panel.php');
include(dirname(__FILE__) . '/ofeatures-wp-core/plugin-shared.php');

//Instalation/deinstalation
register_activation_hook(__FILE__, 'customer_service_ofeatures_install');
register_deactivation_hook(__FILE__, 'customer_service_ofeatures_remove');

function customer_service_ofeatures_install() {
    add_ofeatures_options();
    add_option("customer_service_ofeatures_count", '', '', 'yes');
}

function customer_service_ofeatures_remove() {
    delete_option('customer_service_ofeatures_count');
    delete_ofeatures_options();
}

ofeatures_register_support_panel();

//Configuration menu
if (is_admin()) {
    add_action('admin_menu', 'customer_service_admin_menu');

    function customer_service_ofeatures_config_page(){
        $plugin_name = "ofeatures-customer-service";
        ofeatures_config_page(
              "Customer Service - oFeatures"
            , "Customer Service - oFeatures"
            , "Choose your feature."
            , "You don't have any Features added to website: '[DOMAIN]' on your oFeatures account.<br/>Please also check that you have entered the correct website address by going to Menu > Websites > Settings"
            , plugins_url() . "/$plugin_name"
            , "http://ofeatures.com");
    }
    
    function customer_service_admin_menu() {
        $plugin_name = "ofeatures-customer-service";
        add_submenu_page('options-general.php', 'Customer Service oFeatures', 'oFeatures settings'
            , 'administrator', $plugin_name 
            , "customer_service_ofeatures_config_page");
    }
    
    
    function plugin_add_settings_link( $links ) {
        $settings_link = '<a href="options-general.php?page=ofeatures-customer-service">' . __( 'Settings' ) . '</a>';
        array_push( $links, $settings_link );
        return $links;
    }
    $plugin = plugin_basename( __FILE__ );
    add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );

    
    
}
?>