<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 01:00:29
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/wizard/profiles_useful_changes_in_display.tpl" */ ?>
<?php /*%%SmartyHeaderCode:744339303567de6adf3bd44-84163646%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c79eb09f65a6458e5c02fdf42dfe50a162fde416' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/wizard/profiles_useful_changes_in_display.tpl',
      1 => 1399363765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '744339303567de6adf3bd44-84163646',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tikiMajorVersion' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de6ae069348_63390778',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de6ae069348_63390778')) {function content_567de6ae069348_63390778($_smarty_tpl) {?>

<div class="adminWizardIconleft"><img src="img/icons/large/wizard_profiles48x48.png" alt="Configuration Profiles Wizard" title="Configuration Profiles Wizard" /></div>
Check out some useful profiles that involve changing the display mode of content in your site. </br></br>
<div class="adminWizardContent">
<fieldset>
	<legend>Profiles:</legend>
	<table style="width:100%">
	<tr>
        <td style="width:48%">
            <b>Mobile</b> (<a href="tiki-admin.php?profile=Mobile&show_details_for=Mobile&categories%5B%5D=<?php echo $_smarty_tpl->tpl_vars['tikiMajorVersion']->value;?>
.x&repository=http%3a%2f%2fprofiles.tiki.org%2fprofiles&page=profiles&preloadlist=y&list=List#step2" target="_blank">apply profile now</a>)
            <br/>
            This profile allows to switch the site layout, text and icons to users with smartphones and tablets
            <br/><a href="https://doc.tiki.org/Mobile" target="tikihelp" class="tikihelp" title="Mobile:
           	More details:
        	<ul>
		        <li>Automatic switch when a mobile device is detected</li>
	            <li>Manual switch allowed with provided side module</li>
	            <li>Enhanced mobile mode since Tiki 12</li>
	        </ul>
           	Click to read more">
                <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
            </a>
            <div style="display:block; margin-left:auto; margin-right:auto; width:202px;">
                <a href="http://doc.tiki.org/display942" class="internal" rel="box" title="Click to expand">
                    <img src="img/profiles/profile_thumb_mobile.png"  width="150" style="display:block; margin-left:auto; margin-right:auto;border:1px solid darkgray;" alt="Click to expand" class="regImage pluginImg" title="Click to expand" />
                </a>
                <div class="mini" style="width:100px;">
                    <div class="thumbcaption text-center">Click to expand</div>
                </div>
            </div>
        </td>
        <td style="width:4%">
            &nbsp;
        </td>
        <td style="width:48%">
            <b>Slideshow demo</b>  (<a href="tiki-admin.php?profile=Slideshow_demo&show_details_for=Slideshow_demo&categories%5B%5D=<?php echo $_smarty_tpl->tpl_vars['tikiMajorVersion']->value;?>
.x&repository=http%3a%2f%2fprofiles.tiki.org%2fprofiles&page=profiles&preloadlist=y&list=List#step2" target="_blank">apply profile now</a>)
            <br/>
            This profile sets up a slideshow from a simple wiki page, which you can use to learn the basics of how easily the JqueryS5 slideshow system in Tiki works.
            <br/><a href="https://doc.tiki.org/Slideshow"  target="tikihelp" class="tikihelp" title="Slideshow demo:
        	More details:
            <ul>
                <li>All content is in a wiki page, which can be printed to your audience in just a few sheets of paper</li>
                <li>Headers of different levels are used as markers of 'new slide' and used as titles</li>
                <li>Many settings can be predefined as parameters of a call to PluginSlideshow</li>
                <li>Allows slide notes in a separate window for dual monitor setups, slide numbers in footer, timer, style with background images, navigation bar with all slides listed to jump to</li>
            </ul>
        	Click to read more">
                <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
            </a>
            <div style="display:block; margin-left:auto; margin-right:auto; width:202px;">
                <a href="http://tiki.org/display541" class="internal" rel="box" title="Click to expand">
                    <img src="img/profiles/profile_thumb_slideshow_demo.png"  width="250" style="display:block; margin-left:auto; margin-right:auto;border:1px solid darkgray;" alt="Click to expand" class="regImage pluginImg" title="Click to expand" />
                </a>
                <div class="mini" style="width:100px;">
                    <div class="thumbcaption text-center">Click to expand</div>
                </div>
            </div>
            <br/>
        </td>
	</tr>
        <tr>
            <td style="width:48%">
            </td>
            <td style="width:4%">
                &nbsp;
            </td>
            <td style="width:48%">
            </td>
        </tr>
	</table>
</fieldset>
<br>
</div>
<?php }} ?>