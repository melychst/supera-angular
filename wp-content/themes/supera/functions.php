<?php
	//AFX AUTOLOADER
function afx_autoload($class) {
	$class = strtolower($class);
	if(strpos($class,"widget") === 0) {
	    $class = str_replace('widget_', '', $class );
	    $classfile = locate_template('/templates/widgets/'.$class.'.php');
	} else { $classfile = locate_template('/afx_scripts/'.$class.'.php'); }
    if(file_exists($classfile)) include $classfile;
}
spl_autoload_register('afx_autoload');
function afx_site_setup()
{

	global $domain;
	$domain = site_url();

	//load_theme_textdomain('compass-executives', get_template_directory().'/languages');
	
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');
	//add_theme_support('automatic-feed-links');
	//add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));
	add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

	register_nav_menus(array(
		'top-menu' => 'Top Menu',
		'main-menu' => 'Main Menu',
		'bottom-menu' => 'Bottom Menu'
	));
	
	/*
		if(function_exists('acf_add_options_page'))
		{
			acf_add_options_page(array(
				'page_title' => 'Theme Options',
				'menu_title'	=>	'Options',
				'menu_slug' => 'theme-options',
				'capability' => 'edit_posts',
				'redirect' => false
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Sub-Options',
				'menu_title'	=> 'Sub-Options',
				'parent_slug' => 'theme-options',
			));
		}
		
	}
	add_action('after_setup_theme', 'afx_site_setup');
*/
}
add_action('after_setup_theme', 'afx_site_setup');
require_once get_template_directory().'/inc/scripts.php';
require_once get_template_directory().'/inc/post-types.php';
require_once get_template_directory().'/inc/extras.php';
require_once get_template_directory().'/inc/util.php';            // Utility functions
require_once get_template_directory().'/inc/actions.php';            // Utility functions
require_once get_template_directory().'/inc/hooks.php';            // Utility functions


//Display banner section
function home_page_banner() {
 
    // start by setting up the query
    $query = new WP_Query( array(
        'post_type' => 'afx_banner',
    ));
 
    // now check if the query has posts and if so, output their content in a banner-box div
    if ( $query->have_posts() ) { ?>
		 <?php while ( $query->have_posts() ) : $query->the_post();
			 if( have_rows('banners') ):
				?>
				<div id="main-carousel" class="owl-carousel ">
				<?php 
					while ( have_rows('banners') ) : the_row();
						$image = get_sub_field('banner_image');
				?>
					<div>
						<div class="banner-text">
							<div class="small-heading"><?php echo get_sub_field('banner_small_heading');?></div>
							<div class="big-heading"><?php echo get_sub_field('banner_heading');?></div>
							<div class="description"><?php echo get_sub_field('banner_text');?></div>
						</div>
						<div class="banner-image" style="background-image: url('<?php echo $image['url'];?>');"></div>
					</div>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
		<?php endwhile; ?>
    <?php }
    wp_reset_postdata();
 
}
add_theme_support('post-thumbnails');

/**
 * Tell WordPress how to interpret our project URL structure
 *
 * @param array $rules Existing rewrite rules
 * @return array
 */
function so23698827_add_rewrite_rules( $rules ) {
  $new = array();
  $new['facilities/facility/(.+)/?$'] = 'index.php?afx_facility=$matches[1]';

  return array_merge( $new, $rules ); // Ensure our rules come first
}
add_filter( 'rewrite_rules_array', 'so23698827_add_rewrite_rules' );

function enable_more_buttons($buttons) {

$buttons[] = 'fontselect';
$buttons[] = 'fontsizeselect';
$buttons[] = 'styleselect';
$buttons[] = 'backcolor';
$buttons[] = 'newdocument';
$buttons[] = 'cut';
$buttons[] = 'copy';
$buttons[] = 'charmap';
$buttons[] = 'hr';
$buttons[] = 'visualaid';

return $buttons;

}
add_filter("mce_buttons_3", "enable_more_buttons");


function pagination($pages = '', $range = 4) {  
     $showitems = ($range * 2)+1;  
 
     global $paged;
     if(empty($paged)) $paged = 1;
 
     if(1 != $pages)    {
        echo "<div class='pagination'>";

 		if ($paged == 1) {
         	echo "<span class='first-page'>PREV</span>";
 		} else {
 			$prev = $paged - 1;
 			echo "<span class='prev_page'><a href='".get_pagenum_link($prev)."'>Prev</a></span>";
 			}

         
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                echo "<div class='page-num'>";
                 if ( $paged == $i ) {
 					echo "<span class='active-page'>".$i."</span>";
                 } else {
                 	echo "<a href='".get_pagenum_link($i)."' class='link-page'>".$i."</a>";
                 }
                 echo "</div>";
             }
         }


 		if ($paged == $pages) {
			echo "<span class='last-page'>Next</span>";					
 		} else {
 			$prev = $paged - 1;
          	echo "<span class='next_page'><a href='".get_pagenum_link($paged + 1)."'>NEXT</a></span>";
 			}
         echo "</div>\n";
     }
}

function new_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'new_excerpt_length');

add_filter('excerpt_more', function($more) {
    return ' ...';
});


function js_variables(){
    $variables = array (
        'ajax_url' => admin_url('admin-ajax.php'),
  		'is_mobile' => wp_is_mobile()
    );
    echo(
        '<script type="text/javascript">window.wp_data = '.
        json_encode($variables).
        ';</script>'
    );
}
add_action('wp_head','js_variables');

function get_posts_callback () {
	$link_html = $_POST['arch'];


	$arr = explode ( '/' , $link_html );
    $year  = $arr[count($arr) - 3];
    $month = $arr[count($arr) - 2];

	$args = array(
			'post_type' => 'post',
			'paged' => $paged,
			'year' => $year,
			'monthnum' => $month,
			'caller_get_posts'=> 1,
			);

	$posts = new WP_Query ($args);

		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) { $posts->the_post();

				echo "<div class='article-item'>";
					echo "<div class='header-article'>";
					echo	"<div class='date'>";
					echo		"<div class='day'>";
					echo 			"<span>".get_the_date('d')."</span>";
					echo		"</div>";
					echo 		"<div class='month'>";
					echo			"<span>".get_the_date('M')."</span>";
					echo		"</div>";
					echo	"</div>";
					echo	"<div class='title'>";
								the_title();
					echo	"</div>";
					echo	"<div class='clear'></div>";
					echo "</div>";
					echo "<div class='content-article'>";
							the_excerpt();
					echo "</div>";
					echo "<div class='read-more'>";
					echo	"<a qqq href='"; the_permalink(); echo "'><i  class='icon ion-chevron-right' aria-hidden='true'></i>read more</a>";
					echo "</div>";
				echo "</div>";
			}
		}
wp_die();
}

add_action('wp_ajax_get_posts'       , 'get_posts_callback');
add_action('wp_ajax_nopriv_get_posts', 'get_posts_callback');