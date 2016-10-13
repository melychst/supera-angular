<?php $domain = site_url()."/";
$options = 64; ?>
<footer class='clearfix'>
	<div class="footer-top">

	</div>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="copyrights">
					<div class="col-md-4 logo-left">
						<ul class="circules">
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</div>
					<div class="col-md-3 menu_container">
						<div class="title-container">
							<p>Reservation</p>
						</div>
						<nav><?php wp_nav_menu(array('theme_location' => 'footer-menu', 'menu' => 'footer-menu')) ?></nav>
					</div>
					<div class="col-md-5 contact-container">
						<div class="title-container">
							<p>Contact Supera</p>
						</div>
						<div class="contacts">
							<div class="left-block">
								<p>North America - +1 777 111 2233</p>
								<p>Europe - +2 888 444 5566</p>
								<p>info@supera.com</p>
							</div>
							<div class="right-block">
								<p>North America - +1 777 111 2233</p>
								<p>Europe - +2 888 444 5566</p>
								<p>info@supera.com</p>								
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>			
			</div>
		</div>
	</div>
</div>

<?php wp_footer(); roots_footer() ?>
<script src="<?php echo get_stylesheet_directory_uri();?>/js/jquery.sidr.min.js"></script>
<script>
jQuery(document).ready(function($) {
	$('.site-header .primary-menu .menu-item a:last').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {	
			  var target = $(this.hash);
			  target = target.length ? target : $('.' + this.hash.slice(1));
			  if (target.length) {
				$('html, body').animate({
				  scrollTop: target.offset().top
				}, 1000);
				return false;
			  }
			}
	  });
});
</script>
</body>
</html>