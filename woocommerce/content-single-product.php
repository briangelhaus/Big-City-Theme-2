<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// get featured image
$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
$gallery_ids = $product->get_gallery_image_ids();

// get the current category this product is in
$current_cat = get_the_terms(get_the_ID(), 'product_cat');
$current_cat_name = $current_cat[0]->name;
$current_cat_id = $current_cat[0]->term_id;

// https://docs.woothemes.com/wc-apidocs/class-WC_Product.html
// other functions u can use with $product
$sku = $product->get_sku();

/*
// get upsell ids
// $upsell_ids = $product->get_upsells();
$upsells = get_post_meta( get_the_ID(), '_upsell_ids', true );
$args = array(
	'post_type'           => 'product',
	'posts_per_page'      => -1,
	'post__in'            => $upsells, // show only these product ids
);
$query = new WP_Query( $args );
$upsells = $query->posts;
*/

/*
// get crosssell ids
// $crosssell_ids = $product->get_cross_sells();
$crosssells = get_post_meta( get_the_ID(), '_crosssell_ids', true );
$args = array(
	'post_type'           => 'product',
	'posts_per_page'      => -1,
	'post__in'            => $crosssells, // show only these product ids
);
$query = new WP_Query( $args );
$crosssells = $query->posts;
*/

// get related products in same category ids
// $related_products = $product->get_related(10);
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 4,
	'post__not_in'   => array(get_the_ID()), // grab any product besides the current one
	'tax_query'      => array(
		array(
			'taxonomy' => 'product_cat',
			'terms'    => $current_cat_id, // using ids from above
		),
	),
);
$query = new WP_Query($args);
$related_products = $query->posts;

?>

<?php //do_action( 'woocommerce_before_single_product' ); ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/bigcity/includes/banner.php'); ?>

<section class="basic-content py-40">
	<div class="container">
			
		<?php wc_print_notices(); ?>
	
		<div class="row">
			<div class="col-sm-12">
				<?php woocommerce_breadcrumb(); ?>
			</div><!-- col -->
		</div><!-- row -->
	
		<div class="row">
			<div class="col-sm-5">
				<?php
					/**
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					//do_action( 'woocommerce_before_single_product_summary' ); // images
				?>

				<div class="row mb-20">
					<div class="col-md-12">
						<?php if($featuredImage): ?>
							<a href="<?php echo $featuredImage[0]; ?>">
								<img class="img-fluid" src="<?php echo $featuredImage[0]; ?>" alt="<?php the_title(); ?>">
							</a>
						<?php else: ?>
							<img class="img-fluid" src="http://placehold.it/600x450" alt="no image">
						<?php endif; ?>
					</div><!-- /col -->
				</div><!-- /row -->
				
				<?php if($gallery_ids): ?>
				<div class="product-images row">
					<?php 
						foreach($gallery_ids as $imgID):
						$image = wp_get_attachment_image_src($imgID, 'large');
					?>
					<div class="col-md">
						<a href="<?php echo $image[0]; ?>">
							<img class="img-fluid" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
						</a>
					</div><!-- /col -->
					<?php endforeach; ?>
				</div><!-- /product images -->
				<?php endif; ?>

			</div><!-- /col -->
			<div class="col-sm-7">
				<?php
					/**
					 * woocommerce_single_product_summary hook
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					//do_action( 'woocommerce_single_product_summary' );
	
					// or do your custom layout below
				?>
				<h1><?php the_title(); ?></h1>
				<?php if($sku): ?>
				<span class="sku p" itemprop="sku">SKU: <?php echo $sku; ?></span><br>
				<?php endif; ?>
				<?php woocommerce_template_single_price(); ?>
				<?php woocommerce_template_single_add_to_cart(); ?>
				<div class="product-content"><?php echo the_content(); ?></div>
			</div><!-- /col -->
	
		</div><!-- row -->
	
		<?php if($related_products): ?>
		<div class="related-products products mt-60">
			<h3 class="fs3">More Products In <?php echo $current_cat_name; ?></h3>
			<div class="row">
			<?php
				foreach($related_products as $rp):
				$rpid = $rp->ID;
				$wcproduct = wc_get_product( $rpid );
				$price = get_post_meta($rpid, '_price');
				$review_average = get_post_meta($rpid, '_wc_average_rating');
				$review_count = get_post_meta($rpid, '_wc_review_count');
				$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($rpid), 'medium' );
			?>
				<div class="col-md-6 col-lg-4 product">
					<a href="<?php echo get_the_permalink($pid); ?>">
						<div class="product-image">
							<?php if($featuredImage): ?>
								<img class="img-responsive" src="<?php echo $featuredImage[0]; ?>" alt="">
							<?php else: ?>
								<img class="img-responsive" src="/wp-content/plugins/woocommerce/assets/images/placeholder.png" alt="" />
							<?php endif; ?>
						</div><!-- /no image -->
						<h2 class="fs4 product-title"><?php echo get_the_title($pid); ?></h2>
						
						<?php if($review_average[0] > 0): ?>
						<div class="star-rating">
							<span style="width:<?php echo $review_average[0] / 5  * 100; ?>%">
							<strong itemprop="ratingValue" class="rating"><?php echo $review_average[0]; ?></strong> out of 5</span>
						</div><!-- /star rating -->
						<?php endif; ?>
						
						<span class="product-price"><?php echo $wcproduct->get_price_html(); ?></span>
					</a>
				</div><!-- /col product -->
			<?php endforeach; ?>
			</div><!-- /row -->
		</div><!-- related products-->
		<?php endif; ?>
		
	</div><!-- /container -->
</section><!-- /basic content -->

<?php //do_action( 'woocommerce_after_single_product' ); ?>
