{* $Id: tiki-articles-js.tpl 24849 2010-02-04 19:24:53Z jonnybradley $ *}
{jq notonready=true}
	var articleTypes = new Array();
{{foreach from=$types key=type item=properties}
	typeProp = new Array();
	{foreach from=$properties key=prop item=value}
		typeProp['{$prop|escape}'] = '{$value|escape}';
	{/foreach}
	articleTypes['{$type|escape}'] = typeProp;
{/foreach}}
{/jq}
