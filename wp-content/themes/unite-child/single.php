<?php

/* Template Name: SingleFilm */

get_header(); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header page-header">

            <?php
                if ( of_get_option( 'single_post_image', 1 ) == 1 ) :
                    the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' ));
                endif;
            ?>

            <h1 class="entry-title "><?php the_title(); ?></h1>
            <div class="entry-meta">
                <?php unite_posted_on(); ?>
            </div><!-- .entry-meta -->

        </header><!-- .entry-header -->

        <div class="entry-content">

            <?php the_content(); ?>

        </div>

        <footer class="entry-meta">
            <ul class="film-meta">

                <?php $terms = wp_get_post_terms( get_the_ID(), array( 'genre', 'country' ) ); ?>
                <?php foreach ( $terms as $term ) : ?>
                    <li> <?php echo ucfirst($term->taxonomy).": ".$term->name; ?> </li>
                <?php endforeach; ?>

                <?php

                $ticketPrice = get_post_meta( get_the_ID(), 'wpcf-ticket-price', true);
                echo "<li>Ticket Price: $ticketPrice";

                $releaseDate = get_post_meta( get_the_ID(), 'wpcf-release-date', true);
                echo "<li>Release Date: ". date("Y-m-d", $releaseDate);;

                ?>

            </ul>

            <?php edit_post_link( __( 'Edit', 'unite' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>

            <hr class="section-divider">
        </footer><!-- .entry-meta -->
    </article><!-- #post-## -->

<?php endwhile; endif; ?>
<?php get_footer(); ?>