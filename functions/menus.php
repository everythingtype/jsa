<?php

/* Menus and Sidebars */

function register_custom_menus() {

	register_nav_menu('about', __('About Primary'));
	register_nav_menu('aboutsecondary', __('About Secondary'));

	register_nav_menu('projectsresearch', __('Projects & Research Primary'));
	register_nav_menu('projectsresearchsecondary', __('Projects & Research Secondary'));

	register_nav_menu('news', __('News Primary'));
	register_nav_menu('newssecondary', __('News Secondary'));

	register_nav_menu('contact', __('Contact Primary'));
	register_nav_menu('contactsecondary', __('Contact Secondary'));

}

add_action('init', 'register_custom_menus');


function my_register_sidebars() {

	register_sidebar(
		array(
			'id' => 'topnav',
			'name' => __( 'About Primary Navigation' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		)
	);

	register_sidebar(
		array(
			'id' => 'secondarynav',
			'name' => __( 'About Secondary Navigation' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4>',
			'after_title' => '</h4>'
		)
	);

	register_widget('jsa_WP_Nav_Menu_Widget');

}

add_action( 'widgets_init', 'my_register_sidebars' );



class jsa_WP_Nav_Menu_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __('Add a custom menu to your JSA sidebar.') );
		parent::__construct( 'jsa_nav_menu', __('JSA Custom Menu'), $widget_ops );
	}

	public function widget($args, $instance) {

		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu ) return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) ) echo $args['before_title'] . $instance['title'] . $args['after_title'];


		// This Depth parameter is the thing we're adding for JSA

		if ( is_front_page () || is_singular('jsa_projects') ) :
			$depth = 1;
		elseif ( is_tax( 'jsa_project_categories' ) || is_category( 'books' ) || is_page() || is_single() ) :
			$depth = 3;
		else:
			$depth = 2;
		endif;

		$nav_menu_args = array(
			'fallback_cb' => '',
			'menu' => $nav_menu,
			'walker' =>new JSA_Walker(),
			'depth' => $depth
		);

		wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $args ) );

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		$menus = wp_get_nav_menus();

		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu:'); ?></label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;' ) ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}

class JSA_Walker extends Walker_Nav_Menu {

	function singlebranch($elements) {

		$ancestors = Array();
		$cleared = Array();

		// Current and ancestors
		foreach ( $elements as $e ) :

			$id = strval($e->ID);
			$parent = $e->menu_item_parent;

			if ( $e->current == true || $e->current_item_ancestor == true || $e->current_item_parent == true ) :
				$ancestors[] = $id;
				$cleared[] = $id;
			elseif ( $parent == '0' ) :
				$cleared[] = $id;
			endif;

		endforeach;

		// Cousins
		foreach ( $elements as $e ) :

			$id = strval($e->ID);
			$parent = $e->menu_item_parent;

			if ( in_array($id, $ancestors) ) :
				// Don't re-add ancestors alrady in list
			elseif ( in_array($parent, $ancestors) ) :
				$cleared[] = $id;
			endif;
		endforeach;

		$goodrelatives = Array();

		foreach ( $elements as $e ) :
			$id = strval($e->ID);
			if ( in_array($id, $cleared) ) :
				$goodrelatives[] = $e;
			endif;
		endforeach;

		return $goodrelatives;

	}

	function walk( $elements, $max_depth) {

		$args = array_slice(func_get_args(), 2);
		$output = '';
		
		if ($max_depth < -1) //invalid parameter
			return $output;
		
		if (empty($elements)) //nothing to walk
			return $output;
		
		$parent_field = $this->db_fields['parent'];
		
		// flat display
		if ( -1 == $max_depth ) {
			$empty_array = array();
			foreach ( $elements as $e )
				$this->display_element( $e, $empty_array, 1, 0, $args, $output );
			return $output;
		}

		// Transfer into main variable
		$elements = $this->singlebranch($elements);

		/*
		 * Need to display in hierarchical order.
		 * Separate elements into two buckets: top level and children elements.
		 * Children_elements is two dimensional array, eg.
		 * Children_elements[10][] contains all sub-elements whose parent is 10.
		 */
		$top_level_elements = array();
		$children_elements  = array();

		foreach ( $elements as $e) :
			if ( 0 == $e->$parent_field ) :
				$top_level_elements[] = $e;
			else :
				$children_elements[ $e->$parent_field ][] = $e;
			endif;
		endforeach;
		
		/*
		 * When none of the elements is top level.
		 * Assume the first one must be root of the sub elements.
		 */
		if ( empty($top_level_elements) ) :

			$first = array_slice( $elements, 0, 1 );
			$root = $first[0];

			$top_level_elements = array();
			$children_elements  = array();

			foreach ( $elements as $e) :
				if ( $root->$parent_field == $e->$parent_field ) :
					$top_level_elements[] = $e;
				else :
					$children_elements[ $e->$parent_field ][] = $e;
				endif;
			endforeach;
		endif;

		foreach ( $top_level_elements as $e ) :
			$this->display_element( $e, $children_elements, $max_depth, 0, $args, $output );
		endforeach;

		/*
		 * If we are displaying all levels, and remaining children_elements is not empty,
		 * then we got orphans, which should be displayed regardless.
		 */
		if ( ( $max_depth == 0 ) && count( $children_elements ) > 0 ) {
			$empty_array = array();
			foreach ( $children_elements as $orphans )
				foreach( $orphans as $op )
					$this->display_element( $op, $empty_array, 1, 0, $args, $output );
		 }
		
		 return $output;

	}

}
