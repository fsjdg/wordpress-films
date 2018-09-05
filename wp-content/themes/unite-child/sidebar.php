<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package unite
 */
?>
<div id="secondary" class="widget-area col-sm-12 col-md-4" role="complementary">

        <aside id="search" class="widget widget_search">
            <?php get_search_form(); ?>
        </aside>

        <aside id="films" class="widget">
            <h1 class="widget-title">Films</h1>
            <ul>

                <?php $query = new WP_Query( 'posts_per_page=5&post_type=films' ); ?>
                <?php while ($query -> have_posts()) : $query -> the_post(); ?>

                    <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </ul>
        </aside>

</div><!-- #secondary -->
