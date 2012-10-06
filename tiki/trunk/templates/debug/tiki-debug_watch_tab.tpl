{* $Id: tiki-debug_watch_tab.tpl 17641 2009-03-26 14:24:18Z sylvieg $ *}

<table  id="watchlist">
  <caption> {tr}Watchlist{/tr} </caption>
  <tr>
    <th>Variable</th>
    <th>Value</th>
  </tr>
  {cycle values="even,odd" print=false}
  {section name=i loop=$watchlist}
    <tr>
      <td class="{cycle advance=false}"{if $smarty.section.i.index == 0} id="firstrow"{/if}>
        <code>{$watchlist[i].var}</code>
      </td>
      <td class="{cycle}"{if $smarty.section.i.index == 0} id="firstrow"{/if}>
        <pre>{$watchlist[i].value|escape:"html"|wordwrap:60:"\n":true|replace:"\n":"<br />"}</pre>
      </td>
    </tr>
  {/section}
</table>