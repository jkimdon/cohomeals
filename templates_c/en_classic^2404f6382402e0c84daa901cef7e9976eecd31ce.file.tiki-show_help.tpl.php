<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:31:10
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-show_help.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1503090768567b58ee21ad00-56673036%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2404f6382402e0c84daa901cef7e9976eecd31ce' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-show_help.tpl',
      1 => 1369849898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1503090768567b58ee21ad00-56673036',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'help_sections' => 0,
    'help' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58ee25b941_45663120',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58ee25b941_45663120')) {function content_567b58ee25b941_45663120($_smarty_tpl) {?>
<div class="help" id="tikihelp">
	<div class="help_sections" id="help_sections" style="display:none">
		<ul>
			<?php  $_smarty_tpl->tpl_vars['help'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['help']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['help_sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['help']->key => $_smarty_tpl->tpl_vars['help']->value){
$_smarty_tpl->tpl_vars['help']->_loop = true;
?>
				<li>
					<a href="#<?php echo $_smarty_tpl->tpl_vars['help']->value['id'];?>
">
						<?php echo $_smarty_tpl->tpl_vars['help']->value['title'];?>

					</a>
				</li>
			<?php } ?>
		</ul>
		<?php  $_smarty_tpl->tpl_vars['help'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['help']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['help_sections']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['help']->key => $_smarty_tpl->tpl_vars['help']->value){
$_smarty_tpl->tpl_vars['help']->_loop = true;
?>
			<div id="<?php echo $_smarty_tpl->tpl_vars['help']->value['id'];?>
" class="">
				<?php echo $_smarty_tpl->tpl_vars['help']->value['content'];?>

			</div>
		<?php } ?>
	</div>
</div>
<br>
<?php }} ?>