<?php //netteCache[01]000583a:2:{s:4:"time";s:21:"0.85927700 1485769605";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:98:"C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2\portal\parts\single-item-gallery.php";i:2;i:1480566560;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2\portal\parts\single-item-gallery.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '2r2ouif9ki')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
$gallery = array() ?>

<?php if ($post->hasImage) { array_push($gallery, array(
		'title' => $post->title,
		'image' => $post->imageUrl
	)) ;} ?>

<?php if ($meta->displayGallery && is_array($meta->gallery)) { $gallery = array_merge($gallery, $meta->gallery) ;} ?>

<?php if (count($gallery) > 0) { if (count($gallery) == 1) { ?>
		<section class="elm-main elm-easy-slider-main gallery-single-image">
			<div class="elm-easy-slider-wrapper">
				<div class="elm-easy-slider easy-pager-thumbnails pager-pos-outside detail-thumbnail-wrap detail-thumbnail-slider">
					<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>

<?php if (defined('AIT_REVIEWS_ENABLED')) { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("portal/parts/single-item-reviews-stars", ""), array('showCount' => true, 'class' => "gallery-visible") + get_defined_vars(), $_l->templates['2r2ouif9ki'])->render() ;} ?>

					<ul class="easy-slider"><!--
<?php $iterations = 0; foreach ($gallery as $item) { $title = AitLangs::getCurrentLocaleText($item['title']) ?>
					--><li>
							<a href="<?php echo aitResizeImage($item['image'], array('width' => 1000, 'crop' => 1)) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($title, ENT_COMPAT) ?>" target="_blank" rel="item-gallery">
								<span class="easy-thumbnail">
									<?php if ($title != "") { ?><span class="easy-title"><?php echo NTemplateHelpers::escapeHtml($title, ENT_NOQUOTES) ?>
</span><?php } ?>

									<img src="<?php echo aitResizeImage($item['image'], array('width' => 400, 'crop' => 1)) ?>
" alt="<?php echo NTemplateHelpers::escapeHtml($title, ENT_COMPAT) ?>" />
								</span>
							</a>
						</li><!--
<?php $iterations++; } ?>
					--></ul>
				</div>
				<script type="text/javascript">
					jQuery(window).load(function(){
<?php if ($options->theme->general->progressivePageLoading) { ?>
							if(!isResponsive(1024)){
								jQuery(".detail-thumbnail-slider").waypoint(function(){
									jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
									jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
										jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
										jQuery.waypoints('refresh');
									});
								}, { triggerOnce: true, offset: "95%" });
							} else {
								jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
								jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
									jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
									jQuery.waypoints('refresh');
								});
							}
<?php } else { ?>
							jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
							jQuery('.detail-thumbnail-slider').find('ul').delay(500).animate({'opacity':1}, 500, function(){
								jQuery('.detail-thumbnail-slider').find('.loading').fadeOut('fast');
								jQuery.waypoints('refresh');
							});
<?php } ?>
					});
				</script>
			</div>
		</section>
<?php } else { ?>
		<section class="elm-main elm-easy-slider-main gallery-multiple-image">
			<div class="elm-easy-slider-wrapper">
				<div class="elm-easy-slider easy-pager-thumbnails pager-pos-outside detail-thumbnail-wrap detail-thumbnail-slider">
					<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>

<?php if (defined('AIT_REVIEWS_ENABLED')) { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("portal/parts/single-item-reviews-stars", ""), array('showCount' => true) + get_defined_vars(), $_l->templates['2r2ouif9ki'])->render() ;} ?>

					<ul class="easy-slider"><!--
<?php $iterations = 0; foreach ($gallery as $item) { $title = AitLangs::getCurrentLocaleText($item['title']) ?>
					--><li>
							<a href="<?php echo NTemplateHelpers::escapeHtml($item['image'], ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($title, ENT_COMPAT) ?>" target="_blank" rel="item-gallery">
								<span class="easy-thumbnail">
									<?php if ($title != "") { ?><span class="easy-title"><?php echo $title ?>
</span><?php } ?>

									<img src="<?php echo aitResizeImage($item['image'], array('width' => 400, 'crop' => 1)) ?>
" alt="<?php echo $title ?>" />
								</span>
							</a>
						</li><!--
<?php $iterations++; } ?>
					--></ul>
					<div class="easy-slider-pager">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($gallery) as $item) { $title = AitLangs::getCurrentLocaleText($item['title']) ?>
						<a data-slide-index="<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter()-1, ENT_COMPAT) ?>
" href="#" title="<?php echo $title ?>">
							<span class="entry-thumbnail-icon">
								<img src="<?php echo aitResizeImage($item['image'], array('width' => 100, 'height' => 75, 'crop' => 1)) ?>
" alt="<?php echo $title ?>" class="detail-image" />
							</span>
						</a>
<?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
					</div>
				</div>
				<script type="text/javascript">
					jQuery(window).load(function(){
<?php if ($options->theme->general->progressivePageLoading) { ?>
							if(!isResponsive(1024)){
								jQuery(".detail-thumbnail-slider").waypoint(function(){
									portfolioSingleEasySlider("4:3");
									jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
								}, { triggerOnce: true, offset: "95%" });
							} else {
								portfolioSingleEasySlider("4:3");
								jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
							}
<?php } else { ?>
							portfolioSingleEasySlider("4:3");
							jQuery(".detail-thumbnail-slider").parent().parent().addClass('load-finished');
<?php } ?>
					});
				</script>
			</div>
		</section>
<?php } } 