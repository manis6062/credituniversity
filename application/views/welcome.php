<section id="feature">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2><?php echo $content->content_title; ?></h2>

            <h3><?php echo strip_tags(word_limiter($content->content_description, 1000, '')); ?></h3>
        </div>
    </div>
</section>
<div id="catagory">
    <div class="container">
        <div class="row">
            <div class="features">
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="box-welcome">
                        <img src="<?php echo base_url() ?>frontend/images/catagory.png" width="75" height="75">

                        <h2><?php echo $theme_option->feature_heading1; ?></h2>
                        <h5><?php echo $theme_option->feature_tagline1; ?></h5>

                        <p><?php echo $theme_option->feature_desc1; ?></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="box-welcome">
                        <img src="<?php echo base_url() ?>frontend/images/catagory1.png" width="75" height="75">

                        <h2><?php echo $theme_option->feature_heading2; ?></h2>
                        <h5><?php echo $theme_option->feature_tagline2; ?></h5>

                        <p><?php echo $theme_option->feature_desc2; ?></p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="box-welcome">
                        <img src="<?php echo base_url() ?>frontend/images/catagory2.png" width="75" height="75">

                        <h2><?php echo $theme_option->feature_heading3; ?></h2>
                        <h5><?php echo $theme_option->feature_tagline4; ?></h5>

                        <p><?php echo $theme_option->feature_desc3; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="video">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 video_detail">
                <h3>LET US HELP YOU!</h3><br/>

                <p>
                    Whether you are an individual needing a guiding hand to assist you in repairing your credit or you
                    are a broker already in the industry helping others on their paths to financial freedom, we at TCU
                    have just the right software tools that you will need, not only to help you achieve your goals but
                    also expedite your duties more effectively. Let us help you achieve more and dream bigger.
                    <br/>
                    <br/>
                    SIGN UP TODAY!
                </p>
                <a href="<?php echo base_url() . 'register/signUp' ?> " class="btn btn-default">sign up</a>
            </div>
            <div class="col-lg-6">
                <div class="video-container"><?php echo $theme_option->theme_video; ?></div>
            </div>
        </div>
    </div>
</div>
<section id="recent-works">
    <div class="container">
        <div class="center wow fadeInDown">
            <h2>OUR PROCESS</h2>
        </div>
        <div class="row">
            <?php if (!empty($process)) {
                $i = 1;
                foreach ($process as $value) {
                    if ($i < 5) {
                        ?>
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <div class="process">
                                <img src="<?php echo base_url() ?>frontend/images/<?php echo $i; ?>.png" width="109"
                                     height="100" style="margin-left: 60px">

                                <h3><?php echo $value->process_title; ?></h3>

                                <p><?php echo word_limiter($value->process_description, 200, ''); ?></p>
                            </div>
                        </div>
                        <?php $i++;
                    }
                }
            } ?>
        </div>
    </div>
</section>
</div>
<hr>
