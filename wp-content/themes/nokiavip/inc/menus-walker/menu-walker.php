<?php
/**
 * Custom wp_nav_menu walker.
 *
 * @package    Saha
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Saha_Custom_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        $style = '';
        if( $depth === 0 && $this->megamenu !== "" ) {
            $style .= !empty($this->megamenu_image) ? ('background-image:url('.$this->megamenu_image.');') : '';
            $style .= !empty($this->megamenu_image) && !empty($this->image_repeat) ? ('background-repeat:'.$this->image_repeat.';') : '';
            $style .= !empty($this->megamenu_image) && !empty($this->image_position) ? ('background-position:'.$this->image_position.';') : '';
            $style .= !empty($this->custom_css) && !empty($this->custom_styles) ? $this->custom_styles : '';
        }

        if( $depth === 0 && $this->megamenu != "" ) {
        	$output .= "\n$indent<ul class=\"megamenu columns-". $this->columns ." sub-menu\" style=\"$style\">\n";
         } else {
         	$output .= "\n$indent<ul class=\"sub-menu\">\n";
         }
    }

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Modified the menu output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Set some vars
		if( $depth === 0 ) {
			$this->megamenu 		= get_post_meta( $item->ID, '_menu_item_megamenu', true );
			$this->columns 			= get_post_meta( $item->ID, '_menu_item_columns', true );
			$this->megamenu_auto 	= get_post_meta( $item->ID, '_menu_item_megamenu_auto', true );
			$this->num_of_columns 	= $this->total_num_of_columns = 0;
			$this->megamenu_image 	= get_post_meta( $item->ID, '_menu_item_megamenu_image', true );
			$this->image_repeat 	= get_post_meta( $item->ID, '_menu_item_image_repeat', true );
			$this->image_position 	= get_post_meta( $item->ID, '_menu_item_image_position', true );
			$this->custom_css 		= get_post_meta( $item->ID, '_menu_item_custom_css', true );
			$this->custom_styles 	= get_post_meta( $item->ID, '_menu_item_custom_styles', true );
		}
		
		$this->sidebar = get_post_meta( $item->ID, '_menu_item_sidebar', true );

		// Set up empty variable.
		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Mega menu
	    if( $depth === 0 && $args->has_children ) {
	    	$classes[] = 'menu-parent-item';
			if( $this->megamenu != '' && $this->megamenu_auto == '' ){
				$classes[] = 'megamenu-menu';
			} else if( $this->megamenu != '' && $this->megamenu_auto != '' ){
				$classes[] = 'mega-auto-width';
			}
		}

		// Widget menu
		if( $this->sidebar ){
			$classes[] = 'widget-menu';
		}
		
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// <li> output.
		$output .= $indent . '<li ' . $id . $class_names .'>';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// Icon.
		$icon = '';
	    if($item->icon != ''){
	    	$icon = '<i class="'.$item->icon.'"></i>';
	    }

	    // Description
	    $description = '';
	    if($item->description != ''){
	    	$description = '<span class="nav-content">'.$item->description.'</span>';
	    }

	    // Output
	    $item_output = $args->before;

	    if($item->hide == ''){

			if($item->nolink != '') {
				$item_output .= '<a'. $attributes .' onclick="JavaScript: return false;">';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}

			$item_output .= $args->link_before . $icon . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

	    	if($depth !== 0) {
		    	$item_output .= $description;
		    }

			$item_output .= '</a>';

		}

		if( $this->sidebar && $this->megamenu != '' ){
			ob_start();
			dynamic_sidebar($this->sidebar);
			$sidebar_content = ob_get_contents();
			ob_end_clean();
			$item_output .= $sidebar_content;
		}

	    $item_output .= $args->after;

		// Build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	/**
	 * Icon if sub menu.
	 */
	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) )
		   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

		if( !empty( $children_elements[$element->$id_field] ) && $depth !== 0 ) {
			$element->classes[] = 'dropdown';
			$element->title .= '<span class="nav-arrow plus"></span>';
		}
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}

// Mobile nav
class Saha_Mobile_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);

        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * Modified the menu output.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		// Set up empty variable.
		$class_names = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		if ( $depth >=0 && $args->has_children ) {
	    	$classes[] = 'has-sub';
	    }
		
		/**
		 * Filter the CSS class(es) applied to a menu item's <li>.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's <li>.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's <li>.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of wp_nav_menu() arguments.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		// <li> output.
		$output .= $indent . '<li ' . $id . $class_names .'>';

		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// Icon.
		$icon = '';
	    if($item->icon != ""){
	    	$icon = '<i class="'.$item->icon.'"></i>';
	    }

	    // Description
	    $description = '';
	    if($item->description != ""){
	    	$description = '<span class="nav-content">'.$item->description.'</span>';
	    }

	    // Output
	    $item_output = $args->before;

	    if($item->hide == ''){
	    	if($item->nolink != "") {
				$item_output .= '<a'. $attributes .' onclick="JavaScript: return false;">';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}

			$item_output .= $args->link_before . $icon . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

	    	if($depth !== 0) {
		    	$item_output .= $description;
		    }

			$item_output .= '</a>';
		}

		if ( $args->has_children ) {
	    	$item_output .= '<span class="mobile-icon disable" ></span>';
	    }

	    $item_output .= $args->after;

		// Build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	/**
	 * Icon if sub menu.
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

}