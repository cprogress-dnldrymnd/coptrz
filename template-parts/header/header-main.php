<?php
$Theme_Options = new Theme_Options();
$SVG = new SVG();
if (is_404()) {
    $header_type = 'background-transparent';
}
else {
    $header_type = get__post_meta('header_type');
}
if (is_active_sidebar('top_bar_left') || is_active_sidebar('top_bar_right')) {
    get_template_part('template-parts/header/header', 'top-bar');
}
?>

<div
    class="header-inner <?= (is_active_sidebar('top_bar_left') || is_active_sidebar('top_bar_right')) ? 'has-top-bar' : '' ?>">
    <div class="header-main <?= $header_type ?>">

        <div class="container large-container ">
            <div class="row align-items-center justify-content-between align-items-center gy-3 row-holder">
                <div class="col col-lg-auto col-logo">
                    <div class="column-holder">
                        <div class="site-logo-holder position-relative">
                            <?php
                            echo $Theme_Options->logo;
                            echo $Theme_Options->alt_logo;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-menu d-flex align-self-stretch align-items-center justify-content-end">
                    <div class="column-holder h-lg-100">
                        <div class="d-none d-lg-block h-lg-100">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'header-menu',
                                    'container'      => false,
                                    'menu_class'     => '',
                                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                                    'items_wrap'     => '<ul id="%1$s" class="navbar-nav d-none d-lg-flex align-items-center h-100 %2$s">%3$s</ul>',
                                    'depth'          => 3,
                                    'walker'         => new bootstrap_5_wp_nav_menu_walker()
                                )
                            );
                            ?>
                        </div>
                        <div class="d-block d-lg-none mobile-menu-holder">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'mobile-menu',
                                    'container'      => false,
                                    'menu_class'     => '',
                                    'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
                                    'items_wrap'     => '<ul id="%1$s" class="navbar-nav d-flex d-lg-none align-items-center h-100 %2$s">%3$s</ul>',
                                    'depth'          => 3,
                                    'walker'         => new bootstrap_5_wp_nav_menu_walker()
                                )
                            );
                            ?>
                        </div>
                    </div>

                    <div class="d-none">
                        <button class="navbar-toggler toggler-menu" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#coptrzMenu" aria-controls="coptrzMenu">
                            <span class="navbar-toggler-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                    </div>

                </div>
                <div class="col-auto col-right">
                    <div class="column-holder d-inline-flex align-items-center">
                        <?php //dynamic_sidebar('header_right') ?>
                        <div class="header-icons">
                            <ul class="list-unstyled m-0 p-0 d-flex align-items-center">
                                <?php if (!is_search()) { ?>
                                    <li>
                                        <a href="#modalSearch" data-bs-toggle="modal" data-bs-target="#modalSearch">
                                            <?= $SVG->search ?>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a href="<?= wc_get_page_permalink('myaccount') ?>">
                                        <?= $SVG->user ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offCanvasSideCart" aria-controls="offCanvasSideCart">
                                        <?= $SVG->cart ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="button-group-box">
                            <div class="button-box button-link button-small d-none d-lg-block">
                                 <button class="px-0" 
                                    onclick="window.dispatchEvent(new CustomEvent('heyflow-modal-element:open', { detail: { modalId: '9npbleZmTQmuV3CmsLi8q' }}))">Contact us</button>
                            
                            </div>
                            <div class="button-box button-link button-small d-none d-lg-block">
                                <?= do_shortcode( '[login_link]' ) ?>
                            </div>
                            <div class="button-box button-accent button-small d-none d-lg-block">
                              <button onclick="window.dispatchEvent(new CustomEvent('heyflow-modal-element:open', { detail: { modalId: 'uXa4D8wfqygIKfamkEoOY' }}))">Enquire now</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>