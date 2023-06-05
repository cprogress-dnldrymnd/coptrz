<?php
$DisplayData = new DisplayData;
if (is_shop()) {
    $title = get_the_title(get_option('woocommerce_shop_page_id'));
} else if (is_tax()) {
    $term = get_queried_object();
    $title = $term->name;
    $description = $term->description;
    $image = get__term_meta($term->term_id, 'image');
}


?>


<section class="page-banner md-padding">
    <div class="container">
        <div class="row justify-content-between g-4">
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
                        ), 'big-heading'
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

            <?php if (isset($image)) { ?>
                <div class="col-auto col-image text-end">
                    <div class="column-holder">
                        <?php
                        $DisplayData->image(array(
                            'image_id' => $image,
                            'size' => 'medium'
                        ), 'background-white d-inline-block');
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