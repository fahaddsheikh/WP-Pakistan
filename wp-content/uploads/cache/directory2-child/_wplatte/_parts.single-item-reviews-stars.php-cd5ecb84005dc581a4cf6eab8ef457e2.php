<?php //netteCache[01]000590a:2:{s:4:"time";s:21:"0.88327800 1485769605";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:104:"C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2\portal\parts\single-item-reviews-stars.php";i:2;i:1480566560;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2\portal\parts\single-item-reviews-stars.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '4jvkd2g738')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$rating_count = AitItemReviews::getRatingCount($post->id) ;$rating_mean = floatval(get_post_meta($post->id, 'rating_mean', true)) ?>

<?php $showCount = isset($showCount) ? $showCount : false ?>

<?php $class = isset($class) ? $class : '' ?>
<div class="review-stars-container <?php echo NTemplateHelpers::escapeHtml($class, ENT_COMPAT) ?>">
<?php if ($rating_count > 0) { ?>
		<div class="content rating-star-shown" itemscope itemtype="http://data-vocabulary.org/Review-aggregate">
						<span style="display: none" itemprop="itemreviewed"><?php echo $post->title ?></span>
			<span style="display: none" itemprop="rating"><?php echo NTemplateHelpers::escapeHtml($rating_mean, ENT_NOQUOTES) ?></span>
			<span style="display: none" itemprop="count"><?php echo NTemplateHelpers::escapeHtml($rating_count, ENT_NOQUOTES) ?></span>
						<span class="review-stars" data-score="<?php echo NTemplateHelpers::escapeHtml($rating_mean, ENT_COMPAT) ?>"></span>
			<?php if ($showCount) { ?><span class="review-count">(<?php echo NTemplateHelpers::escapeHtml($rating_count, ENT_NOQUOTES) ?>
)</span><?php } ?>

			<a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>
#review"><?php _e('Submit your rating', 'ait-item-reviews') ?></a>
		</div>
<?php } else { ?>
		<div class="content rating-text-shown">
			<a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>
#review"><?php _e('Submit your rating', 'ait-item-reviews') ?></a>
		</div>
<?php } ?>
</div>