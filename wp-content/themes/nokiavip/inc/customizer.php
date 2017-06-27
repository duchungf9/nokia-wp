<?php
/**
 * Register custom customizer panels, sections and settings.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * We register our custom customizer by using the hook.
 *
 * @since  1.0.0
 */
function saha_customizer_register() {

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// ======= Start Customizer Panels/Sections/Settings ======= //

	// General Panels and Sections
	$general_panel = 'general';

	$panels[] = array(
		'id'          => $general_panel,
		'title'       => __( 'General', 'saha' ),
		'description' => __( 'This panel is used for managing general section of your site.', 'saha' ),
		'priority'    => 10
	);

		// RSS
		$section = PREFIX . 'rss-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'RSS', 'saha' ),
			'priority'    => 100,
			'panel'       => $general_panel,
			'description' => __( 'If you fill the custom rss url below, it will replace the default.', 'saha' ),
		);
		$options[PREFIX . 'custom-rss'] = array(
			'id'           => PREFIX . 'custom-rss',
			'label'        => __( 'Custom RSS URL (eg. Feedburner)', 'saha' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);

	// Header Panels and Sections
	$header_panel = 'header';

	$panels[] = array(
		'id'          => $header_panel,
		'title'       => __( 'Header', 'saha' ),
		'description' => __( 'This panel is used for managing header section of your site.', 'saha' ),
		'priority'    => 15
	);

		// Top bar
		$section = PREFIX . 'top-bar-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Top Bar', 'saha' ),
			'priority'    => 30,
			'panel'       => $header_panel
		);
		$options[PREFIX . 'top-bar'] = array(
			'id'      => PREFIX . 'top-bar',
			'label'   => __( 'Display Top Bar', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'tb-nav-left'] = array(
			'id'      => PREFIX . 'tb-nav-left',
			'label'   => __( 'Top Bar Nav Left', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'tb-social-links'] = array(
			'id'      => PREFIX . 'tb-social-links',
			'label'   => __( 'Display Social Links', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'tb-social-links-target'] = array(
			'id'      => PREFIX . 'tb-social-links-target',
			'label'   => __( 'Social Links Target', 'saha' ),
			'section' => $section,
			'type'    => 'radio-buttonset',
			'choices'	=> array(
				'blank'	=> __( 'New Window', 'saha' ),
				'self'	=> __( 'Same Window', 'saha' ),
			),
			'default'	=> 'blank',
		);
		$options[PREFIX . 'twitter'] = array(
			'id'      => PREFIX . 'tb-social-twitter',
			'label'   => __( 'Twitter URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'facebook'] = array(
			'id'      => PREFIX . 'tb-social-facebook',
			'label'   => __( 'Facebook URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'gplus'] = array(
			'id'      => PREFIX . 'tb-social-gplus',
			'label'   => __( 'Google Plus URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'instagram'] = array(
			'id'      => PREFIX . 'tb-social-instagram',
			'label'   => __( 'Instagram URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'pinterest'] = array(
			'id'      => PREFIX . 'tb-social-pinterest',
			'label'   => __( 'Pinterest URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'linkedin'] = array(
			'id'      => PREFIX . 'tb-social-linkedin',
			'label'   => __( 'LinkedIn URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'youtube'] = array(
			'id'      => PREFIX . 'tb-social-youtube',
			'label'   => __( 'YouTube URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'rss'] = array(
			'id'      => PREFIX . 'tb-social-rss',
			'label'   => __( 'RSS URL', 'saha' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);

		// Logo
		$section = PREFIX . 'logo-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Logo', 'saha' ),
			'priority'    => 30,
			'panel'       => $header_panel
		);
		$options[PREFIX . 'logo'] = array(
			'id'      => PREFIX . 'logo',
			'label'   => __( 'Regular Logo', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);
		$options[PREFIX . 'retina-logo'] = array(
			'id'      => PREFIX . 'retina-logo',
			'label'   => __( 'Retina Logo', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);
		$options[PREFIX . 'favicon'] = array(
			'id'      => PREFIX . 'favicon',
			'label'   => __( 'Favicon (16px by 16px)', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);
		$options[PREFIX . 'iphone-icon'] = array(
			'id'      => PREFIX . 'iphone-icon',
			'label'   => __( 'Apple iPhone Icon (57px by 57px)', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);
		$options[PREFIX . 'ipad-icon'] = array(
			'id'      => PREFIX . 'ipad-icon',
			'label'   => __( 'Apple iPad Icon (72px by 72px)', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);
		$options[PREFIX . 'iphone-icon-retina'] = array(
			'id'      => PREFIX . 'iphone-icon-retina',
			'label'   => __( 'Apple iPhone Retina Icon (114px by 114px)', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);
		$options[PREFIX . 'ipad-icon-retina'] = array(
			'id'      => PREFIX . 'ipad-icon-retina',
			'label'   => __( 'Apple iPad Retina Icon (144px by 144px)', 'saha' ),
			'section' => $section,
			'type'    => 'media',
			'default' => '',
		);

		// Search
		$section = PREFIX . 'header-search-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Search Form', 'saha' ),
			'priority'    => 30,
			'panel'       => $header_panel
		);
		$options[PREFIX . 'header-search'] = array(
			'id'      => PREFIX . 'header-search',
			'label'   => __( 'Display Search Form', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'header-search-style'] = array(
			'id'      => PREFIX . 'header-search-style',
			'label'   => __( 'Search Style', 'saha' ),
			'section' => $section,
			'type'    => 'radio-buttonset',
			'choices'	=> array(
				'ajax'		=> __( 'Ajax', 'saha' ),
				'default'	=> __( 'Default', 'saha' ),
			),
			'default'	=> 'ajax',
		);

		// Right elements
		$section = PREFIX . 'header-right-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Right Elements', 'saha' ),
			'priority'    => 30,
			'panel'       => $header_panel
		);
		$options[PREFIX . 'header-right'] = array(
			'id'      => PREFIX . 'header-right',
			'label'   => __( 'Display Right Elements', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'header-compare'] = array(
			'id'      => PREFIX . 'header-compare',
			'label'   => __( 'Display Compare Button', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'header-wishlist'] = array(
			'id'      => PREFIX . 'header-wishlist',
			'label'   => __( 'Display Wishlist Button', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'header-account'] = array(
			'id'      => PREFIX . 'header-account',
			'label'   => __( 'Display My Account Button', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'header-account-url'] = array(
			'id'      => PREFIX . 'header-account-url',
			'label'   => __( 'My Account Url', 'saha' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
		);
		$options[PREFIX . 'logout-link'] = array(
			'id'      => PREFIX . 'logout-link',
			'label'   => __( 'Display Logout Link When Logged In', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'logout-icon'] = array(
			'id'      => PREFIX . 'logout-icon',
			'label'   => __( 'Logout Icon', 'saha' ),
			'section' => $section,
			'type'    => 'text',
			'default' => 'icon-logout',
		);
		$options[PREFIX . 'header-cart'] = array(
			'id'      => PREFIX . 'header-cart',
			'label'   => __( 'Display Cart Button', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);

	// Footer
	$footer_panel = 'footer';

	$panels[] = array(
		'id'          => $footer_panel,
		'title'       => __( 'Footer', 'saha' ),
		'description' => __( 'This panel is used for managing footer of your site.', 'saha' ),
		'priority'    => 20
	);

		// Scroll top
		$section = PREFIX . 'scroll-top-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Scroll Top Button', 'saha' ),
			'priority'    => 30,
			'panel'       => $footer_panel
		);
		$options[PREFIX . 'scroll-top'] = array(
			'id'          => PREFIX . 'scroll-top',
			'label'       => __( 'Display Scroll Top Button', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'scroll-top-icon'] = array(
			'id'      => PREFIX . 'scroll-top-icon',
			'label'   => __( 'Scroll Top Icon', 'saha' ),
			'section' => $section,
			'type'    => 'text',
			'default' => 'icon-mouse',
		);

		// Footer Widgets
		$section = PREFIX . 'footer-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Footer Widgets', 'saha' ),
			'priority'    => 30,
			'panel'       => $footer_panel
		);
		$options[PREFIX . 'footer-widgets'] = array(
			'id'          => PREFIX . 'footer-widgets',
			'label'       => __( 'Display Footer Widgets', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);

		// Footer Bottom
		$section = PREFIX . 'footer-bottom-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Footer Bottom', 'saha' ),
			'priority'    => 30,
			'panel'       => $footer_panel
		);
		$options[PREFIX . 'footer-bottom'] = array(
			'id'      => PREFIX . 'footer-bottom',
			'label'   => __( 'Display Footer Bottom', 'saha' ),
			'section' => $section,
			'type'    => 'switch',
			'default' => '1',
		);
		$options[PREFIX . 'footer-text'] = array(
			'id'           => PREFIX . 'footer-text',
			'label'        => '',
			'description'  => __( 'Customize the footer copyright.', 'saha' ),
			'section'      => $section,
			'type'         => 'textarea',
			'default'      => '&copy; Copyright ' . date( 'Y' ) . ' &middot; ' . esc_attr( get_bloginfo( 'name' ) ) . ' theme by <a href="http://www.theme-junkie.com/">Theme Junkie</a>'
		);

	// Styling Panel and Sections
	$styling_panel = 'styling';

	$panels[] = array(
		'id'          => $styling_panel,
		'title'       => __( 'Styling', 'saha' ),
		'description' => __( 'This panel is used for managing colors of your site.', 'saha' ),
		'priority'    => 20
	);

		// Color Schemes
		$section = PREFIX . 'schemes-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'General', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'body-bg'] = array(
			'id'          => PREFIX . 'body-bg',
			'label'       => __( 'Background Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ffffff'
		);
		$options[PREFIX . 'body-color'] = array(
			'id'          => PREFIX . 'body-color',
			'label'       => __( 'Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#acacac'
		);
		$options[PREFIX . 'heading-color'] = array(
			'id'          => PREFIX . 'heading-color',
			'label'       => __( 'Heading Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#444444'
		);
		$options[PREFIX . 'links-color'] = array(
			'id'          => PREFIX . 'links-color',
			'label'       => __( 'Links Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#777777'
		);
		$options[PREFIX . 'links-color-hover'] = array(
			'id'          => PREFIX . 'links-color-hover',
			'label'       => __( 'Links Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#f3b714'
		);
		$options[PREFIX . 'color-schemes-group'] = array(
			'id'          => PREFIX . 'color-schemes-group',
			'label'       => __( 'Color Schemes', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'color-schemes'] = array(
				'id'          => PREFIX . 'color-schemes',
				'label'       => __( 'Color Schemes', 'saha' ),
				'section'     => $section,
				'type'        => 'select2',
				'default'     => 'yellow',
				'choices'     => array(
					'custom'  	=> __( 'Custom', 'saha' ),
					'black'  	=> __( 'Black', 'saha' ),
					'blue'  	=> __( 'Blue', 'saha' ),
					'brown'  	=> __( 'Brown', 'saha' ),
					'crimson' 	=> __( 'Crimson', 'saha' ),
					'cyan'  	=> __( 'Cyan', 'saha' ),
					'green'  	=> __( 'Green', 'saha' ),
					'orange'  	=> __( 'Orange', 'saha' ),
					'pink'  	=> __( 'Pink', 'saha' ),
					'red'  		=> __( 'Red', 'saha' ),
					'violet'  	=> __( 'Violet', 'saha' ),
					'yellow'  	=> __( 'Yellow', 'saha' ),
				)
			);
			$options[PREFIX . 'custom-color-scheme-group'] = array(
				'id'          => PREFIX . 'custom-color-scheme-group',
				'label'       => __( 'Custom Color Scheme', 'saha' ),
				'section'     => $section,
				'type'        => 'group-title'
			);
				$options[PREFIX . 'primary-color-scheme'] = array(
					'id'          => PREFIX . 'primary-color-scheme',
					'label'       => __( 'Primary Color', 'saha' ),
					'section'     => $section,
					'type'        => 'color',
					'default'     => ''
				);
				$options[PREFIX . 'secondary-color-scheme'] = array(
					'id'          => PREFIX . 'secondary-color-scheme',
					'label'       => __( 'Secondary Color', 'saha' ),
					'section'     => $section,
					'type'        => 'color',
					'default'     => ''
				);

		// Top Bar
		$section = PREFIX . 'tb-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Top Bar', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'tb-bg'] = array(
			'id'          => PREFIX . 'tb-bg',
			'label'       => __( 'Background Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ffffff'
		);
		$options[PREFIX . 'tb-color'] = array(
			'id'          => PREFIX . 'tb-color',
			'label'       => __( 'Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#a4a4a4'
		);
		$options[PREFIX . 'tb-color-hover'] = array(
			'id'          => PREFIX . 'tb-color-hover',
			'label'       => __( 'Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fab000'
		);
		$options[PREFIX . 'tb-border-color'] = array(
			'id'          => PREFIX . 'tb-border-color',
			'label'       => __( 'Border Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ebebeb'
		);

		// Header
		$section = PREFIX . 'header-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Header', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'header-bg'] = array(
			'id'          => PREFIX . 'header-bg',
			'label'       => __( 'Background Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ffffff'
		);

		$options[PREFIX . 'header-search-group'] = array(
			'id'          => PREFIX . 'header-search-group',
			'label'       => __( 'Search Form', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'header-search-border-color'] = array(
				'id'          => PREFIX . 'header-search-border-color',
				'label'       => __( 'Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);
			$options[PREFIX . 'header-search-color'] = array(
				'id'          => PREFIX . 'header-search-color',
				'label'       => __( 'Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#6d6c6c'
			);
			$options[PREFIX . 'header-search-button-bg'] = array(
				'id'          => PREFIX . 'header-search-button-bg',
				'label'       => __( 'Button: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f8f8f8'
			);
			$options[PREFIX . 'header-search-button-bg-hover'] = array(
				'id'          => PREFIX . 'header-search-button-bg-hover',
				'label'       => __( 'Button: Background Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f1f1f1'
			);
			$options[PREFIX . 'header-search-button-color'] = array(
				'id'          => PREFIX . 'header-search-button-color',
				'label'       => __( 'Button: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#000000'
			);
			$options[PREFIX . 'header-search-sub-bg'] = array(
				'id'          => PREFIX . 'header-search-sub-bg',
				'label'       => __( 'Sub: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'header-search-sub-border-color'] = array(
				'id'          => PREFIX . 'header-search-sub-border-color',
				'label'       => __( 'Sub: Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);
			$options[PREFIX . 'header-search-sub-color-hover'] = array(
				'id'          => PREFIX . 'header-search-sub-color-hover',
				'label'       => __( 'Sub: Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);

		$options[PREFIX . 'header-buttons-group'] = array(
			'id'          => PREFIX . 'header-buttons-group',
			'label'       => __( 'Right Buttons', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'header-buttons-color'] = array(
				'id'          => PREFIX . 'header-buttons-color',
				'label'       => __( 'Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#000000'
			);
			$options[PREFIX . 'header-buttons-color-hover'] = array(
				'id'          => PREFIX . 'header-buttons-color-hover',
				'label'       => __( 'Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#999999'
			);
			$options[PREFIX . 'header-buttons-border-color'] = array(
				'id'          => PREFIX . 'header-buttons-border-color',
				'label'       => __( 'Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);

		$options[PREFIX . 'header-nav-group'] = array(
			'id'          => PREFIX . 'header-nav-group',
			'label'       => __( 'Navigation', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'header-nav-bg'] = array(
				'id'          => PREFIX . 'header-nav-bg',
				'label'       => __( 'Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f6f6f6'
			);
			$options[PREFIX . 'header-nav-color'] = array(
				'id'          => PREFIX . 'header-nav-color',
				'label'       => __( 'Links Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#666666'
			);
			$options[PREFIX . 'header-nav-color-hover'] = array(
				'id'          => PREFIX . 'header-nav-color-hover',
				'label'       => __( 'Links Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
			$options[PREFIX . 'header-nav-icons-color'] = array(
				'id'          => PREFIX . 'header-nav-icons-color',
				'label'       => __( 'Links Icons Color (if sub menu)', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#cccccc'
			);
			$options[PREFIX . 'header-nav-icons-color-hover'] = array(
				'id'          => PREFIX . 'header-nav-icons-color-hover',
				'label'       => __( 'Links Icons Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);

		$options[PREFIX . 'sub-menu-group'] = array(
			'id'          => PREFIX . 'sub-menu-group',
			'label'       => __( 'Sub Menu', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'header-sub-menu-bg'] = array(
				'id'          => PREFIX . 'header-sub-menu-bg',
				'label'       => __( 'Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'header-sub-menu-border-top-color'] = array(
				'id'          => PREFIX . 'header-sub-menu-border-top-color',
				'label'       => __( 'Border Top Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);
			$options[PREFIX . 'header-sub-menu-links-color'] = array(
				'id'          => PREFIX . 'header-sub-menu-links-color',
				'label'       => __( 'Links Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#8a8a8a'
			);
			$options[PREFIX . 'header-sub-menu-links-color-hover'] = array(
				'id'          => PREFIX . 'header-sub-menu-links-color-hover',
				'label'       => __( 'Links Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);
			$options[PREFIX . 'header-megamenu-title-color'] = array(
				'id'          => PREFIX . 'header-megamenu-title-color',
				'label'       => __( 'Megamenu: Title Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#000000'
			);
			$options[PREFIX . 'header-megamenu-title-color-hover'] = array(
				'id'          => PREFIX . 'header-megamenu-title-color-hover',
				'label'       => __( 'Megamenu: Title Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);
			$options[PREFIX . 'header-megamenu-border-color'] = array(
				'id'          => PREFIX . 'header-megamenu-border-color',
				'label'       => __( 'Megamenu: Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);

		$options[PREFIX . 'fixed-header-group'] = array(
			'id'          => PREFIX . 'fixed-header-group',
			'label'       => __( 'Fixed Header', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'fixed-header-bg'] = array(
				'id'          => PREFIX . 'fixed-header-bg',
				'label'       => __( 'Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'fixed-header-border-color'] = array(
				'id'          => PREFIX . 'fixed-header-border-color',
				'label'       => __( 'Border Bottom Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);
			$options[PREFIX . 'fixed-header-buttons-color'] = array(
				'id'          => PREFIX . 'fixed-header-buttons-color',
				'label'       => __( 'Right Buttons: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#aaaaaa'
			);
			$options[PREFIX . 'fixed-header-buttons-color-hover'] = array(
				'id'          => PREFIX . 'fixed-header-buttons-color-hover',
				'label'       => __( 'Right Buttons: Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
			$options[PREFIX . 'fixed-header-buttons-border-color'] = array(
				'id'          => PREFIX . 'fixed-header-buttons-border-color',
				'label'       => __( 'Right Buttons: Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#c6c6c6'
			);
			$options[PREFIX . 'fixed-header-buttons-border-color-hover'] = array(
				'id'          => PREFIX . 'fixed-header-buttons-border-color-hover',
				'label'       => __( 'Right Buttons: Border Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);

		// Title
		$section = PREFIX . 'title-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Title', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'title-bg'] = array(
			'id'          => PREFIX . 'title-bg',
			'label'       => __( 'Background Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ffffff'
		);
		$options[PREFIX . 'title-color'] = array(
			'id'          => PREFIX . 'title-color',
			'label'       => __( 'Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#444444'
		);
		$options[PREFIX . 'title-border-color'] = array(
			'id'          => PREFIX . 'title-border-color',
			'label'       => __( 'Border Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ebebeb'
		);
		$options[PREFIX . 'breadcrumbs-color'] = array(
			'id'          => PREFIX . 'breadcrumbs-color',
			'label'       => __( 'Breadcrumbs: Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#acacac'
		);
		$options[PREFIX . 'breadcrumbs-color-hover'] = array(
			'id'          => PREFIX . 'breadcrumbs-color-hover',
			'label'       => __( 'Breadcrumbs: Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#f3b714'
		);

		// Posts
		$section = PREFIX . 'posts-styling-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Posts', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'posts-border-bottom-color'] = array(
			'id'          => PREFIX . 'posts-border-bottom-color',
			'label'       => __( 'Border Bottom Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ebebeb'
		);
		$options[PREFIX . 'date-bg'] = array(
			'id'          => PREFIX . 'date-bg',
			'label'       => __( 'Date: Background Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ffffff'
		);
		$options[PREFIX . 'date-bg-hover'] = array(
			'id'          => PREFIX . 'date-bg-hover',
			'label'       => __( 'Date: Background Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fab000'
		);
		$options[PREFIX . 'date-color'] = array(
			'id'          => PREFIX . 'date-color',
			'label'       => __( 'Date: Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#777777'
		);
		$options[PREFIX . 'date-color-hover'] = array(
			'id'          => PREFIX . 'date-color-hover',
			'label'       => __( 'Date: Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ffffff'
		);
		$options[PREFIX . 'meta-color'] = array(
			'id'          => PREFIX . 'meta-color',
			'label'       => __( 'Meta: Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#999999'
		);
		$options[PREFIX . 'meta-color-hover'] = array(
			'id'          => PREFIX . 'meta-color-hover',
			'label'       => __( 'Meta: Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#f3b714'
		);
		$options[PREFIX . 'meta-icons-color'] = array(
			'id'          => PREFIX . 'meta-icons-color',
			'label'       => __( 'Meta: Icons Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#f3b714'
		);
		$options[PREFIX . 'more-link-color'] = array(
			'id'          => PREFIX . 'more-link-color',
			'label'       => __( 'More Link: Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#777777'
		);
		$options[PREFIX . 'more-link-color-hover'] = array(
			'id'          => PREFIX . 'more-link-color-hover',
			'label'       => __( 'More Link: Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fab000'
		);
		$options[PREFIX . 'more-link-border-color'] = array(
			'id'          => PREFIX . 'more-link-border-color',
			'label'       => __( 'More Link: Border Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#cccccc'
		);
		$options[PREFIX . 'more-link-border-color-hover'] = array(
			'id'          => PREFIX . 'more-link-border-color-hover',
			'label'       => __( 'More Link: Border Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fab000'
		);
		$options[PREFIX . 'link-post-format-group'] = array(
			'id'          => PREFIX . 'link-post-format-group',
			'label'       => __( 'Link Post Format', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'link-format-icon-bg'] = array(
				'id'          => PREFIX . 'link-format-icon-bg',
				'label'       => __( 'Icon: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#777777'
			);
			$options[PREFIX . 'link-format-icon-bg-hover'] = array(
				'id'          => PREFIX . 'link-format-icon-bg-hover',
				'label'       => __( 'Icon: Background Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);
			$options[PREFIX . 'link-format-icon-color'] = array(
				'id'          => PREFIX . 'link-format-icon-color',
				'label'       => __( 'Icon: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'link-format-icon-color-hover'] = array(
				'id'          => PREFIX . 'link-format-icon-color-hover',
				'label'       => __( 'Icon: Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
		$options[PREFIX . 'quote-post-format-group'] = array(
			'id'          => PREFIX . 'quote-post-format-group',
			'label'       => __( 'Quote Post Format', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'quote-format-bg'] = array(
				'id'          => PREFIX . 'quote-format-bg',
				'label'       => __( 'Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f6f6f6'
			);
			$options[PREFIX . 'quote-format-color'] = array(
				'id'          => PREFIX . 'quote-format-color',
				'label'       => __( 'Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#797979'
			);
			$options[PREFIX . 'quote-format-icon-bg'] = array(
				'id'          => PREFIX . 'quote-format-icon-bg',
				'label'       => __( 'Icon: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#777777'
			);
			$options[PREFIX . 'quote-format-icon-bg-hover'] = array(
				'id'          => PREFIX . 'quote-format-icon-bg-hover',
				'label'       => __( 'Icon: Background Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);
			$options[PREFIX . 'quote-format-icon-color'] = array(
				'id'          => PREFIX . 'quote-format-icon-color',
				'label'       => __( 'Icon: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'quote-format-icon-color-hover'] = array(
				'id'          => PREFIX . 'quote-format-icon-color-hover',
				'label'       => __( 'Icon: Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
		$options[PREFIX . 'single-post-styling-group'] = array(
			'id'          => PREFIX . 'single-post-styling-group',
			'label'       => __( 'Single Post', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'single-post-border-color'] = array(
				'id'          => PREFIX . 'single-post-border-color',
				'label'       => __( 'Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);
			$options[PREFIX . 'single-post-blockquote-bg'] = array(
				'id'          => PREFIX . 'single-post-blockquote-bg',
				'label'       => __( 'Blockquote: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f6f6f6'
			);
			$options[PREFIX . 'single-post-blockquote-color'] = array(
				'id'          => PREFIX . 'single-post-blockquote-color',
				'label'       => __( 'Blockquote: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#777777'
			);
			$options[PREFIX . 'single-post-blockquote-border-color'] = array(
				'id'          => PREFIX . 'single-post-blockquote-border-color',
				'label'       => __( 'Blockquote: Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#fab000'
			);
			$options[PREFIX . 'single-post-tags-bg'] = array(
				'id'          => PREFIX . 'single-post-tags-bg',
				'label'       => __( 'Tags: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f6f6f6'
			);
			$options[PREFIX . 'single-post-tags-bg-hover'] = array(
				'id'          => PREFIX . 'single-post-tags-bg-hover',
				'label'       => __( 'Tags: Background Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f2f2f2'
			);
			$options[PREFIX . 'single-post-tags-color'] = array(
				'id'          => PREFIX . 'single-post-tags-color',
				'label'       => __( 'Tags: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#777777'
			);
			$options[PREFIX . 'single-post-tags-color-hover'] = array(
				'id'          => PREFIX . 'single-post-tags-color-hover',
				'label'       => __( 'Tags: Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#444444'
			);
			$options[PREFIX . 'single-post-share-bg'] = array(
				'id'          => PREFIX . 'single-post-share-bg',
				'label'       => __( 'Share: Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f6f6f6'
			);
			$options[PREFIX . 'single-post-share-title-color'] = array(
				'id'          => PREFIX . 'single-post-share-title-color',
				'label'       => __( 'Share: Title Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#777777'
			);
			$options[PREFIX . 'single-post-share-buttons-bg'] = array(
				'id'          => PREFIX . 'single-post-share-buttons-bg',
				'label'       => __( 'Share: Buttons Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#222222'
			);
			$options[PREFIX . 'single-post-share-buttons-bg-hover'] = array(
				'id'          => PREFIX . 'single-post-share-buttons-bg-hover',
				'label'       => __( 'Share: Buttons Background Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
			$options[PREFIX . 'single-post-share-buttons-color'] = array(
				'id'          => PREFIX . 'single-post-share-buttons-color',
				'label'       => __( 'Share: Buttons Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'single-post-share-buttons-color-hover'] = array(
				'id'          => PREFIX . 'single-post-share-buttons-color-hover',
				'label'       => __( 'Share: Buttons Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'single-post-next-prev-color'] = array(
				'id'          => PREFIX . 'single-post-next-prev-color',
				'label'       => __( 'Next/Prev: Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
			$options[PREFIX . 'single-post-related-posts-categories-color'] = array(
				'id'          => PREFIX . 'single-post-related-posts-categories-color',
				'label'       => __( 'Related Posts: Categories Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
			$options[PREFIX . 'single-post-comments-date-color'] = array(
				'id'          => PREFIX . 'single-post-comments-date-color',
				'label'       => __( 'Comments: Date Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#666666'
			);

		// Sidebar
		$section = PREFIX . 'sidebar-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Sidebar', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'sidebar-title-border-bottom-color'] = array(
			'id'          => PREFIX . 'sidebar-title-border-bottom-color',
			'label'       => __( 'Title: Border Bottom Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ebebeb'
		);
		$options[PREFIX . 'sidebar-title-secondary-border-bottom-color'] = array(
			'id'          => PREFIX . 'sidebar-title-secondary-border-bottom-color',
			'label'       => __( 'Title: Secondary Border Bottom Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fab000'
		);

		// Footer
		$section = PREFIX . 'footer-styling-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Footer', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'footer-bg'] = array(
			'id'          => PREFIX . 'footer-bg',
			'label'       => __( 'Background Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fbfbfb'
		);
		$options[PREFIX . 'footer-border-top'] = array(
			'id'          => PREFIX . 'footer-border-top',
			'label'       => __( 'Border Top Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ebebeb'
		);
		$options[PREFIX . 'footer-border-bottom'] = array(
			'id'          => PREFIX . 'footer-border-bottom',
			'label'       => __( 'Border Bottom Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#fab000'
		);
		$options[PREFIX . 'footer-bottom-group'] = array(
			'id'          => PREFIX . 'footer-bottom-group',
			'label'       => __( 'Footer Bottom', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'footer-bottom-border-top'] = array(
				'id'          => PREFIX . 'footer-bottom-border-top',
				'label'       => __( 'Border Top Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ebebeb'
			);
			$options[PREFIX . 'footer-bottom-copyright-color'] = array(
				'id'          => PREFIX . 'footer-bottom-copyright-color',
				'label'       => __( 'Copyright Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#555555'
			);
			$options[PREFIX . 'footer-bottom-links-color'] = array(
				'id'          => PREFIX . 'footer-bottom-links-color',
				'label'       => __( 'Links Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#555555'
			);
			$options[PREFIX . 'footer-bottom-links-color-hover'] = array(
				'id'          => PREFIX . 'footer-bottom-links-color-hover',
				'label'       => __( 'Links Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
		$options[PREFIX . 'scroll-top-group'] = array(
			'id'          => PREFIX . 'scroll-top-group',
			'label'       => __( 'Scroll Top', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'scroll-top-color'] = array(
				'id'          => PREFIX . 'scroll-top-color',
				'label'       => __( 'Scroll Top Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#cccccc'
			);
			$options[PREFIX . 'scroll-top-color-hover'] = array(
				'id'          => PREFIX . 'scroll-top-color-hover',
				'label'       => __( 'Scroll Top Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#aaaaaa'
			);

		// Mobile
		$section = PREFIX . 'mobile-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Mobile', 'saha' ),
			'priority'    => 5,
			'panel'       => $styling_panel
		);
		$options[PREFIX . 'mobile-header-border-color'] = array(
			'id'          => PREFIX . 'mobile-header-border-color',
			'label'       => __( 'Header Border Bottom Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#ebebeb'
		);
		$options[PREFIX . 'mobile-link-color'] = array(
			'id'          => PREFIX . 'mobile-link-color',
			'label'       => __( 'Link Color', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#666666'
		);
		$options[PREFIX . 'mobile-link-color-hover'] = array(
			'id'          => PREFIX . 'mobile-link-color-hover',
			'label'       => __( 'Link Color Hover', 'saha' ),
			'section'     => $section,
			'type'        => 'color',
			'default'     => '#f3b714'
		);
		$options[PREFIX . 'mobile-nav-group'] = array(
			'id'          => PREFIX . 'mobile-nav-group',
			'label'       => __( 'Mobile Navigation', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'mobile-nav-bg'] = array(
				'id'          => PREFIX . 'mobile-nav-bg',
				'label'       => __( 'Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#1a1a1a'
			);
			$options[PREFIX . 'mobile-nav-close-title-bg'] = array(
				'id'          => PREFIX . 'mobile-nav-close-title-bg',
				'label'       => __( 'Close Title Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#1e1e1e'
			);
			$options[PREFIX . 'mobile-nav-close-title-color'] = array(
				'id'          => PREFIX . 'mobile-nav-close-title-color',
				'label'       => __( 'Close Title Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'mobile-nav-search-form-border-color'] = array(
				'id'          => PREFIX . 'mobile-nav-search-form-border-color',
				'label'       => __( 'Search Form Border Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#4f4f4f'
			);
			$options[PREFIX . 'mobile-nav-search-form-color'] = array(
				'id'          => PREFIX . 'mobile-nav-search-form-color',
				'label'       => __( 'Search Form Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'mobile-nav-search-form-button-color'] = array(
				'id'          => PREFIX . 'mobile-nav-search-form-button-color',
				'label'       => __( 'Search Form Button Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#dddddd'
			);
			$options[PREFIX . 'mobile-nav-links-color'] = array(
				'id'          => PREFIX . 'mobile-nav-links-color',
				'label'       => __( 'Links Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#ffffff'
			);
			$options[PREFIX . 'mobile-nav-links-color-hover'] = array(
				'id'          => PREFIX . 'mobile-nav-links-color-hover',
				'label'       => __( 'Links Color Hover', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#f3b714'
			);
			$options[PREFIX . 'mobile-nav-sub-menu-bg'] = array(
				'id'          => PREFIX . 'mobile-nav-sub-menu-bg',
				'label'       => __( 'Sub Menu Background Color', 'saha' ),
				'section'     => $section,
				'type'        => 'color',
				'default'     => '#222222'
			);

	// Typography Panel and Sections
	$typo_panel = 'typography';

	$panels[] = array(
		'id'          => $typo_panel,
		'title'       => __( 'Typography', 'saha' ),
		'description' => __( 'This panel is used for managing typography of your site.', 'saha' ),
		'priority'    => 30
	);

		// Global typography
		$section = PREFIX . 'global-typography';
		$font_choices = customizer_library_get_font_choices();

		$sections[] = array(
			'id'       => $section,
			'title'    => __( 'Global', 'saha' ),
			'priority' => 5,
			'panel'    => $typo_panel
		);
		$options[PREFIX . 'text-font'] = array(
			'id'          => PREFIX . 'text-font',
			'label'       => __( 'Text font', 'saha' ),
			'section'     => $section,
			'type'        => 'select2',
			'choices'     => $font_choices,
			'default'     => 'Lato',
		);
		$options[PREFIX . 'heading-font'] = array(
			'id'          => PREFIX . 'heading-font',
			'label'       => __( 'Heading font', 'saha' ),
			'section'     => $section,
			'type'        => 'select2',
			'choices'     => $font_choices,
			'default'     => 'Lato',
		);

	// Content Panel and Sections
	$content_panel = 'layouts';

	$panels[] = array(
		'id'          => $content_panel,
		'title'       => __( 'Layouts', 'saha' ),
		'description' => __( 'This panel is used for managing several custom features/layouts of your site.', 'saha' ),
		'priority'    => 35
	);

		// Posts
		$section = PREFIX . 'shop-layout-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Shop', 'saha' ),
			'priority'    => 9,
			'panel'       => $content_panel
		);
			$options[PREFIX . 'shop-layouts'] = array(
				'id'      => PREFIX . 'shop-layouts',
				'label'   => __( 'Shop Layouts', 'saha' ),
				'section' => $section,
				'type'    => 'radio',
				'default' => '2c-r',
				'choices' => array(
					'1c'   => __( '1 Column Wide (Full Width)', 'saha' ),
					'2c-l' => __( '2 Columns: Content / Sidebar', 'saha' ),
					'2c-r' => __( '2 Columns: Sidebar / Content', 'saha' )
				)
			);

		// Posts
		$section = PREFIX . 'posts-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Posts', 'saha' ),
			'priority'    => 10,
			'panel'       => $content_panel
		);
		$options[PREFIX . 'images-sizes-group'] = array(
			'id'          => PREFIX . 'images-sizes-group',
			'label'       => __( 'Images Sizes', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'posts-img-width'] = array(
				'id'      => PREFIX . 'posts-img-width',
				'label'   => __( 'Image Width', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '862',
			);
			$options[PREFIX . 'posts-img-height'] = array(
				'id'      => PREFIX . 'posts-img-height',
				'label'   => __( 'Image Height', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '478',
			);
			$options[PREFIX . '1c-posts-img-width'] = array(
				'id'      => PREFIX . '1c-posts-img-width',
				'label'   => __( 'Full Width Image Width', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '1180',
			);
			$options[PREFIX . '1c-posts-img-height'] = array(
				'id'      => PREFIX . '1c-posts-img-height',
				'label'   => __( 'Full Width Image Height', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '612',
			);
		$options[PREFIX . 'post-entry-group'] = array(
			'id'          => PREFIX . 'post-entry-group',
			'label'       => __( 'Post Entry', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'post-entry-date'] = array(
				'id'          => PREFIX . 'post-entry-date',
				'label'       => __( 'Show post entry date', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-entry-author'] = array(
				'id'          => PREFIX . 'post-entry-author',
				'label'       => __( 'Show post entry author name', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-entry-cat'] = array(
				'id'          => PREFIX . 'post-entry-cat',
				'label'       => __( 'Show post entry categories', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
		$options[PREFIX . 'single-post-group'] = array(
			'id'          => PREFIX . 'single-post-group',
			'label'       => __( 'Single Post', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'post-date'] = array(
				'id'          => PREFIX . 'post-date',
				'label'       => __( 'Show post date', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-author'] = array(
				'id'          => PREFIX . 'post-author',
				'label'       => __( 'Show post author name', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-cat'] = array(
				'id'          => PREFIX . 'post-cat',
				'label'       => __( 'Show post categories', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-tag'] = array(
				'id'          => PREFIX . 'post-tag',
				'label'       => __( 'Show post tags', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-share'] = array(
				'id'          => PREFIX . 'post-share',
				'label'       => __( 'Show post share', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-next-prev'] = array(
				'id'          => PREFIX . 'post-next-prev',
				'label'       => __( 'Show post next/prev', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'post-author-box'] = array(
				'id'          => PREFIX . 'post-author-box',
				'label'       => __( 'Show post author box', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
		$options[PREFIX . 'related-posts-group'] = array(
			'id'          => PREFIX . 'related-posts-group',
			'label'       => __( 'Related Posts', 'saha' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'related-posts'] = array(
				'id'          => PREFIX . 'related-posts',
				'label'       => __( 'Show related posts', 'saha' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'related-posts-img-width'] = array(
				'id'      => PREFIX . 'related-posts-img-width',
				'label'   => __( 'Related Posts Image Width', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '280',
			);
			$options[PREFIX . 'related-posts-img-height'] = array(
				'id'      => PREFIX . 'related-posts-img-height',
				'label'   => __( 'Related Posts Image Height', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '195',
			);
			$options[PREFIX . '1c-related-posts-img-width'] = array(
				'id'      => PREFIX . '1c-related-posts-img-width',
				'label'   => __( 'Full Width Related Posts Image Width', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '383',
			);
			$options[PREFIX . '1c-related-posts-img-height'] = array(
				'id'      => PREFIX . '1c-related-posts-img-height',
				'label'   => __( 'Full Width Related Posts Image Height', 'saha' ),
				'section' => $section,
				'type'    => 'text',
				'default' => '266',
			);

		// Page
		$section = PREFIX . 'page-title-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Page Title', 'saha' ),
			'priority'    => 15,
			'panel'       => $content_panel
		);
		$options[PREFIX . 'page-title'] = array(
			'id'          => PREFIX . 'page-title',
			'label'       => __( 'Show page title', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'page-breadcrumbs'] = array(
			'id'          => PREFIX . 'page-breadcrumbs',
			'label'       => __( 'Show page Breadcrumbs', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'blog-page'] = array(
			'id'      		=> PREFIX . 'blog-page',
			'label'   		=> __( 'Blog Page (for breadcrumbs)', 'saha' ),
			'section' 		=> $section,
			'type'    		=> 'dropdown-pages',
			'default' 		=> '',
		);
		$options[PREFIX . 'breadcrumbs-home-title'] = array(
			'id'      		=> PREFIX . 'breadcrumbs-home-title',
			'label'   		=> __( 'Breadcrumbs: Custom Home Title', 'saha' ),
			'description' 	=> __( 'Enter your custom breadcrumbs home title. You can enter HTML if you want to display an icon instead.', 'saha' ),
			'section' 		=> $section,
			'type'    		=> 'text',
			'default' 		=> '',
		);
		$options[PREFIX . 'breadcrumbs-title-trim'] = array(
			'id'      		=> PREFIX . 'breadcrumbs-title-trim',
			'label'   		=> __( 'Breadcrumbs: Title Trim Length', 'saha' ),
			'description' 	=> __( 'Enter the max number of words to display for your breadcrumbs post title.', 'saha' ),
			'section' 		=> $section,
			'type'    		=> 'text',
			'default' 		=> '4',
		);

	// Woo Panel and Sections
	$woo_panel = 'woocommerce';

	$panels[] = array(
		'id'          => $woo_panel,
		'title'       => __( 'WooCommerce', 'saha' ),
		'description' => __( 'This panel is used for managing woocommerce of your site.', 'saha' ),
		'priority'    => 35
	);

		// Products page
		$section = PREFIX . 'woo-products-page-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Products Page', 'saha' ),
			'priority'    => 5,
			'panel'       => $woo_panel
		);
		$options[PREFIX . 'woo-products-switcher'] = array(
			'id'          => PREFIX . 'woo-products-switcher',
			'label'       => __( 'Display Products Switcher', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'woo-products-per-page'] = array(
			'id'      		=> PREFIX . 'woo-products-per-page',
			'label'   		=> __( 'Products Per Page', 'saha' ),
			'section' 		=> $section,
			'type'    		=> 'text',
			'default' 		=> '12',
		);
		$options[PREFIX . 'woo-products-columns'] = array(
			'id'      => PREFIX . 'woo-products-columns',
			'label'   => __( 'Products Columns', 'saha' ),
			'section' => $section,
			'type'    => 'radio-buttonset',
			'choices'	=> array(
				'2'	=> __( '2', 'saha' ),
				'3'	=> __( '3', 'saha' ),
				'4'	=> __( '4', 'saha' ),
			),
			'default'	=> '3',
		);
		$options[PREFIX . 'woo-quick-title'] = array(
			'id'      => PREFIX . 'woo-quick-title',
			'label'   => __( 'Quick View', 'saha' ),
			'section' => $section,
			'type'    => 'group-title',
		);
		$options[PREFIX . 'quick-images'] = array(
			'id'          => PREFIX . 'quick-images',
			'label'       => __( 'Images Style', 'saha' ),
			'section'     => $section,
			'type'        => 'select',
			'default'     => 'slider',
			'choices'     => array(
				'slider' => __( 'Slider', 'saha' ),
				'single' => __( 'Single', 'saha' )
			)
		);
		$options[PREFIX . 'quick-product-name'] = array(
			'id'          => PREFIX . 'quick-product-name',
			'label'       => __( 'Display Product Name', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'quick-rating'] = array(
			'id'          => PREFIX . 'quick-rating',
			'label'       => __( 'Display Rating', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'quick-price'] = array(
			'id'          => PREFIX . 'quick-price',
			'label'       => __( 'Display Price', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'quick-descr'] = array(
			'id'          => PREFIX . 'quick-descr',
			'label'       => __( 'Display Description', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'quick-add-to-cart'] = array(
			'id'          => PREFIX . 'quick-add-to-cart',
			'label'       => __( 'Display Add To Cart Button', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'quick-share'] = array(
			'id'          => PREFIX . 'quick-share',
			'label'       => __( 'Display Share Buttons', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);

		// Single product
		$section = PREFIX . 'woo-single-product-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => __( 'Single Product', 'saha' ),
			'priority'    => 5,
			'panel'       => $woo_panel
		);
		$options[PREFIX . 'woo-images-lightbox'] = array(
			'id'          => PREFIX . 'woo-images-lightbox',
			'label'       => __( 'Display Images Lightbox', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'woo-share'] = array(
			'id'          => PREFIX . 'woo-share',
			'label'       => __( 'Display Social Share Buttons', 'saha' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

}
add_action( 'init', 'saha_customizer_register' );
