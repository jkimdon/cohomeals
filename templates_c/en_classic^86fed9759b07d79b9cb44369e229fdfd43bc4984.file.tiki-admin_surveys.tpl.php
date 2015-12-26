<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:40:51
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-admin_surveys.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2065403756567b5b33930637-05734364%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86fed9759b07d79b9cb44369e229fdfd43bc4984' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-admin_surveys.tpl',
      1 => 1379428743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2065403756567b5b33930637-05734364',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'channels' => 0,
    'find' => 0,
    'offset' => 0,
    'sort_mode' => 0,
    'tiki_p_admin' => 0,
    'tiki_p_view_survey_stats' => 0,
    'cant_pages' => 0,
    'prefs' => 0,
    'info' => 0,
    'individual' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5b33ad3a14_06672595',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5b33ad3a14_06672595')) {function content_567b5b33ad3a14_06672595($_smarty_tpl) {?><?php if (!is_callable('smarty_block_title')) include 'lib/smarty_tiki/block.title.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_block_tabset')) include 'lib/smarty_tiki/block.tabset.php';
if (!is_callable('smarty_block_tab')) include 'lib/smarty_tiki/block.tab.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
if (!is_callable('smarty_block_wiki')) include 'lib/smarty_tiki/block.wiki.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_norecords')) include 'lib/smarty_tiki/function.norecords.php';
if (!is_callable('smarty_block_pagination_links')) include 'lib/smarty_tiki/block.pagination_links.php';
if (!is_callable('smarty_block_textarea')) include 'lib/smarty_tiki/block.textarea.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('title', array('help'=>"Surveys")); $_block_repeat=true; echo smarty_block_title(array('help'=>"Surveys"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Admin surveys<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_title(array('help'=>"Surveys"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<div class="navbar">
	<?php echo smarty_function_button(array('href'=>"tiki-list_surveys.php",'_text'=>"List Surveys"),$_smarty_tpl);?>

	<?php echo smarty_function_button(array('href'=>"tiki-survey_stats.php",'_text'=>"Survey Stats"),$_smarty_tpl);?>

	<?php echo smarty_function_button(array('surveyId'=>0,'cookietab'=>2,'_auto_args'=>"surveyId,cookietab",'_text'=>"Create Survey"),$_smarty_tpl);?>

</div>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('tabset', array()); $_block_repeat=true; echo smarty_block_tabset(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>"Surveys")); $_block_repeat=true; echo smarty_block_tab(array('name'=>"Surveys"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


<?php if ($_smarty_tpl->tpl_vars['channels']->value||($_smarty_tpl->tpl_vars['find']->value!='')){?>
	<?php echo $_smarty_tpl->getSubTemplate ('find.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<table class="table normal">
	<tr>
		<th>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'surveyId')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'surveyId'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
ID<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'surveyId'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</th>
		<th>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'name')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'name'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Survey<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'name'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</th>
		<th>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'status')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'status'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Status<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'status'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		</th>
		<th>Questions</th>
		<th style="width:120px;">Action</th>
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
		<tr class="<?php echo smarty_function_cycle(array(),$_smarty_tpl);?>
">
			<td class="id"><?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
</td>
			<td class="text">
				<b><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['name'], ENT_QUOTES, 'UTF-8', true);?>
</b>
				<div class="subcomment">
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('wiki', array()); $_block_repeat=true; echo smarty_block_wiki(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['description'];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wiki(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				</div>
			</td>
			<td class="icon">
				<?php if ($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['status']=='o'){?>
					<?php echo smarty_function_icon(array('_id'=>'ofolder','alt'=>"Open"),$_smarty_tpl);?>

				<?php }else{ ?>
					<?php echo smarty_function_icon(array('_id'=>'folder','alt'=>"closed"),$_smarty_tpl);?>

				<?php }?>
			</td>
			<td class="integer"><?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['questions'];?>
</td>
			<td class="action">
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_icon'=>'page_edit','cookietab'=>'2','_anchor'=>'anchor2','surveyId'=>$_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'])); $_block_repeat=true; echo smarty_block_self_link(array('_icon'=>'page_edit','cookietab'=>'2','_anchor'=>'anchor2','surveyId'=>$_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Edit<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_icon'=>'page_edit','cookietab'=>'2','_anchor'=>'anchor2','surveyId'=>$_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<a class="link" href="tiki-admin_survey_questions.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'help','alt'=>"Questions",'title'=>"Questions"),$_smarty_tpl);?>
</a>
				<a class="link" href="tiki-admin_surveys.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php echo $_smarty_tpl->tpl_vars['sort_mode']->value;?>
&amp;remove=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'cross','alt'=>"Remove"),$_smarty_tpl);?>
</a>
				<?php if ($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual']=='y'){?>
					<a class="link" href="tiki-objectpermissions.php?objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['name']);?>
&amp;objectType=survey&amp;permType=surveys&amp;objectId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'key_active','alt'=>"Active Perms"),$_smarty_tpl);?>
</a>
				<?php }else{ ?>
					<a class="link" href="tiki-objectpermissions.php?objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['name']);?>
&amp;objectType=survey&amp;permType=surveys&amp;objectId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'key','alt'=>"Perms"),$_smarty_tpl);?>
</a>
				<?php }?>
				<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual']=='n'&&$_smarty_tpl->tpl_vars['tiki_p_view_survey_stats']->value=='y')||($_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['individual_tiki_p_view_survey_stats']=='y')){?>
					<a class="link" href="tiki-survey_stats_survey.php?surveyId=<?php echo $_smarty_tpl->tpl_vars['channels']->value[$_smarty_tpl->getVariable('smarty')->value['section']['user']['index']]['surveyId'];?>
"><?php echo smarty_function_icon(array('_id'=>'chart_curve','alt'=>"Stats"),$_smarty_tpl);?>
</a>
				<?php }?>
			</td>
		</tr>
	<?php endfor; else: ?>
		<?php echo smarty_function_norecords(array('_colspan'=>5),$_smarty_tpl);?>

	<?php endif; ?>
</table>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('pagination_links', array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['prefs']->value['maxRecords'],'offset'=>$_smarty_tpl->tpl_vars['offset']->value)); $_block_repeat=true; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['prefs']->value['maxRecords'],'offset'=>$_smarty_tpl->tpl_vars['offset']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['prefs']->value['maxRecords'],'offset'=>$_smarty_tpl->tpl_vars['offset']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>"Surveys"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>"Create/Edit Surveys")); $_block_repeat=true; echo smarty_block_tab(array('name'=>"Create/Edit Surveys"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['info']->value['surveyId']>0){?>
	<h2>Edit this Survey: <?php echo $_smarty_tpl->tpl_vars['info']->value['name'];?>
</h2>
<?php }else{ ?>
	<h2>Create New Survey</h2>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['individual']->value=='y'){?>
	<a class="link" href="tiki-objectpermissions.php?objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['info']->value['name']);?>
&amp;objectType=survey&amp;permType=surveys&amp;objectId=<?php echo $_smarty_tpl->tpl_vars['info']->value['surveyId'];?>
">There are individual permissions set for this survey</a><br><br>
<?php }?>

<form action="tiki-admin_surveys.php" method="post">
	<input type="hidden" name="surveyId" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['surveyId'], ENT_QUOTES, 'UTF-8', true);?>
">
	<table class="formcolor">
		<tr>
			<td>Name:</td>
			<td><input type="text" name="name" size="80" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
"></td>
		</tr>
		<tr>
			<td>Description:</td>
			<td><?php $_smarty_tpl->smarty->_tag_stack[] = array('textarea', array('name'=>"description",'rows'=>"6",'cols'=>"80",'_toolbars'=>'y','_simple'=>'y','comments'=>'y')); $_block_repeat=true; echo smarty_block_textarea(array('name'=>"description",'rows'=>"6",'cols'=>"80",'_toolbars'=>'y','_simple'=>'y','comments'=>'y'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['info']->value['description'];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_textarea(array('name'=>"description",'rows'=>"6",'cols'=>"80",'_toolbars'=>'y','_simple'=>'y','comments'=>'y'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</td>
		</tr>
		<?php echo $_smarty_tpl->getSubTemplate ('categorize.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<tr>
			<td>Status</td>
			<td>
				<select name="status">
					<option value="o" <?php if ($_smarty_tpl->tpl_vars['info']->value['status']=='o'){?>selected='selected'<?php }?>>Open</option>
					<option value="c" <?php if ($_smarty_tpl->tpl_vars['info']->value['status']=='c'){?>selected='selected'<?php }?>>Closed</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" class="btn btn-default" name="save" value="Save">
			</td>
		</tr>
	</table>
</form>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>"Create/Edit Surveys"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tabset(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>