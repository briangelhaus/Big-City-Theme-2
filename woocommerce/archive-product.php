<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// get all products for main shop page
if(is_shop()){

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'orderby' => 'title',
		'order'   => 'ASC',
	);
	$query = new WP_Query($args);
	$products = $query->posts;

}else{ // load products by current category

	$object = get_queried_object();
	$currentTaxId = $object->term_id;
	$currentTaxSlug = $object->slug;
	$currentTax = $object->taxonomy;
	//$cat_description = get_field('cat_description', 'product_cat_'.$currentTaxId);

	if($currentTaxSlug){
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'tax_query' => array(
				array(
					'taxonomy' => $currentTax,
					'field'    => 'id',
					'terms'    => $currentTaxId,
				),
			),
		);
		$query = new WP_Query($args);
		$products = $query->posts;
	}else{
		$products = array();
	}
}

get_header( 'shop' ); ?>
		
<?php include($_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/bigcity/includes/banner.php'); ?>

<section class="basic-content py-40">
	<div class="container">
		
	<?php wc_print_notices(); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

	<div class="row">
		
		<div class="col-lg-3">
			<?php get_sidebar(); ?>
		</div><!-- /col -->

		<div class="col-lg-9">

		<?php if(is_shop()): ?>
			<h1>Featured Products</h1>
		<?php else: ?>
			<h1><?php echo woocommerce_page_title(); ?></h1>
		<?php endif; ?>

		<?php woocommerce_breadcrumb(); ?>

		<div class="main-content description">
			<?php do_action( 'woocommerce_archive_description' ); ?>
		</div>

		<?php if ( $products ) : ?>
		<div class="product-container">
			<div class="row">

			<?php
				$i = 0;
				foreach($products as $p):
				$i++;
				$pid = $p->ID;
				$wcproduct = wc_get_product( $pid );
				$price = get_post_meta($pid, '_price');
				$review_average = get_post_meta($pid, '_wc_average_rating');
				$review_count = get_post_meta($pid, '_wc_review_count');
				$featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id($pid), 'medium' );
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

		</div><!-- /product container -->
		<?php else: ?>

		<p>No Products Found.</p>

		<?php endif; ?>

		</div><!-- /col -->
	</div><!-- /row -->

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
	
	</div><!-- /container -->
</section><!-- /shop content -->

<?php get_footer( 'shop' ); ?>
