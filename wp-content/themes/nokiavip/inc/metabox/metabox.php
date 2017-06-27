<?php
/**
 * Adds custom metaboxes to the WordPress categories
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// The Metabox class
class Saha_Post_Metaboxes {
	private $post_types;

	/**
	 * Register this class with the WordPress API
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Post types to add the metabox to
		$this->post_types = apply_filters( 'saha_main_metaboxes_post_types', array(
			'post' 			=> 'post',
			'page' 			=> 'page',
			'product' 		=> 'product',
		) );

		// Add metabox to corresponding post types
		foreach( $this->post_types as $key => $val ) {
			add_action( 'add_meta_boxes_'. $val, array( $this, 'post_meta' ), 11 );
		}

		// Save meta
		add_action( 'save_post', array( $this, 'save_meta_data' ) );

		// Load scripts for the metabox
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// Load custom css for metabox
		add_action( 'admin_print_styles-post.php', array( $this, 'metaboxes_css' ) );
		add_action( 'admin_print_styles-post-new.php', array( $this, 'metaboxes_css' ) );

		// Load custom js for metabox
		add_action( 'admin_footer-post.php', array( $this, 'metaboxes_js' ) );
		add_action( 'admin_footer-post-new.php', array( $this, 'metaboxes_js' ) );

	}

	/**
	 * The function responsible for creating the actual meta box.
	 *
	 * @since 1.0.0
	 */
	public function post_meta( $post ) {
		$obj = get_post_type_object( $post->post_type );
		add_meta_box(
			'saha-metabox',
			$obj->labels->singular_name . ' '. __( 'Settings', 'saha' ),
			array( $this, 'display_meta_box' ),
			$post->post_type,
			'normal',
			'high'
		);
	}

	/**
	 * Enqueue scripts and styles needed for the metaboxes
	 *
	 * @since 1.0.0
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'jquery' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}

	/**
	 * Renders the content of the meta box.
	 *
	 * @since 1.0.0
	 */
	public function display_meta_box( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'saha_metabox', 'saha_metabox_nonce' );

		// Get current post data
		$post_id   = $post->ID;
		$post_type = get_post_type();

		// Get tabs
		$tabs = $this->tabs_array();

		// Make sure tabs aren't empty
		if ( empty( $tabs ) ) {
			echo '<p>Hey your settings are empty, something is going on please contact your webmaster</p>';
			return;
		}

		// Store tabs that should display on this specific page in an array for use later
		$active_tabs = array();
		foreach ( $tabs as $tab ) {
			$tab_post_type = isset( $tab['post_type'] ) ? $tab['post_type'] : '';
			if ( ! $tab_post_type ) {
				$display_tab = true;
			} elseif ( in_array( $post_type, $tab_post_type ) ) {
				$display_tab = true;
			} else {
				$display_tab = false;
			}
			if ( $display_tab ) {
				$active_tabs[] = $tab;
			}
		} ?>

		<ul class="wp-tab-bar">
			<?php
			// Output tab links
			$saha_count = '';
			foreach ( $active_tabs as $tab ) {
				$saha_count++;
				$li_class = ( '1' == $saha_count ) ? ' class="wp-tab-active"' : '';
				// Define tab title
				$tab_title = $tab['title'] ? $tab['title'] : __( 'Other', 'saha' ); ?>
				<li<?php echo $li_class; ?>>
					<a href="javascript:;" data-tab="#saha-mb-tab-<?php echo $saha_count; ?>"><?php echo $tab_title; ?></a>
				</li>
			<?php } ?>
		</ul><!-- .saha-mb-tabnav -->

		<?php
		// Output tab sections
		$saha_count = '';
		foreach ( $active_tabs as $tab ) {
			$saha_count++; ?>
			<div id="saha-mb-tab-<?php echo $saha_count; ?>" class="wp-tab-panel clr">
				<table class="form-table">
					<?php
					// Loop through sections and store meta output
					foreach ( $tab['settings'] as $setting ) {

						// Vars
						$meta_id     = $setting['id'];
						$title       = $setting['title'];
						$hidden      = isset ( $setting['hidden'] ) ? $setting['hidden'] : false;
						$type        = isset ( $setting['type'] ) ? $setting['type'] : 'text';
						$default     = isset ( $setting['default'] ) ? $setting['default'] : '';
						$description = isset ( $setting['description'] ) ? $setting['description'] : '';
						$meta_value  = get_post_meta( $post_id, $meta_id, true );
						$meta_value  = $meta_value ? $meta_value : $default; ?>

						<tr<?php if ( $hidden ) echo ' style="display:none;"'; ?> id="<?php echo $meta_id; ?>_tr">
							<th>
								<label for="saha_main_layout"><strong><?php echo $title; ?></strong></label>
								<?php
								// Display field description
								if ( $description ) { ?>
									<p class="saha-mb-description"><?php echo $description; ?></p>
								<?php } ?>
							</th>

							<?php
							// Text Field
							if ( 'text' == $type ) { ?>

								<td><input name="<?php echo $meta_id; ?>" type="text" value="<?php echo $meta_value; ?>"></td>

							<?php }

							// Number Field
							if ( 'number' == $type ) { ?>

								<td><input name="<?php echo $meta_id; ?>" type="number" value="<?php echo $meta_value; ?>"></td>

							<?php }

							// HTML Text
							if ( 'text_html' == $type ) { ?>

								<td><input name="<?php echo $meta_id; ?>" type="text" value="<?php echo esc_html( $meta_value ); ?>"></td>

							<?php }

							// Link field
							elseif ( 'link' == $type ) { ?>

								<td><input name="<?php echo $meta_id; ?>" type="text" value="<?php echo esc_url( $meta_value ); ?>"></td>

							<?php }

							// Textarea Field
							elseif ( 'textarea' == $type ) {
								$rows = isset ( $setting['rows'] ) ? $setting['rows'] : '4';?>

								<td>
									<textarea rows="<?php echo $rows; ?>" cols="1" name="<?php echo $meta_id; ?>" type="text" class="saha-mb-textarea"><?php echo $meta_value; ?></textarea>
								</td>

							<?php }

							// Code Field
							elseif ( 'code' == $type ) { ?>

								<td>
									<textarea rows="1" cols="1" name="<?php echo $meta_id; ?>" type="text" class="saha-mb-textarea-code"><?php echo $meta_value; ?></textarea>
								</td>

							<?php }

							// Checkbox
							elseif ( 'checkbox' == $type ) {

								$meta_value = ( 'on' == $meta_value ) ? false : true; ?>
								<td><input name="<?php echo $meta_id; ?>" type="checkbox" <?php checked( $meta_value, true, true ); ?>></td>

							<?php }

							// Select
							elseif ( 'select' == $type ) {

								$options = isset ( $setting['options'] ) ? $setting['options'] : '';
								if ( ! empty( $options ) ) { ?>
									<td><select id="<?php echo $meta_id; ?>" name="<?php echo $meta_id; ?>">
									<?php foreach ( $options as $option_value => $option_name ) { ?>
										<option value="<?php echo $option_value; ?>" <?php selected( $meta_value, $option_value, true ); ?>><?php echo $option_name; ?></option>
									<?php } ?>
									</select></td>
								<?php }

							}

							// Select
							elseif ( 'color' == $type ) { ?>

								<td><input name="<?php echo $meta_id; ?>" type="text" value="<?php echo $meta_value; ?>" class="saha-mb-color-field"></td>

							<?php }

							// Media
							elseif ( 'media' == $type ) { ?>
								<td>
									<div class="uploader">
										<input type="text" name="<?php echo $meta_id; ?>" value="<?php echo $meta_value; ?>">
										<input class="saha-mb-uploader button-secondary" name="<?php echo $meta_id; ?>" type="button" value="<?php _e( 'Upload', 'saha' ); ?>" />
									</div>
								</td>

							<?php }

							// Editor
							elseif ( 'editor' == $type ) {
								$teeny= isset( $setting['teeny'] ) ? $setting['teeny'] : false;
								$rows = isset( $setting['rows'] ) ? $setting['rows'] : '10';
								$media_buttons= isset( $setting['media_buttons'] ) ? $setting['media_buttons'] : true; ?>
								<td><?php wp_editor( $meta_value, $meta_id, array(
									'textarea_name' => $meta_id,
									'teeny' => $teeny,
									'textarea_rows' => $rows,
									'media_buttons' => $media_buttons,
								) ); ?></td>
							<?php } ?>
						</tr>

					<?php } ?>
				</table>
			</div>
		<?php } ?>

		<div class="saha-mb-reset">
			<a class="button button-secondary saha-reset-btn"><?php _e( 'Reset Settings', 'saha' ); ?></a>
			<div class="saha-reset-checkbox"><input type="checkbox" name="saha_metabox_reset"> <?php _e( 'Are you sure? Check this box, then update your post to reset all settings.', 'saha' ); ?></div>
		</div>

		<div class="clear"></div>

	<?php }

	/**
	 * Save metabox data
	 *
	 * @since 1.0.0
	 */
	public function save_meta_data( $post_id ) {

		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['saha_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['saha_metabox_nonce'], 'saha_metabox' ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. Now we can loop through fields */

		// Check reset field
		$reset = isset( $_POST['saha_metabox_reset'] ) ? $_POST['saha_metabox_reset'] : '';

		// Set settings array
		$tabs = $this->tabs_array();
		$settings = array();
		foreach( $tabs as $tab ) {
			foreach ( $tab['settings'] as $setting ) {
				$settings[] = $setting;
			}
		}

		// Loop through settings and validate
		foreach ( $settings as $setting ) {

			// Vars
			$value = '';
			$id    = $setting['id'];
			$type  = isset ( $setting['type'] ) ? $setting['type'] : 'text';

			// Make sure field exists and if so validate the data
			if ( isset( $_POST[$id] ) ) {

				// Validate text
				if ( 'text' == $type ) {
					$value = sanitize_text_field( $_POST[$id] );
				}

				// Validate textarea
				if ( 'textarea' == $type ) {
					$value = esc_html( $_POST[$id] );
				}

				// Links
				elseif ( 'link' == $type ) {
					$value = esc_url( $_POST[$id] );
				}

				// Validate select
				elseif ( 'select' == $type ) {
					if ( 'default' == $_POST[$id] ) {
						$value = '';
					} else {
						$value = $_POST[$id];
					}
				}

				// Validate media
				if ( 'media' == $type ) {

					// Sanitize
					$value = $_POST[$id];

				}

				// All else
				else {
					$value = $_POST[$id];
				}

				// Update meta if value exists
				if ( $value && 'on' != $reset ) {
					update_post_meta( $post_id, $id, $value );
				}

				// Otherwise cleanup stuff
				else {
					delete_post_meta( $post_id, $id );
				}
			}

		}

	}

	/**
	 * Helpers
	 *
	 * @since 1.0.0
	 */
	public static function helpers( $return = NULl ) {

		// Title styles
		if ( 'title_styles' == $return ) {
			$styles = array(
				'' 					=> __( 'Default', 'saha' ),
				'background-image' 	=> __( 'Background Image', 'saha' ),
			);
			$styles = apply_filters( 'saha_title_styles', $styles );
			return $styles;
		}

		// Widgets
		elseif ( 'widget_areas' == $return ) {
			global $wp_registered_sidebars;
			$widgets_areas = array( __( 'Default', 'saha' ) );
			$get_widget_areas = $wp_registered_sidebars;
			if ( ! empty( $get_widget_areas ) ) {
				foreach ( $get_widget_areas as $widget_area ) {
					$name = isset ( $widget_area['name'] ) ? $widget_area['name'] : '';
					$id = isset ( $widget_area['id'] ) ? $widget_area['id'] : '';
					if ( $name && $id ) {
						$widgets_areas[$id] = $name;
					}
				}
			}
			return $widgets_areas;
		}

	}

	/**
	 * Settings Array
	 *
	 * @since 1.0.0
	 */
	public function tabs_array() {

		// Prefix
		$prefix = 'saha_';

		// Define variable
		$array = array();

		// General Tab
		$array['general'] = array(
			'title' 	=> __( 'General', 'saha' ),
			'settings' 	=> array(
				'page_fullscreen' 	=> array(
					'title' 		=> __( 'Page Fullscreen', 'saha' ),
					'id' 			=> $prefix . 'page_fullscreen',
					'type' 			=> 'select',
					'description' 	=> __( 'Activate the fullscreen on this page or post.', 'saha' ),
					'options' 		=> array(
						'' 		=> __( 'No', 'saha' ),
						'on' 	=> __( 'Yes', 'saha' ),
					),
				),
				'sidebar' 			=> array(
					'title' 		=> __( 'Sidebar', 'saha' ),
					'type' 			=> 'select',
					'id' 			=> 'sidebar',
					'description' 	=> __( 'Select your custom sidebar for this page or post.', 'saha' ),
					'options' 		=> $this->helpers( 'widget_areas' ),
				),
				'disable_margin' 	=> array(
					'title' 		=> __( 'Margin', 'saha' ),
					'id' 			=> $prefix . 'disable_margin',
					'type' 			=> 'select',
					'description' 	=> __( 'Enable or disable the margin top & bottom on this page or post.', 'saha' ),
					'options' 		=> array(
						'' 			=> __( 'Default', 'saha' ),
						'enable' 	=> __( 'Enable', 'saha' ),
						'on' 		=> __( 'Disable', 'saha' ),
					),
				),
			),
		);

		// Title Tab
		$array['title'] = array(
			'title' 	=> __( 'Title', 'saha' ),
			'settings' 	=> array(
				'disable_title' 	=> array(
					'title' 		=> __( 'Title', 'saha' ),
					'id' 			=> $prefix . 'disable_title',
					'type' 			=> 'select',
					'description' 	=> __( 'Enable or disable this element on this page or post.', 'saha' ),
					'options' 		=> array(
						'' 		=> __( 'Enable', 'saha' ),
						'on' 	=> __( 'Disable', 'saha' ),
					),
				),
				'title_style' 	=> array(
					'title' 		=> __( 'Title Style', 'saha' ),
					'type' 			=> 'select',
					'id' 			=> $prefix . 'title_style',
					'description' 	=> __( 'Select a custom title style for this page or post.', 'saha' ),
					'options' 		=> $this->helpers( 'title_styles' ),
				),
				'title_color' 	=> array(
					'title' 		=> __( 'Title Color', 'saha' ),
					'id' 			=> $prefix . 'title_color',
					'type' 			=> 'color',
					'description' 	=> __( 'Select your color for your title.', 'saha' ),
					'hidden' 		=> true,
				),
				'title_font_size' => array(
					'title' 		=> __( 'Title Font Size', 'saha' ),
					'type' 			=> 'text',
					'id' 			=> $prefix . 'title_font_size',
					'description' 	=> __( 'Select your custom font size (px, em, %) for your title.', 'saha' ),
					'hidden' 		=> true,
				),
				'title_background_img' => array(
					'title' 		=> __( 'Title: Background Image', 'saha'),
					'id' 			=> $prefix . 'title_background_img',
					'type' 			=> 'media',
					'description' 	=> __( 'Select a custom header image for your main title.', 'saha' ),
					'hidden' 		=> true,
				),
				'title_height' => array(
					'title' 		=> __( 'Title: Background Height', 'saha' ),
					'type' 			=> 'text',
					'id' 			=> $prefix . 'title_height',
					'description' 	=> __( 'Select your custom height (in px) for your title background.', 'saha' ),
					'hidden' 		=> true,
				),
				'title_background_overlay' => array(
					'title' 		=> __( 'Title: Background Overlay', 'saha' ),
					'type' 			=> 'select',
					'id' 			=> $prefix . 'title_background_overlay',
					'description' 	=> __( 'Select an overlay for the title background.', 'saha' ),
					'options' => array(
						'' 			=> __( 'No', 'saha' ),
						'yes' 		=> __( 'Yes', 'saha' ),
					),
					'hidden' => true,
				),
				'title_background_overlay_opacity' => array(
					'id' 			=> $prefix . 'title_background_overlay_opacity',
					'type' 			=> 'text',
					'title' 		=> __( 'Title: Background Overlay Opacity', 'saha' ),
					'description' 	=> __( 'Enter a custom opacity for your title background overlay.', 'saha' ),
					'default' 		=> '',
					'hidden' 		=> true,
				),
			),
		);

		// Media tab
		$array['media'] = array(
			'title' 	=> __( 'Media', 'saha' ),
			'post_type' => array( 'post' ),
			'settings' 	=> array(
				'post_oembed' 		=> array(
					'title' 		=> __( 'oEmbed URL', 'saha' ),
					'description' 	=>__( 'Enter a URL that is compatible with WP\'s built-in oEmbed feature. This setting is used for your video and audio post formats.', 'saha' ) .'<br /><a href="http://codex.wordpress.org/Embeds" target="_blank">'. __( 'Learn More', 'saha' ) .' &rarr;</a>',
					'id' 			=> $prefix . 'post_oembed',
					'type' 			=> 'text',
				),
				'post_self_hosted_shortcode' => array(
					'title' 		=> __( 'Self Hosted', 'saha' ),
					'description' 	=> __( 'Insert your self hosted video or audio url here.', 'saha' ) .'<br /><a href="http://make.wordpress.org/core/2013/04/08/audio-video-support-in-core/" target="_blank">'. __( 'Learn More', 'saha' ) .' &rarr;</a>',
					'id' 			=> $prefix . 'post_self_hosted_media',
					'type' 			=> 'media',
				),
				'post_video_embed' 	=> array(
					'title' 		=> __( 'Embed Code', 'saha' ),
					'description' 	=> __( 'Insert your embed/iframe code.', 'saha' ),
					'id' 			=> $prefix . 'post_video_embed',
					'type' 			=> 'textarea',
					'rows' 			=> '2',
				),
			),
		);

		// Link/Quote tab
		$array['link_quote'] = array(
			'title' 	=> __( 'Link/Quote', 'saha' ),
			'post_type' => array( 'post' ),
			'settings' 	=> array(
				'link_format' 		=> array(
					'title' 		=> __( 'Link', 'saha' ),
					'description' 	=>__( 'Enter your external url. This setting is used for your link post formats.', 'saha' ),
					'id' 			=> $prefix . 'link_format',
					'type' 			=> 'text',
				),
				'link_format_target' => array(
					'title' 		=> __( 'Link Target', 'saha' ),
					'type' 			=> 'select',
					'id' 			=> $prefix . 'link_format_target',
					'description' 	=> __( 'Choose your target for the url. This setting is used for your link post formats.', 'saha' ),
					'options' => array(
						'self' 		=> __( 'Self', 'saha' ),
						'blank' 	=> __( 'Blank', 'saha' ),
					),
				),
				'quote_format' 		=> array(
					'title' 		=> __( 'Quote', 'saha' ),
					'description' 	=> __( 'Enter your quote. This setting is used for your quote post formats.', 'saha' ),
					'id' 			=> $prefix . 'quote_format',
					'type' 			=> 'textarea',
					'rows' 			=> '2',
				),
			),
		);

		// Apply filter & return settings array
		return apply_filters( 'saha_metabox_array', $array );
	}

	/**
	 * Adds custom CSS for the metaboxes inline instead of loading another stylesheet
	 *
	 * @see assets/metabox.css
	 * @since 1.0.0
	 */
	public static function metaboxes_css() { ?>

		<style type="text/css">
			#saha-metabox .wp-tab-panel{display:none;}#saha-metabox .wp-tab-panel#saha-mb-tab-1{display:block;}#saha-metabox .wp-tab-panel{max-height:none !important;}#saha-metabox ul.wp-tab-bar{-webkit-touch-callout:none;-webkit-user-select:none;-khtml-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;}#saha-metabox ul.wp-tab-bar{padding-top:5px;}#saha-metabox ul.wp-tab-bar:after{content:"";display:block;height:0;clear:both;visibility:hidden;zoom:1;}#saha-metabox ul.wp-tab-bar li{padding:5px 12px;font-size:14px;}#saha-metabox ul.wp-tab-bar li a:focus{box-shadow:none;}#saha-metabox .inside .form-table tr{border-top:1px solid #dfdfdf;}#saha-metabox .inside .form-table tr:first-child{border:none;}#saha-metabox .inside .form-table th{width:240px;padding:10px 30px 10px 0;}#saha-metabox .inside .form-table td{padding:10px 0;}#saha-metabox .inside .form-table label{display:block;}#saha-metabox .inside .form-table th label span{margin-right:7px;}#saha-metabox .saha-mb-uploader{margin-left:5px;}#saha-metabox .inside .form-table th p.saha-mb-description{font-size:12px;font-weight:normal;margin:0;padding:0;padding-top:4px;}#saha-metabox .inside .form-table input[type="text"],#saha-metabox .inside .form-table input[type="number"],#saha-metabox .inside .form-table .saha-mb-textarea-code{width:40%;}#saha-metabox .inside .form-table textarea{width:100%}#saha-metabox .inside .form-table select{min-width:40%;}#saha-metabox .saha-mb-reset{margin-top:7px;}#saha-metabox .saha-mb-reset .saha-reset-btn{display:block;float:left;}#saha-metabox .saha-mb-reset .saha-reset-checkbox{float:left;display:none;margin-left:10px;padding-top:5px;}
		</style>

	<?php

	}

	/**
	 * Adds custom js for the metaboxes inline instead of loading another js file
	 *
	 * @see assets/metabox.js
	 * @since 1.0.0
	 */
	public static function metaboxes_js() { ?>

		<script type="text/javascript">
			!function(a){"use strict";a(document).on("ready",function(){a("div#saha-metabox ul.wp-tab-bar a").click(function(){var t=a("#saha-metabox ul.wp-tab-bar li"),e=a(this).data("tab"),i=a("#saha-metabox div.wp-tab-panel");return a(t).removeClass("wp-tab-active"),a(i).hide(),a(e).show(),a(this).parent("li").addClass("wp-tab-active"),!1}),a("div#saha-metabox .saha-mb-color-field").wpColorPicker();var t=!0,e=wp.media.editor.send.attachment;a("div#saha-metabox .saha-mb-uploader").click(function(i){var s=(wp.media.editor.send.attachment,a(this)),h=s.prev();return wp.media.editor.send.attachment=function(i,s){return t?void a(h).val(s.id):e.apply(this,[i,s])},wp.media.editor.open(s),!1}),a("div#saha-metabox .add_media").on("click",function(){t=!1}),a("div#saha-metabox div.saha-mb-reset a.saha-reset-btn").click(function(){var t=a("div.saha-mb-reset div.saha-reset-checkbox"),e=t.is(":visible")?"<?php echo __(  'Reset Settings', 'saha' ); ?>":"<?php echo __(  'Cancel Reset', 'saha' ); ?>";a(this).text(e),a("div.saha-mb-reset div.saha-reset-checkbox input").attr("checked",!1),t.toggle()});var i=a("div#saha-metabox select#saha_disable_title"),s=a("#saha_title_style_tr"),h=a("div#saha-metabox select#saha_title_style"),o=h.val(),r=a("#saha_title_color_tr,#saha_title_font_size_tr,#saha_title_background_img_tr,#saha_title_height_tr,#saha_title_background_overlay_tr,#saha_title_background_overlay_opacity_tr");"on"===i.val()?(s.hide(),r.hide()):s.show(),"background-image"===o&&r.show(),i.change(function(){if("on"===a(this).val())s.hide(),r.hide();else{s.show();var t=h.val();"background-image"===t&&r.show()}}),h.change(function(){r.hide(),"background-image"==a(this).val()&&r.show()})})}(jQuery);
		</script>

	<?php }

}
$saha_post_metaboxes = new Saha_Post_Metaboxes();