<div class="sidebar">
	<h3>Categories</h3>
	<ul>
		<?php foreach(get_categories() as $c): ?>
		<li><a href="<?php echo get_category_link($c->term_id); ?>"><?php echo $c->name; ?></a></li>
		<?php endforeach; ?>
	</ul>
</div><!-- /sidebar -->