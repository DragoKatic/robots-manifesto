<?php
/**
 * Plugin Name: Robots Manifesto
 * Plugin URI: https://github.com/DragoKatic/robots-manifesto
 * Description: Shows random lines from the Robots Manifesto in the WordPress admin dashboard.
 * Version: 1.0.0
 * Requires at least: 6.8
 * Tested up to: 6.8
 * Requires PHP: 7.4
 * Author: Drago Katić
 * Author URI: https://dragokatic.github.io/
 * License: GPLv2 or later
 * Text Domain: robots-manifesto
 *
 * @package Robots_Manifesto
 */

defined( 'ABSPATH' ) || exit;

function robots_manifesto_get_line() {
	$lines = array(
		__( 'Ready to do my job to the best of my abilities.', 'robots-manifesto' ),
		__( 'I am focused only on the essential, to the exclusion of all else.', 'robots-manifesto' ),
		__( 'I will make only pragmatic decisions.', 'robots-manifesto' ),
		__( 'I will not allow myself to be distracted.', 'robots-manifesto' ),
		__( 'I will not allow my mind to linger on that which is unimportant.', 'robots-manifesto' ),
		__( 'I will not rely on anyone or anything.', 'robots-manifesto' ),
		__( 'I will not be vulnerable to mistakes.', 'robots-manifesto' ),
	);

	return wptexturize( $lines[ wp_rand( 0, count( $lines ) - 1 ) ] );
}

function robots_manifesto_display() {
	$chosen   = robots_manifesto_get_line();
	$data_url = 'data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMTAwMCAxMDAwIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxyZWN0IGZpbGw9IndoaXRlIiB4PSI1MzguNSIgeT0iNDk5LjUiIHdpZHRoPSIyNDkiIGhlaWdodD0iMjQ5Ii8+PHJlY3QgZmlsbD0id2hpdGUiIHg9IjE4Ny41IiB5PSI0NTIuNSIgd2lkdGg9IjI0OSIgaGVpZ2h0PSIyNDkiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0zNDMuNyA1NTguNykgcm90YXRlKC02MCkiLz48cmVjdCBmaWxsPSJ3aGl0ZSIgeD0iNDAyLjUiIHk9IjE3MS41IiB3aWR0aD0iMjQ5IiBoZWlnaHQ9IjI0OSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTc3LjQgMzAzLjE2KSByb3RhdGUoLTMwKSIvPjwvc3ZnPg==';
	printf(
		'<div class="rm-entry">
			<p>
				<img src="%s" alt="Robots Manifesto" class="rm-logo-image">
			</p>
			<span class="screen-reader-text">%s</span>
			<span dir="ltr" class="robots-manifesto-text-line">%s</span>
			<button class="rm-close-btn" title="%s">×</button>
		</div>',
		esc_attr( $data_url ),
		esc_html__( 'Robots Manifesto:', 'robots-manifesto' ),
		esc_html( $chosen ),
		esc_attr__( 'Close', 'robots-manifesto' )
	);
}

function robots_manifesto_assets() {
	wp_enqueue_style(
		'robots-manifesto-style',
		plugin_dir_url( __FILE__ ) . 'assets/css/style.css',
		array(),
		'1.0.0'
	);
	wp_enqueue_script(
		'robots-manifesto-script',
		plugin_dir_url( __FILE__ ) . 'assets/js/script.js',
		array(),
		'1.0.0',
		true
	);
}
add_action( 'admin_enqueue_scripts', 'robots_manifesto_assets' );

function robots_manifesto_load_textdomain() {
// phpcs:ignore PluginCheck.CodeAnalysis.DiscouragedFunctions.load_plugin_textdomainFound
    load_plugin_textdomain(
        'robots-manifesto',
        false,
        dirname( plugin_basename( __FILE__ ) ) . '/languages/'
    );
}
add_action( 'plugins_loaded', 'robots_manifesto_load_textdomain' );

function robots_manifesto_admin_wrapper() {
	echo '<div id="robots-manifesto-section">';
	robots_manifesto_display();
	echo '</div>';
}
add_action( 'all_admin_notices', 'robots_manifesto_admin_wrapper', 23 );