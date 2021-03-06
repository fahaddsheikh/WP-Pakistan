<!doctype html>
<!--[if IE 8]>
<html {languageAttributes}  class="lang-{$currentLang->locale} {$options->layout->custom->pageHtmlClass} ie ie8">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!-->
<html {languageAttributes} class="lang-{$currentLang->locale} {$options->layout->custom->pageHtmlClass}">
<!--<![endif]-->
<head>
	<meta charset="{$wp->charset}">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{$wp->pingbackUrl}">

	{if $options->theme->general->favicon != ""}
		<link href="{$options->theme->general->favicon}" rel="icon" type="image/x-icon" />
	{/if}

	{includePart parts/seo}

	{googleAnalytics $options->theme->google->analyticsTrackingId, $options->theme->google->anonymizeIp}

	{wpHead}

	{!$options->theme->header->customJsCode}
</head>

{var $searchFormClass = ""}
{if $elements->unsortable[search-form]->display}
	{var $searchFormClass = $elements->unsortable[search-form]->option('type') != "" ? "search-form-type-".$elements->unsortable[search-form]->option('type') : "search-form-type-1"}
{/if}

<body n:class="$wp->bodyHtmlClass(false), defined('AIT_REVIEWS_ENABLED') ? reviews-enabled, $searchFormClass, $options->layout->general->showBreadcrumbs ? breadcrumbs-enabled">
	{* usefull for inline scripts like facebook social plugins scripts, etc... *}
	{doAction ait-html-body-begin}

	{if $wp->isPage}
	<div id="page" class="page-container header-one">
	{else}
	<div id="page" class="hfeed page-container header-one">
	{/if}


		<header id="masthead" class="site-header" role="banner">

			<div class="top-bar">
				<div class="grid-main">

					<div class="top-bar-tools">
					{includePart parts/social-icons}
					{includePart parts/languages-switcher}
					{includePart "parts/woocommerce-cart"}
					</div>
					<p class="site-description">
						{?
						 	echo date( 'l, F j, Y' ); 
						}
					</p>
						{?
						echo do_shortcode('[bep_trendingnow]');	
						}


				</div>
			</div>
				<div class="header-container grid-main">

					<div class="site-logo">
						{if $options->theme->header->logo}
						<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
						{else}
						<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
						{/if}

					</div>
					<div class="top-banner-widget">
						{? if ( is_active_sidebar( 'top_banner_widget' ) ) :
							dynamic_sidebar( 'top_banner_widget' );
						endif; }
					</div>

					<div class="menu-container">
						<nav class="main-nav menu-hidden" role="navigation" data-menucollapse={$options->theme->header->menucollapse}>

							<div class="main-nav-wrap">
								<h3 class="menu-toggle">{__ 'Menu'}</h3>
								{menu main}
							</div>
						</nav>
					</div>

				</div>


			</header><!-- #masthead -->

		<div class="sticky-menu menu-container" >
			<div class="grid-main">
				<div class="site-logo">
					{if $options->theme->header->logo}
					<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
					{else}
					<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
					{/if}
				</div>
				<nav class="main-nav menu-hidden" data-menucollapse={$options->theme->header->menucollapse}>
					<!-- wp menu here -->
				</nav>
			</div>
		</div>
