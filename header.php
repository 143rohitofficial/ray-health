<?php
/**
 * The header for the Ray Health theme.
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header">

    <div class="site-header__top">
        <div class="container site-header__top-inner">

            <a class="site-header__support" href="#">
                <span class="site-header__icon" aria-hidden="true">i</span>
                <span>Help &amp; Support</span>
            </a>

            <div class="site-header__utilities">

                <a href="#" class="site-header__basket">
                    <span>Basket</span>
                    <span class="site-header__basket-icon" aria-hidden="true">🛒</span>
                    <span class="site-header__basket-count">1</span>
                </a>

                <a
                    href="#"
                    aria-label="Call us"
                    class="site-header__utility-link"
                >
                    <span aria-hidden="true">☎</span>
                </a>

                <a
                    href="#"
                    aria-label="Email us"
                    class="site-header__utility-link"
                >
                    <span aria-hidden="true">✉</span>
                </a>

                <a
                    href="#"
                    aria-label="My account"
                    class="site-header__utility-link"
                >
                    <span aria-hidden="true">●</span>
                </a>

            </div>

        </div>
    </div>

    <div class="site-header__main">
        <div class="container site-header__main-inner">

            <a
                class="site-header__logo"
                href="<?php echo esc_url( home_url( '/' ) ); ?>"
                aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"
            >
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.svg' ); ?>"
                    alt="Ray Health"
                    width="250"
                    height="60"
                >
            </a>

            <button
                class="site-header__menu-toggle"
                type="button"
                aria-expanded="false"
                aria-controls="site-header-menu"
                aria-label="<?php esc_attr_e( 'Open menu', 'ray-health' ); ?>"
            >
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav
                id="site-header-menu"
                class="site-header__navigation"
                aria-label="<?php esc_attr_e( 'Primary navigation', 'ray-health' ); ?>"
            >
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </nav>

            <div class="site-header__actions">

                <form
                    class="site-header__search"
                    role="search"
                    method="get"
                    action="<?php echo esc_url( home_url( '/' ) ); ?>"
                >
                    <label
                        class="screen-reader-text"
                        for="site-search"
                    >
                        <?php esc_html_e( 'Search', 'ray-health' ); ?>
                    </label>

                    <input
                        id="site-search"
                        type="search"
                        name="s"
                        placeholder="Search..."
                    >
                </form>

                <a
                    class="site-header__button site-header__button--primary"
                    href="#"
                >
                    Get Started
                </a>

                <a
                    class="site-header__button site-header__button--login"
                    href="#"
                >
                    Login
                </a>

            </div>

        </div>
    </div>

</header>