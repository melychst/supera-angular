<?php 
	if (isset($_GET['ajax'])) {
		get_template_part('templates/page-ajax', 'content');
	}
	else {
		get_template_part('templates/header');
		include roots_template_path();
		get_template_part('templates/footer');
	}
?>