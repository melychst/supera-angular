<?php
class AFX_Post_Type {
  var $prefix = "afx_";
  var $post_type;
  var $args = array();
  
  function __construct($name, $taxonomies = false) {
      $this->post_type = strtolower($name);
      
      
      $this->args = array(
        'public' => true,
        'publicly_queriable' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'query_var' => true,
        'menu_position' => 5,
        'rewrite' => array( 'slug' => $name, 'with_front' => false ), // plural
      );
      $this->setLabels($name);
      
      if(is_array($taxonomies)) {
          foreach($taxonomies as $key => $tax) {
              if(strpos($tax, 'afx')===false) {
                  $taxonomies[$key] = "afx_{$taxonomies[$key]}";
              }
          }    
      }
      
      
      if(is_array($taxonomies)) $this->args['taxonomies'] = $taxonomies;
      add_action('init', array($this, 'afx_add_post_type'));
  }
  
  function setRewrite($rewrite)
  {
	$this->args['rewrite'] = $rewrite;
  }
  
  function setPublic($public) {
      $this->args['public'] = $public;
  }
  
  function setLabels($name,$plural=false) {
      $name = strtolower($name);
      if(!$plural) $plural = $name."s";
      $ucname = ucfirst($name);
      $ucplural = ucfirst($plural);
      
      $this->args['labels'] = array(
        'name' => $ucplural,
        'singular_name' => $ucname,
        'add_new' => 'Add New',
        'add_new_item' => 'Add New '.$ucname,
        'edit_item' => 'Edit '.$ucname,
        'new_item' => 'New '.$ucname,
        'all_items' => 'All '.$ucplural,
        'view_item' => 'View '.$ucname,
        'search_items' => 'Search '.$ucplural,
        'not_found' =>  'No '.$name.' found',
        'not_found_in_trash' => 'No '.$plural.' found in Trash', 
        'parent_item_colon' => '',
        'menu_name' => $ucplural
      );
  }
  
  function setSupports($supports) {
      $this->args['supports'] = $supports;
  }
  
  function setShowInMenu($menu) {
      $this->args['show_in_menu'] = $menu;
  }
  
  function setHierachical($value) {
      $this->args['hierarchical'] = $value;
  }
  
  function afx_add_post_type() {
      register_post_type($this->prefix.$this->post_type,$this->args);
  }
  
  
  
}