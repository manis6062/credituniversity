<?php
$CI = &get_instance();
$this->load->model('BannerModel');
$banner = $CI->BannerModel->getAllBanner();
if ($banner) {
    ?>

    <div id="main-slider" class="no-margin">
        <div class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php foreach ($banner as $key => $val) { ?>
                    <li data-target="#main-slider" data-slide-to="<?php echo $key; ?>" <?php if ($key == 0) {
                        echo 'class="active"';
                    } ?>></li>
                <?php } ?>
            </ol>
            <div class="carousel-inner">

                <?php foreach ($banner as $key => $val) { ?>

                    <div class="item <?php if ($key == 0) {
                        echo 'active';
                    } ?>" style="background-image: url(<?php echo base_url() . 'uploads/banner/' . $val->path ?>)">
                        <div class="container">
                            <div class="row slide-margin" id="imageContainer">
                                <div class="col-sm-4">
                                    <div class="carousel-content">
                                        <h1 class="animation animated-item-1"><?php echo $val->description ?></h1>
                                        <!-- <h2 class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</h2>
                                         <a class="btn-slide animation animated-item-3" href="#">Read More</a>-->
                                    </div>
                                </div>
                                <div class="col-sm-4 hidden-xs animation animated-item-4">
                                    <div class="slider-img">
                                        <img src="<?php echo base_url() . 'uploads/banner/' . $val->mimage; ?>"
                                             class="img-responsive image">
                                    </div>
                                </div>
                                <div class="col-sm-4 hidden-xs animation animated-item-4">
                                    <div class="slider-img">
                                        <img src="<?php echo base_url() . 'uploads/banner/' . $val->rimage; ?>"
                                             class="img-responsive image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/.item-->
                <?php } ?>

                <!--/.item-->
            </div>
            <!--/.carousel-inner-->
        </div>
        <!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </div><!--/#main-slider-->
<?php } ?>

<script src="<?php echo base_url() ?>frontend/js/bootstrap.min.js"></script>
