<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:31:10
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-edit_help_plugins.tpl" */ ?>
<?php /*%%SmartyHeaderCode:462580030567b58ee125441-56937935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '834a28302bcfe3fca03ada4c7b1cd81899dfcd3c' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-edit_help_plugins.tpl',
      1 => 1392161615,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '462580030567b58ee125441-56937935',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'plugins' => 0,
    'prefs' => 0,
    'tiki_p_admin' => 0,
    'editorId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58ee18fcf1_03966331',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58ee18fcf1_03966331')) {function content_567b58ee18fcf1_03966331($_smarty_tpl) {?><?php if (!is_callable('smarty_block_add_help')) include 'lib/smarty_tiki/block.add_help.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_listfilter')) include 'lib/smarty_tiki/function.listfilter.php';
if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('add_help', array('show'=>'n','id'=>"plugin_help",'title'=>"Plugin Help")); $_block_repeat=true; echo smarty_block_add_help(array('show'=>'n','id'=>"plugin_help",'title'=>"Plugin Help"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


<?php if (count($_smarty_tpl->tpl_vars['plugins']->value)!=0){?>

<h3>Plugins</h3>
<div class="help_section">
<p>Note that plugin arguments can be enclosed with double quotes (&quot;); this allows them to contain , or = or &gt;.<br>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_help']=='y'){?>More help here <a href="<?php echo $_smarty_tpl->tpl_vars['prefs']->value['helpurl'];?>
Plugins" target="tikihelp" class="tikihelp" title="Plugins:Wiki plugins extend the function of wiki syntax with more specialized commands."><?php echo smarty_function_icon(array('_id'=>'help','style'=>"vertical-align:middle"),$_smarty_tpl);?>
</a>
<?php }?></p>

<?php if ($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y'){?>
<a href="tiki-admin.php?page=textarea&amp;cookietab=2" target="tikihelp" class="tikihelp">Activate/deactivate plugins</a>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['editorId']->value)){?>
	<?php echo smarty_function_listfilter(array('selectors'=>'#plugins_help_table tr','editorId'=>$_smarty_tpl->tpl_vars['editorId']->value,'parentTabId'=>"plugin_help"),$_smarty_tpl);?>

<?php }else{ ?>
	<?php echo smarty_function_listfilter(array('selectors'=>'#plugins_help_table tr','parentTabId'=>"plugin_help"),$_smarty_tpl);?>

<?php }?>
<table id="plugins_help_table" width="95%" class="formcolor">
	<tr><th>Description</th></tr>
  <?php echo smarty_function_cycle(array('values'=>"even,odd",'print'=>false),$_smarty_tpl);?>

  <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['plugins']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>    
    <tr class="<?php echo smarty_function_cycle(array(),$_smarty_tpl);?>
">
      <td>
        <?php if ($_smarty_tpl->tpl_vars['plugins']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['help']==''){?>
          No description available
        <?php }else{ ?>
          <?php echo $_smarty_tpl->tpl_vars['plugins']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['help'];?>

        <?php }?>
      </td>
    </tr>
  <?php endfor; endif; ?>
</table>
</div>
<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_add_help(array('show'=>'n','id'=>"plugin_help",'title'=>"Plugin Help"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>