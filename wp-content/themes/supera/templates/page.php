<?php $domain = site_url()."/"; the_post(); ?>
<?php
$imageUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<div class="">
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
			</div>
		</div>
	</div>
</div>