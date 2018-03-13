
<section class="footer-cta py-80 bg-light">
	<div class="container">
		<div class="row">
			<div class="col-md-8 text-md-center mx-auto">
				<h3>Want to learn more?</h3>
				<p>This is dummy copy. It is not meant to be read. It has been placed here solely to demonstrate the look and feel of finished typeset text. We will replace this copy when you can give us more info. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum gravida justo in arcu mattis lacinia. Mauris aliquet mi quis diam euismod bland.</p>
				<a href="/contact" class="btn btn-secondary">Contact Us <i class="fa fa-envelope-o" aria-hidden="true"></i></a>
			</div>
		</div><!-- /row -->
	</div><!-- /container -->
</section><!-- /footer-cta -->

<footer class="main py-40">
	<div class="container">
		
		<div class="row">
			<div class="col-md-4 contact mb-20">
				<h4 class="title mb-20">Contact</h4>
				<div class="row align-items-center mb-2">
					<div class="col-2 text-center">
						<i class="display-4 fa fa-map-marker large" aria-hidden="true"></i>
					</div>
					<div class="col-10">
						<span>
							123 Main St.<br>
							Cincinnati, Ohio 45248
						</span>
					</div>
				</div><!-- /row -->
				<div class="row align-items-center mb-2">
					<div class="col-2 text-center">
						<i class="display-4 fa fa-mobile-phone" aria-hidden="true"></i>
					</div>
					<div class="col-10">
						<span>123-123-1234</span>
					</div>
				</div><!-- /row -->
				<div class="row align-items-center mb-2">
					<div class="col-2 text-center">
						<i class="display-4 fa fa fa-clock-o" aria-hidden="true"></i>
					</div>
					<div class="col-10">
						<span>
							Mon-Fri: 9am - 5pm<br>
							Sat: 9am - 1pm
						</span>
					</div>
				</div><!-- /row -->
			</div><!-- /col -->
			
			<div class="col-md-4 social mb-20">
				<h4 class="title mb-20">Social Media</h4>
				<ul class="list-unstyled">
					<li class="mb-1"><a href="" target="_blank"><i class="fa fa-facebook-square mr-1" aria-hidden="true"></i> Facebook</a></li>
					<li class="mb-1"><a href="" target="_blank"><i class="fa fa-twitter-square mr-1" aria-hidden="true"></i> Twitter</a></li>
					<li class="mb-1"><a href="" target="_blank"><i class="fa fa-instagram mr-1" aria-hidden="true"></i> Instagram</a></li>
					<li class="mb-1"><a href="" target="_blank"><i class="fa fa-rss-square mr-1" aria-hidden="true"></i> Blog</a></li>
				</ul>
			</div><!-- /col -->
			
			<div class="col-md-4 news">
				<h4 class="title mb-20">Newsletter</h4>
				<p>Sign up for our newsletter.</p>
				<form class="form-inline">
					<div class="form-group">
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						<button type="submit" class="btn btn-primary mx-2">Sign Up</button>
					</div>
				</form>
			</div><!-- /col -->
		</div><!-- /row -->
		
		<div class="row mt-40">
			<div class="col-sm-12">
				<div class="text-center">
					<p class="mb-0 small copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> | <a href="//primaxstudio.com" target="_blank" rel="nofollow">Web Design by Primax Studio</a></p>
				</div>
			</div><!-- /col -->
		</div><!-- /row -->
	</div><!-- /container -->
</footer><!-- /footer -->

<?php wp_footer(); ?>

<script>
	// https://browser-update.org
	var $buoop = {c:2};
	function $buo_f(){
		var e = document.createElement("script");
		e.src = "//browser-update.org/update.min.js";
		document.body.appendChild(e);
	};
	try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
	catch(e){window.attachEvent("onload", $buo_f)}
</script>

</body>
</html>