<div class="banner text-center">
	<img class="img-fluid" src="http://placehold.it/1800x450/444444/ffffff?text=banner" alt="" />
</div><!-- /banner -->

<?php /*

<?php if(get_field('banner')): ?>

<div class="banner">
	<div class="image" style="background-image: url(<?php echo get_field('banner'); ?>);"></div>
</div>

<?php 
	elseif(is_category()): 
	$cat = get_queried_object();
	$acfID = $cat->taxonomy.'_'.$cat->term_id;
?>

<div class="banner">
	<div class="image" style="background-image: url(<?php echo get_field('banner', $acfID); ?>);"></div>
</div>

<?php endif; ?>

*/ ?>