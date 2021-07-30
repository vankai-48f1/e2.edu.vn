<?php
$comments_arg = array(
	'fields' => apply_filters(
		'comment_form_default_fields',
		array(
			'author' => '<div class="form-group">' .
				'<label for="author">' . __('Full name') . '</label> ' .
				'<input id="author" name="author" class="form-control" type="text"  size="30" />
								</div>',

			'email' => '<div class="form-group">' .
				'<label for="email">' . __('Email') . '</label> ' .
				'<input type="email" id="email" name="email" class="form-control" type="text" size="30" />
								</div>',

			'url' 	=> '<div class="form-group">' .
				'<label for="url">' . __('URL') . '</label> ' .
				'<input type="url" id="url" name="url" class="form-control" type="text" size="30" />
								</div>'
		)
	),
	'comment_field'			=> '<div class="form-group">' .
		'<textarea id="comment" class="form-control" name="comment" rows="3" aria-required="true" placeholder="' . __('Your comment') . '"></textarea>' .
		'</div>',
	'comment_notes_after' 	=> '',
	'title_reply'			=> 'Comment',
	'title_reply_to'		=> 'Reply to \'s comment %s',
	'cancel_reply_link'		=> '( Cancel )',
	'class_submit'			=> 'btn',
	'label_submit'			=> 'Submit',
	'logged_in_as'			=> sprintf(
		'<p class="logged-in-as">%s</p>',
		sprintf(
			/* translators: 1: Edit user link, 2: Accessibility text, 3: User name, 4: Logout URL. */
			__('<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>&ensp; <a href="%4$s">Log out?</a>'),
			get_edit_user_link(),
			/* translators: %s: User name. */
			esc_attr(sprintf(__('Logged in as %s. Edit your profile.'), $user_identity)),
			$user_identity,
			/** This filter is documented in wp-includes/link-template.php */
			wp_logout_url(apply_filters('the_permalink', get_permalink($post_id), $post_id))
		)
	)
);

comment_form($comments_arg);
?>

<?php if (have_comments()) : ?>
	<div class="card mg-t-1 mg-bt-2">
		<h5 class="card-header"><?php echo 'Comment (' . get_comments_number() . ')' ?></h5>
		<ul class="card-body">
			<?php
			$args = [
				'type'    	  => 'comment',
				'walker'      => new My_Custom_Walker_Comment,
				'max_depth'   => 2
			];
			wp_list_comments($args);
			?>
		</ul>
	</div>
<?php endif; ?>