<?php

function be_profiles_enqueue_files() {
    wp_enqueue_style( 'be_profiles_custom_css', get_stylesheet_directory_uri() . '/profile-module/css/be_profiles_custom_css.css' );
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/profile-module/includes/font-awesome/css/font-awesome.min.css.css' );
    wp_enqueue_script( 'be_adsense', '//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js', true );
    wp_enqueue_script( 'be_profiles_custom_js', get_stylesheet_directory_uri() . '/profile-module/js/be_profiles_custom_js.js', array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'be_profiles_custom_js', 'myAjax', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' )
        ) );
    
}

add_action( 'wp_enqueue_scripts', 'be_profiles_enqueue_files' );

function add_admin_scripts( $hook ) {

    global $post;

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( 'profile' === $post->post_type ) {    
            wp_enqueue_media();
            wp_enqueue_style(  'be_mediamodal_css', get_stylesheet_directory_uri().'/profile-module/css/be_mediamodal.css' ); 
            wp_enqueue_script(  'be_mediamodal_js', get_stylesheet_directory_uri().'/profile-module/js/be_mediamodal.js' );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );


function be_custom_post_type_init() {

    /**
     * add the td_book custom post type
     * https://codex.wordpress.org/Function_Reference/register_post_type
     */
    $args = array(
        'public' => true,
        'label'  => 'Profiles',
        'has_archive' => true,
        'supports' => array( // here we specify what the taxonomy supports
            'title',
            'editor',
            'thumbnail'
        ),
        'taxonomies' => array( 'ait-items' , 'ait-locations' ),
        'publicly_queryable' => true,
    );
    register_post_type( 'profile', $args );

    // Add new taxonomy, make it hierarchical (like categories)
    $labels = array(
        'name'              => _x( 'Profile Type', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Profile Type', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Profile Types', 'textdomain' ),
        'all_items'         => __( 'All Profile Types', 'textdomain' ),
        'parent_item'       => __( 'Parent Profile Type', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Profile Type:', 'textdomain' ),
        'edit_item'         => __( 'Edit Profile Type', 'textdomain' ),
        'update_item'       => __( 'Update Profile Type', 'textdomain' ),
        'add_new_item'      => __( 'Add New Profile Type', 'textdomain' ),
        'new_item_name'     => __( 'New Profile Type Name', 'textdomain' ),
        'menu_name'         => __( 'Profile Type', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'profile-type' ),
    );

    register_taxonomy( 'profile-type', array( 'profile' ), $args );
}
add_action('init', 'be_custom_post_type_init');

//Mailer

function be_profiles_mailer(){

    check_ajax_referer( 'be_nonce', 'security' );
    $messagename = sanitize_text_field( $_POST['messagename'] );
    $messageemail = sanitize_text_field( $_POST['messageemail'] );
    $messagesubject = sanitize_text_field( $_POST['messagesubject'] );
    $messagetext = sanitize_text_field( $_POST['messagetext'] );
    $postid = sanitize_text_field( $_POST['postid'] );
    $contactemail = sanitize_text_field( get_post_meta( $postid, 'be_profile_email', true ));
    // If the email is not entered in the profile. The email will be forwarded to hello@bekarachi.com
    if (empty($contactemail)) {
        $contactemail = sanitize_text_field("hello@bekarachi.com");
    }
    $previousnumberoftimescontact = intval(get_post_meta( $postid, 'be_metabox_times_contacted', true ));
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $messagebody = "Sent by:" . $messagename . "<" . $messageemail . ">";
    $messagebody .= "<br>";
    $messagebody .= "Message:" . $messagetext;
    // If the email is not mention who this email is intended to be sent.
    if ( $contactemail == "hello@bekarachi.com") {
        $contactname = sanitize_text_field( get_the_title( $postid ));
        $messagebody .= "<br>";
        $messagebody .= "This email was intended for " . $contactname . ". But was sent to you because there was no email provided for this user.";
    }
    $mail = wp_mail( $contactemail, $messagesubject, $messagebody , $headers);
    if (!$mail) {
        echo "NOT SENT";
    }
    else {
        $contactemailcounterupdate = intval($previousnumberoftimescontact);
        $contactemailcounterupdate++;
        update_post_meta($postid, 'be_metabox_times_contacted', sanitize_text_field( $contactemailcounterupdate ));
        echo $contactemailcounterupdate;
    }
    //do something
    wp_die();
}
add_action('wp_ajax_be_profiles_mailer', 'be_profiles_mailer');
add_action('wp_ajax_nopriv_be_profiles_mailer', 'be_profiles_mailer');


include( get_stylesheet_directory() . '/profile-module/meta-boxes/be_profile-metabox-core.php' );