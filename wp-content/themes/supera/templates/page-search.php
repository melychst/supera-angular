<?php $domain = site_url().'/'; $options = 64; ?>
<div>
	<div class="search_results">
		<div class="container">
		<?php
			if ($imageUrl):
			?>
			<div class="top-image" style="background-image: url('<?php echo $imageUrl;?>');">
			</div>
		<?php endif; ?>
			<h2>Search Results for "<?php echo get_search_query() ?>"</h2>
			<div class="main-content">
				<?php 
				if(count($posts) > 0) {
					foreach($posts as $post) {
						setup_postdata($post);
						include("include-search-result.php");
						wp_reset_postdata();
						?>
						<div class="page_divider"></div>
						<?php
					}
				} else echo "There are no results.";
				?>
			</div>
		</div>
	</div>
</div>