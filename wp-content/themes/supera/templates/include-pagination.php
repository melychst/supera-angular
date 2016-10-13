<?php
	$domain = site_url();
	
	if(get_previous_posts_link() || get_next_posts_link()) {
		$page_links = '';
		if(is_category()) {
			$category = get_category($cat);
			$slug = "category/{$category->slug}";
		} else if(is_tax()) {
			$taxonomy = $wp_query->tax_query->queries[0]['taxonomy'];
			$term = $temp_term = get_queried_object();
			$slug = $term->slug;
			if($term->parent != 0) {
				while(isset($temp_term->parent)) {
					$temp_term = get_term($temp_term->parent, $taxonomy);
					$slug = $temp_term->slug.'/'.$slug;
				}
			} else $slug = '/'.$slug;
			$taxonomy = str_replace('afx_', '', $taxonomy);
			$slug = $taxonomy.$slug;
		} else if(is_author()) {
			$author = get_the_author();
			$slug = "author/{$author}";
		} else if(is_search()) {
			$query = get_search_query();
			$slug = "search/{$query}";
		} else if(is_archive()) $query = $slug = get_query_var('year');
		else { 
			$slug = $pagename;
			 $page = $post;
			if($page->post_parent != 0) {
				$parent = get_page($page->post_parent);
				$slug = $parent->post_name.'/'.$slug;
			}
		}
		
		$pages = ceil($wp_query->found_posts / get_option('posts_per_page'));
		
		if($paged <= 4) {
			for($i = 1; $i <= 7 && $i <= $pages; $i++) {
				$class = '';
				if($i == $paged || (!is_paged() && $i == 1)) $class = ' selected';
				$page_links .= "<li class='page'><a class='number{$class}' href='{$domain}/{$slug}/page/{$i}/' title='Jump to page {$i}'>{$i}</a></li>";
			}
		} else {
			for($i = ($paged - 3); $i <= ($paged + 3) && $i <= $pages; $i++) {
				$class = '';
				if($i == $paged) $class = ' selected';
				$page_links .= "<li class='page'><a class='number{$class}' href='{$domain}/{$slug}/page/{$i}/' title='Jump to page {$i}'>{$i}</a></li>";
			}
		}
		
		$previous_link = get_previous_posts_page_link();
		$next_link = get_next_posts_page_link();
		if($previous_link) $previous = "<a href='{$previous_link}' title='View the previous page'><div class='arrow-left'></div></a>";
		else $previous = "<li class='previous'><img src='{$domain}/img/arrow-blue-left.png' alt='Previous' /></li>";
		if($next_link) $next = "<a href='{$next_link}' title='View the next page'><div class='arrow-right'></div></a>";
		else $next = "<li class='next'><img src='{$domain}/img/arrow-blue.png' alt='Next' /></li>";
		
		echo '<div class="pagination-holder clearfix">
		      <div class="pagination clearfix">';
		echo "{$previous}<ul class='blog-pagination'> {$page_links} </ul>{$next}";
		echo '</div></div>';
	}