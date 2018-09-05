<?php

// Import parent styles
add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', 0);

function enqueue_child_theme_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// Adding new post type
add_action( 'init', 'create_posttype', 0 );

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

add_action( 'init', 'create_films_taxonomies', 0 );

// create taxonomies for the post type films
function create_films_taxonomies() {

    $labels = array(
        'name'                  => _x( 'Genres', 'taxonomy general name', 'textdomain' ),
        'singular_name'         => _x( 'Genre', 'taxonomy singular name', 'textdomain' ),
        'search_items'          => __( 'Search Genres', 'textdomain' ),
        'popular_items'         => __( 'Popular Genres', 'textdomain' ),
        'all_items'             => __( 'All Genres', 'textdomain' ),
        'edit_item'             => __( 'Edit Genre', 'textdomain' ),
        'update_item'           => __( 'Update Genre', 'textdomain' ),
        'add_new_item'          => __( 'Add New Genre', 'textdomain' ),
        'new_item_name'         => __( 'New Genre Name', 'textdomain' ),
        'menu_name'             => __( 'Genre', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => false,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'genre' ),
    );

    register_taxonomy( 'genre', array( 'films' ), $args );


    $labels = array(
        'name'                       => _x( 'Countries', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Country', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Countries', 'textdomain' ),
        'popular_items'              => __( 'Popular Countries', 'textdomain' ),
        'all_items'                  => __( 'All Countries', 'textdomain' ),
        'edit_item'                  => __( 'Edit Country', 'textdomain' ),
        'update_item'                => __( 'Update Country', 'textdomain' ),
        'add_new_item'               => __( 'Add New Country', 'textdomain' ),
        'new_item_name'              => __( 'New Country Name', 'textdomain' ),
        'menu_name'                  => __( 'Countries', 'textdomain' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'country' ),
    );

    register_taxonomy( 'country', 'films', $args );

    $labels = array(
        'name'                       => _x( 'Years', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Year', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Years', 'textdomain' ),
        'popular_items'              => __( 'Popular Years', 'textdomain' ),
        'all_items'                  => __( 'All Years', 'textdomain' ),
        'edit_item'                  => __( 'Edit Year', 'textdomain' ),
        'update_item'                => __( 'Update Year', 'textdomain' ),
        'add_new_item'               => __( 'Add New Year', 'textdomain' ),
        'new_item_name'              => __( 'New Year Name', 'textdomain' ),
        'menu_name'                  => __( 'Years', 'textdomain' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'year' ),
    );

    register_taxonomy( 'year', 'films', $args );

    $labels = array(
        'name'                       => _x( 'Actors', 'taxonomy general name', 'textdomain' ),
        'singular_name'              => _x( 'Actor', 'taxonomy singular name', 'textdomain' ),
        'search_items'               => __( 'Search Actors', 'textdomain' ),
        'popular_items'              => __( 'Popular Actors', 'textdomain' ),
        'all_items'                  => __( 'All Actors', 'textdomain' ),
        'edit_item'                  => __( 'Edit Actor', 'textdomain' ),
        'update_item'                => __( 'Update Actor', 'textdomain' ),
        'add_new_item'               => __( 'Add New Actor', 'textdomain' ),
        'new_item_name'              => __( 'New Actor Name', 'textdomain' ),
        'menu_name'                  => __( 'Actors', 'textdomain' ),
    );

    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'actor' ),
    );

    register_taxonomy( 'actor', 'films', $args );
}

// Hook for Film meta
add_action( 'attach_film_meta_to_title', 'attach_film_meta_to_title' );

function attach_film_meta_to_title() {

    add_filter('the_post', 'attach_film_meta');

}

function attach_film_meta($post) {

    $meta = array();

    $terms = wp_get_post_terms( $post->ID, array( 'genre', 'country' ) );

    foreach ( $terms as $term ){
        $meta[] = ucfirst($term->taxonomy).": ".$term->name;
    }

    $ticketPrice = get_post_meta( $post->ID, 'wpcf-ticket-price', true);
    $meta[] = "Ticket Price: $ticketPrice";

    $releaseDate = get_post_meta( $post->ID, 'wpcf-release-date', true);
    $meta[] = "Release Date: ". date("Y-m-d", $releaseDate);

    $metaString = join(", ", $meta);

    $post->post_title = "<h1 class='entry-title'>{$post->post_title}</h1><small>$metaString</small>";

}