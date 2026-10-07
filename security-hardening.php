<?php
/*
Plugin Name: Security Hardening
Description: Custom WordPress security improvements
Version: 1.0
Author: Ahmet Hekim
Author URI: https://hkmsmart.com
License: GPL2
*/
if (!defined('ABSPATH')) {
    exit;
}
define('SH_VERSION', '1.0');

// LOGIN ACTION ENGELLEME
add_action('login_init', function () {
    $blocked_actions = [
        'confirm_admin_email',
        'postpass',
        'lostpassword',
        'retrievepassword',
        'resetpass',
        'rp',
        'register',
        'checkemail'
    ];

    if (isset($_GET['action']) && in_array($_GET['action'], $blocked_actions)) {
        wp_safe_redirect(home_url());
        exit;
    }
});

// LOGIN LINKLERİNİ GİZLE
add_action('login_enqueue_scripts', function () {
    echo '<style>
        .login #nav a[href*="lostpassword"],
        .login #nav a[href*="register"] {
            display:none !important;
        }
    </style>';
});

// XML-RPC KAPAT
add_filter('xmlrpc_enabled', '__return_false');

// REST API KISITLA (login olmayanlara kapalı)
add_filter('rest_authentication_errors', function($result) {

    // Zaten hata varsa dokunma
    if (!empty($result)) {
        return $result;
    }

    // İstek URL'ini al
    $route = $_SERVER['REQUEST_URI'];

    // Contact Form 7 endpoint'ine izin ver
    if (strpos($route, '/wp-json/contact-form-7/') !== false) {
        return $result;
    }

    // Diğer tüm REST API isteklerini engelle
    return new WP_Error(
        'rest_disabled',
        'REST API kapalı',
        ['status' => 403]
    );
});

// WP-ADMIN KORUMA
add_action('init', function() {
    if (is_admin() && !is_user_logged_in() && !defined('DOING_AJAX')) {
        wp_safe_redirect(home_url());
        exit;
    }
});

// BASİT BRUTE FORCE KORUMA (5 deneme)
add_action('wp_login_failed', function () {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts = (int) get_transient('login_attempts_' . $ip);
    set_transient('login_attempts_' . $ip, $attempts + 1, 300);
});

add_filter('authenticate', function($user) {
    $ip = $_SERVER['REMOTE_ADDR'];
    $attempts = (int) get_transient('login_attempts_' . $ip);

    if ($attempts >= 5) {
        return new WP_Error('too_many_attempts', 'Çok fazla deneme. 5 dakika sonra tekrar dene.');
    }

    return $user;
}, 30, 1);

// VERSION GİZLE
remove_action('wp_head', 'wp_generator');