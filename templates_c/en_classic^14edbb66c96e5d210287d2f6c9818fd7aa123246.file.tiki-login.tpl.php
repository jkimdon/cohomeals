<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:58:16
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/tiki-login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:575690586567de6284b9ad7-51169827%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '14edbb66c96e5d210287d2f6c9818fd7aa123246' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/tiki-login.tpl',
      1 => 1368636796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '575690586567de6284b9ad7-51169827',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de62870c881_79388234',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de62870c881_79388234')) {function content_567de62870c881_79388234($_smarty_tpl) {?><?php if (!is_callable('smarty_function_module')) include 'lib/smarty_tiki/function.module.php';
?><div align="center">
<?php echo smarty_function_module(array('module'=>'login_box','mode'=>"module",'show_register'=>"y",'show_forgot'=>"y",'error'=>'','flip'=>'','decorations'=>'','nobox'=>'','notitle'=>''),$_smarty_tpl);?>

</div>
<?php }} ?>