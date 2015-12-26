<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:24
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-ajax_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:780811823567b58c0d9a260-12610233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e74b2cd22a9798f6fc4b62505a29df3595d9b567' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-ajax_header.tpl',
      1 => 1302758003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '780811823567b58c0d9a260-12610233',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'prefs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58c0e00998_72816010',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c0e00998_72816010')) {function content_567b58c0e00998_72816010($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_ajax']=='y'){?>
<div id="ajaxLoading">Loading...</div>
<div id="ajaxLoadingBG">&nbsp;</div>
<div id="ajaxDebug"></div>
<?php }?>
<?php }} ?>