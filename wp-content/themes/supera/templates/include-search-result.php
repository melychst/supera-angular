<?php
	$title = get_the_title();
	$link = get_permalink();
	$excerpt = wp_trim_words(get_the_content(), 65, null);
	if($i==0) { $class = " first"; }
	else { $class = ""; }
?>

<div class="search-result<?php echo $class ?> clearfix">
	<div class="text-heading clearfix">
	   	<h4><?php echo "<a href='{$link}' title='Read more about {$title}'>{$title}</a>" ?></h4>
    </div>
	<div class="search-result-main-content clearfix">
		<div class="main-text">
			<?php the_excerpt();?>
		</div>
		<a class="readmore" href='<?php echo $link ?>' title='Read more about <?php echo $title ?>'>Read more</a>
	</div>
</div>

<?php $i++; ?>