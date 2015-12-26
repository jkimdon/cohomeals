<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:58:21
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/modules/mod-logo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:243612509567de62d3a0919-46612968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78b83947fbf822588a01063638731634964114c1' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/modules/mod-logo.tpl',
      1 => 1376045156,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '243612509567de62d3a0919-46612968',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_params' => 0,
    'tpl_module_title' => 0,
    'prefs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de62d541e91_19864577',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de62d541e91_19864577')) {function content_567de62d541e91_19864577($_smarty_tpl) {?><?php if (!is_callable('smarty_block_tikimodule')) include 'lib/smarty_tiki/block.tikimodule.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('tikimodule', array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>"logo",'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'])); $_block_repeat=true; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>"logo",'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<div <?php if ($_smarty_tpl->tpl_vars['module_params']->value['bgcolor']!=''){?> style="background-color: <?php echo $_smarty_tpl->tpl_vars['module_params']->value['bgcolor'];?>
;" <?php }?> class="floatleft <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_params']->value['class_image'], ENT_QUOTES, 'UTF-8', true);?>
"><?php if ($_smarty_tpl->tpl_vars['module_params']->value['src']){?><a href="<?php echo $_smarty_tpl->tpl_vars['module_params']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_params']->value['title_attr'], ENT_QUOTES, 'UTF-8', true);?>
"<?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?> rel="external"<?php }?>><img src="<?php echo $_smarty_tpl->tpl_vars['module_params']->value['src'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_params']->value['alt_attr'], ENT_QUOTES, 'UTF-8', true);?>
" style="border: none"></a><?php }?></div><?php if (!empty($_smarty_tpl->tpl_vars['module_params']->value['sitetitle'])||!empty($_smarty_tpl->tpl_vars['module_params']->value['sitesubtitle'])){?><div class="floatleft  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_params']->value['class_titles'], ENT_QUOTES, 'UTF-8', true);?>
"><div class="sitetitle"><?php if (!empty($_smarty_tpl->tpl_vars['module_params']->value['sitetitle'])){?><a href="<?php echo $_smarty_tpl->tpl_vars['module_params']->value['link'];?>
"<?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']=="y"){?> rel="external"<?php }?>><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_params']->value['sitetitle'], ENT_QUOTES, 'UTF-8', true);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</a><?php }?></div><div class="sitesubtitle"><?php if (!empty($_smarty_tpl->tpl_vars['module_params']->value['sitesubtitle'])){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_params']->value['sitesubtitle'], ENT_QUOTES, 'UTF-8', true);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?></div></div><?php }?><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>"logo",'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>