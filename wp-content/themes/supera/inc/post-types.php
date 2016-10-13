<?php
$afx_banner = new AFX_Post_Type("Banner");
$afx_banner->setLabels("Banner", "Banners");
$afx_banner->setPublic(true);
//$afx_case_study->setShowInMenu("#");
$afx_banner->setSupports(array('title'));
$afx_banner->setHierachical(true);
//$afx_banner->afx_add_post_type();

$afx_service = new AFX_Post_Type("service");
$afx_service->setLabels("Service", "Services");
$afx_service->setPublic(true);
//$afx_case_study->setShowInMenu("#");
$afx_service->setSupports(array('title', 'editor', 'thumbnail', 'revisions'));
$afx_service->setHierachical(true);
//$afx_service->afx_add_post_type();
