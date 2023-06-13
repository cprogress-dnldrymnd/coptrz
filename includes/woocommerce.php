<?php



/**
 * Remove the breadcrumbs 
 */

add_action('init', 'woo_remove_wc_breadcrumbs');

function woo_remove_wc_breadcrumbs()
{

    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

}


/**
 * @snippet       Plus Minus Quantity Buttons @ WooCommerce Product Page & Cart
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */



// -------------

// 1. Show plus minus buttons



add_action('woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus');



function bbloomer_display_quantity_plus()
{
    global $product;

    if (!is_cart() && !$product->is_sold_individually()) {
        echo '<button type="button" class="plus">+</button>';
    }

}



add_action('woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus');



function bbloomer_display_quantity_minus()
{
    global $product;
    if (!is_cart() && !$product->is_sold_individually()) {

        echo '<button type="button" class="minus">-</button>';

    }
}

/**
 * @snippet       Dynamic Attributes @ Single Product
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 6
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */



add_action('woocommerce_before_add_to_cart_quantity', 'bbloomer_dynamic_atts_variation');



function bbloomer_dynamic_atts_variation()
{

    wc_enqueue_js(" 

    jQuery('.is-variation-radio input.variation_id').change(function(){

       if( $(this).val() && $(this).val() > 0  ) {   

          $('form.variations_form').find('.variations select').each( function( index, el ){

             var current_select_id = $(el).attr('id');

             var current_select_val = $(el).find('option:selected').text();

             $('.woocommerce-product-attributes-item--attribute_'+current_select_id+' td p').text(current_select_val);

          });

       } 

    });

 ");

}



function product_slider($is_shop = false)
{

    $DisplayData = new DisplayData;
    $GetData = new GetData;

    $SVG = new SVG;

    ob_start();



    $args = array(

        'taxonomy'   => 'product_cat',

        'hide_empty' => false,

        'meta_key'   => '_menu_order',

        'orderby'    => '_menu_order',

    );


    if ($is_shop) {


        $product_categories = get_terms($args);



        foreach ($product_categories as $key => $category) {

            $display_in_shop = get__term_meta($category->term_id, 'display_in_shop');
            $display_type = get__term_meta($category->term_id, 'display_type');


            if ($display_in_shop) {

                $array[] = $category->term_id;

            }





        }



        $args['include'] = $array;


    }
    else {

        $term = get_queried_object();

        $args['parent'] = false;


    }





    $product_categories = get_terms($args);






    if (!empty($product_categories)) {



        foreach ($product_categories as $key => $category) {

            $product_slider_items_width = get__term_meta($category->term_id, 'product_slider_items_width');

            $args = array(

                'post_type'   => array('product'),

                'post_status' => 'publish',

                'tax_query'   => array(

                    array(

                        'taxonomy' => 'product_cat',

                        'field'    => 'term_id',

                        'terms'    => array($category->term_id),

                        'operator' => 'IN',

                    )

                )

            );


            if ($is_shop) {

                $args['posts_per_page'] = 6;

            }
            else {

                $args['tax_query'][] = array(

                    'taxonomy' => 'pa_vendors',

                    'field'    => 'term_id',

                    'terms'    => array($term->term_id),

                    'operator' => 'IN',

                );

                $args['posts_per_page'] = -1;



            }

            $products = new WP_Query($args);

            echo product_slider_section($products, $product_slider_items_width);

            ?>

        <?php } ?>



    <?php } ?>

    <?php

    return ob_get_clean();

}



function product_slider_category($is_category = false)
{

    $DisplayData = new DisplayData;

    $SVG = new SVG;

    $term = get_queried_object();


    if (isset($_GET['vendor'])) {
        $vendor = $_GET['vendor'];
    }
    else {
        $vendor = $_GET['vendors'];
    }

    if ($vendor) {
        $tax_query[] = array(

            'taxonomy' => 'pa_vendors',

            'field'    => 'slug',

            'terms'    => array($vendor),

            'operator' => 'IN',
        );
    }

    $tax_query[] = array(

        'taxonomy' => 'product_cat',

        'field'    => 'slug',

        'terms'    => array($term->slug),

        'operator' => 'IN',

    );

    $args = array(


        'post_type'      => array('product'),

        'post_status'    => 'publish',

        'posts_per_page' => -1,

        'tax_query'      => $tax_query

    );


    $products = new WP_Query($args);
    $product_slider_items_width = get__term_meta($term->term_id, 'product_slider_items_width');
    $display_type = get__term_meta($term->term_id, 'display_type');

    echo product_slider_section($products, $product_slider_items_width, $display_type);
}


function product_slider_section($products, $product_slider_items_width)
{
    $DisplayData = new DisplayData;
    $GetData = new GetData;
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

    if ($display_type == 'grid' || !$display_type) {
        $wrapper_class_1 = 'product-grid';
        $wrapper_class_2 = 'row g-4';
        $wrapper_class_3 = 'col-xl-3 col-lg-4 col-md-6';
        $wrapper_class_4 = '';
    }
    else {
        $wrapper_class_1 = 'swiper mySwiper-productSwiper' . ($product_slider_items_width ? '-' . $product_slider_items_width : '');
        $wrapper_class_2 = 'swiper-wrapper';
        $wrapper_class_3 = 'swiper-slide';
        $wrapper_class_4 = 'extend-right';
    }

    if ($products->have_posts()) {
        ?>
        <section class="product-slider md-padding">

            <div class="container <?= $wrapper_class_4 ?>">

                <div class="product-slider-box">

                    <div class="product-holder <?= $wrapper_class_1 ?>">

                        <div class="<?= $wrapper_class_2 ?>">

                            <?php

                            $products->the_post();

                            $product = wc_get_product(get_the_ID());

                            $main_image = $product->get_image_id() ? $product->get_image_id() : get__theme_option('placeholder_image');

                            $image_class = $product->get_image_id() ? 'image-contain-transform' : 'image-cover-transform';

                            ?>

                            <div class="product-box <?= $wrapper_class_3 ?>">

                                <div class="inner background-white d-block content-margin"
                                    href="<?= get_permalink(get_the_ID()) ?>">

                                    <?php

                                    $DisplayData->heading(

                                        array(

                                            'heading' => $product->get_name(),

                                            'tag'     => 'h4'

                                        )

                                    );

                                    $DisplayData->image(

                                        array(

                                            'image_id' => $main_image,

                                            'size'     => 'medium'

                                        ),

                                        'position-relative mb-3 ' . $image_class

                                    );

                                    echo $GetData->product_price(get_the_ID());

                                    $DisplayData->description(

                                        array(

                                            'description' => $product->get_short_description()

                                        ),

                                        false

                                    );

                                    ?>

                                    <div class="button-group-box justify-content-center align-items-center">
                                        <div class="button-quick-view">
                                            <button type="button"
                                                class="product-modal-trigger product-modal-trigger-open d-flex align-items-center justify-content-center"
                                                product="<?= get_the_ID() ?>">

                                                <span class="text">
                                                    <?= $SVG->eye ?>
                                                </span>

                                                <span class="icon"><?= $SVG->ellipsis ?></span>

                                            </button>
                                        </div>
                                        <div class="button-box button-accent button-small">
                                            <a href="<?php the_permalink() ?>">
                                                <span class="text">VIEW PRODUCT</span>
                                            </a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <?= product_slider_nav($display_type) ?>

                    </div>

                </div>

            </div>

        </section>

        <?php

    }
    return ob_get_clean();
}

function product_slider_nav($display_type)
{
    if ($display_type != 'grid') {
        ob_start();
        ?>
        <div class="swiper-nav-holder d-none d-sm-inline-flex">

            <div class="swiper-button-prev"></div>

            <div class="swiper-button-next"></div>

        </div>
        <div class="swiper-pagination-holder d-flex d-sm-none">
            <div class="swiper-pagination"></div>
        </div>
        <?php
        return ob_get_clean();
    }
}

function wt_mime_types($mime_types)
{
    $mime_types['webp'] = 'image/webp'; //Adding webp extension
    return $mime_types;
}
add_filter('woocommerce_rest_allowed_image_mime_types', 'wt_mime_types', 1, 1);



//remove description tab
add_filter('woocommerce_product_tabs', 'my_remove_description_tab', 11);

function my_remove_description_tab($tabs)
{
    unset($tabs['description']);
    return $tabs;
}


/**
 * ENQUIRE NOW TAB
 */
add_filter('woocommerce_product_tabs', 'woo_new_product_tab');
function woo_new_product_tab($tabs)
{
    $button_type = get__post_meta('button_type');
    if ($button_type == 'link_to_form') {

        // Adds the new tab


        $tabs['enquire_now'] = array(
            'title'    => __('Enquire Now', 'woocommerce'),
            'priority' => 50,
            'callback' => 'woo_enquire_now_tab'
        );
    }

    return $tabs;

}
function woo_enquire_now_tab()
{

    // The new tab content
    $enquire_now_form = get__post_meta('enquire_now_form');
    ?>
    <div class="heading-box text-center">
        <h2>ENQUIRE NOW</h2>
    </div>
    <div class="form-box" id="product-enquire-now">
        <?= do_shortcode($enquire_now_form) ?>
    </div>
    <?php


}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);

add_action('woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30);

function single_product_components()
{
    if (is_product()) {

        ob_start();
        ?>
        <section class="product-tabs md-padding background-white" id="product-tabs">
            <div class="container">
                <?php wc_get_template('single-product/tabs/tabs.php'); ?>
            </div>
        </section>
        <section class="related-products md-padding" id="related-products">
            <div class="container">
                <?= do_shortcode('[related_products limit="4"]') ?>
            </div>
        </section>
        <?php
        return ob_get_clean();
    }
}

function single_product_summary($product_id)
{
    if (is_product()) {
        ob_start();
        $SVG = new SVG;
        $GetData = new GetData;
        $Modules = new Modules;
        $product_id = get_the_ID();
        $product = wc_get_product($product_id);
        $name = $product->get_name();
        $main_image = $product->get_image_id() ? $product->get_image_id() : get__theme_option('placeholder_image');
        $images = $product->get_gallery_image_ids();
        $type = $product->get_type();
        $price = $product->get_price_html();
        $variation_radio = false;
        $variation_radio_value = false;
        if ($type == 'variable') {
            $count = count($product->get_children());
            if ($count == 2) {
                $variation_radio = true;
                $variation_radio_value = $product->get_children();
            }
        }
        $hide_product_summary = get__post_meta_by_id($product_id, 'hide_product_summary');

        if (!$hide_product_summary) {
            include(get_stylesheet_directory() . '/template-parts/woocommerce/product-details/product-details.php');
        }
        include(get_stylesheet_directory() . '/template-parts/woocommerce/product-details/product-featured-video.php');
        include(get_stylesheet_directory() . '/template-parts/woocommerce/product-details/product-specifications.php');

        return ob_get_clean();
    }
}


/**
 * Function for `woocommerce_cart_item_price` filter-hook.
 * 
 * @param  $WC()->cart->get_product_price 
 * @param  $cart_item                     
 * @param  $cart_item_key                 
 *
 * @return 
 */

add_filter('woocommerce_cart_item_price', 'action_woocommerce_cart_item_price', 10, 3);

function action_woocommerce_cart_item_price($old_display, $cart_item, $cart_item_key)
{
    if (is_user_logged_in()) {
        $customer_type = carbon_get_user_meta(get_current_user_id(), 'customer_type');
    }
    else {
        $customer_type = $_SESSION['customer_type'];
    }
    if ($customer_type == 'consumer') {
        $GetData = new GetData;

        return $GetData->product_price_cart($cart_item['data']->get_id());

    }
    else {
        return $old_display . ' Incl. VAT';
    }
}


add_filter('woocommerce_cart_item_subtotal', 'action_woocommerce_cart_item_subtotal', 10, 3);

function action_woocommerce_cart_item_subtotal($old_display, $cart_item, $cart_item_key)
{
    $customer_type = carbon_get_user_meta(get_current_user_id(), 'customer_type');
    if ($customer_type == 'consumer') {
        $GetData = new GetData;
        return $GetData->product_price_cart($cart_item['data']->get_id(), $cart_item['quantity']);
    }
    else {
        return $old_display . ' Incl. VAT';
    }
}

/**
 * @snippet       Get Current Variation ID @ WooCommerce Single Product
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_action('woocommerce_before_add_to_cart_quantity', 'bbloomer_display_dropdown_variation_add_cart');

function bbloomer_display_dropdown_variation_add_cart()
{
    global $product;
    if ($product->is_type('variable')) {
        wc_enqueue_js("
         $( 'input.variation_id' ).change( function(){
            if( '' != $(this).val() ) {
               var var_id = $(this).val();
		        jQuery('.ajax_add_to_cart').attr('data-product_id', var_id);
            }
         });
      ");
    }
}

function display_filter($post_count, $display_type, $class = '', $param = '')
{
    if ($post_count > 4) {
        ob_start();
        ?>

        <div class="display-filter <?= $class ?>">
            <ul class="list-inline d-flex justify-content-end">
                <li class="me-2 display-grid <?= $display_type == 'grid' ? 'active' : '' ?>">
                    <a href="?display=grid<?= $param ?>">
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

                        <div class="tooltip-text">
                            Grid View
                        </div>
                    </a>
                </li>
                <li class="display-slider <?= $display_type != 'grid' ? 'active' : '' ?>">
                    <a href="?display=slider">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="48"
                            height="48" viewBox="0 0 48 48">
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
                                        <rect id="Rectangle_257" data-name="Rectangle 257" width="13" height="21" rx="2"
                                            transform="translate(0.21 -0.403)" fill="#eeeef3" />
                                        <rect id="Rectangle_258" data-name="Rectangle 258" width="13" height="21" rx="2"
                                            transform="translate(16.21 -0.403)" fill="#eeeef3" />
                                        <rect id="Rectangle_259" data-name="Rectangle 259" width="12" height="21" rx="2"
                                            transform="translate(32.21 -0.403)" fill="#eeeef3" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <div class="tooltip-text">
                            Slider View
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <?php

        return ob_get_clean();
    }
}