<?php

$DisplayData = new DisplayData;

$SVG = new SVG;

?>


<section class="product-slider blog-section careers-section xl-padding-bottom archive-section">

  <div class="container">

    <div class="product-slider-box">

      <div class="mySwiper-productSwiperPost mySwiper-PostSlider">

        <div id="results">

          <div class="results-holder">

            <div class="row gy-3">
              <?php
              if (have_posts()) {
                while (have_posts()) {
                  the_post();
                  $salary_and_location = get__post_meta('salary_and_location');
                  $duration = get__post_meta('duration');
                  ?>
                  <div class="col-lg-4 col-sm-6 post-item">
                    <div class="swiper-slide">
                      <div class="inner background-white d-block ">
                        <div class="image-holder position-relative">
                          <?php
                          $DisplayData->image(
                            array(
                              'image_id'    => get_post_thumbnail_id(),
                              'size'        => 'large',
                              'placeholder' => true
                            ),
                            'position-relative image-cover-transform'
                          );
                          ?>
                        </div>

                        <div class="content-box ">
                          <?php
                          $DisplayData->heading(
                            array(
                              'heading' => get_the_title(),
                              'tag'     => 'h4'
                            )
                          );
                          ?>
                          <div class="details-box fw-medium mb-3">
                            <p><?= $salary_and_location . ', ' . $duration ?></p>
                          </div>
                          <?php
                          $DisplayData->description(
                            array(
                              'description' => get_the_excerpt()
                            )
                          );
                          ?>
                        </div>
                        <div class="bottom-box">

                          <div class="link-box">
                            <a href="<?= get_permalink() ?>" class="link-underline fw-medium">
                              Read more
                            </a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                <?php }
              }
              else {
                ?>
                <h2>No Results Found</h2>
                <?php
              }
              ?>
            </div>

          </div>

        </div>

      </div>

    </div>





    <div class="load-more load-more-box text-center xl-padding-top">

      <a href="#"
        class="load-more d-inline-flex flex-column link-underline fw-medium justify-content-center align-items-center"
        id="load-more">

        <?= $SVG->load_more ?>

        <span class="text">Load more</span>

      </a>

    </div>



  </div>

</section>