 {* $Id: wikiplugin_catorphans.tpl 28368 2010-08-07 15:28:06Z jonnybradley $ *}

{foreach from=$pages item=pg}
		 <a href="{$pg.pageName|sefurl}">{$pg.pageName|escape}</a><br />
{/foreach}
{if $pagination.step ne -1}
	{pagination_links cant=$pagination.cant step=$pagination.step offset=$pagination.offset}{/pagination_links}
{/if}