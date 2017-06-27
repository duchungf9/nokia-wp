<?php
/**
 * Custom Sidebars
 *
 * @package	Saha
 * @author	 Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license	http://www.gnu.org/licenses/gpl-2.0.html
 * @since	  1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'SAHA_Custom_Sidebars' ) ) {
	class SAHA_Custom_Sidebars {
		protected $widget_areas	= array();
		protected $orig			= array();

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct( $widget_areas = array() ) {
			add_action( 'init', array( $this, 'register_custom_widget_areas' ) , 1000 );
			add_action( 'admin_print_scripts-widgets.php', array( $this, 'add_widget_box' ) );
			add_action( 'load-widgets.php', array( $this, 'add_widget_area' ), 100 );
			add_action( 'load-widgets.php', array( $this, 'scripts' ), 100 );
			add_action( 'admin_print_styles-widgets.php', array( $this, 'inline_css' ) );
			add_action( 'wp_ajax_saha_delete_widget_area', array( $this, 'saha_delete_widget_area' ) );
			add_action( 'wp_ajax_nopriv_saha_delete_widget_area', array( $this, 'saha_delete_widget_area' ) );
		}

		/**
		 * Add the widget box inside a script
		 *
		 * @since 1.0.0
		 */
		public function add_widget_box() {
			$nonce = wp_create_nonce ( 'delete-saha-widget_area-nonce' ); ?>
			  <script type="text/html" id="saha-add-widget-template">
				<div id="saha-add-widget" class="widgets-holder-wrap">
				 <div class="">
				  <input type="hidden" name="saha-nonce" value="<?php echo $nonce ?>" />
				  <div class="sidebar-name">
				   <h3><?php echo __( 'Create Widget Area', 'saha' ); ?> <span class="spinner"></span></h3>
				  </div>
				  <div class="sidebar-description">
					<form id="addWidgetAreaForm" action="" method="post">
					  <div class="widget-content">
						<input id="saha-add-widget-input" name="saha-add-widget-input" type="text" class="regular-text" title="<?php echo __( 'Name', 'saha' ); ?>" placeholder="<?php echo __( 'Name', 'saha' ); ?>" />
					  </div>
					  <div class="widget-control-actions">
						<div class="aligncenter">
						  <input class="addWidgetArea-button button-primary" type="submit" value="<?php echo __( 'Create Widget Area', 'saha' ); ?>" />
						</div>
						<br class="clear">
					  </div>
					</form>
				  </div>
				 </div>
				</div>
			  </script>
			<?php
		}

		/**
		 * Create new Widget Area
		 *
		 * @since 1.0.0
		 */
			public function add_widget_area() {
			if ( ! empty( $_POST['saha-add-widget-input'] ) ) {
				$this->widget_areas = $this->get_widget_areas();
				array_push( $this->widget_areas, $this->check_widget_area_name( $_POST['saha-add-widget-input'] ) );
				$this->save_widget_areas();
				wp_redirect( admin_url( 'widgets.php' ) );
				die();
			}
		}

		/**
		 * Before we create a new widget_area, verify it doesn't already exist. If it does, append a number to the name.
		 *
		 * @since 1.0.0
		 */
		public function check_widget_area_name( $name ) {
			if ( empty( $GLOBALS['wp_registered_widget_areas'] ) ) {
				return $name;
			}

			$taken = array();
			foreach ( $GLOBALS['wp_registered_widget_areas'] as $widget_area ) {
				$taken[] = $widget_area['name'];
			}

			$taken = array_merge( $taken, $this->widget_areas );

			if ( in_array( $name, $taken ) ) {
				$counter  = substr( $name, -1 );
				$new_name = '';

				if ( ! is_numeric( $counter ) ) {
					$new_name = $name . ' 1';
				} else {
					$new_name = substr( $name, 0, -1 ) . ((int) $counter + 1);
				}

				$name = $this->check_widget_area_name( $new_name );
			}
			echo $name;
			exit();
			return $name;
		}

		public function save_widget_areas() {
			set_theme_mod( 'saha-widget-areas', array_unique( $this->widget_areas ) );
		}

		/**
		 * Register and display the custom widget_area areas we have set.
		 *
		 * @since 1.0.0
		 */
		public function register_custom_widget_areas() {

			// Get widget areas
			if ( empty( $this->widget_areas ) ) {
				$this->widget_areas = $this->get_widget_areas();
			}

			// Original widget areas is empty
			$this->orig = array();

			// Save widget areas
			if ( ! empty( $this->orig ) && $this->orig != $this->widget_areas ) {
				$this->widget_areas = array_unique( array_merge( $this->widget_areas, $this->orig ) );
				$this->save_widget_areas();
			}

			// If widget areas are defined add a sidebar area for each
			if ( is_array( $this->widget_areas ) ) {
				foreach ( array_unique( $this->widget_areas ) as $widget_area ) {
					$args = array(
						'id'			=> sanitize_key( $widget_area ),
						'name'			=> $widget_area,
						'class'			=> 'saha-custom',
						'before_widget' => '<aside id="%1$s" class="widget %2$s">',
						'after_widget'  => '</aside>',
						'before_title'  => '<h3 class="widget-title">',
						'after_title'   => '</h3>',
					);
					register_sidebar( $args );
				}
			}
		}

		/**
		 * Return the widget_areas array.
		 *
		 * @since 1.0.0
		 */
		public function get_widget_areas() {

			// If the single instance hasn't been set, set it now.
			if ( ! empty( $this->widget_areas ) ) {
				return $this->widget_areas;
			}

			$db = get_theme_mod('saha-widget-areas');

			if (!empty($db)) {
				$this->widget_areas = array_unique(array_merge($this->widget_areas, $db));
			}

			// Return widget areas
			return $this->widget_areas;
		}

		/**
		 * Before we create a new widget_area, verify it doesn't already exist. If it does, append a number to the name.
		 *
		 * @since 1.0.0
		 */
		public function saha_delete_widget_area() {
			check_ajax_referer( 'delete-saha-widget_area-nonce', 'sahaNonce' );
			if ( ! empty( $_REQUEST['name'] ) ) {
				$name = strip_tags( ( stripslashes( $_REQUEST['name'] ) ) );
				$this->widget_areas = $this->get_widget_areas();
				$key = array_search($name, $this->widget_areas );
				if ( $key >= 0 ) {
					unset( $this->widget_areas[$key] );
					$this->save_widget_areas();
				}
				echo 'widget_area-deleted';
			}
			die();
		}

		/**
		 * Enqueue JS for the customizer controls
		 *
		 * @since 1.0.0
		 */
		public function scripts() {

			// Load scripts
			wp_enqueue_style( 'dashicons' );
			wp_enqueue_script( 'saha-widget-areas', trailingslashit( get_template_directory_uri() ) .'inc/plugins/assets/widget_areas.js', array('jquery'), time(), true );

			// Get widgets
			$widgets = array();
			if ( ! empty( $this->widget_areas ) ) {
				foreach ( $this->widget_areas as $widget ) {
					$widgets[$widget] = 1;
				}
			}

			// Localize script
			wp_localize_script(
				'saha-widget-areas',
				'sahaWidgetAreasLocalize',
				array(
					'count'   => count( $this->orig ),
					'delete'  => __( 'Delete', 'saha' ),
					'confirm' => __( 'Confirm', 'saha' ),
					'cancel'  => __( 'Cancel', 'saha' )
				)
			);
		}

		/**
		 * Adds inline CSS to style the widget form
		 *
		 * @since 1.0.0
		 */
		public function inline_css() { ?>

			<style type="text/css">
				body #saha-add-widget h3 { text-align: center !important; padding: 15px 7px; font-size: 1.3em; margin-top: 5px; }
				body div#widgets-right .sidebar-saha-custom .widgets-sortables { padding-bottom: 45px }
				body div#widgets-right .sidebar-saha-custom.closed .widgets-sortables { padding-bottom: 0 }
				body .saha-widget-area-footer { display: block; position: absolute; bottom: 0; left: 0; height: 40px; line-height: 40px; width: 100%; border-top: 1px solid #eee; }
				body .saha-widget-area-footer > div { padding: 8px 8px 0 }
				body .saha-widget-area-footer .saha-widget-area-id { display: block; float: left; max-width: 48%; overflow: hidden; position: relative; top: -6px; }
				body .saha-widget-area-footer .saha-widget-area-buttons { float: right }
				body .saha-widget-area-footer .description { padding: 0 !important; margin: 0 !important; }
				body div#widgets-right .sidebar-saha-custom.closed .widgets-sortables .saha-widget-area-footer { display: none }
				body .saha-widget-area-footer .saha-widget-area-delete { display: block; float: right; margin: 0; }
				body .saha-widget-area-footer .saha-widget-area-delete-confirm { display: none; float: right; margin: 0 5px 0 0; }
				body .saha-widget-area-footer .saha-widget-area-delete-cancel { display: none; float: right; margin: 0; }
				body .saha-widget-area-delete-confirm:hover:before { color: red }
				body .saha-widget-area-delete-confirm:hover { color: #000 }
				body .saha-widget-area-delete:hover:before { color: #888 }
				body .activate_spinner { display: block !important; position: absolute; top: 10px; right: 4px; background-color: #ECECEC; }
				body #saha-add-widget form { text-align: center }
				body #widget_area-saha-custom,
				body #widget_area-saha-custom h3 { position: relative }
				body #saha-add-widget p { margin-top: 0 }
				body #saha-add-widget { margin: 10px 0 0; position: relative; }
				body #saha-add-widget-input { max-width: 95%; padding: 8px; margin-bottom: 14px; margin-top: 3px; text-align: center; }
			</style>

		<?php }

	}
}
$saha_custom_sidebars = new SAHA_Custom_Sidebars();
