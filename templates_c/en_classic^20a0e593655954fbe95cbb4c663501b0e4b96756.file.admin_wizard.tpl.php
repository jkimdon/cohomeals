<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:31
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wizard/admin_wizard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:500864406567b58c7c571a7-12593837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20a0e593655954fbe95cbb4c663501b0e4b96756' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wizard/admin_wizard.tpl',
      1 => 1401362034,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '500864406567b58c7c571a7-12593837',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tiki_version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58c7c8a458_13466960',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c7c8a458_13466960')) {function content_567b58c7c8a458_13466960($_smarty_tpl) {?><?php if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
?>

<fieldset>
	<legend>Get Started</legend>

	<img src="img/icons/tick.png" alt="Ok" /><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>$_smarty_tpl->tpl_vars['tiki_version']->value)); $_block_repeat=true; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['tiki_version']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Congratulations! You now have a working instance of Tiki %0<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['tiki_version']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
. 
    You may <a href="tiki-index.php">start using it right away</a>, or you may configure it to better meet your needs, using one of the configuration helpers below.
    <br>
	<div style="width:90%">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"tip",'title'=>"Tip")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Tip"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        Mouse over the icons to know more about the features and preferences that are new for you.
		<a href="http://doc.tiki.org/Wizards" target="tikihelp" class="tikihelp" style="float:right" title="Help icon: 
			You will get more information about the features and preferences whenever this icon is available and you pass your mouse over it. 
			<br/><br/>Moreover, if you click on it, you'll be directed in a new window to the corresponding documentation page for further information on that feature or topic.">
			<img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
		</a>
        <div target="tikihelp" class="tikihelp" style="float:right" title="Information icon:
            You will get more information about the features and preferences whenever this icon is available and you pass your mouse over it.
            ">
            <img src="img/icons/information.png" alt="" width="16" height="16" class="icon" />
        </div>
		Example: 
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Tip"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</div>
	<br>
    <table>
        <tr>
            <td><div class="adminWizardIconleft"><img src="img/icons/large/wizard_profiles48x48.png" alt="Configuration Profiles Wizard" title="Configuration Profiles Wizard" /></div></td>
            <td>
                You may start by applying some of our configuration templates through the <b>Configuration Profiles Wizard</b>. They are like the <b>Macros</b> from many computer languages.
				<a href="http://doc.tiki.org/Profiles+Wizard" target="tikihelp" class="tikihelp" title="Configuration Profiles: 
                Each of these provides a shrink-wrapped solution that meets most of the needs of a particular kind of community or site (Personal Blog space, Company Intranet, ...) or that extends basic setup with extra features configured for you.
                <br><br>If you are new to Tiki administration, we recommend that you start with this approach.
                <br><br>If the profile you selected does not quite meet your needs, you will still have the option of customizing it further with one of the approaches below">
					<img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
				</a>
                <br>
                <input  type="submit" class="btn btn-default" name="use-default-prefs" value="Start Configuration Profiles Wizard (Macros)" />
                <br><br>
            </td>
        </tr>

        <tr>
            <td><div class="adminWizardIconleft"><img src="img/icons/large/wizard_admin48x48.png" alt="Configuration Walkthrough" title="Configuration Walkthrough" /><br/><br/></div></td>
            <td>
                Alternatively, you may use the <b>Admin Wizard</b>.
                This will guide you through the most common preference settings in order to customize your site.
				<a href="http://doc.tiki.org/Admin+Wizard" target="tikihelp" class="tikihelp" title="Admin Wizard: 
                Use this wizard if none of the <b>Configuration Profiles</b> look like a good starting point, or if you need to customize your site further">
					<img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
				</a>
                <br>
                <input type="submit" class="btn btn-default" name="continue" value="Start Admin Wizard" /><br><br>
            </td>
        </tr>

        <tr>
            <td><div class="adminWizardIconleft"><img src="img/icons/large/wizard_upgrade48x48.png" alt="Upgrade Wizard" title="Upgrade Wizard" /><br/><br/></div></td>
            <td>
                Or you may use the <b>Upgrade Wizard</b>.
                This will guide you through the most common new settings and informations in order to upgrade your site.
                <a href="http://doc.tiki.org/Upgrade+Wizard" target="tikihelp" class="tikihelp" title="Upgrade Wizard:
                Use this wizard if you are upgrading from previous versions of Tiki, specially if you come from the previous Long Term Support (LTS) version.
                <br/><br/>
                Some of these settings are also available through the Admin Wizard, and all of them are available through Admin Panels.
                But this wizard will let you learn about them as well as enable/disable them easily according to your needs and interests for your site.">
                    <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
                </a>
                <br>
                <input type="submit" class="btn btn-default" name="use-upgrade-wizard" value="Start Upgrade Wizard" /><br><br>
            </td>
        </tr>

        <tr>
            <td><div class="adminWizardIconleft"><img src="img/icons/large/admin_panel48x48.png" alt="Admin Panel" /></div></td>
            <td>
                Use the <b>Admin Panel</b> to manually browse through the full list of preferences.
                <br>
                <?php echo smarty_function_button(array('href'=>"tiki-admin.php",'_text'=>"Go to the Admin Panel"),$_smarty_tpl);?>

                <br><br>
            </td>
        </tr>
    </table>
</fieldset>

<fieldset>
<legend>Server Fitness</legend>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>$_smarty_tpl->tpl_vars['tiki_version']->value)); $_block_repeat=true; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['tiki_version']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
To check if your server meets the requirements for running Tiki version %0, please visit <a href="tiki-check.php" target="_blank">Tiki Server Compatibility Check</a><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['tiki_version']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.
</fieldset>

<?php }} ?>