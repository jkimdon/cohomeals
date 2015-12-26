<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:59:39
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/remarksbox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:364547958567de67b6af183-02102612%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d69af673ffca9ba019ab03e4834ccf85a11efd5' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/remarksbox.tpl',
      1 => 1387294681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '364547958567de67b6af183-02102612',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'rbox_params' => 0,
    'rbox_guid' => 0,
    'rbox_close_click' => 0,
    'remarksbox_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de67b732fc0_53427520',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de67b732fc0_53427520')) {function content_567de67b732fc0_53427520($_smarty_tpl) {?><?php if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
?>
<div class="clearfix rbox <?php echo $_smarty_tpl->tpl_vars['rbox_params']->value['type'];?>
 panel" id="<?php echo $_smarty_tpl->tpl_vars['rbox_guid']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['rbox_params']->value['close']&&$_smarty_tpl->tpl_vars['rbox_params']->value['type']!='errors'&&$_smarty_tpl->tpl_vars['rbox_params']->value['type']!='confirm'){?><?php echo smarty_function_icon(array('_id'=>'close','class'=>'rbox-close','onclick'=>(($tmp = @$_smarty_tpl->tpl_vars['rbox_close_click']->value)===null||$tmp==='' ? '' : $tmp)),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['rbox_params']->value['title']!=''){?><div class="rbox-title panel-heading"><?php if ($_smarty_tpl->tpl_vars['rbox_params']->value['icon']!='none'){?><img src="img/icons/<?php echo $_smarty_tpl->tpl_vars['rbox_params']->value['icon'];?>
.png" alt="<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['rbox_params']->value['type'];?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
" class="icon"><?php }?><span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rbox_params']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</span></div><?php }?><div class="rbox-data <?php echo $_smarty_tpl->tpl_vars['rbox_params']->value['highlight'];?>
 panel-body"<?php if (!empty($_smarty_tpl->tpl_vars['rbox_params']->value['width'])){?> style="width:<?php echo $_smarty_tpl->tpl_vars['rbox_params']->value['width'];?>
"<?php }?>><?php echo $_smarty_tpl->tpl_vars['remarksbox_content']->value;?>
</div></div><?php }} ?>