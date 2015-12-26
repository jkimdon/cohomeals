<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 00:59:39
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/tiki-wizard_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:996685702567de67b4934d3-42778163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba3ad2039c4dcfee6e8b85e914d79a7cf11bab66' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/tiki-wizard_admin.tpl',
      1 => 1400859982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '996685702567de67b4934d3-42778163',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'wizard_toc' => 0,
    'useDefaultPrefs' => 0,
    'useUpgradeWizard' => 0,
    'wizardBody' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de67b525a39_59596120',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de67b525a39_59596120')) {function content_567de67b525a39_59596120($_smarty_tpl) {?>



<form action="tiki-wizard_admin.php" method="post">
<?php echo $_smarty_tpl->getSubTemplate ("wizard/wizard_bar_admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<div id="wizardBody">
<table class="adminWizardTable">
	<tr>
	<?php if (!empty($_smarty_tpl->tpl_vars['wizard_toc']->value)){?>
		<td class="adminWizardTOC">
			<span class="adminWizardTOCTitle"><?php if ($_smarty_tpl->tpl_vars['useDefaultPrefs']->value){?>Profiles Wizard<?php }elseif($_smarty_tpl->tpl_vars['useUpgradeWizard']->value){?>Upgrade Wizard<?php }else{ ?>Admin Wizard<?php }?> - steps:</span>
			<?php echo $_smarty_tpl->tpl_vars['wizard_toc']->value;?>

		</td>
	<?php }?>
		<td class="adminWizardBody">
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['wizardBody']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		</td>
	</tr>
</table>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("wizard/wizard_bar_admin.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</form>
<?php }} ?>