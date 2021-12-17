<?php

/**
 * Template Name: Register Page
 */

get_header() ?>
<!-- Page Content -->
<div class="container-large container">
    <div class="register">
        <div class="heading-page mg-bt-3">
            <h1 class="mg-bt-1"><?php the_title() ?></h1>
        </div>
        <?php if (is_user_logged_in()) {
            $user_id = get_current_user_id();
            $current_user = wp_get_current_user();
            $profile_url = get_author_posts_url($user_id);
            $edit_profile_url = get_edit_profile_url($user_id); ?>
            <div class="da-dang-nhap">
                Bạn đã đăng nhập với tài khoản <a href="<?php echo $profile_url ?>"><?php echo $current_user->display_name; ?></a> Hãy truy cập <a href="/wp-admin">Quản trị viên</a> hoặc <a href="<?php echo esc_url(wp_logout_url($current_url)); ?>">Đăng xuất tài khoản</a>
            </div>
        <?php } else { ?>

            <?php
                $err = '';
                $success = '';

                global $wpdb, $PasswordHash, $current_user, $user_ID;

                if (isset($_POST['task']) && $_POST['task'] == 'register') {


                    $pwd1 = $wpdb->escape(trim($_POST['pwd1']));
                    $pwd2 = $wpdb->escape(trim($_POST['pwd2']));
                    $first_name = $wpdb->escape(trim($_POST['first_name']));
                    $last_name = $wpdb->escape(trim($_POST['last_name']));
                    $email = $wpdb->escape(trim($_POST['email']));
                    $username = $wpdb->escape(trim($_POST['username']));

                    if ($email == "" || $pwd1 == "" || $pwd2 == "" || $username == "" || $first_name == "" || $last_name == "") {
                        $err = 'Vui lòng không bỏ trống các thông tin!';
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $err = 'Địa chỉ email không hợp lệ!';
                    } else if (email_exists($email)) {
                        $err = 'Email đã tồn tại!';
                    } else {

                        $user_id = wp_insert_user(array(
                            'first_name' => apply_filters('pre_user_first_name', $first_name),
                            'last_name' => apply_filters('pre_user_last_name', $last_name),
                            'user_pass' => apply_filters('pre_user_user_pass', $pwd1),
                            'user_login' => apply_filters('pre_user_user_login', $username),
                            'user_email' => apply_filters('pre_user_user_email', $email),
                            'role' => 'subscriber'
                        ));
                        if (is_wp_error($user_id)) {
                            $err = 'Lỗi đăng ký tài khoản';
                        } else {
                            do_action('user_register', $user_id);
                            $success = 'Bạn đã đăng ký thành công!';
                        }
                    }
                }
                ?>
            <!--display error/success message-->
            <div id="message">
                <?php
                    if (!empty($err)) :
                        echo '<p class="error">' . $err . '';
                    endif;
                    ?>

                <?php
                    if (!empty($success)) :
                        echo '<p class="error">' . $success . '';
                    endif;
                    ?>
            </div>
            <form method="post">

                <p><label>Họ của bạn</label></p>
                <p><input type="text" value="" name="last_name" id="last_name" /></p>
                <p><label>Tên của bạn</label></p>
                <p><input type="text" value="" name="first_name" id="first_name" /></p>
                <p><label>Email của bạn</label></p>
                <p><input type="text" value="" name="email" id="email" /></p>
                <p><label>Tài khoản</label></p>
                <p><input type="text" value="" name="username" id="username" /></p>
                <p><label>Mật khẩu</label></p>
                <p><input type="password" value="" name="pwd1" id="pwd1" /></p>
                <p><label>Nhập lại mật khẩu</label></p>
                <p><input type="password" value="" name="pwd2" id="pwd2" /></p>
                <div class="message">
                    <p><?php if ($sucess != "") {
                                echo $sucess;
                            } ?> <?php if ($err != "") {
                                            echo $err;
                                        } ?></p>
                </div>
                <div class="btn-register">
                    <button type="submit" name="btnregister" id="nut-dk" class="button eff-primary">Đăng ký</button>
                </div>
                <input type="hidden" name="task" value="register" />
            </form>
        <?php } ?>
    </div>
</div>
<!-- /.container -->
<?php get_footer() ?>