<?php
	$bgHeader = get_the_post_thumbnail_url();
?>

<div class="basic-page page">
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
	
	<div class="main-content">
	
	<?php 
	if ( get_field("show_text_block") == true ) {
	?>

		<div class="text-block">
			<div class="container">
				<div class="text-item">	
					<div class="row">
						<div class="col-md-5">
							<div class="image-block">
								<?php 
									$img = get_field("image_text_block");
									$imgUrl = $img['url'];
									$imgAlt =  $img['alt'];
								?>
								<img src="<?php echo $imgUrl; ?>" alt="<?php echo $imgAlt; ?>">
							</div>	
						</div>
						<div class="col-md-7">
							<div class="content-block">
								<div class="heading-top-title-line"></div>
								<div class="title-block">
									<h3><?php echo get_field("title_text_block")?></h3>
								</div>
								<div class="content">
									<?php echo get_field("content_text_block")?>
								</div>
								<div class="author">
									<?php 
										$authorImg = get_field("author_img");
										$authorUrl = $authorImg['url'];
										$authorAlt = $authorImg['alt'];
									?>
									<img src="<?php echo $authorUrl; ?>" alt="<?php echo $authorAlt; ?>">
									<div class="author-data">
										<p><?php echo get_field("author_name")?></p>
										<p><?php echo get_field("author_position")?></p>
									</div>
								</div>
							</div>
						</div>					
					</div>
				</div>
			</div>		
		</div>
		
		<?php 
		}
		?>

		<div class="feature-block">
			<div class="container">
				
				<div class="row">
					<div class="col-md-12">
						<div class="promotion-text">
							<?php echo get_field("promotion_content"); ?>	
						</div>
					</div>
				</div>

				<?php 

					if ( (get_field("features_items") != 0 ) && (get_field("show_features_block") == true) ) {
				
					$featuresItems = get_field("features_items") ;
					$count = 1;
						foreach ($featuresItems as $key => $value) {
							if ($count%2 != 0 ) {
				?>

				<div class="row left-feature-item">
					<div class="feature-item">
						<div class="col-md-4">
							<div class="title-feature">
								<?php  echo $value['title']?>
							</div>
						</div>
						<div class="col-md-8">
							<div class="content-feature">
								<?php echo $value['content'] ?>						
							</div>
						</div>
						<div class="clear"></div>				
					</div> 
				</div>
				
				<?php 
					} else { 
				?>

				<div class="row right-feature-item">
					<div class="feature-item">
						<div class="col-md-8">
							<div class="content-feature">
								<?php echo $value['content'] ?>						
							</div>					
						</div>
						<div class="col-md-4">
							<div class="title-feature">
								<?php  echo $value['title']?>
							</div>
						</div>
						<div class="clear"></div>				
					</div> 
				</div>

				<?php 
					}
				?>

				<?php 
					$count++;
						}
					}
				?>

			</div>
		</div>

		<div class="logo-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title-section">
							<p><?php echo get_field("description_text"); ?></p>
							<p><span><?php echo get_field("main_text"); ?></span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>