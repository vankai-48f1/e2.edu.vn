<?php
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
require_once get_template_directory() . '/widgets/mini_blog_widget_latest_post.php';

// Thêm widget Bài viết mới nhất
function m_load_widget_latest_post()
{
	register_widget('mini_blog_latest_post'); // gọi ID widget
}
add_action('widgets_init', 'm_load_widget_latest_post');


// Thêm ảnh đại diện
add_theme_support('post-thumbnails');

// Ảnh này sẽ hiện ở ngoài blog
add_image_size('blog-thumbnail', 700, 350, true);

// Ảnh này sẽ hiện ở trong post
add_image_size('post-large', 900, 600, true);

add_image_size('post-small', 250, 200, true);


// Khai báo menu
function register_my_menu()
{
	register_nav_menus(
		array(
			'header-menu' => __('Header Menu'),
			'footer-menu' => __('Footer Menu'),
			'popular-menu' => __('Popular Post Menu'),
			// 'topMenu' => __('Submenu Menu'),
		)
	);
}
add_action('init', 'register_my_menu');

// Khai báo sidebar
function m_widgets_init()
{

	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name'			=> __('Sidebar', 'sidebar'),
			'id' 			=> 'sidebar',
			'before_title'  => '<h5 class="sidebar-header">',
			'after_title'   => '</h5>',
		));

		register_sidebar(array(
			'name'			=> __('Sign up', 'signup'),
			'id' 			=> 'signup',
			'description' 	=> __('Sign up for our newsletter'),
		));


		register_sidebar(array(
			'name'			=> __('Banner sidebar', 'banner-sidebar'),
			'id' 			=> 'banner-sidebar',
			'description' 	=> __('Banner sidebar'),
			'before_widget' => '<div class="banner-sidebar">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="banner-sidebar-title">',
			'after_title'   => '</h5>',
		));

	}
}
add_action('widgets_init', 'm_widgets_init');




// Tạo Paginate
function m_pagination()
{
	global $wp_query;

	$pages = paginate_links(array(
		'format' 		=> '?paged=%#%',
		'current' 		=> max(1, get_query_var('paged')),
		'total' 		=> $wp_query->max_num_pages,
		'type'  		=> 'array',
		'prev_next'   	=> true,
		'prev_text'    	=> __('« Trước'),
		'next_text'    	=> __('Sau »'),
	));

	if (is_array($pages)) {
		$paged = (get_query_var('paged') == 0) ? 1 : get_query_var('paged');
		$pagination = '<ul class="pagination justify-content-center mb-4">';
		foreach ($pages as $page) {
			$pagination .= "<li class='page-item'>$page</li>";
		}
		$pagination .= '</ul>';

		echo $pagination;
	}
}

// Tạo Breadcrumbs
function m_breadcrumbs()
{
	if (!is_home()) {
		echo '<nav class="breadcrumb">';
		echo '<div class="container">';

		echo '<a class="breadcrumb-item" href="' . home_url('/') . '">Trang chủ</a>';
		if (is_category() || is_single()) {

			$categories = wp_get_post_terms(get_the_id(), 'category');

			if ($categories) :
				foreach ($categories as $category) : ?>
					<a href="<?php echo get_term_link($category->term_id, 'category'); ?>" class="breadcrumb-item"><?php echo $category->name; ?></a>
	<?php endforeach;
				endif;

				if (is_single()) {
					the_title('<span class="breadcrumb-item active">', '</span>');
				}
			} elseif (is_page()) {
				the_title('<span class="breadcrumb-item active">', '</span>');
			} elseif (is_tag()) {
				echo '<span class="breadcrumb-item active">Thẻ</span>';
			} elseif (is_search()) {
				echo '<span class="breadcrumb-item active">Tìm kiếm</span>';
			} elseif (is_author()) {
				echo '<span class="breadcrumb-item active">Tác giả</span>';
			} elseif (is_archive()) {
				echo '<span class="breadcrumb-item active">Lưu trữ</span>';
			} else {
				echo '<span class="breadcrumb-item active">Error 404</span>';
			}

			echo '</div>';
			echo '</nav>';
		}
	}

	function dd($code)
	{
		echo "<pre>";
		print_r($code);
		echo "</pre>";
	}

	// Tạo related posts
	function m_related_post($title = 'Bài viết liên quan', $count = 5)
	{

		global $post;
		$tag_ids = array();
		$current_cat = get_the_category($post->ID);
		$current_cat = $current_cat[0]->cat_ID;
		$this_cat = '';
		$tags = get_the_tags($post->ID);
		if ($tags) {
			foreach ($tags as $tag) {
				$tag_ids[] = $tag->term_id;
			}
		} else {
			$this_cat = $current_cat;
		}

		$args = array(
			'post_type'   => get_post_type(),
			'numberposts' => $count,
			'orderby'     => 'rand',
			'tag__in'     => $tag_ids,
			'cat'         => $this_cat,
			'exclude'     => $post->ID
		);
		$related_posts = get_posts($args);

		if (empty($related_posts)) {
			$args['tag__in'] = '';
			$args['cat'] = $current_cat;
			$related_posts = get_posts($args);
		}
		if (empty($related_posts)) {
			return;
		}
		$post_list = '';
		foreach ($related_posts as $related) {

			$post_list .= '<div class="media mb-4 ">';
			$post_list .= '<img class="mr-3 img-thumbnail" style="width: 150px" src="' . get_the_post_thumbnail_url($related->ID, 'post-small') . '" alt="Generic placeholder image">';
			$post_list .= '<div class="media-body align-self-center">';
			$post_list .= '<h5 class="mt-0"><a href="' . get_permalink($related->ID) . '">' . $related->post_title . '</a></h5>';
			$post_list .= get_the_category($related->ID)[0]->cat_name;

			$post_list .= '</div>';
			$post_list .= '</div>';
		}

		return sprintf('
			<div class="card my-4">
				<h4 class="card-header">%s</h4>
				<div class="card-body">%s</div>
			</div>
		', $title, $post_list);
	}

	// Trả nội dung bình luận
	function m_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		?>
	<?php if ($comment->comment_approved == '1') : ?>
		<li class="media mb-4">
			<?php echo '<img class="d-flex mr-3 rounded-circle" src="' . get_avatar_url($comment) . '" style="width: 60px;">' ?>
			<div class="media-body">
				<?php echo  '<h5 class="mt-0 mb-0"><a rel="nofllow" href="' . get_comment_author_url() . '">' . get_comment_author() . '</a> - <small>' . get_comment_date() . ' - ' . get_comment_time() . '</small></h5>' ?>
				<p class="mt-1">
					<?php comment_text() ?>
				</p>

				<div class="reply">
					<?php comment_reply_link(array_merge($args, array('reply_text' => 'Trả lời', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
			</div>
		</li>
<?php endif;
}


function m_logo_web($wp_customize)
{
	$wp_customize->add_section(
		'logo',
		array(
			'title' => 'Logo',
			'description' => 'logo',
			'priority' => 25
		)
	);

	$wp_customize->add_setting('Logo', array('default' => ''));
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'Logo', array(
			'label' => 'Logo',
			'section' => 'logo',
			'settings' => 'Logo'
		))
	);

	$wp_customize->add_setting('Logo-ft', array('default' => ''));
	$wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'Logo-ft', array(
			'label' => 'Logo footer',
			'section' => 'logo',
			'settings' => 'Logo-ft'
		))
	);
}
add_action('customize_register', 'm_logo_web');


function link_social($wp_customize)
{
	$wp_customize->add_section(
		'social',
		array(
			'title' => 'Social',
			'description' => 'Social',
			'priority' => 25
		)
	);

	$wp_customize->add_setting('Link_www', array('default' => ''));
	$wp_customize->add_control('control_Link_www', array(
		'label' => 'Link Global',
		'section' => 'social',
		'type' => 'text',
		'settings' => 'Link_www'
	));

	$wp_customize->add_setting('Link_fb', array('default' => ''));
	$wp_customize->add_control('control_Link_fb', array(
		'label' => 'Link Facebook',
		'section' => 'social',
		'type' => 'text',
		'settings' => 'Link_fb'
	));


	$wp_customize->add_setting('Link_yt', array('default' => ''));
	$wp_customize->add_control('control_Link_yt', array(
		'label' => 'Link Youtube',
		'section' => 'social',
		'type' => 'text',
		'settings' => 'Link_yt'
	));

	$wp_customize->add_setting('Link_ins', array('default' => ''));
	$wp_customize->add_control('control_Link_ins', array(
		'label' => 'Link Instagram',
		'section' => 'social',
		'type' => 'text',
		'settings' => 'Link_ins'
	));
}
add_action('customize_register', 'link_social');

function contact_address($wp_customize)
{
	$wp_customize->add_section(
		'contact-address',
		array(
			'title' => 'Contact & Address',
			'description' => 'Contact & Address',
			'priority' => 25
		)
	);

	$wp_customize->add_setting('Phone', array('default' => ''));
	$wp_customize->add_control('control_Phone', array(
		'label' => 'Phone',
		'section' => 'contact-address',
		'type' => 'text',
		'settings' => 'Phone'
	));

	$wp_customize->add_setting('Email', array('default' => ''));
	$wp_customize->add_control('control_Email', array(
		'label' => 'Email',
		'section' => 'contact-address',
		'type' => 'text',
		'settings' => 'Email'
	));

	$wp_customize->add_setting('Address_1', array('default' => ''));
	$wp_customize->add_control('control_Address_1', array(
		'label' => 'Address',
		'section' => 'contact-address',
		'type' => 'textarea',
		'settings' => 'Address_1'
	));


	$wp_customize->add_setting('Address_2', array('default' => ''));
	$wp_customize->add_control('control_Address_2', array(
		'label' => 'Address',
		'section' => 'contact-address',
		'type' => 'textarea',
		'settings' => 'Address_2'
	));

	$wp_customize->add_setting('Address_3', array('default' => ''));
	$wp_customize->add_control('control_Address_3', array(
		'label' => 'Address',
		'section' => 'contact-address',
		'type' => 'textarea',
		'settings' => 'Address_3'
	));

	$wp_customize->add_setting('Address_4', array('default' => ''));
	$wp_customize->add_control('control_Address_4', array(
		'label' => 'Address',
		'section' => 'contact-address',
		'type' => 'textarea',
		'settings' => 'Address_4'
	));

	$wp_customize->add_setting('Address_5', array('default' => ''));
	$wp_customize->add_control('control_Address_5', array(
		'label' => 'Address',
		'section' => 'contact-address',
		'type' => 'textarea',
		'settings' => 'Address_5'
	));
}
add_action('customize_register', 'contact_address');


/* Tự động chuyển đến một trang khác sau khi login */
function my_login_redirect($redirect_to, $request, $user)
{
	//is there a user to check?
	global $user;
	if (isset($user->roles) && is_array($user->roles)) {
		//check for admins
		if (in_array('administrator', $user->roles)) {
			// redirect them to the default place
			return admin_url();
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter('login_redirect', 'my_login_redirect', 10, 3);


/* Kiểm tra lỗi đăng nhập */
function login_failed()
{
	$login_page  = home_url('/login/');
	wp_redirect($login_page . '?login=failed');
	exit;
}
add_action('wp_login_failed', 'login_failed');

function verify_username_password($user, $username, $password)
{
	$login_page  = home_url('/login/');
	if ($username == "" || $password == "") {
		wp_redirect($login_page . "?login=empty");
		exit;
	}
}
add_filter('authenticate', 'verify_username_password', 1, 3);


// add option menu bar admin 
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
}

// add_filter( 'comment_text', 'modify_comment');
// function modify_comment( $text ){
 
// 	$plugin_url_path = WP_PLUGIN_URL;
 
// 	if( $commenttitle = get_comment_meta( get_comment_ID(), 'title', true ) ) {
// 		$commenttitle = '<strong>' . esc_attr( $commenttitle ) . '</strong><br />';
// 		$text = $commenttitle . $text;
// 	} 
 
// 	if( $commentrating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
// 		$commentrating = '<p class="comment-rating">	<img src="'. $plugin_url_path .
// 		'/ExtendComment/images/'. $commentrating . 'star.gif"/><br />Rating: <strong>'. $commentrating .' / 5</strong></p>';
// 		$text = $text . $commentrating;
// 		return $text;
// 	} else {
// 		return $text;
// 	}
// }



if ( !class_exists( 'WPSE_Walker_Comment' ) ) {

    /**
     * Custom comment walker
     *
     * @users Walker_Comment
     */
    class My_Custom_Walker_Comment extends Walker_Comment {

        public function comment( $comment, $depth, $args ) {
            if ( 'div' === $args['style'] ) {
				$tag       = 'div';
				$add_below = 'comment';
			} else {
				$tag       = 'li';
				$add_below = 'div-comment';
			}
	
			$commenter          = wp_get_current_commenter();
			$show_pending_links = isset( $commenter['comment_author'] ) && $commenter['comment_author'];
	
			if ( $commenter['comment_author_email'] ) {
				$moderation_note = __( 'Your comment is awaiting moderation.' );
			} else {
				$moderation_note = __( 'Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.' );
			}
			?>
			<<?php echo $tag; ?> <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="comment-<?php comment_ID(); ?>">
			<?php if ( 'div' !== $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<?php endif; ?>
			<div class="comment-author vcard">
				<?php
				if ( 0 != $args['avatar_size'] ) {
					echo get_avatar( $comment, $args['avatar_size'] );
				}
				?>
				<?php
				$comment_author = get_comment_author_link( $comment );
	
				if ( '0' == $comment->comment_approved && ! $show_pending_links ) {
					$comment_author = get_comment_author( $comment );
				}
	
				printf(
					/* translators: %s: Comment author link. */
					__( '%s' ),
					sprintf( '<cite class="fn">%s</cite>', $comment_author )
				);
				?>
			</div>
			<?php if ( '0' == $comment->comment_approved ) : ?>
			<em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
			<br />
			<?php endif; ?>
	
			<div class="comment-meta commentmetadata">
				<?php
				printf(
					'<a href="%s">%s</a>',
					esc_url( get_comment_link( $comment, $args ) ),
					sprintf(
						/* translators: 1: Comment date, 2: Comment time. */
						__( '%1$s at %2$s' ),
						get_comment_date( '', $comment ),
						get_comment_time()
					)
				);
	
				edit_comment_link( __( '(Edit)' ), ' &nbsp;&nbsp;', '' );
				?>
			</div>
	
			<div class="content-user-comment">
			<?php
				comment_text(
					$comment,
					array_merge(
						$args,
						array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>
			</div>

			<?php
			comment_reply_link(
				array_merge(
					$args,
					array(
						'add_below' => $add_below,
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
					)
				)
			);
			?>
	
			<?php if ( 'div' !== $args['style'] ) : ?>
			</div>
			<?php endif; ?>
			<?php
        }
    }
    
} // end of '!class_exists' condition