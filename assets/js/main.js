document.addEventListener('DOMContentLoaded', function () {
    const menuToggle = document.querySelector('.site-header__menu-toggle');
    const navigation = document.querySelector('.site-header__navigation');

    if (!menuToggle || !navigation) {
        return;
    }

    function closeMenu() {
        menuToggle.setAttribute('aria-expanded', 'false');
        menuToggle.setAttribute('aria-label', 'Open menu');
        navigation.classList.remove('is-open');
    }

    menuToggle.addEventListener('click', function () {
        const isOpen = menuToggle.getAttribute('aria-expanded') === 'true';

        menuToggle.setAttribute('aria-expanded', String(!isOpen));
        menuToggle.setAttribute(
            'aria-label',
            isOpen ? 'Open menu' : 'Close menu'
        );

        navigation.classList.toggle('is-open', !isOpen);
    });

    navigation.addEventListener('click', function (event) {
        if (event.target.closest('a')) {
            closeMenu();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
});