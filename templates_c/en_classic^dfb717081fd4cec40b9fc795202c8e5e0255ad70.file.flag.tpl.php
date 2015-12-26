<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:37:06
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/prefs/flag.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1626099595567b5a52a70f50-10037886%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dfb717081fd4cec40b9fc795202c8e5e0255ad70' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/prefs/flag.tpl',
      1 => 1366223016,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1626099595567b5a52a70f50-10037886',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'p' => 0,
    'mode' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5a52b3cc75_26229979',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5a52b3cc75_26229979')) {function content_567b5a52b3cc75_26229979($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_simplewiki')) include 'lib/smarty_tiki/modifier.simplewiki.php';
?><div class="adminoptionbox preference clearfix <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['tagstring'], ENT_QUOTES, 'UTF-8', true);?>
<?php if (isset($_REQUEST['highlight'])&&$_REQUEST['highlight']==$_smarty_tpl->tpl_vars['p']->value['preference']){?> highlight<?php }?>">
	<div class="adminoption">
		<input id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['preference'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['p']->value['value']=='y'){?>checked="checked" <?php }?> 
			<?php if (!$_smarty_tpl->tpl_vars['p']->value['available']){?>disabled="disabled"<?php }?> <?php echo $_smarty_tpl->tpl_vars['p']->value['params'];?>

			data-tiki-admin-child-block="#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['preference'], ENT_QUOTES, 'UTF-8', true);?>
_childcontainer"
			data-tiki-admin-child-mode="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mode']->value, ENT_QUOTES, 'UTF-8', true);?>
"
		>
	</div>
	<div class="adminoptionlabel" >
		<label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</label>
		<?php echo $_smarty_tpl->getSubTemplate ("prefs/shared-flags.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php if ($_smarty_tpl->tpl_vars['p']->value['hint']){?>
			<br/><em><?php echo smarty_modifier_simplewiki($_smarty_tpl->tpl_vars['p']->value['hint']);?>
</em>
		<?php }?>
	</div>
	<?php echo $_smarty_tpl->getSubTemplate ("prefs/shared-dependencies.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php }} ?>