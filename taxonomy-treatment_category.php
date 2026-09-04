<?php
/**
 * Treatment category archive.
 */

get_header();

$current_category = get_queried_object();
?>

<main id="main-content">

    <section class="treatment-archive">
        <div class="container">

            <header class="treatment-archive__header">

                <span class="treatment-archive__label">
                    TREATMENT
                </span>

                <h1>
                    <?php echo esc_html( $current_category->name ); ?>
                </h1>

                <?php if ( $current_category->description ) : ?>
                    <p>
                        <?php echo esc_html( $current_category->description ); ?>
                    </p>
                <?php endif; ?>

            </header>

            <div class="treatment-archive__content">

                <?php
                $treatments = new WP_Query(
                    array(
                        'post_type'      => 'treatment',
                        'posts_per_page' => -1,
                        'post_status'    => 'publish',
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'treatment_category',
                                'field'    => 'term_id',
                                'terms'    => $current_category->term_id,
                            ),
                        ),
                    )
                );
                ?>

                <?php if ( $treatments->have_posts() ) : ?>

                    <div class="treatment-archive__grid">

                        <?php
                        while ( $treatments->have_posts() ) :
                            $treatments->the_post();
                            ?>

                            <article class="treatment-card">

                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="treatment-card__image">
                                        <?php
                                        the_post_thumbnail(
                                            'medium',
                                            array(
                                                'loading'  => 'lazy',
                                                'decoding' => 'async',
                                                'alt'      => '',
                                            )
                                        );
                                        ?>
                                    </div>
                                <?php endif; ?>

                                <div class="treatment-card__content">

                                    <h2>
                                        <?php echo esc_html( get_the_title() ); ?>
                                    </h2>

                                    <?php if ( has_excerpt() ) : ?>
                                        <p>
                                            <?php echo esc_html( get_the_excerpt() ); ?>
                                        </p>
                                    <?php endif; ?>

                                    <a
                                        href="<?php echo esc_url( get_permalink() ); ?>"
                                        class="treatment-card__button"
                                    >
                                        View Treatment
                                        <span aria-hidden="true">→</span>
                                    </a>

                                </div>

                            </article>

                            <?php
                        endwhile;
                        ?>

                    </div>

                    <?php wp_reset_postdata(); ?>

                <?php else : ?>

                    <div class="treatment-archive__empty">

                        <h2>
                            Treatments coming soon
                        </h2>

                        <p>
                            We’re currently preparing treatments for
                            <?php echo esc_html( $current_category->name ); ?>.
                            Please check back soon.
                        </p>

                        <a
                            href="<?php echo esc_url( home_url( '/' ) ); ?>"
                            class="treatment-archive__back"
                        >
                            Back to Home
                        </a>

                    </div>

                <?php endif; ?>

            </div>

        </div>
    </section>

</main>

<?php
get_footer();