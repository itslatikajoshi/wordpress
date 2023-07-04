<?php


function gj_theme() {

    
    
    
    // wp_enqueue_style( 'aos-css',get_template_directory_uri().'/assets/vendor/aos/aos.css' );
    wp_enqueue_style( 'bootstrap-css',get_template_directory_uri().'/assets/vendor/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-icons-css',get_template_directory_uri().'/assets/vendor/bootstrap-icons/bootstrap-icons.css' );
    wp_enqueue_style( 'boxicons-css',get_template_directory_uri().'/assets/vendor/boxicons/css/boxicons.min.css' );
    wp_enqueue_style( 'glightbox-css',get_template_directory_uri().'/assets/vendor/glightbox/css/glightbox.min.css' );
    wp_enqueue_style( 'remixicon',get_template_directory_uri().'/assets/vendor/remixicon/remixicon.css' );
    wp_enqueue_style( 'swiper-bundle-css',get_template_directory_uri().'/assets/vendor/swiper/swiper-bundle.min.css' );
    wp_enqueue_style( 'style-name',get_template_directory_uri().'/assets/css/style.css' );
	wp_enqueue_style( 'style', get_template_directory_uri(). '/style.css' );
    
    
    wp_enqueue_script( 'script-name', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );
    wp_enqueue_script( 'purecounter_vanilla', get_template_directory_uri() . '/assets/vendor/purecounter/purecounter_vanilla.js', array(), '1.0.0', true );
    wp_enqueue_script( 'aos', get_template_directory_uri() . '/assets/vendor/aos/aos.js', array(), '1.0.0', true );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/vendor/isotope-layout/isotope.pkgd.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'swiper-bundle', get_template_directory_uri() . '/assets/vendor/swiper/swiper-bundle.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'validate', get_template_directory_uri() . '/assets/vendor/php-email-form/validate.js', array(), '1.0.0', true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

    
  }
add_action( 'wp_enqueue_scripts', 'gj_theme' );


