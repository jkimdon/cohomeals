<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-26 01:00:20
         compiled from "/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/wizard/profiles_useful_micro_confs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1029718517567de6a4d30140-07869832%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '975faba1b8dfc4196461f73423da039784619561' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/cohomeals/templates/wizard/profiles_useful_micro_confs.tpl',
      1 => 1399363765,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1029718517567de6a4d30140-07869832',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tikiMajorVersion' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567de6a4da49f0_41409026',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567de6a4da49f0_41409026')) {function content_567de6a4da49f0_41409026($_smarty_tpl) {?>

<div class="adminWizardIconleft"><img src="img/icons/large/wizard_profiles48x48.png" alt="Configuration Profiles Wizard" title="Configuration Profiles Wizard" /></div>
Check out this set of potentially useful profiles for your site which involve small amount of changes in your site configuration. </br></br>
<div class="adminWizardContent">
<fieldset>
	<legend>Profiles:</legend>
	<table style="width:100%">
	<tr>
        <td style="width:48%">
            <b>Menu on Wiki page</b> (<a href="tiki-admin.php?profile=Collaborative_Community_Wiki_menupage&show_details_for=Collaborative_Community_Wiki_menupage&categories%5B%5D=<?php echo $_smarty_tpl->tpl_vars['tikiMajorVersion']->value;?>
.x&repository=http%3a%2f%2fprofiles.tiki.org%2fprofiles&page=profiles&preloadlist=y&list=List#step2" target="_blank">apply profile now</a>)
            <br/>
            This profile sets up a side module with a menu based on a wiki page in the right hand-side column.
            <br/><a href="https://doc.tiki.org/Module+menupage" target="tikihelp" class="tikihelp" title="Menu on Wiki page:
            With this profile you can:
            <ul>
                <li>use wiki syntax to edit it</li>
                <li>delegate its edition with wiki page permissions</li>
                <li>use plugins to manage conditional display of sections</li>
        	</ul>
        	Click to read more">
                <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
            </a>
            <div style="display:block; margin-left:auto; margin-right:auto; width:202px;">
                <a href="http://tiki.org/display538" class="internal" rel="box" title="Click to expand">
                    <img src="img/profiles/profile_thumb_menu_on_wiki_page.png"  width="150" style="display:block; margin-left:auto; margin-right:auto;border:1px solid darkgray;" alt="Click to expand" class="regImage pluginImg" title="Click to expand" />
                </a>
                <div class="mini" style="width:100px;">
                    <div class="thumbcaption text-center">Click to expand</div>
                </div>
            </div>
            <br/><br/>
        </td>
        <td style="width:4%">
            &nbsp;
        </td>
        <td style="width:48%">
            <b>Random header images</b>  (<a href="tiki-admin.php?profile=Random_header_images&show_details_for=Random_header_images&categories%5B%5D=<?php echo $_smarty_tpl->tpl_vars['tikiMajorVersion']->value;?>
.x&repository=http%3a%2f%2fprofiles.tiki.org%2fprofiles&page=profiles&preloadlist=y&list=List#step2" target="_blank">apply profile now</a>)
            <br/>
            This profile adds a module in the top zone that displays a random image from a File Gallery.
            <br/><a href="https://doc.tiki.org/PluginImg"  target="tikihelp" class="tikihelp" title="Random header images:
            Some sample images to fit the default configuration are also provided as a starting point:
            <ul>
                <li>default configuration uses images at 800x150px resized by the top module parameters to match the header default size</li>
                <li>a different random image is shown at each page load</li>
                <li>elFinder modern file galery manager (with drag & drop capabilities!) is used by default
                <li>you can tweak the module and file gallery defaults as needed for your needs</li>
        	</ul>
        	Click to read more">
                <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
            </a>
            <div style="display:block; margin-left:auto; margin-right:auto; width:202px;">
                <a href="http://tiki.org/display539" class="internal" rel="box" title="Click to expand">
                    <img src="img/profiles/profile_thumb_random_header_images.png"  width="200" style="display:block; margin-left:auto; margin-right:auto;border:1px solid darkgray;" alt="Click to expand" class="regImage pluginImg" title="Click to expand" />
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
            <b>Multilingual Wiki</b> (<a href="tiki-admin.php?profile=Multilingual_Wiki_12x&show_details_for=Multilingual_Wiki_12x&categories%5B%5D=<?php echo $_smarty_tpl->tpl_vars['tikiMajorVersion']->value;?>
.x&repository=http%3a%2f%2fprofiles.tiki.org%2fprofiles&page=profiles&preloadlist=y&list=List#step2" target="_blank">apply profile now</a>)
            <br/>
            This profile allows Tiki content translation, and sets up modules to change language and to display links to page translations with their percentage of completion.
            <br/><a href="https://doc.tiki.org/Multilingual+Wiki"  target="tikihelp" class="tikihelp" title="Multilingual Wiki:
            The enabled features comprise:
            <ul>
                <li>Multilingual, Translation assistant, Urgent translation notifications</li>
                <li>Multilingual structures, Quantify change size, Multilingual freetags</li>
                <li>Show pages in user's preferred language, Detect browser language</li>
        	</ul>
        	Click to read more">
                <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
            </a>
            <div style="display:block; margin-left:auto; margin-right:auto; width:202px;">
                <a href="http://tiki.org/display516" class="internal" rel="box" title="Click to expand">
                    <img src="img/profiles/profile_thumb_multilingual_wiki.png"  width="200" style="display:block; margin-left:auto; margin-right:auto;border:1px solid darkgray;" alt="Click to expand" class="regImage pluginImg" title="Click to expand" />
                </a>
                <div class="mini" style="width:100px;">
                    <div class="thumbcaption text-center">Click to expand</div>
                </div>
            </div>
            <br/>
        </td>
        <td style="width:4%">
            &nbsp;
        </td>
        <td style="width:48%">
            <b>Countries By Region</b> (<a href="tiki-admin.php?profile=Countries_By_Region&show_details_for=Countries_By_Region&categories%5B%5D=<?php echo $_smarty_tpl->tpl_vars['tikiMajorVersion']->value;?>
.x&repository=http%3a%2f%2fprofiles.tiki.org%2fprofiles&page=profiles&preloadlist=y&list=List#step2" target="_blank">apply profile now</a>)
            This profile will create a set of categories and subcategories in your site with the names of countries grouped by regions.
            <br/><a href="https://profiles.tiki.org/Countries+By+Region"  target="tikihelp" class="tikihelp" title="Countries By Region:
            The regions listed with their countries are:
            <ul>
                <li>Saharan, Sub-Saharan Africa</li>
                <li>Middle East, North Africa</li>
                <li>Asia</li>
                <li>Europe</li>
                <li>North, Central America</li>
                <li>Oceania</li>
                <li>South America</li>
            </ul>
        	Click to read more">
                <img src="img/icons/help.png" alt="" width="16" height="16" class="icon" />
            </a>
            <div style="display:block; margin-left:auto; margin-right:auto; width:202px;">
                <a href="http://tiki.org/display540" class="internal" rel="box" title="Click to expand">
                    <img src="img/profiles/profile_thumb_countries_by_region.png"  width="200" style="display:block; margin-left:auto; margin-right:auto;border:1px solid darkgray;" alt="Click to expand" class="regImage pluginImg" title="Click to expand" />
                </a>
                <div class="mini" style="width:100px;">
                    <div class="thumbcaption text-center">Click to expand</div>
                </div>
            </div>
            <br/>
        </td>
	</tr>
	</table>
</fieldset>
<br>
</div>
<?php }} ?>