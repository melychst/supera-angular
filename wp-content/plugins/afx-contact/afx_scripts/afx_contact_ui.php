<?php
class AFX_Contact_Ui {
    
    function __construct() {
        add_action('admin_menu', array($this, 'admin_actions'));
        
        //Email templates
        $post_type = new AFX_Post_Type('email_template');
        $post_type->setLabels("Email Template");
        $post_type->setPublic(false);
        $post_type->setSupports( array('title') );
        $post_type->setShowInMenu("afx_contact");
        
        add_action("add_meta_boxes", array($this, 'post_meta'));
        add_action('save_post',array($this, 'save_post'));
        
        add_filter('manage_afx_email_template_posts_columns' , array($this, 'addColumns'));
        add_action( 'manage_afx_email_template_posts_custom_column' , array($this, 'customColumns'), 10, 2 );
    }
    
    function admin_actions() {  
       add_menu_page('Email Contact', 'Email Contacts', 'edit_posts', 'afx_contact', array($this, 'contact_ui'), AFX_CONTACT_URL.'icon.png', '19');
       add_submenu_page("afx_contact", "Email Contact", "Email Contacts", 'edit_posts', 'afx_contact_main', array($this, 'contact_ui'));
    }    
     
	function contact_ui() {
		$contacts = new AFX_Contact_Model();
		$args = "";
		$contacts = $contacts->getContacts($args);		
		include(AFX_CONTACT_DIR.'afx_views/contact_ui.php');
	}
	
	function addColumns($columns) {
        $new = array();
        foreach($columns as $key => $title) {
            if ($key=='date') $new['afx_template'] = _('Template');
            $new[$key] = $title;
        }
        return $new; 
	}
	
	function customColumns($column, $post_id) {
        if($column == 'afx_template') {
            echo get_post_meta( $post_id, 'afx_email_template_type', true );
        }	
	}
	
	function post_meta() {
         add_meta_box( "afx_email_templates_post", 'Templates', array($this,'meta_render'), 'afx_email_template', "normal",
                "high");    
        
    }
    
    function meta_render($post) {
        include(AFX_CONTACT_DIR.'afx_views/templates_ui.php');
    }
    
    function save_post($post_id) {
        
        // Check if our nonce is set.
        if ( ! isset( $_POST['afx_email_template_post_meta_nonce'] ) )
            return $post_id;
        
        
        $nonce = $_POST['afx_email_template_post_meta_nonce'];
        
        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $nonce, 'afx_email_template_post_meta' ) )
          return $post_id;
          
        
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return $post_id;
        
        
        // Check the user's permissions.
        if(isset($_POST['post_type']) && $_POST['post_type'] == 'afx_email_template') {
        
            $footer = $_POST['afx_email_footer'];           
            update_post_meta( $post_id, 'afx_email_footer', $footer );
        }
    }
       
}
