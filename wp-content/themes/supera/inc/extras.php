<?php
	
	function custom_menu_order()
	{
		return array
		(
			'index.php',
			'separator1',
			'edit.php?post_type=page',
			'edit.php',
			//'edit.php?post_type=afx_example',
			'separator2',
			'upload.php',
			'theme-options',
			'edit-comments.php',
			'separator-last'
		);
	}
	add_filter('custom_menu_order', '__return_true');
	add_filter('menu_order', 'custom_menu_order');
	
	//https://codex.wordpress.org/Roles_and_Capabilities
	
	function create_client_role()
	{
		//remove_role('client');
		add_role('client', __('Client'),
			array
			(
				// Admin permissions
				'activate_plugins' => true,
				'create_users' => true,
				'delete_plugins' => true,
				'delete_users' => true,
				'edit_plugins' => true,
				'edit_theme_options' => true,
				'edit_users' => true,
				'install_plugins' => true,
				'list_users' => true,
				// Editor permissions
				'delete_others_pages' => true,
				'delete_others_posts' => true,
				'delete_pages' => true,
				'delete_posts' => true,
				'delete_private_pages' => true,
				'delete_private_posts' => true,
				'delete_published_pages' => true,
				'delete_published_posts' => true,
				'edit_others_pages' => true,
				'edit_others_posts' => true,
				'edit_pages' => true,
				'edit_posts' => true,
				'edit_private_pages' => true,
				'edit_private_posts' => true,
				'edit_published_pages' => true,
				'edit_published_posts' => true,
				'manage_categories' => true,
				'manage_links' => true,
				'moderate_comments' => true,
				'publish_pages' => true,
				'publish_posts' => true,
				'read' => true,
				'read_private_pages' => true,
				'read_private_posts' => true,
				'upload_files' => true
			)
		);
	}
	add_action('after_switch_theme', 'create_client_role');