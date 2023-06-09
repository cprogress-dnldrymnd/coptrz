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
                        $vendor = get_the_terms($product->get_id(), 'pa_vendors');
                        if($vendor) {
                           $vendor_id = $vendor[0]->term_id;
                        }
                        $vendor_image = get__term_meta($vendor_id, 'featured_product_image');
                        $image = get_the_post_thumbnail_url($featured_product['id'], 'large');
                        $image_url = $image ? $image : wp_get_attachment_image_url(get__theme_option('placeholder_image'), 'large');
                        ?>
                        <div class="swiper-slide">
                            <div class="container">
                                <div class="row gy-4 align-items-center">
                                    <div class="col-lg-5">
                                        <div class="column-holder">
                                            <div class="image-box">
                                                <img class="main-image <?= $image ? '' : 'image-cover' ?>" src="<?= $image_url ?>"
                                                    alt="<?= $product->get_name() ?>">
                                             
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        
                                        <div class="column-holder content-margin ">
                                               <img class="image-icon"
                                                    src="<?= wp_get_attachment_image_url($vendor_image, 'medium') ?>">
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
                                            global $product_id_global;
                                            $product_id_global = $featured_product['id'];
                                            ?>
                                            <?= $GetData->add_to_cart($featured_product['id']) ?>
                                            <?php if($product->get_price_html()) { ?>
                                            <div class="button-box button-accent">
                                                <a href="<?= get_permalink($featured_product['id']) ?>">VIEW PRODUCT</a>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?= product_slider_nav('slider'); ?>
            </div>
        </div>
    </div>

<?php } ?>