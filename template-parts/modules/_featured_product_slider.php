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
                        <div class="swiper-slide">
                            <div class="container">
                                <div class="row gy-4">
                                    <div class="col-lg-7">
                                        <div class="column-holder">
                                            <div class="image-box">
                                                <img src="<?= get_the_post_thumbnail_url($featured_product['id'], 'large') ?>" alt="<?= get_the_title($featured_product['id']) ?>">
                                                <img src="<?= content_url() ?>/uploads/2022/12/dji-icon.png" class="image-icon"
                                                    alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="column-holder content-margin extra-small-width">
                                            <div class="heading-box small-width small-heading">
                                                <span class="prefix white-color">FEATURED PRODUCT</span>
                                                <h2>
                                                    DJI Mavic 3 Thermal
                                                </h2>
                                            </div>
                                            <div class="description-box content-margin">
                                                <p>
                                                    Image above everything! The Mavic 3 is finally here, set to be the ultimate
                                                    compact drone for high-end photography and videography.
                                                </p>
                                                <ul>
                                                    <li>
                                                        20 Megapixel, 4/3 CMOS Sensor
                                                    </li>
                                                    <li>
                                                        100 Megapixel Panorama mode
                                                    </li>
                                                    <li>
                                                        4K video up to 120 fps or 5.1K up to 50 fps
                                                    </li>
                                                    <li>
                                                        200Mbps H.264 or 140Mbps H.265 video recording
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="button-box button-accent">
                                                <a href="#">SHOP NOW</a>
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