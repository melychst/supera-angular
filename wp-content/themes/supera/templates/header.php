<?php	
session_start();
$domain = site_url()."/"; $options = 64; ?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php //meta name="viewport" content="width=device-width, initial-scale=1.0"> ?>
	<link rel="icon" type="image/jpg" href="<?=$domain?>img/favicon.jpg" />
	<?php wp_head(); ?>
	<?php roots_head(); ?>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/css/jquery.sidr.light.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/css/owl.carousel.css">
	<script src="//use.typekit.net/zlk8eyp.js"></script>
	<script>try{Typekit.load();}catch(e){}</script>
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?=$domain?>css/ie.css" type="text/css" />
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript">
		(function(doc) {
			var viewport = document.getElementById('viewport');
			if(navigator.userAgent.match(/iPad/i)) {
				doc.getElementById("viewport").setAttribute("content", "width=1024");
			}
		}(document));
	</script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery('#menu-toggle').sidr();
			if ('<?php the_field('opening_hours_popup', $options);?>' == '1') {
			$('.opening-hours').click(function (e) {
				e.preventDefault();
				$(".hours-popup > div.content").load($(this).attr("href")+"?ajax=1", function(){
					$('html').addClass('overlay');
					var activePopup = "#hours-popup";
					$(activePopup).addClass('visible');
					if ($('body').hasClass("sidr-open")) { jQuery.sidr('close', 'sidr'); }
				});
			});
			}
			
			if ('<?php the_field('second_header_button_popup', $options);?>' == '1') {
			$('.header-button').click(function (e) {
				e.preventDefault();
				$(".second-popup > div.content").load($(this).attr("href")+"?ajax=1", function(){
					$('html').addClass('overlay');
					var activePopup = "#second-popup";
					$(activePopup).addClass('visible');
					if ($('body').hasClass("sidr-open")) { jQuery.sidr('close', 'sidr'); }
				});
			});
			}
			
			$(document).keyup(function (e) {
			if (e.keyCode == 27 && $('html').hasClass('overlay')) {
				clearPopup();
				}
			});
		 
			$('.popup-exit').click(function () {
				clearPopup();
			});
		 
			$('.popup-overlay').click(function () {
				clearPopup();
			});
			$('.form_close').click(function () {
				clearPopup();
			});
			
			$('.hours-popup .form_close').click(function () {
				var activePopup = "#hours-popup";
				$(activePopup).find('.resp-video-center').remove();
				clearPopup();
			});
			$('.second-popup .form_close').click(function () {
				var activePopup = "#second-popup";
				$(activePopup).find('.resp-video-center').remove();
				clearPopup();
			});
			
			function clearPopup() {
				$('.popup.visible').addClass('transitioning').removeClass('visible');
				$('html').removeClass('overlay');
		 
				setTimeout(function () {
					$('.popup').removeClass('transitioning');
				}, 200);
			}
		});
	</script>


</head>

<body id="top" <?php body_class() ?>>
	<header class='clearfix site-header'>
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-md-3 toplogo">
						<a id="menu-toggle" href="#sidr"></a>
						<a id="menu-toggle-full" href="#sidr"></a>
						<a href="<?php echo $domain ?>"><span class="logo"><img src="<?php echo get_stylesheet_directory_uri();?>/img/logo.png"/></span></a>
					</div>
					<div class="col-md-9 hide-phone">
						<nav class='primary-menu clearfix hide-phone'><?php wp_nav_menu(array('theme_location' => 'top-menu', 'menu' => 'top-menu', 'container'=> '')) ?></nav>
						<nav id="sidr" class='clearfix'><?php wp_nav_menu(array('theme_location' => 'top-menu', 'menu' => 'top-menu')) ?></nav>
					</div>				
				</div>
			</div>
		</div>
	</header>	