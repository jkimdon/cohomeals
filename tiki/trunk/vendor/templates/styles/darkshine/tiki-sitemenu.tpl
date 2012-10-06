{* $Id: tiki-sitemenu.tpl 28331 2010-08-06 05:12:16Z pkdille $ *}
{* site header horizontal menu *}
{if $prefs.feature_sitemenu eq 'y'}
	{if $prefs.feature_cssmenus eq 'y'}
		<table id="listcontainer"><tr><td>{menu id=$prefs.feature_topbar_id_menu type=horiz css=y}</td></tr></table>
	{elseif $prefs.feature_phplayers eq 'y'}
		{phplayers id=$prefs.feature_topbar_id_menu type=horiz}
	{/if}
{/if}