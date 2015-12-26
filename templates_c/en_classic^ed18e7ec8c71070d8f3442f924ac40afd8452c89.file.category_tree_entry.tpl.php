<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:40:51
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/category_tree_entry.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1335573866567b5b3389d4b9-57566566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed18e7ec8c71070d8f3442f924ac40afd8452c89' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/category_tree_entry.tpl',
      1 => 1362118800,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1335573866567b5b3389d4b9-57566566',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category_data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5b339245e8_75584604',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5b339245e8_75584604')) {function content_567b5b339245e8_75584604($_smarty_tpl) {?><span<?php if (!empty($_smarty_tpl->tpl_vars['category_data']->value['description'])){?> class="tips" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
 | <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['description'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
	<?php if ($_smarty_tpl->tpl_vars['category_data']->value['canchange']){?>
		<input id="categ-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['categId'], ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" name="cat_categories[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['categId'], ENT_QUOTES, 'UTF-8', true);?>
" 
			<?php if ($_smarty_tpl->tpl_vars['category_data']->value['incat']=='y'){?>checked="checked"<?php }?>>
		<input id="categ-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['categId'], ENT_QUOTES, 'UTF-8', true);?>
_hidden" type="hidden" name="cat_managed[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['categId'], ENT_QUOTES, 'UTF-8', true);?>
">
	<?php }else{ ?>
		<input id="categ-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['categId'], ENT_QUOTES, 'UTF-8', true);?>
" type="checkbox" disabled="disabled"
			<?php if ($_smarty_tpl->tpl_vars['category_data']->value['incat']=='y'){?>checked="checked"<?php }?>>
	<?php }?>
	<label for="categ-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['categId'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category_data']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</label>
</span>
<?php }} ?>