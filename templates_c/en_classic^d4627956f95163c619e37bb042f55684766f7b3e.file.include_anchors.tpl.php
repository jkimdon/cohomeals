<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:37:06
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/admin/include_anchors.tpl" */ ?>
<?php /*%%SmartyHeaderCode:411203334567b5a5254dd43-08040222%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4627956f95163c619e37bb042f55684766f7b3e' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/admin/include_anchors.tpl',
      1 => 1381491635,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '411203334567b5a5254dd43-08040222',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'icons' => 0,
    'info' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5a525aa353_03850879',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5a525aa353_03850879')) {function content_567b5a525aa353_03850879($_smarty_tpl) {?><?php if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
?>

<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_smarty_tpl->tpl_vars['page'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['icons']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
 $_smarty_tpl->tpl_vars['page']->value = $_smarty_tpl->tpl_vars['info']->key;
?>
	<?php if (!$_smarty_tpl->tpl_vars['info']->value['disabled']&&$_smarty_tpl->tpl_vars['info']->value['icon']){?>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_icon'=>$_smarty_tpl->tpl_vars['info']->value['icon'],'_icon_class'=>"reflect",'_width'=>"32",'_height'=>"32",'_alt'=>$_smarty_tpl->tpl_vars['info']->value['title'],'page'=>$_smarty_tpl->tpl_vars['page']->value,'_class'=>"icon tips",'_title'=>((string)$_smarty_tpl->tpl_vars['info']->value['title'])."|".((string)$_smarty_tpl->tpl_vars['info']->value['description']))); $_block_repeat=true; echo smarty_block_self_link(array('_icon'=>$_smarty_tpl->tpl_vars['info']->value['icon'],'_icon_class'=>"reflect",'_width'=>"32",'_height'=>"32",'_alt'=>$_smarty_tpl->tpl_vars['info']->value['title'],'page'=>$_smarty_tpl->tpl_vars['page']->value,'_class'=>"icon tips",'_title'=>((string)$_smarty_tpl->tpl_vars['info']->value['title'])."|".((string)$_smarty_tpl->tpl_vars['info']->value['description'])), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_icon'=>$_smarty_tpl->tpl_vars['info']->value['icon'],'_icon_class'=>"reflect",'_width'=>"32",'_height'=>"32",'_alt'=>$_smarty_tpl->tpl_vars['info']->value['title'],'page'=>$_smarty_tpl->tpl_vars['page']->value,'_class'=>"icon tips",'_title'=>((string)$_smarty_tpl->tpl_vars['info']->value['title'])."|".((string)$_smarty_tpl->tpl_vars['info']->value['description'])), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
<?php } ?>

<br class="clear" />
<?php }} ?>