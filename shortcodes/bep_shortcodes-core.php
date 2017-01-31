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
include( get_stylesheet_directory() .'/shortcodes/bep_custom_functions.php');

/* 
*
* Sizes for all Images 
*
*/

// BIGGRID 
add_image_size( 'bep_649x500', 649, 500, array( 'center', 'top' ) ); // for biggrid-large-square and biggrid-horizontal
add_image_size( 'bep_324x235', 324, 235, array( 'center', 'top' ) ); // for biggrid-small, bep_shortcodes_1-big and bep_shortcodes_3
add_image_size( 'bep_100x70', 100, 70, array( 'center', 'top' ) ); // for bep_shortcodes_1-small




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
    add_meta_box( ' ', __( 'BEP Event Date', 'textdomain' ), 'be_event_datefrom_content_callback', 'ait-event-pro' );
}
add_action( 'add_meta_boxes', 'bep_register_meta_boxes' );

/**
 * Date Meta box display callback.
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
add_action( 'save_post_ait-event-pro', 'be_event_datefrom_content_save_callback' );



?>