<?php //netteCache[01]000594a:2:{s:4:"time";s:21:"0.96654300 1485769567";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:108:"C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2\ait-theme\elements\page-title\page-title.latte";i:2;i:1480566560;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.1";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:3:"1.0";}}}?><?php

// source file: C:\xampp\htdocs\local_bepakistan\wp-content\themes\directory2\ait-theme\elements\page-title\page-title.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'gwh4nx5mn6')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if (($wp->isBlog and $blog) or !$wp->isHome) { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/page-title", ""), array() + get_defined_vars(), $_l->templates['gwh4nx5mn6'])->render() ?>

<?php } 