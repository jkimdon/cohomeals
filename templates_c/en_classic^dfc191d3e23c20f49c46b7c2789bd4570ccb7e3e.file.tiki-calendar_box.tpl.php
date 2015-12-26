<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:48
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-calendar_box.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1677214167567b58d8f11b82-62216260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfc191d3e23c20f49c46b7c2789bd4570ccb7e3e' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-calendar_box.tpl',
      1 => 1367201001,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1677214167567b58d8f11b82-62216260',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'calendar_type' => 0,
    'item_url' => 0,
    'cellhead' => 0,
    'cellcalendarId' => 0,
    'infocals' => 0,
    'cellprio' => 0,
    'prefs' => 0,
    'cellid' => 0,
    'tiki_p_change_events' => 0,
    'celluser' => 0,
    'user' => 0,
    'group_by_item' => 0,
    'cellstatus' => 0,
    'allday' => 0,
    'cellstart' => 0,
    'cellend' => 0,
    'cellname' => 0,
    'show_description' => 0,
    'celldescription' => 0,
    'show_participants' => 0,
    'cellparticipants' => 0,
    'cellorganizers' => 0,
    'show_category' => 0,
    'cellcategory' => 0,
    'show_location' => 0,
    'celllocation' => 0,
    'show_url' => 0,
    'cellurl' => 0,
    'show_calname' => 0,
    'cellcalname' => 0,
    'show_status' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58d92712c8_67973855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58d92712c8_67973855')) {function content_567b58d92712c8_67973855($_smarty_tpl) {?><?php if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_modifier_tiki_short_date')) include 'lib/smarty_tiki/modifier.tiki_short_date.php';
if (!is_callable('smarty_modifier_tiki_short_time')) include 'lib/smarty_tiki/modifier.tiki_short_time.php';
if (!is_callable('smarty_modifier_truncate')) include 'lib/smarty_tiki/modifier.truncate.php';
?><div class='opaque calBox' style="width:200px">
	<?php if ($_smarty_tpl->tpl_vars['calendar_type']->value=="tiki_actions"){?>
		<div class='box-title'>
			<a href="<?php echo $_smarty_tpl->tpl_vars['item_url']->value;?>
">
				<?php echo $_smarty_tpl->tpl_vars['cellhead']->value;?>

			</a>
			<?php if (isset($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['custompriorities'])&&$_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['custompriorities']=='y'&&$_smarty_tpl->tpl_vars['cellprio']->value){?>
				<span class='calprio<?php echo $_smarty_tpl->tpl_vars['cellprio']->value;?>
' id='calprio'>
					<?php echo $_smarty_tpl->tpl_vars['cellprio']->value;?>

				</span>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_sticky_popup']=="y"){?>
				<span style="right:2px; position:absolute">
					<a href="javascript:void(0)" onclick="nd();return false;">
						<?php echo smarty_function_icon(array('_id'=>"close",'alt'=>"Close",'width'=>"16",'height'=>"16"),$_smarty_tpl);?>

					</a>
				</span>
			<?php }?>
		</div>
	<?php }else{ ?>
		<div style="float:right">
			<?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_sticky_popup']=="y"){?>
				<?php echo smarty_function_button(array('_noborder'=>'y','_text'=>"Export event",'_icon'=>"task_submitted",'href'=>"tiki-calendar_export_ical.php",'calendarItem'=>$_smarty_tpl->tpl_vars['cellid']->value,'export'=>'y','_auto_args'=>"calendarItem,export"),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['tiki_p_change_events']->value=='y'||$_smarty_tpl->tpl_vars['celluser']->value==$_smarty_tpl->tpl_vars['user']->value){?>
					<?php echo smarty_function_button(array('_noborder'=>'y','_text'=>"Edit event",'_icon'=>"page_edit",'href'=>"tiki-calendar_edit_item.php",'calitemId'=>$_smarty_tpl->tpl_vars['cellid']->value,'_auto_args'=>"calitemId"),$_smarty_tpl);?>

					<?php echo smarty_function_button(array('_noborder'=>'y','_text'=>"Delete event",'_icon'=>"cross",'href'=>"tiki-calendar_edit_item.php",'calitemId'=>$_smarty_tpl->tpl_vars['cellid']->value,'delete'=>"y",'_auto_args'=>"calitemId,delete"),$_smarty_tpl);?>

				<?php }?>
				<?php echo smarty_function_button(array('_noborder'=>'y','_text'=>"View event",'_icon'=>"magnifier",'href'=>"tiki-calendar_edit_item.php",'viewcalitemId'=>$_smarty_tpl->tpl_vars['cellid']->value,'_auto_args'=>"viewcalitemId"),$_smarty_tpl);?>

			<?php }?>
			<?php echo smarty_function_button(array('_noborder'=>'y','_text'=>"Close",'_icon'=>"close",'href'=>"javascript:void(0)",'_onclick'=>"nd();return false;"),$_smarty_tpl);?>

		</div>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['group_by_item']->value!='y'){?>
		<strong<?php if (isset($_smarty_tpl->tpl_vars['cellstatus']->value)&&$_smarty_tpl->tpl_vars['cellstatus']->value=='2'){?> style="text-decoration:line-through"<?php }?>>
			<?php if ($_smarty_tpl->tpl_vars['allday']->value){?>
				<?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['cellstart']->value);?>

				<?php if ($_smarty_tpl->tpl_vars['cellend']->value-$_smarty_tpl->tpl_vars['cellstart']->value>=86400){?>&ndash; <?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['cellend']->value);?>

					<br>
				<?php }?>
				(All day)
			<?php }else{ ?>
				<?php if (($_smarty_tpl->tpl_vars['cellend']->value-$_smarty_tpl->tpl_vars['cellstart']->value<86400)){?>
					<?php echo smarty_modifier_tiki_short_time($_smarty_tpl->tpl_vars['cellstart']->value);?>
 &ndash; <?php echo smarty_modifier_tiki_short_time($_smarty_tpl->tpl_vars['cellend']->value);?>

				<?php }else{ ?>
					<?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['cellstart']->value);?>
&nbsp;(<?php echo smarty_modifier_tiki_short_time($_smarty_tpl->tpl_vars['cellstart']->value);?>
) &ndash; <?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['cellend']->value);?>
&nbsp;(<?php echo smarty_modifier_tiki_short_time($_smarty_tpl->tpl_vars['cellend']->value);?>
)
				<?php }?>
			<?php }?>
		</strong>
		<br>
	<?php }?>
	<a href="tiki-calendar_edit_item.php?viewcalitemId=<?php echo $_smarty_tpl->tpl_vars['cellid']->value;?>
" title="Details"<?php if (isset($_smarty_tpl->tpl_vars['cellstatus']->value)&&$_smarty_tpl->tpl_vars['cellstatus']->value=='2'){?> style="text-decoration:line-through"<?php }?>>
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cellname']->value, ENT_QUOTES, 'UTF-8', true);?>

	</a>
	<br><br>
	<?php if ($_smarty_tpl->tpl_vars['show_description']->value=='y'){?>
		<div class="box-data">
			<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['celldescription']->value,250,'...');?>

		</div>
		<br>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['show_participants']->value)&&$_smarty_tpl->tpl_vars['show_participants']->value=='y'&&$_smarty_tpl->tpl_vars['cellparticipants']->value){?>
		<span class="box-title">
			Organized by:
		</span>
		<?php echo $_smarty_tpl->tpl_vars['cellorganizers']->value;?>

		<br>
		<span class="box-title">
			Participants:
		</span>
		<?php echo $_smarty_tpl->tpl_vars['cellparticipants']->value;?>

		<br>
		<br>
	<?php }?>
	
	<?php if (isset($_smarty_tpl->tpl_vars['cellcalendarId']->value)&&isset($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['custompriorities'])&&$_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['custompriorities']=='y'&&$_smarty_tpl->tpl_vars['cellprio']->value){?>
		<span class='box-title'>
			Priority:
		</span>
		<?php echo $_smarty_tpl->tpl_vars['cellprio']->value;?>

		<br>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['show_category']->value)&&$_smarty_tpl->tpl_vars['show_category']->value=='y'&&isset($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customcategories'])&&$_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customcategories']=='y'&&$_smarty_tpl->tpl_vars['cellcategory']->value){?>
		<span class='box-title'>
			Classification:
		</span>
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cellcategory']->value, ENT_QUOTES, 'UTF-8', true);?>

		<br>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['show_location']->value)&&$_smarty_tpl->tpl_vars['show_location']->value=='y'&&isset($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customlocations'])&&$_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customlocations']=='y'&&$_smarty_tpl->tpl_vars['celllocation']->value){?>
		<span class='box-title'>
			Location:
		</span>
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['celllocation']->value, ENT_QUOTES, 'UTF-8', true);?>

		<br>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['show_url']->value)&&$_smarty_tpl->tpl_vars['show_url']->value=='y'&&isset($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customurl'])&&$_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customurl']=='y'&&$_smarty_tpl->tpl_vars['cellurl']->value){?>
		<span class='box-title'>
			Website:
		</span>
		<a href="<?php echo rawurlencode($_smarty_tpl->tpl_vars['cellurl']->value);?>
" title="<?php echo rawurlencode($_smarty_tpl->tpl_vars['cellurl']->value);?>
">
			 <?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['cellurl']->value,32,'...');?>

		 </a>
		<br>
	<?php }?>
	<?php if (isset($_smarty_tpl->tpl_vars['show_calname']->value)&&$_smarty_tpl->tpl_vars['show_calname']->value=='y'&&$_smarty_tpl->tpl_vars['cellcalname']->value){?>
		<span class='box-title'>
			Calendar:
		</span>
		<span style="height:12px;width:12px;color:#<?php echo $_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customfgcolor'];?>
;<?php if (!empty($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['custombgcolor'])){?>background-color:#<?php echo $_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['custombgcolor'];?>
;<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customfgcolor'])){?>border-color:#<?php echo $_smarty_tpl->tpl_vars['infocals']->value[$_smarty_tpl->tpl_vars['cellcalendarId']->value]['customfgcolor'];?>
;<?php }?>border-width:1px;border-style:solid;">
			&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cellcalname']->value, ENT_QUOTES, 'UTF-8', true);?>
&nbsp;
		</span>
		<br>
	<?php }?>
	<br>
	<?php if (isset($_smarty_tpl->tpl_vars['show_status']->value)&&$_smarty_tpl->tpl_vars['show_status']->value=='y'){?>
		<div class="statusbox status<?php echo $_smarty_tpl->tpl_vars['cellstatus']->value;?>
">
			<?php if ($_smarty_tpl->tpl_vars['cellstatus']->value==0){?>
				Tentative
			<?php }elseif($_smarty_tpl->tpl_vars['cellstatus']->value==1){?>
				Confirmed
			<?php }elseif($_smarty_tpl->tpl_vars['cellstatus']->value==2){?>
				Cancelled
			<?php }?>
		</div>
	<?php }?>
</div>
<?php }} ?>