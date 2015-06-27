<?php
/*
Plugin Name: Sucuri Scanner custom settings
Description: Hide Firewall menu and Plugin advertisements, relocate datastore path.
Version: 2.2.0
Author: Viktor Szépe
License: GNU General Public License (GPL) version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/szepeviktor/sucuri-cleanup
Options: O1_SUCURI_USER
*/

add_action( 'init', 'o1_sucuri_restrict' );

add_action( 'admin_menu', 'o1_sucuri_remove_firewall' );
add_action( 'admin_enqueue_scripts', 'o1_sucuri_hide_waf_postbox', 20 );

add_filter( 'option_' . 'sucuriscan_ads_visibility', 'o1_sucuri_ads_visibility', 9999 );
add_filter( 'option_' . 'sucuriscan_datastore_path', 'o1_sucuri_datastore_path', 9999 );

/**
 * Restrict the admin interface to a specific user.
 *
 * Copy this to your wp-config.php
 *
 *     define( 'O1_SUCURI_USER', 'your-username' );
 */
function o1_sucuri_restrict() {

    if ( is_user_logged_in() && defined( 'O1_SUCURI_USER' ) ) {
        $current_user = wp_get_current_user();

        if ( O1_SUCURI_USER !== $current_user->user_login ) {
            remove_action( 'admin_menu', 'SucuriScanInterface::add_interface_menu' );
        }
    }
}

/**
 * Removes WAF admin menu and the corresponding tab.
 */
function o1_sucuri_remove_firewall() {

    global $sucuriscan_pages;

    unset( $sucuriscan_pages['sucuriscan_monitoring'] );
    // Would remove only the admin menu: remove_submenu_page( 'sucuriscan', 'sucuriscan_monitoring' );
}

/**
 * Hide "Website Firewall protection" postbox on Hardening tab
 */
function o1_sucuri_hide_waf_postbox( $hook ) {

    if ( 'sucuri-security_page_sucuriscan_hardening' !== $hook ) {
        return;
    }

    $style = '.sucuri-security_page_sucuriscan_hardening #poststuff .postbox:nth-of-type(2) {display:none !important;}';
    wp_add_inline_style( 'wp-admin', $style );
}

/**
 * Hide Sucuri ads.
 */
function o1_sucuri_ads_visibility( $value ) {

    return 'disabled';
}

/**
 * Set data store path.
 */
function o1_sucuri_datastore_path( $value ) {

    return WP_CONTENT_DIR . '/sucuri';
}
