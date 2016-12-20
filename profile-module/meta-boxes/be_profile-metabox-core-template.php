<!-- Contact Stats -->
<table class="form-table">
    <tbody>
        <tr><div style="width: 100%;background-color: rgba(0,0,0,.07);padding: 10px 0;box-sizing: content-box;color: #fff;margin-left: -12px !important;margin-right: -12px !important;padding-left: 12px !important;padding-right: 12px !important;padding-top: 10px;padding-bottom: 10px;"><h2>Contact Stats</div></h2></tr>

        <?php foreach ($be_metabox_times_contacted as $key => $value) { ?>
            <tr valign="top">
                <td scope="row"><label for="<?php echo $key ?>"><h4><?php echo $value ?></h4></label></td>
                <td style="width:75%">
                    <?php $timescontacted = get_post_meta( $post->ID, $key, true ); 
                        if (isset($timescontacted) && !empty($timescontacted)) {
                            echo $timescontacted;
                        }
                        else {
                            echo "0";
                        }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- About Settings -->
<table class="form-table">
    <tbody>
        <tr><div style="width: 100%;background-color: rgba(0,0,0,.07);padding: 10px 0;box-sizing: content-box;color: #fff;margin-left: -12px !important;margin-right: -12px !important;padding-left: 12px !important;padding-right: 12px !important;padding-top: 10px;padding-bottom: 10px;"><h2>About</div></h2></tr>
        <?php foreach ($be_metabox_about as $key => $value) { ?>
            <tr valign="top">
                <td scope="row"><label for="<?php echo $key ?>"><h4><?php echo $value ?></h4></label></td>
                <td>
                    <textarea type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" cols="80" rows="8"/><?php echo get_post_meta( $post->ID, $key, true ); ?></textarea>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- General Settings -->
<table class="form-table">
    <tbody>
        <tr><div style="width: 100%;background-color: rgba(0,0,0,.07);padding: 10px 0;box-sizing: content-box;color: #fff;margin-left: -12px !important;margin-right: -12px !important;padding-left: 12px !important;padding-right: 12px !important;padding-top: 10px;padding-bottom: 10px;"><h2>General Settings</div></h2></tr>

        <?php foreach ($be_metabox_general_values as $key => $value) { ?>
            <tr valign="top">
                <td scope="row"><label for="<?php echo $key ?>"><h4><?php echo $value ?></h4></label></td>
                <td>
                	<input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo get_post_meta( $post->ID, $key, true ); ?>" class="regular-text" />
                	<p>Enter the <?php echo $value ?> here</p>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Social Settings -->
<table class="form-table">
    <tbody>
        <tr><div style="width: 100%;background-color: rgba(0,0,0,.07);padding: 10px 0;box-sizing: content-box;color: #fff;margin-left: -12px !important;margin-right: -12px !important;padding-left: 12px !important;padding-right: 12px !important;padding-top: 10px;padding-bottom: 10px;"><h2>Social Settings</div></h2></tr>

        <?php foreach ($be_metabox_social_values as $key => $value) { ?>
            <tr valign="top">
                <td scope="row"><label for="<?php echo $key ?>"><h4><?php echo $value ?></h4></label></td>
                <td>
                	<input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo get_post_meta( $post->ID, $key, true ); ?>" class="regular-text" />
                	<p>Enter the <?php echo $value ?> Link here</p>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Related Content Settings -->
<table class="form-table">
    <tbody>
        <tr><div style="width: 100%;background-color: rgba(0,0,0,.07);padding: 10px 0;box-sizing: content-box;color: #fff;margin-left: -12px !important;margin-right: -12px !important;padding-left: 12px !important;padding-right: 12px !important;padding-top: 10px;padding-bottom: 10px;"><h2>Related Content</div></h2></tr>

        <?php foreach ($be_metabox_related_content_values as $key => $value) { ?>
            <tr valign="top">
                <td scope="row"><label for="<?php echo $key ?>"><h4><?php echo $value ?></h4></label></td>
                <td>
                	<input type="text" name="<?php echo $key ?>" id="<?php echo $key ?>" value="<?php echo get_post_meta( $post->ID, $key, true ); ?>" class="regular-text" />
                	<p>Enter the ID's of the <?php echo $value ?> seperated by a comma.</p>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Gallery Content Settings -->
<table class="form-table">
    <tbody>
        <tr><div style="width: 100%;background-color: rgba(0,0,0,.07);padding: 10px 0;box-sizing: content-box;color: #fff;margin-left: -12px !important;margin-right: -12px !important;padding-left: 12px !important;padding-right: 12px !important;padding-top: 10px;padding-bottom: 10px;"><h2>Gallery Images</div></h2></tr>

        <?php foreach ($be_metabox_gallery_values as $key => $value) { ?>
            <?php
                global $post;

                // Get WordPress' media upload URL
                $upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );

                // See if there's a media id already saved as post meta
                $your_img_id = get_post_meta( $post->ID, '$key', true );

                // Get the image src
                $your_img_src = wp_get_attachment_image_src( $your_img_id );

                // For convenience, see if the array is valid
                $you_have_img = is_array( $your_img_src );

                // Get all images already attached to the gallery
                $be_attached_gallery_images = get_post_meta( $post->ID, $key, true );
                preg_match_all('!\d+!', $be_attached_gallery_images, $be_attached_gallery_images_array);
                $be_attached_gallery_images_string = implode ( "," , $be_attached_gallery_images_array[0] );
            ?>
            <div class="meta-gallery">
                <div class="meta-gallery-title">Attached Images:</div>
                <div class="meta-gallery-images">
                    <ul>
                        <?php foreach ($be_attached_gallery_images_array[0] as $be_attached_gallery_image) { ?>
                        <li><?php echo wp_get_attachment_image(  $be_attached_gallery_image, array('150', '150'), "", array( "class" => "img-responsive" , "id" => "$be_attached_gallery_image") ); ?>
                        </li>
                        <?php }?>
                    </ul>
                    <a class="upload-custom-img <?php if ( $you_have_img  ) { echo 'hidden'; } ?> button-primary" style="display: block;margin: 10px 0;" 
                           href="<?php echo $upload_link ?>">
                            <?php _e('Add Gallery Images') ?>
                    </a>
<!--                     <a class="delete-custom-img <?php if ( ! $you_have_img  ) { echo 'hidden'; } ?> button-primary" style="margin: 10px 0;"
                          href="#">
                    <?php _e('Remove Gallery Images') ?> -->
                    </a>
                </div>
                <!-- A hidden input to set and post the chosen image id -->
                <input class="custom-img-id" name="<?php echo $key ?>" id="<?php echo $key ?>" type="hidden" value="<?php echo $be_attached_gallery_images_string?>" />
            </div>
        <?php } ?>
    </tbody>
</table>