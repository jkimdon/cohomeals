<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:40:48
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-list_surveys.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1347203185567b5b3037e747-17520926%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b648a422cc5e973d7d72d10c006761436aa8c3a1' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-list_surveys.tpl',
      1 => 1379428743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1347203185567b5b3037e747-17520926',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tiki_p_view_survey_stats' => 0,
    'tiki_p_admin_surveys' => 0,
    'offset' => 0,
    'sort_mode' => 0,
    'channels' => 0,
    'tiki_p_admin' => 0,
    'tiki_p_take_survey' => 0,
    'cant_pages' => 0,
    'maxRecords' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5b304deb87_70632183',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5b304deb87_70632183')) {function content_567b5b304deb87_70632183($_smarty_tpl) {?><?php if (!is_callable('smarty_block_title')) include 'lib/smarty_tiki/block.title.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
if (!is_callable('smarty_block_wiki')) include 'lib/smarty_tiki/block.wiki.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_norecords')) include 'lib/smarty_tiki/function.norecords.php';
if (!is_callable('smarty_block_pagination_links')) include 'lib/smarty_tiki/block.pagination_links.php';
?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('title', array('help'=>"Surveys")); $_block_repeat=true; echo smarty_block_title(array('help'=>"Surveys"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Surveys<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_title(array('help'=>"Surveys"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<div class="navbar">
	<?php if ($_smarty_tpl->tpl_vars['tiki_p_view_survey_stats']->value=='y'){?>
		<?php echo smarty_function_button(array('href'=>"tiki-survey_stats.php",'_text'=>"Survey stats"),$_smarty_tpl);?>

	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_surveys']->value=='y'){?>
		<?php echo smarty_function_button(array('href'=>"tiki-admin_surveys.php",'_text'=>"Create New Survey"),$_smarty_tpl);?>

	<?php }?>
</div>

<table class="table normal">
	<tr>
		<th>
			<a href="tiki-list_surveys.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='name_desc'){?>name_asc<?php }else{ ?>name_desc<?php }?>">Name</a>
		</th>
		<th>Questions</th>
		<th>Actions</th>
	</tr>
	<?php echo smarty_function_cycle(array('values'=>"odd,even",'print'=>false),$_smarty_tpl);?>

	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['user'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['user']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['name'] = 'user';
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['channels']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['user']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['user']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['user']['total']);
?>
		<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual']=='n'&&$_smarty_tpl->tpl_vars['tiki_p_take_survey']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual_tiki_p_take_survey']=='y')){?>
			<tr class="<?php echo smarty_function_cycle(array(),$_smarty_tpl);?>
">
				<td class="text">
					<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin_surveys']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['status']=='o'&&$_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['taken_survey']=='n')){?>
						<a class="tablename" href="tiki-take_survey.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
					<?php }else{ ?>
						<a class="link" href="tiki-survey_stats_survey.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>
					<?php }?>
					<div class="subcomment"><?php $_smarty_tpl->smarty->_tag_stack[] = array('wiki', array()); $_block_repeat=true; echo smarty_block_wiki(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['description'];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wiki(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</div>
				</td>
				<td class="text">
					<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['questions'];?>

				</td>
				<td class="action">
					<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual']=='n'&&$_smarty_tpl->tpl_vars['tiki_p_admin_surveys']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual_tiki_p_admin_surveys']=='y')){?>
						<a href="tiki-admin_surveys.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'page_edit','alt'=>"Edit this Survey"),$_smarty_tpl);?>
</a>
					<?php }?>
					
					<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin_surveys']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['status']=='o'&&$_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['taken_survey']=='n')){?>
						<a href="tiki-take_survey.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'control_play','alt'=>"Take Survey"),$_smarty_tpl);?>
</a>
					<?php }?>

					<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual']=='n'&&$_smarty_tpl->tpl_vars['tiki_p_view_survey_stats']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual_tiki_p_view_survey_stats']=='y')){?>
						<a href="tiki-survey_stats_survey.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'chart_curve','alt'=>"Stats"),$_smarty_tpl);?>
</a>
					<?php }?>
				</td>
			</tr>
		<?php }?>
	<?php endfor; else: ?>
		<?php echo smarty_function_norecords(array('_colspan'=>3),$_smarty_tpl);?>

	<?php endif; ?>
</table>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('pagination_links', array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['maxRecords']->value,'offset'=>$_smarty_tpl->tpl_vars['offset']->value)); $_block_repeat=true; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['maxRecords']->value,'offset'=>$_smarty_tpl->tpl_vars['offset']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['maxRecords']->value,'offset'=>$_smarty_tpl->tpl_vars['offset']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>