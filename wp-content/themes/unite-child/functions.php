<?php

// Import parent styles
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// Adding new post type
function create_posttype() {
    register_post_type( 'films',
        array(
            'labels' => array(
                'name' => __( 'Films' ),
                'singular_name' => __( 'Film' )
            ),
            'public' => true,
            'rewrite' => array('slug' => 'films'),
        )
    );
}

add_action( 'init', 'create_posttype' );