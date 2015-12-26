<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:31
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wizard/wizard_bar_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1623461319567b58c7b8c2e6-24678189%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '999c6c1f1de966ac503806a2a0417a96368f9d11' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wizard/wizard_bar_admin.tpl',
      1 => 1400859982,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1623461319567b58c7b8c2e6-24678189',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'showOnLoginDisplayed' => 0,
    'showOnLogin' => 0,
    'prefs' => 0,
    'provideFeedback' => 0,
    'connect_feedback_showing' => 0,
    'headerlib' => 0,
    'firstWizardPage' => 0,
    'showWizardPageTitle' => 0,
    'pageTitle' => 0,
    'homepageUrl' => 0,
    'wizard_step' => 0,
    'useDefaultPrefs' => 0,
    'useUpgradeWizard' => 0,
    'lastWizardPage' => 0,
    'isEditable' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58c7c513e0_95773388',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c7c513e0_95773388')) {function content_567b58c7c513e0_95773388($_smarty_tpl) {?>

<table style="width:100%">
<tr>
<td colspan="3" style="text-align:left; width:270px">
	<?php if (!isset($_smarty_tpl->tpl_vars['showOnLoginDisplayed']->value)||$_smarty_tpl->tpl_vars['showOnLoginDisplayed']->value!='y'){?>
		<div style="float:left; width:20px"><img src="img/icons/wizard16x16.png" alt="Wizard" title="Wizard" /></div>
		<input type="checkbox" name="showOnLogin" <?php if (isset($_smarty_tpl->tpl_vars['showOnLogin']->value)&&$_smarty_tpl->tpl_vars['showOnLogin']->value==true){?>checked="checked"<?php }?> /> Show on admin login
		<?php $_smarty_tpl->tpl_vars["showOnLoginDisplayed"] = new Smarty_variable("y", null, 2);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["showOnLoginDisplayed"] = clone $_smarty_tpl->tpl_vars["showOnLoginDisplayed"]; $_ptr = $_ptr->parent; }?>
	<?php }else{ ?>
		&nbsp;
	<?php }?>
        &nbsp;&nbsp;
    <?php if ($_smarty_tpl->tpl_vars['prefs']->value['connect_feature']=="y"){?>
        <?php if (!isset($_smarty_tpl->tpl_vars['provideFeedback']->value)||$_smarty_tpl->tpl_vars['provideFeedback']->value!='y'){?>
            <label>
                <input type="checkbox" id="connect_feedback_cbx" <?php if (!empty($_smarty_tpl->tpl_vars['connect_feedback_showing']->value)){?>checked="checked"<?php }?>>
                Provide Feedback
                <a href="http://doc.tiki.org/Connect" target="tikihelp" class="tikihelp" title="Provide Feedback:
                Once selected, some icon/s will be shown next to all features so that you can provide some on-site feedback about them.
                <br/><br/>
                <ul>
                    <li>Icon for 'Like' <img src=img/icons/connect_like.png></li>
<!--				<li>Icon for 'Fix me' <img src=img/icons/connect_fix.png></li> -->
<!--				<li>Icon for 'What is this for?' <img src=img/icons/connect_wtf.png></li> -->
                </ul>
                <br/>
                Your votes will be sent when you connect with mother.tiki.org (currently only by clicking the 'Connect > <strong>Send Info</strong>' button)
                <br/><br/>
                Click to read more
	    	    ">
                    <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
                </a>
            </label>
            <?php echo $_smarty_tpl->tpl_vars['headerlib']->value->add_jsfile("lib/jquery_tiki/tiki-connect.js");?>


            <?php $_smarty_tpl->tpl_vars["provideFeedback"] = new Smarty_variable("y", null, 2);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["provideFeedback"] = clone $_smarty_tpl->tpl_vars["provideFeedback"]; $_ptr = $_ptr->parent; }?>
        <?php }else{ ?>
            &nbsp;
        <?php }?>
    <?php }?>

	</td>
</tr>
<tr>
<td style="text-align:left">
	<input type="submit" class="btn btn-warning" name="close" value="Close" />
	&nbsp;&nbsp;&nbsp;
	<?php if (!isset($_smarty_tpl->tpl_vars['firstWizardPage']->value)){?><input type="submit" class="btn btn-default" name="back" value="Back" /><?php }?>
	</td>
<td>
	<?php if (!isset($_smarty_tpl->tpl_vars['showWizardPageTitle']->value)||$_smarty_tpl->tpl_vars['showWizardPageTitle']->value!='y'){?>
		<h1 class="adminWizardPageTitle"><?php echo $_smarty_tpl->tpl_vars['pageTitle']->value;?>
</h1>
		<?php $_smarty_tpl->tpl_vars["showWizardPageTitle"] = new Smarty_variable("y", null, 2);
$_ptr = $_smarty_tpl->parent; while ($_ptr != null) {$_ptr->tpl_vars["showWizardPageTitle"] = clone $_smarty_tpl->tpl_vars["showWizardPageTitle"]; $_ptr = $_ptr->parent; }?>
	<?php }?>
	</td>
<td style="text-align:right">
	<input type="hidden" name="url" value="<?php echo $_smarty_tpl->tpl_vars['homepageUrl']->value;?>
">
	<input type="hidden" name="wizard_step" value="<?php echo $_smarty_tpl->tpl_vars['wizard_step']->value;?>
">
	<?php if (isset($_smarty_tpl->tpl_vars['useDefaultPrefs']->value)){?>
		<input type="hidden" name="use-default-prefs" value="<?php echo $_smarty_tpl->tpl_vars['useDefaultPrefs']->value;?>
">
	<?php }?>
    <?php if (isset($_smarty_tpl->tpl_vars['useUpgradeWizard']->value)){?>
        <input type="hidden" name="use-upgrade-wizard" value="<?php echo $_smarty_tpl->tpl_vars['useUpgradeWizard']->value;?>
">
    <?php }?>
	<input type="submit" class="btn btn-default" name="<?php if (isset($_smarty_tpl->tpl_vars['firstWizardPage']->value)){?>use-default-prefs<?php }else{ ?>continue<?php }?>" value="<?php if (isset($_smarty_tpl->tpl_vars['lastWizardPage']->value)){?>Finish<?php }elseif(isset($_smarty_tpl->tpl_vars['firstWizardPage']->value)){?>Start<?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['isEditable']->value==true){?>Save and Continue<?php }else{ ?>Next<?php }?><?php }?>" />
	</td>
</tr>
</table>

<?php }} ?>