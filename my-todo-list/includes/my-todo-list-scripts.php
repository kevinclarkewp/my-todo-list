<?php
	// Check if admin
	if(is_admin()){
		// Add Scripts
		function mtl_add_admin_scripts(){
			wp_enqueue_style('mtl-admin-style', plugins_url().'/my-todo-list/css/style-admin.css');	
		}

		add_action('admin_init', 'mtl_add_admin_scripts');
	}

	// Add Scripts
	function mtl_add_scripts(){
		wp_enqueue_style('mtl-main-style', plugins_url().'/my-todo-list/css/style.css');
		wp_enqueue_script('mtl-main-scripts', plugins_url().'/my-todo-list/js/main.js');
	}

	add_action('wp_enqueue_scripts', 'mtl_add_scripts');