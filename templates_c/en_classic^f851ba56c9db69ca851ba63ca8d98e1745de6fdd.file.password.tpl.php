<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:37:06
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/prefs/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1649766620567b5a52eafde8-35962007%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f851ba56c9db69ca851ba63ca8d98e1745de6fdd' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/prefs/password.tpl',
      1 => 1362131000,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1649766620567b5a52eafde8-35962007',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'p' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5a52f1fcb7_28237626',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5a52f1fcb7_28237626')) {function content_567b5a52f1fcb7_28237626($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_simplewiki')) include 'lib/smarty_tiki/modifier.simplewiki.php';
?><div class="adminoptionbox preference clearfix <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['tagstring'], ENT_QUOTES, 'UTF-8', true);?>
<?php if (isset($_REQUEST['highlight'])&&$_REQUEST['highlight']==$_smarty_tpl->tpl_vars['p']->value['preference']){?> highlight<?php }?>">
	<label for="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
:</label>
	<input name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['preference'], ENT_QUOTES, 'UTF-8', true);?>
" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['value'], ENT_QUOTES, 'UTF-8', true);?>
" size="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['p']->value['size'])===null||$tmp==='' ? 80 : $tmp), ENT_QUOTES, 'UTF-8', true);?>
" type="password" <?php echo $_smarty_tpl->tpl_vars['p']->value['params'];?>
>
	<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['p']->value['detail'], ENT_QUOTES, 'UTF-8', true);?>

	<?php echo $_smarty_tpl->getSubTemplate ("prefs/shared-flags.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	<?php if ($_smarty_tpl->tpl_vars['p']->value['shorthint']){?>
		<em><?php echo smarty_modifier_simplewiki($_smarty_tpl->tpl_vars['p']->value['shorthint']);?>
</em>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['p']->value['hint']){?>
		<br/><em><?php echo smarty_modifier_simplewiki($_smarty_tpl->tpl_vars['p']->value['hint']);?>
</em>
	<?php }?>
	<?php echo $_smarty_tpl->getSubTemplate ("prefs/shared-dependencies.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</div>
<?php }} ?>