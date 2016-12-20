<div id="main" class="elements">
	<div class="main-sections">
		<section id="elm-text-_e4300405a2ec2d-main" class="elm-main elm-text-main  load-finished">
			<div class="elm-wrapper elm-text-wrapper">
				<?php
					/*
					*	TO FETCH ALL IDS ASSOCIATED TO THE FEATURED CATEGORY 
						IN THE PROFILE-TYPE TAXONOMY
					*/ 
					echo do_shortcode("[bep_biggrid custom_post_type_box_one='profile' custom_one_taxonomy='ait-items' custom_two_taxonomy='ait-items' custom_three_taxonomy='ait-items' custom_four_taxonomy='ait-items' custom_post_type_box_two='profile' custom_post_type_box_three='profile' custom_post_type_box_four='profile']" );
				?>
			</div>
		</section>
	</div>
	<section class="elm-main elm-text-main  load-finished">
		<div class="elm-wrapper elm-columns-wrapper">
			<div class="column-grid column-grid-3">
				<div class="column column-span-2 column-first">
					<div class="td-ss-main-content">
						<?php
							/*
							*	TO FETCH ALL IDS ASSOCIATED TO THE ENTREPRENEURS CATEGORY 
								IN THE PROFILE-TYPE TAXONOMY
							*/
								echo do_shortcode("[bep_shortcode_1 bep_shortcode_1_title='Title' bep_shortcode_1_custom_post_type='profile']" ); 
						?>
	                </div>
            </div>
            	<?php get_sidebar(); ?>

        </div>
	</section>
	<section class="elm-main elm-text-main  load-finished">
		<div class="submit-your-story-banner">
			<div class="submit-your-story-inner">
			<h2>Do you run a startup, are an entrepreneur or have an interesting story? Please fill up the form and we will get back to you</h2>
			<div class="submit-your-story-banner-button"><a href="http://bekarachi.com/submit-your-story/">Submit Your Story</a></div>
		</div>
	</section>
</div>
</div>
