<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:31:09
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-calendar_edit_item.tpl" */ ?>
<?php /*%%SmartyHeaderCode:245433211567b58ed3e9a84-17548222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd34e941ae93d1c0a09456fef33e629370640c64' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-calendar_edit_item.tpl',
      1 => 1397928102,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '245433211567b58ed3e9a84-17548222',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'calitem' => 0,
    'tiki_p_view_calendar' => 0,
    'tiki_p_admin_calendar' => 0,
    'tiki_p_add_events' => 0,
    'id' => 0,
    'edit' => 0,
    'tiki_p_change_events' => 0,
    'prefs' => 0,
    'preview' => 0,
    'myurl' => 0,
    'calendar' => 0,
    'listcals' => 0,
    'it' => 0,
    'itid' => 0,
    'calendarView' => 0,
    'calendarId' => 0,
    'recurrence' => 0,
    'recurrent' => 0,
    'occurnumber' => 0,
    'daysnames' => 0,
    'monthnames' => 0,
    'hidden_if_all_day' => 0,
    'hour_minmax' => 0,
    'use_24hr_clock' => 0,
    'impossibleDates' => 0,
    'listprioritycolors' => 0,
    'listpriorities' => 0,
    'listcats' => 0,
    'listlocs' => 0,
    'listlanguages' => 0,
    'groupforalert' => 0,
    'showeachuser' => 0,
    'listusertoalert' => 0,
    'changeCal' => 0,
    'org' => 0,
    'ppl' => 0,
    'listroles' => 0,
    'user' => 0,
    'tiki_p_calendar_add_my_particip' => 0,
    'in_particip' => 0,
    'tiki_p_calendar_add_guest_particip' => 0,
    'cookie' => 0,
    'referer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58ede835c5_87413795',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58ede835c5_87413795')) {function content_567b58ede835c5_87413795($_smarty_tpl) {?><?php if (!is_callable('smarty_block_title')) include 'lib/smarty_tiki/block.title.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_block_wikiplugin')) include 'lib/smarty_tiki/block.wikiplugin.php';
if (!is_callable('smarty_modifier_tiki_long_date')) include 'lib/smarty_tiki/modifier.tiki_long_date.php';
if (!is_callable('smarty_function_jscalendar')) include 'lib/smarty_tiki/function.jscalendar.php';
if (!is_callable('smarty_function_html_select_date')) include 'lib/smarty_tiki/function.html_select_date.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_html_select_time')) include 'lib/smarty_tiki/function.html_select_time.php';
if (!is_callable('smarty_modifier_tiki_short_date')) include 'lib/smarty_tiki/modifier.tiki_short_date.php';
if (!is_callable('smarty_modifier_isodate')) include 'lib/smarty_tiki/modifier.isodate.php';
if (!is_callable('smarty_modifier_tiki_long_datetime')) include 'lib/smarty_tiki/modifier.tiki_long_datetime.php';
if (!is_callable('smarty_block_textarea')) include 'lib/smarty_tiki/block.textarea.php';
if (!is_callable('smarty_modifier_langname')) include 'lib/smarty_tiki/modifier.langname.php';
if (!is_callable('smarty_modifier_userlink')) include 'lib/smarty_tiki/modifier.userlink.php';
if (!is_callable('smarty_function_help')) include 'lib/smarty_tiki/function.help.php';
?><?php $_smarty_tpl->smarty->_tag_stack[] = array('title', array('admpage'=>"calendar")); $_block_repeat=true; echo smarty_block_title(array('admpage'=>"calendar"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Calendar event : <?php echo $_smarty_tpl->tpl_vars['calitem']->value['name'];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_title(array('admpage'=>"calendar"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<div class="navbar"><?php if ($_smarty_tpl->tpl_vars['tiki_p_view_calendar']->value=='y'){?><?php echo smarty_function_button(array('href'=>"tiki-calendar.php",'_text'=>"View Calendars"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_calendar']->value=='y'){?><?php echo smarty_function_button(array('href'=>"tiki-admin_calendars.php?calendarId=".((string)$_smarty_tpl->tpl_vars['calendarId']->value),'_text'=>"Edit Calendar"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_add_events']->value=='y'&&$_smarty_tpl->tpl_vars['id']->value){?><?php echo smarty_function_button(array('href'=>"tiki-calendar_edit_item.php",'_text'=>"New event"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['id']->value){?><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php echo smarty_function_button(array('href'=>"tiki-calendar_edit_item.php?viewcalitemId=".((string)$_smarty_tpl->tpl_vars['id']->value),'_text'=>"View event"),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['tiki_p_change_events']->value=='y'){?><?php echo smarty_function_button(array('href'=>"tiki-calendar_edit_item.php?calitemId=".((string)$_smarty_tpl->tpl_vars['id']->value),'_text'=>"Edit/Delete event"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_calendar']->value=='y'){?><?php echo smarty_function_button(array('href'=>"tiki-admin_calendars.php",'_text'=>"Admin Calendars"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_fullcalendar']!='y'||!$_smarty_tpl->tpl_vars['edit']->value){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_export_item']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_view_calendar']->value=='y'){?><?php echo smarty_function_button(array('href'=>('tiki-calendar_export_ical.php? export=y&calendarItem=').($_smarty_tpl->tpl_vars['id']->value),'_text'=>'Export Event as iCal'),$_smarty_tpl);?>
<?php }?><?php }?></div><div class="wikitext"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if ($_smarty_tpl->tpl_vars['preview']->value){?><h2>Preview</h2><?php echo $_smarty_tpl->tpl_vars['calitem']->value['parsedName'];?>
<div class="wikitext"><?php echo $_smarty_tpl->tpl_vars['calitem']->value['parsed'];?>
</div><h2><?php if ($_smarty_tpl->tpl_vars['id']->value){?>Edit Calendar Item<?php }else{ ?>New Calendar Item<?php }?></h2><?php }?><form action="<?php echo $_smarty_tpl->tpl_vars['myurl']->value;?>
" method="post" name="f" id="editcalitem"><input type="hidden" name="save[user]" value="<?php echo $_smarty_tpl->tpl_vars['calitem']->value['user'];?>
"><?php if ($_smarty_tpl->tpl_vars['id']->value){?><input type="hidden" name="save[calitemId]" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_addtogooglecal']=='y'){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('wikiplugin', array('_name'=>"addtogooglecal",'calitemid'=>$_smarty_tpl->tpl_vars['id']->value)); $_block_repeat=true; echo smarty_block_wikiplugin(array('_name'=>"addtogooglecal",'calitemid'=>$_smarty_tpl->tpl_vars['id']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wikiplugin(array('_name'=>"addtogooglecal",'calitemid'=>$_smarty_tpl->tpl_vars['id']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><table class="formcolor<?php if (!$_smarty_tpl->tpl_vars['edit']->value){?> vevent<?php }?>"><tr><td>Calendar</td><td style="background-color:#<?php echo $_smarty_tpl->tpl_vars['calendar']->value['custombgcolor'];?>
;color:#<?php echo $_smarty_tpl->tpl_vars['calendar']->value['customfgcolor'];?>
;"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']=='n'){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calendar']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
<br>or&nbsp;<input type="submit" class="btn btn-default" name="changeCal" value="Go to"><?php }?><select name="save[calendarId]" id="calid" onchange="javascript:needToConfirm=false;document.getElementById('editcalitem').submit();"><?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_smarty_tpl->tpl_vars['itid'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['listcals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
$_smarty_tpl->tpl_vars['it']->_loop = true;
 $_smarty_tpl->tpl_vars['itid']->value = $_smarty_tpl->tpl_vars['it']->key;
?><?php if ($_smarty_tpl->tpl_vars['it']->value['tiki_p_add_events']=='y'){?><option value="<?php echo $_smarty_tpl->tpl_vars['it']->value['calendarId'];?>
" style="background-color:#<?php echo $_smarty_tpl->tpl_vars['it']->value['custombgcolor'];?>
;color:#<?php echo $_smarty_tpl->tpl_vars['it']->value['customfgcolor'];?>
;"<?php if (isset($_smarty_tpl->tpl_vars['calitem']->value['calendarId'])){?><?php if ($_smarty_tpl->tpl_vars['calitem']->value['calendarId']==$_smarty_tpl->tpl_vars['itid']->value){?>selected="selected"<?php }?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['calendarView']->value){?><?php if ($_smarty_tpl->tpl_vars['calendarView']->value==$_smarty_tpl->tpl_vars['itid']->value){?>selected="selected"<?php }?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['calendarId']->value){?><?php if ($_smarty_tpl->tpl_vars['calendarId']->value==$_smarty_tpl->tpl_vars['itid']->value){?>selected="selected"<?php }?><?php }?><?php }?><?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['it']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option><?php }?><?php } ?></select><?php }else{ ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['listcals']->value[$_smarty_tpl->tpl_vars['calitem']->value['calendarId']]['name'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?></td></tr><tr><td>Title</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><input type="text" name="save[name]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calitem']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
" size="32" style="width:90%;"><?php }else{ ?><span class="summary"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calitem']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?></td></tr><?php if ($_smarty_tpl->tpl_vars['edit']->value||$_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><tr><td>Recurrence</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><input type="hidden" name="recurrent" value="1">This event depends on a recurrence rule<?php }else{ ?><input type="checkbox" id="id_recurrent" name="recurrent" value="1" onclick="toggle('recurrenceRules');toggle('startdate');toggle('enddate');togglereminderforrecurrence();"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['recurrenceId']>0||$_smarty_tpl->tpl_vars['recurrent']->value==1){?>checked="checked"<?php }?>><label for="id_recurrent">This event depends on a recurrence rule</label><?php }?><?php }else{ ?><span class="summary"><?php if ($_smarty_tpl->tpl_vars['calitem']->value['recurrenceId']>0){?>This event depends on a recurrence rule<?php }else{ ?>This event is not recurrent<?php }?></span><?php }?></td></tr><tr><td>&nbsp;</td><td style="padding:5px 10px"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><div id="recurrenceRules" style="width:100%;<?php if ((!($_smarty_tpl->tpl_vars['calitem']->value['recurrenceId']>0)&&$_smarty_tpl->tpl_vars['recurrent']->value!=1)&&$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']=='y'){?>display:none;<?php }?>"><?php if ($_smarty_tpl->tpl_vars['calitem']->value['recurrenceId']>0){?><input type="hidden" name="recurrenceId" value="<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['id'];?>
"><?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekly']){?><input type="hidden" name="recurrenceType" value="weekly">On a weekly basis<br><?php }?><?php }else{ ?><input type="radio" id="id_recurrenceTypeW" name="recurrenceType" value="weekly"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekly']||$_smarty_tpl->tpl_vars['calitem']->value['calitemId']==0){?>checked="checked"<?php }?>><label for="id_recurrenceTypeW">On a weekly basis</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']==0||$_smarty_tpl->tpl_vars['recurrence']->value['weekly']){?>Each&nbsp;<select name="weekday"><option value="0"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='0'){?>selected="selected"<?php }?>>Sunday</option><option value="1"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='1'){?>selected="selected"<?php }?>>Monday</option><option value="2"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='2'){?>selected="selected"<?php }?>>Tuesday</option><option value="3"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='3'){?>selected="selected"<?php }?>>Wednesday</option><option value="4"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='4'){?>selected="selected"<?php }?>>Thursday</option><option value="5"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='5'){?>selected="selected"<?php }?>>Friday</option><option value="6"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekday']=='6'){?>selected="selected"<?php }?>>Saturday</option></select>&nbsp;of the week<br><hr style="width:75%"/><?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['monthly']){?><input type="hidden" name="recurrenceType" value="monthly">On a monthly basis<br><?php }?><?php }else{ ?><input type="radio" id="id_recurrenceTypeM" name="recurrenceType" value="monthly"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['monthly']){?>checked="checked"<?php }?>><label for="id_recurrenceTypeM">On a monthly basis</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']==0||$_smarty_tpl->tpl_vars['recurrence']->value['monthly']){?>Each&nbsp;<select name="dayOfMonth"><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['k'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['k']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['name'] = 'k';
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total']);
?><option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['k']['index'];?>
"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dayOfMonth']==$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']){?>selected="selected"<?php }?>><?php if ($_smarty_tpl->getVariable('smarty')->value['section']['k']['index']<10){?>0<?php }?><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['k']['index'];?>
</option><?php endfor; endif; ?></select>&nbsp;of the month<br><hr style="width:75%"/><?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['yearly']){?><input type="hidden" name="recurrenceType" value="yearly">On a yearly basis<br><?php }?><?php }else{ ?><input type="radio" id="id_recurrenceTypeY" name="recurrenceType" value="yearly"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['yearly']){?>checked="checked"<?php }?>><label for="id_recurrenceTypeY">On a yearly basis</label><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']==0||$_smarty_tpl->tpl_vars['recurrence']->value['yearly']){?>Each&nbsp;<select name="dateOfYear_day" onChange="checkDateOfYear(this.options[this.selectedIndex].value,document.forms['f'].elements['dateOfYear_month'].options[document.forms['f'].elements['dateOfYear_month'].selectedIndex].value);"><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['k'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['k']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['name'] = 'k';
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = (int)1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] = is_array($_loop=32) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['k']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['k']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['k']['total']);
?><option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['k']['index'];?>
"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_day']==$_smarty_tpl->getVariable('smarty')->value['section']['k']['index']){?>selected="selected"<?php }?>><?php if ($_smarty_tpl->getVariable('smarty')->value['section']['k']['index']<10){?>0<?php }?><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['k']['index'];?>
</option><?php endfor; endif; ?></select>&nbsp;of&nbsp;<select name="dateOfYear_month" onChange="checkDateOfYear(document.forms['f'].elements['dateOfYear_day'].options[document.forms['f'].elements['dateOfYear_day'].selectedIndex].value,this.options[this.selectedIndex].value);"><option value="1"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='1'){?>selected="selected"<?php }?>>January</option><option value="2"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='2'){?>selected="selected"<?php }?>>February</option><option value="3"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='3'){?>selected="selected"<?php }?>>March</option><option value="4"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='4'){?>selected="selected"<?php }?>>April</option><option value="5"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='5'){?>selected="selected"<?php }?>>May</option><option value="6"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='6'){?>selected="selected"<?php }?>>June</option><option value="7"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='7'){?>selected="selected"<?php }?>>July</option><option value="8"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='8'){?>selected="selected"<?php }?>>August</option><option value="9"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='9'){?>selected="selected"<?php }?>>September</option><option value="10"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='10'){?>selected="selected"<?php }?>>October</option><option value="11"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='11'){?>selected="selected"<?php }?>>November</option><option value="12"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']=='12'){?>selected="selected"<?php }?>>December</option></select>&nbsp;&nbsp;<span id="errorDateOfYear" style="color:#900;"></span><br><br><hr><?php }?><br><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><input type="hidden" name="startPeriod" value="<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['startPeriod'];?>
"><input type="hidden" name="nbRecurrences" value="<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences'];?>
"><input type="hidden" name="endPeriod" value="<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['endPeriod'];?>
">Starting on <?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['recurrence']->value['startPeriod']);?>
,&nbsp;<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['endPeriod']>0){?>ending by <?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['recurrence']->value['endPeriod']);?>
<?php }else{ ?>ending after <?php echo $_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences'];?>
 events<?php }?>.<?php }else{ ?>Start period&nbsp;<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']=='y'){?><?php echo smarty_function_jscalendar(array('id'=>"startPeriod",'date'=>$_smarty_tpl->tpl_vars['recurrence']->value['startPeriod'],'fieldname'=>"startPeriod",'align'=>"Bc",'showtime'=>'n'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_html_select_date(array('prefix'=>"startPeriod_",'time'=>$_smarty_tpl->tpl_vars['recurrence']->value['startPeriod'],'field_order'=>$_smarty_tpl->tpl_vars['prefs']->value['display_field_order'],'start_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_start_year'],'end_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_end_year']),$_smarty_tpl);?>
<?php }?><br><hr style="width:75%"/><input type="radio" id="id_endTypeNb" name="endType" value="nb"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences']||$_smarty_tpl->tpl_vars['calitem']->value['calitemId']==0){?>checked="checked"<?php }?>>&nbsp;<label for="id_endTypeNb">End after&nbsp;</label><input type="text" name="nbRecurrences" size="3" style="text-align:right" value="<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences']>0){?><?php echo $_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences'];?>
<?php $_smarty_tpl->tpl_vars['occurnumber'] = new Smarty_variable("occurrences", null, 0);?><?php }elseif($_smarty_tpl->tpl_vars['calitem']->value['calitemId']==0||$_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences']==0){?>1<?php $_smarty_tpl->tpl_vars['occurnumber'] = new Smarty_variable("occurrence", null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['occurnumber'] = new Smarty_variable("occurrences", null, 0);?><?php }?>">&nbsp;<label for="id_endTypeNb"><?php echo $_smarty_tpl->tpl_vars['occurnumber']->value;?>
</label><br><input type="radio" id="id_endTypeDt" name="endType" value="dt"<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['endPeriod']>0){?>checked="checked"<?php }?>>&nbsp;<label for="id_endTypeDt">End before&nbsp;</label><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']=='y'){?><?php echo smarty_function_jscalendar(array('id'=>"endPeriod",'date'=>$_smarty_tpl->tpl_vars['recurrence']->value['endPeriod'],'fieldname'=>"endPeriod",'align'=>"Bc",'showtime'=>'n'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_html_select_date(array('prefix'=>"endPeriod_",'time'=>$_smarty_tpl->tpl_vars['recurrence']->value['endPeriod'],'field_order'=>$_smarty_tpl->tpl_vars['prefs']->value['display_field_order'],'start_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_start_year'],'end_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_end_year']),$_smarty_tpl);?>
<?php }?><?php }?><br>&nbsp;</div><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences']==1){?>Event occurs once on&nbsp;<?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['recurrence']->value['startPeriod']);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences']>1||$_smarty_tpl->tpl_vars['recurrence']->value['endPeriod']>0){?>Event is repeated&nbsp;<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences']>1){?><?php echo $_smarty_tpl->tpl_vars['recurrence']->value['nbRecurrences'];?>
 times,&nbsp;<?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['weekly']){?>on&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['daysnames']->value[$_smarty_tpl->tpl_vars['recurrence']->value['weekday']];?>
s<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
,<?php }elseif($_smarty_tpl->tpl_vars['recurrence']->value['monthly']){?>on&nbsp;<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['dayOfMonth'];?>
 of every month<?php }else{ ?>on each&nbsp;<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_day'];?>
 of <?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['monthnames']->value[$_smarty_tpl->tpl_vars['recurrence']->value['dateOfYear_month']];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><br>starting <?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['recurrence']->value['startPeriod']);?>
<?php if ($_smarty_tpl->tpl_vars['recurrence']->value['endPeriod']>0){?>, ending&nbsp;<?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['recurrence']->value['endPeriod']);?>
<?php }?>.<?php }?><?php }?><?php }?></td></tr><?php }?><tr><td>Start</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><table cellpadding="0" cellspacing="0" border="0"><tr><td style="border:0;padding-top:2px;vertical-align:middle"><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']!='y'||$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']!='y'){?><a href="#" onclick="document.f.Time_Hour.selectedIndex=(document.f.Time_Hour.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a><?php }?></td><td rowspan="2" style="border:0;padding-top:2px;vertical-align:middle"><div id="startdate"><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']=='y'){?><?php echo smarty_function_jscalendar(array('id'=>"start",'date'=>$_smarty_tpl->tpl_vars['calitem']->value['start'],'fieldname'=>"save[date_start]",'align'=>"Bc",'showtime'=>'n'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_html_select_date(array('prefix'=>"start_date_",'time'=>$_smarty_tpl->tpl_vars['calitem']->value['start'],'field_order'=>$_smarty_tpl->tpl_vars['prefs']->value['display_field_order'],'start_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_start_year'],'end_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_end_year']),$_smarty_tpl);?>
<?php }?></div></td><td style="border:0;padding-top:2px;vertical-align:middle"><span id="starttimehourplus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.start_Hour.selectedIndex=(document.f.start_Hour.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td rowspan="2" style="border:0;vertical-align:middle" class="html_select_time"><span id="starttime"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><?php echo smarty_function_html_select_time(array('prefix'=>"start_",'display_seconds'=>false,'time'=>$_smarty_tpl->tpl_vars['calitem']->value['start'],'minute_interval'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_timespan'],'hour_minmax'=>$_smarty_tpl->tpl_vars['hour_minmax']->value,'use_24_hours'=>$_smarty_tpl->tpl_vars['use_24hr_clock']->value),$_smarty_tpl);?>
</span></td><td style="border:0;padding-top:2px;vertical-align:middle"><span id="starttimeminplus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.start_Minute.selectedIndex=(document.f.start_Minute.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td style="border:0;padding-top:2px;vertical-align:middle;" rowspan="2"><label for="alldayid"><input type="checkbox" id="alldayid" name="allday"onclick="toggleSpan('starttimehourplus');toggleSpan('starttimehourminus');toggleSpan('starttime');toggleSpan('starttimeminplus');toggleSpan('starttimeminminus');toggleSpan('endtimehourplus');toggleSpan('endtimehourminus');toggleSpan('endtime');toggleSpan('endtimeminplus');toggleSpan('endtimeminminus');toggleSpan('durhourplus');toggleSpan('durhourminus');toggleSpan('duration');toggleSpan('duratione');toggleSpan('durminplus');toggleSpan('durminminus');"value="true"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['allday']){?>checked="checked"<?php }?>>All day</label></td></tr><tr><td style="border:0;vertical-align:middle"><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']!='y'||$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']!='y'){?><a href="#" onclick="document.f.Time_Hour.selectedIndex=(document.f.Time_Hour.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a><?php }?></td><td style="border:0;vertical-align:middle"><span id="starttimehourminus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.start_Hour.selectedIndex=(document.f.start_Hour.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td style="border:0;vertical-align:middle"><span id="starttimeminminus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.start_Minute.selectedIndex=(document.f.start_Minute.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td></tr></table><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['calitem']->value['allday']){?><abbr class="dtstart" title="<?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['calitem']->value['start']);?>
"><?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['calitem']->value['start']);?>
</abbr><?php }else{ ?><abbr class="dtstart" title="<?php echo smarty_modifier_isodate($_smarty_tpl->tpl_vars['calitem']->value['start']);?>
"><?php echo smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['calitem']->value['start']);?>
</abbr><?php }?><?php }?></td></tr><tr><td>End</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><input type="hidden" name="save[end_or_duration]" value="end" id="end_or_duration"><div id="end_date"><table cellpadding="0" cellspacing="0" border="0"><tr><td style="border:0;padding-top:2px;vertical-align:middle"><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']!='y'||$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']!='y'){?><a href="#" onclick="document.f.Time_Hour.selectedIndex=(document.f.Time_Hour.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a><?php }?></td><td rowspan="2" style="border:0;vertical-align:middle"><div id="enddate"><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']=='y'){?><?php echo smarty_function_jscalendar(array('id'=>"end",'date'=>$_smarty_tpl->tpl_vars['calitem']->value['end'],'fieldname'=>"save[date_end]",'align'=>"Bc",'showtime'=>'n'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_html_select_date(array('prefix'=>"end_date_",'time'=>$_smarty_tpl->tpl_vars['calitem']->value['end'],'field_order'=>$_smarty_tpl->tpl_vars['prefs']->value['display_field_order'],'start_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_start_year'],'end_year'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_end_year']),$_smarty_tpl);?>
<?php }?></div></td><td style="border:0;padding-top:2px;vertical-align:middle"><span id="endtimehourplus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.end_Hour.selectedIndex=(document.f.end_Hour.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td rowspan="2" style="border:0;vertical-align:middle" class="html_select_time"><span id="endtime"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><?php echo smarty_function_html_select_time(array('prefix'=>"end_",'display_seconds'=>false,'time'=>$_smarty_tpl->tpl_vars['calitem']->value['end'],'minute_interval'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_timespan'],'hour_minmax'=>$_smarty_tpl->tpl_vars['hour_minmax']->value,'use_24_hours'=>$_smarty_tpl->tpl_vars['use_24hr_clock']->value),$_smarty_tpl);?>
</span></td><td style="border:0;padding-top:2px;vertical-align:middle"><span id="endtimeminplus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.end_Minute.selectedIndex=(document.f.end_Minute.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td rowspan="2" style="border:0;padding-top:2px;vertical-align:middle"><span id="duration"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.getElementById('end_or_duration').value='duration';flip('end_duration');flip('end_date');return false;return false;">Show duration</a></span></td></tr><tr><td style="border:0;vertical-align:middle"><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_jscalendar']!='y'||$_smarty_tpl->tpl_vars['prefs']->value['javascript_enabled']!='y'){?><a href="#" onclick="document.f.Time_Hour.selectedIndex=(document.f.Time_Hour.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a><?php }?></td><td style="border:0;vertical-align:middle"><span id="endtimehourminus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.end_Hour.selectedIndex=(document.f.end_Hour.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td style="border:0;vertical-align:middle"><span id="endtimeminminus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.end_Minute.selectedIndex=(document.f.end_Minute.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td></tr></table></div><div id="end_duration" style="display:none;"><table cellpadding="0" cellspacing="0" border="0"><tr><td style="border:0;padding-top:2px;vertical-align:middle"><span id="durhourplus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.duration_Hour.selectedIndex=(document.f.duration_Hour.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td style="border:0;vertical-align:middle" rowspan="2" class="html_select_time"><span id="duratione"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><?php echo smarty_function_html_select_time(array('prefix'=>"duration_",'display_seconds'=>false,'time'=>(($tmp = @$_smarty_tpl->tpl_vars['calitem']->value['duration'])===null||$tmp==='' ? '01:00' : $tmp),'minute_interval'=>$_smarty_tpl->tpl_vars['prefs']->value['calendar_timespan']),$_smarty_tpl);?>
</span></td><td style="border:0;padding-top:2px;vertical-align:middle"><span id="durminplus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.duration_Minute.selectedIndex=(document.f.duration_Minute.selectedIndex+1);return false;"><?php echo smarty_function_icon(array('_id'=>'plus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td rowspan="2" style="border:0;padding-top:2px;vertical-align:middle"><a href="#" onclick="document.getElementById('end_or_duration').value='end';flip('end_date');flip('end_duration');return false;">Show end date and time</a></td></tr><tr><td style="border:0;vertical-align:middle"><span id="durhourminus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.duration_Hour.selectedIndex=(document.f.duration_Hour.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td><td style="border:0;vertical-align:middle"><span id="durminminus"<?php echo $_smarty_tpl->tpl_vars['hidden_if_all_day']->value;?>
><a href="#" onclick="document.f.duration_Minute.selectedIndex=(document.f.duration_Minute.selectedIndex-1);return false;"><?php echo smarty_function_icon(array('_id'=>'minus_small','align'=>'left','width'=>'11','height'=>'8'),$_smarty_tpl);?>
</a></span></td></tr></table></div><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['calitem']->value['allday']){?><?php if ($_smarty_tpl->tpl_vars['calitem']->value['end']){?><abbr class="dtend" title="<?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['calitem']->value['end']);?>
"><?php }?><?php echo smarty_modifier_tiki_long_date($_smarty_tpl->tpl_vars['calitem']->value['end']);?>
<?php if ($_smarty_tpl->tpl_vars['calitem']->value['end']){?></abbr><?php }?><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['calitem']->value['end']){?><abbr class="dtend" title="<?php echo smarty_modifier_isodate($_smarty_tpl->tpl_vars['calitem']->value['end']);?>
"><?php }?><?php echo smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['calitem']->value['end']);?>
<?php if ($_smarty_tpl->tpl_vars['calitem']->value['end']){?></abbr><?php }?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['impossibleDates']->value){?><br><span style="color:#900;">Events cannot end before they start</span><?php }?></td></tr><?php if ($_smarty_tpl->tpl_vars['edit']->value||!empty($_smarty_tpl->tpl_vars['calitem']->value['parsed'])){?><tr><td>Description</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('textarea', array('name'=>"save[description]",'id'=>"editwiki",'cols'=>40,'rows'=>10)); $_block_repeat=true; echo smarty_block_textarea(array('name'=>"save[description]",'id'=>"editwiki",'cols'=>40,'rows'=>10), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['calitem']->value['description'];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_textarea(array('name'=>"save[description]",'id'=>"editwiki",'cols'=>40,'rows'=>10), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }else{ ?><span<?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_description_is_html']!="y"){?> class="description"<?php }?>><?php echo (($tmp = @$_smarty_tpl->tpl_vars['calitem']->value['parsed'])===null||$tmp==='' ? "<i>No description</i>" : $tmp);?>
</span><?php }?></td></tr><?php }?><?php if ($_smarty_tpl->tpl_vars['calendar']->value['customstatus']!='n'){?><tr><td>Status</td><td><div class="statusbox	<?php if ($_smarty_tpl->tpl_vars['calitem']->value['status']==0){?>status0<?php }?>"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><input id="status0" type="radio" name="save[status]" value="0"<?php if ((!empty($_smarty_tpl->tpl_vars['calitem']->value)&&$_smarty_tpl->tpl_vars['calitem']->value['status']==0)||(empty($_smarty_tpl->tpl_vars['calitem']->value)&&$_smarty_tpl->tpl_vars['calendar']->value['defaulteventstatus']==0)){?>checked="checked"<?php }?>><label for="status0">Tentative</label><?php }else{ ?>Tentative<?php }?></div><div class="statusbox	<?php if ($_smarty_tpl->tpl_vars['calitem']->value['status']==1){?>status1<?php }?>"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><input id="status1" type="radio" name="save[status]" value="1"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['status']==1){?>checked="checked"<?php }?>><label for="status1">Confirmed</label><?php }else{ ?>Confirmed<?php }?></div><div class="statusbox <?php if ($_smarty_tpl->tpl_vars['calitem']->value['status']==2){?>status2<?php }?>"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><input id="status2" type="radio" name="save[status]" value="2"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['status']==2){?>checked="checked"<?php }?>><label for="status2">Cancelled</label><?php }else{ ?>Cancelled<?php }?></div></td></tr><?php }?><?php if ($_smarty_tpl->tpl_vars['calendar']->value['custompriorities']=='y'){?><tr><td>Priority</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><select name="save[priority]" style="background-color:#<?php echo $_smarty_tpl->tpl_vars['listprioritycolors']->value[$_smarty_tpl->tpl_vars['calitem']->value['priority']];?>
;font-size:150%;"onchange="this.style.bacgroundColor='#'+this.selectedIndex.value;"><?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listpriorities']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
$_smarty_tpl->tpl_vars['it']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['it']->value;?>
" style="background-color:#<?php echo $_smarty_tpl->tpl_vars['listprioritycolors']->value[$_smarty_tpl->tpl_vars['it']->value];?>
;"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['priority']==$_smarty_tpl->tpl_vars['it']->value){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['it']->value;?>
</option><?php } ?></select><?php }else{ ?><span style="background-color:#<?php echo $_smarty_tpl->tpl_vars['listprioritycolors']->value[$_smarty_tpl->tpl_vars['calitem']->value['priority']];?>
;font-size:150%;width:90%;padding:1px 4px"><?php echo $_smarty_tpl->tpl_vars['calitem']->value['priority'];?>
</span><?php }?></td></tr><?php }?><tr style="display:<?php if ($_smarty_tpl->tpl_vars['calendar']->value['customcategories']=='y'){?>tablerow<?php }else{ ?>none<?php }?>;" id="calcat"><td>Classification</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if (count($_smarty_tpl->tpl_vars['listcats']->value)){?><select name="save[categoryId]"><option value=""></option><?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listcats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
$_smarty_tpl->tpl_vars['it']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['it']->value['categoryId'];?>
"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['categoryId']==$_smarty_tpl->tpl_vars['it']->value['categoryId']){?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['it']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option><?php } ?></select>or new<?php }?><input type="text" name="save[newcat]" value=""><?php }else{ ?><span class="category"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calitem']->value['categoryName'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?></td></tr><tr style="display:<?php if ($_smarty_tpl->tpl_vars['calendar']->value['customlocations']=='y'){?>tablerow<?php }else{ ?>none<?php }?>;" id="calloc"><td>Location</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if (count($_smarty_tpl->tpl_vars['listlocs']->value)){?><select name="save[locationId]"><option value=""></option><?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listlocs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
$_smarty_tpl->tpl_vars['it']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['it']->value['locationId'];?>
"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['locationId']==$_smarty_tpl->tpl_vars['it']->value['locationId']){?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['it']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</option><?php } ?></select>or new<?php }?><input type="text" name="save[newloc]" value=""><?php }else{ ?><span class="location"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calitem']->value['locationName'], ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?></td></tr><?php if ($_smarty_tpl->tpl_vars['calendar']->value['customurl']!='n'){?><tr><td>URL</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><input type="text" name="save[url]" value="<?php echo $_smarty_tpl->tpl_vars['calitem']->value['url'];?>
" size="32" style="width:90%;"><?php }else{ ?><a class="url" href="<?php echo $_smarty_tpl->tpl_vars['calitem']->value['url'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calitem']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
</a><?php }?></td></tr><?php }?><tr style="display:<?php if ($_smarty_tpl->tpl_vars['calendar']->value['customlanguages']=='y'){?>tablerow<?php }else{ ?>none<?php }?>;" id="callang"><td>Language</td><td><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><select name="save[lang]"><option value=""></option><?php  $_smarty_tpl->tpl_vars['it'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['it']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['listlanguages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['it']->key => $_smarty_tpl->tpl_vars['it']->value){
$_smarty_tpl->tpl_vars['it']->_loop = true;
?><option value="<?php echo $_smarty_tpl->tpl_vars['it']->value['value'];?>
"<?php if ($_smarty_tpl->tpl_vars['calitem']->value['lang']==$_smarty_tpl->tpl_vars['it']->value['value']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['it']->value['name'];?>
</option><?php } ?></select><?php }else{ ?><?php echo smarty_modifier_langname($_smarty_tpl->tpl_vars['calitem']->value['lang']);?>
<?php }?></td></tr><?php if (!empty($_smarty_tpl->tpl_vars['groupforalert']->value)){?><?php if ($_smarty_tpl->tpl_vars['showeachuser']->value=='y'){?><tr><td>Choose users to alert</td><td><?php }?><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['idx'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['name'] = 'idx';
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['listusertoalert']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['idx']['total']);
?><?php if ($_smarty_tpl->tpl_vars['showeachuser']->value=='n'){?><input type="hidden"  name="listtoalert[]" value="<?php echo $_smarty_tpl->tpl_vars['listusertoalert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['idx']['index']]['user'];?>
"><?php }else{ ?><input type="checkbox" name="listtoalert[]" value="<?php echo $_smarty_tpl->tpl_vars['listusertoalert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['idx']['index']]['user'];?>
"> <?php echo $_smarty_tpl->tpl_vars['listusertoalert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['idx']['index']]['user'];?>
<?php }?><?php endfor; endif; ?></td></tr><?php }?><?php if ($_smarty_tpl->tpl_vars['calendar']->value['customparticipants']=='y'){?><tr><td colspan="2">&nbsp;</td></tr><?php }?><tr style="display:<?php if ($_smarty_tpl->tpl_vars['calendar']->value['customparticipants']=='y'){?>tablerow<?php }else{ ?>none<?php }?>;" id="calorg"><td>Organized by</td><td><?php if (isset($_smarty_tpl->tpl_vars['calitem']->value['organizers'])){?><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if ($_smarty_tpl->tpl_vars['preview']->value||$_smarty_tpl->tpl_vars['changeCal']->value){?><input type="text" name="save[organizers]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['calitem']->value['organizers'], ENT_QUOTES, 'UTF-8', true);?>
" style="width:90%;"><?php }else{ ?><input type="text" name="save[organizers]" value="<?php  $_smarty_tpl->tpl_vars['org'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['org']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calitem']->value['organizers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['org']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['org']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['org']->key => $_smarty_tpl->tpl_vars['org']->value){
$_smarty_tpl->tpl_vars['org']->_loop = true;
 $_smarty_tpl->tpl_vars['org']->iteration++;
 $_smarty_tpl->tpl_vars['org']->last = $_smarty_tpl->tpl_vars['org']->iteration === $_smarty_tpl->tpl_vars['org']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['organizers']['last'] = $_smarty_tpl->tpl_vars['org']->last;
?><?php if ($_smarty_tpl->tpl_vars['org']->value!=''){?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['org']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['organizers']['last']){?>,<?php }?><?php }?><?php } ?>" style="width:90%;"><?php }?><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['org'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['org']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calitem']->value['organizers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['org']->key => $_smarty_tpl->tpl_vars['org']->value){
$_smarty_tpl->tpl_vars['org']->_loop = true;
?><?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['org']->value);?>
<br><?php } ?><?php }?><?php }?></td></tr><tr style="display:<?php if ($_smarty_tpl->tpl_vars['calendar']->value['customparticipants']=='y'){?>tablerow<?php }else{ ?>none<?php }?>;" id="calpart"><td>Participants<?php if ($_smarty_tpl->tpl_vars['edit']->value){?><a href="#" onclick="flip('calparthelp');return false;"><?php echo smarty_function_icon(array('_id'=>'help'),$_smarty_tpl);?>
</a><?php }?></td><td><?php if (isset($_smarty_tpl->tpl_vars['calitem']->value['participants'])){?><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><?php if ($_smarty_tpl->tpl_vars['preview']->value||$_smarty_tpl->tpl_vars['changeCal']->value){?><input type="text" name="save[participants]" value="<?php echo $_smarty_tpl->tpl_vars['calitem']->value['participants'];?>
" style="width:90%;"><?php }else{ ?><input type="text" name="save[participants]" value="<?php  $_smarty_tpl->tpl_vars['ppl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ppl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calitem']->value['participants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['ppl']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['ppl']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['ppl']->key => $_smarty_tpl->tpl_vars['ppl']->value){
$_smarty_tpl->tpl_vars['ppl']->_loop = true;
 $_smarty_tpl->tpl_vars['ppl']->iteration++;
 $_smarty_tpl->tpl_vars['ppl']->last = $_smarty_tpl->tpl_vars['ppl']->iteration === $_smarty_tpl->tpl_vars['ppl']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['participants']['last'] = $_smarty_tpl->tpl_vars['ppl']->last;
?><?php if ($_smarty_tpl->tpl_vars['ppl']->value['name']!=''){?><?php if ($_smarty_tpl->tpl_vars['ppl']->value['role']){?><?php echo $_smarty_tpl->tpl_vars['ppl']->value['role'];?>
:<?php }?><?php echo $_smarty_tpl->tpl_vars['ppl']->value['name'];?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['participants']['last']){?>,<?php }?><?php }?><?php } ?>" style="width:90%;"><?php }?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['in_particip'] = new Smarty_variable('n', null, 0);?><?php  $_smarty_tpl->tpl_vars['ppl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ppl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['calitem']->value['participants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ppl']->key => $_smarty_tpl->tpl_vars['ppl']->value){
$_smarty_tpl->tpl_vars['ppl']->_loop = true;
?><?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['ppl']->value['name']);?>
<?php if ($_smarty_tpl->tpl_vars['listroles']->value[$_smarty_tpl->tpl_vars['ppl']->value['role']]){?>(<?php echo $_smarty_tpl->tpl_vars['listroles']->value[$_smarty_tpl->tpl_vars['ppl']->value['role']];?>
)<?php }?><br><?php if ($_smarty_tpl->tpl_vars['ppl']->value['name']==$_smarty_tpl->tpl_vars['user']->value){?><?php $_smarty_tpl->tpl_vars['in_particip'] = new Smarty_variable('y', null, 0);?><?php }?><?php } ?><?php if ($_smarty_tpl->tpl_vars['tiki_p_calendar_add_my_particip']->value=='y'){?><?php if ($_smarty_tpl->tpl_vars['in_particip']->value=='y'){?><?php echo smarty_function_button(array('_text'=>"Withdraw me from the list of participants",'href'=>"?del_me=y&viewcalitemId=".((string)$_smarty_tpl->tpl_vars['id']->value)),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_button(array('_text'=>"Add me to the list of participants",'href'=>"?add_me=y&viewcalitemId=".((string)$_smarty_tpl->tpl_vars['id']->value)),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_calendar_add_guest_particip']->value=='y'){?><form action="tiki-calendar_edit_item.php" method="post"><input type ="hidden" name="viewcalitemId" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><input type="text" name="guests"><?php echo smarty_function_help(array('desc'=>"Format: Participant names separated by comma",'url'=>'calendar'),$_smarty_tpl);?>
<input type="submit" class="btn btn-default" name="add_guest" value="Add guests"></form><?php }?><?php }?><?php }?></td></tr><tr><td colspan="2"><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><div style="display: <?php if ($_smarty_tpl->tpl_vars['calendar']->value['customparticipants']=='y'&&(isset($_smarty_tpl->tpl_vars['cookie']->value['show_calparthelp'])&&$_smarty_tpl->tpl_vars['cookie']->value['show_calparthelp']=='y')){?>block<?php }else{ ?>none<?php }?>;" id="calparthelp">Roles<br>0: chair (default role)<br>1: required participant<br>2: optional participant<br>3: non participant<br><br>Give participant list separated by commas. Roles have to be given in a prefix separated by a column like in:&nbsp;<span class="inline_syntax">role:login_or_email,login_or_email</span><br>If no role is provided, default role will be "Chair participant".<?php }?></div></td></tr></table><?php if ($_smarty_tpl->tpl_vars['edit']->value){?><table class="formcolor"><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']>0){?><tr><td><input type="radio" id="id_affectEvt" name="affect" value="event" checked="checked"><label for="id_affectEvt">Update this event only</label><br><input type="radio" id="id_affectMan" name="affect" value="manually"><label for="id_affectMan">Update every unchanged event in this recurrence series</label><br><input type="radio" id="id_affectAll" name="affect" value="all"><label for="id_affectAll">Update every event in this recurrence series</label></td></tr><?php }?><?php if (!$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['feature_antibot']=='y'){?><?php echo $_smarty_tpl->getSubTemplate ('antibot.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }?><tr><td><input type="submit" class="btn btn-default" name="preview" value="Preview" onclick="needToConfirm=false;">&nbsp;<input type="submit" class="btn btn-default" name="act" value="Save" onclick="needToConfirm=false;"><?php if ($_smarty_tpl->tpl_vars['id']->value){?>&nbsp;<input type="submit" class="btn btn-default" onclick="needToConfirm=false;document.location='tiki-calendar_edit_item.php?calitemId=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&amp;delete=y';return false;" value="Delete event"><?php }?><?php if ($_smarty_tpl->tpl_vars['recurrence']->value['id']){?>&nbsp;<input type="submit" class="btn btn-default" onclick="needToConfirm=false;document.location='tiki-calendar_edit_item.php?recurrenceId=<?php echo $_smarty_tpl->tpl_vars['recurrence']->value['id'];?>
&amp;delete=y';return false;" value="Delete recurrent events"><?php }?>&nbsp;<?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_fullcalendar']=='y'){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['calendar_export_item']=='y'){?><?php echo smarty_function_button(array('href'=>('tiki-calendar_export_ical.php? export=y&calendarItem=').($_smarty_tpl->tpl_vars['id']->value),'_text'=>'Export Event as iCal'),$_smarty_tpl);?>
<?php }?><?php }?>&nbsp;&nbsp;<input type="submit" class="btn btn-default" onclick="needToConfirm=false;document.location='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['referer']->value, ENT_QUOTES, 'UTF-8', true);?>
';return false;" value="Cancel"></td></tr></table><?php }?></form></div>
<?php }} ?>