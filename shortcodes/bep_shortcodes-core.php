<?php 

/*
*
* INCLUDE FILES FOR ALL SHORTCODES
*
*/

//Include ALL PHP Shortcode Details

include( get_stylesheet_directory() . '/shortcodes/bep_biggrid/bep_big-grid-shortcode.php' );
include( get_stylesheet_directory() . '/shortcodes/bep_trendingnow/bep_trendingnow-shortcode.php' );
/* 
*
* Sizes for all Images 
*
*/

// BIGGRID BigSquare Images
add_image_size( 'biggrid-large-square', 534, 462, array( 'center', 'top' ) );

// BIGGRID Horizontal Images
add_image_size( 'biggrid-horizontal', 533, 261, array( 'center', 'top' ) );

// BIGGRID Small Images
add_image_size( 'biggrid-small', 265, 198, array( 'center', 'top' ) );



//Include ALL STYLES for Shortcodes

function bep_include_shortcode_styles() {
    wp_enqueue_style( 'bep_biggrid-style', get_stylesheet_directory_uri() . '/shortcodes/bep_biggrid/big-grid-shortcode-style.css' );
    wp_enqueue_style( 'bep_trendingnow-shortcode-style', get_stylesheet_directory_uri() . '/shortcodes/bep_trendingnow/bep_trendingnow-shortcode-style.css' );
    wp_enqueue_script( 'bep_trendingnow-shortcode-script', get_stylesheet_directory_uri() . '/shortcodes/bep_trendingnow/bep_trendingnow-shortcode-script.js', true );
}
add_action( 'wp_enqueue_scripts', 'bep_include_shortcode_styles' );


/**
 * Register Type Metabox
 */

function bep_register_meta_boxes() {
    add_meta_box( 'bep_metaboxes', __( 'Type', 'textdomain' ), 'bep_type_box_content_callback' );
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

?>