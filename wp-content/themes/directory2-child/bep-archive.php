<?php if ( have_posts() ) : ?>
	<div id="main" class="elements">
		<div class="main-sections bep_archive">
			<section id="elm-text-_e6b34f6cfb915-main" class="elm-main elm-text-main  load-finished">
				<div class="elm-wrapper elm-text-wrapper">
				<?php
				$current_posttype = $wp_query->query;
				$shortcode_businesses = sprintf(
					    '[bep_biggrid_single bep_post_type="%1$s" bep_taxonomy_type="ait-items"]',
					    $current_posttype['post_type']
					);
				$shortcode_profile = sprintf(
					    '[bep_biggrid_single bep_post_type="%1$s" bep_taxonomy_type="profile-type"]',
					    $current_posttype['post_type']
					);
				if ($current_posttype['post_type'] == 'ait-item') {
					echo do_shortcode( $shortcode_businesses );
				}
				elseif ($current_posttype['post_type'] == 'profile') {
					echo do_shortcode( $shortcode_profile );
				}
				?>
				</div>
			</section>
			<?php if ($current_posttype['post_type'] !== 'ait-review') { ?>
				<section id="elm-text-_e6b34f6cfb915-main" class="elm-main elm-text-main  load-finished">
					<div class="elm-wrapper elm-text-wrapper">
						<?php get_template_part( 'bep-custom-searchform' ); ?>
					</div>
				</section>
			<?php } ?>
			<section id="elm-columns-_e6241ff7a58752-main" class="elm-main elm-columns-main ">
				<div class="elm-wrapper elm-columns-wrapper">
					<div id="elm-columns-_e6241ff7a58752" class="column-grid column-grid-3">
						<div class="column column-span-2 column-first">
							<section id="elm-text-_e112360c79c121-main" class="elm-main elm-text-main  load-finished">
								<div class='bep_block_inner'>
								 	<div class='bep_block-row'>
								 		<div class='bep_review-template'>
								 			<div class="archive-container">
									 			<?php while ( have_posts() ) : the_post(); ?>
								 						<div class='bep_module_6 bep_module_wrap bep_review reviews-container ratings-shown reviews-ajax-shown'>
								 							<?php
								 							$return_string .= bep_custom_thumb(100,70); 
								 							?>
								 							<div class='item-details'>
								 								<div class='bep_review-title'>
								  								<?php
									 							$return_string .= bep_custom_title(); 
									 							?>
								 							<di
									                         	</div>
									                        	
									                        	<?php 
									                        		if ($current_posttype['post_type'] == 'ait-review') {
									                        		 	$rating_overall = get_post_meta(get_the_ID(), 'rating_mean', true);
																		$rating_data = (array)json_decode(get_post_meta(get_the_ID(), 'ratings', true));
																		$ratings = ''; 
																?>
																<div class='bep_review-rating review-container'>
																	<?php if(is_array($rating_data) && count($rating_data) > 0){ ?>
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
																	<?php } ?>
								 								<div class='bep_module-meta-info'>
								 										<?php
								 											if ($current_posttype['post_type'] == 'ait-item') {
								 											 	$profile_types = get_the_terms( $post->id, 'ait-items' );
								 											}
								 											if ($current_posttype['post_type'] == 'profile') {
								 											 	$profile_types = get_the_terms( $post->id, 'profile-type' );
								 											}
								 											if ($current_posttype['post_type'] == 'ait-review') {
								 											 	echo get_the_title();
								 											 	echo "<span>-</span>";
								 											}
								 											if (isset($profile_types) && !empty($profile_types)) {
								 												foreach ( $profile_types  as $profile_type ) {
						 											        		$out[] = esc_html( $profile_type->name );
																	        	}
																	        	
									 												$return_string .= bep_custom_author_name(); 
									 											
																	        	unset($out);
								 											}
								 										?>
								 									</span> 
								 									<?php
									 												$return_string .= bep_custom_time(); 
									 								?>
								 								</div>
								 								<?php
									 												$return_string .= bep_custom_excerpt(0,150); 
									 								?>
								 							</div>
								 						</div>
													<?php wp_reset_postdata(); ?>
													<?php endwhile; ?>
													<div class="clearfix"></div>
												</div>
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