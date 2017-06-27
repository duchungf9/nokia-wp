<?php
/**
 * Initial functions.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Filters the original Walker.
 *
 * @since  1.0.0
 */
function saha_walker_init() {

	// Add custom field to menu
	add_filter( 'wp_setup_nav_menu_item', 'saha_add_custom_nav_fields' );
	add_action( 'wp_nav_menu_item_custom_fields', 'saha_add_custom_fields', 10, 4 );

	// Save menu custom fields
	add_action( 'wp_update_nav_menu_item', 'saha_update_custom_nav_fields', 10, 3 );
	
	// Edit menu walker
	add_filter( 'wp_edit_nav_menu_walker', 'saha_edit_walker', 10, 2 );

}
add_action( 'after_setup_theme', 'saha_walker_init', 10 );

/**
 * Add custom fields to $item nav object
 * in order to be used in custom Walker.
 *
 * @since  1.0.0
 */
function saha_add_custom_nav_fields( $menu_item ) {
	$menu_item->megamenu 			= get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
	$menu_item->columns 			= get_post_meta( $menu_item->ID, '_menu_item_columns', true );
	$menu_item->megamenu_auto 		= get_post_meta( $menu_item->ID, '_menu_item_megamenu_auto', true );
	$menu_item->megamenu_image 		= get_post_meta( $menu_item->ID, '_menu_item_megamenu_image', true );
	$menu_item->image_repeat 		= get_post_meta( $menu_item->ID, '_menu_item_image_repeat', true );
	$menu_item->image_position 		= get_post_meta( $menu_item->ID, '_menu_item_image_position', true );
	$menu_item->custom_css 			= get_post_meta( $menu_item->ID, '_menu_item_custom_css', true );
	$menu_item->custom_styles 		= get_post_meta( $menu_item->ID, '_menu_item_custom_styles', true );
	$menu_item->nolink 				= get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
	$menu_item->hide 				= get_post_meta( $menu_item->ID, '_menu_item_hide', true );
	$menu_item->icon 				= get_post_meta( $menu_item->ID, '_menu_item_icon', true );
	$menu_item->sidebar 			= get_post_meta( $menu_item->ID, '_menu_item_sidebar', true );

	return $menu_item;
}

/**
 * Add custom megamenu field.
 *
 * @since  1.0.0
 */
function saha_add_custom_fields( $id, $item, $depth, $args ) {
?>
	<p class="field-icon description description-wide">
        <label for="edit-menu-item-icon-<?php echo esc_attr( $item->ID ); ?>">
            <?php _e( 'Enter Icon Class', 'saha' ); ?> <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome</a> - <a href="http://thesabbir.github.io/simple-line-icons/" target="_blank">Simple Line Icons</a><br />
            <input type="text" id="edit-menu-item-icon-<?php echo esc_attr( $item->ID ); ?>" class="widefat edit-menu-item-icon" name="menu-item-icon[<?php echo esc_attr( $item->ID ); ?>]" value="<?php echo esc_attr( $item->icon ); ?>" />
        </label>
    </p>
    <p class="field-megamenu description description-wide">
    	<?php $value = esc_attr( $item->megamenu ); ?>
    	<label for="edit-menu-item-megamenu-<?php echo esc_attr( $item->ID ); ?>">
    		<input type="checkbox" id="edit-menu-item-megamenu-<?php echo esc_attr( $item->ID ); ?>" class="code edit-menu-item-megamenu" name="menu-item-megamenu[<?php echo esc_attr( $item->ID ); ?>]" value="megamenu" <?php if($value != "") { ?>checked="checked"<?php } ?> />
    		<strong><?php _e( "Enable Mega Menu", 'saha' ); ?></strong>
    	</label>
	</p>
	<p class="field-columns description description-wide">
		<label for="edit-menu-item-columns-<?php echo esc_attr( $item->ID ); ?>">
			<?php _e( 'Mega Menu Number of Columns', 'saha' ); ?><br />
			<select id="edit-menu-item-columns<?php echo esc_attr( $item->ID ); ?>" class="widefat edit-menu-item-columns" name="menu-item-columns[<?php echo esc_attr( $item->ID ); ?>]">
				<option value="2" <?php selected( esc_attr( $item->columns ), '2' ); ?>>2</option>
				<option value="3" <?php selected( esc_attr( $item->columns ), '3' ); ?>>3</option>
				<option value="4" <?php selected( esc_attr( $item->columns ), '4' ); ?>>4</option>
				<option value="5" <?php selected( esc_attr( $item->columns ), '5' ); ?>>5</option>
				<option value="6" <?php selected( esc_attr( $item->columns ), '6' ); ?>>6</option>
			</select>
		</label>
    </p>
    <p class="field-megamenu_auto description description-wide">
    	<?php $value = esc_attr( $item->megamenu_auto ); ?>
    	<label for="edit-menu-item-megamenu_auto-<?php echo esc_attr( $item->ID ); ?>">
    		<input type="checkbox" id="edit-menu-item-megamenu_auto-<?php echo esc_attr( $item->ID ); ?>" class="code edit-menu-item-megamenu_auto" name="menu-item-megamenu_auto[<?php echo esc_attr( $item->ID ); ?>]" value="megamenu_auto" <?php if($value != "") { ?>checked="checked"<?php } ?> />
    		<?php _e( "Mega Menu Auto Width", 'saha' ); ?>
    	</label>
	</p>
	<p class="field-image-upload description description-wide">
		<a href="#" id="saha-media-upload-<?php echo esc_attr( $item->ID ); ?>" class="saha-open-media saha-megamenu-upload-image"><?php _e( 'Set Background Image', 'saha' ); ?></a>
	</p>
	<?php $image = esc_attr( $item->megamenu_image ); ?>
	<p class="field-megamenu_image description description-wide">
    	<label for="edit-menu-item-megamenu_image-<?php echo esc_attr( $item->ID ); ?>">
    		<input type="hidden" id="edit-menu-item-megamenu_image-<?php echo esc_attr( $item->ID ); ?>" class="code edit-menu-item-megamenu_image" name="menu-item-megamenu_image[<?php echo esc_attr( $item->ID ); ?>]" value="<?php echo esc_attr( $item->megamenu_image ); ?>" />
    		<img src="<?php echo esc_attr( $item->megamenu_image ); ?>" id="saha-media-img-<?php echo esc_attr( $item->ID ); ?>" class="megamenu_image-image" style="<?php echo ( trim( esc_attr( $item->megamenu_image ) ) ) ? 'display: inline;' : '';?>" />
    		<a href="#" id="saha-media-remove-<?php echo esc_attr( $item->ID ); ?>" class="saha-remove-image custom-bg-<?php echo esc_attr( $item->ID ); ?>" <?php if($image != "") { ?>style="display:inline-block;"<?php } ?>><?php _e( "Remove Image", 'saha' ); ?></a>
    	</label>
	</p>
	<p class="field-image_repeat description description-thin custom-bg-<?php echo esc_attr( $item->ID ); ?>" <?php if($image != "") { ?>style="display:inline-block;"<?php } ?>>
        <label for="edit-menu-item-image_repeat-<?php echo esc_attr( $item->ID ); ?>">
        	<?php _e( 'Background Repeat', "saha" ); ?><br />
			<select id="edit-menu-item-image_repeat<?php echo esc_attr( $item->ID ); ?>" class="widefat edit-menu-item-image_repeat" name="menu-item-image_repeat[<?php echo esc_attr( $item->ID ); ?>]">
				<option value="no-repeat" <?php selected( esc_attr( $item->image_repeat ), 'no-repeat' ); ?>><?php _e( 'No Repeat', 'saha' ); ?></option>
				<option value="repeat" <?php selected( esc_attr( $item->image_repeat ), 'repeat' ); ?>><?php _e( 'Repeat All', 'saha' ); ?></option>
				<option value="repeat-x" <?php selected( esc_attr( $item->image_repeat ), 'repeat-x' ); ?>><?php _e( 'Repeat Horizontally', 'saha' ); ?></option>
				<option value="repeat-y" <?php selected( esc_attr( $item->image_repeat ), 'repeat-y' ); ?>><?php _e( 'Repeat Vertically', 'saha' ); ?></option>
				<option value="inherit" <?php selected( esc_attr( $item->image_repeat ), 'inherit' ); ?>><?php _e( 'Inherit', 'saha' ); ?></option>
			</select>
		</label>
    </p>
    <p class="field-image_position description description-thin custom-bg-<?php echo esc_attr( $item->ID ); ?>" <?php if($image != "") { ?>style="display:inline-block;"<?php } ?>>
        <label for="edit-menu-item-image_position-<?php echo esc_attr( $item->ID ); ?>">
            <?php _e( 'Background Position', 'saha' ); ?><br />
			<select id="edit-menu-item-image_position<?php echo esc_attr( $item->ID ); ?>" class="widefat edit-menu-item-image_position" name="menu-item-image_position[<?php echo esc_attr( $item->ID ); ?>]">
				<option value="left top" <?php selected( esc_attr( $item->image_position ), 'left top' ); ?>><?php _e( 'Left Top', 'saha' ); ?></option>
				<option value="left center" <?php selected( esc_attr( $item->image_position ), 'left center' ); ?>><?php _e( 'Left Center', 'saha' ); ?></option>
				<option value="left bottom" <?php selected( esc_attr( $item->image_position ), 'left bottom' ); ?>><?php _e( 'Left Bottom', 'saha' ); ?></option>
				<option value="center top" <?php selected( esc_attr( $item->image_position ), 'center top' ); ?>><?php _e( 'Center Top', 'saha' ); ?></option>
				<option value="center center" <?php selected( esc_attr( $item->image_position ), 'center center' ); ?>><?php _e( 'Center Center', 'saha' ); ?></option>
				<option value="center bottom" <?php selected( esc_attr( $item->image_position ), 'center bottom' ); ?>><?php _e( 'Center Bottom', 'saha' ); ?></option>
				<option value="right top" <?php selected( esc_attr( $item->image_position ), 'right top' ); ?>><?php _e( 'Right Top', 'saha' ); ?></option>
				<option value="right center" <?php selected( esc_attr( $item->image_position ), 'right center' ); ?>><?php _e( 'Right Center', 'saha' ); ?></option>
				<option value="right bottom" <?php selected( esc_attr( $item->image_position ), 'right bottom' ); ?>><?php _e( 'Right Bottom', 'saha' ); ?></option>
			</select>
		</label>
    </p>
    <p class="field-custom_css description description-wide">
    	<?php $value = esc_attr( $item->custom_css ); ?>
    	<label for="edit-menu-item-custom_css-<?php echo esc_attr( $item->ID ); ?>">
    		<input type="checkbox" id="edit-menu-item-custom_css-<?php echo esc_attr( $item->ID ); ?>" class="code edit-menu-item-custom_css" name="menu-item-custom_css[<?php echo esc_attr( $item->ID ); ?>]" value="custom_css" <?php if($value != "") { ?>checked="checked"<?php } ?> />
    		<?php _e( "Add Custom CSS", 'saha' ); ?>
    	</label>
	</p>
	<p class="field-custom_styles description description-wide">
        <label for="edit-menu-item-custom_styles-<?php echo esc_attr( $item->ID ); ?>">
            <?php _e( 'Mega Menu Styles', 'saha' ); ?><br />
            <textarea id="edit-menu-item-custom_styles-<?php echo esc_attr( $item->ID ); ?>" class="widefat edit-menu-item-custom_styles" rows="3" cols="20" name="menu-item-custom_styles[<?php echo esc_attr( $item->ID ); ?>]"><?php echo esc_html( $item->custom_styles ); ?></textarea>
            <span class="description"><?php _e('This option will allow you add custom styles (width, padding-left, padding-bottom, ...) to your mega menu.', "saha"); ?></span>
        </label>
    </p>
    <p class="field-nolink description description-wide">
    	<?php $value = esc_attr( $item->nolink ); ?>
    	<label for="edit-menu-item-nolink-<?php echo esc_attr( $item->ID ); ?>">
    		<input type="checkbox" id="edit-menu-item-nolink-<?php echo esc_attr( $item->ID ); ?>" class="code edit-menu-item-nolink" name="menu-item-nolink[<?php echo esc_attr( $item->ID ); ?>]" value="nolink" <?php if($value != "") { ?>checked="checked"<?php } ?> />
    		<?php _e( "Disable link", 'saha' ); ?>
    	</label>
	</p>
	<p class="field-hide description description-wide">
		<?php $value = esc_attr( $item->hide ); ?>
		<label for="edit-menu-item-hide-<?php echo esc_attr( $item->ID ); ?>">
			<input type="checkbox" id="edit-menu-item-hide-<?php echo esc_attr( $item->ID ); ?>" class="code edit-menu-item-hide" name="menu-item-hide[<?php echo esc_attr( $item->ID ); ?>]" value="hide" <?php if($value != "") { ?>checked="checked"<?php } ?> />
			<?php _e( "Disable Column Title", 'saha' ); ?>
		</label>
	</p>
    <p class="field-sidebar description description-wide">
		<label for="edit-menu-item-sidebar-<?php echo esc_attr( $item->ID ); ?>">
			<?php _e( 'Custom widget area', 'saha' ); ?><br />
			<select id="edit-menu-item-sidebar<?php echo esc_attr( $item->ID ); ?>" class="widefat" name="menu-item-sidebar[<?php echo esc_attr( $item->ID ); ?>]">
				<option value="0"><?php _e( 'Select Widget Area', 'saha' ); ?></option>
					<?php global $wp_registered_sidebars;
					if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ):
						foreach( $wp_registered_sidebars as $sidebar ): ?>
							<option value="<?php echo esc_attr( $sidebar['id'] ); ?>" <?php selected( esc_attr( $item->sidebar ), esc_attr( $sidebar['id'] ) ); ?>><?php echo esc_attr( $sidebar['name'] ); ?></option>
						<?php endforeach; 
					endif; ?>
			</select>
		</label>
    </p>
<?php
}

/**
 * Save menu custom fields.
 *
 * @since  1.0.0
 */
function saha_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

	$check = array('megamenu','columns','megamenu_auto','megamenu_image','image_repeat','image_position','custom_css','custom_styles','nolink','hide','icon','sidebar');
			
	foreach ( $check as $key ) {
		if(!isset($_POST['menu-item-'.$key][$menu_item_db_id])) {
			$_POST['menu-item-'.$key][$menu_item_db_id] = '';
		}
		
		$value = $_POST['menu-item-'.$key][$menu_item_db_id];
		update_post_meta( $menu_item_db_id, '_menu_item_'.$key, $value );
	}

}

/**
 * Define new Walker edit.
 *
 * @since  1.0.0
 */
function saha_edit_walker( $walker, $menu_id ) {
	require_once trailingslashit( get_template_directory() ) . 'inc/menus-walker/class-walker-edit-custom.php';
	return 'Walker_Nav_Menu_Edit_Custom';
}