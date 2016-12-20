<div class="td-main-content-wrap td-main-page-wrap">
	<div class="td-container tdc-content-wrap">
		<?php
			$be_fetch_metabox_values = array (    
	        	"current_be_metabox_times_contacted" => "be_metabox_times_contacted",
				"current_be_profile_about" => "be_profile_about",
				"current_be_profile_occupation" => "be_profile_occupation",
	        	"current_be_profile_city" => "be_profile_city", 
	        	"current_be_profile_address" => "be_profile_address",
	        	"current_be_profile_landline_number" => "be_profile_landline_number",
	        	"current_be_profile_mobile_number" => "be_profile_mobile_number",
	        	"current_be_profile_email" => "be_profile_email",
	        	"current_be_profile_website" => "be_profile_website",
	        	"current_be_profile_facebook" => "be_profile_facebook",
	        	"current_be_profile_twitter" => "be_profile_twitter",
	        	"current_be_profile_instagram" => "be_profile_instagram",
	        	"current_be_profile_linkdln" => "be_profile_linkdln",
	        	"current_be_profile_google" => "be_profile_google",
	        	"current_be_profile_youtube" => "be_profile_youtube",
	        	"current_be_profile_related_video_ids" => "be_profile_related_video_ids",
	        	"current_be_profile_related_review_ids" => "be_profile_related_review_ids",
	        	"current_be_profile_related_event_ids" => "be_profile_related_event_ids",
	        	"current_be_profile_related_blog_ids" => "be_profile_related_blog_ids",
	        	"current_be_profile_gallery_ids" => 'be_profile_gallery_ids'
	    	);
	    	
	    	foreach ($be_fetch_metabox_values  as $key => $value) {
	        	$$key = get_post_meta( $post->ID, $value, true );
	    	}

			// Start the loop.
			while ( have_posts() ) : the_post(); ?>
					<div class="vc_row wpb_row td-pb-row">
						<div class="wpb_column vc_column_container td-pb-span4">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="wpb_text_column wpb_content_element ">
										<div class="wpb_wrapper">
											<div class="be_profile">
												<div class="be_profilepicture td-pb-span5">
													<?php echo get_the_post_thumbnail( $post_id, 'thumbnail' ); ?>
												</div>
												<div class="be_profiledetails td-pb-span7">
													<div class="be_profiledetails_title"><?php the_title( '<h3>','</h3>'); ?></div>
													<?php if (isset($current_be_profile_occupation) && !empty($current_be_profile_occupation)) { ?>
													<div class="be_profiledetails_occupation"><?php echo $current_be_profile_occupation; ?></div>
													<?php } ?>
													<?php if (isset($current_be_profile_city) && !empty($current_be_profile_city)) { ?>
													<div class="be_profiledetails_location"><?php echo $current_be_profile_city; ?></div>
													<?php } ?>

													<!-- Social Details -->
													<div class="be_profiledetails_social">
														<!-- facebook -->
														<?php if (isset($current_be_profile_facebook) && !empty($current_be_profile_facebook)) { ?>
															<span class="td-social-icon-wrap">
													            <a target="_blank" href="<?php echo $current_be_profile_facebook ?>" title="Facebook">
													                <i class="td-icon-font td-icon-facebook"></i>
													            </a>
													        </span>
														<?php } ?>
														<!-- twitter -->
														<?php if (isset($current_be_profile_twitter) && !empty($current_be_profile_twitter)) { ?>
															<span class="td-social-icon-wrap">
													            <a target="_blank" href="<?php echo $current_be_profile_twitter ?>" title="Twitter">
													                <i class="td-icon-font td-icon-twitter"></i>
													            </a>
													        </span>
														<?php } ?>
														<!-- Instagram -->
														<?php if (isset($current_be_profile_instagram) && !empty($current_be_profile_instagram)) { ?>
															<span class="td-social-icon-wrap">
													            <a target="_blank" href="<?php echo $current_be_profile_instagram ?>" title="Instagram">
													                <i class="td-icon-font td-icon-instagram"></i>
													            </a>
													        </span>
														<?php } ?>
														<!-- Linkdln -->
														<?php if (isset($current_be_profile_linkdln) && !empty($current_be_profile_linkdln)) { ?>
															<span class="td-social-icon-wrap">
													            <a target="_blank" href="<?php echo $current_be_profile_linkdln ?>" title="Linkedin">
													                <i class="td-icon-font td-icon-linkedin"></i>
													            </a>
													        </span>
														<?php } ?>
														<!-- Google -->
														<?php if (isset($current_be_profile_google) && !empty($current_be_profile_google)) { ?>
															<span class="td-social-icon-wrap">
													            <a target="_blank" href="<?php echo $current_be_profile_google ?>" title="Google">
													                <i class="td-icon-font td-icon-googleplus"></i>
													            </a>
													        </span>
														<?php } ?>
														<!-- Youtube -->
														<?php if (isset($current_be_profile_youtube) && !empty($current_be_profile_youtube)) { ?>
															<span class="td-social-icon-wrap">
													            <a target="_blank" href="<?php echo $current_be_profile_youtube ?>" title="Youtube">
													                <i class="td-icon-font td-icon-youtube"></i>
													            </a>
													        </span>
														<?php } ?>
													</div>
												</div>
												<div class="clearfix"></div>
											</div>
											<div class="be_furtherdetails">
												<?php if (isset($current_be_profile_address) && !empty($current_be_profile_address)) { ?>
												<div class="td-pb-row">
													<div class="td-pb-span3">Address:</div>
													<div class="td-pb-span9"><?php echo $current_be_profile_address; ?></div>
												</div>
												<?php } ?>
												<?php if (isset($current_be_profile_landline_number) && !empty($current_be_profile_landline_number)) { ?>
												<div class="td-pb-row">
													<div class="td-pb-span3">Landline:</div>
													<div class="td-pb-span9"><?php echo $current_be_profile_landline_number; ?></div>
												</div>
												<?php } ?>
												<?php if (isset($current_be_profile_mobile_number) && !empty($current_be_profile_mobile_number)) { ?>
												<div class="td-pb-row">
													<div class="td-pb-span3">Mobile:</div>
													<div class="td-pb-span9"><?php echo $current_be_profile_mobile_number; ?></div>
												</div>
												<?php } ?>
												<?php if (isset($current_be_profile_email) && !empty($current_be_profile_email)) { ?>
												<div class="td-pb-row">
													<div class="td-pb-span3">Email:</div>
													<div class="td-pb-span9"><?php echo $current_be_profile_email; ?></div>
												</div>
												<?php } ?>
												<?php if (isset($current_be_profile_website) && !empty($current_be_profile_website)) { ?>
												<div class="td-pb-row">
													<div class="td-pb-span3">Website:</div>
													<div class="td-pb-span9"><?php echo $current_be_profile_website; ?></div>
												</div>
												<?php } ?>
											</div>
											<?php if (isset($current_be_profile_about) && !empty($current_be_profile_about)) { ?>
											<div class="be_about "> 
												<div class="td-block-title-wrap"><h4 class="block-title"><span>About</span></h4></div>
												<div class="be_about_text">
													<?php echo strip_tags($current_be_profile_about); ?>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="wpb_column vc_column_container td-pb-span8">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="wpb_text_column wpb_content_element ">
										<div class="wpb_wrapper">
											<div class="be_content">
												<?php 
												$content = get_the_content();
												$content = apply_filters('the_content', $content);
												echo $content;
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="be_advanced_details vc_row wpb_row td-pb-row">
						<?php if (isset($current_be_profile_related_video_ids) && !empty($current_be_profile_related_video_ids)) { ?>
							<div class="wpb_column vc_column_container td-pb-span4">
								<div class="vc_column-inner ">
									<div class="wpb_wrapper">
										<?php
										// Show all the related videos using the builtin Newspaper 7 block with the provided IDS in the metabox
										preg_match_all('!\d+!', $current_be_profile_related_video_ids, $current_be_profile_related_video_ids_array);
										$relatedvideoids = implode ( "," , $current_be_profile_related_video_ids_array[0] );
										if (count($current_be_profile_related_video_ids_array[0]) == 1) {
											echo do_shortcode( "[td_block_5 custom_title='Videos' post_ids='$relatedvideoids' installed_post_types='post' limit='1']" );
										}
										else {
										echo do_shortcode( "[td_block_15 custom_title='Videos' post_ids='$relatedvideoids' installed_post_types='post' limit='4' ajax_pagination='next_prev']" );
										}
										?>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="wpb_column vc_column_container td-pb-span4">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="td-block-title-wrap"><h4 class="block-title"><span>Gallery</span></h4></div>
				                    <div class="gallery gallery-size-large">
				                        <figure class="gallery-item">
				                            <div class="gallery-icon landscape">
				                            	<?php 
				                            	// Show all the related videos using the builtin Newspaper 7 block with the provided IDS in the metabox
												preg_match_all('!\d+!', $current_be_profile_gallery_ids, $current_be_profile_gallery_ids_array);
												$gallery = implode ( "," , $current_be_profile_gallery_ids_array[0] );
												
				                            	?>
				                            	<?php foreach ($current_be_profile_gallery_ids_array[0] as $current_be_profile_gallery_images) {
				                            		$galleryimagenumber = count($current_be_profile_gallery_images);
				                            		if ($current_be_profile_gallery_ids_array[0][0] == $current_be_profile_gallery_images) { ?>
						                                <a href="<?php echo wp_get_attachment_image_url( $current_be_profile_gallery_images, 'full', '', array( 'class' => 'img-responsive' , 'id' => '$current_be_profile_gallery_images') ); ?>">
														<?php echo wp_get_attachment_image(  $current_be_profile_gallery_images, array('324', '235'), "", array( "class" => "img-responsive" , "id" => "$current_be_profile_gallery_images") ); ?>
				                                		</a>
				                            <?php 	}
				                            		else { 
				                            ?>
						                                <a href="<?php echo wp_get_attachment_image_url( $current_be_profile_gallery_images, 'full', '', array( 'class' => 'img-responsive' , 'id' => '$current_be_profile_gallery_images') ); ?>">
														<?php echo wp_get_attachment_image(  $current_be_profile_gallery_images, array('100', '70'), "", array( "class" => "img-responsive" , "id" => "$current_be_profile_gallery_images") ); ?>
														</a>
				                            <?php	}
				                            $count++;
				                            	if ($count>6) {
				                            		break;
				                            	}
				                            	}
				                             ?>
				                            </div>
				                        </figure>
				                    </div>

								</div>
							</div>
						</div>
						<div class="wpb_column vc_column_container td-pb-span4">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="td-block-title-wrap"><h4 class="block-title"><span>Contact</span>
										<?php 
											if (!empty($current_be_metabox_times_contacted )) {
												echo "<div class='timescontacted' style='float:right;''><span>";
												echo $current_be_metabox_times_contacted;
												echo "</span></div>";
											}
										?>
									</h4></div>
										<div class="be_contact_form">
											<div id="respond">
											  <form action="<?php the_permalink(); ?>" method="post" id="be_contact_form">
											    <p><input type="text" name="message_name" id="message_name" placeholder="Full Name*" value="">
											    <span class="be_error message_name_error" style="display:none"></span></p>
											    <p><input type="text" name="message_email" id="message_email" placeholder="Email*" value=""><span class="be_error message_email_error" style="display:none"></span></p>
											    <p><input type="text" name="message_subject" id="message_subject" placeholder="Subject" value=""></p>
											    <p><textarea type="text" name="message_text" id="message_text" placeholder="Message*" style="height: 150px;min-height: 150px;resize: none;"></textarea>
											    	<span class="be_error message_text_error" style="display:none"></span>
											    </p>
											    <input type="hidden" name="submitted" id="submitted" value="<?php echo wp_create_nonce( 'be_nonce' );?>">
											    <input type="hidden" name="postid" id="postid" value="<?php echo $post->ID ?>">
											    <div class="input-col">
											    	<div class="input-col-submit">
											    		<input type="submit">
											    	</div>
											    	<div class="input-col-message-container">
											   			<img src="<?php echo get_stylesheet_directory_uri() . '/profile-module/images/loading.gif'?>" style="position:absolute;display:none;" class="be_ajax_loader">
											    		<div class="be_message" style="display:none"></div>
											    	</div>
											    	<div style="clear:both"></div>
											    </div>
											  </form>
											</div>
										</div>
								</div>
							</div>
						</div>
						<?php if (isset($current_be_profile_related_review_ids) && !empty($current_be_profile_related_review_ids)) { ?>
							<div class="wpb_column vc_column_container td-pb-span4">
								<div class="vc_column-inner ">
									<div class="wpb_wrapper">
										<?php
										// Show all the related reviews using the builtin theme block with the provided IDS in the metabox
										preg_match_all('!\d+!', $current_be_profile_related_review_ids, $current_be_profile_related_review_ids_array);
										$relatedreviewids = implode ( "," , $current_be_profile_related_review_ids_array[0] );
										echo do_shortcode( "[td_block_5 custom_title='Reviews' post_ids='$relatedreviewids' installed_post_types='post' limit='1' ajax_pagination='next_prev']" );
										?>
									</div>
								</div>
							</div>
						<?php } ?>					
						<?php if (isset($current_be_profile_related_event_ids) && !empty($current_be_profile_related_event_ids)) { ?>
							<div class="wpb_column vc_column_container td-pb-span4">
								<div class="vc_column-inner ">
									<div class="wpb_wrapper">
										<?php
										// Show all the related events using the builtin theme block with the provided IDS in the metabox
										preg_match_all('!\d+!', $current_be_profile_related_event_ids, $current_be_profile_related_event_ids_array);
										$relatedeventids = implode ( "," , $current_be_profile_related_event_ids_array[0] );
										echo do_shortcode( "[td_block_5 custom_title='Events' post_ids='$relatedeventids' installed_post_types='post' limit='1' ajax_pagination='next_prev']" );
										?>
									</div>
								</div>
							</div>
						<?php } ?>
						<div class="wpb_column vc_column_container td-pb-span4">
							<div class="vc_column-inner ">
								<div class="wpb_wrapper">
									<div class="td-block-title-wrap"><h4 class="block-title"><span>Advertisement</span></h4></div>
									<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<!-- BeKarachi 250x250 -->
									<ins class="adsbygoogle"
									     style="display:inline-block;width:250px;height:250px"
									     data-ad-client="ca-pub-2825367626708661"
									     data-ad-slot="7041851165"></ins>
									<script>
									(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
								</div>
							</div>
						</div>
						<?php if (isset($current_be_profile_related_blog_ids) && !empty($current_be_profile_related_blog_ids)) { ?>
							<div class="wpb_column vc_column_container td-pb-span8">
								<div class="vc_column-inner ">
									<div class="wpb_wrapper">
										<?php
										// Show all the related blogs using the builtin theme block with the provided IDS in the metabox
										preg_match_all('!\d+!', $current_be_profile_related_blog_ids, $current_be_profile_related_blog_ids);
										$relatedblogids = implode ( "," , $current_be_profile_related_blog_ids[0] );
										echo do_shortcode( "[td_block_12 custom_title='Blogs' post_ids='$relatedblogids' installed_post_types='post' limit='1' ajax_pagination='next_prev']" );?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php // End the loop.
				endwhile;
				?>
			</div>
			<div class="submit-your-story-banner">
				<div class="submit-your-story-inner">
					<h2>Do you run a startup, are an entrepreneur or have an interesting story? Please fill up the form and we will get back to you</h2>
					<div class="submit-your-story-banner-button"><a href="http://bekarachi.com/submit-your-story/">Submit Your Story</a></div>
				</div>
			</div>
		</div>