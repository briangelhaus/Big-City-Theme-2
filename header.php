<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<?php wp_head(); ?>

	<?php
		/*
			enable SEO by Yoast for basic Open Graph tags
			uncomment the below meta tags for a sitewide sharing image
			facebook image - 1200px × 630px
			twitter image - minimum of 120px x 120px

			debug your facebook OG tags here: https://developers.facebook.com/tools/debug/sharing/
			debug your twitter OG tags here: https://cards-dev.twitter.com/validator

			<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/images/facebook_image.jpg" />
			<meta name="twitter:image" content="<?php echo get_template_directory_uri(); ?>/images/twitter_image.jpg" />
		*/
	?>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" rel="icon" />

	<?php //include('includes/google_map.php'); ?>
	<?php //include('includes/local_business.php'); ?>
	
</head>
<body <?php body_class(); ?>>

<div class="mobile-nav">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="#" class="mobile-close" aria-label="Close">&times;</a>
				<ul class="menu">
					<?php
						wp_nav_menu( array(
							'menu'       => 'primary',
							'container'  => false,
							'items_wrap' => '%3$s',
						));
					?>
				</ul>
				<form class="form-inline" action="/" method="get">
					<input class="form-control" type="text" name="s" id="search" placeholder="Search for a Product..." value="<?php the_search_query(); ?>" />
				</form>
			</div>
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /mobile-nav -->

<header class="main">
	<div class="container">
		
		<div class="flex-nav d-flex">
			<div class="logo">
				<a href="<?php echo home_url(); ?>"><img src="//placehold.it/300x200" alt="<?php bloginfo( 'name' ); ?>" /></a>
			</div><!-- /logo -->
			
			<div class="ml-auto align-self-center"><!-- delete this div if not using top-content -->
				<div class="top-content text-right">
					<p class="m-0 mr-2">Call us today! 123-123-1234</p>
				</div>
	
				<nav class="navbar navbar-expand-lg ml-auto navbar-light">
					<button class="navbar-toggler ml-auto" type="button" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
				
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<?php
								wp_nav_menu( [
									'menu'            => 'primary',
									'depth'           => 2,
									'container'       => false,
									'items_wrap'      => '%3$s',
									'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
									'walker'          => new WP_Bootstrap_Navwalker()
								] );
							?>
	<?php /*
							<?php 
								// show cart items count in nav
								global $woocommerce;
								$count = $woocommerce->cart->get_cart_contents_count();
							?>
							<li><a class="view-cart" href="/cart">Cart (<?php echo $count; ?>)</a></li>
	*/ ?>
						</ul>
					</div><!-- /nav collapse -->
				</nav>
			</div>

		</div><!-- /flex nav -->

	</div><!-- /container -->
</header>