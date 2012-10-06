{* $Id: mod-logo.tpl 23156 2009-11-12 22:24:46Z sylvieg $ *}

{tikimodule error=$module_params.error title=$tpl_module_title name="logo" flip=$module_params.flip decorations=$module_params.decorations nobox=$module_params.nobox notitle=$module_params.notitle}
   <div id="sitelogo"{if $prefs.sitelogo_bgcolor ne ''} style="background-color: {$prefs.sitelogo_bgcolor};" {/if}>
      {if $prefs.sitelogo_src}<a href="./" title="{$prefs.sitelogo_title}"><img src="{$prefs.sitelogo_src}" alt="{$prefs.sitelogo_alt}" style="border: none" /></a>
      {/if}
   </div>
   <div id="sitetitles">
      <div id="sitetitle">
         <a href="index.php">{$prefs.sitetitle}</a>
      </div>
      <div id="sitesubtitle">{$prefs.sitesubtitle}
      </div>
   </div>
{/tikimodule}