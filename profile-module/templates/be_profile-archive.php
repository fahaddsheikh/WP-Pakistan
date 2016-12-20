<div class="td-main-content-wrap td-main-page-wrap profile-archive">
	<div class="td-container tdc-content-wrap">
		<div class="vc_row wpb_row td-pb-row">
			<div class="wpb_column vc_column_container td-pb-span12 profile-archive">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<?php
							/*
							*	TO FETCH ALL IDS ASSOCIATED TO THE FEATURED CATEGORY 
								IN THE PROFILE-TYPE TAXONOMY
							*/ 
							$be_featured_category_args = array(
								 'posts_per_page' => 5,
								 'post_type' => 'profile',
								 'profile-type' => 'featured',
								 'post_status' => 'publish'
							);
							$be_get_featured_category_items = get_posts( $be_featured_category_args );
							$be_get_featured_items_array = array();

							if ( !empty($be_get_featured_category_items) ) {
								foreach ($be_get_featured_category_items as $be_get_featured_category_item) {
									$be_get_featured_category_item_postid = $be_get_featured_category_item->ID;
									if ( !empty($be_get_featured_category_item_postid) ) {
										array_push ( $be_get_featured_items_array , $be_get_featured_category_item_postid );
									}
								}
								$be_posts_in_featured_category = implode( "," , $be_get_featured_items_array );
								echo do_shortcode("[td_block_big_grid_1 post_ids='$be_posts_in_featured_category' installed_post_types='profile']" );
							} 
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="td-container td-pb-article-list">
		<div class="td-pb-row">
			<div class="td-pb-span12 td-main-content">
				<div class="td-ss-main-content">
					<?php
						/*
						*	TO FETCH ALL IDS ASSOCIATED TO THE ENTREPRENEURS CATEGORY 
							IN THE PROFILE-TYPE TAXONOMY
						*/
						$be_entrepreneurs_category_items_args = array(
							 'posts_per_page' => -1,
							 'post_type' => 'profile',
							 'profile-type' => 'entrepreneurs',
							 'post_status' => 'publish'
						);
						$be_get_entrepreneurs_category_items = get_posts( $be_entrepreneurs_category_items_args );
						$be_get_entrepreneurs_items_array = array();

						if ( !empty($be_get_entrepreneurs_category_items) ) {
							foreach ($be_get_entrepreneurs_category_items as $be_get_entrepreneurs_category_item) {
								$be_get_entrepreneurs_category_item_postid = $be_get_entrepreneurs_category_item->ID;
								if ( !empty($be_get_entrepreneurs_category_item_postid) ) {
									array_push ( $be_get_entrepreneurs_items_array , $be_get_entrepreneurs_category_item_postid );
								}
							}
							$be_posts_in_entrepreneurs_category = implode( "," , $be_get_entrepreneurs_items_array );
							echo do_shortcode("[td_block_13 header_color='#da3b46' custom_title='Entrepreneurs' post_ids='$be_posts_in_entrepreneurs_category' installed_post_types='profile' limit='6' el_class='red-block' ajax_pagination='next_prev']" ); 
						}

						/*
						*	TO FETCH ALL IDS ASSOCIATED TO THE MEDIA CATEGORY 
							IN THE PROFILE-TYPE TAXONOMY
						*/
						$be_media_category_items_args = array(
							 'posts_per_page' => -1,
							 'post_type' => 'profile',
							 'profile-type' => 'media',
							 'post_status' => 'publish'
						);
						$be_get_media_category_items = get_posts( $be_media_category_items_args );
						$be_get_media_items_array = array();

						if ( !empty($be_get_media_category_items) ) {
							foreach ($be_get_media_category_items as $be_get_media_category_item) {
								$be_get_media_category_item_postid = $be_get_media_category_item->ID;
								if ( !empty($be_get_media_category_item_postid) ) {
									array_push ( $be_get_media_items_array , $be_get_media_category_item_postid );
								}
							}
							$be_posts_in_media_category = implode( "," , $be_get_media_items_array );
							echo do_shortcode("[td_block_13 header_color='#2860a5' custom_title='Media' post_ids='$be_posts_in_media_category' installed_post_types='profile' limit='6' ajax_pagination='next_prev' el_class='blue-block']" ); 
						}

						/*
						*	TO FETCH ALL IDS ASSOCIATED TO THE ACTIVISTS CATEGORY 
							IN THE PROFILE-TYPE TAXONOMY
						*/
						$be_activists_category_items_args = array(
							 'posts_per_page' => -1,
							 'post_type' => 'profile',
							 'profile-type' => 'activists',
							 'post_status' => 'publish'
						);
						$be_get_activists_category_items = get_posts( $be_activists_category_items_args );
						$be_get_activists_items_array = array();

						if ( !empty($be_get_activists_category_items) ) {
							foreach ($be_get_activists_category_items as $be_get_activists_category_item) {
								$be_get_activists_category_item_postid = $be_get_activists_category_item->ID;
								if ( !empty($be_get_activists_category_item_postid) ) {
									array_push ( $be_get_activists_items_array , $be_get_activists_category_item_postid );
								}
							}
							$be_posts_in_activists_category = implode( "," , $be_get_activists_items_array );
							echo do_shortcode("[td_block_13 header_color='#da3b46' custom_title='Activists' post_ids='$be_posts_in_activists_category' installed_post_types='profile' limit='6' ajax_pagination='next_prev' el_class='red-block']" ); 
						}
					?>
                </div>
            </div>

        </div>
	</div>
	<div class="submit-your-story-banner">
		<div class="submit-your-story-inner">
		<h2>Do you run a startup, are an entrepreneur or have an interesting story? Please fill up the form and we will get back to you</h2>
		<div class="submit-your-story-banner-button"><a href="http://bekarachi.com/submit-your-story/">Submit Your Story</a></div>
	</div>
</div>
</div>
