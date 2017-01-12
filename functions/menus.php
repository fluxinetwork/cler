<?php

/*
 * Main Menu
 */
function register_main_menu() {
  register_nav_menu('main-menu','Main Menu');
}
add_action( 'init', 'register_main_menu' );
/*
 * Walker menu
 */
class fluxi_walker_nav_menu extends Walker_Nav_Menu {
  
	// add classes to ul sub-menus
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 2); // because it counts the first submenu as 0
		$classes = array(
			'c-navList c-navList--subnav',
			//( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			//( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'c-navList--lvl' . $display_depth
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}
	  
	// add main/sub classes to li's and links
	function start_el( &$output, $item, $depth = 0, $args= array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
	  
		// depth dependent classes
		$depth_classes = array(
			//( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			//( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			//( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			//'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
	  
		// passed classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		/*$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );*/
		/*$class_names = '';*/

		// Add active class 
        if (in_array('current-menu-item', $classes)) {
            $class_active = ' c-navList__item--active';
        }else{
        	$class_active = '';
        }

        if (in_array('menu-item-has-children', $classes)) {
            $class_dropdown = ' has-dropdown js-open-subnav';
        }else{
        	$class_dropdown = '';
        }

		$class_names = ( $depth > 0  ? 'c-navList__item' : 'c-navList__item js-mute-main' );
		
	  
		// build html
		$output .= $indent . '<li class="' . $class_names . $class_active . '">';
	  
		// link attributes
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="c-navList__item__link ' . $class_dropdown . '"';
	  
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
	  
		// build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args= array() );
	}
	
}