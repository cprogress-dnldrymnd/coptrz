<?php

$DisplayData = new DisplayData;

$Helpers = new Helpers;

$GetData = new GetData;

$featured_products = $module['featured_products'];
?>
<?php if ($featured_products) { ?>
    <div class="container-fluid p-0">
        <div class="featured-product-slider-box">
            <div class="swiper mySwiper-FeaturedProducts">
                <div class="swiper-wrapper align-items-center">
                    <?php foreach ($featured_products as $key => $featured_product) { ?>
                        <?php
                        $product = wc_get_product($featured_product['id']);
                        $vendor_id = get_the_terms($product->get_id(), array('pa_vendors'))[0];
                        $vendor_image = get__term_meta($vendor_id, 'image');
                        ?>
                        <div class="swiper-slide">
                            <div class="container">
                                <div class="row gy-4">
                                    <div class="col-lg-7">
                                        <div class="column-holder">
                                            <div class="image-box">
                                                <img src="<?= get_the_post_thumbnail_url($featured_product['id'], 'large') ?>"
                                                    alt="<?= $product->get_name() ?>">
                                                <img src="<?= wp_get_attachment_image_url($vendor_image, 'medium') ?>"
                                                    class="image-icon" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="column-holder content-margin extra-small-width">
                                            <?php
                                            $DisplayData->heading(
                                                array(
                                                    'heading'       => $product->get_name(),
                                                    'heading_small' => 'FEATURED PRODUCT'
                                                ),
                                                'small-width small-heading'
                                            );
                                            $DisplayData->description(
                                                array(
                                                    'description' => $product->get_short_description(),
                                                ),
                                                'content-margin'
                                            );
                                            ?>

                                            <?= $GetData->add_to_cart($featured_product['id']) ?>
                                            <div class="button-box button-accent">
                                                <a href="<?= get_permalink($featured_product['id']) ?>">VIEW PRODUCT</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php } ?>