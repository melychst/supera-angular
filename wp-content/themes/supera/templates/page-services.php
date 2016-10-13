<?php
	$bgHeader = get_the_post_thumbnail_url();
?>

<div class="page">
	<div class="header-page" style="background-image:url(<?php echo $bgHeader; ?>)">
		<div class="container">
			<div class="row">
				<div class="col-md-8 banner">
					<div class="banner-content">
						<div class="page-title">
							<?php the_title()?>
						</div>
						<div class="title-banner">
							<h1><?php echo get_field("title_banner");?></h1>
						</div>
						<div class="description-banner">
								<?php echo get_field("description_banner");?>
						</div>
					</div>
					<div class="banner-button">
						<a href="<?php echo get_field("link_cta_button") ?>"><?php echo get_field("title_cta_button");?></a>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<div class="services-page-content">
		<div class="container">
			<div class="row">
				<div class="text-block">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<div class="title">
							<?php echo get_field("title");?>
						</div>
					</div>
				</div>				
			</div>

			<div class="row">
				<div class="text-block">
					<div class="col-md-2">
						<div class="icon-text-block">
						<?php 
							$icon = get_field("icon-text-block");
							$iconUrl = $icon['url'];
							$iconAlt = $icon['alt'];
						?>
							<img src="<?php echo $iconUrl ?>" alt="<?php echo $iconAlt ?>">
						</div>
					</div>
					<div class="col-md-10">
						<div class="content-block">
							<div class="description">
								<?php echo get_field("description");?>
							</div>
						</div>
					</div>
				</div>				
			</div>			
			
			<div class="row">
				<div class="services-block">

					<?php
						$args = array(
							"post_type" => "afx_service",
							);

						$services = new WP_Query($args);
						
						if ( $services->have_posts() ) :
							while( $services->have_posts() ) : $services->the_post(); 
					?>

					<div class="service-item">
						<div class="col-md-3">
							<div class="icon-service">
								<?php 
								  $iconService = get_field("image");
								  $iconServiceUrl = $iconService['url'];
								 ?>

								 <img src="<?php echo $iconServiceUrl ?>">
							</div>
							<div class="title-service">
								<?php echo get_field("title");?>
							</div>
						</div>
						<div class="col-md-9">
							<div class="description">
								<?php echo get_field("description"); ?>
								<div class="accordion">
									<?php
										if ( get_field("acordion_list") ) {
											$accordion_items = get_field("acordion_list");
											foreach ($accordion_items as $key => $value) {
									?>
										
										<div class="acardeon_item">
											<div class="title_item">
												<span><i class="fa fa-plus" aria-hidden="true"></i><?php echo $value['title'] ?></span>
											</div>
											<div class="descript_item">
												<p><?php echo $value['description'] ?></p>
											</div>
										</div>

									<?php
											}		
										}
									?>
								</div>
								<div class="button-link">
									<a href="<?php echo get_field("link_url")?>"><?php echo get_field("link_text")?></a>
								</div>							
							</div>
						</div>
						<div class="clear"></div>
					</div>

					<?php 
							endwhile;
							wp_reset_postdata();
						endif;
					?>

				</div>
			</div>
			
		</div>

	</div>

	<div class="logo-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title-section">
						<p><?php echo get_field("logo_section_description_text")?></p>
						<p><span><?php echo get_field("logo_section_main_text")?></span></p>
					</div>
				</div>
			</div>
		</div>
	</div>	

</div>
