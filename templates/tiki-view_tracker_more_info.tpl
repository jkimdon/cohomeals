{* $Id: tiki-view_tracker_more_info.tpl 44972 2013-02-25 16:13:14Z luciash $ *}<!DOCTYPE html>
<html lang="{if !empty($pageLang)}{$pageLang}{else}{$prefs.language}{/if}">
	<head>
		{include file='header.tpl'}
	</head>
	<body{html_body_attributes}>
		{if $prefs.feature_bidi eq 'y'}
			<table dir="rtl" ><tr><td>
		{/if}
		<div id="tiki-main" class="simplebox">
			<h3>{tr}Details{/tr}</h3>
			<table class="formcolor">
				{if $info.name}
					<tr><td>{tr}Name{/tr}</td><td><b>{$info.name}</b></td></tr>
				{/if}
				{if $info.version}
					<tr><td>{tr}Version{/tr}</td><td><b>{$info.version}</b></td></tr>
				{/if}
				{if $info.longdesc}
					<tr><td colspan="2">{$info.longdesc}</td></tr>
				{/if}
				{if $info.hits}
					<tr><td>{tr}Downloads{/tr}</td><td>{$info.hits}</td></tr>
				{/if}
			</table>
			<div class="cbox">
				<a href="#" onclick="javascript:window.close();" class="link">{tr}close{/tr}</a>
			</div>
		</div>
		{if $prefs.feature_bidi eq 'y'}
			</td></tr></table>
		{/if}
		{include file='footer.tpl'}
	</body>
</html>