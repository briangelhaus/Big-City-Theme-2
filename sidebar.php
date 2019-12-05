<div class="sidebar">
	<h3>Categories</h3>
	<?php  
		$product_cats = get_terms(array(
		    'taxonomy' => 'category',
		    'hide_empty' => false,
		));
	?>
	<ul>
		<?php foreach($product_cats as $c): ?>
		<li><a href="<?php echo get_category_link($c->term_id); ?>"><?php echo $c->name; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div><!-- /sidebar -->