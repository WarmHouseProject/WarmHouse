<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<div class="footer">
	<div class="container">
		<div class="footer-top">
			<div class="footer-left">
				<ul class="tabs-list">
					<li><a href="<?= esc_url( home_url( '/' ) ); ?>">Главная</a></li>
					<li><a href="<?= get_site_url(); ?>/childs">Дети</a></li>
					<li><a href="<?= get_site_url(); ?>/helped_childs">Кому помогли</a></li>
					<li><a href="<?= get_site_url(); ?>/orphanages">Детстке дома</a></li>
					<li><a href="<?= get_site_url(); ?>/stocks">Акции</a></li>
					<li><a href="typo.html">Blog</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="footer-text">
			<div class="col-md-6 ftr-left">
				<h4><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Лучик надежды</a></h4>
			</div>
			<div class="col-md-6 ftr-right">
				<p>© 2015 Adoption. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			/*
			 var defaults = {
			 containerID: 'toTop', // fading element id
			 containerHoverID: 'toTopHover', // fading element hover id
			 scrollSpeed: 1200,
			 easingType: 'linear'
			 };
			 */

			$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#home" id="toTop" class="scroll" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</div>

<?php wp_footer(); ?>
</body>
</html>