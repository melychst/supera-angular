<?php
class AFX_Posts_Ui {
    function __construct() {
      add_action('init', array($this, 'afx_create_taxonomies'));      
    }
    
    function afx_filter_posts() {
        global $typenow;
        global $post;

        $args=array( 'public' => true, '_builtin' => false );
        $post_types = get_post_types($args);
        if ( in_array($typenow, $post_types) ) {
            $filters = get_object_taxonomies($typenow);
            foreach ($filters as $tax_slug) {
                if(strpos($tax_slug,"afx")!==false) {
                    $tax_obj = get_taxonomy($tax_slug);
                    if(isset($_GET[$tax_obj->query_var])) $selected = $_GET[$tax_obj->query_var];
                    else $selected = -1;
                    echo " <a href='edit-tags.php?taxonomy={$tax_slug}&post_type={$typenow}' class='add-new-h2' style='float: left; top:-1px;padding: 6px 8px; margin-right: 4px;'>Manage categories</a> ";
                    $drop = array(
                        'show_option_all' => __('Show All '.$tax_obj->label ),
                        'taxonomy' => $tax_slug,
                        'name' => $tax_obj->name,
                        'orderby' => 'name',
                        'selected' => $selected,
                        'hierarchical' => $tax_obj->hierarchical,
                        'show_count' => false,
                        'hide_if_empty' => true
                    );
	                wp_dropdown_categories($drop);
                    
                    
                    
                }
            }
       }
    }
    
    function afx_filter_query($query) {
        global $pagenow;
        global $typenow;
        if ($pagenow=='edit.php') {
            $filters = get_object_taxonomies($typenow);
            foreach ($filters as $tax_slug) {
                $var = &$query->query_vars[$tax_slug];
                if ( isset($var) ) {
                    $term = get_term_by('id',$var,$tax_slug);
                    $var = $term->slug;
                }
            }
        }
        return $query;
    }
    
    function afx_create_taxonomies()  {
        add_action( 'restrict_manage_posts', array($this, 'afx_filter_posts') );
        add_filter('parse_query',array($this, 'afx_filter_query'));
        //Setup styles for new column
        add_action('admin_head',array($this, 'afx_column_widths'));
        
        $args=array( 'public' => true, '_builtin' => false );
        $post_types = get_post_types($args);
        foreach($post_types as $post_type) {
           if(strpos($post_type, "afx")!==false) { 
               //Check if there are post taxonomies
               $post_taxonomies = get_object_taxonomies($post_type);
               if(!empty($post_taxonomies)) {
                   add_filter("manage_{$post_type}_posts_columns", array($this, 'afx_columns_head'));
                   //add_action("manage_pages_custom_column", array($this, 'afx_columns_content'), 10, 2);
                   add_action("manage_{$post_type}_posts_custom_column", array($this, 'afx_columns_content'), 10, 2);    
               }
           }
           
        }        
    }
    
    function afx_columns_head($columns) {
        $new = array();
        foreach($columns as $key => $title) {
            if ($key=='date') $new['afx_categories'] = 'Categories';
            $new[$key] = $title;
        }
        return $new;        
    }
    
    function afx_columns_content($column_name,$post_id) {
        if($column_name == 'afx_categories') {
            $post_type = get_post_type( $post_id );
            $post_taxonomies = get_object_taxonomies($post_type);
            foreach($post_taxonomies as $taxonomy) {
                $terms = get_the_terms($post_id, $taxonomy);
                if(!empty($terms)) {
                    foreach($terms as $term) {
                        echo "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->term_id}'>{$term->name}</a> ";
                    }
                }
            }            
        }
    }
    
    function afx_column_widths() {
        echo "<style type='text/css'>";
        echo "th.column-afx_categories { width: 100px; }";
        echo "</style>";
    }    
}