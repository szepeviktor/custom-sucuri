=== Custom settings for Sucuri Scanner ===
Contributors: szepe.viktor
Donate link: https://szepe.net/wp-donate/
Tags: sucuri, sucuri scanner, malware, security, firewall, scan, virus
Requires at least: 4.0
Tested up to: 4.2.2
Stable tag: 2.3.1
License: GPLv2

Hide firewall related UI elements, relocate datastore path and more.

== Description ==

Custom settings for [Sucuri Scanner](https://wordpress.org/plugins/sucuri-scanner/) plugin.

The author has no association with Sucuri LLC.

* Restrict the admin interface to a specific user
* Hide Sucuri WAF (web application firewall) related UI elements
* Prevent DNS queries on each page load
* Hide Sucuri ads
* Set data store path.

For details please see [the GitHub repository](https://github.com/szepeviktor/custom-sucuri).

= How to restrict the admin interface to a specific user? =

Copy this to your wp-config.php

`define( 'O1_SUCURI_USER', 'your-username' );`

= Links =

Development of this plugin goes on on [GitHub](https://github.com/szepeviktor/custom-sucuri).

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload `custom-sucuri.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= How to restrict the admin interface to a specific user? =

Copy this to your wp-config.php

`define( 'O1_SUCURI_USER', 'your-username' );`

== Changelog ==

= 2.3.1 =
* Initial release on WordPress.org.

= 2.3.0 =
* Up to version 2.3.0 this plugin was only available on
  [GitHub](https://github.com/szepeviktor/custom-sucuri/commits/master).
