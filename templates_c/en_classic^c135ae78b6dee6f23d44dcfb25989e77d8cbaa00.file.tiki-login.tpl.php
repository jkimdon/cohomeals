<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:23
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1027793995567b58bfb007e0-03464867%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c135ae78b6dee6f23d44dcfb25989e77d8cbaa00' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-login.tpl',
      1 => 1368636796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1027793995567b58bfb007e0-03464867',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58bfb754d6_72815339',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58bfb754d6_72815339')) {function content_567b58bfb754d6_72815339($_smarty_tpl) {?><?php if (!is_callable('smarty_function_module')) include 'lib/smarty_tiki/function.module.php';
?><div align="center">
<?php echo smarty_function_module(array('module'=>'login_box','mode'=>"module",'show_register'=>"y",'show_forgot'=>"y",'error'=>'','flip'=>'','decorations'=>'','nobox'=>'','notitle'=>''),$_smarty_tpl);?>

</div>
<?php }} ?>