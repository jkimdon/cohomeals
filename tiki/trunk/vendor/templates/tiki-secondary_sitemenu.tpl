{* $Id: tiki-secondary_sitemenu.tpl 28331 2010-08-06 05:12:16Z pkdille $ *}
{* site header secondary menu *}
{if $prefs.feature_secondary_sitemenu_custom_code}
	<div class="clearfix" id="secondary_site_menu"><div class="wrapper">{eval var=$prefs.feature_secondary_sitemenu_custom_code}</div></div>
{/if}