<?php
$SVG = new SVG;
$DisplayData = new DisplayData;
$module['heading'];
$heading = $module['heading'];
$heading_prefix = $module['heading_prefix'];
$items = $module['items'];

?>

<div class="container text-center">
    <?php
    $DisplayData->heading(
        array(
            'heading'       => $heading,
            'heading_small' => $heading_prefix
        ),
        'small-width mb-6 section-heading ms-auto me-auto'
    );
    ?>

    <div class="row gy-3 av-tabs align-items-center" id="tab-center">
        <div class="col-12 col-lg col-left">
            <div class="column-holder py-5">
                <div class="nav nav-tabs" role="tablist">
                    <button class="nav-link text-start active" id="nav-1-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-1" type="button" role="tab" aria-controls="nav-1" aria-selected="true">
                        <div class="icon-heading-holder">
                            <?php
                            $DisplayData->image(
                                array(
                                    'image_id' => $items[0]['icon']
                                ), 'icon-box'
                            );
                            $DisplayData->heading(
                                array(
                                    'heading' => $items[0]['heading'],
                                    'tag'     => 'h4'
                                ),
                                'mb-2'
                            );

                            $DisplayData->description(
                                array(
                                    'description' => $items[0]['description'],
                                ),
                            );
                            ?>
                        </div>
                    </button>
                    <button class="nav-link text-start" id="nav-2-tab" data-bs-toggle="tab" data-bs-target="#nav-2"
                        type="button" role="tab" aria-controls="nav-2" aria-selected="false">
                        <div class="icon-box mb-4">
                            <?= $SVG->education ?>
                        </div>
                        <div class="heading-box mb-2">
                            <h4>
                                Education & research
                            </h4>
                        </div>
                        <div class="description-box">
                            <p>
                                The drone industry is advancing every single day. Find out how you can get yourself
                                airborne.
                            </p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-center">
            <div class="column-holder">
                <div class="tab-content" id="tab-center-tabContent">
                    <div class="tab-pane fade show active" id="nav-1" role="tabpanel" aria-labelledby="nav-1-tab">
                        <div class="image-box">
                            <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                            <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-2" role="tabpanel" aria-labelledby="nav-2-tab">
                        <div class="image-box">
                            <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                            <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-3" role="tabpanel" aria-labelledby="nav-3-tab">
                        <div class="image-box">
                            <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                            <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-4" role="tabpanel" aria-labelledby="nav-4-tab">
                        <div class="image-box">
                            <img src="<?= content_url() ?>/uploads/2022/11/windmill-1.png" alt="">
                            <img src="<?= content_url() ?>/uploads/2022/11/drone-image.png" alt="" class="drone-image">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg col-right">
            <div class="column-holder py-5">
                <div class="nav nav-tabs" role="tablist">
                    <button class="nav-link text-start" id="nav-3-tab" data-bs-toggle="tab" data-bs-target="#nav-3"
                        type="button" role="tab" aria-controls="nav-3" aria-selected="false">
                        <div class="icon-box mb-4">
                            <?= $SVG->inspection ?>
                        </div>
                        <div class="heading-box mb-2">
                            <h4>
                                Inspection
                            </h4>
                        </div>
                        <div class="description-box">
                            <p>
                                Reduce risk, lower costs and save time by using an integrated drone solution in your
                                organisation.
                            </p>
                        </div>
                    </button>
                    <button class="nav-link text-start" id="nav-4-tab" data-bs-toggle="tab" data-bs-target="#nav-4"
                        type="button" role="tab" aria-controls="nav-4" aria-selected="false">
                        <div class="icon-box mb-4">
                            <?= $SVG->surveying ?>
                        </div>
                        <div class="heading-box mb-2">
                            <h4>
                                Surveying & construction
                            </h4>
                        </div>
                        <div class="description-box">
                            <p>
                                Drones are helping surveyors to carry out operations faster, safer and more cost
                                effective.
                            </p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>