<!--banner-starts-->
<div class="bnr">
    <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <div class="banner1">
                </div>
            </li>
            <li>
                <div class="banner2">
                </div>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->
<!--Slider-Starts-Here-->
<script src="<?php echo get_template_directory_uri(); ?>/js/responsiveslides.min.js"></script>
<script>
// You can also use "$(window).load(function() {"
jQuery(document).ready(function($) {
    // Slideshow 4
    $("#slider4").responsiveSlides({
                auto: true,
                pager: true,
                nav: true,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
</script>
<!--End-slider-script-->