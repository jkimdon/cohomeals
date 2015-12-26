<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:59:39
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/modules/user_module.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1207313784567de67bbaddd6-85679426%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '223d1474d1c9d987764c17b5e9d5529f446f8e6b' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/modules/user_module.tpl',
      1 => 1302758003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1207313784567de67bbaddd6-85679426',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_params' => 0,
    'user_title' => 0,
    'user_module_name' => 0,
    'module_type' => 0,
    'user_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de67bc57c89_32541968',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de67bc57c89_32541968')) {function content_567de67bc57c89_32541968($_smarty_tpl) {?><?php if (!is_callable('smarty_block_tikimodule')) include 'lib/smarty_tiki/block.tikimodule.php';
if (!is_callable('smarty_modifier_stringfix')) include 'lib/smarty_tiki/modifier.stringfix.php';
?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('tikimodule', array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['user_title']->value,'name'=>$_smarty_tpl->tpl_vars['user_module_name']->value,'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'overflow'=>$_smarty_tpl->tpl_vars['module_params']->value['overflow'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'],'type'=>$_smarty_tpl->tpl_vars['module_type']->value)); $_block_repeat=true; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['user_title']->value,'name'=>$_smarty_tpl->tpl_vars['user_module_name']->value,'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'overflow'=>$_smarty_tpl->tpl_vars['module_params']->value['overflow'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'],'type'=>$_smarty_tpl->tpl_vars['module_type']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


<div id="<?php echo smarty_modifier_stringfix($_smarty_tpl->tpl_vars['user_module_name']->value,' ','_');?>
" <?php if ((isset($_COOKIE[$_smarty_tpl->tpl_vars['user_module_name']->value])&&$_COOKIE[$_smarty_tpl->tpl_vars['user_module_name']->value]!='c')||!isset($_COOKIE[$_smarty_tpl->tpl_vars['user_module_name']->value])){?>style="display:block;"<?php }else{ ?>style="display:none;"<?php }?>>
<?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['user_data']->value, $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?>
</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['user_title']->value,'name'=>$_smarty_tpl->tpl_vars['user_module_name']->value,'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'overflow'=>$_smarty_tpl->tpl_vars['module_params']->value['overflow'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'],'type'=>$_smarty_tpl->tpl_vars['module_type']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>