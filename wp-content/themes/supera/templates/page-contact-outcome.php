<?php $domain = site_url()."/" ?>

<?php
if(!isset($_POST['imagetext'])) { $msg = "There has been an error with sending the mail please contact us directly."; }
else if ((!isset($_POST['Name']) || $_POST['Name']=="") || (!isset($_POST["Phone"]) || $_POST["Phone"] == "") ) {
	$msg = "Missing information. Please make sure Name and Phone fields are populated";
} else {
/*
	$mailer = new AFX_Contact();
	$args = array(
		'template' => 'test',
		'content' => $_POST['msgContent'],
		'name' =>	$_POST['msgName'],
		'location' => $_POST['msgLocation'],
		'phone' => $_POST['msgPhone'],
		'from' => $_POST['msgEmail']
		);
	if (isset($_POST["productId"])) $args["productId"] = $_POST["productId"];
	$mailer->mail($args);
*/
	
	
	$message = '';
	foreach($_POST as $key=>$value) {
		if($key != 'imagetext' && (strlen($value) > 0)) $message .= ucfirst($key).": {$value}\n\n";
	}
	if($message != '') {
		$args['subject'] = 'Message from Whiteleys website';
		$args['content'] = $message;
		if(afx_mail($args)) {
			$title = get_field('success_title');
			$text = get_field('success_text');
			$msg = "Thank you for contacting Whiteleys!";
		} else $msg = "There has been an error with sending the mail please contact us directly.";
	}
	
	
	
}
?>
<div class='container'>
	<div class='text-content'>
		<p class="breadcrumbs"><a href="<?php echo $domain ?>">Home</a><span>Enquiry Sent</span></p>
		<h1 class="centered">ENQUIRY SENT</h1>
		<p><?php echo $msg; ?></p>
	</div>
</div>