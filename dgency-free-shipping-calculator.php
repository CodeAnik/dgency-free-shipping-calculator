<?php
/**
 * Plugin Name: Dgency Free Shipping Calculator
 * Plugin URI: https://github.com/CodeAnik
 * Description: Automatically enables free shipping for orders containing 2 jars or more.
 * Version: 1.0.0
 * Author: Md. Anik Khan
 * Author URI: https://codeanik.github.io/portfolio
 * License: GPL2
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Filter to modify shipping methods based on the number of jars in the cart
add_filter('woocommerce_package_rates', 'custom_hide_shipping_methods_based_on_total_quantity', 10, 2);

function custom_hide_shipping_methods_based_on_total_quantity($rates, $package) {
    $quantity_threshold = 2; // Minimum total jars for free shipping
    $total_jars = 0; // To store the total number of jars across all products

    // Loop through cart items to calculate the total number of jars
    foreach (WC()->cart->get_cart() as $cart_item) {
        $product = $cart_item['data']; // Get product data
        $cart_quantity = $cart_item['quantity']; // Get the cart item quantity

        // Initialize jars per product
        $jars_per_product = 1; // Default to 1 jar if no attribute is found

        // Check if the product is a variation and has the "Quantity" attribute
        if ($product->is_type('variation')) {
            $quantity_attribute = $cart_item['variation']['attribute_pa_quantity'] ?? '';
        } else {
            $quantity_attribute = $product->get_attribute('quantity'); // For simple products
        }

        // Parse the attribute value if it's not empty
        if (!empty($quantity_attribute)) {
            $jars_per_product = intval(preg_replace('/[^0-9]/', '', $quantity_attribute)); // Extract numeric value
        }

        // Add total jars (cart quantity * jars per product)
        $total_jars += $jars_per_product * $cart_quantity;
    }

    // Determine whether free shipping is applicable
    $free_shipping_applicable = $total_jars >= $quantity_threshold;

    // Filter rates
    foreach ($rates as $rate_id => $rate) {
        if ('free_shipping' === $rate->method_id && !$free_shipping_applicable) {
            unset($rates[$rate_id]); // Remove free shipping if not applicable
        } elseif ('flat_rate' === $rate->method_id && $free_shipping_applicable) {
            unset($rates[$rate_id]); // Remove flat rate if free shipping is applicable
        }
    }

    // Ensure only one free shipping option is displayed
    if ($free_shipping_applicable) {
        $rates = array_filter($rates, function($rate) {
            return 'free_shipping' === $rate->method_id;
        });
        // Reset keys to avoid display issues
        $rates = array_values($rates);
    }

    return $rates; // Return modified rates
}
