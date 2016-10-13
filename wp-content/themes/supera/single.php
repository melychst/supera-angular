<?php 
	if(get_post_type($post) == "afx_facility") get_template_part('templates/page', 'facility');
	else get_template_part('templates/page', 'single');
?>