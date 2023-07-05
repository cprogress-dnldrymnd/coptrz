<?php
/*-----------------------------------------------------------------------------------*/
/* Template Name: Vendors
/*-----------------------------------------------------------------------------------*/
?>

<?php get_header(); ?>

<?php
$terms = get_terms(
  array(
    'taxonomy'   => 'pa_vendors',
    'hide_empty' => false,
  )
);

$DisplayData = new DisplayData;

?>

<section class="vendors">
  <div class="container">
    <div class="vendor-slider-box md-padding">
      <div class="row g-3 text-center">
        <?php foreach ($terms as $term) { ?>
          <?php
          $image = get__term_meta($term->term_id, 'image');
          $hide_vendor = get__term_meta($term->term_id, 'hide_vendor');
          if (!$hide_vendor) {
            ?>
            <div class="col-md-3 vendor-box">
              <a class="inner h-100 background-white d-block" href="<?= get_term_link($term->term_id) ?>">
                <?php
                $DisplayData->image(
                  array(
                    'image_id' => $image,
                    'size'     => 'medium'
                  ),
                  'position-relative image-contain-transform mb-3'
                );
                ?>
                <div class="vendor-title">
                  <h4 class="mb-0">
                    <?= $term->name ?>
                  </h4>
                </div>
              </a>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>