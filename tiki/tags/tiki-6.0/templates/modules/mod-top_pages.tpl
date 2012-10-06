{* $Id: mod-top_pages.tpl 26273 2010-03-23 12:02:11Z sylvieg $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="top_pages" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
{modules_list list=$modTopPages nonums=$nonums}
	{section name=ix loop=$modTopPages}
		<li>
			<a class="linkmodule" href="tiki-index.php?page={$modTopPages[ix].name|escape:'url'}">
				{$modTopPages[ix].name|escape}
			</a>
		</li>
	{/section}
{/modules_list}
{/tikimodule}
