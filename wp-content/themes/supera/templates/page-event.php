<?php $domain = site_url()."/"; the_post();?>

<?php
	$bgHeader = get_the_post_thumbnail_url();

	$bgBanner = get_field("background_image");
	$bgBannerUrl = $bgBanner['url'];
?>

<div class="event-page page">
	<div class="header-page-event" style="background-image: url(<?php echo $bgHeader; ?>)">
		<div class="container">
			<div class="row">
				<div class="col-md-12 banner" style="background-image: url(<?php echo $bgBannerUrl; ?> ">
					<div class="banner-content">
						<div class="content-block">
							<div class="title-banner">
								<h1><?php the_title()?></h1>
							</div>
							<span><?php echo get_field("description_banner")?></span>
						</div>
						<div class="button">
							<a href="<?php echo get_field("link_cta_button")?>"><?php echo get_field("title_cta_button")?></a>
						</div>						
					</div>

				</div>
			</div>
		</div>		
	</div>

	<div class="content-page-event">
		<div class="container">
			<div class="row">
				<div class="col-md-7 main-content">
					<div class="">
					<?php 
						the_content();
					?>						
					</div>
				</div>
				<div class="col-md-5 side-bar">
					<div class="side-bar-bg">
						<div class="side-bar-section">
							<div class="title-section">
								<p>flight choises<span>(departing from)</span></p>
							</div>
							<div class="list-section">
								
								<?php 
									for ($i = 0; $i < 4; $i++) {
								?>
								<div class="list-item">
									<div class="image-item">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/plaine.jpg"  alt="">
									</div>
									<div class="content-item">
										<div class="description">
											<p class="title">> New-York</p>
											<p class="description">dep. feb 27</p>
											<p class="description">2:30PM local time</p>
											<p class="text">7 hours flight</p>
										</div>
										<div class="button">
											<a href="#">$5,404 <span> ></span></a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								<?php 
									}
								?>
							</div>
						</div>

						<div class="side-bar-section">
							<div class="title-section">
								<p>hotel choises</p>
							</div>
							<div class="list-section">
								
								<?php 
									for ($i = 0; $i < 4; $i++) {
								?>
								<div class="list-item hotel">
									<div class="image-item">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/hotel_event.jpg"  alt="">
									</div>
									<div class="content-item">
										<div class="description">
											<p class="title">The Bouleard</p>
											<p class="title">Hotel palace</p>
											<p class="description">executive suite</p>
											<p class="text">4,5 stars</p>
										</div>
										<div class="button">
											<a href="#">$350,00<span> ></span></a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								<?php 
									}
								?>
							</div>
						</div>

						<div class="side-bar-section">
							<div class="title-section">
								<p>Other travel package</p>
							</div>
							<div class="list-section">
								
								<?php 
									for ($i = 0; $i < 2; $i++) {
								?>
								<div class="list-item hotel">
									<div class="image-item">
										<img src="<?php echo get_stylesheet_directory_uri()?>/img/othe_travel.jpg"  alt="">
									</div>
									<div class="content-item">
										<div class="description">
											<p class="title">Tribecs Film </p>
											<p class="title">Festival</p>
											<p class="description">New York City, NY</p>
											<p class="text">Aprile 2017</p>
										</div>
										<div class="button">
											<a href="#">+ DETAILS <span> ></span></a>
										</div>
									</div>
									<div class="clear"></div>
								</div>
								<?php 
									}
								?>
							</div>
						</div>						

					</div>
				</div>
			</div>
		</div>
	</div>


</div>