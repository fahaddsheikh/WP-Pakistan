<?php if ( have_posts() ) : ?>
	<div id="main" class="elements">
		<div class="main-sections">
			<section id="elm-columns-_e6241ff7a58752-main" class="elm-main elm-columns-main ">
				<div class="elm-wrapper elm-columns-wrapper">
					<div id="elm-columns-_e6241ff7a58752" class="column-grid column-grid-3">
						<div class="column column-span-2 column-first">
							<section id="elm-text-_e112360c79c121-main" class="elm-main elm-text-main  load-finished">
								<div class='bep_block_inner'>
								 	<div class='bep_block-row'>
								 		<div class='bep_review-template'>
								 			<?php while ( have_posts() ) : the_post(); ?>
							 						<div class='bep_module_6 bep_module_wrap bep_review reviews-container ratings-shown reviews-ajax-shown'>
							 							<div class='bep_module-thumb'>
							 								<a href='<?php echo get_permalink(get_post_meta(get_the_id(), 'post_id', true)) ?>' rel='bookmark' title='<?php echo get_the_title(get_post_meta(get_the_id(), 'post_id', true)) ?>'>
							 				 					<?php echo get_the_post_thumbnail( get_post_meta(get_the_id(), 'post_id', true) ,  'bep_shortcodes_1-small' ) ?>
							 								</a>
							 							</div>
							 							<div class='item-details'>
							 								<div class='bep_review-title'>
							  									<h3 class='entry-title bep_module-title'>
							 										<a href='<?php echo  get_permalink( get_post_meta(get_the_id(), 'post_id', true) ) ?>'> <?php echo  get_the_title( get_post_meta(get_the_id(), 'post_id', true) )  ?> 
							 										</a>
							 									</h3>
								                         	</div>
							 								<div class='bep_review-rating review-container'>
																			
															<?php 	$rating_overall = get_post_meta(get_the_ID(), 'rating_mean', true);
																	$rating_data = (array)json_decode(get_post_meta(get_the_ID(), 'ratings', true));
																	$ratings = '';
																	if(is_array($rating_data) && count($rating_data) > 0){
															?>
								 										<div class='review-stars'>
								 											<span class='review-rating-overall' data-score='<?php echo  $rating_overall ?>'></span>
								 											<div class='review-ratings'>
																			<?php
																				foreach ($rating_data as $index => $rating) {
																					if ($rating->question != "") {
																			?>
								 													<div class='review-rating'>
								 														<span class='review-rating-question'><?php echo  $rating->question ?></span>
								  														<span class='review-rating-stars' data-score='<?php echo $rating->value ?>'></span>
								  													</div>
																			<?php	}
																				} ?>
								 											</div>
								 										</div>
																	<?php } ?>
							 								</div>
							 								<div class='bep_module-meta-info'>
							 									<span class='bep_post-author-name'>
							 										<?php echo get_the_title(); ?>
							 										<span>-</span>
							 									</span> 
							 									<span class='bep_post-date'>
							 										<time class='entry-date updated bep_module-date' datetime='". get_the_date('c' , get_the_ID() ) ."'>
							 										<?php echo get_the_date('F j,Y' , get_the_ID() ); ?>
							 										</time>
							 									</span>
							 								</div>
							 								<div class='bep_review-description'>
							 									<?php echo substr( strip_tags(get_the_content( get_the_ID() )), 0, 180) . '...'; ?>
							 								</div>
							 							</div>
							 						</div>
												<?php wp_reset_postdata(); ?>
												<?php endwhile; ?>
								 		</div>							
								 	</div>
									<div class='clearfix'></div>
									<nav class="nav-single nav-below" role="navigation">
										<?php echo paginate_links(); ?>
									</nav>
								</div>
							</section>
						</div>
						<?php get_sidebar(); ?>	
					</div>
				</div>
			</section>
		</div>
	</div>
<?php endif; ?>