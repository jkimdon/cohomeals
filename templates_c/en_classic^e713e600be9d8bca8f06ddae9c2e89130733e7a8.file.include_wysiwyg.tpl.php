<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:41:55
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/admin/include_wysiwyg.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1843014628567b5b73e2e644-55956582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e713e600be9d8bca8f06ddae9c2e89130733e7a8' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/admin/include_wysiwyg.tpl',
      1 => 1431448690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1843014628567b5b73e2e644-55956582',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ticket' => 0,
    'prefs' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5b73ee8051_14923737',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5b73ee8051_14923737')) {function content_567b5b73ee8051_14923737($_smarty_tpl) {?><?php if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_function_preference')) include 'lib/smarty_tiki/function.preference.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"tip",'title'=>"Tip")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Tip"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
WYSIWYG means What You See Is What You Get, and is handled in Tiki by <a href="http://ckeditor.com/">CKEditor</a>.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Tip"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<div class="navbar">
<?php echo smarty_function_button(array('href'=>"tiki-admin_toolbars.php",'_text'=>"Toolbars"),$_smarty_tpl);?>

</div>

<form action="tiki-admin.php?page=wysiwyg" method="post">
	<input type="hidden" name="ticket" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value, ENT_QUOTES, 'UTF-8', true);?>
">
	<div class="heading input_submit_container" style="text-align: right">
		<input type="submit" class="btn btn-default" name="wysiwygfeatures" value="Change preferences" />
	</div>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wysiwyg_htmltowiki']!='y'){?>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"warning",'title'=>"Page links")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Page links"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Note that if the SEFURL feature is on, page links created using wysiwyg might not be automatically updated when pages are renamed. This is addressed through the "Use Wiki syntax in WYSIWYG" feature.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Page links"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>

	<fieldset class="admin">
		<legend>Activate the feature</legend>
		<?php echo smarty_function_preference(array('name'=>'feature_wysiwyg','visible'=>"always"),$_smarty_tpl);?>

		<?php echo smarty_function_preference(array('name'=>'wikiplugin_wysiwyg'),$_smarty_tpl);?>

	</fieldset>

	<fieldset class="admin">
		<legend><?php echo smarty_function_icon(array('_id'=>"text_dropcaps"),$_smarty_tpl);?>
 Wysiwyg Editor Features</legend>
		<?php echo smarty_function_preference(array('name'=>'wysiwyg_optional'),$_smarty_tpl);?>

		<div class="adminoptionboxchild" id="wysiwyg_optional_childcontainer">
			<?php echo smarty_function_preference(array('name'=>'wysiwyg_default'),$_smarty_tpl);?>

			<?php echo smarty_function_preference(array('name'=>'wysiwyg_memo'),$_smarty_tpl);?>

		</div>

		<?php echo smarty_function_preference(array('name'=>'wysiwyg_wiki_parsed'),$_smarty_tpl);?>

		<div class="adminoptionboxchild" id="wysiwyg_wiki_parsed_childcontainer">
			<?php echo smarty_function_preference(array('name'=>'wysiwyg_wiki_semi_parsed'),$_smarty_tpl);?>

		</div>
		<?php echo smarty_function_preference(array('name'=>'wysiwyg_htmltowiki'),$_smarty_tpl);?>

		<?php echo smarty_function_preference(array('name'=>'wysiwyg_inline_editing'),$_smarty_tpl);?>

		<?php echo smarty_function_preference(array('name'=>'wysiwyg_toolbar_skin'),$_smarty_tpl);?>

		<?php echo smarty_function_preference(array('name'=>"wysiwyg_fonts"),$_smarty_tpl);?>

		<?php echo smarty_function_preference(array('name'=>"wysiwyg_extra_plugins"),$_smarty_tpl);?>


	</fieldset>
	<fieldset>
		<legend class="heading"><?php echo smarty_function_icon(array('_id'=>"bricks"),$_smarty_tpl);?>
 <span>Related features</span></legend>
		
		<?php echo smarty_function_preference(array('name'=>'feature_wiki_paragraph_formatting'),$_smarty_tpl);?>

		<div class="adminoptionboxchild" id="feature_wiki_paragraph_formatting_childcontainer">
			<?php echo smarty_function_preference(array('name'=>'feature_wiki_paragraph_formatting_add_br'),$_smarty_tpl);?>

		</div>
		
		<p class="description">
			<?php echo smarty_function_preference(array('name'=>'feature_ajax'),$_smarty_tpl);?>

			<div class="adminoptionboxchild" id="feature_ajax_childcontainer">
			<?php echo smarty_function_preference(array('name'=>'ajax_autosave'),$_smarty_tpl);?>

			</div>
	</fieldset>

	<div class="heading input_submit_container" style="text-align: center">
		<input type="submit" class="btn btn-default" name="wysiwygfeatures" value="Change preferences" />
	</div>
</form>

<?php }} ?>