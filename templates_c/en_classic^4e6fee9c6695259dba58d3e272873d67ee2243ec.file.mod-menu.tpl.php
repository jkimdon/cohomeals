<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:58:22
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/modules/mod-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1289692362567de62e090958-94046279%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e6fee9c6695259dba58d3e272873d67ee2243ec' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/modules/mod-menu.tpl',
      1 => 1351087533,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1289692362567de62e090958-94046279',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_error' => 0,
    'tpl_module_title' => 0,
    'tpl_module_name' => 0,
    'module_params' => 0,
    'module_type' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de62e2a6340_02168410',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de62e2a6340_02168410')) {function content_567de62e2a6340_02168410($_smarty_tpl) {?><?php if (!is_callable('smarty_block_tikimodule')) include 'lib/smarty_tiki/block.tikimodule.php';
if (!is_callable('smarty_function_menu')) include 'lib/smarty_tiki/function.menu.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('tikimodule', array('error'=>$_smarty_tpl->tpl_vars['module_error']->value,'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>$_smarty_tpl->tpl_vars['tpl_module_name']->value,'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'],'type'=>$_smarty_tpl->tpl_vars['module_type']->value)); $_block_repeat=true; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_error']->value,'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>$_smarty_tpl->tpl_vars['tpl_module_name']->value,'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'],'type'=>$_smarty_tpl->tpl_vars['module_type']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if (!empty($_smarty_tpl->tpl_vars['module_params']->value['menu_id'])){?>
	<div class="clearfix <?php echo $_smarty_tpl->tpl_vars['module_params']->value['menu_class'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['module_params']->value['menu_id'];?>
">
		<?php echo smarty_function_menu(array('params'=>$_smarty_tpl->tpl_vars['module_params']->value),$_smarty_tpl);?>

	</div>
<?php }else{ ?>
	<?php echo smarty_function_menu(array('params'=>$_smarty_tpl->tpl_vars['module_params']->value),$_smarty_tpl);?>

<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_error']->value,'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>$_smarty_tpl->tpl_vars['tpl_module_name']->value,'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'],'type'=>$_smarty_tpl->tpl_vars['module_type']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>