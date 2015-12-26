<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:37:03
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:233982576567b5a4f328860-86099332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '707b661ad1b02d5f565bc8db92034a5dca8c4890' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-admin.tpl',
      1 => 1431448690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '233982576567b5a4f328860-86099332',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'admintitle' => 0,
    'prefs' => 0,
    'pref_filters' => 0,
    'info' => 0,
    'name' => 0,
    'connect_feedback_showing' => 0,
    'headerlib' => 0,
    'lm_criteria' => 0,
    'indexNeedsRebuilding' => 0,
    'csrferror' => 0,
    'lm_error' => 0,
    'lm_searchresults' => 0,
    'prefName' => 0,
    'ticket' => 0,
    'db_requires_update' => 0,
    'tikidomain' => 0,
    'adminpage' => 0,
    'include' => 0,
    'upgrade_messages' => 0,
    'title' => 0,
    'um' => 0,
    'tikifeedback' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5a4f5ef336_97009616',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5a4f5ef336_97009616')) {function content_567b5a4f5ef336_97009616($_smarty_tpl) {?><?php if (!is_callable('smarty_block_title')) include 'lib/smarty_tiki/block.title.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
if (!is_callable('smarty_function_preference')) include 'lib/smarty_tiki/function.preference.php';
if (!is_callable('smarty_modifier_replace')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/modifier.replace.php';
if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_modifier_stringfix')) include 'lib/smarty_tiki/modifier.stringfix.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('title', array('help'=>((string)$_smarty_tpl->tpl_vars['helpUrl']->value))); $_block_repeat=true; echo smarty_block_title(array('help'=>((string)$_smarty_tpl->tpl_vars['helpUrl']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['admintitle']->value;?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_title(array('help'=>((string)$_smarty_tpl->tpl_vars['helpUrl']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if ($_smarty_tpl->tpl_vars['prefs']->value['sender_email']==''){?>
	<div class="alert alert-info">
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>"tiki-admin.php?page=general&highlight=sender_email")); $_block_repeat=true; echo smarty_block_tr(array('_0'=>"tiki-admin.php?page=general&highlight=sender_email"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Your sender email is not set. You can set it <a href="%0" class="alert-link">here</a><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>"tiki-admin.php?page=general&highlight=sender_email"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	</div>
<?php }?>


<?php if (!$_GET['page']){?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"note",'title'=>"Note")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Note"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div style="float:left">&nbsp;&nbsp;<a href="tiki-wizard_admin.php?&stepNr=0&url=tiki-admin.php"><img src="img/icons/wizard22x22.png"></a></div>&nbsp;&nbsp;<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>"tiki-wizard_admin.php?&stepNr=0&url=tiki-admin.php")); $_block_repeat=true; echo smarty_block_tr(array('_0'=>"tiki-wizard_admin.php?&stepNr=0&url=tiki-admin.php"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Use the <a href="%0" class="rbox-link" >Configuration Wizards</a> to more easily set up your site.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>"tiki-wizard_admin.php?&stepNr=0&url=tiki-admin.php"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Note"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

<form method="post" action="">
	<fieldset>
		<legend>Preference Filters</legend>
		<?php  $_smarty_tpl->tpl_vars['info'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['info']->_loop = false;
 $_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['pref_filters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['info']->key => $_smarty_tpl->tpl_vars['info']->value){
$_smarty_tpl->tpl_vars['info']->_loop = true;
 $_smarty_tpl->tpl_vars['name']->value = $_smarty_tpl->tpl_vars['info']->key;
?>
			<label>
				<input type="checkbox" class="preffilter <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['type'], ENT_QUOTES, 'UTF-8', true);?>
" name="pref_filters[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['info']->value['selected']){?>checked="checked"<?php }?>>
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['info']->value['label'], ENT_QUOTES, 'UTF-8', true);?>

			</label>
		<?php } ?>

		<input type="submit" value="Set as my default" class="btn btn-primary btn-xs">

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['connect_feature']=="y"){?>
			<label>
				<input type="checkbox" id="connect_feedback_cbx" <?php if (!empty($_smarty_tpl->tpl_vars['connect_feedback_showing']->value)){?>checked="checked"<?php }?>>
                    Provide Feedback
                    <a href="http://doc.tiki.org/Connect" target="tikihelp" class="tikihelp" title="Provide Feedback:
                        Once selected, some icon/s will be shown next to all features so that you can provide some on-site feedback about them.
                        <br/><br/>
                        <ul>
                            <li>Icon for 'Like' <img src=img/icons/connect_like.png></li>
<!--						<li>Icon for 'Fix me' <img src=img/icons/connect_fix.png></li> -->
<!--						<li>Icon for 'What is this for?' <img src=img/icons/connect_wtf.png></li> -->
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

		<?php }?>
	</fieldset>
</form>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	var updateVisible = function() {
		var show = function (selector) {
			selector.show();
			selector.parents('fieldset:not(.tabcontent)').show();
			selector.closest('fieldset.tabcontent').addClass('filled');
		};
		var hide = function (selector) {
			selector.hide();
			/*selector.parents('fieldset:not(.tabcontent)').hide();*/
		};

		var filters = [];
		var prefs = $('.adminoptionbox.preference, .admbox').hide();
		prefs.parents('fieldset:not(.tabcontent)').hide();
		prefs.closest('fieldset.tabcontent').removeClass('filled');
		$('.preffilter').each(function () {
			var targets = $('.adminoptionbox.preference.' + $(this).val() + ',.admbox.' + $(this).val());
			if ($(this).is(':checked')) {
				filters.push($(this).val());
				show(targets);
			} else if ($(this).is('.negative:not(:checked)')) {
				hide(targets);
			}
		});

		show($('.adminoptionbox.preference.modified'))

		$('input[name="filters"]').val(filters.join(' '));
		$('.tabset .tabmark a').each(function () {
			var selector = 'fieldset.tabcontent.' + $(this).attr('href').substring(1);
			var content = $(this).closest('.tabset').find(selector);

			$(this).parent().toggle(content.is('.filled') || content.find('.preference').length === 0);
		});
	};

	updateVisible();
	$('.preffilter').change(updateVisible);
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if (!isset($_GET['page'])||$_GET['page']!='profiles'){?> 
<form method="post" action="">
	
	<p>
		<label>Configuration search: <input type="text" name="lm_criteria" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['lm_criteria']->value, ENT_QUOTES, 'UTF-8', true);?>
"></label>
		<input type="submit" value="Search" <?php if ($_smarty_tpl->tpl_vars['indexNeedsRebuilding']->value){?> class="tips" title="Configuration search|Note: The search index needs rebuilding, this will take a few minutes."<?php }?> />
		<input type="hidden" name="filters">
	</p>
</form>
<?php if (isset($_smarty_tpl->tpl_vars['csrferror']->value)){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"error",'title'=>"Potential Cross-Site Request Forgery")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"error",'title'=>"Potential Cross-Site Request Forgery"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<?php echo $_smarty_tpl->tpl_vars['csrferror']->value;?>

	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"error",'title'=>"Potential Cross-Site Request Forgery"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['lm_error']->value){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"warning",'title'=>"Search error")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Search error"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['lm_error']->value;?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Search error"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }elseif($_smarty_tpl->tpl_vars['lm_searchresults']->value){?>
<fieldset>
<legend>Preferences Search Results</legend>
	<form method="post" action="">
		<div class="pref_search_results box">
			<?php  $_smarty_tpl->tpl_vars['prefName'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['prefName']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['lm_searchresults']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['prefName']->key => $_smarty_tpl->tpl_vars['prefName']->value){
$_smarty_tpl->tpl_vars['prefName']->_loop = true;
?>
				<?php echo smarty_function_preference(array('name'=>$_smarty_tpl->tpl_vars['prefName']->value,'get_pages'=>"y"),$_smarty_tpl);?>

			<?php } ?>
		</div>
		<input type="submit" value="Change" class="clear">
		<input type="hidden" name="lm_criteria" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['lm_criteria']->value, ENT_QUOTES, 'UTF-8', true);?>
">
		<input type="hidden" name="daconfirm" value="y">
		<input type="hidden" name="ticket" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	</form>
</fieldset>
<?php }elseif($_smarty_tpl->tpl_vars['lm_criteria']->value){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"note",'title'=>"No results",'icon'=>"magnifier")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"No results",'icon'=>"magnifier"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
No preferences were found for your search query with your current choice of Preference Filters.<?php if ($_smarty_tpl->tpl_vars['prefs']->value['unified_engine']=='lucene'){?> Not what you expected? Try <a class="rbox-link" href="tiki-admin.php?prefrebuild">rebuild</a> the preferences search index.<?php }?><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"No results",'icon'=>"magnifier"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>
<?php }?>

<div id="pageheader">


<?php if ($_smarty_tpl->tpl_vars['db_requires_update']->value){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"errors",'title'=>"Database Version Problem")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"errors",'title'=>"Database Version Problem"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	Your database requires an update to match the the Tiki version; use <a href="tiki-install.php">the installer</a>. Using Tiki with an incorrect database version will cause errors.
	If you have shell (SSH) access, you can also use the following, on the command line, from the root of your Tiki installation:
	<kbd>php console.php<?php if (!empty($_smarty_tpl->tpl_vars['tikidomain']->value)){?> --site=<?php echo smarty_modifier_replace($_smarty_tpl->tpl_vars['tikidomain']->value,'/','');?>
<?php }?> database:update</kbd>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"errors",'title'=>"Database Version Problem"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

</div>

<?php if (in_array($_smarty_tpl->tpl_vars['adminpage']->value,array("features","general","login","wiki","gal","fgal","articles","polls","search","blogs","forums","faqs","trackers","webmail","comments","rss","directory","userfiles","maps","metatags","performance","security","wikiatt","score","community","messages","calendar","intertiki","video","freetags","i18n","wysiwyg","copyright","category","module","look","textarea","ads","profiles","semantic","plugins","webservices",'sefurl','connect','metrics','payment','rating','socialnetworks','share',"workspace"))){?>
  <?php $_smarty_tpl->tpl_vars["include"] = new Smarty_variable($_GET['page'], null, 0);?>
<?php }else{ ?>
  <?php $_smarty_tpl->tpl_vars["include"] = new Smarty_variable("list_sections", null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['include']->value!="list_sections"){?>
  <div class="simplebox adminanchors clearfix" ><?php echo $_smarty_tpl->getSubTemplate ('admin/include_anchors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div>
<?php }?>

<?php if (count($_smarty_tpl->tpl_vars['upgrade_messages']->value)){?>
	<?php if (count($_smarty_tpl->tpl_vars['upgrade_messages']->value)==1){?>
		<?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("Upgrade Available", null, 0);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable("Upgrades Available", null, 0);?>
	<?php }?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"note",'title'=>$_smarty_tpl->tpl_vars['title']->value,'icon'=>"announce")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"note",'title'=>$_smarty_tpl->tpl_vars['title']->value,'icon'=>"announce"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<?php  $_smarty_tpl->tpl_vars['um'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['um']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['upgrade_messages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['um']->key => $_smarty_tpl->tpl_vars['um']->value){
$_smarty_tpl->tpl_vars['um']->_loop = true;
?>
			<p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['um']->value, ENT_QUOTES, 'UTF-8', true);?>
</p>
		<?php } ?>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"note",'title'=>$_smarty_tpl->tpl_vars['title']->value,'icon'=>"announce"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['tikifeedback']->value){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"note",'title'=>"Note")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Note"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<?php echo smarty_function_cycle(array('values'=>"odd,even",'print'=>false),$_smarty_tpl);?>

		The following list of changes has been applied:
		<ul>
		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['n'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['n']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['name'] = 'n';
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['tikifeedback']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['n']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['n']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['n']['total']);
?>
			<li class="<?php echo smarty_function_cycle(array(),$_smarty_tpl);?>
">
				<p>
			<?php if ($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['st']==0){?>
				<?php echo smarty_function_icon(array('_id'=>'delete','alt'=>"Disabled",'style'=>"vertical-align: middle"),$_smarty_tpl);?>

			<?php }elseif($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['st']==1){?>
				<?php echo smarty_function_icon(array('_id'=>'accept','alt'=>"Enabled",'style'=>"vertical-align: middle"),$_smarty_tpl);?>

			<?php }elseif($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['st']==2){?>
				<?php echo smarty_function_icon(array('_id'=>'accept','alt'=>"Changed",'style'=>"vertical-align: middle"),$_smarty_tpl);?>

			<?php }elseif($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['st']==4){?>
				<?php echo smarty_function_icon(array('_id'=>'arrow_undo','alt'=>"Reset",'style'=>"vertical-align: middle"),$_smarty_tpl);?>

			<?php }else{ ?>
				<?php echo smarty_function_icon(array('_id'=>'information','alt'=>"Information",'style'=>"vertical-align: middle"),$_smarty_tpl);?>

			<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['st']!=3){?>Preference <?php }?><strong><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smarty_modifier_stringfix($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['mes']);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</strong><br>
					<?php if ($_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['st']!=3){?>(<em>Preference name:</em> <?php echo $_smarty_tpl->tpl_vars['tikifeedback']->value[$_smarty_tpl->getVariable('smarty')->value['section']['n']['index']]['name'];?>
)<?php }?>
				</p>
			</li>
		<?php endfor; endif; ?>
		</ul>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Note"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ("admin/include_".((string)$_smarty_tpl->tpl_vars['include']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


<br style="clear:both" />
<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"tip",'title'=>"Crosslinks to other features and settings")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Crosslinks to other features and settings"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


	Administration features:<br>
	
	<a href="tiki-adminusers.php">Users</a> 
	<a href="tiki-admingroups.php">Groups</a> 
	<a href="tiki-admin_security.php">Security</a> 
	<a href="tiki-admin_system.php">TikiCache/System</a> 
	<a href="tiki-syslog.php">SysLogs</a> 
	<a href="tiki-mods.php">Mods</a>
	<hr>

	Transversal features (which apply to more than one section):<br>
	<a href="tiki-admin_notifications.php">Mail Notifications</a> 
	<hr>

	Navigation features:<br>
	<a href="tiki-admin_menus.php">Menus</a> 
	<a href="tiki-admin_modules.php">Modules</a>
	<hr>

	Text area features (features you can use in all text areas, like wiki pages, blogs, articles, forums, etc):<br>
	<a href="tiki-admin_cookies.php">Cookies</a> 
	<a href="tiki-list_cache.php">External Pages Cache</a> 
	<a href="tiki-admin_toolbars.php">Toolbars</a> 
	<a href="tiki-admin_dsn.php">DSN</a> 
	<a href="tiki-admin_external_wikis.php">External Wikis</a> 
	<hr>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Crosslinks to other features and settings"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>