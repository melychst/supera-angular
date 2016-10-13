<?php
class AFX_Widget extends WP_Widget {
    function widget($args, $instance) {
        global $post;
        global $page;

        //Checks for widget control. If there is no control will display all by default
        $selectWidgets = get_field('select_widgets');
        if($selectWidgets) {
            $widgetId = $args['widget_id'];
            return in_array($widgetId, $selectWidgets);
        }
        return false;        
    }
}

class AFX_Widget_Init {
    var $widget_areas = array();
    var $widgets = array();
    var $unwidgets = array('WP_Widget_Pages','WP_Widget_Calendar','WP_Widget_Archives','WP_Widget_Links','WP_Widget_Meta','WP_Widget_Search','WP_Widget_Text','WP_Widget_Categories','WP_Widget_Recent_Posts','WP_Widget_Recent_Comments','WP_Widget_RSS','WP_Widget_Tag_Cloud','WP_Nav_Menu_Widget');
    
    function __construct() {
        add_action('widgets_init', array($this, 'afx_widget_init'));
        add_action('init', array($this, 'afx_add_fields'),99);
    }
    
    function afx_widget_init() {
        $this->afx_register_sidebars();
        $this->afx_register_widgets();
        $this->afx_unregister_widgets();
    }   
    
    function afx_register_sidebars() {
        foreach($this->widget_areas as $widget_area) {
            register_sidebar($widget_area);
        }
    }
    
    function afx_register_widgets() {
        foreach($this->widgets as $widget) {
            register_widget($widget);
        }
    }
    
    function afx_unregister_widgets() {
        foreach($this->unwidgets as $widget) {
            unregister_widget($widget);
        }
    }
    
    function addSidebar($name,$id,$before_widget='<section id="%1$s" class="widget %2$s"><div class="widget-inner">',$after_widget='<div class="clear20"></div>',$before_title='',$after_title='') {
        $sidebar = array();
        $sidebar['name'] = __($name, 'roots');
        $sidebar['id'] = $id;
        $sidebar['before_widget'] = $before_widget;
        $sidebar['after_widget'] = $after_widget;
        $sidebar['before_title'] = $before_title;
        $sidebar['after_title'] = $after_title;
        $this->widget_areas[] = $sidebar;
    }
    
    function addWidgets($widgets) {
        if(is_array($widgets)) {
            foreach($widgets as $widget) {
                $this->widgets[] = $widget;
            }
        } else $this->widgets[] = $widgets;
    }
    
    
    function afx_add_fields() {
        //Adding new widget fields using ACF
        if(function_exists("register_field_group")) {
        	$choices=array();
        	$defaults="";
        	$sidebars = wp_get_sidebars_widgets();
        	foreach($sidebars as $sidebar=>$widgets) {
            	foreach($widgets as $z=>$widget) {
            		$widget = str_replace(array('-', '_', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'), ' ', $widget);
            		$widget_words = explode(' ', $widget);
            		foreach($widget_words as $i=>$word) {
	            		$widget_words[$i] = ucfirst($word);
            		}
            		$widget = implode(' ', $widget_words);
                	if($z == 0) $sidebar_text = "({$sidebar})";
                	else $sidebar_text = "";
                	$choices["{$widget}"] = "{$widget} {$sidebar_text}";
                	$defaults .= "{$widget}\n";
            	}        	
        	}
        	$location = array(
            	array (
    				array (
    					'param' => 'post_type',
    					'operator' => '==',
    					'value' => 'post',
    					'order_no' => 0,
    					'group_no' => 0,
    				),
    			),
    			array (
    				array (
    					'param' => 'post_type',
    					'operator' => '==',
    					'value' => 'page',
    					'order_no' => 0,
    					'group_no' => 1,
    				),
    			),
			);
        	
        	$args=array( 'public' => true, '_builtin' => false );
            $post_types = get_post_types($args);
            foreach($post_types as $post_type) {
               if(strpos($post_type, "afx")!==false) {
                   $location[] = array(
                       array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => $post_type,
                            'order_no' => 0,
                            'group_no' => 0,
                        )
                    );
                    
               }
           }
        	register_field_group(array (
        		'id' => 'acf_widgets',
        		'title' => 'Widgets',
        		'fields' => array (
        			array (
        				'key' => 'field_519b4c0a91c8c',
        				'label' => 'Select Widgets',
        				'name' => 'select_widgets',
        				'type' => 'checkbox',
        				'instructions' => 'Choose the widgets to show on this page.<br /><a href="widgets.php">Manage widgets</a> ',
        				'multiple' => 0,
        				'allow_null' => 0,
        				'choices' => $choices,
        				'default_value' => $defaults,
        			),
        		),
        		'location' => $location,
        		'options' => array ( 'position' => 'side','layout' => 'default','hide_on_screen' => array ( ), ),
        		'menu_order' => 0,
        	));
        }        
    }
    
}