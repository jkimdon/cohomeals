{* based on $Id: mod-freetags_morelikethis.tpl 27983 2010-07-14 12:59:08Z sylvieg $ *}

{if isset($modMoreLikeThis) && count($modMoreLikeThis) gt 0}
  {tikimodule error=$module_params.error title=$tpl_module_title name="freetags_morelikethis" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
  {if ($nonums eq 'y')}<ul>{else}<ol>{/if}
  {foreach item=row from=$modMoreLikeThis}
     <li><a class="linkmodule" href="{$row.href|escape}">{$row.name|escape}</a></li>
  {/foreach}
  {if ($nonums eq 'y')}</ul>{else}</ol>{/if}
  {/tikimodule}
{/if}
