<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:49
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-calendar_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:101194939567b58d9645d98-84569485%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a62ee54080ea7f8ec645d0bcb9f8a009c9c4093' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-calendar_nav.tpl',
      1 => 1385917406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '101194939567b58d9645d98-84569485',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ajax' => 0,
    'module' => 0,
    'module_params' => 0,
    'calendar_type' => 0,
    'now' => 0,
    'viewmode' => 0,
    'prefs' => 0,
    'focus_prev' => 0,
    'focus_next' => 0,
    'viewlist' => 0,
    'calendarViewMode' => 0,
    'daystart' => 0,
    'dayend' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58d9a9edc5_08527982',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58d9a9edc5_08527982')) {function content_567b58d9a9edc5_08527982($_smarty_tpl) {?><?php if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_function_query')) include 'lib/smarty_tiki/function.query.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_modifier_tiki_date_format')) include 'lib/smarty_tiki/modifier.tiki_date_format.php';
?><?php if (!isset($_smarty_tpl->tpl_vars['ajax']->value)){?><?php $_smarty_tpl->tpl_vars['ajax'] = new Smarty_variable('y', null, 0);?><?php }?><?php if (!isset($_smarty_tpl->tpl_vars['module']->value)){?><?php $_smarty_tpl->tpl_vars['module'] = new Smarty_variable('n', null, 0);?><?php }?><?php if (empty($_smarty_tpl->tpl_vars['module_params']->value['viewnavbar'])||$_smarty_tpl->tpl_vars['module_params']->value['viewnavbar']=='y'){?><div class="clearfix tabrow" <?php if ($_smarty_tpl->tpl_vars['module']->value=='y'){?>style="padding: 0pt"<?php }?>><?php if ($_smarty_tpl->tpl_vars['module']->value!='y'){?><div class="tabrowRight"></div><div class="tabrowLeft"></div><?php }?><div class="viewmode"><?php if (!isset($_smarty_tpl->tpl_vars['calendar_type']->value)||$_smarty_tpl->tpl_vars['calendar_type']->value!="tiki_actions"){?><?php if ($_smarty_tpl->tpl_vars['module']->value!='y'){?><?php echo smarty_function_button(array('_auto_args'=>"viewmode,focus",'_title'=>"Today",'_text'=>"Today",'_class'=>"calbuttonoff",'viewmode'=>'day','focus'=>$_smarty_tpl->tpl_vars['now']->value,'todate'=>$_smarty_tpl->tpl_vars['now']->value),$_smarty_tpl);?>
<?php }else{ ?><?php if (empty($_smarty_tpl->tpl_vars['module_params']->value['viewmode'])){?><?php echo smarty_function_button(array('_auto_args'=>"viewmode,focus",'_keepall'=>'y','_title'=>"Today",'_text'=>"Today",'_class'=>"calbuttonoff",'viewmode'=>'day','focus'=>$_smarty_tpl->tpl_vars['now']->value,'todate'=>$_smarty_tpl->tpl_vars['now']->value),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_button(array('_auto_args'=>"focus",'_keepall'=>'y','_title'=>"Today",'_text'=>"Today",'_class'=>"calbuttonoff",'focus'=>$_smarty_tpl->tpl_vars['now']->value,'todate'=>$_smarty_tpl->tpl_vars['now']->value),$_smarty_tpl);?>
<?php }?><br class="clear"><?php }?><?php }?><span style="display: inline-block"><div><?php if ($_smarty_tpl->tpl_vars['viewmode']->value=="day"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'prev','todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value),$_smarty_tpl);?>
" title="Day"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Day"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="week"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'prev','todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value),$_smarty_tpl);?>
" title="Week"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Week"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="month"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'prev','todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value),$_smarty_tpl);?>
" title="Month"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Month"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="quarter"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'prev','todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value),$_smarty_tpl);?>
" title="Quarter"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Quarter"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="semester"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'prev','todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value),$_smarty_tpl);?>
" title="Semester"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Semester"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="year"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'prev','todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value),$_smarty_tpl);?>
" title="Year"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Year"),$_smarty_tpl);?>
</a><?php }?></div><?php if (!isset($_smarty_tpl->tpl_vars['calendar_type']->value)||$_smarty_tpl->tpl_vars['calendar_type']->value!="tiki_actions"){?><?php if ($_smarty_tpl->tpl_vars['module']->value!='y'){?><?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'href'=>"?viewmode=day",'_title'=>"Day",'_text'=>"Day",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'day'"),$_smarty_tpl);?>
<?php }elseif(empty($_smarty_tpl->tpl_vars['module_params']->value['viewmode'])){?><?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'viewmode'=>'day','_auto_args'=>"viewmode",'_keepall'=>'y','_title'=>"Day",'_text'=>"D",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'day'"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['module']->value!='y'){?><?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'href'=>"?viewmode=week",'_title'=>"Week",'_text'=>"Week",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'week'"),$_smarty_tpl);?>
<?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'href'=>"?viewmode=month",'_title'=>"Month",'_text'=>"Month",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'month'"),$_smarty_tpl);?>
<?php }elseif(empty($_smarty_tpl->tpl_vars['module_params']->value['viewmode'])){?><?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'viewmode'=>'week','_auto_args'=>"viewmode",'_keepall'=>'y','_title'=>"Week",'_text'=>"W",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'week'"),$_smarty_tpl);?>
<?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'viewmode'=>'month','_auto_args'=>"viewmode",'_keepall'=>'y','_title'=>"Month",'_text'=>"M",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'month'"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['module']->value!='y'){?><?php echo smarty_function_button(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'href'=>"?viewmode=quarter",'_title'=>"Quarter",'_text'=>"Quarter",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'quarter'"),$_smarty_tpl);?>
<?php echo smarty_function_button(array('href'=>"?viewmode=semester",'_title'=>"Semester",'_text'=>"Semester",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'semester'"),$_smarty_tpl);?>
<?php echo smarty_function_button(array('href'=>"?viewmode=year",'_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'viewmode'=>'year','_title'=>"Year",'_text'=>"Year",'_selected_class'=>"buttonon",'_selected'=>"'".((string)$_smarty_tpl->tpl_vars['viewmode']->value)."' == 'year'"),$_smarty_tpl);?>
<?php }?><div><?php if ($_smarty_tpl->tpl_vars['viewmode']->value=="day"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'next','todate'=>$_smarty_tpl->tpl_vars['focus_next']->value),$_smarty_tpl);?>
" title="Day"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Day"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="week"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'next','todate'=>$_smarty_tpl->tpl_vars['focus_next']->value),$_smarty_tpl);?>
" title="Week"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Week"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="month"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'next','todate'=>$_smarty_tpl->tpl_vars['focus_next']->value),$_smarty_tpl);?>
" title="Month"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Month"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="quarter"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'next','todate'=>$_smarty_tpl->tpl_vars['focus_next']->value),$_smarty_tpl);?>
" title="Quarter"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Quarter"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="semester"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'next','todate'=>$_smarty_tpl->tpl_vars['focus_next']->value),$_smarty_tpl);?>
" title="Semester"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Semester"),$_smarty_tpl);?>
</a><?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="year"){?><a <?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?>data-role="button" data-mini="true" data-inline="true" <?php }?>href="<?php echo smarty_function_query(array('_type'=>'relative','_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>'next','todate'=>$_smarty_tpl->tpl_vars['focus_next']->value),$_smarty_tpl);?>
" title="Year"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Year"),$_smarty_tpl);?>
</a><?php }?></div></span>
	</div>
</div>
<br style="clear:both" />
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['viewmode']->value!='day'){?>
<div class="calnavigation">

	 <?php if (!empty($_smarty_tpl->tpl_vars['module_params']->value['viewnavbar'])&&$_smarty_tpl->tpl_vars['module_params']->value['viewnavbar']=='partial'){?>
		<?php if ($_smarty_tpl->tpl_vars['viewmode']->value=="day"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Day",'_alt'=>"Day",'_icon'=>"resultset_previous")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Day",'_alt'=>"Day",'_icon'=>"resultset_previous"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Day",'_alt'=>"Day",'_icon'=>"resultset_previous"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="week"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Week",'_alt'=>"Week",'_icon'=>"resultset_previous")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Week",'_alt'=>"Week",'_icon'=>"resultset_previous"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Week",'_alt'=>"Week",'_icon'=>"resultset_previous"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="month"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Month",'_alt'=>"Month",'_icon'=>"resultset_previous")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Month",'_alt'=>"Month",'_icon'=>"resultset_previous"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Month",'_alt'=>"Month",'_icon'=>"resultset_previous"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="quarter"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Quarter",'_alt'=>"Quarter",'_icon'=>"resultset_previous")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Quarter",'_alt'=>"Quarter",'_icon'=>"resultset_previous"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Quarter",'_alt'=>"Quarter",'_icon'=>"resultset_previous"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="semester"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Semester",'_alt'=>"Semester",'_icon'=>"resultset_previous")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Semester",'_alt'=>"Semester",'_icon'=>"resultset_previous"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Semester",'_alt'=>"Semester",'_icon'=>"resultset_previous"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="year"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Year",'_alt'=>"Year",'_icon'=>"resultset_previous")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Year",'_alt'=>"Year",'_icon'=>"resultset_previous"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"prev",'todate'=>$_smarty_tpl->tpl_vars['focus_prev']->value,'_title'=>"Year",'_alt'=>"Year",'_icon'=>"resultset_previous"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['viewlist']->value!='list'||$_smarty_tpl->tpl_vars['prefs']->value['calendar_list_begins_focus']!='y'){?>
		<?php if ($_smarty_tpl->tpl_vars['calendarViewMode']->value=='month'){?>
			<?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['daystart']->value,"%B %Y");?>

		<?php }elseif($_smarty_tpl->tpl_vars['calendarViewMode']->value=='week'){?>

			<?php if (($_smarty_tpl->tpl_vars['prefs']->value['display_field_order']=='DMY')||($_smarty_tpl->tpl_vars['prefs']->value['display_field_order']=='DYM')||($_smarty_tpl->tpl_vars['prefs']->value['display_field_order']=='YDM')){?>		
			<?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['daystart']->value,"%d/%m/%Y");?>
 - <?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['dayend']->value,"%d/%m/%Y");?>

			<?php }else{ ?> <?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['daystart']->value,"%m/%d/%Y");?>
 - <?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['dayend']->value,"%m/%d/%Y");?>

			<?php }?>
		<?php }else{ ?>
			<?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['daystart']->value,"%B %Y");?>
 - <?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['dayend']->value,"%B %Y");?>

		<?php }?>
	<?php }else{ ?>
		<?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['daystart']->value,"%m/%d/%Y");?>
 - <?php echo smarty_modifier_tiki_date_format($_smarty_tpl->tpl_vars['dayend']->value,"%m/%d/%Y");?>

	<?php }?>


	<?php if (!empty($_smarty_tpl->tpl_vars['module_params']->value['viewnavbar'])&&$_smarty_tpl->tpl_vars['module_params']->value['viewnavbar']=='partial'){?>
		<?php if ($_smarty_tpl->tpl_vars['viewmode']->value=="day"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Day",'_alt'=>"Day",'_icon'=>"resultset_next")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Day",'_alt'=>"Day",'_icon'=>"resultset_next"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Day",'_alt'=>"Day",'_icon'=>"resultset_next"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="week"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Week",'_alt'=>"Week",'_icon'=>"resultset_next")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Week",'_alt'=>"Week",'_icon'=>"resultset_next"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Week",'_alt'=>"Week",'_icon'=>"resultset_next"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="month"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Month",'_alt'=>"Month",'_icon'=>"resultset_next")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Month",'_alt'=>"Month",'_icon'=>"resultset_next"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Month",'_alt'=>"Month",'_icon'=>"resultset_next"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="quarter"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Quarter",'_alt'=>"Quarter",'_icon'=>"resultset_next")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Quarter",'_alt'=>"Quarter",'_icon'=>"resultset_next"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Quarter",'_alt'=>"Quarter",'_icon'=>"resultset_next"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="semester"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Semester",'_alt'=>"Semester",'_icon'=>"resultset_next")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Semester",'_alt'=>"Semester",'_icon'=>"resultset_next"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Semester",'_alt'=>"Semester",'_icon'=>"resultset_next"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }elseif($_smarty_tpl->tpl_vars['viewmode']->value=="year"){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Year",'_alt'=>"Year",'_icon'=>"resultset_next")); $_block_repeat=true; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Year",'_alt'=>"Year",'_icon'=>"resultset_next"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_ajax'=>$_smarty_tpl->tpl_vars['ajax']->value,'_class'=>"next",'todate'=>$_smarty_tpl->tpl_vars['focus_next']->value,'_title'=>"Year",'_alt'=>"Year",'_icon'=>"resultset_next"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }?>
	<?php }?>
</div>
<?php }?>

<?php }} ?>