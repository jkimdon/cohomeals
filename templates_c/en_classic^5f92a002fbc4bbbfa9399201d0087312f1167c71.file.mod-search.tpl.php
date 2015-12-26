<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:24
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/modules/mod-search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1637653625567b58c0ed7799-36942477%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f92a002fbc4bbbfa9399201d0087312f1167c71' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/modules/mod-search.tpl',
      1 => 1386170127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1637653625567b58c0ed7799-36942477',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tiki_p_search' => 0,
    'module_error' => 0,
    'smod_params' => 0,
    'search_mod_usage_counter' => 0,
    'prefs' => 0,
    't' => 0,
    'tiki_p_edit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58c12d6713_00581462',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c12d6713_00581462')) {function content_567b58c12d6713_00581462($_smarty_tpl) {?><?php if (!is_callable('smarty_block_compact')) include 'lib/smarty_tiki/block.compact.php';
if (!is_callable('smarty_block_tikimodule')) include 'lib/smarty_tiki/block.tikimodule.php';
if (!is_callable('smarty_block_add_help')) include 'lib/smarty_tiki/block.add_help.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
if (!is_callable('smarty_function_autocomplete')) include 'lib/smarty_tiki/function.autocomplete.php';
?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('compact', array()); $_block_repeat=true; echo smarty_block_compact(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['tiki_p_search']->value=='y'){?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('tikimodule', array('error'=>$_smarty_tpl->tpl_vars['module_error']->value,'title'=>$_smarty_tpl->tpl_vars['smod_params']->value['title'],'name'=>"search",'flip'=>$_smarty_tpl->tpl_vars['smod_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['smod_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['smod_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['smod_params']->value['notitle'])); $_block_repeat=true; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_error']->value,'title'=>$_smarty_tpl->tpl_vars['smod_params']->value['title'],'name'=>"search",'flip'=>$_smarty_tpl->tpl_vars['smod_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['smod_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['smod_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['smod_params']->value['notitle']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['tiki_search']!='none'){?>
    <form id="search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
" method="get" action="<?php echo $_smarty_tpl->tpl_vars['smod_params']->value['search_action'];?>
"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['use_autocomplete']=='y'){?> onsubmit="return submitSearch<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
()"<?php }?>>
    	<div>
			<input id="search_mod_input_<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
" name="<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>filter~content<?php }else{ ?>find<?php }?>" <?php if (!empty($_smarty_tpl->tpl_vars['smod_params']->value['input_size'])){?>size="<?php echo $_smarty_tpl->tpl_vars['smod_params']->value['input_size'];?>
" style="width: auto"<?php }?> type="text" accesskey="s" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['smod_params']->value['input_value'], ENT_QUOTES, 'UTF-8', true);?>
" />
			
		 	<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['show_object_filter']=='y'){?>
				in:
			 	<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>
					<select name="filter~type" style="width:<?php echo $_smarty_tpl->tpl_vars['smod_params']->value['select_size'];?>
em;">
						<option value="">Entire Site</option>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki']=='y'){?><option value="wiki page"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="wiki page"){?> selected="selected"<?php }?>>Wiki Pages</option><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_blogs']=='y'){?><option value="blog post"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="blog post"){?> selected="selected"<?php }?>>Blog Posts</option><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_articles']=='y'){?><option value="article"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="article"){?> selected="selected"<?php }?>>Articles</option><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_file_galleries']=='y'){?><option value="file"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="file"){?> selected="selected"<?php }?>>Files</option><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_forums']=='y'){?><option value="forum post"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="forum post"){?> selected="selected"<?php }?>>Forums</option><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_trackers']=='y'){?><option value="trackeritem"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="trackeritem"){?> selected="selected"<?php }?>>Trackers</option><?php }?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_sheet']=='y'){?><option value="sheet"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="sheet"){?> selected="selected"<?php }?>>Spreadsheets</option><?php }?>
					 </select>
				<?php }else{ ?>
					 <select name="where" style="width:<?php echo $_smarty_tpl->tpl_vars['smod_params']->value['select_size'];?>
em;">
						 <option value="pages">Entire Site</option>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki']=='y'){?><option value="wikis"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="wikis"){?> selected="selected"<?php }?>>Wiki Pages</option><?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_directory']=='y'){?><option value="directory"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="directory"){?> selected="selected"<?php }?>>Directory</option><?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_galleries']=='y'){?>
							 <option value="galleries"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="galleries"){?> selected="selected"<?php }?>>Image Gals</option>
							 <option value="images"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="images"){?> selected="selected"<?php }?>>Images</option>
						 <?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_file_galleries']=='y'){?><option value="files"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="files"){?> selected="selected"<?php }?>>Files</option><?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_articles']=='y'){?><option value="articles"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="articles"){?> selected="selected"<?php }?>>Articles</option><?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_forums']=='y'){?><option value="forums"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="forums"){?> selected="selected"<?php }?>>Forums</option><?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_blogs']=='y'){?>
							  <option value="blogs"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="blogs"){?> selected="selected"<?php }?>>Blogs</option>
							  <option value="posts"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="posts"){?> selected="selected"<?php }?>>Blog Posts</option>
						 <?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_faqs']=='y'){?><option value="faqs"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="faqs"){?> selected="selected"<?php }?>>FAQs</option><?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_trackers']=='y'){?><option value="trackers"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['where']=="trackers"){?> selected="selected"<?php }?>>Trackers</option><?php }?>
					  </select>
				<?php }?>
			<?php }elseif(!empty($_smarty_tpl->tpl_vars['prefs']->value['search_default_where'])){?>
				 <?php if (is_array($_smarty_tpl->tpl_vars['prefs']->value['search_default_where'])){?>
					<?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['prefs']->value['search_default_where']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value){
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
						<input type="hidden" name="<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>filter~type[]<?php }else{ ?>where[]<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['t']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
					<?php } ?>
				<?php }else{ ?>
					<input type="hidden" name="<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>filter~type<?php }else{ ?>where<?php }?>" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['prefs']->value['search_default_where'], ENT_QUOTES, 'UTF-8', true);?>
" />
				<?php }?>
		    <?php }?>
		    
			<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['tiki_search']!='y'){?>
				<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['advanced_search_option']=='y'){?>
					<label for="boolean">Advanced:<input type="checkbox" name="boolean" id="boolean"<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['advanced_search']=="y"){?> checked="checked"<?php }?> /></label>
				<?php }else{ ?>
					<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['advanced_search']=="y"){?><input type="hidden" name="boolean" value="on" /><?php }?>
				<?php }?>
				<input type="hidden" name="boolean_last" value="<?php echo $_smarty_tpl->tpl_vars['smod_params']->value['advanced_search'];?>
" />
				<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['advanced_search_help']=='y'){?>
					<?php $_smarty_tpl->_capture_stack[0][] = array('advanced_search_help', null, null); ob_start(); ?>
						<?php echo $_smarty_tpl->getSubTemplate ('advanced_search_help.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

					<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('add_help', array('show'=>'y','title'=>"Search Help",'id'=>"advanced_search_help")); $_block_repeat=true; echo smarty_block_add_help(array('show'=>'y','title'=>"Search Help",'id'=>"advanced_search_help"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

						<?php echo Smarty::$_smarty_vars['capture']['advanced_search_help'];?>

					<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_add_help(array('show'=>'y','title'=>"Search Help",'id'=>"advanced_search_help"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<?php }?>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['compact']=="y"){?>
				<?php echo smarty_function_icon(array('_id'=>"magnifier",'class'=>"search_mod_magnifier icon"),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']!="y"){?><div class="search_mod_buttons box" style="display:none; position: absolute; right: 0; padding: 0 1em; z-index: 2; white-space: nowrap;"><?php }?> 
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['show_search_button']=='y'){?>
					<input type = "submit" class = "wikiaction tips<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['default_button']=='search'){?> button_default<?php }?>"
						   name = "search" value = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['smod_params']->value['search_submit'], ENT_QUOTES, 'UTF-8', true);?>
"
							title="Search|Search for text throughout the site."
							onclick = "$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
').attr('action', '<?php echo strtr($_smarty_tpl->tpl_vars['smod_params']->value['search_action'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
').attr('page_selected','');" />
				<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['show_go_button']=='y'){?>
					<input type = "submit" class = "wikiaction tips<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['default_button']=='go'){?> button_default<?php }?>"
						   name = "go" value = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['smod_params']->value['go_submit'], ENT_QUOTES, 'UTF-8', true);?>
"
							title="Search|Go directly to a page, or search in page titles if exact match is not found."
							onclick = "$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
').attr('action', '<?php echo strtr($_smarty_tpl->tpl_vars['smod_params']->value['go_action'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
').attr('page_selected','');
										<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>
											$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
 input[name=\'filter~content\']').attr('name', 'find');
										<?php }?>" />
					<input type="hidden" name="exact_match" value="" />
				<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['show_edit_button']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'){?>
					<input type = "submit" class = "wikiaction tips<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['default_button']=='edit'){?> button_default<?php }?>"
						   name = "edit" value = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['smod_params']->value['edit_submit'], ENT_QUOTES, 'UTF-8', true);?>
"
							title="Search|Edit existing page or create a new one."
							onclick = "$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
 input[name!=<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>\'filter~content\'<?php }else{ ?>\'find\'<?php }?>]').attr('name', '');
										$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
 input[name=<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['search_action']=='tiki-searchindex.php'){?>\'filter~content\'<?php }else{ ?>\'find\'<?php }?>]').attr('name', 'page');
										$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
').attr('action', '<?php echo strtr($_smarty_tpl->tpl_vars['smod_params']->value['edit_action'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
').attr('page_selected','');" />
				<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['compact']=="y"){?>
				<?php if ($_smarty_tpl->tpl_vars['prefs']->value['mobile_mode']!="y"){?></div> 
				<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
$(".search_mod_magnifier").mouseover( function () {
					$(".search_mod_buttons", $(this).parent())
						.show('fast')
						.mouseleave( function () {
							$(this).hide('fast');
						});
				}).click( function () {
					$(this).parents("form").submit();
				});
				$("#search_mod_input_<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
")
					.keydown( function () { $(".search_mod_magnifier", $(this).parent()).mouseover();} );<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<?php }?> 
			<?php }?>
	    </div>
    </form>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array('notonready'=>true)); $_block_repeat=true; echo smarty_block_jq(array('notonready'=>true), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

function submitSearch<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
() {
	var $f = $('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
');
	if ($f.attr('action') !== "tiki-editpage.php" && $f.data('page_selected') === $("#search_mod_input_<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
").val()) {
		if ($f.find('input[name="find"]').length) {
		    $f.find('input[name="find"]').val($f.data('page_selected'));
		} else {
		    $f.append($('<input name="find">').val($f.data('page_selected')));
		}
		$f.attr('action', '<?php echo strtr($_smarty_tpl->tpl_vars['smod_params']->value['go_action'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
	} else if ($f.attr('action') == "#") {
		$f.attr('action', '<?php echo strtr($_smarty_tpl->tpl_vars['smod_params']->value['search_action'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
	}
	$exact = $f.find("input[name=exact_match]");
	if ($exact.val() != "On") {
		$exact.remove();		// seems exact_match is true even if empty
	}
	return true;
}
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array('notonready'=>true), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php if ($_smarty_tpl->tpl_vars['smod_params']->value['use_autocomplete']=='y'){?>
		<?php $_smarty_tpl->_capture_stack[0][] = array("selectFn", null, null); ob_start(); ?>select: function(event, item) {
	$('#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
').data('page_selected', item.item.value).find("input[name=exact_match]").val("On");
}, open: function(event, item) {
	$(".search_mod_buttons", "#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
").hide();
}, close: function(event, item) {
	$(".search_mod_buttons", "#search-module-form<?php echo $_smarty_tpl->tpl_vars['search_mod_usage_counter']->value;?>
").show();
}<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
		<?php echo smarty_function_autocomplete(array('element'=>("#search_mod_input_").($_smarty_tpl->tpl_vars['search_mod_usage_counter']->value),'type'=>"pagename",'options'=>Smarty::$_smarty_vars['capture']['selectFn']),$_smarty_tpl);?>

	<?php }?>
<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_error']->value,'title'=>$_smarty_tpl->tpl_vars['smod_params']->value['title'],'name'=>"search",'flip'=>$_smarty_tpl->tpl_vars['smod_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['smod_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['smod_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['smod_params']->value['notitle']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_compact(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>