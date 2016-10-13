<?php $domain = site_url()."/" ?>

<?php
	$bgHeader = get_the_post_thumbnail_url();

	$testimonalBg = get_field("background_testimonal_section");
	$testimonalBgUrl = $testimonalBg['url'];

	$workBg = get_field("background_work_section");
	$workBgUrl = $workBg['url'];
?>

<div class="home main-page page">
	<div class="top-banner" style="background-image: url(<?php echo $bgHeader;?>)">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="title-banner">
						<h1><?php echo get_field("title_banner");?></h1>
					</div>
					<div class="button-book-now">
						<a href="<?php echo get_field("link_cta_button");?>"><?php echo get_field("title_cta_button");?></a>
					</div>					
				</div>
			</div>
		</div>
	</div>

	<div class="book-filter">
		<div class="container">
			<div class="row">
				<div class="col-md-12 form">
					<div class="nav-tab">
						<ul>
							<li class="flight_tab active"><a href="">flight</a></li>
							<li class="limousine_tab"><a href="">limousine</a></li>
							<li class="concierge_tab"><a href="">concierge</a></li>
							<li class="hotels_tab"><a href="">hotels</a></li>
						</ul>
					</div>
					<form action="">
						
						<div class="from-to">
							<div class="from">
								<label for="input-from">From</label>
								<input id="input-from" type="text">
								<span>Los Angeles, CA</span>								
							</div>
							
							<div class="from-to-arrow">
								<i class="icon ion-android-arrow-forward" aria-hidden="true"></i>
								<i class="icon ion-android-arrow-forward" aria-hidden="true"></i>
							</div>

							<div class="to">
								<label for="to">To</label>
								<input id="to" type="text">
								<span>New York, CA</span>
							</div>

						</div>

						<div class="time">
							<label for="input-time"><span>ARR</span> | DEP</label>
							<input id="input-time" type="text">
							<input type="text">
						</div>

						<div class="date">
							<label for="input-date">date</label>
							<input id="input-date" type="text">
							<input type="text">
						</div>

						<div class="passenger">
							<label for="input-passenger">passenger</label>
							<input id="input-passenger" class="mod" type="number">
						</div>

						<div class="search">
							<button>Search</button>
							<div class="check-option">
								<input id="first" type="checkbox" class="form-check">
								<label for="first">round - trip</label>								
							</div>
							<div class="check-option">
								<input id="second" type="checkbox" class="form-check">
								<label for="second">multi - city</label>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="events-trip section">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="title-section">
						<span><?php echo get_field("title_event_section")?></span>
					</div>
				</div>
				<div class="col-md-2 see-all">
					<a href="#">> see all</a>	
				</div>
			</div>
			<div class="row">

			<?php 
				for ($i = 0; $i < 3; $i++) {
			?>
				<div class="col-md-4 event">
					<div class="img">
						<a href="http://supera/superbowll-li/">
							<img src="<?php echo get_stylesheet_directory_uri();?>/img/hotel.jpg">
						</a>
					</div>
					<div class="heading">The Best Hotel Rooms</div>
					<div class="details">Now for the caravan and looking for the right caravan to suit your needs.Most of the Parks will deal with majority of the manufacturers</div>
					<div class="button"><a class="btn btn-gray" href="http://supera/superbowll-li/">Book now</a></div>
				</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>

	<div class="testimonal section" style="background-image: url(<?php echo $testimonalBgUrl; ?>)">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="title-banner">
						<h1><?php echo get_field("title_section");?></h1>
					</div>
					<div class="content-banner">
						<?php echo get_field("content_section");?>
					</div>
					<div class="author">
					<?php
						$authorImg = get_field("author_img");
						$authorUrl = $authorImg['url'];
						$authorAlt = $authorImg['alt'];
					?>
						<img src="<?php echo $authorUrl ?>" alt="<?php echo $authorAlt ?>">
						<div class="author-data">
							<p><?php echo get_field("author_name")?></p>
							<p><?php echo get_field("author_position")?></p>
						</div>
					</div>					
				</div>
				<div class="col-md-6"></div>
			</div>
		</div>
	</div>

	<div class="services">
		<div class="container container-gray">
			<div class="row">
				<div class="small-container">
					<div class="col-lg-12 col-md-12 services-text">
						<?php echo get_field("title_services_section")?>
					</div>
					<div class="col-lg-4 col-md-4 service">
						<div class="img"><img src="<?php echo get_stylesheet_directory_uri();?>/img/Flight.jpg"></div>
						<div class="heading">Private Jet travel</div>
						<div class="details">We will provide the best price, most flexible private flight service available.</div>
						<div class="button"><a class="btn btn-gray" href="Details">Details</a></div>
					</div>
					<div class="col-lg-4 col-md-4 service">
						<div class="img"><img src="<?php echo get_stylesheet_directory_uri();?>/img/Event.jpg"></div>
						<div class="heading">Events to remember</div>
						<div class="details">Your complete luxury package to worldwide events which you.</div>
						<div class="button"><a class="btn btn-gray" href="Details">Details</a></div>
					</div>
					<div class="col-lg-4 col-md-4 service">
						<div class="img"><img src="<?php echo get_stylesheet_directory_uri();?>/img/Transport.jpg"></div>
						<div class="heading">Transport to suit</div>
						<div class="details">Full travel and connection services to meet your expectation.</div>
						<div class="button"><a class="btn btn-gray" href="Details">Details</a></div>
					</div>
				</div>			
			</div>
		</div>
	</div>
	
	<div class="logo-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="title-section">
						<p><?php echo get_field("description_text")?></p>
						<p><span><?php echo get_field("main_text")?></span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="itworks" style="background-image: url(<?php echo $workBgUrl?>)"> 
		<div class="container container-gray">
			<div class="row">
				<div class="small-container">
					<div class="col-lg-12 col-md-12 heading"><div class="heading-top-line"></div><?php echo get_field("title_section_work")?></div>
					<div class="col-lg-12 col-md-12 explanation">
						<?php echo get_field("content_section_work")?>
					</div>
					<div class="col-lg-12 col-md-12 boxes">
						<?php 
							$listItems = get_field("list_items");
							foreach ($listItems as $key => $value) {
						?>
						<div class="col-lg-2 col-md-2 box">
							<div class="circule"></div>
								<?php echo $value['content'];?>
						</div>
						<?php
							}
						?>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>