{* $Id: tiki-ajax_header.tpl 29170 2010-09-13 15:46:36Z jonnybradley $ *}
{if $prefs.feature_ajax eq 'y'}
	{if $prefs.ajax_xajax eq 'y'}
		{$xajax_js}
	{/if}
<div id="ajaxLoading">{tr}Loading...{/tr}</div>
<div id="ajaxLoadingBG">&nbsp;</div>
<div id="ajaxDebug"></div>
{/if}
