{if $prefs.user_register_prettytracker eq 'y' and $prefs.user_register_prettytracker_tpl}
	<input id='pass1' type="password" name="pass" onkeypress="regCapsLock(event)" /><strong class='mandatory_star'>*</strong>	
{else}
	{if $openid_associate neq 'y'}
		<tr>
			<td><label for="pass1">{tr}Password:{/tr}</label>{if $trackerEditFormId}&nbsp;<strong class='mandatory_star'>*</strong>&nbsp;{/if}</td>
			<td>
				<input id='pass1' type="password" name="pass" onkeypress="regCapsLock(event)" onkeyup="{if $prefs.ajax_xajax neq 'y' && !$userTrackerData}runPassword(this.value, 'mypassword');checkPasswordsMatch('#pass2', '#pass1', '#mypassword2_text');{elseif !$userTrackerData}check_pass();{/if}" />
				<div style="float:right;margin-left:5px;">
					<div id="mypassword_text"></div>
					<div id="mypassword_bar" style="font-size: 5px; height: 2px; width: 0px;"></div> 
				</div>
				{if $prefs.ajax_xajax ne 'y'}
					{if $prefs.min_pass_length > 1}<div class="highlight"><em>{tr}Minimum {$prefs.min_pass_length} characters long{/tr}</em></div>{/if}
					{if $prefs.pass_chr_num eq 'y'}<div class="highlight"><em>{tr}Password must contain both letters and numbers{/tr}</em></div>{/if}
				{/if}
			</td>
		</tr>
	{/if}
{/if}
