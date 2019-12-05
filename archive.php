<?php 
	get_header(); 
	
	$cat = get_queried_object();
	$catID = $cat->term_id;
	$catName = $cat->name;
	$catSlug = $cat->slug;
	$catTax = $cat->taxonomy;
	$acfID = $catTax.'_'.$catID;
?>

<?php include('includes/banner.php'); ?>

<section class="basic-content py-40">
	<div class="container">
		<div class="row">
				<?php 
					$args = array(
						'post_type' => 'post',
						'posts_per_page' => -1,
						'post_status' => 'publish',
						'tax_query' => array(
							array(
								'taxonomy' => $catTax,
								'field'    => 'slug',
								'terms'    => $catSlug,
							),
						),
					);
					$query = new WP_Query($args);
					foreach($query->posts as $p):
					$pid = $p->ID;
					$content = wp_trim_words( $p->post_content, 25, '...' );
				?>
				<div class="col-lg-12 mb-30">
					<h2 class="fs4"><a href="<?php echo get_permalink($pid); ?>"><?php echo $p->post_title; ?></a></h2>
					<?php echo $content; ?>
				</div><!-- /item -->
				<?php endforeach; ?>
		</div><!-- row -->
	</div><!-- /container -->
</section><!-- /basic content -->

<?php get_footer(); ?>