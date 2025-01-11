=== Dgency Free Shipping Calculator ===
Contributors: mdanikhan
Tags: WooCommerce, free shipping, shipping calculator, jars
Requires at least: 5.0
Tested up to: 6.3
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Automatically enables free shipping for WooCommerce orders containing 2 jars or more.

== Description ==
Dgency Free Shipping Calculator is a WooCommerce plugin that dynamically calculates shipping eligibility based on the number of jars in the cart. If the total quantity of jars equals or exceeds 2, free shipping is enabled.

== Features ==
1. Free shipping for orders containing 2 or more jars.
2. Supports both simple and variable products.
3. Removes conflicting shipping methods like flat rates when free shipping is applicable.

== Installation ==
1. Download the plugin from the repository or GitHub.
2. Upload the `dgency-free-shipping-calculator` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Ensure WooCommerce is installed and configured.

== Frequently Asked Questions ==
= How does the plugin calculate the total jars? =
The plugin loops through all cart items and calculates the total number of jars based on the product's quantity attribute or defaults to 1 jar per product.

= Can I change the threshold for free shipping? =
Yes, you can modify the `$quantity_threshold` variable in the main plugin file to set your desired threshold.

== Support ==
For any issues or feature requests, visit the [Author's Profile](https://codeanik.github.io/portfolio) or [GitHub Repository](https://github.com/CodeAnik).

== Changelog ==
= 1.0.0 =
* Initial release.
