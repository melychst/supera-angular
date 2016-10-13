<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Compass_Executives
 */

?>
<?php $domain = site_url()."/"; the_post(); ?>
<?php
$imageUrl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<div class="">
	<div class="about">
		<div class="container">
			<h2>Oops! That page can&rsquo;t be found.</h2>
			<div class="main-content">
				<?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'compass-executives' ); ?>
			</div>
		</div>
	</div>
</div>
