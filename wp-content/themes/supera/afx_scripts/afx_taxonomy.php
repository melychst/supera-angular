<?php
class AFX_Taxonomy {
      var $prefix = "afx_";
      var $taxonomy = "";
      var $post_types = array();
      var $args = array();
      
      function __construct($taxonomy, $post_types) {
          $this->taxonomy = strtolower($taxonomy);
          
          foreach($post_types as $key => $pt) {
              if(strpos($pt, 'afx')===false && $pt != "attachment" && $pt != "post") {
                  $post_types[$key] = "afx_{$post_types[$key]}";
              }
          }          
          $this->post_types = $post_types;
          
          $this->args = array(
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => $this->taxonomy, 'with_front' => false,'hierarchical'=> true  ), // plural
            'show_admin_column' => true
          );
          $this->args['label'] = ucfirst($taxonomy);
          add_action('init', array($this, 'afx_add_taxonomy'));
      }
      
      function setLabels($item = "", $singular = "Category", $plural = "Categories") {
      	  $this->args['labels'] = array(
    	    'name' => _x( $plural, $plural ),
    	    'singular_name' => _x( $singular, $singular ),
    	    'search_items' =>  __( 'Search '.$plural ),
    	    'all_items' => __( 'All '.$plural ),
    	    'parent_item' => __( 'Parent '.$singular ),
    	    'parent_item_colon' => __( 'Parent '.$singular.':' ),
    	    'edit_item' => __( 'Edit '.$singular ), 
    	    'update_item' => __( 'Update '.$singular ),
    	    'add_new_item' => __( 'Add New '.$singular ),
    	    'new_item_name' => __( 'New '.$singular.$item ),
    	    'menu_name' => __( $plural ),
    	  );
    	  unset($this->args['label']);
      }
      
      function afx_add_taxonomy() {
          register_taxonomy($this->prefix.$this->taxonomy,$this->post_types, $this->args);
          foreach($this->post_types as $post_type) {
             register_taxonomy_for_object_type( $this->prefix.$this->taxonomy, $post_type ); 
          }
          
      }      
      
  }