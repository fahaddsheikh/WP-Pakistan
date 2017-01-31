<?php //netteCache[01]000563a:2:{s:4:"time";s:21:"0.51565900 1485769552";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:78:"C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2-child\header.php";i:2;i:1485760391;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2-child\header.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'q340wffixk')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!doctype html>
<!--[if IE 8]>
<html <?php language_attributes() ?>  class="lang-<?php echo NTemplateHelpers::escapeHtmlComment($currentLang->locale) ?>
 <?php echo NTemplateHelpers::escapeHtmlComment($options->layout->custom->pageHtmlClass) ?> ie ie8">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!-->
<html <?php language_attributes() ?> class="lang-<?php echo NTemplateHelpers::escapeHtml($currentLang->locale, ENT_COMPAT) ?>
 <?php echo NTemplateHelpers::escapeHtml($options->layout->custom->pageHtmlClass, ENT_COMPAT) ?>">
<!--<![endif]-->
<head>
	<meta charset="<?php echo NTemplateHelpers::escapeHtml($wp->charset, ENT_COMPAT) ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo NTemplateHelpers::escapeHtml($wp->pingbackUrl, ENT_COMPAT) ?>" />

<?php if ($options->theme->general->favicon != "") { ?>
		<link href="<?php echo NTemplateHelpers::escapeHtml($options->theme->general->favicon, ENT_COMPAT) ?>" rel="icon" type="image/x-icon" />
<?php } ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/seo", ""), array() + get_defined_vars(), $_l->templates['q340wffixk'])->render() ?>

	<?php echo AitWpLatteMacros::googleAnalytics($options->theme->google->analyticsTrackingId, $options->theme->google->anonymizeIp) ?>


<?php wp_head() ?>

	<?php echo $options->theme->header->customJsCode ?>

</head>

<?php $searchFormClass = "" ;if ($elements->unsortable['search-form']->display) { $searchFormClass = $elements->unsortable['search-form']->option('type') != "" ? "search-form-type-".$elements->unsortable['search-form']->option('type') : "search-form-type-1" ;} ?>

<body<?php if ($_l->tmp = array_filter(array($wp->bodyHtmlClass(false), defined('AIT_REVIEWS_ENABLED') ? 'reviews-enabled':null, $searchFormClass, $options->layout->general->showBreadcrumbs ? 'breadcrumbs-enabled':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php do_action('ait-html-body-begin') ?>

<?php if ($wp->isPage) { ?>
	<div id="page" class="page-container header-one">
<?php } else { ?>
	<div id="page" class="hfeed page-container header-one">
<?php } ?>


		<header id="masthead" class="site-header" role="banner">

			<div class="top-bar">
				<div class="grid-main">

					<div class="top-bar-tools">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/social-icons", ""), array() + get_defined_vars(), $_l->templates['q340wffixk'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/languages-switcher", ""), array() + get_defined_vars(), $_l->templates['q340wffixk'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/woocommerce-cart", ""), array() + get_defined_vars(), $_l->templates['q340wffixk'])->render() ?>
					</div>
					<p class="site-description">
						<?php echo date( 'l, F j, Y' ) ?>

					</p>
						<?php echo do_shortcode('[bep_trendingnow]') ?>



				</div>
			</div>
				<div class="header-container grid-main">

					<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
						<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>
" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
						<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>

					</div>
					<div class="top-banner-widget">
<?php if ( is_active_sidebar( 'top_banner_widget' ) ) :
							dynamic_sidebar( 'top_banner_widget' );
						endif ?>
					</div>

					<div class="menu-container">
						<nav class="main-nav menu-hidden" role="navigation" data-menucollapse=<?php echo NTemplateHelpers::escapeHtml($options->theme->header->menucollapse, ENT_NOQUOTES) ?>>

							<div class="main-nav-wrap">
								<h3 class="menu-toggle"><?php echo NTemplateHelpers::escapeHtml(__('Menu', 'wplatte'), ENT_NOQUOTES) ?></h3>
<?php WpLatteMacros::menu("main", array()) ?>
							</div>
						</nav>
					</div>

				</div>


			</header><!-- #masthead -->

		<div class="sticky-menu menu-container" >
			<div class="grid-main">
				<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
					<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>
" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
					<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>
				</div>
				<nav class="main-nav menu-hidden" data-menucollapse=<?php echo NTemplateHelpers::escapeHtml($options->theme->header->menucollapse, ENT_NOQUOTES) ?>>
					<!-- wp menu here -->
				</nav>
			</div>
		</div>
