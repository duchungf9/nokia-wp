<?php
/**
 * Dropdown pages with Description.
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

class Customizer_Library_Dropdown_Pages extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 */
	public $type = 'dropdown-pages';

	/**
	 * Displays the dropdown on the customize screen.
	 */
	public function render_content() { ?>

		<label>
			<?php if ( $this->label ) { ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php } 
			if ( $this->description ) { ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php }

			$dropdown = wp_dropdown_pages(
				array(
					'name'              => '_customize-dropdown-pages-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( '&mdash; Select &mdash;', 'saha' ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);

			// Hackily add in the data link parameter.
			echo str_replace( '<select', '<select ' . $this->get_link(), $dropdown ); ?>
		</label>

	<?php }

}