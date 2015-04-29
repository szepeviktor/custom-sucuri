<?php
/*
Plugin Name: Sucuri Scanner custom settings
Description: Hide Firewall menu and Plugin advertisements, relocate datastore path.
Version: 2.0.0
Author: Viktor Szépe, Wojtek Szałkiewicz
License: GNU General Public License (GPL) version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
GitHub Plugin URI: https://github.com/szepeviktor/sucuri-cleanup
*/

add_action( 'admin_menu', 'o1_sucuri_remove_firewall', 0 );
add_filter( 'pre_option_' . 'sucuriscan_ads_visibility', 'o1_sucuri_ads_visibility', 9999 );
add_filter( 'pre_update_option_' . 'sucuriscan_ads_visibility', 'o1_sucuri_ads_visibility', 9999 );
add_filter( 'pre_option_' . 'sucuriscan_datastore_path', 'o1_sucuri_datastore_path', 9999 );
add_filter( 'pre_update_option_' . 'sucuriscan_datastore_path', 'o1_sucuri_datastore_path', 9999 );

function o1_sucuri_remove_firewall() {

    global $sucuriscan_pages;

    unset( $sucuriscan_pages['sucuriscan_monitoring'] );
}

function o1_sucuri_ads_visibility( $value ) {

    return 'disabled';
}

function o1_sucuri_datastore_path( $value ) {

    return WP_CONTENT_DIR . '/sucuri';
}
