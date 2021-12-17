<?php

/**
 * Template Name: Login Page
 */

get_header() ?>
<!-- Page Content -->
<div class="container-large container">
  <div class="login">
    <div class="heading-page mg-bt-3">
      <h1 class="mg-bt-1"><?php the_title() ?></h1>
    </div>
    <?php
    $args_login = array(
      'redirect' => site_url($_SERVER['REQUEST_URI']),
      'form_id' => 'dangnhap', //Để dành viết CSS
      'label_username' => __('Tên tài khoản'),
      'label_password' => __('Mật khẩu'),
      'label_remember' => __('Ghi nhớ'),
      'label_log_in' => __('Đăng nhập'),
    );
    wp_login_form($args_login); ?>
    <?php
    $login  = (isset($_GET['login'])) ? $_GET['login'] : 0;
    if ($login === "failed") {
      echo '<p><strong>ERROR:</strong> Sai username hoặc mật khẩu.</p>';
    } elseif ($login === "empty") {
      echo '<p><strong>ERROR:</strong> Username và mật khẩu không thể bỏ trống.</p>';
    } elseif ($login === "false") {
      echo '<p><strong>ERROR:</strong> Bạn đã thoát ra.</p>';
    }
    ?>
  </div>
</div>
<!-- /.container -->
<?php get_footer() ?>