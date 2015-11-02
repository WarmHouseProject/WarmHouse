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
?><!DOCTYPE html>
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
<title>Adoption a Society & people Category Flat Bootstarp responsive Website Template</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel='stylesheet' type='text/css' />
<script async src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.0.min.js"></script>
<?php wp_head(); ?>
<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/move-top.js"></script>
<script async type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/easing.js"></script>
<script async type="text/javascript">
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
    				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><h1>Adoption</h1></a>
    			</div>
    			<div class="col-md-6 header-right">
    				<ul>
    					<li><a href="#"><span class="fb"></span></a></li>
    					<li><a href="#"><span class="twitter"></span></a></li>
    					<li><a href="#"><span class="google"></span></a></li>
    					<li><a href="#"><span class="rss"></span></a></li>
    				</ul>
    			</div>
    			<div class="clearfix"></div>
    		</div>
    	</div>
    </div>
	<!--header-ends-->
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
		$(function () {
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
	<!--header-starts-->
	<div class="header-bottom">
		<div class="fixed-header">
			<div class="container">
				<div class="top-menu">
					<span class="menu"><img src="images/menu-icon.png" alt="" /></span>
					<ul class="nav">
						<li><a class="hvr-bounce-to-right" href="index.html">Home</a></li>
						<li><a href="about.html" class="hvr-bounce-to-right">About</a></li>
						<li><a href="faq.html" class="hvr-bounce-to-right">Faqs</a></li>
						<li><a href="services.html" class="active hvr-bounce-to-right">Services</a></li>
						<li><a href="gallery.html" class="hvr-bounce-to-right">Gallery</a></li>
						<li><a href="typo.html" class="hvr-bounce-to-right">Blog</a></li>
						<li><a href="contact.html" class="hvr-bounce-to-right">Contact</a></li>
					</ul>
					<!-- script for menu -->
					<script>
						$( "span.menu" ).click(function() {
							$( "ul.nav" ).slideToggle( "slow", function() {
								// Animation complete.
							});
						});
					</script>
					<!-- script for menu -->
				</div>
				<script>
					$(document).ready(function() {
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