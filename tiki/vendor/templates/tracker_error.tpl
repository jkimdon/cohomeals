{strip}
{* $Id: tracker_error.tpl 28804 2010-08-31 14:05:01Z xavidp $ *}
{****  Display warnings about incorrect values and missing mandatory fields ***}
{if count($err_mandatory) > 0}
{remarksbox type='errors' title="{tr}Errors{/tr}"}
	<em class='mandatory_note'>{tr}Following mandatory fields are missing{/tr}</em>&nbsp;:<br/>
	{section name=ix loop=$err_mandatory}
		{$err_mandatory[ix].name|escape}
		{if !$smarty.section.ix.last},&nbsp;{/if}
	{/section}
{/remarksbox}
{/if}

{if count($err_value) > 0}
{remarksbox type='errors' title="{tr}Errors{/tr}"}
	<em class='mandatory_note'>{tr}Following fields are incorrect{/tr}</em>&nbsp;:<br/>
	{section name=ix loop=$err_value}
		{$err_value[ix].name|escape}
		{if !empty($err_value[ix].errorMsg)} (<em>{$err_value[ix].errorMsg|escape}</em>){/if}
		{if !$smarty.section.ix.last},&nbsp;{/if}
	{/section}
{/remarksbox}
{/if}
{/strip}