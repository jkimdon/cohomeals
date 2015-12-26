<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:58:28
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/credits.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2054745042567de6349b3821-67336941%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '972057e06a3a062e4eb57624d77a3429f1c60b78' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/credits.tpl',
      1 => 1302758003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2054745042567de6349b3821-67336941',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'prefs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de634b5ff33_72481456',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de634b5ff33_72481456')) {function content_567de634b5ff33_72481456($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/home/jkimdon/newStuff/coho/software/code/cohomeals/vendor/smarty/smarty/distribution/libs/plugins/modifier.replace.php';
?>Theme: <?php echo ucwords(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['prefs']->value['style'],'.css',''),'None',''));?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['style_option']){?> - <?php echo ucwords(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['prefs']->value['style_option'],'.css',''),'None',''));?>
<?php }?>
<?php }} ?>