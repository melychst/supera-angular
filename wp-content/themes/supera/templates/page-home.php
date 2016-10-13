<?php $domain = site_url()."/" ?>

<div class="home">
	<div class="banner hide-phone">
		<div class="container">
			<div class="bkg" style="background-image: url(<?php echo get_stylesheet_directory_uri();?>/img/bg-banner.png); height: 400px;">
				<div class="small-container">
					<div class="banner-text">A New Smart Booking Platform<br/>for Aviation & Travel Services.<br/>
					<button class="btn btn-black">coming soon</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="signup">
		<div class="container">
			<div class="small-container">
				<div class="col-lg-5 col-md-5 signup-text">
					<div class="headline">Tell me when it's out</div>
				</div>
				<?php echo do_shortcode("[epm_mailchimp]"); ?>
			</div>
		</div>
	</div>
	<div class="services">
		<div class="container container-gray">
			<div class="small-container">
				<div class="col-lg-12 col-md-12 services-text">We Provide a Complete Service</div>
				<?php
				if( have_rows('services') ):

					// loop through the rows of data
					while ( have_rows('services') ) : the_row();
					$image = get_sub_field('service_image');
				?>
				<div class="col-lg-4 col-md-4 service">
					<div class="img"><img src="<?php echo $image['url']; ?>"></div>
					<div class="heading"><?php echo get_sub_field('service_heading');?></div>
					<div class="details"><?php echo get_sub_field('service_description');?></div>
					<!--<div class="button"><a class="btn btn-gray" href="Details">Details</a></div>-->
				</div>
				<?php
					endwhile;
				endif;
				?>
			</div>
		</div>
	</div>
	<div class="itworks">
		<div class="container container-gray">
			<div class="small-container">
				<div class="col-lg-12 col-md-12 heading">It Just Works</div>
				<div class="col-lg-12 col-md-12 explanation">The most amazing thing about us is the innovation that goes into driving our technology forward. In order for charter operators to be competitive in the 21st century, someone had to innovate a system to accomplish that.
				Supera Aviation is proud to announce that our team has developed the world's first B2C/B2B system for jet charter operators that is simple, faster and smarter.</div>
				<div class="col-lg-12 col-md-12 boxes">
					<div class="col-lg-2 col-md-2 box">Quotes are not estimated. What you see is what you pay.</div>
					<div class="col-lg-2 col-md-2 box">Our automated sourcing delivers powerful empty leg marketing capability.</div>
					<div class="col-lg-2 col-md-2 box">We deliver fastest response times possible for flight requests, usually within 60 seconds.</div>
					<div class="col-lg-2 col-md-2 box">True, verifiable and accurate real-time aircraft availability and monitored 24/7.</div>
					<div class="col-lg-2 col-md-2 box">Powerful and flexible pricing system.</div>
					<div class="col-lg-2 col-md-2 box">Prices can be set according to customer requirements, lower prices for flexible customers.</div>
				</div>
			</div>
		</div>
	</div>
</div>