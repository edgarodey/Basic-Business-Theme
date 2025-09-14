<?php
/**
 * The template for displaying all pages.
 */
get_header(); ?>

<main id="main" class="site-main" role="main">
    <div class="container">
        <?php
        while ( have_posts() ) : the_post();
            the_title( '<h1>', '</h1>' );
            the_content();
        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>