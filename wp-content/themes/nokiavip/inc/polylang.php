<?php
/**
 * Polylang Compatibility File
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Register footer text strings
 */
$footer_text = shopy_mod( PREFIX . 'footer-text' ); // Get the data set in customizer
pll_register_string( PREFIX . 'footer-text', $footer_text, 'saha' ); // Register string