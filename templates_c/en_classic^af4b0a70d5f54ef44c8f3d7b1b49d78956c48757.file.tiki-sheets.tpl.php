<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:40:59
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-sheets.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1235483318567b5b3b52e4f6-47828296%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'af4b0a70d5f54ef44c8f3d7b1b49d78956c48757' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-sheets.tpl',
      1 => 1379428743,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1235483318567b5b3b52e4f6-47828296',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tiki_p_edit_sheet' => 0,
    'sheets' => 0,
    'find' => 0,
    'sheet' => 0,
    'childSheet' => 0,
    'cant_pages' => 0,
    'prefs' => 0,
    'offset' => 0,
    'sheetId' => 0,
    'title' => 0,
    'individual' => 0,
    'name' => 0,
    'description' => 0,
    'className' => 0,
    'headerRow' => 0,
    'footerRow' => 0,
    'parseValues' => 0,
    'tiki_p_admin_sheet' => 0,
    'creator' => 0,
    'parentSheetId' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5b3b6d9c44_35160424',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5b3b6d9c44_35160424')) {function content_567b5b3b6d9c44_35160424($_smarty_tpl) {?><?php if (!is_callable('smarty_block_title')) include 'lib/smarty_tiki/block.title.php';
if (!is_callable('smarty_block_tabset')) include 'lib/smarty_tiki/block.tabset.php';
if (!is_callable('smarty_block_tab')) include 'lib/smarty_tiki/block.tab.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
if (!is_callable('smarty_function_norecords')) include 'lib/smarty_tiki/function.norecords.php';
if (!is_callable('smarty_block_pagination_links')) include 'lib/smarty_tiki/block.pagination_links.php';
if (!is_callable('smarty_function_user_selector')) include 'lib/smarty_tiki/function.user_selector.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('title', array('help'=>"Spreadsheet")); $_block_repeat=true; echo smarty_block_title(array('help'=>"Spreadsheet"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Spreadsheets<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_title(array('help'=>"Spreadsheet"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('tabset', array()); $_block_repeat=true; echo smarty_block_tabset(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>"List")); $_block_repeat=true; echo smarty_block_tab(array('name'=>"List"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php if ($_smarty_tpl->tpl_vars['tiki_p_edit_sheet']->value=='y'){?>
	<div class="navbar">
		<?php echo smarty_function_button(array('href'=>"tiki-sheets.php?edit_mode=1&amp;sheetId=0",'_text'=>"Create New Sheet"),$_smarty_tpl);?>

	</div>
<?php }?>
<h2>Spreadsheet</h2>
<?php if ($_smarty_tpl->tpl_vars['sheets']->value||$_smarty_tpl->tpl_vars['find']->value!=''){?>
  <?php echo $_smarty_tpl->getSubTemplate ('find.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<table class="table normal">
	<tr>
		<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'title')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'title'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Title<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'title'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
		<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'description')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'description'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Description<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'description'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
		<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'created')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'created'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Created<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'created'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
		<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'lastModif')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'lastModif'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last Modif<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'lastModif'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
		<th><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_sort_arg'=>'sort_mode','_sort_field'=>'user')); $_block_repeat=true; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'user'), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
User<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_sort_arg'=>'sort_mode','_sort_field'=>'user'), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</th>
		<th>Actions</th>
	</tr>
	<?php echo smarty_function_cycle(array('values'=>"odd,even",'print'=>false),$_smarty_tpl);?>

	<?php  $_smarty_tpl->tpl_vars['sheet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sheet']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sheets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sheet']->key => $_smarty_tpl->tpl_vars['sheet']->value){
$_smarty_tpl->tpl_vars['sheet']->_loop = true;
?>
		<?php echo $_smarty_tpl->getSubTemplate ('tiki-sheets_listing.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>'base','sheet'=>$_smarty_tpl->tpl_vars['sheet']->value), 0);?>

		<?php  $_smarty_tpl->tpl_vars['childSheet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['childSheet']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sheet']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['childSheet']->key => $_smarty_tpl->tpl_vars['childSheet']->value){
$_smarty_tpl->tpl_vars['childSheet']->_loop = true;
?>
			<?php echo $_smarty_tpl->getSubTemplate ('tiki-sheets_listing.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('name'=>'child','sheet'=>$_smarty_tpl->tpl_vars['childSheet']->value), 0);?>

		<?php } ?>
	<?php }
if (!$_smarty_tpl->tpl_vars['sheet']->_loop) {
?>
		<?php echo smarty_function_norecords(array('_colspan'=>6),$_smarty_tpl);?>

	<?php } ?>
</table>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('pagination_links', array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['prefs']->value['maxRecords'],'offset'=>$_smarty_tpl->tpl_vars['offset']->value)); $_block_repeat=true; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['prefs']->value['maxRecords'],'offset'=>$_smarty_tpl->tpl_vars['offset']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant_pages']->value,'step'=>$_smarty_tpl->tpl_vars['prefs']->value['maxRecords'],'offset'=>$_smarty_tpl->tpl_vars['offset']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>"List"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if ($_smarty_tpl->tpl_vars['tiki_p_edit_sheet']->value=='y'){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('title', null, null); ob_start(); ?><?php if ($_smarty_tpl->tpl_vars['sheetId']->value==0){?>Create<?php }else{ ?>Configure<?php }?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>Smarty::$_smarty_vars['capture']['title'])); $_block_repeat=true; echo smarty_block_tab(array('name'=>Smarty::$_smarty_vars['capture']['title']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

		<?php if ($_smarty_tpl->tpl_vars['sheetId']->value==0){?>
			<h2>Create a sheet</h2>
		<?php }else{ ?>
			<h2>Configure this sheet: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8', true);?>
</h2>
		<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['individual']->value=='y'){?>
			<a class="gallink" href="tiki-objectpermissions.php?objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['name']->value);?>
&amp;objectType=sheet&amp;permType=sheet&amp;objectId=<?php echo $_smarty_tpl->tpl_vars['sheetId']->value;?>
">
				There are individual permissions set for this sheet
			</a>
		<?php }?>
		<form action="tiki-sheets.php" method="post">
			<input type="hidden" name="sheetId" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sheetId']->value, ENT_QUOTES, 'UTF-8', true);?>
">
			<table class="formcolor">
				<tr><td>Title:</td><td><input type="text" name="title" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8', true);?>
"></td></tr>
				<tr><td>Description:</td><td><textarea rows="5" cols="40" name="description"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['description']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea></td></tr>
				<!--<tr><td>Class Name:</td><td><input type="text" name="className" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['className']->value, ENT_QUOTES, 'UTF-8', true);?>
"></td></tr>
				<tr><td>Header Rows:</td><td><input type="text" name="headerRow" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['headerRow']->value, ENT_QUOTES, 'UTF-8', true);?>
"></td></tr>
				<tr><td>Footer Rows:</td><td><input type="text" name="footerRow" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['footerRow']->value, ENT_QUOTES, 'UTF-8', true);?>
"></td></tr>-->
				<tr>
					<td>Wiki Parse Values:</td><td>
						<input type="checkbox" name="parseValues"<?php if ($_smarty_tpl->tpl_vars['parseValues']->value=='y'){?> checked="checked"<?php }?>>
					</td>
				</tr>
				<?php echo $_smarty_tpl->getSubTemplate ('categorize.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

				<?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_sheet']->value=="y"){?>
				<tr>
					<td>Creator:</td><td>
						<?php echo smarty_function_user_selector(array('name'=>"creator",'editable'=>$_smarty_tpl->tpl_vars['tiki_p_admin_sheet']->value,'user'=>$_smarty_tpl->tpl_vars['creator']->value),$_smarty_tpl);?>

					</td>
				</tr>
				<?php }?>
				<tr>
					<td>Parent Spreadsheet:</td>
					<td>
						<select name="parentSheetId">
							<option value="0">None</option>
							<?php  $_smarty_tpl->tpl_vars['sheet'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['sheet']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['sheets']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['sheet']->key => $_smarty_tpl->tpl_vars['sheet']->value){
$_smarty_tpl->tpl_vars['sheet']->_loop = true;
?>
								<option value="<?php echo $_smarty_tpl->tpl_vars['sheet']->value['sheetId'];?>
"<?php if ($_smarty_tpl->tpl_vars['parentSheetId']->value==$_smarty_tpl->tpl_vars['sheet']->value['sheetId']){?> selected="selected"<?php }?>>
									<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sheet']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
 - (<?php echo $_smarty_tpl->tpl_vars['sheet']->value['sheetId'];?>
)
								</option>
							<?php } ?>
						</select>
						<em>Makes this sheet a "child" sheet of a multi-sheet set</em>
					</td>
				</tr>
				<tr><td>&nbsp;</td><td><input type="submit" class="btn btn-default" value="Save" name="edit"></td></tr>
			</table>
		</form>
		
	<?php if ($_smarty_tpl->tpl_vars['sheetId']->value>0){?>
		<div class="wikitext">
			You can access the sheet using the following URL: <a class="gallink" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
?sheetId=<?php echo $_smarty_tpl->tpl_vars['sheetId']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['url']->value;?>
?sheetId=<?php echo $_smarty_tpl->tpl_vars['sheetId']->value;?>
</a>
		</div>
	<?php }?>
	<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>Smarty::$_smarty_vars['capture']['title']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tabset(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>