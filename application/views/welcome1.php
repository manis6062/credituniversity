<?php $CI = &get_instance();
$content = $CI->ContentModel->getDetails('Home');
?>
<div class="main">
    <div class="wrap">
        <h3 style="padding-bottom:2px; border-bottom:1px solid #cccccc; margin-bottom: 5px; font-size: 18px; text-transform: uppercase;">
            The Credit University</h3>
        <?php if (!empty($content)) {
            ?>
            <p>
                <?php echo word_limiter(strip_tags($content->content_description), 150); ?><a
                    href="<?php echo base_url() . 'index.php/Content/' . $content->content_id; ?>">Read More</a>
            </p>
            <?php //}
        }
        ?>
    </div>

    <div class="wrap" style="margin-top:15px;">
        <div class="col_1_of_3 span_1_of_3">

            <iframe width="100%" height="215" src="//www.youtube.com/embed/4SsgjAwZ_ZE" frameborder="0"
                    allowfullscreen></iframe>

        </div>

        <div class="col_1_of_3 span_1_of_3">

            <iframe width="100%" height="215" src="//www.youtube.com/embed/6shm2JO8msg" frameborder="0"
                    allowfullscreen></iframe>

        </div>
        <div class="col_1_of_3 span_1_of_3">

            <iframe width="100%" height="215" src="//www.youtube.com/embed/gKJDZT0L2ks" frameborder="0"
                    allowfullscreen></iframe>

        </div>
        <div class="clear"></div>

    </div>
    <div class="wrap" style="margin-top:15px;">

        <div class="col_1_of_3 span_1_of_3">

            <div class="desc">
                <div class="fb-comments" data-href="http://example.com/comments" data-width="100%" data-numposts="3"
                     data-colorscheme="light"></div>
            </div>

        </div>
        <div class="col_1_of_3 span_1_of_3">

            <script src="http://snapwidget.com/js/snapwidget.js"></script>
            <iframe
                src="http://snapwidget.com/in/?u=Z2VsY2hoaXJpc2dtYWlsLmNvbXxpbnwxMjV8M3wzfHxub3w1fG5vbmV8b25TdGFydHx5ZXN8eWVz&ve=200814"
                title="Instagram Widget" class="snapwidget-widget" allowTransparency="true" frameborder="0"
                scrolling="no" style="border:none; overflow:hidden; width:100%;"></iframe>

        </div>
        <div class="col_1_of_3 span_1_of_3">

            <a class="twitter-timeline" href="https://twitter.com/rbclubmo" data-widget-id="448357930765537280">Tweets
                by @rbclubmo</a>
            <script>
                !function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + "://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");
            </script>

        </div>
        <div class="clear"></div>

    </div>
</div>

<!-- <div class="main">
<div class="wrap">

<div class="col_1_of_3 span_1_of_3">

<div class="desc">
<div class="fb-comments" data-href="http://example.com/comments" data-width="100%" data-numposts="3" data-colorscheme="light"></div>
</div>

</div>
<div class="col_1_of_3 span_1_of_3">

<div class="desc">
<h3><a href="#">America CPN</a></h3>
<?php if (!empty($content)) {
    ?>
<p>
<?php echo word_limiter(strip_tags($content->content_description), 150); ?><a href="<?php echo base_url() . 'index.php/Content/show/' . $content->content_id; ?>">Read More</a>
</p>
<?php
//}
}
?>
</div>

</div>
<div class="col_1_of_3 span_1_of_3">

<div class="desc1">
<iframe width="100%" height="215" src="//www.youtube.com/embed/4SsgjAwZ_ZE" frameborder="0" allowfullscreen></iframe>
</div>
<div class="desc1">
<iframe width="100%" height="215" src="//www.youtube.com/embed/6shm2JO8msg" frameborder="0" allowfullscreen></iframe>
</div>
<div class="desc1">
<iframe width="100%" height="215" src="//www.youtube.com/embed/gKJDZT0L2ks" frameborder="0" allowfullscreen></iframe>
</div>
</div>
<div class="clear"></div>

</div>

</div> -->