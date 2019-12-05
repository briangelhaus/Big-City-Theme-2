<?php
	// if you want to override this, for example for the home page, just copy and paste the code below into page-home.php
	// how custom banners work
	// 1. create a ACF image field called "banner", return as image url, and place it on pages, posts and categories or whereever you need it
	
	// if its a category page and not the woocommerce shop page(WP counts the shop page as an archive, even though its a page)
	if(is_archive() && !is_shop()){
		$cat = get_queried_object();
		$acfID = $cat->taxonomy.'_'.$cat->term_id;
		$banner = get_field('banner',$acfID);
		//$banner = $banner['url']; // if ACF image field returns array
	}else{
		// else its a page, single, etc
		$acfID = get_the_id();
		$banner = get_field('banner',$acfID);
		//$banner = $banner['url']; // if ACF image field returns array
		$title = get_the_title();
	}
	// if no banner is uploaded
	if(!$banner){
		// use a default banner
		$banner = '//s3.amazonaws.com/scripps-com/ample_admin/attachments/files/000/000/407/original/Cincinnati2.jpg';
		// or use pre-selected random banner from our images folder
		// add istock banner images named banner1.jpg, banner2.jpg, etc.
		//$banner = get_template_directory_uri().'/images/banner'.rand(1,4).'.jpg';
	}
?>
<section class="hero">
	<?php // background image for desktop (optional) ?>
	<div class="bg-image d-none d-lg-block" style="background-image: url(<?php echo $banner; ?>);"></div>
	<?php // html img for mobile ?>
	<img class="img-fluid d-block d-lg-none" src="<?php echo $banner; ?>" alt="<?php echo $title; ?>" />	
	<div class="overlay d-none d-lg-block"></div>
	<div class="hero-content">
		<?php if(is_front_page()): ?>
			<h1 class="fs1">Some Headline Here</h1>
			<p>Some subtext here is optional</p>
			<a href="#" class="btn btn-secondary">Some Action <i class="fas fa-chevron-right"></i></a>
			<a href="#" class="btn btn-primary mx-2">Some Action <i class="fas fa-arrow-right"></i></a>
		<?php else: ?>
			<h1 class="fs1">
				<?php  					
					if(is_shop()){ // woocommerce shop page is unique
						echo 'Shop Products';
					}elseif(is_archive()){
						echo $cat->name;
					}elseif (is_category()){
						single_cat_title();
					}elseif(is_tag()){
						single_tag_title();
					}else{
						echo $title;
					}
				?>
			</h1>
		<?php endif; ?>
	</div><!-- /hero content -->
</section>

<?php /*
	<section class="hero">
	<div class="bg-image d-flex justify-content-center align-items-center" style="background-image: url('//s3.amazonaws.com/scripps-com/ample_admin/attachments/files/000/000/407/original/Cincinnati2.jpg');">
		<div class="overlay"></div>
		<div class="hero-content">
			<h1 class="fs1 white">Some Headline Here</h1>
			<a href="#" class="btn btn-secondary">Some Action <i class="fas fa-chevron-right"></i></a>
			<a href="#" class="btn btn-primary mx-2">Some Action <i class="fas fa-arrow-right"></i></a>
		</div><!-- /hero content -->
	</div><!-- /hero bg -->
</section><!-- /hero -->
*/ ?>