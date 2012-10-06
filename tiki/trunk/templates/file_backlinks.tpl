{* $Id: file_backlinks.tpl 29142 2010-09-12 14:09:21Z changi67 $ *}
<div>
	<div class='box-title'>{if $file_backlinks_title}{tr}{$file_backlinks_title}{/tr}{else}{tr}Backlinks{/tr}{/if}</div>
	<div class='box-data'>
		<ul>
			{foreach from=$backlinks item=object}
				<li><a href="{$object.itemId|sefurl:$object.type}">{$object.name|escape}</a></li>
			{/foreach}
		</ul>
	</div>
</div>
