{* $Id: wikiplugin_tabs.tpl 29354 2010-09-17 18:00:01Z jonnybradley $ 
 * smarty template for tabs wiki plugin 
 *}
{tabset name=$tabsetname|escape}
	{section name=ix loop=$tabs}{tab name=$tabs[ix]|escape}{$tabcontent[ix]}{/tab}{/section}
{/tabset}