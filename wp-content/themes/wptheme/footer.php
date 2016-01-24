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
		<div class="col-md-12 footer-text">
			<p>© Благотворительный фонд помощи детям <span>«Лучик Надежды»</span></p>
		</div>
		<div class="clearfix"></div>
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