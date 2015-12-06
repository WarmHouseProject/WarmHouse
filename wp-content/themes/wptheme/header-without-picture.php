<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
global $tabIndex;
$tabIndex = isset($tabIndex) ? $tabIndex : 0;
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Лучик надежды</title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
    <![endif]-->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/components.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/index.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/fileinput.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/childs-list.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/child_form_page.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/child-info-page.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/orphanages-page.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/donate-page.css" rel='stylesheet' type='text/css' />
    <link href="<?php echo get_template_directory_uri(); ?>/css/thank-you-page.css" rel='stylesheet' type='text/css' />
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.0.min.js"></script>
    <?php wp_head(); ?>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/move-top.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script
</head>

<body <?php body_class(); ?>>
<div class="header" id="home">
    <div class="container">
        <div class="header-main">
            <div class="col-md-6 header-left">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1>Лучик надежды</h1></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--header-ends-->
<div style="height: 20px"></div>
<!--header-starts-->
<div class="header-bottom">
    <div class="fixed-header">
        <div class="container">
            <div class="top-menu">
                <span class="menu"><img src="<?php echo get_template_directory_uri(); ?>/images/menu-icon.png" alt="" /></span>
                <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav', 'menu_id' => 'primary-menu' ) ); ?>
                <!-- script for menu -->
                <div class="clearfix"></div>
                <script>
                    jQuery(document).ready(function($) {
                        $( "span.menu" ).click(function() {
                            $( "ul.nav" ).slideToggle( "slow", function() {

                                if ($(this).css("display") == "none") {
                                    $(this).css("display", "")
                                }
                            });
                        });
                    });
                </script>
                <!-- script for menu -->
            </div>
            <script>
                jQuery(document).ready(function($) {
                    var navoffeset=$(".header-bottom").offset().top;

                    $(window).scroll(function(){
                        var scrollpos=$(window).scrollTop();
                        if(scrollpos >=navoffeset){
                            $(".header-bottom").addClass("fixed");
                        }else{
                            $(".header-bottom").removeClass("fixed");
                        }
                    });

                });
            </script>
        </div>
    </div>
</div>