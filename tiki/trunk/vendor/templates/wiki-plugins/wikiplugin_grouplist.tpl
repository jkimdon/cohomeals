{* $Id: wikiplugin_grouplist.tpl 25049 2010-02-11 09:11:46Z pkdille $ *}
{if empty($groups)}
{else}
	<ul>
	{foreach from=$groups item=group}
		<li>
		{if $params.linkhome eq 'y' && !empty($group.groupHome)}
			<a href="{$group.groupHome|sefurl:wiki}">
			{assign var=link value='y'}
		{/if}
		{$group.groupName|escape}
		{if !empty($link)}
			</a>
		{/if}
		</li>
	{/foreach}
	</ul>
{/if}