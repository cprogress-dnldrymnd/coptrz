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

$featured_vendor_arr = array();
foreach ($terms as $term) {
  $image = get__term_meta($term->term_id, 'image');
  $hide_vendor = get__term_meta($term->term_id, 'hide_vendor');
  $featured_vendor = get__term_meta($term->term_id, 'featured_vendor');

  if ($featured_vendor) {
    $featured_vendor_arr[$term->term_id] = array(
      'image' => $image,
      'name'  => $term->name
    );
  }
}
$DisplayData = new DisplayData;

?>
<?php
if (!get__post_meta('hide_page_banner')) {
  get_template_part('template-parts/section/content', 'banner');
}
get_template_part('template-parts/section/content', 'after-banner');
?>
<section class="vendors md-padding-bottom overflow-visible" id="featured-vendors">
  <div class="container">
    <div class="heading-box">
      <h3>Featured Vendors</h3>
    </div>
    <div class="vendor-slider-box">
      <div class="row g-3 text-center">
        <?php foreach ($featured_vendor_arr as $key => $featured_vendor_val) { ?>
          <?php
          ?>
          <div class="col-xl-3 col-lg-4 col-sm-6 col-6 vendor-box">
            <a class="inner h-100 background-white d-block" href="<?= get_term_link($key) ?>">
              <?php
              $DisplayData->image(
                array(
                  'image_id' => $featured_vendor_val['image'],
                  'size'     => 'medium'
                ),
                'position-relative image-contain-transform mb-3'
              );
              ?>
              <div class="vendor-title">
                <h4 class="mb-0">
                  <?= $featured_vendor_val['name'] ?>
                </h4>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</section>


<?php get_footer(); ?>