=== Plugin Name ===
Contributors: greatwitenorth, woothemes, bryceadams
Tags: woocommerce, woothemes, quantity, quantity increment, quantity buttons
Requires at least: 3.6.1
Tested up to: 4.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Quantity Increment Buttons for WooCommerce re-adds the quantity buttons depreciated in WooCommerce 2.3

== Description ==

In WooCommerce 2.3, the quantity increment buttons have been depreciated, as most browsers now support `<input type="number" />`.

However, you may want to keep them. Simply install and activate this plugin to do so.

It optionally includes [Number Polyfill](https://github.com/jonstipe/number-polyfill), which is a polyfill for implementing the HTML5 `<input type="number">` element in browsers that do not currently support it.

To include it, add something like this to your `functions.php`:

`
add_action( 'wp_enqueue_scripts', 'wcqib_enqueue_polyfill' );
function wcqib_enqueue_polyfill() {
    wp_enqueue_script( 'wcqib-number-polyfill' );
}
`

== Installation ==

1. Upload `woocommerce-quantity-increment-buttons` to the `/wp-content/plugins/` directory or search for 'Quantity Increment Buttons for WooCommerce' from **Plugins > Add New**.
1. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= I don’t want to use the plugin styles as it looks bad with my theme =

You can add the following to your `functions.php` file:

`
add_action( 'wp_enqueue_scripts', 'wcqib_dequeue_quantity' );
function wcqib_dequeue_quantity() {
    wp_dequeue_style( 'wcqib-css' );
}
`

This will dequeue the plugin’s stylesheet.

== Screenshots ==

1. The Quantity Increment buttons

== Changelog ==

= 1.0 =
* Initial Release