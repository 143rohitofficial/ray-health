<?php
/**
 * Ray Health homepage.
 */

get_header();
?>

<main id="main-content">

    <?php get_template_part( 'template-parts/hero' ); ?>
    <?php get_template_part( 'template-parts/categories' ); ?>
    <?php get_template_part( 'template-parts/how-it-works' ); ?>

</main>

<?php
get_footer();