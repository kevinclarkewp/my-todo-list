<?php
	
	// Create Custom Post Type
	function mtl_register_todo(){
		$singular_name = apply_filters('mtl_label_single', 'Todo');
		$plural_name = apply_filters('mtl_label_plural', 'Todos');

		$labels = array(
			'name' 				=> $plural_name,
			'singular_name' 	=> $singular_name,
			'add_new'           => 'Add New',
			'add_new_item'      => 'Add New '. $singular_name,
			'edit'				=> 'Edit',
			'edit_item'			=> 'Edit '. $singular_name,
			'new_item'			=> 'New ' .$singular_name,
			'view'				=> 'View',
			'view_item'			=> 'View '. $singular_name,
			'search_items'		=> 'Search '. $plural_name,
			'not_found'			=> 'No '.$plural_name. ' Found',
			'not_found_in_trash'=> 'No '.$plural_name. ' Found',
			'menu_name'			=> $plural_name
		);

		$args = apply_filters('mtl_todo_args', array(
			'labels'        	=> $labels,
			'description'   	=> 'Todos by category',
			'taxonomies'    	=> array('category'),
			'public'			=> true,
			'show_in_menu'		=> true,
			'menu_position'		=> 5,
			'menu_icon'			=> 'dashicons-edit',
			'show_in_nav_menus'	=> true,
			'query_var'			=> true,
			'can_export'		=> true,
			'rewrite'			=> array('slug' => 'todo'),
			'capability_type'	=> 'post',
			'supports'			=> array(
				'title'
			)
		));

		// Register Post Type
		register_post_type('todo', $args);
	}

	add_action('init', 'mtl_register_todo');