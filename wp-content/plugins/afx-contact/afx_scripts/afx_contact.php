<?php
class AFX_Contact {
    var $admin_from;
    var $admin_to;
    var $admin_bcc;
    var $web_name;
    
    function __construct() {
        $this->admin_from = AFX_Contact_Options::getFrom();
        $this->admin_to = AFX_Contact_Options::getAdminEmail();
        $this->admin_bcc = AFX_Contact_Options::getBcc();
        $this->web_name = get_option('blogname','');
    }
    
    function mail($args) {
        global $post;
        $error = "";
        $type = "plain";

        if(! isset($args['content'])) return false;
        else {

            if(isset($args['template'])) {

                $search_args = array(
                	'post_type' => 'afx_email_template',
                	'meta_query' => array(
                		array(
                			'key' => 'afx_email_template_type',
                			'value' => $args['template'],
                		)
                	)
                 );
                if($posts = get_posts( $search_args )) {
                    $post = $posts[0];
                    setup_postdata($post);
                    //the_post();
                    if($footer = get_post_meta( $post->ID, 'afx_email_footer', true )) {
                        $footer = apply_filters('the_content', $footer);
                    } else $footer = "";
                    
                    $header = get_the_content();
                    $header = apply_filters('the_content', $header);
                    $content = $args['content'];
                    
                    
                    $args['content'] = "";
                    if(isset($args['salutation'])) $args['content'] = $args['salutation'];
                    $args['content'] .= $header;
                    $args['content'] .= $content;
					if(isset($args['name'])) $args['content'] .= "<br>Name:" . $args['name']. "<br/>";
					if(isset($args['location'])) $args['content'] .= "Location: ".$args['location']."<br/>";
					if(isset($args['phone'])) $args['content'] .= "Phone: ". $args['phone'] ."<br>";
					if(isset($args['from'])) $args['content'] .= "Email address: ". $args['from'] ."<br>";
					if(isset($args['productId'])) $args['content'] .= "Product: ".$args['productId']."<br/>";
                    $args['content'] .= $footer;
                    
                    $args['subject'] = get_the_title();
                    
                    $args['type'] =  'html';         
                
                    wp_reset_postdata();
                } else {
                    if(isset($args['subject'])) $title = $args['subject'];
                    else $title = "Message from {$this->web_name}";
        
                    $defaults = array(
                      'post_status'           => 'publish', 
                      'post_type'             => 'afx_email_template',
                      'post_title'             => $title,
                    );
                    if($post_id = wp_insert_post( $defaults )) {
                        update_post_meta( $post_id, 'afx_email_template_type', $args['template'] );    
                    }
                        
                }
                
                
                
            }
            $content = $args['content'];
        }
        
        $from = $this->admin_from;
        $to = $this->admin_to;
        $bcc = $this->admin_bcc;
        
        if(isset($args['from'])) $from = $args['from'];
        if(isset($args['to'])) $to = $args['to'];
        if(isset($args['bcc'])) $bcc = $args['bcc'];
        if(isset($args['type'])) $type = $args['type'];
        
        if(! $this->validate_email($from)) $error .= "Please provide a valid from email address ({$from}).";
        if(! $this->validate_email($to)) $error .= "Please provide a valid to email address ({$to}).";
        if((!empty($bcc)) && (!$this->validate_email($bcc))) $error .= "Please provide valid bcc addresses ({$bcc}).";
        
        if(isset($args['subject'])) $subject = $args['subject'];
        else $subject = "Message from {$this->web_name}";

        
        $headers = "From: \"{$this->web_name}\" <{$from}>\n";
		if(! empty($bcc)) $headers .= "Bcc: {$bcc}" . "\n";
		$headers .= 'X-Mailer: PHP/' . phpversion() . "\n";
		$headers .= 'MIME-Version: 1.0' . "\n";
		$headers .= "Content-type: text/{$type}; charset=iso-8859-1" . "\n";
		$extraParam   = "-r {$from}";

        $save = new AFX_Contact_Model();
        $save->email_from = $from;
        $save->email_to = $to;
        if(! empty($bcc)) $save->email_bcc = $bcc;
        $save->subject = $subject;
        $save->content = $content;

        if(empty($error)) {
            if(wp_mail($to, $subject, $content, $headers, $extraParam)) $save->response = "Message sent";
            else $save->response = "Message not sent";    
            $save->save();
            return true;
        } else {
            $save->response = "Error: {$error}";
            $save->save();
            return false;
        }       
    }
    
    function validate_email($validate) {
        $validate_array = explode(",", $validate);
        foreach($validate_array as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        }
        return true;
    }
}