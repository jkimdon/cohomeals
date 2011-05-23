{section name=d loop=$printDay}

<span style="font-size:16pt;color:#3366ff;">{$printDay[d].day|tiki_date_format:"%A, %b %e"}</span><br />

{section name=bd loop=$printDay[d].birthdays}
<b><span style="font-size: 11pt;">{$printDay[d].birthdays[bd]|escape}</span></b><br />
{/section}

<span style="font-size: 11pt;">

{section name=ev loop=$printDay[d].events}
<table>
<tr>
<td nowrap>
{if $printDay[d].events[ev].start eq $printDay[d].events[ev].end}
  {$printDay[d].events[ev].start|tiki_date_format:"%I:%M%p"} -- 
{else}
  {$printDay[d].events[ev].start|tiki_date_format:"%I:%M%p"}-{$printDay[d].events[ev].end|tiki_date_format:"%I:%M%p"} -- 
{/if}
</td>
<td><b>{$printDay[d].events[ev].name|escape}</b> (Location: {$printDay[d].events[ev].location|escape})</td>
</tr><tr>
<td></td><td>{$printDay[d].events[ev].description|nl2br}</td>
</tr></table>
{/section}


{section name=gr loop=$printDay[d].guestroom}
<b>Guest Room</b> - Please welcome {$printDay[d].guestroom[gr].visitor|escape}, guest of {$printDay[d].guestroom[gr].host|escape}. Expected to arrive on {$printDay[d].guestroom[gr].start|tiki_date_format:"%a, %b %e"} at {$printDay[d].guestroom[gr].start|tiki_date_format:"%I:%M%p"} and leave on {$printDay[d].guestroom[gr].end|tiki_date_format:"%a, %b %e"} at {$printDay[d].guestroom[gr].end|tiki_date_format:"%I:%M%p"}
<br />
{/section}

</span>

<br /><br />

{/section}


<span style="font-size:16pt;color:#993300;">Visitors</span><br />

{section name=vi loop=$visitors}
{$visitors[vi].startTimeStamp|tiki_date_format:"%b %e"} to {$visitors[vi].endTimeStamp|tiki_date_format:"%b %e"} -- <b>{$visitors[vi].name|escape}</b>. {$visitors[vi].description|nl2br}
<br />
<br />
{/section}
<br />

<span style="font-size:16pt;color:#993300;">People who are or will be away</span>
<br />

{section name=vi loop=$absent}
{$absent[vi].startTimeStamp|tiki_date_format:"%b %e"} to {$absent[vi].endTimeStamp|tiki_date_format:"%b %e"} -- <b>{$absent[vi].name|escape}</b>. {$absent[vi].description|nl2br}
<br />
<br />
{/section}

