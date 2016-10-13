<?php 
/**
 * Template file to display the mailchimp form
 * @since    1.0.0
 */

global $epm_options, $current_user;

?>



<form class="subscriber" name="epm-sign-up-form" action="#" method="post">
	<input type="text" placeholder="<?php echo __("Enter your E-Mail");?>" name="epm-email" tabindex="8" class="email" id="epm-email"/>
	<input type="hidden" name="epm_list_id" id="epm_list_id" value="7d5605df65" />
	<button class="btn btn-primary epm-sign-up-button epm-submit-chimp" name="epm-submit-chimp" data-wait-text="<?php _e('Please wait...','easy-peasy-mailchimp');?>"><?php echo __("SUBSCRIBE");?></button>
</form>