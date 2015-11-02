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
			<div class="col-md-6 footer-left">
				<h3>Subscribe to Our Newsletter</h3>
				<div class="letter">
					<form>
						<input type="text" value="Enter Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Your Email';}">
						<input type="submit" value="Subscribe">
					</form>
				</div>
			</div>
			<div class="col-md-3 footer-left">
				<h3>Overview</h3>
				<ul>
					<li><a href="#">Phasellus at lacus ultrices</a></li>
					<li><a href="#">Duis vestibulum porta lorem</a></li>
					<li><a href="#">Praesent laoreet quam nec purus</a></li>
					<li><a href="#">Suspendisse id tempus dolor</a></li>
					<li><a href="#">Morbi efficitur tincidunt</a></li>
					<li><a href="#">Sed eu erat vel ipsum fermentum</a></li>
				</ul>
			</div>
			<div class="col-md-3 footer-left">
				<h3>Information</h3>
				<ul>
					<li><a href="about.html">About</a></li>
					<li><a href="faq.html">Faqs</a></li>
					<li><a href="services.html">Services</a></li>
					<li><a href="gallery.html">Gallery</a></li>
					<li><a href="typo.html">Blog</a></li>
					<li><a href="contact.html">Contact</a></li>
				</ul>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="footer-text">
			<div class="col-md-6 ftr-left">
				<h4><a href="index.html">Adoption</a></h4>
			</div>
			<div class="col-md-6 ftr-right">
				<p>© 2015 Adoption. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
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