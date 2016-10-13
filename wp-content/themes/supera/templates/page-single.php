<?php $domain = site_url()."/"; the_post(); ?>
<?php
$imageUrl = get_field('banner_image');//wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<div>
	<div class="page-single">
		<div class="container">
		<?php
			if ($imageUrl):
			?>
			<div class="top-image" style="background-image: url('<?php echo $imageUrl;?>');">
			</div>
		<?php endif; ?>
			<h2><?php the_title();?></h2>
			<div class="main-content">
				<?php the_content(); ?>
				
				
				<?php 

				$images = get_field('gallery');
				$i = 0;
				if( $images ): ?>
				<div class="facility-gallery">	
						<?php foreach( $images as $image ): ?>
							<div class="fimg" >
								<a href="#" onclick="productPopup('<?php echo $i;?>');">
									 <img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" />
								</a>
								<p><?php echo $image['caption']; ?></p>
							</div>
						<?php 
						$i++;
						endforeach; ?>
					
				</div>	
				<?php endif; ?>
				
				


				<div class="back-link">
					<span class='back_page'><a href="<?php echo $_SERVER['HTTP_REFERER']?>">BACK</a></span>
				</div>


			</div>
		</div>
	</div>
</div>

<div class="facility-image-cover" style="display: none;">
	<div class="facility-image-popup">
		<a class="facility-image-close-btn"><img src="<?php echo get_stylesheet_directory_uri();?>/img/close-x.png"></a>
		<div class="facility-image-carousel owl-carousel">
		<?php
			$images = get_field('gallery');
			$i=0;
			foreach($images as $image):
					$_image = $image;
					if (is_array($_image))
					{
						if(isset($_image['sizes']['full'])) {
        					$image = $_image['sizes']['full'];	
						} if(isset($_image['sizes']['large'])) {
    				        //print_r($_image['sizes']);
    				        $image = $_image['sizes']['large'];
    				    } //else print_r($_image['sizes']);
						
					}
					else {
						$img = wp_get_attachment_image_src( $_image, 'full');
						$image = $img[0];
					}
		?>
			<img src="<?php echo $image;?>"/>
		<?php
			$i++;
			endforeach;
		?>
		</div>
		<script>
			jQuery(document).ready(function(){
				jQuery(".facility-image-carousel").owlCarousel({
					singleItem: true,
					navigation: true,
					pagination: true,
					navigationText : ["&nbsp;","&nbsp;"],
					slideSpeed: 500,
					rewindSpeed: 500,
				});
			});
			jQuery(".facility-image-close-btn").click(function(){
				jQuery(".facility-image-cover").hide();
			});
			function productPopup(item){
				var owl = jQuery(".owl-carousel").data('owlCarousel');
				owl.jumpTo(item);
				jQuery(".facility-image-cover").show();
			}
		</script>
	</div>
</div>