{* $Id: tiki-list_surveys.tpl 29081 2010-09-09 20:56:56Z changi67 $ *}
{title help="Surveys"}{tr}Surveys{/tr}{/title}

<div class="navbar">
	{if $tiki_p_view_survey_stats eq 'y'}
		{button href="tiki-survey_stats.php" _text="{tr}Survey stats{/tr}"}
	{/if}
	{if $tiki_p_admin_surveys eq 'y'}
		{button href="tiki-admin_surveys.php" _text="{tr}Create New Survey{/tr}"}
	{/if}
</div>

<table class="normal">
	<tr>
		<th>
			<a href="tiki-list_surveys.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'name_desc'}name_asc{else}name_desc{/if}">{tr}Name{/tr}</a>
		</th>
		<th>{tr}Questions{/tr}</th>
		<th>{tr}Actions{/tr}</th>
	</tr>
	{cycle values="odd,even" print=false}
	{section name=user loop=$channels}
		{if ($tiki_p_admin eq 'y') or ($channels[user].individual eq 'n' and $tiki_p_take_survey eq 'y') or ($channels[user].individual_tiki_p_take_survey eq 'y')}
			<tr class="{cycle}">
				<td>
					{if ($tiki_p_admin_surveys eq 'y') or ($channels[user].status eq 'o' and $channels[user].taken_survey eq 'n')}
						<a class="tablename" href="tiki-take_survey.php?surveyId={$channels[user].surveyId}">{$channels[user].name|escape}</a>
					{else}
						<a class="link" href="tiki-survey_stats_survey.php?surveyId={$channels[user].surveyId}">{$channels[user].name|escape}</a>
					{/if}
					<div class="subcomment">{wiki}{$channels[user].description|escape}{/wiki}</div>
				</td>
				<td>
					{$channels[user].questions}
				</td>
				<td>
					{if ($tiki_p_admin eq 'y') or ($channels[user].individual eq 'n' and $tiki_p_admin_surveys eq 'y') or ($channels[user].individual_tiki_p_admin_surveys eq 'y')}
						<a href="tiki-admin_surveys.php?surveyId={$channels[user].surveyId}">{icon _id='page_edit' alt="{tr}Edit this Survey{/tr}"}</a>
					{/if}
					
					{if ($tiki_p_admin_surveys eq 'y') or ($channels[user].status eq 'o' and $channels[user].taken_survey eq 'n')}
						<a href="tiki-take_survey.php?surveyId={$channels[user].surveyId}">{icon _id='control_play' alt="{tr}Take Survey{/tr}"}</a>
					{/if}

					{if ($tiki_p_admin eq 'y') or ($channels[user].individual eq 'n' and $tiki_p_view_survey_stats eq 'y') or ($channels[user].individual_tiki_p_view_survey_stats eq 'y')}
						<a href="tiki-survey_stats_survey.php?surveyId={$channels[user].surveyId}">{icon _id='chart_curve' alt="{tr}Stats{/tr}"}</a>
					{/if}
				</td>
			</tr>
		{/if}
	{sectionelse}
		<tr>
			<td class="odd" colspan="3">
				<b>{tr}No records found{/tr}</b>
			</td>
		</tr>
	{/section}
</table>

{pagination_links cant=$cant_pages step=$maxRecords offset=$offset}{/pagination_links}
