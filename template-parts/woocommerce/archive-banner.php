<?php
$DisplayData = new DisplayData;
if (is_shop()) {
    $title = get_the_title(get_option('woocommerce_shop_page_id'));
}
else if (is_tax()) {
    $term = get_queried_object();
    $title = $term->name;
    $description = $term->description;
    $image = get__term_meta($term->term_id, 'image');
}


?>


<section class="page-banner md-padding">
    <div class="container">
        <div class="row justify-content-between g-4 align-items-end">
            <div class="col-auto">
                <div class="column-holder col-text">
                    <?php if (is_tax()) { ?>
                        <?php
                        get_template_part('template-parts/woocommerce/breadcrumbs');
                        ?>
                    <?php } ?>
                    <?php
                    $DisplayData->heading(
                        array(
                            'heading' => $title
                        ),
                        'big-heading'
                    );
                    ?>
                    <?php if (isset($description)) { ?>

                        <div class="description-box">
                            <p>
                                <?= $description ?>
                            </p>
                        </div>
                    <?php } ?>

                </div>
            </div>

            <?php if (is_product_category()) { ?>
                <?php
                $term = get_queried_object();

                $args = array(

                    'post_type'      => array('product'),

                    'post_status'    => 'publish',

                    'posts_per_page' => -1,

                    'tax_query'      => array(

                        array(

                            'taxonomy' => 'product_cat',

                            'field'    => 'slug',

                            'terms'    => array($term->slug),

                            'operator' => 'IN',

                        )

                    )

                );


                $products = new WP_Query($args);
                $display_type = get__term_meta($term->term_id, 'display_type');



                if ($products->found_posts > 4) {
                    if (!isset($_GET['display'])) {
                        $display_type = $display_type;
                    }
                    else {
                        $display_type = $_GET['display'];
                    }
                }
                else {
                    $display_type = 'grid';
                }


                ?>
                <?php if ($products->found_posts > 4) { ?>
                    <div class="col-auto display-filter mb-0">
                        <ul class="list-inline d-flex justify-content-end">
                            <li class="me-2 display-grid <?= $display_type == 'grid' ? 'active' : '' ?>">
                                <a href="?display=grid" title="Grid View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                        <g id="grid" transform="translate(0.114)">
                                            <rect id="Rectangle_256" data-name="Rectangle 256" width="48" height="48" rx="5"
                                                transform="translate(-0.114)" fill="#fff" />
                                            <rect id="Rectangle_261" data-name="Rectangle 261" width="12" height="16" rx="2"
                                                transform="translate(25.886 7)" fill="#eeeef3" />
                                            <rect id="Rectangle_262" data-name="Rectangle 262" width="12" height="16" rx="2"
                                                transform="translate(10.886 7)" fill="#eeeef3" />
                                            <rect id="Rectangle_263" data-name="Rectangle 263" width="12" height="16" rx="2"
                                                transform="translate(25.886 25)" fill="#eeeef3" />
                                            <rect id="Rectangle_264" data-name="Rectangle 264" width="12" height="16" rx="2"
                                                transform="translate(10.886 25)" fill="#eeeef3" />
                                        </g>
                                    </svg>
                                </a>
                            </li>
                            <li class="display-slider <?= $display_type != 'grid' ? 'active' : '' ?>">
                                <a href="?display=slider" title="Slider View">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="48" height="48" viewBox="0 0 48 48">
                                        <defs>
                                            <clipPath id="clip-path">
                                                <rect id="Rectangle_260" data-name="Rectangle 260" width="48" height="48" rx="5"
                                                    transform="translate(0.252)" fill="#fff" />
                                            </clipPath>
                                        </defs>
                                        <g id="carousel" transform="translate(-0.252)">
                                            <rect id="Rectangle_255" data-name="Rectangle 255" width="48" height="48" rx="5"
                                                transform="translate(0.252)" fill="#fff" />
                                            <g id="Mask_Group_11" data-name="Mask Group 11" clip-path="url(#clip-path)">
                                                <g id="Group_165" data-name="Group 165" transform="translate(8.042 13.403)">
                                                    <rect id="Rectangle_257" data-name="Rectangle 257" width="13" height="21"
                                                        rx="2" transform="translate(0.21 -0.403)" fill="#eeeef3" />
                                                    <rect id="Rectangle_258" data-name="Rectangle 258" width="13" height="21"
                                                        rx="2" transform="translate(16.21 -0.403)" fill="#eeeef3" />
                                                    <rect id="Rectangle_259" data-name="Rectangle 259" width="12" height="21"
                                                        rx="2" transform="translate(32.21 -0.403)" fill="#eeeef3" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php } ?>
            <?php } ?>

            <?php if ($image) { ?>
                <div class="col-auto col-image text-end">
                    <div class="column-holder">
                        <?php
                        $DisplayData->image(
                            array(
                                'image_id' => $image,
                                'size'     => 'medium'
                            ),
                            'background-white d-inline-block'
                        );
                        ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
if (is_tax()) {
    get_template_part('template-parts/woocommerce/featured', 'boxes');
}
?>