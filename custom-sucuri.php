<?php
/*
Plugin Name: Custom settings for Sucuri Scanner
Description: Hide firewall related UI elements, relocate datastore path and more.
Version: 2.3.1
Author: Viktor Szépe
Author URI: https://github.com/szepeviktor?tab=activity
License: GNU General Public License (GPL) version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/szepeviktor/custom-sucuri
Options: O1_SUCURI_USER
*/

final class O1_sucuri_custom {

    public function __construct() {

        add_action( 'init', array( $this, 'init' ) );

        add_action( 'admin_menu', array( $this, 'remove_firewall_ui' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'hide_waf_postbox' ), 20 );

        add_filter( 'option_' . 'sucuriscan_ads_visibility', array( $this, 'option_ads_visibility' ), 9999 );
        add_filter( 'default_option_' . 'sucuriscan_ads_visibility', array( $this, 'option_ads_visibility' ), 9999 );
        add_filter( 'option_' . 'sucuriscan_datastore_path', array( $this, 'option_datastore_path' ), 9999 );
        add_filter( 'default_option_' . 'sucuriscan_datastore_path', array( $this, 'option_datastore_path' ), 9999 );
    }

    /**
     * Restrict the admin interface to a specific user and prevent host lookups.
     *
     * To activate one-user restriction copy this into your wp-config.php
     *
     *     define( 'O1_SUCURI_USER', 'your-username' );
     */
    public function init() {

        // Prevent host lookups.
        if ( ! defined( 'NOT_USING_CLOUDPROXY' ) ) {
            define( 'NOT_USING_CLOUDPROXY', true );
        }

        // User restriction.
        if ( defined( 'O1_SUCURI_USER' ) && is_user_logged_in() ) {
            $current_user = wp_get_current_user();

            if ( O1_SUCURI_USER !== $current_user->user_login ) {
                remove_action( 'admin_menu', 'SucuriScanInterface::add_interface_menu' );
            }
        }
    }

    /**
     * Removes WAF admin menu and the corresponding tab.
     */
    public function remove_firewall_ui() {

        global $sucuriscan_pages;

        unset( $sucuriscan_pages['sucuriscan_monitoring'] );
        // Would remove only the admin menu: remove_submenu_page( 'sucuriscan', 'sucuriscan_monitoring' );
    }

    /**
     * Hide "Website Firewall protection" postbox on Hardening tab
     */
    public function hide_waf_postbox( $hook ) {

        if ( 'sucuri-security_page_sucuriscan_hardening' !== $hook ) {
            return;
        }

        $style = '.sucuri-security_page_sucuriscan_hardening #poststuff .postbox:nth-of-type(2) {display:none !important;}';
        wp_add_inline_style( 'wp-admin', $style );
    }

    /**
     * Hide Sucuri ads.
     */
    public function option_ads_visibility( $value ) {

        return 'disabled';
    }

    /**
     * Set data store path.
     */
    public function option_datastore_path( $value ) {

        return WP_CONTENT_DIR . '/sucuri';
    }
}

new O1_sucuri_custom();
