<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:58:20
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/tiki-ajax_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1135687034567de62cf1c008-03438100%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67b1dffcc9460fb6875edf5fb80bae86ac1d5c60' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/tiki-ajax_header.tpl',
      1 => 1302758003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1135687034567de62cf1c008-03438100',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'prefs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de62d0b3ea8_91700196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de62d0b3ea8_91700196')) {function content_567de62d0b3ea8_91700196($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_ajax']=='y'){?>
<div id="ajaxLoading">Loading...</div>
<div id="ajaxLoadingBG">&nbsp;</div>
<div id="ajaxDebug"></div>
<?php }?>
<?php }} ?>