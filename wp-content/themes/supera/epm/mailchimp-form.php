<?php 
/**
 * Template file to display the mailchimp form
 * @since    1.0.0
 */

global $epm_options, $current_user;

?>
<form class="subscriber" name="epm-sign-up-form" id="epm-sign-up-form" action="#" method="post">
<div class="col-lg-4 col-md-4 signup-box">
	<input type="text" id="epm-email" name="epm-email" class="signup-email email" placeholder="youremail@email.com"/>
	<input type="hidden" name="epm_list_id" id="epm_list_id" value="5633e60a1e" />
</div>
<div class="col-lg-3 col-md-3 signup-button">
	<div class=""><button class="btn btn-black epm-sign-up-button epm-submit-chimp" name="epm-submit-chimp" data-wait-text="<?php _e('Please wait...','easy-peasy-mailchimp');?>">send email</button></div>
</div>
</form>
