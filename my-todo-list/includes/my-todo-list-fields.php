<?php
	function mtl_add_fields_metabox(){
		add_meta_box(
			'mtl_todo_fields',
			__('Todo Fields'),
			'mtl_todo_fields_callback',
			'todo',
			'normal',
			'default'
		);
	}

	add_action('add_meta_boxes', 'mtl_add_fields_metabox');

	// Display Fields Metabox Content
	function mtl_todo_fields_callback($post){
		wp_nonce_field(basename(__FILE__), 'wp_todos_nonce');
		$mtl_todo_stored_meta = get_post_meta($post->ID);
		?>
			<div class="wrap todo-form">
				<div class="form-group">
					<label for="priority"><?php esc_html_e('Priority', 'mtl_domain'); ?></label>
					<select name="priority" id="priority">
						<?php
							$option_values = array('Low', 'Normal', 'High');
							foreach($option_values as $key => $value){
								if($value == $mtl_todo_stored_meta['priority'][0]){
									?>
										<option selected><?php echo $value; ?></option>
									<?php
								} else {
									?>
										<option><?php echo $value; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>

				<div class="form-group">
					<label for="details"><?php esc_html_e('Details', 'mtl_domain'); ?></label>
					<?php
						$content = get_post_meta($post->ID, 'details', true);
						$editor = 'details';
						$settings = array(
							'textarea_rows' => 5,
							'media_buttons' => true
						);

						wp_editor($content, $editor, $settings);
					?>
				</div>

				<div class="form-group">
					<label for="due_date"><?php esc_html_e('Due Date', 'mtl_domain'); ?></label>
					<input type="date" name="due_date" id="due_date" value="<?php if(!empty($mtl_todo_stored_meta['due_date'])) echo esc_attr($mtl_todo_stored_meta['due_date'][0]); ?>"> 
				</div>
			</div>
		<?php
	}

	function mtl_todos_save($post_id){
		$is_autosave = wp_is_post_autosave($post_id);
		$is_revision = wp_is_post_revision($post_id);
		$is_valid_nonce = (isset($_POST['wp_todos_nonce']) && wp_verify_nonce($_POST['wp_todos_nonce'], basename(__FILE__)))? 'true' : 'false';
	
		if($is_autosave || $is_revision || !$is_valid_nonce){
			return;
		}

		if(isset($_POST['priority'])){
			update_post_meta($post_id, 'priority', sanitize_text_field($_POST['priority']));
		}

		if(isset($_POST['details'])){
			update_post_meta($post_id, 'details', sanitize_text_field($_POST['details']));
		}

		if(isset($_POST['due_date'])){
			update_post_meta($post_id, 'due_date', sanitize_text_field($_POST['due_date']));
		}
	}

	add_action('save_post', 'mtl_todos_save');
