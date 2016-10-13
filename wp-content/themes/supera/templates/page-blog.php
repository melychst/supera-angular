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

	<div class="blog-main-content">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="blog-items">

					<?php
						$args = array(
								"post-type" => "post",
								'post_per_page' => -1,
								);

						$posts = new WP_Query($args);

						if ($posts->have_posts() ) :

							while ( $posts->have_posts() ) : $posts->the_post();

					?>
						<div class="article-item">
							<div class="header-article">
								<div class="date">
									<div class="day">
										<span><?php echo get_the_date('d')?></span>
									</div>
									<div class="month">
										<span><?php echo get_the_date('M')?></span>
									</div>
								</div>
								<div class="title">
									<?php the_title(); ?>
								</div>
								<div class="clear"></div>
							</div>
							<div class="content-article">
								<?php the_excerpt();?>
							</div>
							<div class="read-more">
								<a href="<?php the_permalink(); ?>"><i  class="icon ion-chevron-right" aria-hidden="true"></i>read more</a>
							</div>
						</div>

						<?php 
						endwhile;
						wp_reset_postdata();
						endif;
						?>

					</div>
				</div>
				<div class="col-md-4">
				 	<div class="search-archive">
						<div class="search-form">
							<form action="<?php bloginfo( 'url' ); ?>" method="get">
								<input  type="text" name="s" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>" placeholder="Search archive"/>
								<button><i class="icon ion-android-search"></i></button>
							</form>						
						</div>				 	
					 	<div class="archive">
						 	<?php 
								wp_get_archives('type=monthly&format=html&echo=1');
							 ?>
					 	</div>				 	
				 	</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script>
	
(function ($) {

	$(function () {

		$(".search-archive .archive li a").click(function (event) {
			event.preventDefault();
			$.post(
				window.wp_data.ajax_url,
				{
					action:"get_posts",
					arch:$(this).attr("href"),
				},
			    function(data){
			        $('.blog-main-content .blog-items').html( data);
			    }
			);
		})
	})

}(jQuery));

</script>