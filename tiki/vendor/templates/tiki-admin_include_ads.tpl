{* $Id: tiki-admin_include_ads.tpl 29037 2010-09-08 18:53:29Z changi67 $ *}
{remarksbox type="tip" title="{tr}Tip{/tr}"}
	{tr}Select <a href="tiki-list_banners.php" title="Banners">Admin &gt; Banners</a> from the menu to create and edit banner zones.{/tr}
{/remarksbox}

<form action="tiki-admin.php?page=ads" onreset="return(confirm("{tr}Cancel Edit{/tr}"))" class="admin" method="post">
	<div class="heading input_submit_container" style="text-align: right">
		<input type="submit" value="{tr}Change preferences{/tr}" />
	</div>
	<input type="hidden" name="adssetup" />
	<fieldset>
		<legend>{tr}Site Ads and Banners{/tr}{help url="Banners"}</legend>

		{preference name=sitead}
		{preference name=feature_sitead}
		<div class="adminoptionbox" id="feature_sitead_childcontainer">
			{remarksbox type="note" title="{tr}Note{/tr}"}
				{tr}<strong>Activate</strong> will display content for Admin only. Select <strong>Publish</strong> to display for all users.{/tr}
			{/remarksbox}
			{preference name=sitead_publish}
		</div>
	</fieldset>

	<div class="input_submit_container clear" style="text-align: center">
		<input type="submit" value="{tr}Change preferences{/tr}" />
	</div>
</form>
