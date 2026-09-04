<?php
/**
 * Ray Health theme functions.
 */

function ray_health_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );

    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'ray-health' ),
        )
    );
}
add_action( 'after_setup_theme', 'ray_health_setup' );


function ray_health_assets() {
    wp_enqueue_style(
        'ray-health-font',
        'https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'ray-health-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array( 'ray-health-font' ),
        '1.0.0'
    );

    wp_enqueue_script(
        'ray-health-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'ray_health_assets' );


function ray_health_register_treatment_post_type() {
    register_post_type(
        'treatment',
        array(
            'labels' => array(
                'name'          => __( 'Treatments', 'ray-health' ),
                'singular_name' => __( 'Treatment', 'ray-health' ),
                'add_new_item'  => __( 'Add New Treatment', 'ray-health' ),
                'edit_item'     => __( 'Edit Treatment', 'ray-health' ),
                'all_items'     => __( 'All Treatments', 'ray-health' ),
            ),
            'public'       => true,
            'menu_icon'    => 'dashicons-heart',
            'supports'     => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
            ),
            'has_archive'  => true,
            'rewrite'      => array(
                'slug' => 'treatments',
            ),
            'show_in_rest' => true,
        )
    );
}
add_action( 'init', 'ray_health_register_treatment_post_type' );


function ray_health_register_treatment_category_taxonomy() {
    register_taxonomy(
        'treatment_category',
        'treatment',
        array(
            'labels' => array(
                'name'          => __( 'Treatment Categories', 'ray-health' ),
                'singular_name' => __( 'Treatment Category', 'ray-health' ),
                'search_items'  => __( 'Search Treatment Categories', 'ray-health' ),
                'all_items'     => __( 'All Treatment Categories', 'ray-health' ),
                'edit_item'     => __( 'Edit Treatment Category', 'ray-health' ),
                'update_item'   => __( 'Update Treatment Category', 'ray-health' ),
                'add_new_item'  => __( 'Add New Treatment Category', 'ray-health' ),
                'new_item_name' => __( 'New Treatment Category Name', 'ray-health' ),
                'menu_name'     => __( 'Categories', 'ray-health' ),
            ),
            'public'            => true,
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => array(
                'slug' => 'treatment-category',
            ),
        )
    );
}
add_action( 'init', 'ray_health_register_treatment_category_taxonomy' );


function ray_health_category_fields( $term = null ) {
    $image_id     = $term ? get_term_meta( $term->term_id, '_ray_health_category_image', true ) : '';
    $button_label = $term ? get_term_meta( $term->term_id, '_ray_health_category_button', true ) : '';

    if ( $term ) {
        wp_nonce_field(
            'ray_health_save_category_' . $term->term_id,
            'ray_health_category_nonce'
        );
    } else {
        wp_nonce_field(
            'ray_health_save_category',
            'ray_health_category_nonce'
        );
    }
    ?>

    <div class="form-field">
        <label for="ray-health-category-button">
            <?php esc_html_e( 'Card Button Label', 'ray-health' ); ?>
        </label>

        <input
            type="text"
            id="ray-health-category-button"
            name="ray_health_category_button"
            value="<?php echo esc_attr( $button_label ); ?>"
            placeholder="e.g. Weight Loss"
        >

        <p class="description">
            <?php esc_html_e( 'Text displayed after "View all" on the category card.', 'ray-health' ); ?>
        </p>
    </div>

    <div class="form-field">
        <label for="ray-health-category-image">
            <?php esc_html_e( 'Card Image', 'ray-health' ); ?>
        </label>

        <input
            type="hidden"
            id="ray-health-category-image"
            name="ray_health_category_image"
            value="<?php echo esc_attr( $image_id ); ?>"
        >

        <button
            type="button"
            class="button ray-health-upload-image"
        >
            <?php esc_html_e( 'Select Image', 'ray-health' ); ?>
        </button>

        <div class="ray-health-image-preview">
            <?php
            if ( $image_id ) {
                echo wp_get_attachment_image(
                    $image_id,
                    'thumbnail'
                );
            }
            ?>
        </div>
    </div>

    <?php
}

add_action(
    'treatment_category_add_form_fields',
    'ray_health_category_fields'
);


function ray_health_edit_category_fields( $term ) {
    ray_health_category_fields( $term );
}

add_action(
    'treatment_category_edit_form_fields',
    'ray_health_edit_category_fields'
);


function ray_health_save_category_fields( $term_id ) {
    if ( ! current_user_can( 'manage_categories' ) ) {
        return;
    }

    if ( ! isset( $_POST['ray_health_category_nonce'] ) ) {
        return;
    }

    $nonce = sanitize_text_field(
        wp_unslash( $_POST['ray_health_category_nonce'] )
    );

    $action = 'ray_health_save_category';

    if ( isset( $_POST['tag_ID'] ) ) {
        $action = 'ray_health_save_category_' . absint( $_POST['tag_ID'] );
    }

    if ( ! wp_verify_nonce( $nonce, $action ) ) {
        return;
    }

    if ( isset( $_POST['ray_health_category_button'] ) ) {
        update_term_meta(
            $term_id,
            '_ray_health_category_button',
            sanitize_text_field(
                wp_unslash( $_POST['ray_health_category_button'] )
            )
        );
    }

    if ( isset( $_POST['ray_health_category_image'] ) ) {
        update_term_meta(
            $term_id,
            '_ray_health_category_image',
            absint( $_POST['ray_health_category_image'] )
        );
    }
}

add_action(
    'created_treatment_category',
    'ray_health_save_category_fields'
);

add_action(
    'edited_treatment_category',
    'ray_health_save_category_fields'
);


function ray_health_category_media_scripts( $hook ) {
    if ( 'edit-tags.php' !== $hook && 'term.php' !== $hook ) {
        return;
    }

    if (
        ! isset( $_GET['taxonomy'] ) ||
        'treatment_category' !== $_GET['taxonomy']
    ) {
        return;
    }

    wp_enqueue_media();

    wp_add_inline_script(
        'media-editor',
        "
        jQuery(function($) {
            $('.ray-health-upload-image').on('click', function(e) {
                e.preventDefault();

                const button = $(this);
                const input = $('#ray-health-category-image');
                const preview = $('.ray-health-image-preview');

                const frame = wp.media({
                    title: 'Select Treatment Image',
                    button: {
                        text: 'Use this image'
                    },
                    multiple: false
                });

                frame.on('select', function() {
                    const attachment = frame.state().get('selection').first().toJSON();

                    input.val(attachment.id);

                    preview.html(
                        '<img src=\"' + attachment.url + '\" style=\"max-width:150px;height:auto;margin-top:10px;\">'
                    );
                });

                frame.open();
            });
        });
        "
    );
}

add_action(
    'admin_enqueue_scripts',
    'ray_health_category_media_scripts'
);