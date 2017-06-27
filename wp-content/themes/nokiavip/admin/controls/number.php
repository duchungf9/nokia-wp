<?php
/**
 * The number customize control extends the WP_Customize_Control class.  This class allows 
 * developers to create number settings within the WordPress theme customizer.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return NULL;
}

/**
 * Number customize control class.
 *
 * @since  1.0.0
 */
class Customizer_Library_Number extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 */
	public $type = 'number';

	/**
	 * Displays the number on the customize screen.
	 */
	public function render_content() { ?>
		<label>
			
			<?php if ( $this->label ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } 
			if ( $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php } ?>
			
			<input type="number" step="1" min="0" value="<?php echo (int) $this->value(); ?>" <?php $this->link(); ?>>
			
		</label>
	<?php }
	
}