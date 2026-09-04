<section class="categories">
    <div class="container">

        <div class="categories__grid">

            <?php
            $category_order = array(
                'lose-weight',
                'hair-loss',
                'health-nutrition',
                'general-wellbeing',
            );

            $categories = get_terms(
                array(
                    'taxonomy'   => 'treatment_category',
                    'hide_empty' => false,
                    'slug'       => $category_order,
                )
            );

            if ( ! is_wp_error( $categories ) && $categories ) {
                usort(
                    $categories,
                    function ( $a, $b ) use ( $category_order ) {
                        return array_search( $a->slug, $category_order, true )
                            <=> array_search( $b->slug, $category_order, true );
                    }
                );

                foreach ( $categories as $category ) {

                    $category_id = $category->term_id;

                    $image_id = get_term_meta(
                        $category_id,
                        '_ray_health_category_image',
                        true
                    );

                    $button_label = get_term_meta(
                        $category_id,
                        '_ray_health_category_button',
                        true
                    );

                    $category_link = get_term_link( $category );

                    if ( is_wp_error( $category_link ) ) {
                        $category_link = '#';
                    }
                    ?>

                    <article class="category-card">

                        <span class="category-card__label">
                            <?php esc_html_e( 'TREATMENT', 'ray-health' ); ?>
                        </span>

                        <div class="category-card__content">

                            <?php if ( $category->description ) : ?>
                                <p>
                                    <?php echo esc_html( $category->description ); ?>
                                </p>
                            <?php endif; ?>

                            <h2>
                                <?php echo esc_html( $category->name ); ?>
                            </h2>

                        </div>

                        <?php if ( $image_id ) : ?>
                            <div class="category-card__image">
                                <?php
                                echo wp_get_attachment_image(
                                    $image_id,
                                    'medium',
                                    false,
                                    array(
                                        'alt'      => '',
                                        'loading'  => 'lazy',
                                        'decoding' => 'async',
                                    )
                                );
                                ?>
                            </div>
                        <?php endif; ?>

                        <a
                            class="category-card__button"
                            href="<?php echo esc_url( $category_link ); ?>"
                        >
                            <span>
                                <?php esc_html_e( 'View all', 'ray-health' ); ?>
                            </span>

                            <?php if ( $button_label ) : ?>
                                <span>
                                    <strong><?php echo esc_html( $button_label ); ?></strong>
                                </span>
                            <?php endif; ?>

                            <span
                                class="category-card__arrow"
                                aria-hidden="true"
                            >
                                →
                            </span>
                        </a>

                    </article>

                    <?php
                }
            }
            ?>

        </div>

        <a
            class="categories__next"
            href="#"
            aria-label="<?php esc_attr_e( 'View more treatments', 'ray-health' ); ?>"
        >
            <span aria-hidden="true">›</span>
        </a>

    </div>
</section>