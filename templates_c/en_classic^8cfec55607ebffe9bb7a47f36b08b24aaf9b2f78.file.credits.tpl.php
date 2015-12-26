<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:25
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/credits.tpl" */ ?>
<?php /*%%SmartyHeaderCode:763766781567b58c1958655-77833942%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8cfec55607ebffe9bb7a47f36b08b24aaf9b2f78' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/credits.tpl',
      1 => 1302758003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '763766781567b58c1958655-77833942',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'prefs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58c197bef2_86545196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c197bef2_86545196')) {function content_567b58c197bef2_86545196($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/modifier.replace.php';
?>Theme: <?php echo ucwords(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['prefs']->value['style'],'.css',''),'None',''));?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['style_option']){?> - <?php echo ucwords(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['prefs']->value['style_option'],'.css',''),'None',''));?>
<?php }?>
<?php }} ?>