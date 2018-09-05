<?php

/* Template Name: PageFilm */

get_header();
do_action('attach_film_meta_to_title');

$args = array(
    'post_type' => "films",
    'posts_per_page' => 3
);

$query = new WP_query($args);

?>

    <div id="primary" class="content-area col-sm-12 col-md-8 <?php echo of_get_option( 'site_layout' ); ?>">
        <main id="main" class="site-main" role="main">

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header page-header">
                        <?php the_title(); ?>
                    </header><!-- .entry-header -->

                    <div class="entry-content">

                        <?php if(of_get_option('blog_settings') == 1 || !of_get_option('blog_settings')) : ?>
                            <?php the_content( __( 'Continue reading <i class="fa fa-chevron-right"></i>', 'unite' ) ); ?>
                        <?php elseif (of_get_option('blog_settings') == 2) :?>
                            <?php the_excerpt(); ?>
                        <?php endif; ?>

                    </div><!-- .entry-content -->

                    <?php edit_post_link( __( 'Edit', 'unite' ), '<footer class="entry-meta"><i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span></footer>' ); ?>
                    <hr class="section-divider">
                </article><!-- #post-## -->


            <?php endwhile;  ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>