<?php 

/**
 * Register meta box(es).
 */
function be_register_meta_boxes() {
    add_meta_box( 'be_metaboxes', __( 'Profile Details', 'textdomain' ), 'be_profile_box_content_callback', 'profile' );
}
add_action( 'add_meta_boxes', 'be_register_meta_boxes' );


/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function be_profile_box_content_callback( $post ) {
    // make sure the form request comes from WordPress.
    wp_nonce_field( basename( __FILE__ ), 'be_profile_box_content_nonce' );
    
    // Array for fields with respective modules.
    $be_metabox_times_contacted = array (
        "be_metabox_times_contacted" => "Number of times Contacted",
    );

    $be_metabox_about = array (
        "be_profile_about" => "About"
    );
    
    $be_metabox_general_values = array (
        "be_profile_occupation" => "Occupation",
        "be_profile_city" => "City",
        "be_profile_address" => "Address",
        "be_profile_landline_number" => "Landline Number",
        "be_profile_mobile_number" => "Mobile Number",
        "be_profile_email" => "Email",
        "be_profile_website" => "Website"
    );

    $be_metabox_social_values = array (
        "be_profile_facebook" => "Facebook",
        "be_profile_twitter" => "Twitter",
        "be_profile_instagram" => "Instagram",
        "be_profile_linkdln" => "Linkdln",
        "be_profile_google" => "Google",
        "be_profile_youtube" => "Youtube",
    );

    $be_metabox_related_content_values = array (
        "be_profile_related_video_ids" => "Related Videos",
        "be_profile_related_review_ids" => "Related Reviews",
        "be_profile_related_event_ids" => "Related Events",
        "be_profile_related_blog_ids" => "Related Blogs",
    );

    $be_metabox_gallery_values = array (
        "be_profile_gallery_ids" => "Gallery"
    );


    include( get_stylesheet_directory() . '/profile-module/meta-boxes/be_profile-metabox-core-template.php' );
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function be_profile_box_content_save_callback( $post_id ) {
    // verify taxonomies meta box nonce
    if ( !isset( $_POST['be_profile_box_content_nonce'] ) || !wp_verify_nonce( $_POST['be_profile_box_content_nonce'], basename( __FILE__ ) ) ){
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
    $be_metaboxvalues = array (
        "be_profile_about" => $_POST["be_profile_about"],
        "be_profile_occupation" => $_POST["be_profile_occupation"],
        "be_profile_city" => $_POST["be_profile_city"],
        "be_profile_address" => $_POST["be_profile_address"],
        "be_profile_landline_number" => $_POST["be_profile_landline_number"],
        "be_profile_mobile_number" => $_POST["be_profile_mobile_number"],
        "be_profile_email" => $_POST["be_profile_email"],
        "be_profile_website" => $_POST["be_profile_website"],
        "be_profile_facebook" => $_POST["be_profile_facebook"],
        "be_profile_twitter" => $_POST["be_profile_twitter"],
        "be_profile_instagram" => $_POST["be_profile_instagram"],
        "be_profile_linkdln" => $_POST["be_profile_linkdln"],
        "be_profile_google" => $_POST["be_profile_google"],
        "be_profile_youtube" => $_POST["be_profile_youtube"],
        "be_profile_related_video_ids" => $_POST["be_profile_related_video_ids"],
        "be_profile_related_review_ids" => $_POST["be_profile_related_review_ids"],
        "be_profile_related_event_ids" => $_POST["be_profile_related_event_ids"],
        "be_profile_related_blog_ids" => $_POST["be_profile_related_blog_ids"],
        "be_profile_gallery_ids" => $_POST["be_profile_gallery_ids"]
    );

    foreach ($be_metaboxvalues as $key => $value) {
        update_post_meta($post_id, $key, sanitize_text_field( $value ));
    }
}
add_action( 'save_post', 'be_profile_box_content_save_callback' );
?>