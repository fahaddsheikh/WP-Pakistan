<?php
/**
 * default search form
 */

$current_posttype = $wp_query->query;

function bep_categories_out($categories, $post_type) {
	// Get the categories for post and product post types
	$fetch_categories = get_terms($categories, array(
	 	'post_type' => $post_type,
	 	'fields' => 'all',
	 	'hide_empty' => 0
	));

	echo "<select name=" . esc_attr($categories) . ">";
	echo "<option disabled selected>Select One</option>";
	foreach($fetch_categories as $fetch_category) {
		echo "<option value='" . esc_attr($fetch_category->slug) . "'>" . esc_attr($fetch_category->name) . "</option>"; 
	}
	echo "</select>";
}
?>

<form role="search" method="get" id="bep_custom-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="search-wrap">
        <input type="search" placeholder="<?php echo esc_attr( 'Search…', 'presentation' ); ?>" name="s" id="search-input" value="<?php echo esc_attr( get_search_query() ); ?>" />
        <input type="hidden" name="post_type" value="<?php echo esc_attr($current_posttype['post_type'])?>">
        <?php 
	        if ($current_posttype['post_type'] == 'profile') {
	        	bep_categories_out('profile-type', $current_posttype);
	        }
	        elseif ($current_posttype['post_type'] == 'ait-item') {
	        	bep_categories_out('ait-items', $current_posttype);
	        	bep_categories_out('ait-locations', $current_posttype);
       			echo "<input type='hidden' name='a' value='true'>";
	        } 
        ?>
        <input class="screen-reader-text" type="submit" id="search-submit" value="Search" />
    </div>
</form>