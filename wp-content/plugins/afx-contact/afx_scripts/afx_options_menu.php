<?php
class AFX_Options_Menu {
    function __construct() {
        add_action('admin_menu', array($this, 'admin_actions'));
    }    
       
    function admin_actions() {  
       add_submenu_page( 'options-general.php', 'AFX Plugin Options', 'AFX Plugin Options', 'manage_options', 'afx-options',array($this, "options_ui"));  
    }
    
    function options_ui() {
        echo "&copy; AFX Design Ltd";
    }
}