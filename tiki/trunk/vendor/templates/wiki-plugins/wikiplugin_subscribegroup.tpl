{* $Id: wikiplugin_subscribegroup.tpl 25765 2010-02-27 18:34:19Z sylvieg $ *}
{strip}
<form method="post">
<input type="hidden" name="group" value="{$subscribeGroup|escape}" />
<input type="hidden" name="iSubscribeGroup" value="{$iSubscribeGroup}" />
{$text|escape}
<div><input type="submit" name="subscribeGroup" value="{tr}{$action}{/tr}" /></div>
</form>
{/strip}