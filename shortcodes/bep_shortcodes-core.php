<?php 

/*
*
* INCLUDE FILES FOR ALL SHORTCODES
*
*/

//Include ALL PHP Shortcode Details

include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big-grid-shortcode.php' );
include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big-grid_single_shortcode.php' );
include( get_stylesheet_directory() . '/shortcodes/bep_trendingnow/bep_trendingnow-shortcode.php' );
include( get_stylesheet_directory() .'/shortcodes/bep_shortcodes_1/bep_shortcodes_1.php');
include( get_stylesheet_directory() .'/shortcodes/bep_shortcodes_3/bep_shortcode_3.php');
include( get_stylesheet_directory() .'/shortcodes/bep_latest_reviews/bep_reviews-shortcode.php');
include( get_stylesheet_directory() .'/shortcodes/bep_latest_events/bep_events-shortcode.php');


/* 
*
* Sizes for all Images 
*
*/

// BIGGRID 
add_image_size( 'biggrid-large-square', 649, 500, array( 'center', 'top' ) );
add_image_size( 'biggrid-horizontal', 644, 297, array( 'center', 'top' ) );
add_image_size( 'biggrid-small', 322, 200, array( 'center', 'top' ) );

// Shortcode 1 Image Sizes
add_image_size( 'bep_shortcodes_1-big', 324, 235, array( 'center', 'top' ) );
add_image_size( 'bep_shortcodes_1-small', 100, 70, array( 'center', 'top' ) );

// Shortcode 3 Image Sizes
add_image_size( 'bep_shortcodes_3', 218,150, array( 'center', 'top' ) );




//Include ALL STYLES for Shortcodes

function bep_include_shortcode_styles() {
    wp_enqueue_style( 'bep_shortodes_reviews-style', get_stylesheet_directory_uri() . '/shortcodes/bep_shortcodes_style-core.css' );
    
    //wp_enqueue_style( 'bep_trendingnow-shortcode-style', get_stylesheet_directory_uri() . '/shortcodes/bep_trendingnow/bep_trendingnow-shortcode-style.css' );
    wp_enqueue_script( 'bep_trendingnow-shortcode-script', get_stylesheet_directory_uri() . '/shortcodes/bep_trendingnow/bep_trendingnow-shortcode-script.js', true );
    }
add_action( 'wp_enqueue_scripts', 'bep_include_shortcode_styles' );


/**
 * Register Type Metabox
 */

function bep_register_meta_boxes() {
    add_meta_box( 'bep_metaboxes', __( 'Type', 'textdomain' ), 'bep_type_box_content_callback' );
    add_meta_box( 'bep_metaboxes', __( 'BEP Event Date', 'textdomain' ), 'be_event_datefrom_content_callback', 'ait-event-pro' );
}
add_action( 'add_meta_boxes', 'bep_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function bep_type_box_content_callback( $post ) {
    // make sure the form request comes from WordPress.
    wp_nonce_field( basename( __FILE__ ), 'bep_type_box_content_nonce' );
    
    // Array for fields with respective modules.
    $bep_type = array (
        "bep_type" => "Select the type of this post",
    );
    $bep_previously_selected_type = get_post_meta( $post->ID, $key, true );

?>
	<!-- About Settings -->
	<table class="form-table">
	    <tbody>
	        <?php foreach ($bep_type as $key => $value) { ?>
	            <tr>
	                <td style="max-width:30px;"><label for="<?php echo $key ?>"><h4><?php echo $value ?></h4></label></td>
	                <td>
	                	<?php $bep_selectedtype = get_post_meta( $post->ID, $key, true ); ?>
	              	    <select name='<?php echo $key ?>' id='<?php echo $key ?>'>
				            <option value="Business" <?php if($bep_selectedtype == 'Business') : echo 'selected'; endif; ?>>Business</option>
				            <option value="Event" <?php if($bep_selectedtype == 'Event') : echo 'selected'; endif; ?> >Event</option>
				            <option value="Blog"<?php if($bep_selectedtype == 'Blog') : echo 'selected'; endif; ?> >Blog</option>
				            <option value="Profile"<?php if($bep_selectedtype == 'Profile') : echo 'selected'; endif; ?> >Profile</option>
				        </select>
	                </td>
	            </tr>
	        <?php } ?>
	    </tbody>
	</table>
<?php }

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function bep_type_box_content_save_callback( $post_id ) {
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['bep_type_box_content_nonce'] ) || !wp_verify_nonce( $_POST['bep_type_box_content_nonce'], basename( __FILE__ ) ) ){
        return;
    }
    // return if autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return;
    }
    // Check the user's permissions.
    if ( !current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // Array to submit data associated to the values.
    $bep_metaboxvalues = array (
        "bep_type" => $_POST["bep_type"],
    );

    foreach ($bep_metaboxvalues as $key => $value) {
        update_post_meta($post_id, $key, sanitize_text_field( $value ));
    }
}
add_action( 'save_post', 'bep_type_box_content_save_callback' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function be_event_datefrom_content_callback( $post ) {
    // make sure the form request comes from WordPress.
    wp_nonce_field( basename( __FILE__ ), 'be_event_datefrom_content_nonce' );
    
    // Array for fields with respective modules.
    $bep_event_date = array (
        "be_event_datefrom" => "Event Date",
    );

    $bep_selected_event_date = get_post_meta( $post->ID, $key, true );
    $bep_event_array = get_post_meta($post->ID, '_ait-event-pro_event-pro-data', true);
    $bep_event_date_selected_raw = strtotime($bep_event_array['dates'][0]['dateFrom']);
    $bep_event_date_selected_converted = date('Ymd', $bep_event_date_selected_raw);
    $bep_event_date_selected_output = date('d-m-Y', $bep_event_date_selected_raw);

?>
    <!-- About Settings -->
    <table class="form-table">
        <tbody>
            <?php foreach($bep_event_date as $key => $value) { ?>
                <tr>
                    <td style="max-width:30px;"><label for="<?php echo $key; ?>"><h4><?php echo $value; ?></h4></label></td>
                    <td>
                        <?php echo $bep_event_date_selected_output ?><br>
                        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $bep_event_date_selected_converted; ?>"><br>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }


/**
 * Save date provided in the events pro metabox content.
 *
 * @param int $post_id Post ID
 */
function be_event_datefrom_content_save_callback( $post_id ) {
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['be_event_datefrom_content_nonce'] ) || !wp_verify_nonce( $_POST['be_event_datefrom_content_nonce'], basename( __FILE__ ) ) ){
        return;
    }

    // return if autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return;
    }
    // Check the user's permissions.
    if ( !current_user_can( 'edit_post', $post_id ) ){
        return;
    }

    // Array to submit data associated to the values.
    $bep_metaboxvalues = array (
        "be_event_datefrom" => strtotime($_POST["be_event_datefrom"]),
    );

    foreach ($bep_metaboxvalues as $key => $value) {
        update_post_meta($post_id, $key,  $value);
    }
}
add_action( 'save_post', 'be_event_datefrom_content_save_callback' );

?>