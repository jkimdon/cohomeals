<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-show_page.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1038668405567b58d10d4ec4-24702146%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c7938d71626f5378266c5d3fa471643f6339bb4' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-show_page.tpl',
      1 => 1377204441,
      2 => 'file',
    ),
    'fb8cd626f88a68ddf6b267fcb8f1d5edb17715c6' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/layouts/classic/layout_view.tpl',
      1 => 1391098466,
      2 => 'file',
    ),
    'a4f8e1a47674e8b2f6ae5dcc3bf36737fdc965ea' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-flaggedrev_approval_header.tpl',
      1 => 1379339536,
      2 => 'file',
    ),
    '11d158123990ceda828245b8e83b7da4f6dd9c93' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/translated-lang.tpl',
      1 => 1379161765,
      2 => 'file',
    ),
    'b7d20d5b4c11f6341761b02734618c8412f48033' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-wiki_topline.tpl',
      1 => 1397493731,
      2 => 'file',
    ),
    '9891b3ec2623cc1bca157c39fc3095acf02253dc' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wiki-discussion.tpl',
      1 => 1352980245,
      2 => 'file',
    ),
    '293dcf1514a4b4a71f03d4801007995a5873ce3b' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/attachments.tpl',
      1 => 1379339536,
      2 => 'file',
    ),
    '227716383ca547b91f5d56fe9108e1a1eace768b' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-page_bar.tpl',
      1 => 1421875587,
      2 => 'file',
    ),
    'd34ee31bb64e72d9d13a13f25bcc85e0df30426d' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/freetag_list.tpl',
      1 => 1325885219,
      2 => 'file',
    ),
    '717d035f770ab69474ff46a0ea8fb6a12d94966a' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-wiki_structure_bar.tpl',
      1 => 1379339536,
      2 => 'file',
    ),
    '2a6d109a03e67c88f51ec67826aa12775137ed2a' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/poll.tpl',
      1 => 1379339536,
      2 => 'file',
    ),
    '8e17640a7b6c7924a7e4015688d72f5d537e3756' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wiki_authors.tpl',
      1 => 1362063598,
      2 => 'file',
    ),
    'c1abf256b150940322c9fdceab89e45949b9f38c' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/show_copyright.tpl',
      1 => 1362063598,
      2 => 'file',
    ),
    '78b88ba1e43806811934c6b65a69cc7944f49c1e' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/category_related_objects.tpl',
      1 => 1316196542,
      2 => 'file',
    ),
    'cfc569ac9755e07ee0313e90b1063baf90c49d60' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-show_content.tpl',
      1 => 1394731699,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1038668405567b58d10d4ec4-24702146',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pageLang' => 0,
    'prefs' => 0,
    'page_id' => 0,
    'cookie_consent_html' => 0,
    'filegals_manager' => 0,
    'print_page' => 0,
    'tikitest_state' => 0,
    'show_columns' => 0,
    'section' => 0,
    'tiki_p_share' => 0,
    'edit_page' => 0,
    'tiki_p_tell_a_friend' => 0,
    'display_msg' => 0,
    'cookie' => 0,
    'ie6' => 0,
    'module_pref_errors' => 0,
    'pref_error' => 0,
    'headerlib' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58d38647d5_41688358',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58d38647d5_41688358')) {function content_567b58d38647d5_41688358($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_body_attributes')) include 'lib/smarty_tiki/function.html_body_attributes.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_function_modulelist')) include 'lib/smarty_tiki/function.modulelist.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_error_report')) include 'lib/smarty_tiki/function.error_report.php';
if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_function_show_help')) include 'lib/smarty_tiki/function.show_help.php';
if (!is_callable('smarty_function_preference')) include 'lib/smarty_tiki/function.preference.php';
if (!is_callable('smarty_block_wikiplugin')) include 'lib/smarty_tiki/block.wikiplugin.php';
if (!is_callable('smarty_function_interactivetranslation')) include 'lib/smarty_tiki/function.interactivetranslation.php';
?><!DOCTYPE html>
<html lang="<?php if (!empty($_smarty_tpl->tpl_vars['pageLang']->value)){?><?php echo $_smarty_tpl->tpl_vars['pageLang']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['prefs']->value['language'];?>
<?php }?>"<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_bidi']=='y'){?> dir="rtl"<?php }?><?php if (!empty($_smarty_tpl->tpl_vars['page_id']->value)){?> id="page_<?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
"<?php }?>>
	<head>
		<?php echo $_smarty_tpl->getSubTemplate ('header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	</head>
	<body<?php echo smarty_function_html_body_attributes(array(),$_smarty_tpl);?>
>

		<ul class="jumplinks" style="position:absolute;top:-9000px;left:-9000px;z-index:9;">
			<li><a href="#tiki-center" title="Jump to Content">Jump to Content</a></li>
		</ul>
		<?php echo $_smarty_tpl->tpl_vars['cookie_consent_html']->value;?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']=='y'&&$_smarty_tpl->tpl_vars['filegals_manager']->value==''&&$_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
			<div id="fullscreenbutton">
				<?php if ($_SESSION['fullscreen']=='n'){?>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('fullscreen'=>"y",'_ajax'=>'n','_icon'=>'application_get','_title'=>"Fullscreen")); $_block_repeat=true; echo smarty_block_self_link(array('fullscreen'=>"y",'_ajax'=>'n','_icon'=>'application_get','_title'=>"Fullscreen"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('fullscreen'=>"y",'_ajax'=>'n','_icon'=>'application_get','_title'=>"Fullscreen"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<?php }else{ ?>
					<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('fullscreen'=>"n",'_ajax'=>'n','_icon'=>'application_put','_title'=>"Cancel Fullscreen")); $_block_repeat=true; echo smarty_block_self_link(array('fullscreen'=>"n",'_ajax'=>'n','_icon'=>'application_put','_title'=>"Cancel Fullscreen"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('fullscreen'=>"n",'_ajax'=>'n','_icon'=>'application_put','_title'=>"Cancel Fullscreen"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

				<?php }?>
			</div>
		<?php }?>

		
		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_tikitests']=='y'&&!empty($_smarty_tpl->tpl_vars['tikitest_state']->value)&&$_smarty_tpl->tpl_vars['tikitest_state']->value!=0){?>
			<?php echo $_smarty_tpl->getSubTemplate ('tiki-tests_topbar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_ajax']=='y'){?>
			<?php echo $_smarty_tpl->getSubTemplate ('tiki-ajax_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php }?>
		
		<div id="fixedwidth" class="fixedwidth"> 
			<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><div id="main-shadow"><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['main_shadow_start'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?><?php }?>
			<div id="main">
				<?php if (($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']!='y'||$_SESSION['fullscreen']!='y')&&($_smarty_tpl->tpl_vars['prefs']->value['layout_section']!='y'||$_smarty_tpl->tpl_vars['prefs']->value['feature_top_bar']!='n')){?>
					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['module_zones_top']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['module_zones_top']!='n'&&!zone_is_empty('top'))){?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><div id="header-shadow"><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['header_shadow_start'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?><?php }?>
							<div class="header_outer">
								<div class="header_container">
									<div class="fixedwidth header_fixedwidth">
										<header class="clearfix header" id="header">
											<?php echo smarty_function_modulelist(array('zone'=>'top'),$_smarty_tpl);?>

										</header>
									</div>	
								</div>
							</div>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['header_shadow_end'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?></div><?php }?>
					<?php }?>
				<?php }?>
				<div class="middle_outer">
					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><div id="middle-shadow"><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['middle_shadow_start'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?><?php }?>
						<div class="clearfix fixedwidth middle" id="middle">
							<?php echo smarty_function_modulelist(array('zone'=>'topbar'),$_smarty_tpl);?>

							<div class="clearfix <?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']!='y'||$_SESSION['fullscreen']!='y'){?>nofullscreen<?php }else{ ?>fullscreen<?php }?>" id="c1c2">
								<div class="clearfix" id="wrapper">
									<div id="col1" class="<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']!='n'&&!zone_is_empty('left')&&$_smarty_tpl->tpl_vars['show_columns']->value['left_modules']!='n')){?>marginleft<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']!='n'&&!zone_is_empty('right')&&$_smarty_tpl->tpl_vars['show_columns']->value['right_modules']!='n')){?> marginright<?php }?>">
									<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><div id="tiki-center-shadow"><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['center_shadow_start'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?><?php }?>
										<div id="tiki-center"  class="clearfix content">
										<?php if (($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']!='y'||$_SESSION['fullscreen']!='y')){?>
											<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']=='user'||$_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']=='user'){?>
												<div class="clearfix" id="showhide_columns">
													<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']=='user'&&!zone_is_empty('left')>0&&$_smarty_tpl->tpl_vars['show_columns']->value['left_modules']!='n')){?>
														<div style="text-align:left;float:left;" id="showhide_left_column">
															<a class="flip" title="Show/Hide Left Column" href="#" onclick="toggleCols('col2',<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_bidi']=='y'){?>'left','col1','rtl'<?php }else{ ?>'left'<?php }?>); return false"><?php echo smarty_function_icon(array('_name'=>'oleftcol','_id'=>"oleftcol",'class'=>"colflip",'alt'=>"[Show/Hide Left Column]"),$_smarty_tpl);?>
</a>
														</div>
													<?php }?>
													<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']=='user'&&!zone_is_empty('right')&&$_smarty_tpl->tpl_vars['show_columns']->value['right_modules']!='n')){?>
														<div class="clearfix" style="text-align:right;float:right" id="showhide_right_column">
															<a class="flip" title="Show/Hide Right Column" href="#" onclick="toggleCols('col3',<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_bidi']=='y'){?>'right','col1','rtl'<?php }else{ ?>'right'<?php }?>); return false"><?php echo smarty_function_icon(array('_name'=>'orightcol','_id'=>"orightcol",'class'=>"colflip",'alt'=>"[Show/Hide Right Column]"),$_smarty_tpl);?>
</a>
														</div>
													<?php }?>
													<br style="clear:both" />
												</div>
											<?php }?>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['prefs']->value['module_zones_pagetop']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['module_zones_pagetop']!='n'&&!zone_is_empty('pagetop'))){?>
											<?php echo smarty_function_modulelist(array('zone'=>'pagetop'),$_smarty_tpl);?>

										<?php }?>
										<?php if ((isset($_smarty_tpl->tpl_vars['section']->value)&&$_smarty_tpl->tpl_vars['section']->value!='share')&&$_smarty_tpl->tpl_vars['prefs']->value['feature_share']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_share']->value=='y'&&(!isset($_smarty_tpl->tpl_vars['edit_page']->value)||$_smarty_tpl->tpl_vars['edit_page']->value!='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_site_send_link']!='y')){?>
											<div class="share">
												<a title="Share this page" href="tiki-share.php?url=<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
">Share this page</a>
											</div>
										<?php }?>
										<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_tell_a_friend']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_tell_a_friend']->value=='y'&&(!isset($_smarty_tpl->tpl_vars['edit_page']->value)||$_smarty_tpl->tpl_vars['edit_page']->value!='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_site_send_link']!='y')){?>
											<div class="tellafriend">
												<a title="Email this page" href="tiki-tell_a_friend.php?url=<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
">Email this page</a>
											</div>
										<?php }?>
											<?php echo smarty_function_error_report(array(),$_smarty_tpl);?>

											<?php if ($_smarty_tpl->tpl_vars['display_msg']->value){?>
												<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"note",'title'=>"Notice")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Notice"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['display_msg']->value, ENT_QUOTES, 'UTF-8', true);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Notice"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											<?php }?>
											<div id="role_main"<?php if (!empty($_smarty_tpl->tpl_vars['pageLang']->value)){?> lang="<?php echo $_smarty_tpl->tpl_vars['pageLang']->value;?>
"<?php }?>>
												
												
												<?php /*  Call merged included template "tiki-show_content.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-show_content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1326363_13328152($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-show_content.tpl" */?>
											</div>
											<?php if ($_smarty_tpl->tpl_vars['prefs']->value['module_zones_pagebottom']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['module_zones_pagebottom']!='n'&&!zone_is_empty('pagebottom'))){?>
												<?php echo smarty_function_modulelist(array('zone'=>'pagebottom'),$_smarty_tpl);?>

											<?php }?>
											<?php echo smarty_function_show_help(array(),$_smarty_tpl);?>

										</div>
										<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['center_shadow_end'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?></div><?php }?>
									</div>
								</div>

								<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']!='y'||$_SESSION['fullscreen']!='y'){?>
									<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']!='n'&&!zone_is_empty('left')&&$_smarty_tpl->tpl_vars['show_columns']->value['left_modules']!='n')){?>
										<div id="col2"<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_left_column']=='user'){?> style="display:<?php if (isset($_smarty_tpl->tpl_vars['cookie']->value['show_col2'])&&$_smarty_tpl->tpl_vars['cookie']->value['show_col2']!='y'){?> none<?php }elseif(isset($_smarty_tpl->tpl_vars['ie6']->value)){?> block<?php }else{ ?> table-cell<?php }?>;"<?php }?>>
											<?php echo smarty_function_modulelist(array('zone'=>'left','class'=>"content modules"),$_smarty_tpl);?>

										</div>
									<?php }?>
								<?php }?>
							</div>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']!='y'||$_SESSION['fullscreen']!='y'){?>
								<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']!='n'&&!zone_is_empty('right')&&$_smarty_tpl->tpl_vars['show_columns']->value['right_modules']!='n')||(isset($_smarty_tpl->tpl_vars['module_pref_errors']->value)&&$_smarty_tpl->tpl_vars['module_pref_errors']->value)){?>
									<div class="clearfix" id="col3"<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_right_column']=='user'){?> style="display:<?php if (isset($_smarty_tpl->tpl_vars['cookie']->value['show_col3'])&&$_smarty_tpl->tpl_vars['cookie']->value['show_col3']!='y'){?> none<?php }elseif(isset($_smarty_tpl->tpl_vars['ie6']->value)){?> block<?php }else{ ?> table-cell<?php }?>;"<?php }?>>
										
										<?php echo smarty_function_modulelist(array('zone'=>'right','class'=>"content modules"),$_smarty_tpl);?>

										<?php if ($_smarty_tpl->tpl_vars['module_pref_errors']->value){?>
											<div class="content modules">
												<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"warning",'title'=>"Module errors")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Module errors"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

													The following modules could not be loaded
													<form method="post" action="tiki-admin.php">
														<?php  $_smarty_tpl->tpl_vars['pref_error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pref_error']->_loop = false;
 $_smarty_tpl->tpl_vars['index'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['module_pref_errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pref_error']->key => $_smarty_tpl->tpl_vars['pref_error']->value){
$_smarty_tpl->tpl_vars['pref_error']->_loop = true;
 $_smarty_tpl->tpl_vars['index']->value = $_smarty_tpl->tpl_vars['pref_error']->key;
?>
															<p><?php echo $_smarty_tpl->tpl_vars['pref_error']->value['mod_name'];?>
:</p>
															<?php echo smarty_function_preference(array('name'=>$_smarty_tpl->tpl_vars['pref_error']->value['pref_name']),$_smarty_tpl);?>

														<?php } ?>
														<div class="submit">
															<input type="submit" value="Change"/>
														</div>
													</form>
												<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Module errors"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

											</div>
										<?php }?>
										
									</div>
									<br style="clear:both" />
								<?php }?>
							<?php }?>
							<!--[if IE 7]><br style="clear:both; height: 0" /><![endif]-->
						</div>
					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['middle_shadow_end'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?></div><?php }?>
				</div>
				<?php if (($_smarty_tpl->tpl_vars['prefs']->value['feature_fullscreen']!='y'||$_SESSION['fullscreen']!='y')&&($_smarty_tpl->tpl_vars['prefs']->value['layout_section']!='y'||$_smarty_tpl->tpl_vars['prefs']->value['feature_bot_bar']!='n')){?>
					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['module_zones_bottom']=='fixed'||($_smarty_tpl->tpl_vars['prefs']->value['module_zones_bottom']!='n'&&!zone_is_empty('bottom'))){?>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><div id="footer-shadow"><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['footer_shadow_start'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?><?php }?>
							<footer class="footer" id="footer">
								<div class="footer_liner">
									<div class="fixedwidth footerbgtrap">
										<?php echo smarty_function_modulelist(array('zone'=>'bottom','class'=>"content modules",'bidi'=>'y'),$_smarty_tpl);?>

									</div>
								</div>
							</footer>
						<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['footer_shadow_end'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?></div><?php }?>
					<?php }?>
				<?php }?>
			</div><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_layoutshadows']=='y'){?><?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['main_shadow_end'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?></div><?php }?>
		</div> 

		<?php echo $_smarty_tpl->getSubTemplate ('footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['prefs']->value['socialnetworks_user_firstlogin'])&&$_smarty_tpl->tpl_vars['prefs']->value['socialnetworks_user_firstlogin']=='y'){?>
			<?php echo $_smarty_tpl->getSubTemplate ('tiki-socialnetworks_firstlogin_launcher.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['site_google_analytics_account']){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('wikiplugin', array('_name'=>'googleanalytics','account'=>$_smarty_tpl->tpl_vars['prefs']->value['site_google_analytics_account'])); $_block_repeat=true; echo smarty_block_wikiplugin(array('_name'=>'googleanalytics','account'=>$_smarty_tpl->tpl_vars['prefs']->value['site_google_analytics_account']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_wikiplugin(array('_name'=>'googleanalytics','account'=>$_smarty_tpl->tpl_vars['prefs']->value['site_google_analytics_account']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_endbody_code']){?>
			<?php $_template = new Smarty_Internal_Template('eval:'.$_smarty_tpl->tpl_vars['prefs']->value['feature_endbody_code'], $_smarty_tpl->smarty, $_smarty_tpl);echo $_template->fetch(); ?>
		<?php }?>
		<?php echo smarty_function_interactivetranslation(array(),$_smarty_tpl);?>

		<!-- Put JS at the end -->
		<?php if ($_smarty_tpl->tpl_vars['headerlib']->value){?>
			<?php echo $_smarty_tpl->tpl_vars['headerlib']->value->output_js_config();?>

			<?php echo $_smarty_tpl->tpl_vars['headerlib']->value->output_js_files();?>

			<?php echo $_smarty_tpl->tpl_vars['headerlib']->value->output_js();?>

		<?php }?>
	</body>
</html>
<?php if (!empty($_REQUEST['show_smarty_debug'])){?>
	<?php $_smarty_tpl->smarty->loadPlugin('Smarty_Internal_Debug'); Smarty_Internal_Debug::display_debug($_smarty_tpl); ?>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-show_content.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d1326363_13328152')) {function content_567b58d1326363_13328152($_smarty_tpl) {?><?php if (!is_callable('smarty_function_breadcrumbs')) include 'lib/smarty_tiki/function.breadcrumbs.php';
if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
if (!is_callable('smarty_function_rating')) include 'lib/smarty_tiki/function.rating.php';
if (!is_callable('smarty_function_rating_result_avg')) include 'lib/smarty_tiki/function.rating_result_avg.php';
if (!is_callable('smarty_function_rating_result')) include 'lib/smarty_tiki/function.rating_result.php';
if (!is_callable('smarty_function_query')) include 'lib/smarty_tiki/function.query.php';
?>

	<?php if (!isset($_smarty_tpl->tpl_vars['pageLang']->value)){?>
		<?php if (isset($_smarty_tpl->tpl_vars['info']->value['lang'])){?>
			<?php $_smarty_tpl->tpl_vars['pageLang'] = new Smarty_variable($_smarty_tpl->tpl_vars['info']->value['lang'], null, 0);?>
		<?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars['pageLang'] = new Smarty_variable('', null, 0);?>
		<?php }?>
	<?php }?><?php if (!isset($_smarty_tpl->tpl_vars['hide_page_header']->value)||!$_smarty_tpl->tpl_vars['hide_page_header']->value){?>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_siteloc']=='page'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_breadcrumbs']=='y'){?>
		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_siteloclabel']=='y'){?>Location : <?php }?>
		<?php echo smarty_function_breadcrumbs(array('type'=>"trail",'loc'=>"page",'crumbs'=>$_smarty_tpl->tpl_vars['crumbs']->value),$_smarty_tpl);?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_page_title']=='y'){?>
			<?php echo smarty_function_breadcrumbs(array('type'=>"pagetitle",'loc'=>"page",'crumbs'=>$_smarty_tpl->tpl_vars['crumbs']->value,'machine_translate'=>$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value,'source_lang'=>$_smarty_tpl->tpl_vars['pageLang']->value,'target_lang'=>$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value),$_smarty_tpl);?>

		<?php }?>
	<?php }?>
<?php }?>



<?php if (!isset($_smarty_tpl->tpl_vars['hide_page_header']->value)||!$_smarty_tpl->tpl_vars['hide_page_header']->value){?>
	<?php /*  Call merged included template "tiki-flaggedrev_approval_header.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-flaggedrev_approval_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d139acd4_74349426($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-flaggedrev_approval_header.tpl" */?>
<?php }?>

<?php if (!$_smarty_tpl->tpl_vars['prefs']->value['wiki_topline_position']||$_smarty_tpl->tpl_vars['prefs']->value['wiki_topline_position']=='top'||$_smarty_tpl->tpl_vars['prefs']->value['wiki_topline_position']=='both'){?>
	<?php /*  Call merged included template "tiki-wiki_topline.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-wiki_topline.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1496b19_14620070($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-wiki_topline.tpl" */?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['page_bar_position']=='top'){?>
		<?php /*  Call merged included template "tiki-page_bar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-page_bar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1a98f38_46105799($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-page_bar.tpl" */?>
	<?php }?>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['saved_msg']->value)&&$_smarty_tpl->tpl_vars['saved_msg']->value!=''){?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"note",'title'=>"Note")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Note"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo $_smarty_tpl->tpl_vars['saved_msg']->value;?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"note",'title'=>"Note"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

<?php if ($_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['feature_user_watches']=='y'&&(isset($_smarty_tpl->tpl_vars['category_watched']->value)&&$_smarty_tpl->tpl_vars['category_watched']->value=='y')){?>
	<div class="categbar" style="clear: both; text-align: right">
		Watched by categories:
		<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['watching_categories']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<a href="tiki-browse_categories.php?parentId=<?php echo $_smarty_tpl->tpl_vars['watching_categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['categId'];?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['watching_categories']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'], ENT_QUOTES, 'UTF-8', true);?>
</a>&nbsp;
		<?php endfor; endif; ?>
	</div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_urgent_translation']=='y'){?>
	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['translation_alert']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<div class="cbox">
			<div class="cbox-title">
				<?php echo smarty_function_icon(array('_id'=>'information','style'=>"vertical-align:middle"),$_smarty_tpl);?>
 Content may be out of date
			</div>
			<div class="cbox-data">
				<p>
					An urgent request for translation has been sent. Until this page is updated, you can see a corrected version in the following pages:
				</p>
				<ul>
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['j'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['j']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['name'] = 'j';
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['j']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['j']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['j']['total']);
?>
						<li>
							<a href="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['page'],'wiki','with_next');?>
no_bl=y">
								<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['page'], ENT_QUOTES, 'UTF-8', true);?>

							</a>
							(<?php echo $_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['lang'];?>
)
							<?php if ($_smarty_tpl->tpl_vars['editable']->value&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')&&$_smarty_tpl->tpl_vars['beingEdited']->value!='y'){?> 
								<a href="tiki-editpage.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;source_page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['page']);?>
&amp;oldver=<?php echo rawurlencode($_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['last_update']);?>
&amp;newver=<?php echo rawurlencode($_smarty_tpl->tpl_vars['translation_alert']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']][$_smarty_tpl->getVariable('smarty')->value['section']['j']['index']]['current_version']);?>
&amp;diff_style=htmldiff" title="update from it">
									<?php echo smarty_function_icon(array('_id'=>'arrow_refresh','alt'=>"update from it",'style'=>"vertical-align:middle"),$_smarty_tpl);?>

								</a>
							<?php }?>
						</li>
					<?php endfor; endif; ?>
				</ul>
			</div>
		</div>
	<?php endfor; endif; ?>
<?php }?>

<article id="top" class="wikitext clearfix<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_page_title']!='y'){?> nopagetitle<?php }?>">
	<?php if (!isset($_smarty_tpl->tpl_vars['hide_page_header']->value)||!$_smarty_tpl->tpl_vars['hide_page_header']->value){?>
		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_freetags']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_view_freetags']->value=='y'&&isset($_smarty_tpl->tpl_vars['freetags']->value['data'][0])&&$_smarty_tpl->tpl_vars['prefs']->value['freetags_show_middle']=='y'){?>
			<?php /*  Call merged included template "freetag_list.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('freetag_list.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d23165c0_05242935($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "freetag_list.tpl" */?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['pages']->value>1&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_page_navigation_bar']!='bottom'){?>
			<div class="center navigation_bar pagination position_top">
				<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['first_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_first','alt'=>"First page"),$_smarty_tpl);?>
</a>

				<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['prev_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Previous page"),$_smarty_tpl);?>
</a>

				<small><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>$_smarty_tpl->tpl_vars['pagenum']->value,'_1'=>$_smarty_tpl->tpl_vars['pages']->value)); $_block_repeat=true; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['pagenum']->value,'_1'=>$_smarty_tpl->tpl_vars['pages']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
page: %0/%1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['pagenum']->value,'_1'=>$_smarty_tpl->tpl_vars['pages']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</small>

				<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['next_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Next page"),$_smarty_tpl);?>
</a>

				<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['last_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_last','alt'=>"Last page"),$_smarty_tpl);?>
</a>
			</div>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_page_title']=='y'){?>
			<h1 class="pagetitle"><?php echo smarty_function_breadcrumbs(array('type'=>"pagetitle",'loc'=>"page",'crumbs'=>$_smarty_tpl->tpl_vars['crumbs']->value,'machine_translate'=>$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value,'source_lang'=>$_smarty_tpl->tpl_vars['pageLang']->value,'target_lang'=>$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value),$_smarty_tpl);?>
</h1>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'&&($_smarty_tpl->tpl_vars['prefs']->value['wiki_structure_bar_position']!='bottom')){?>
			<?php /*  Call merged included template "tiki-wiki_structure_bar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-wiki_structure_bar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d249db53_75142096($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-wiki_structure_bar.tpl" */?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_ratings']=='y'){?>
			<?php /*  Call merged included template "poll.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('poll.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d266cd05_74066897($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "poll.tpl" */?>
		<?php }?>
	<?php }?> 

	<?php if ($_smarty_tpl->tpl_vars['machine_translate_to_lang']->value!=''){?>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"warning",'title'=>"Warning",'highlight'=>"y")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Warning",'highlight'=>"y"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			This text was automatically translated by Google Translate from the following page: <a href="tiki-index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</a>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"warning",'title'=>"Warning",'highlight'=>"y"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
	
	<div id="page-data" class="clearfix">
		<?php if (isset($_smarty_tpl->tpl_vars['pageLang']->value)&&($_smarty_tpl->tpl_vars['pageLang']->value=='ar'||$_smarty_tpl->tpl_vars['pageLang']->value=='he')){?>
			<div style="direction:RTL; unicode-bidi:embed; text-align: right; <?php if ($_smarty_tpl->tpl_vars['pageLang']->value=='ar'){?>font-size: large;<?php }?>">
				<?php echo $_smarty_tpl->tpl_vars['parsed']->value;?>

			</div>
		<?php }else{ ?>
			<?php echo $_smarty_tpl->tpl_vars['parsed']->value;?>

		<?php }?>
	</div>
	
	
	<hr class="hrwikibottom" /> 

	<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'&&(($_smarty_tpl->tpl_vars['prefs']->value['wiki_structure_bar_position']=='bottom')||($_smarty_tpl->tpl_vars['prefs']->value['wiki_structure_bar_position']=='both'))){?>
		<?php /*  Call merged included template "tiki-wiki_structure_bar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-wiki_structure_bar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d27e9fb0_31218111($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-wiki_structure_bar.tpl" */?>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['pages']->value>1&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_page_navigation_bar']!='top'){?>
		<br>
		<div class="center navigation_bar pagination position_bottom">
			<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['first_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_first','alt'=>"First page"),$_smarty_tpl);?>
</a>

			<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['prev_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Previous page"),$_smarty_tpl);?>
</a>

			<small><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>$_smarty_tpl->tpl_vars['pagenum']->value,'_1'=>$_smarty_tpl->tpl_vars['pages']->value)); $_block_repeat=true; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['pagenum']->value,'_1'=>$_smarty_tpl->tpl_vars['pages']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
page: %0/%1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>$_smarty_tpl->tpl_vars['pagenum']->value,'_1'=>$_smarty_tpl->tpl_vars['pages']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</small>

			<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['next_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Next page"),$_smarty_tpl);?>
</a>

			<a href="tiki-index.php?<?php if ($_smarty_tpl->tpl_vars['page_info']->value){?>page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
<?php }else{ ?>page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php }?>&amp;pagenum=<?php echo $_smarty_tpl->tpl_vars['last_page']->value;?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_last','alt'=>"Last page"),$_smarty_tpl);?>
</a>
		</div>
	<?php }?>
</article> 

<?php if ($_smarty_tpl->tpl_vars['has_footnote']->value=='y'){?>
	<div class="wikitext" id="wikifootnote"><?php echo $_smarty_tpl->tpl_vars['footnote']->value;?>
</div>
<?php }?>

<footer class="editdate">
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_simple_ratings']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_vote_ratings']->value=='y'){?>
		Rate this page:
	    <form method="post" action="">
			<?php echo smarty_function_rating(array('type'=>"wiki page",'id'=>$_smarty_tpl->tpl_vars['page_id']->value),$_smarty_tpl);?>

	    </form>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_simple_ratings']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_wiki_admin_ratings']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_ratings_view_results']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')){?>
		<span class="ratingResultAvg">Users Rating: </span><?php echo smarty_function_rating_result_avg(array('type'=>"wiki page",'id'=>$_smarty_tpl->tpl_vars['page_id']->value),$_smarty_tpl);?>

		<?php echo smarty_function_rating_result(array('type'=>"wiki page",'id'=>$_smarty_tpl->tpl_vars['page_id']->value),$_smarty_tpl);?>

	<?php }?>

	<?php if (isset($_smarty_tpl->tpl_vars['wiki_authors_style']->value)&&$_smarty_tpl->tpl_vars['wiki_authors_style']->value!='none'){?>
		<?php /*  Call merged included template "wiki_authors.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('wiki_authors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d2ac7376_70686874($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wiki_authors.tpl" */?>
	<?php }?>

	<?php /*  Call merged included template "show_copyright.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('show_copyright.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d2cfa684_89818851($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "show_copyright.tpl" */?>

	<?php if ($_smarty_tpl->tpl_vars['print_page']->value=='y'){?>
		<br>
		<?php $_smarty_tpl->_capture_stack[0][] = array('url', null, null); ob_start(); ?><?php echo smarty_function_query(array('_script'=>'tiki-index.php','_type'=>'absolute_uri'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
		The original document is available at <a href="<?php echo Smarty::$_smarty_vars['capture']['url'];?>
"><?php echo Smarty::$_smarty_vars['capture']['url'];?>
</a>
	<?php }?>
</footer>

<?php if ($_smarty_tpl->tpl_vars['is_categorized']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categories']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categoryobjects']=='y'){?>
	<?php echo $_smarty_tpl->tpl_vars['display_catobjects']->value;?>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['is_categorized']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categories']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['category_morelikethis_algorithm']!=''){?>
	<?php /*  Call merged included template "category_related_objects.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('category_related_objects.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d2e2b2f8_25827069($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "category_related_objects.tpl" */?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_topline_position']=='bottom'||$_smarty_tpl->tpl_vars['prefs']->value['wiki_topline_position']=='both'){?>
	<?php /*  Call merged included template "tiki-wiki_topline.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-wiki_topline.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d2e5bd11_60691879($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-wiki_topline.tpl" */?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
	<?php if ((!$_smarty_tpl->tpl_vars['prefs']->value['page_bar_position']||$_smarty_tpl->tpl_vars['prefs']->value['page_bar_position']=='bottom'||$_smarty_tpl->tpl_vars['prefs']->value['page_bar_position']=='both')&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
		<?php /*  Call merged included template "tiki-page_bar.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('tiki-page_bar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d32c0c41_29538737($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "tiki-page_bar.tpl" */?>
	<?php }?>
<?php }?>

<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-flaggedrev_approval_header.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d139acd4_74349426')) {function content_567b58d139acd4_74349426($_smarty_tpl) {?><?php if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['flaggedrev_approval']=='y'&&$_smarty_tpl->tpl_vars['revision_approval']->value){?>
	<?php if (($_smarty_tpl->tpl_vars['revision_approved']->value||$_smarty_tpl->tpl_vars['revision_displayed']->value)&&$_smarty_tpl->tpl_vars['revision_approved']->value!=$_smarty_tpl->tpl_vars['lastVersion']->value&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_latest']->value=='y'){?>
		<?php if ($_smarty_tpl->tpl_vars['lastVersion']->value==$_smarty_tpl->tpl_vars['revision_displayed']->value){?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>'comment','title'=>"Content waiting for approval")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>'comment','title'=>"Content waiting for approval"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<p>
					You are currently viewing the latest version of the page.
					<?php if ($_smarty_tpl->tpl_vars['revision_approved']->value){?>
						You can also view the <?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array()); $_block_repeat=true; echo smarty_block_self_link(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
latest approved version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['tiki_p_wiki_approve']->value=='y'){?>
						You can approve this revision and make it available to a wider audience. Make sure you review all the changes before approving.
					<?php }?>
				</p>
				<?php if ($_smarty_tpl->tpl_vars['tiki_p_wiki_approve']->value=='y'){?>
					<form method="post" action="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['page']->value);?>
">
						<?php if ($_smarty_tpl->tpl_vars['revision_approved']->value){?>
							<p><a href="tiki-pagehistory.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&compare&oldver=<?php echo rawurlencode($_smarty_tpl->tpl_vars['revision_approved']->value);?>
&diff_style=<?php echo rawurlencode($_smarty_tpl->tpl_vars['prefs']->value['default_wiki_diff_style']);?>
">Show changes since last approved revision</a></p>
						<?php }else{ ?>
							<p>This page has no prior approved revision. <strong>All of the content must be reviewed.</strong></p>
						<?php }?>
						<div class="submit">
							<input type="hidden" name="revision" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['revision_displayed']->value, ENT_QUOTES, 'UTF-8', true);?>
">
							<input type="submit" class="btn btn-default" name="approve" value="Approve current revision">
						</div>
					</form>
				<?php }?>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>'comment','title'=>"Content waiting for approval"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }else{ ?>
			<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>'comment','title'=>"Content waiting for approval")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>'comment','title'=>"Content waiting for approval"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

				<p>
					You are currently viewing the approved version of the page.
					<?php if ($_smarty_tpl->tpl_vars['revision_approved']->value&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_latest']->value=='y'){?>
						You can also view the <?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('latest'=>1)); $_block_repeat=true; echo smarty_block_self_link(array('latest'=>1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
latest version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('latest'=>1), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.
					<?php }?>
				</p>
			<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>'comment','title'=>"Content waiting for approval"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

		<?php }?>
	<?php }elseif($_smarty_tpl->tpl_vars['revision_approval']->value&&!$_smarty_tpl->tpl_vars['revision_approved']->value&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_latest']->value=='y'){?>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>'comment','title'=>"Content waiting for approval")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>'comment','title'=>"Content waiting for approval"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<p>
				View the <?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('latest'=>1)); $_block_repeat=true; echo smarty_block_self_link(array('latest'=>1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
latest version<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('latest'=>1), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.
			</p>
		<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>'comment','title'=>"Content waiting for approval"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-wiki_topline.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d1496b19_14620070')) {function content_567b58d1496b19_14620070($_smarty_tpl) {?><?php if (!is_callable('smarty_function_breadcrumbs')) include 'lib/smarty_tiki/function.breadcrumbs.php';
if (!is_callable('smarty_function_query')) include 'lib/smarty_tiki/function.query.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_block_ajax_href')) include 'lib/smarty_tiki/block.ajax_href.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_modifier_truncate')) include 'lib/smarty_tiki/modifier.truncate.php';
?><div class="wikitopline clearfix" style="clear: both;">
	<div class="content">
		<?php if (!isset($_smarty_tpl->tpl_vars['hide_page_header']->value)||!$_smarty_tpl->tpl_vars['hide_page_header']->value){?>
			<div class="wikiinfo" style="float: left">
				<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_page_name_above']=='y'&&$_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
				    <a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
" class="titletop" title="refresh"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_pageid']=='y'&&$_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
					<small><a class="link" href="tiki-index.php?page_id=<?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
">page id: <?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
</a></small>
				<?php }?>
				
				<?php echo smarty_function_breadcrumbs(array('type'=>"desc",'loc'=>"page",'crumbs'=>$_smarty_tpl->tpl_vars['crumbs']->value),$_smarty_tpl);?>

				
				<?php if ($_smarty_tpl->tpl_vars['cached_page']->value=='y'){?><span class="cachedStatus">(Cached)</span><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['is_categorized']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categories']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categorypath']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_view_category']->value=='y'){?>
					<?php echo $_smarty_tpl->tpl_vars['display_catpath']->value;?>

				<?php }?>
			</div>

			<?php if (!isset($_smarty_tpl->tpl_vars['versioned']->value)){?>
				<?php if ($_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
					<div class="wikiactions" style="float: right; padding-left:10px; white-space: nowrap">
						<div class="icons" style="float: left;">
							<?php if ($_smarty_tpl->tpl_vars['pdf_export']->value=='y'){?>
								<a href="tiki-print.php?<?php echo smarty_function_query(array('display'=>"pdf",'page'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
" title="PDF"><?php echo smarty_function_icon(array('_id'=>'page_white_acrobat','alt'=>"PDF"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['flaggedrev_approval']!='y'||!$_smarty_tpl->tpl_vars['revision_approval']->value||$_smarty_tpl->tpl_vars['lastVersion']->value==$_smarty_tpl->tpl_vars['revision_displayed']->value){?>
								<?php if ($_smarty_tpl->tpl_vars['editable']->value&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')&&$_smarty_tpl->tpl_vars['beingEdited']->value!='y'&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
									<a title="Edit this page" <?php $_smarty_tpl->smarty->_tag_stack[] = array('ajax_href', array('template'=>"tiki-editpage.tpl")); $_block_repeat=true; echo smarty_block_ajax_href(array('template'=>"tiki-editpage.tpl"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tiki-editpage.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php if (!empty($_smarty_tpl->tpl_vars['page_ref_id']->value)&&$_smarty_tpl->tpl_vars['needsStaging']->value!='y'){?>&amp;page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_ref_id']->value;?>
<?php }?><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_ajax_href(array('template'=>"tiki-editpage.tpl"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
><?php echo smarty_function_icon(array('_id'=>'page_edit','alt'=>"Edit this page"),$_smarty_tpl);?>
</a>
									<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_edit_icons_toggle']=='y'&&($_smarty_tpl->tpl_vars['prefs']->value['wiki_edit_plugin']=='y'||$_smarty_tpl->tpl_vars['prefs']->value['wiki_edit_section']=='y')){?>
										<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

											$("#wiki_plugin_edit_view").click( function () {
												var src = $("#wiki_plugin_edit_view img").attr("src");
												if (src.indexOf("wiki_plugin_edit_view") > -1) {
													$(".editplugin, .icon_edit_section").show();
													$("#wiki_plugin_edit_view img").attr("src", src.replace("wiki_plugin_edit_view", "wiki_plugin_edit_hide"));
													setCookieBrowser("wiki_plugin_edit_view", true);
												} else {
													$(".editplugin, .icon_edit_section").hide();
													$("#wiki_plugin_edit_view img").attr("src", src.replace("wiki_plugin_edit_hide", "wiki_plugin_edit_view"));
													deleteCookie("wiki_plugin_edit_view");
												}
												return false;
											});
											if (!getCookie("wiki_plugin_edit_view")) {$(".editplugin, .icon_edit_section").hide(); } else { $("#wiki_plugin_edit_view").click(); }
										<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

										<a title="View edit icons" href="#" id="wiki_plugin_edit_view"><?php echo smarty_function_icon(array('_id'=>'wiki_plugin_edit_view','title'=>"View edit icons"),$_smarty_tpl);?>
</a>
									<?php }?>
								<?php }?>
								<?php if (($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_edit_inline']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')&&$_smarty_tpl->tpl_vars['beingEdited']->value!='y'&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
									<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wysiwyg_inline_editing']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_wysiwyg']=='y'){?>
										<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

											$("#wysiwyg_inline_edit").click( function () {
												var src = $("#wysiwyg_inline_edit img").attr("src");
												if (src.indexOf("page.png") > -1) {
													if (enableWysiwygInlineEditing()) {
														$("#wysiwyg_inline_edit img").attr("src", src.replace("page.png", "page_lightning.png"));
													}
												} else {
													if (disableWyiswygInlineEditing()) {
														$("#wysiwyg_inline_edit img").attr("src", src.replace("page_lightning.png", "page.png"));
													}
												}
												return false;
											});
											if (getCookie("wysiwyg_inline_edit", "preview")) { $("#wysiwyg_inline_edit").click(); }
										<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

										<a title="Inline Edit" href="#" id="wysiwyg_inline_edit"><?php echo smarty_function_icon(array('_id'=>'page','title'=>"Inline Edit"),$_smarty_tpl);?>
</a>
									<?php }?>
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_morcego']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_feature_3d']=='y'){?>
								<a title="3d browser" href="javascript:wiki3d_open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value, ENT_QUOTES, 'UTF-8', true);?>
',<?php echo $_smarty_tpl->tpl_vars['prefs']->value['wiki_3d_width'];?>
, <?php echo $_smarty_tpl->tpl_vars['prefs']->value['wiki_3d_height'];?>
)"><?php echo smarty_function_icon(array('_id'=>'wiki3d','alt'=>"3d browser"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['cached_page']->value=='y'){?>
								<a title="Refresh" href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;refresh=1"><?php echo smarty_function_icon(array('_id'=>'arrow_refresh'),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_print']=='y'){?>
								<a title="Print" href="tiki-print.php?<?php echo smarty_function_query(array('_keepall'=>'y'),$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('_id'=>'printer','alt'=>"Print"),$_smarty_tpl);?>
</a>
							<?php }?>
					
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_share']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_share']->value=='y'){?>
								<a title="Share this page" href="tiki-share.php?url=<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
"><?php echo smarty_function_icon(array('_id'=>'share_link','alt'=>"Share this page"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_tell_a_friend']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_tell_a_friend']->value=='y'){?>
								<a title="Send a link" href="tiki-tell_a_friend.php?url=<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
"><?php echo smarty_function_icon(array('_id'=>'email_link','alt'=>"Send a link"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['user']->value)&&$_smarty_tpl->tpl_vars['prefs']->value['feature_notepad']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_notepad']->value=='y'){?>
								<a title="Save to notepad" href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;savenotepad=1<?php if (!empty($_smarty_tpl->tpl_vars['page_ref_id']->value)){?>&amp;page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_ref_id']->value;?>
<?php }?>"><?php echo smarty_function_icon(array('_id'=>'disk','alt'=>"Save to notepad"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['user']->value)&&$_smarty_tpl->tpl_vars['prefs']->value['feature_user_watches']=='y'){?>
								<?php if ($_smarty_tpl->tpl_vars['user_watching_page']->value=='n'){?>
									<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=wiki_page_changed&amp;watch_object=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_action=add<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'){?>&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
<?php }?>" class="icon"><?php echo smarty_function_icon(array('_id'=>'eye','alt'=>"Page is NOT being monitored. Click icon to START monitoring."),$_smarty_tpl);?>
</a>
								<?php }else{ ?>
									<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=wiki_page_changed&amp;watch_object=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_action=remove<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'){?>&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
<?php }?>" class="icon"><?php echo smarty_function_icon(array('_id'=>'no_eye','alt'=>"Page IS being monitored. Click icon to STOP monitoring."),$_smarty_tpl);?>
</a>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_watch_structure']->value=='y'){?>
									<?php if ($_smarty_tpl->tpl_vars['user_watching_structure']->value!='y'){?>
										<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=structure_changed&amp;watch_object=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
&amp;watch_action=add_desc&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
"><?php echo smarty_function_icon(array('_id'=>'eye_arrow_down','alt'=>"Monitor the Sub-Structure"),$_smarty_tpl);?>
</a>
									<?php }else{ ?>
										<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=structure_changed&amp;watch_object=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
&amp;watch_action=remove_desc&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
"><?php echo smarty_function_icon(array('_id'=>'no_eye_arrow_down','alt'=>"Stop Monitoring the Sub-Structure"),$_smarty_tpl);?>
</a>
									<?php }?>
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_group_watches']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_admin_users']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')){?>
								<a href="tiki-object_watches.php?objectId=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=wiki_page_changed&amp;objectType=wiki+page&amp;objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;objectHref=<?php echo rawurlencode(('tiki-index.php?page=').($_smarty_tpl->tpl_vars['page']->value));?>
" class="icon"><?php echo smarty_function_icon(array('_id'=>'eye_group','alt'=>"Group Monitor"),$_smarty_tpl);?>
</a>
					
								<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'){?>
									<a href="tiki-object_watches.php?objectId=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page_info']->value['page_ref_id']);?>
&amp;watch_event=structure_changed&amp;objectType=structure&amp;objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;objectHref=<?php echo rawurlencode(('tiki-index.php?page_ref_id=').($_smarty_tpl->tpl_vars['page_ref_id']->value));?>
" class="icon"><?php echo smarty_function_icon(array('_id'=>'eye_group_arrow_down','alt'=>"Group Monitor on Structure"),$_smarty_tpl);?>
</a>
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_backlinks']=='y'&&$_smarty_tpl->tpl_vars['backlinks']->value&&$_smarty_tpl->tpl_vars['tiki_p_view_backlink']->value=='y'){?>
								<div class="backlinks_button">
									<ul class="clearfix cssmenu_horiz">
										<li class="tabmark">
											<?php echo smarty_function_icon(array('_id'=>'arrow_turn_left','title'=>"Backlinks",'class'=>"icon"),$_smarty_tpl);?>

											<ul class="backlinks_poppedup">
												<li class="tabcontent">
													<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['back'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['back']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['name'] = 'back';
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['backlinks']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total']);
?>
													<a href="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'],'wiki');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'], ENT_QUOTES, 'UTF-8', true);?>
">
														<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_backlinks_name_len']>='1'){?><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'],$_smarty_tpl->tpl_vars['prefs']->value['wiki_backlinks_name_len'],"...",true), ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>
													</a>
													<?php endfor; endif; ?>
												</li>
											</ul>
										</li>
									</ul>
								</div>		
							<?php }?>
							<?php if (($_smarty_tpl->tpl_vars['structure']->value=='y'&&count($_smarty_tpl->tpl_vars['showstructs']->value)>1)||($_smarty_tpl->tpl_vars['structure']->value=='n'&&count($_smarty_tpl->tpl_vars['showstructs']->value)!=0)){?>
								<div class="structure_select">
									<ul class="clearfix cssmenu_horiz">
										<li class="tabmark">
											<?php echo smarty_function_icon(array('_id'=>'chart_organisation','title'=>"Structures",'class'=>"icon"),$_smarty_tpl);?>

											<ul class="structure_poppedup">
												<li class="tabcontent">
													<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['struct'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['name'] = 'struct';
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['showstructs']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total']);
?>
														<a href="tiki-index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&structure=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName']==$_smarty_tpl->tpl_vars['structure_path']->value[0]['pageName']){?> title="Current structure: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
" class="selected" <?php }else{ ?> title="Show structure: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
															<?php if ($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['page_alias']){?>														
																<?php echo $_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['page_alias'];?>

															<?php }else{ ?>
																<?php echo $_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'];?>

															<?php }?>
														</a>
													<?php endfor; endif; ?>
													<?php if ($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName']!=$_smarty_tpl->tpl_vars['structure_path']->value[0]['pageName']){?>
														<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
" title="Hide structure bar">
															Hide structure
														</a>
													<?php }?>	
												</li>
											</ul>
										</li>
									</ul>
								</div>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_multilingual']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['show_available_translations']=='y'&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
								<div class="lang_select">
									<?php /*  Call merged included template "translated-lang.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('translated-lang.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('object_type'=>'wiki page'), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d182cbd8_98957277($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "translated-lang.tpl" */?>
								</div>
							<?php }?>
						</div><!-- END of icons -->
					</div> 
				<?php }?> 
			<?php }?>
		<?php }?> 
	</div> 
</div> 
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/translated-lang.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d182cbd8_98957277')) {function content_567b58d182cbd8_98957277($_smarty_tpl) {?><?php if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_service')) include 'lib/smarty_tiki/function.service.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
?>

<ul class="clearfix cssmenu_horiz">
	<li class="tabmark">
	
		<?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['langName'], ENT_QUOTES, 'UTF-8', true);?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['lang'], ENT_QUOTES, 'UTF-8', true);?>
<?php $_tmp2=ob_get_clean();?><?php echo smarty_function_icon(array('_id'=>'world','class'=>"icon",'title'=>"Current language: ".$_tmp1." (".$_tmp2.")"),$_smarty_tpl);?>

	
        <?php if (empty($_smarty_tpl->tpl_vars['trads']->value[0]['lang'])){?>
        <ul>
            <li class="tabcontent">
                <h1>No language is assigned to this page.</h1>
                <?php if ($_smarty_tpl->tpl_vars['object_type']->value=='wiki page'&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||(!$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_encourage_contribution']=='y'))&&!$_smarty_tpl->tpl_vars['lock']->value){?>
                    <a href="tiki-edit_translation.php?page=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value, ENT_QUOTES, 'UTF-8', true);?>
">Please select a language before performing translation.</a>
                <?php }elseif($_smarty_tpl->tpl_vars['object_type']->value=='article'&&$_smarty_tpl->tpl_vars['tiki_p_edit_article']->value=='y'){?>
                    <a href="tiki-edit_article.php?articleId=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['articleId']->value, ENT_QUOTES, 'UTF-8', true);?>
">Please select a language before performing translation.</a>
                <?php }?>
            </li>
        </ul>
        <?php }else{ ?>
		<ul>
			<li class="tabcontent">
			
			<?php if ($_smarty_tpl->tpl_vars['object_type']->value=='wiki page'){?>
				<a href="tiki-index.php?page=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['objName'], ENT_QUOTES, 'UTF-8', true);?>
&no_bl=y" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['lang'], ENT_QUOTES, 'UTF-8', true);?>
): <?php echo $_smarty_tpl->tpl_vars['trads']->value[0]['objName'];?>
" class="selected">
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['lang'], ENT_QUOTES, 'UTF-8', true);?>
)
				</a>
			<?php }elseif($_smarty_tpl->tpl_vars['object_type']->value=='article'){?>
				<a href="tiki-read_article.php?articleId=<?php echo $_smarty_tpl->tpl_vars['trads']->value[0]['objId'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['lang'], ENT_QUOTES, 'UTF-8', true);?>
): <?php echo $_smarty_tpl->tpl_vars['trads']->value[0]['objName'];?>
" class="selected">
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[0]['lang'], ENT_QUOTES, 'UTF-8', true);?>
)
				</a>
			<?php }?>
			
				<?php if (isset($_smarty_tpl->tpl_vars['trads']->value)&&count($_smarty_tpl->tpl_vars['trads']->value)>1){?>
					<h1>
						<?php echo smarty_function_icon(array('_id'=>'group','title'=>"Translations"),$_smarty_tpl);?>
 Translations
					</h1>
				<?php }?>
			
				<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['trads']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						
					<?php if ($_smarty_tpl->tpl_vars['object_type']->value=='wiki page'&&$_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]!=$_smarty_tpl->tpl_vars['trads']->value[0]){?>
						<a href="tiki-index.php?page=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['objName'], ENT_QUOTES, 'UTF-8', true);?>
&no_bl=y" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['lang'], ENT_QUOTES, 'UTF-8', true);?>
): <?php echo $_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['objName'];?>
" class="linkmodule <?php echo $_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['class'];?>
">
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['lang'], ENT_QUOTES, 'UTF-8', true);?>
)
						</a>
					<?php }?>
				
					<?php if ($_smarty_tpl->tpl_vars['object_type']->value=='article'&&$_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]!=$_smarty_tpl->tpl_vars['trads']->value[0]){?>
						<a href="tiki-read_article.php?articleId=<?php echo $_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['objId'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['lang'], ENT_QUOTES, 'UTF-8', true);?>
): <?php echo $_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['objName'];?>
" class="linkmodule <?php echo $_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['class'];?>
">
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['trads']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['lang'], ENT_QUOTES, 'UTF-8', true);?>
)
						</a>
					<?php }?>
				<?php endfor; endif; ?>
			
				<?php if ($_smarty_tpl->tpl_vars['object_type']->value=='wiki page'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_multilingual_one_page']=='y'&&$_smarty_tpl->tpl_vars['translationsCount']->value>1){?>
					<h1>
						<a href="tiki-all_languages.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['trads']->value[0]['objName']);?>
&no_bl=y" title="Show all translations of this page on a single page"><?php echo smarty_function_icon(array('_id'=>'application_view_columns','title'=>''),$_smarty_tpl);?>

							All languages
						</a>
					</h1>
				<?php }?>
			
				<?php if ($_smarty_tpl->tpl_vars['object_type']->value=='wiki page'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_machine_translation']=='y'){?>
					<h1>
						<?php echo smarty_function_icon(array('_id'=>'google','title'=>"Google translate"),$_smarty_tpl);?>
 Machine translations
					</h1>
				
					<?php  $_smarty_tpl->tpl_vars['mtl'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['mtl']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['langsCandidatesForMachineTranslation']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['mtl']->key => $_smarty_tpl->tpl_vars['mtl']->value){
$_smarty_tpl->tpl_vars['mtl']->_loop = true;
?>
						<a href="tiki-index.php?machine_translate_to_lang=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mtl']->value['lang'], ENT_QUOTES, 'UTF-8', true);?>
&page=<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['page']->value);?>
&no_bl=y" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mtl']->value['langName'], ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mtl']->value['lang'], ENT_QUOTES, 'UTF-8', true);?>
)">
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['mtl']->value['langName'], ENT_QUOTES, 'UTF-8', true);?>
 *
						</a>
					<?php } ?>
				<?php }?>
			
				<?php $_smarty_tpl->_capture_stack[0][] = array('default', null, null); ob_start(); ?><?php if ($_smarty_tpl->tpl_vars['object_type']->value=='wiki page'&&$_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'){?>
					<a href="tiki-edit_translation.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['trads']->value[0]['objName']);?>
&no_bl=y" title="Translate page">
						Translate
					</a>
					<a href="<?php echo smarty_function_service(array('controller'=>'translation','action'=>'manage','type'=>'wiki page','source'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
" class="attach_detach_translation" data-object_type="wiki page" data-object_id="<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['page']->value);?>
" title="Manage page translations">
						Manage translations
					</a>
				<?php }elseif($_smarty_tpl->tpl_vars['object_type']->value=='article'&&$_smarty_tpl->tpl_vars['tiki_p_edit_article']->value=='y'){?>
					<a href="tiki-edit_article.php?translationOf=<?php echo $_smarty_tpl->tpl_vars['articleId']->value;?>
" title="Translate article">
						Translate
					</a>
					<a href="<?php echo smarty_function_service(array('controller'=>'translation','action'=>'manage','type'=>'article','source'=>$_smarty_tpl->tpl_vars['articleId']->value),$_smarty_tpl);?>
" class="attach_detach_translation" data-object_id="<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['articleId']->value);?>
" data-object_type="article" title="Manage article translations">
						Manage translations
					</a>
				<?php }?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
				<?php if (!empty(Smarty::$_smarty_vars['capture']['default'])){?>
					<div>
						<?php echo smarty_function_icon(array('_id'=>'world_edit','title'=>"Maintenance"),$_smarty_tpl);?>
 Maintenance
					</div>
					<?php echo Smarty::$_smarty_vars['capture']['default'];?>

				<?php }?>				
			</li>
		</ul>
        <?php }?>
	</li>
</ul>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

$('a.attach_detach_translation').click(function() {
    var object_type = $(this).data('object_type');
    var object_to_translate = $(this).data('object_id');
	$(this).serviceDialog({
		title: 'Manage translations',
		data: {
			controller: 'translation',
			action: 'manage',
			type: object_type,
			source: object_to_translate
		}
    });
    return false;
});
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-page_bar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d1a98f38_46105799')) {function content_567b58d1a98f38_46105799($_smarty_tpl) {?><?php if (!is_callable('smarty_function_favorite')) include 'lib/smarty_tiki/function.favorite.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
if (!is_callable('smarty_function_service')) include 'lib/smarty_tiki/function.service.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/modifier.regex_replace.php';
if (!is_callable('smarty_function_attachments')) include 'lib/smarty_tiki/function.attachments.php';
?>
<?php if (!isset($_smarty_tpl->tpl_vars['versioned']->value)||!$_smarty_tpl->tpl_vars['versioned']->value){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'page_bar', null); ob_start(); ?><?php echo smarty_function_favorite(array('type'=>"wiki page",'object'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
<?php if ($_smarty_tpl->tpl_vars['edit_page']->value!='y'){?><?php if (((isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')||(!$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_encourage_contribution']=='y'))||$_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'){?><?php if (isset($_smarty_tpl->tpl_vars['beingEdited']->value)&&$_smarty_tpl->tpl_vars['beingEdited']->value=='y'){?><?php $_smarty_tpl->tpl_vars['thisPageClass'] = new Smarty_variable('+highlight', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['thisPageClass'] = new Smarty_variable('', null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['flaggedrev_approval']!='y'||!$_smarty_tpl->tpl_vars['revision_approval']->value||$_smarty_tpl->tpl_vars['lastVersion']->value==$_smarty_tpl->tpl_vars['revision_displayed']->value){?><?php if (isset($_smarty_tpl->tpl_vars['page_ref_id']->value)){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-editpage.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'page_ref_id'=>$_smarty_tpl->tpl_vars['page_ref_id']->value,'_class'=>$_smarty_tpl->tpl_vars['thisPageClass']->value,'_text'=>"Edit this page"),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-editpage.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_class'=>$_smarty_tpl->tpl_vars['thisPageClass']->value,'_text'=>"Edit this page"),$_smarty_tpl);?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['tiki_p_wiki_view_latest']->value=='y'){?><span class="btn btn-default button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('latest'=>1)); $_block_repeat=true; echo smarty_block_self_link(array('latest'=>1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
View latest version before editing<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('latest'=>1), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_source']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_source']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-pagehistory.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'source'=>"0",'_text'=>"Source"),$_smarty_tpl);?>
<?php }?><?php if (mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')!='sandbox'){?><?php if ($_smarty_tpl->tpl_vars['tiki_p_remove']->value=='y'&&(isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-removepage.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'version'=>"last",'_text'=>"Remove"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_rename']->value=='y'&&(isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-rename_page.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Rename"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_usrlock']=='y'&&$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['tiki_p_lock']->value=='y'){?><?php if (!$_smarty_tpl->tpl_vars['lock']->value){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'action'=>"lock",'_text'=>"Lock"),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'||$_smarty_tpl->tpl_vars['user']->value==$_smarty_tpl->tpl_vars['page_user']->value){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'action'=>"unlock",'_text'=>"Unlock"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_assign_perm_wiki_page']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-objectpermissions.php",'objectId'=>$_smarty_tpl->tpl_vars['page']->value,'objectName'=>$_smarty_tpl->tpl_vars['page']->value,'objectType'=>"wiki+page",'permType'=>"wiki",'_text'=>"Permissions"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_history']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_history']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-pagehistory.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"History"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_page_contribution']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_page_contribution_view']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-page_contribution.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Contributions by author"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_likePages']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_similar']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-likepages.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Similar"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_undo']=='y'&&$_smarty_tpl->tpl_vars['canundo']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'undo'=>"1",'_text'=>"Undo"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_make_structure']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_edit_structures']->value=='y'&&(isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['structure']->value=='n'&&count($_smarty_tpl->tpl_vars['showstructs']->value)==0){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'convertstructure'=>"1",'_text'=>"Make Structure"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_slideshow']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_uses_slides']=='y'){?><?php if ($_smarty_tpl->tpl_vars['show_slideshow']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"./tiki-slideshow.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Slideshow"),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['structure']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-slideshow2.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'],'_text'=>"Slideshow"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_export']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_export_wiki']->value=='y')){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-export_wiki_pages.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Export"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_discuss']=='y'&&$_smarty_tpl->tpl_vars['show_page']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_forum_post']->value=='y'){?><?php $_smarty_tpl->_capture_stack[0][] = array('default', 'wiki_discussion_string', null); ob_start(); ?><?php /*  Call merged included template "wiki-discussion.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('wiki-discussion.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1d22935_20098918($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wiki-discussion.tpl" */?> [tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
|<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
]<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-view_forum.php",'forumId'=>$_smarty_tpl->tpl_vars['prefs']->value['wiki_forum_id'],'comments_postComment'=>"post",'comments_title'=>$_smarty_tpl->tpl_vars['page']->value,'comments_data'=>$_smarty_tpl->tpl_vars['wiki_discussion_string']->value,'comment_topictype'=>"n",'_text'=>"Discuss"),$_smarty_tpl);?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['show_page']->value)&&$_smarty_tpl->tpl_vars['show_page']->value=='y'){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_comments']=='y'&&($_smarty_tpl->tpl_vars['prefs']->value['wiki_comments_allow_per_page']=='n'||$_smarty_tpl->tpl_vars['info']->value['comments_enabled']=='y')&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_comments']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_read_comments']->value=='y'){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_comments_displayed_default']=='y'){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							var id = '#comment-container';
							$(id).comment_load('tiki-ajax_services.php?controller=comment&action=list&type=wiki+page&objectId=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
#comment-container');
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><span class="btn btn-default button"><a id="comment-toggle" href="<?php echo smarty_function_service(array('controller'=>'comment','action'=>'list','type'=>"wiki page",'objectId'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
#comment-container">Comments<?php if ($_smarty_tpl->tpl_vars['count_comments']->value){?>&nbsp;(<span class="count_comments"><?php echo $_smarty_tpl->tpl_vars['count_comments']->value;?>
</span>)<?php }?></a></span><?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							$('#comment-toggle').comment_toggle();
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_attachments']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='y'&&(isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)>0)||$_smarty_tpl->tpl_vars['tiki_p_wiki_attach_files']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='y')){?><?php if (isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)>0){?><?php $_smarty_tpl->tpl_vars['thisbuttonclass'] = new Smarty_variable('highlight', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['thisbuttonclass'] = new Smarty_variable('', null, 0);?><?php }?><?php $_smarty_tpl->_capture_stack[0][] = array('default', 'thistext', null); ob_start(); ?><?php if ((!isset($_smarty_tpl->tpl_vars['atts']->value)||count($_smarty_tpl->tpl_vars['atts']->value)==0)||$_smarty_tpl->tpl_vars['tiki_p_wiki_attach_files']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='n'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='n'){?>Attach File<?php }elseif(isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)==1){?>1 File Attached<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo count($_smarty_tpl->tpl_vars['atts']->value);?>
 files attached<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?>
						<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
						<?php if ((isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)>0)||$_smarty_tpl->tpl_vars['editable']->value){?>
							<?php ob_start();?><?php if (isset($_smarty_tpl->tpl_vars['pagemd5']->value)){?><?php echo (string)$_smarty_tpl->tpl_vars['pagemd5']->value;?><?php }?><?php $_tmp1=ob_get_clean();?><?php echo smarty_function_button(array('href'=>"#attachments",'_flip_id'=>"attzone".$_tmp1,'_class'=>$_smarty_tpl->tpl_vars['thisbuttonclass']->value,'_text'=>$_smarty_tpl->tpl_vars['thistext']->value,'_flip_default_open'=>$_smarty_tpl->tpl_vars['prefs']->value['w_displayed_default']),$_smarty_tpl);?>

						<?php }?>
					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_multilingual']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||(!$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_encourage_contribution']=='y'))&&!$_smarty_tpl->tpl_vars['lock']->value){?>
						<?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-edit_translation.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Translate"),$_smarty_tpl);?>

					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_keywords']=='y'){?>
						<?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-admin_keywords.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Keywords"),$_smarty_tpl);?>

					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value&&(isset($_smarty_tpl->tpl_vars['tiki_p_create_bookmarks']->value)&&$_smarty_tpl->tpl_vars['tiki_p_create_bookmarks']->value=='y')&&$_smarty_tpl->tpl_vars['prefs']->value['feature_user_bookmarks']=='y'){?>
						<?php ob_start();?><?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['page']->value);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo smarty_modifier_regex_replace(smarty_modifier_regex_replace($_SERVER['REQUEST_URI'],'/^[^\?\&]*/',''),'/(\?page=[^\&]+)/','');?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['urlurl'] = new Smarty_variable($_tmp2.$_tmp3, null, 0);?><?php echo smarty_function_button(array('_script'=>"tiki-user_bookmarks.php",'urlname'=>$_smarty_tpl->tpl_vars['page']->value,'urlurl'=>$_smarty_tpl->tpl_vars['urlurl']->value,'addurl'=>"Add",'_text'=>"Bookmark",'_auto_args'=>"urlname,urlurl,addurl"),$_smarty_tpl);?>

					<?php }?>
				<?php }?>
			<?php }?>
		<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

		<?php if ($_smarty_tpl->tpl_vars['page_bar']->value!=''){?>
			<div class="clearfix" id="page-bar">
				<?php echo $_smarty_tpl->tpl_vars['page_bar']->value;?>

			</div>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['wiki_extras']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_attachments']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='y'){?>
			<a name="attachments"></a>
			<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_use_fgal_for_wiki_attachments']=='y'){?>
				<?php echo smarty_function_attachments(array('_id'=>$_smarty_tpl->tpl_vars['page']->value,'_type'=>'wiki page'),$_smarty_tpl);?>

			<?php }else{ ?>
				<?php /*  Call merged included template "attachments.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('attachments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1f1fc45_86923811($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "attachments.tpl" */?>
			<?php }?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_comments']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_comments']->value=='y'&&$_smarty_tpl->tpl_vars['edit_page']->value!='y'){?>
			<div id="comment-container"></div>
		<?php }?>

	
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wiki-discussion.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d1d22935_20098918')) {function content_567b58d1d22935_20098918($_smarty_tpl) {?>Use this thread to discuss the page:<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:41
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/attachments.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d1f1fc45_86923811')) {function content_567b58d1f1fc45_86923811($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_iconify')) include 'lib/smarty_tiki/modifier.iconify.php';
if (!is_callable('smarty_modifier_tiki_short_datetime')) include 'lib/smarty_tiki/modifier.tiki_short_datetime.php';
if (!is_callable('smarty_modifier_userlink')) include 'lib/smarty_tiki/modifier.userlink.php';
if (!is_callable('smarty_modifier_kbsize')) include 'lib/smarty_tiki/modifier.kbsize.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
?>

<a name="attachments"></a>
<?php if ($_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_wiki_attach_files']->value=='y'){?>

	<div
		<?php if (isset($_smarty_tpl->tpl_vars['pagemd5']->value)&&$_smarty_tpl->tpl_vars['pagemd5']->value){?>
			<?php $_smarty_tpl->tpl_vars['cookie_key'] = new Smarty_variable("show_attzone".((string)$_smarty_tpl->tpl_vars['pagemd5']->value), null, 0);?>
			id="attzone<?php echo $_smarty_tpl->tpl_vars['pagemd5']->value;?>
"
		<?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars['cookie_key'] = new Smarty_variable("show_attzone", null, 0);?>
			id="attzone"
		<?php }?>
		<?php if ((isset($_SESSION['tiki_cookie_jar'][$_smarty_tpl->tpl_vars['cookie_key']->value])&&$_SESSION['tiki_cookie_jar'][$_smarty_tpl->tpl_vars['cookie_key']->value]=='y')||(!isset($_SESSION['tiki_cookie_jar'][$_smarty_tpl->tpl_vars['cookie_key']->value])&&$_smarty_tpl->tpl_vars['prefs']->value['w_displayed_default']=='y')){?>
			style="display:block;"
		<?php }else{ ?>
			style="display:none;"
		<?php }?>
	>

	

	<?php if (($_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='y')&&count($_smarty_tpl->tpl_vars['atts']->value)>0){?>
		<?php if (isset($_smarty_tpl->tpl_vars['offset']->value)){?>
			<?php $_smarty_tpl->tpl_vars['offsetparam'] = new Smarty_variable("offset=".((string)$_smarty_tpl->tpl_vars['offset']->value)."&amp;", null, 0);?>
		<?php }else{ ?>
			<?php $_smarty_tpl->tpl_vars['offsetparam'] = new Smarty_variable('', null, 0);?>
		<?php }?>
		<table class="normal">
			<caption> List of attached files </caption>
			<tr>
				<th>
					<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='attId_desc'){?>attId_asc<?php }else{ ?>attId_desc<?php }?>&amp;atts_show=y#attachments">ID</a>
				</th>
				<th>
					<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='filename_desc'){?>filename_asc<?php }else{ ?>filename_desc<?php }?>&amp;atts_show=y#attachments">Name</a>
				</th>
				<th>
					<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='comment_desc'){?>comment_asc<?php }else{ ?>comment_desc<?php }?>&amp;atts_show=y#attachments">desc</a>
				</th>
				<th>
					<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='created_desc'){?>created_asc<?php }else{ ?>created_desc<?php }?>&amp;atts_show=y#attachments">uploaded</a>
				</th>
				<th>
					<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='size_desc'){?>size_asc<?php }else{ ?>size_desc<?php }?>&amp;atts_show=y#attachments">Size</a>
				</th>
				<th>
					<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='hits_desc'){?>hits_asc<?php }else{ ?>hits_desc<?php }?>&amp;atts_show=y#attachments">Downloads</a>
				</th>
				<th>Actions</th>
			</tr>
			<?php echo smarty_function_cycle(array('values'=>"odd,even",'print'=>false,'advance'=>false),$_smarty_tpl);?>

			<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['name'] = 'ix';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['atts']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total']);
?>
				<tr class="<?php echo smarty_function_cycle(array(),$_smarty_tpl);?>
">
					<td class="id"><?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['attId'];?>
</td>
					<td class="text">
						<?php echo smarty_modifier_iconify($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['filename']);?>

						<a class="tablename" href="tiki-download_wiki_attachment.php?attId=<?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['attId'];?>
&amp;page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;download=y"><?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['filename'];?>
</a>
					</td>
					<td class="text"><small><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['comment'], ENT_QUOTES, 'UTF-8', true);?>
</small></td>
					<td class="date">
						<small><?php echo smarty_modifier_tiki_short_datetime($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['created']);?>
<?php if ($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['user']){?> by <?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['user']);?>
<?php }?></small>
					</td>
					<td class="integer"><?php echo smarty_modifier_kbsize($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['filesize']);?>
</td>
					<td class="integer"><?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['hits'];?>
</td>
					<td class="action">
						<a title="View" href="tiki-download_wiki_attachment.php?attId=<?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['attId'];?>
" target="_blank"><?php echo smarty_function_icon(array('_id'=>'monitor','alt'=>"View"),$_smarty_tpl);?>
</a>
						<a title="Download" href="tiki-download_wiki_attachment.php?attId=<?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['attId'];?>
&amp;download=y"><?php echo smarty_function_icon(array('_id'=>'disk','alt'=>"Download"),$_smarty_tpl);?>
</a>
						&nbsp;
						<?php if (($_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='y'||($_smarty_tpl->tpl_vars['user']->value&&($_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['user']==$_smarty_tpl->tpl_vars['user']->value)))&&$_smarty_tpl->tpl_vars['editable']->value){?>
							<a title="Delete" class="link" href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;removeattach=<?php echo $_smarty_tpl->tpl_vars['atts']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['attId'];?>
&amp;<?php echo $_smarty_tpl->tpl_vars['offsetparam']->value;?>
<?php if (!empty($_smarty_tpl->tpl_vars['sort_mode']->value)){?>sort_mode=<?php echo $_smarty_tpl->tpl_vars['sort_mode']->value;?>
<?php }?>"<?php if (!empty($_smarty_tpl->tpl_vars['target']->value)){?> target="<?php echo $_smarty_tpl->tpl_vars['target']->value;?>
"<?php }?>><?php echo smarty_function_icon(array('_id'=>'cross','alt'=>"Remove"),$_smarty_tpl);?>
</a>
						<?php }?>
					</td>
				</tr>
			<?php endfor; endif; ?>
		</table>
	<?php }?>

	

	<?php if (($_smarty_tpl->tpl_vars['tiki_p_wiki_attach_files']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='y')&&(!isset($_smarty_tpl->tpl_vars['attach_box']->value)||$_smarty_tpl->tpl_vars['attach_box']->value!='n')&&$_smarty_tpl->tpl_vars['editable']->value){?>
		<form enctype="multipart/form-data" action="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
" method="post">
			<?php if ($_smarty_tpl->tpl_vars['page_ref_id']->value){?>
				<input type="hidden" name="page_ref_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_ref_id']->value, ENT_QUOTES, 'UTF-8', true);?>
">
			<?php }?>
			<?php if (!empty($_REQUEST['no_bl'])){?>
				<input type="hidden" name="no_bl" value="<?php echo htmlspecialchars($_REQUEST['no_bl'], ENT_QUOTES, 'UTF-8', true);?>
">
			<?php }?>
			<table class="formcolor">
				<tr>
					<td>
						<label for="attach-upload">Upload file:</label><input type="hidden" name="MAX_FILE_SIZE" value="1000000000">
						<input size="16" name="userfile1" type="file" id="attach-upload">
						<label for="attach-comment">Comment:</label><input type="text" name="attach_comment" maxlength="250" id="attach-comment">
						<input type="submit" class="btn btn-default" name="attach" value="Attach">
					</td>
				</tr>
			</table>
		</form>
	<?php }?>
</div>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/freetag_list.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d23165c0_05242935')) {function content_567b58d23165c0_05242935($_smarty_tpl) {?><?php if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_freetags']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_view_freetags']->value=='y'&&isset($_smarty_tpl->tpl_vars['freetags']->value['data'][0])){?>
	<div class="freetaglist"><?php echo smarty_function_icon(array('_id'=>'tag_blue','alt'=>"Tags"),$_smarty_tpl);?>

		<?php  $_smarty_tpl->tpl_vars['taginfo'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['taginfo']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['freetags']->value['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['taginfo']->key => $_smarty_tpl->tpl_vars['taginfo']->value){
$_smarty_tpl->tpl_vars['taginfo']->_loop = true;
?>
			<?php $_smarty_tpl->_capture_stack[0][] = array('tagurl', null, null); ob_start(); ?><?php if ((strstr($_smarty_tpl->tpl_vars['taginfo']->value['tag'],' '))){?>"<?php echo $_smarty_tpl->tpl_vars['taginfo']->value['tag'];?>
"<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['taginfo']->value['tag'];?>
<?php }?><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
			<?php if (isset($_smarty_tpl->tpl_vars['links_inactive']->value)&&$_smarty_tpl->tpl_vars['links_inactive']->value=='y'){?>
				<a class="freetag" href="#"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['taginfo']->value['tag'], ENT_QUOTES, 'UTF-8', true);?>
</a>
			<?php }else{ ?>
				<a class="freetag" href="tiki-browse_freetags.php?tag=<?php echo rawurlencode(Smarty::$_smarty_vars['capture']['tagurl']);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['taginfo']->value['tag'], ENT_QUOTES, 'UTF-8', true);?>
</a><?php if (isset($_smarty_tpl->tpl_vars['deleteTag']->value)&&$_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y'){?><a title="Untag <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['taginfo']->value['tag'], ENT_QUOTES, 'UTF-8', true);?>
" href="<?php echo $_SERVER['REQUEST_URI'];?>
<?php if (strstr($_SERVER['REQUEST_URI'],'?')){?>&amp;<?php }else{ ?>?<?php }?>delTag=<?php echo rawurlencode($_smarty_tpl->tpl_vars['taginfo']->value['tag']);?>
"><?php echo smarty_function_icon(array('_id'=>'cross','alt'=>"Untag"),$_smarty_tpl);?>
</a>&nbsp;<?php }?>
			<?php }?>
		<?php } ?>
		<?php if (isset($_smarty_tpl->tpl_vars['freetags_mixed_lang']->value)&&$_smarty_tpl->tpl_vars['freetags_mixed_lang']->value){?>
			(<a href="<?php echo $_smarty_tpl->tpl_vars['freetags_mixed_lang']->value;?>
">Translate tags</a>)
		<?php }?>
	</div>
<?php }?><?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-wiki_structure_bar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d249db53_75142096')) {function content_567b58d249db53_75142096($_smarty_tpl) {?><?php if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_sefurl')) include 'lib/smarty_tiki/function.sefurl.php';
if (!is_callable('smarty_function_autocomplete')) include 'lib/smarty_tiki/function.autocomplete.php';
if (!is_callable('smarty_modifier_pagename')) include 'lib/smarty_tiki/modifier.pagename.php';
if (!is_callable('smarty_function_menu')) include 'lib/smarty_tiki/function.menu.php';
?><div class="tocnav">
	<div class="clearfix">
		<div style="float: left; width: 100px">
  
    <?php if ($_smarty_tpl->tpl_vars['home_info']->value){?><?php if ($_smarty_tpl->tpl_vars['home_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['home_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['home_info']->value['pageName'], null, 0);?><?php }?>
    	<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('page'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'])); $_block_repeat=true; echo smarty_block_self_link(array('page'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smarty_function_icon(array('_id'=>'house','alt'=>"TOC",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('page'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['prev_info']->value&&$_smarty_tpl->tpl_vars['prev_info']->value['page_ref_id']){?><?php if ($_smarty_tpl->tpl_vars['prev_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['prev_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['prev_info']->value['pageName'], null, 0);?><?php }?>
    	<a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['prev_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['prev_info']->value['page_ref_id']),$_smarty_tpl);?>
">
    		<?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Previous page",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
</a>
    <?php }else{ ?>
    	<img src="img/icons/8.gif" alt="" height="1" width="8px">
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['parent_info']->value){?><?php if ($_smarty_tpl->tpl_vars['parent_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['parent_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['parent_info']->value['pageName'], null, 0);?><?php }?>
    	<a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['parent_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['parent_info']->value['page_ref_id']),$_smarty_tpl);?>
">
    		<?php echo smarty_function_icon(array('_id'=>'resultset_up','alt'=>"Parent page",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
</a>
    <?php }else{ ?>
    	<img src="img/icons/8.gif" alt="" height="1" width="8px">
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['next_info']->value&&$_smarty_tpl->tpl_vars['next_info']->value['page_ref_id']){?><?php if ($_smarty_tpl->tpl_vars['next_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['next_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['next_info']->value['pageName'], null, 0);?><?php }?><a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['next_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['next_info']->value['page_ref_id']),$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Next page",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
</a><?php }else{ ?><img src="img/icons/8.gif" alt="" height="1px" width="8px"><?php }?>

		</div>
  		<div style="float: left;">
<?php if ($_smarty_tpl->tpl_vars['struct_editable']->value=='y'){?>
	<form action="tiki-editpage.php" method="post">
		<div class="form">
			<input type="hidden" name="current_page_id" value="<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
">
			<input type="text" id="structure_add_page" name="page">
			<?php echo smarty_function_autocomplete(array('element'=>'#structure_add_page','type'=>'pagename'),$_smarty_tpl);?>

			
			<?php if ($_smarty_tpl->tpl_vars['page_info']->value&&!$_smarty_tpl->tpl_vars['parent_info']->value){?>
				<input type="hidden" name="add_child" value="checked"> 
			<?php }else{ ?>
				<input type="checkbox" name="add_child"> Child
			<?php }?>      
			<input type="submit" class="btn btn-default" name="insert_into_struct" value="Add Page">
		</div>
	</form>
	</div>
	</div>
	<div>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_script'=>"tiki-edit_structure.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'],'_alt'=>"Structure",'_title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")")); $_block_repeat=true; echo smarty_block_self_link(array('_script'=>"tiki-edit_structure.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'],'_alt'=>"Structure",'_title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smarty_function_icon(array('_id'=>'chart_organisation','alt'=>"Structure",'title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")"),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_script'=>"tiki-edit_structure.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'],'_alt'=>"Structure",'_title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;&nbsp;
<?php }else{ ?>
		</div>
<?php }?>
	    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['structure_path']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['name'] = 'ix';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total']);
?>
	      <?php if ($_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['parent_id']){?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['site_crumb_seper'];?>
&nbsp;<?php }?>
		  <a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['page_ref_id']),$_smarty_tpl);?>
">
	      <?php if ($_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['page_alias']){?>
	        <?php echo $_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['page_alias'];?>

		  <?php }else{ ?>
	        <?php echo smarty_modifier_pagename($_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['stripped_pageName']);?>

		  <?php }?>
		  </a>
		<?php endfor; endif; ?>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_structure_drilldownmenu']=='y'){?>
		<?php echo smarty_function_menu(array('structureId'=>$_smarty_tpl->tpl_vars['page_info']->value['structure_id'],'page_id'=>$_smarty_tpl->tpl_vars['page_info']->value['page_id'],'page_name'=>$_smarty_tpl->tpl_vars['page_info']->value['pageName'],'drilldown'=>'y'),$_smarty_tpl);?>

	<?php }?>
	</div>
</div>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/poll.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d266cd05_74066897')) {function content_567b58d266cd05_74066897($_smarty_tpl) {?><?php if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
?><?php if (count($_smarty_tpl->tpl_vars['ratings']->value)&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_ratings']->value=='y'){?>
	<div style="display:inline;float:right;padding: 1px 3px; border:1px solid #666666; -moz-border-radius : 10px;font-size:.8em;">
		<div id="pollopen">
			<?php echo smarty_function_button(array('href'=>"#",'_onclick'=>"show('pollzone');hide('polledit');hide('pollopen');return false;",'class'=>"link",'_text'=>"Rating"),$_smarty_tpl);?>

		</div>
		<?php if ($_smarty_tpl->tpl_vars['tiki_p_wiki_vote_ratings']->value=='y'){?>
			<div id="polledit">
				<div class="pollnav">
					<?php echo smarty_function_button(array('href'=>"#",'_onclick'=>"hide('pollzone');hide('polledit');show('pollopen');return false;",'_text'=>"[-]"),$_smarty_tpl);?>

					<?php echo smarty_function_button(array('href'=>"#",'_onclick'=>"show('pollzone');hide('polledit');hide('pollopen');return false;",'class'=>"link",'_text'=>"View"),$_smarty_tpl);?>

				</div>
				
				<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ratings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
					<?php if ($_smarty_tpl->tpl_vars['r']->value['title']){?>
						<div><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['r']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
					<?php }?>
					<form method="post" action="tiki-index.php">
						<?php if ($_smarty_tpl->tpl_vars['page']->value){?>
							<input type="hidden" name="wikipoll" value="1">
							<input type="hidden" name="page" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value, ENT_QUOTES, 'UTF-8', true);?>
">
						<?php }?>
						<input type="hidden" name="polls_pollId" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['r']->value['info']['pollId'], ENT_QUOTES, 'UTF-8', true);?>
">
						<table>
							<?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['r']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
?>
								<tr>
									<td valign="top" <?php if ($_smarty_tpl->tpl_vars['r']->value['vote']==$_smarty_tpl->tpl_vars['option']->value['optionId']){?>class="highlight"<?php }?>>
										<input type="radio" name="polls_optionId" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['optionId'], ENT_QUOTES, 'UTF-8', true);?>
" id="poll<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['r']->value['info']['pollId'], ENT_QUOTES, 'UTF-8', true);?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['optionId'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['r']->value['vote']==$_smarty_tpl->tpl_vars['option']->value['optionId']){?> checked="checked"<?php }?>>
									</td>
									<td valign="top" <?php if ($_smarty_tpl->tpl_vars['r']->value['vote']==$_smarty_tpl->tpl_vars['option']->value['optionId']){?>class="highlight"<?php }?>> 
										<label for="poll<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['r']->value['info']['pollId'], ENT_QUOTES, 'UTF-8', true);?>
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['optionId'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</label>
									</td>
									<td valign="top" <?php if ($_smarty_tpl->tpl_vars['r']->value['vote']==$_smarty_tpl->tpl_vars['option']->value['optionId']){?>class="highlight"<?php }?>>
										(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['votes'], ENT_QUOTES, 'UTF-8', true);?>
)
									</td>
								</tr>
							<?php } ?>
						</table>
						<div align="center">
							<input type="submit" class="btn btn-default" name="pollVote" value="vote" style="border:1px solid #666666;font-size:.8em;">
						</div>
					</form>
				<?php } ?>
			</div>
			<div id="pollzone">
				<div class="pollnav">
					<?php echo smarty_function_button(array('href'=>"#",'_onclick'=>"hide('pollzone');hide('polledit');show('pollopen');return false;",'_text'=>"[-]"),$_smarty_tpl);?>

					<?php echo smarty_function_button(array('href'=>"#",'_onclick'=>"hide('pollzone');show('polledit');hide('pollopen');return false;",'_text'=>"Vote"),$_smarty_tpl);?>

				</div>
				<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ratings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
					<div>
						<?php if ($_smarty_tpl->tpl_vars['r']->value['title']){?>
							<div><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['r']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
						<?php }?>
						<?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['r']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
?>
							<div><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['votes'], ENT_QUOTES, 'UTF-8', true);?>
 : <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php }else{ ?>
			<div id="pollzone">
				<div class="pollnav">
					<?php echo smarty_function_button(array('href'=>"#",'_onclick'=>"hide('pollzone');hide('polledit');show('pollopen');return false;",'_text'=>"[-]"),$_smarty_tpl);?>

				</div>
				<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ratings']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
					<div>
						<?php if ($_smarty_tpl->tpl_vars['r']->value['title']){?>
							<div><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['r']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
						<?php }?>
						<?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['r']->value['options']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value){
$_smarty_tpl->tpl_vars['option']->_loop = true;
?>
							<div><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['votes'], ENT_QUOTES, 'UTF-8', true);?>
 : <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value['title'], ENT_QUOTES, 'UTF-8', true);?>
</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php }?>
	</div>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-wiki_structure_bar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d27e9fb0_31218111')) {function content_567b58d27e9fb0_31218111($_smarty_tpl) {?><?php if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_sefurl')) include 'lib/smarty_tiki/function.sefurl.php';
if (!is_callable('smarty_function_autocomplete')) include 'lib/smarty_tiki/function.autocomplete.php';
if (!is_callable('smarty_modifier_pagename')) include 'lib/smarty_tiki/modifier.pagename.php';
if (!is_callable('smarty_function_menu')) include 'lib/smarty_tiki/function.menu.php';
?><div class="tocnav">
	<div class="clearfix">
		<div style="float: left; width: 100px">
  
    <?php if ($_smarty_tpl->tpl_vars['home_info']->value){?><?php if ($_smarty_tpl->tpl_vars['home_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['home_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['home_info']->value['pageName'], null, 0);?><?php }?>
    	<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('page'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'])); $_block_repeat=true; echo smarty_block_self_link(array('page'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smarty_function_icon(array('_id'=>'house','alt'=>"TOC",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('page'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['prev_info']->value&&$_smarty_tpl->tpl_vars['prev_info']->value['page_ref_id']){?><?php if ($_smarty_tpl->tpl_vars['prev_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['prev_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['prev_info']->value['pageName'], null, 0);?><?php }?>
    	<a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['prev_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['prev_info']->value['page_ref_id']),$_smarty_tpl);?>
">
    		<?php echo smarty_function_icon(array('_id'=>'resultset_previous','alt'=>"Previous page",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
</a>
    <?php }else{ ?>
    	<img src="img/icons/8.gif" alt="" height="1" width="8px">
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['parent_info']->value){?><?php if ($_smarty_tpl->tpl_vars['parent_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['parent_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['parent_info']->value['pageName'], null, 0);?><?php }?>
    	<a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['parent_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['parent_info']->value['page_ref_id']),$_smarty_tpl);?>
">
    		<?php echo smarty_function_icon(array('_id'=>'resultset_up','alt'=>"Parent page",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
</a>
    <?php }else{ ?>
    	<img src="img/icons/8.gif" alt="" height="1" width="8px">
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['next_info']->value&&$_smarty_tpl->tpl_vars['next_info']->value['page_ref_id']){?><?php if ($_smarty_tpl->tpl_vars['next_info']->value['page_alias']){?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['next_info']->value['page_alias'], null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['icon_title'] = new Smarty_variable($_smarty_tpl->tpl_vars['next_info']->value['pageName'], null, 0);?><?php }?><a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['next_info']->value['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['next_info']->value['page_ref_id']),$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('_id'=>'resultset_next','alt'=>"Next page",'title'=>$_smarty_tpl->tpl_vars['icon_title']->value),$_smarty_tpl);?>
</a><?php }else{ ?><img src="img/icons/8.gif" alt="" height="1px" width="8px"><?php }?>

		</div>
  		<div style="float: left;">
<?php if ($_smarty_tpl->tpl_vars['struct_editable']->value=='y'){?>
	<form action="tiki-editpage.php" method="post">
		<div class="form">
			<input type="hidden" name="current_page_id" value="<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
">
			<input type="text" id="structure_add_page" name="page">
			<?php echo smarty_function_autocomplete(array('element'=>'#structure_add_page','type'=>'pagename'),$_smarty_tpl);?>

			
			<?php if ($_smarty_tpl->tpl_vars['page_info']->value&&!$_smarty_tpl->tpl_vars['parent_info']->value){?>
				<input type="hidden" name="add_child" value="checked"> 
			<?php }else{ ?>
				<input type="checkbox" name="add_child"> Child
			<?php }?>      
			<input type="submit" class="btn btn-default" name="insert_into_struct" value="Add Page">
		</div>
	</form>
	</div>
	</div>
	<div>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('_script'=>"tiki-edit_structure.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'],'_alt'=>"Structure",'_title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")")); $_block_repeat=true; echo smarty_block_self_link(array('_script'=>"tiki-edit_structure.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'],'_alt'=>"Structure",'_title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo smarty_function_icon(array('_id'=>'chart_organisation','alt'=>"Structure",'title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")"),$_smarty_tpl);?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('_script'=>"tiki-edit_structure.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['home_info']->value['page_ref_id'],'_alt'=>"Structure",'_title'=>"Structure (".((string)$_smarty_tpl->tpl_vars['cur_pos']->value).")"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
&nbsp;&nbsp;
<?php }else{ ?>
		</div>
<?php }?>
	    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['structure_path']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['name'] = 'ix';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['total']);
?>
	      <?php if ($_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['parent_id']){?>&nbsp;<?php echo $_smarty_tpl->tpl_vars['prefs']->value['site_crumb_seper'];?>
&nbsp;<?php }?>
		  <a href="<?php echo smarty_function_sefurl(array('page'=>$_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName'],'structure'=>$_smarty_tpl->tpl_vars['home_info']->value['pageName'],'page_ref_id'=>$_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['page_ref_id']),$_smarty_tpl);?>
">
	      <?php if ($_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['page_alias']){?>
	        <?php echo $_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['page_alias'];?>

		  <?php }else{ ?>
	        <?php echo smarty_modifier_pagename($_smarty_tpl->tpl_vars['structure_path']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['stripped_pageName']);?>

		  <?php }?>
		  </a>
		<?php endfor; endif; ?>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_structure_drilldownmenu']=='y'){?>
		<?php echo smarty_function_menu(array('structureId'=>$_smarty_tpl->tpl_vars['page_info']->value['structure_id'],'page_id'=>$_smarty_tpl->tpl_vars['page_info']->value['page_id'],'page_name'=>$_smarty_tpl->tpl_vars['page_info']->value['pageName'],'drilldown'=>'y'),$_smarty_tpl);?>

	<?php }?>
	</div>
</div>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/wiki_authors.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d2ac7376_70686874')) {function content_567b58d2ac7376_70686874($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_userlink')) include 'lib/smarty_tiki/modifier.userlink.php';
if (!is_callable('smarty_modifier_tiki_long_datetime')) include 'lib/smarty_tiki/modifier.tiki_long_datetime.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
?><?php if ($_smarty_tpl->tpl_vars['wiki_authors_style']->value=='business'){?>
	Last edited by <?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value);?>

	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['author'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['author']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['name'] = 'author';
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['contributors']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total']);
?>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['author']['first']){?>
			, based on work by
		<?php }else{ ?>
			<?php if (!$_smarty_tpl->getVariable('smarty')->value['section']['author']['last']){?>
				,
			<?php }else{ ?>
				and
			<?php }?>
		<?php }?>
		<?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['contributors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['author']['index']]);?>

	<?php endfor; endif; ?>.
	<br>
	Page last modified on <?php echo smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value);?>
. <?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_show_version']=='y'){?>(Version <?php echo $_smarty_tpl->tpl_vars['lastVersion']->value;?>
)<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['revision_approval_info']->value){?>
		<br>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif']))); $_block_repeat=true; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif'])), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Page approved by %0 on %1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif'])), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
<?php }elseif($_smarty_tpl->tpl_vars['wiki_authors_style']->value=='collaborative'){?>
	Contributors to this page: <?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value);?>

	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['author'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['author']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['name'] = 'author';
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['contributors']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['author']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['author']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['author']['total']);
?>
		<?php if (!$_smarty_tpl->getVariable('smarty')->value['section']['author']['last']){?>
			,
		<?php }else{ ?> 
			and
		<?php }?>
		<?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['contributors']->value[$_smarty_tpl->getVariable('smarty')->value['section']['author']['index']]);?>

	<?php endfor; endif; ?>.
	<br>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value),'_1'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value))); $_block_repeat=true; echo smarty_block_tr(array('_0'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value),'_1'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Page last modified on %0 by %1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value),'_1'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
. 
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_show_version']=='y'){?>
		(Version <?php echo $_smarty_tpl->tpl_vars['lastVersion']->value;?>
)
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['revision_approval_info']->value){?>
		<br>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif']))); $_block_repeat=true; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif'])), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Page approved by %0 on %1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif'])), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>

<?php }elseif($_smarty_tpl->tpl_vars['wiki_authors_style']->value=='lastmodif'){?>
	Page last modified on <?php echo smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value);?>

<?php }else{ ?>
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['creator']->value))); $_block_repeat=true; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['creator']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Created by %0<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['creator']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
.
	<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value),'_1'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value))); $_block_repeat=true; echo smarty_block_tr(array('_0'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value),'_1'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value)), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Last Modification: %0 by %1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['lastModif']->value),'_1'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['lastUser']->value)), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
. 
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_show_version']=='y'){?>
		(Version <?php echo $_smarty_tpl->tpl_vars['lastVersion']->value;?>
)
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['revision_approval_info']->value){?>
		<br>
		<?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif']))); $_block_repeat=true; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif'])), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Page approved by %0 on %1<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array('_0'=>smarty_modifier_userlink($_smarty_tpl->tpl_vars['revision_approval_info']->value['user']),'_1'=>smarty_modifier_tiki_long_datetime($_smarty_tpl->tpl_vars['revision_approval_info']->value['lastModif'])), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

	<?php }?>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/show_copyright.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d2cfa684_89818851')) {function content_567b58d2cfa684_89818851($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_feature_copyrights']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wikiLicensePage']){?>
	<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wikiLicensePage']==$_smarty_tpl->tpl_vars['page']->value){?>
		<?php if ($_smarty_tpl->tpl_vars['tiki_p_edit_copyrights']->value=='y'){?>
			<br>
			To edit the copyright notices <a href="copyrights.php?page=<?php echo $_smarty_tpl->tpl_vars['copyrightpage']->value;?>
">Click Here</a>.
		<?php }?>
	<?php }else{ ?>
		<br>
		The content on this page is licensed under the terms of the <a href="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['prefs']->value['wikiLicensePage'],'wiki','with_next');?>
copyrightpage=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
"><?php echo $_smarty_tpl->tpl_vars['prefs']->value['wikiLicensePage'];?>
</a>.
	<?php }?>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/category_related_objects.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d2e2b2f8_25827069')) {function content_567b58d2e2b2f8_25827069($_smarty_tpl) {?>
<?php if (!empty($_smarty_tpl->tpl_vars['category_related_objects']->value)){?>
<div class="related">
	<h4>Related content</h4>
	<ul>
	<?php  $_smarty_tpl->tpl_vars['object'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['object']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category_related_objects']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['object']->key => $_smarty_tpl->tpl_vars['object']->value){
$_smarty_tpl->tpl_vars['object']->_loop = true;
?>
		<li><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object']->value['href'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['object']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
</a></li>
	<?php } ?>
	</ul>
</div>
<?php }?>
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:42
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-wiki_topline.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d2e5bd11_60691879')) {function content_567b58d2e5bd11_60691879($_smarty_tpl) {?><?php if (!is_callable('smarty_function_breadcrumbs')) include 'lib/smarty_tiki/function.breadcrumbs.php';
if (!is_callable('smarty_function_query')) include 'lib/smarty_tiki/function.query.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_block_ajax_href')) include 'lib/smarty_tiki/block.ajax_href.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_modifier_truncate')) include 'lib/smarty_tiki/modifier.truncate.php';
?><div class="wikitopline clearfix" style="clear: both;">
	<div class="content">
		<?php if (!isset($_smarty_tpl->tpl_vars['hide_page_header']->value)||!$_smarty_tpl->tpl_vars['hide_page_header']->value){?>
			<div class="wikiinfo" style="float: left">
				<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_page_name_above']=='y'&&$_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
				    <a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
" class="titletop" title="refresh"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_pageid']=='y'&&$_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
					<small><a class="link" href="tiki-index.php?page_id=<?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
">page id: <?php echo $_smarty_tpl->tpl_vars['page_id']->value;?>
</a></small>
				<?php }?>
				
				<?php echo smarty_function_breadcrumbs(array('type'=>"desc",'loc'=>"page",'crumbs'=>$_smarty_tpl->tpl_vars['crumbs']->value),$_smarty_tpl);?>

				
				<?php if ($_smarty_tpl->tpl_vars['cached_page']->value=='y'){?><span class="cachedStatus">(Cached)</span><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['is_categorized']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categories']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_categorypath']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_view_category']->value=='y'){?>
					<?php echo $_smarty_tpl->tpl_vars['display_catpath']->value;?>

				<?php }?>
			</div>

			<?php if (!isset($_smarty_tpl->tpl_vars['versioned']->value)){?>
				<?php if ($_smarty_tpl->tpl_vars['print_page']->value!='y'){?>
					<div class="wikiactions" style="float: right; padding-left:10px; white-space: nowrap">
						<div class="icons" style="float: left;">
							<?php if ($_smarty_tpl->tpl_vars['pdf_export']->value=='y'){?>
								<a href="tiki-print.php?<?php echo smarty_function_query(array('display'=>"pdf",'page'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
" title="PDF"><?php echo smarty_function_icon(array('_id'=>'page_white_acrobat','alt'=>"PDF"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['flaggedrev_approval']!='y'||!$_smarty_tpl->tpl_vars['revision_approval']->value||$_smarty_tpl->tpl_vars['lastVersion']->value==$_smarty_tpl->tpl_vars['revision_displayed']->value){?>
								<?php if ($_smarty_tpl->tpl_vars['editable']->value&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')&&$_smarty_tpl->tpl_vars['beingEdited']->value!='y'&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
									<a title="Edit this page" <?php $_smarty_tpl->smarty->_tag_stack[] = array('ajax_href', array('template'=>"tiki-editpage.tpl")); $_block_repeat=true; echo smarty_block_ajax_href(array('template'=>"tiki-editpage.tpl"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
tiki-editpage.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
<?php if (!empty($_smarty_tpl->tpl_vars['page_ref_id']->value)&&$_smarty_tpl->tpl_vars['needsStaging']->value!='y'){?>&amp;page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_ref_id']->value;?>
<?php }?><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_ajax_href(array('template'=>"tiki-editpage.tpl"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
><?php echo smarty_function_icon(array('_id'=>'page_edit','alt'=>"Edit this page"),$_smarty_tpl);?>
</a>
									<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_edit_icons_toggle']=='y'&&($_smarty_tpl->tpl_vars['prefs']->value['wiki_edit_plugin']=='y'||$_smarty_tpl->tpl_vars['prefs']->value['wiki_edit_section']=='y')){?>
										<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

											$("#wiki_plugin_edit_view").click( function () {
												var src = $("#wiki_plugin_edit_view img").attr("src");
												if (src.indexOf("wiki_plugin_edit_view") > -1) {
													$(".editplugin, .icon_edit_section").show();
													$("#wiki_plugin_edit_view img").attr("src", src.replace("wiki_plugin_edit_view", "wiki_plugin_edit_hide"));
													setCookieBrowser("wiki_plugin_edit_view", true);
												} else {
													$(".editplugin, .icon_edit_section").hide();
													$("#wiki_plugin_edit_view img").attr("src", src.replace("wiki_plugin_edit_hide", "wiki_plugin_edit_view"));
													deleteCookie("wiki_plugin_edit_view");
												}
												return false;
											});
											if (!getCookie("wiki_plugin_edit_view")) {$(".editplugin, .icon_edit_section").hide(); } else { $("#wiki_plugin_edit_view").click(); }
										<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

										<a title="View edit icons" href="#" id="wiki_plugin_edit_view"><?php echo smarty_function_icon(array('_id'=>'wiki_plugin_edit_view','title'=>"View edit icons"),$_smarty_tpl);?>
</a>
									<?php }?>
								<?php }?>
								<?php if (($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_edit_inline']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')&&$_smarty_tpl->tpl_vars['beingEdited']->value!='y'&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
									<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wysiwyg_inline_editing']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_wysiwyg']=='y'){?>
										<?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

											$("#wysiwyg_inline_edit").click( function () {
												var src = $("#wysiwyg_inline_edit img").attr("src");
												if (src.indexOf("page.png") > -1) {
													if (enableWysiwygInlineEditing()) {
														$("#wysiwyg_inline_edit img").attr("src", src.replace("page.png", "page_lightning.png"));
													}
												} else {
													if (disableWyiswygInlineEditing()) {
														$("#wysiwyg_inline_edit img").attr("src", src.replace("page_lightning.png", "page.png"));
													}
												}
												return false;
											});
											if (getCookie("wysiwyg_inline_edit", "preview")) { $("#wysiwyg_inline_edit").click(); }
										<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

										<a title="Inline Edit" href="#" id="wysiwyg_inline_edit"><?php echo smarty_function_icon(array('_id'=>'page','title'=>"Inline Edit"),$_smarty_tpl);?>
</a>
									<?php }?>
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_morcego']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_feature_3d']=='y'){?>
								<a title="3d browser" href="javascript:wiki3d_open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value, ENT_QUOTES, 'UTF-8', true);?>
',<?php echo $_smarty_tpl->tpl_vars['prefs']->value['wiki_3d_width'];?>
, <?php echo $_smarty_tpl->tpl_vars['prefs']->value['wiki_3d_height'];?>
)"><?php echo smarty_function_icon(array('_id'=>'wiki3d','alt'=>"3d browser"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['cached_page']->value=='y'){?>
								<a title="Refresh" href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;refresh=1"><?php echo smarty_function_icon(array('_id'=>'arrow_refresh'),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_print']=='y'){?>
								<a title="Print" href="tiki-print.php?<?php echo smarty_function_query(array('_keepall'=>'y'),$_smarty_tpl);?>
"><?php echo smarty_function_icon(array('_id'=>'printer','alt'=>"Print"),$_smarty_tpl);?>
</a>
							<?php }?>
					
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_share']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_share']->value=='y'){?>
								<a title="Share this page" href="tiki-share.php?url=<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
"><?php echo smarty_function_icon(array('_id'=>'share_link','alt'=>"Share this page"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_tell_a_friend']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_tell_a_friend']->value=='y'){?>
								<a title="Send a link" href="tiki-tell_a_friend.php?url=<?php echo rawurlencode($_SERVER['REQUEST_URI']);?>
"><?php echo smarty_function_icon(array('_id'=>'email_link','alt'=>"Send a link"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['user']->value)&&$_smarty_tpl->tpl_vars['prefs']->value['feature_notepad']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_notepad']->value=='y'){?>
								<a title="Save to notepad" href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;savenotepad=1<?php if (!empty($_smarty_tpl->tpl_vars['page_ref_id']->value)){?>&amp;page_ref_id=<?php echo $_smarty_tpl->tpl_vars['page_ref_id']->value;?>
<?php }?>"><?php echo smarty_function_icon(array('_id'=>'disk','alt'=>"Save to notepad"),$_smarty_tpl);?>
</a>
							<?php }?>
							<?php if (!empty($_smarty_tpl->tpl_vars['user']->value)&&$_smarty_tpl->tpl_vars['prefs']->value['feature_user_watches']=='y'){?>
								<?php if ($_smarty_tpl->tpl_vars['user_watching_page']->value=='n'){?>
									<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=wiki_page_changed&amp;watch_object=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_action=add<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'){?>&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
<?php }?>" class="icon"><?php echo smarty_function_icon(array('_id'=>'eye','alt'=>"Page is NOT being monitored. Click icon to START monitoring."),$_smarty_tpl);?>
</a>
								<?php }else{ ?>
									<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=wiki_page_changed&amp;watch_object=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_action=remove<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'){?>&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
<?php }?>" class="icon"><?php echo smarty_function_icon(array('_id'=>'no_eye','alt'=>"Page IS being monitored. Click icon to STOP monitoring."),$_smarty_tpl);?>
</a>
								<?php }?>
								<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_watch_structure']->value=='y'){?>
									<?php if ($_smarty_tpl->tpl_vars['user_watching_structure']->value!='y'){?>
										<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=structure_changed&amp;watch_object=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
&amp;watch_action=add_desc&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
"><?php echo smarty_function_icon(array('_id'=>'eye_arrow_down','alt'=>"Monitor the Sub-Structure"),$_smarty_tpl);?>
</a>
									<?php }else{ ?>
										<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=structure_changed&amp;watch_object=<?php echo $_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'];?>
&amp;watch_action=remove_desc&amp;structure=<?php echo rawurlencode($_smarty_tpl->tpl_vars['home_info']->value['pageName']);?>
"><?php echo smarty_function_icon(array('_id'=>'no_eye_arrow_down','alt'=>"Stop Monitoring the Sub-Structure"),$_smarty_tpl);?>
</a>
									<?php }?>
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_group_watches']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_admin_users']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')){?>
								<a href="tiki-object_watches.php?objectId=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;watch_event=wiki_page_changed&amp;objectType=wiki+page&amp;objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;objectHref=<?php echo rawurlencode(('tiki-index.php?page=').($_smarty_tpl->tpl_vars['page']->value));?>
" class="icon"><?php echo smarty_function_icon(array('_id'=>'eye_group','alt'=>"Group Monitor"),$_smarty_tpl);?>
</a>
					
								<?php if ($_smarty_tpl->tpl_vars['structure']->value=='y'){?>
									<a href="tiki-object_watches.php?objectId=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page_info']->value['page_ref_id']);?>
&amp;watch_event=structure_changed&amp;objectType=structure&amp;objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
&amp;objectHref=<?php echo rawurlencode(('tiki-index.php?page_ref_id=').($_smarty_tpl->tpl_vars['page_ref_id']->value));?>
" class="icon"><?php echo smarty_function_icon(array('_id'=>'eye_group_arrow_down','alt'=>"Group Monitor on Structure"),$_smarty_tpl);?>
</a>
								<?php }?>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_backlinks']=='y'&&$_smarty_tpl->tpl_vars['backlinks']->value&&$_smarty_tpl->tpl_vars['tiki_p_view_backlink']->value=='y'){?>
								<div class="backlinks_button">
									<ul class="clearfix cssmenu_horiz">
										<li class="tabmark">
											<?php echo smarty_function_icon(array('_id'=>'arrow_turn_left','title'=>"Backlinks",'class'=>"icon"),$_smarty_tpl);?>

											<ul class="backlinks_poppedup">
												<li class="tabcontent">
													<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['back'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['back']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['name'] = 'back';
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['backlinks']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['back']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['back']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['back']['total']);
?>
													<a href="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'],'wiki');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'], ENT_QUOTES, 'UTF-8', true);?>
">
														<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_backlinks_name_len']>='1'){?><?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'],$_smarty_tpl->tpl_vars['prefs']->value['wiki_backlinks_name_len'],"...",true), ENT_QUOTES, 'UTF-8', true);?>
<?php }else{ ?><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['backlinks']->value[$_smarty_tpl->getVariable('smarty')->value['section']['back']['index']]['fromPage'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>
													</a>
													<?php endfor; endif; ?>
												</li>
											</ul>
										</li>
									</ul>
								</div>		
							<?php }?>
							<?php if (($_smarty_tpl->tpl_vars['structure']->value=='y'&&count($_smarty_tpl->tpl_vars['showstructs']->value)>1)||($_smarty_tpl->tpl_vars['structure']->value=='n'&&count($_smarty_tpl->tpl_vars['showstructs']->value)!=0)){?>
								<div class="structure_select">
									<ul class="clearfix cssmenu_horiz">
										<li class="tabmark">
											<?php echo smarty_function_icon(array('_id'=>'chart_organisation','title'=>"Structures",'class'=>"icon"),$_smarty_tpl);?>

											<ul class="structure_poppedup">
												<li class="tabcontent">
													<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['struct'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['name'] = 'struct';
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['showstructs']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['struct']['total']);
?>
														<a href="tiki-index.php?page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&structure=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName']==$_smarty_tpl->tpl_vars['structure_path']->value[0]['pageName']){?> title="Current structure: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
" class="selected" <?php }else{ ?> title="Show structure: <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
"<?php }?>>
															<?php if ($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['page_alias']){?>														
																<?php echo $_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['page_alias'];?>

															<?php }else{ ?>
																<?php echo $_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName'];?>

															<?php }?>
														</a>
													<?php endfor; endif; ?>
													<?php if ($_smarty_tpl->tpl_vars['showstructs']->value[$_smarty_tpl->getVariable('smarty')->value['section']['struct']['index']]['pageName']!=$_smarty_tpl->tpl_vars['structure_path']->value[0]['pageName']){?>
														<a href="tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
" title="Hide structure bar">
															Hide structure
														</a>
													<?php }?>	
												</li>
											</ul>
										</li>
									</ul>
								</div>
							<?php }?>
							<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_multilingual']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['show_available_translations']=='y'&&$_smarty_tpl->tpl_vars['machine_translate_to_lang']->value==''){?>
								<div class="lang_select">
									<?php /*  Call merged included template "translated-lang.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('translated-lang.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('object_type'=>'wiki page'), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d182cbd8_98957277($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "translated-lang.tpl" */?>
								</div>
							<?php }?>
						</div><!-- END of icons -->
					</div> 
				<?php }?> 
			<?php }?>
		<?php }?> 
	</div> 
</div> 
<?php }} ?><?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:43
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-page_bar.tpl" */ ?>
<?php if ($_valid && !is_callable('content_567b58d32c0c41_29538737')) {function content_567b58d32c0c41_29538737($_smarty_tpl) {?><?php if (!is_callable('smarty_function_favorite')) include 'lib/smarty_tiki/function.favorite.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_block_self_link')) include 'lib/smarty_tiki/block.self_link.php';
if (!is_callable('smarty_block_jq')) include 'lib/smarty_tiki/block.jq.php';
if (!is_callable('smarty_function_service')) include 'lib/smarty_tiki/function.service.php';
if (!is_callable('smarty_block_tr')) include 'lib/smarty_tiki/block.tr.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_modifier_regex_replace')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/modifier.regex_replace.php';
if (!is_callable('smarty_function_attachments')) include 'lib/smarty_tiki/function.attachments.php';
?>
<?php if (!isset($_smarty_tpl->tpl_vars['versioned']->value)||!$_smarty_tpl->tpl_vars['versioned']->value){?>
	<?php $_smarty_tpl->_capture_stack[0][] = array('default', 'page_bar', null); ob_start(); ?><?php echo smarty_function_favorite(array('type'=>"wiki page",'object'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
<?php if ($_smarty_tpl->tpl_vars['edit_page']->value!='y'){?><?php if (((isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')=='sandbox')||(!$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_encourage_contribution']=='y'))||$_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'){?><?php if (isset($_smarty_tpl->tpl_vars['beingEdited']->value)&&$_smarty_tpl->tpl_vars['beingEdited']->value=='y'){?><?php $_smarty_tpl->tpl_vars['thisPageClass'] = new Smarty_variable('+highlight', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['thisPageClass'] = new Smarty_variable('', null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['flaggedrev_approval']!='y'||!$_smarty_tpl->tpl_vars['revision_approval']->value||$_smarty_tpl->tpl_vars['lastVersion']->value==$_smarty_tpl->tpl_vars['revision_displayed']->value){?><?php if (isset($_smarty_tpl->tpl_vars['page_ref_id']->value)){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-editpage.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'page_ref_id'=>$_smarty_tpl->tpl_vars['page_ref_id']->value,'_class'=>$_smarty_tpl->tpl_vars['thisPageClass']->value,'_text'=>"Edit this page"),$_smarty_tpl);?>
<?php }else{ ?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-editpage.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_class'=>$_smarty_tpl->tpl_vars['thisPageClass']->value,'_text'=>"Edit this page"),$_smarty_tpl);?>
<?php }?><?php }elseif($_smarty_tpl->tpl_vars['tiki_p_wiki_view_latest']->value=='y'){?><span class="btn btn-default button"><?php $_smarty_tpl->smarty->_tag_stack[] = array('self_link', array('latest'=>1)); $_block_repeat=true; echo smarty_block_self_link(array('latest'=>1), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
View latest version before editing<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_self_link(array('latest'=>1), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
</span><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_source']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_source']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-pagehistory.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'source'=>"0",'_text'=>"Source"),$_smarty_tpl);?>
<?php }?><?php if (mb_strtolower($_smarty_tpl->tpl_vars['page']->value, 'UTF-8')!='sandbox'){?><?php if ($_smarty_tpl->tpl_vars['tiki_p_remove']->value=='y'&&(isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-removepage.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'version'=>"last",'_text'=>"Remove"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_rename']->value=='y'&&(isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-rename_page.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Rename"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_usrlock']=='y'&&$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['tiki_p_lock']->value=='y'){?><?php if (!$_smarty_tpl->tpl_vars['lock']->value){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'action'=>"lock",'_text'=>"Lock"),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'||$_smarty_tpl->tpl_vars['user']->value==$_smarty_tpl->tpl_vars['page_user']->value){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'action'=>"unlock",'_text'=>"Unlock"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_assign_perm_wiki_page']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-objectpermissions.php",'objectId'=>$_smarty_tpl->tpl_vars['page']->value,'objectName'=>$_smarty_tpl->tpl_vars['page']->value,'objectType'=>"wiki+page",'permType'=>"wiki",'_text'=>"Permissions"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_history']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_history']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-pagehistory.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"History"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_page_contribution']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_page_contribution_view']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-page_contribution.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Contributions by author"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_likePages']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_similar']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-likepages.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Similar"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_undo']=='y'&&$_smarty_tpl->tpl_vars['canundo']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'undo'=>"1",'_text'=>"Undo"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_make_structure']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_edit_structures']->value=='y'&&(isset($_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['editable']->value)&&$_smarty_tpl->tpl_vars['structure']->value=='n'&&count($_smarty_tpl->tpl_vars['showstructs']->value)==0){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-index.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'convertstructure'=>"1",'_text'=>"Make Structure"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_slideshow']=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_uses_slides']=='y'){?><?php if ($_smarty_tpl->tpl_vars['show_slideshow']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"./tiki-slideshow.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Slideshow"),$_smarty_tpl);?>
<?php }elseif($_smarty_tpl->tpl_vars['structure']->value=='y'){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-slideshow2.php",'page_ref_id'=>$_smarty_tpl->tpl_vars['page_info']->value['page_ref_id'],'_text'=>"Slideshow"),$_smarty_tpl);?>
<?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_export']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_export_wiki']->value=='y')){?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-export_wiki_pages.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Export"),$_smarty_tpl);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_discuss']=='y'&&$_smarty_tpl->tpl_vars['show_page']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_forum_post']->value=='y'){?><?php $_smarty_tpl->_capture_stack[0][] = array('default', 'wiki_discussion_string', null); ob_start(); ?><?php /*  Call merged included template "wiki-discussion.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('wiki-discussion.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1d22935_20098918($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "wiki-discussion.tpl" */?> [tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
|<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
]<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?><?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-view_forum.php",'forumId'=>$_smarty_tpl->tpl_vars['prefs']->value['wiki_forum_id'],'comments_postComment'=>"post",'comments_title'=>$_smarty_tpl->tpl_vars['page']->value,'comments_data'=>$_smarty_tpl->tpl_vars['wiki_discussion_string']->value,'comment_topictype'=>"n",'_text'=>"Discuss"),$_smarty_tpl);?>
<?php }?><?php if (isset($_smarty_tpl->tpl_vars['show_page']->value)&&$_smarty_tpl->tpl_vars['show_page']->value=='y'){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_comments']=='y'&&($_smarty_tpl->tpl_vars['prefs']->value['wiki_comments_allow_per_page']=='n'||$_smarty_tpl->tpl_vars['info']->value['comments_enabled']=='y')&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_comments']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_read_comments']->value=='y'){?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_comments_displayed_default']=='y'){?><?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							var id = '#comment-container';
							$(id).comment_load('tiki-ajax_services.php?controller=comment&action=list&type=wiki+page&objectId=<?php echo rawurlencode($_smarty_tpl->tpl_vars['page']->value);?>
#comment-container');
							<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><span class="btn btn-default button"><a id="comment-toggle" href="<?php echo smarty_function_service(array('controller'=>'comment','action'=>'list','type'=>"wiki page",'objectId'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl);?>
#comment-container">Comments<?php if ($_smarty_tpl->tpl_vars['count_comments']->value){?>&nbsp;(<span class="count_comments"><?php echo $_smarty_tpl->tpl_vars['count_comments']->value;?>
</span>)<?php }?></a></span><?php $_smarty_tpl->smarty->_tag_stack[] = array('jq', array()); $_block_repeat=true; echo smarty_block_jq(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

							$('#comment-toggle').comment_toggle();
						<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_jq(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_attachments']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='y'&&(isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)>0)||$_smarty_tpl->tpl_vars['tiki_p_wiki_attach_files']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='y')){?><?php if (isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)>0){?><?php $_smarty_tpl->tpl_vars['thisbuttonclass'] = new Smarty_variable('highlight', null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['thisbuttonclass'] = new Smarty_variable('', null, 0);?><?php }?><?php $_smarty_tpl->_capture_stack[0][] = array('default', 'thistext', null); ob_start(); ?><?php if ((!isset($_smarty_tpl->tpl_vars['atts']->value)||count($_smarty_tpl->tpl_vars['atts']->value)==0)||$_smarty_tpl->tpl_vars['tiki_p_wiki_attach_files']->value=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='n'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_admin_attachments']->value=='n'){?>Attach File<?php }elseif(isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)==1){?>1 File Attached<?php }else{ ?><?php $_smarty_tpl->smarty->_tag_stack[] = array('tr', array()); $_block_repeat=true; echo smarty_block_tr(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo count($_smarty_tpl->tpl_vars['atts']->value);?>
 files attached<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tr(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }?>
						<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
						<?php if ((isset($_smarty_tpl->tpl_vars['atts']->value)&&count($_smarty_tpl->tpl_vars['atts']->value)>0)||$_smarty_tpl->tpl_vars['editable']->value){?>
							<?php ob_start();?><?php if (isset($_smarty_tpl->tpl_vars['pagemd5']->value)){?><?php echo (string)$_smarty_tpl->tpl_vars['pagemd5']->value;?><?php }?><?php $_tmp1=ob_get_clean();?><?php echo smarty_function_button(array('href'=>"#attachments",'_flip_id'=>"attzone".$_tmp1,'_class'=>$_smarty_tpl->tpl_vars['thisbuttonclass']->value,'_text'=>$_smarty_tpl->tpl_vars['thistext']->value,'_flip_default_open'=>$_smarty_tpl->tpl_vars['prefs']->value['w_displayed_default']),$_smarty_tpl);?>

						<?php }?>
					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_multilingual']=='y'&&($_smarty_tpl->tpl_vars['tiki_p_edit']->value=='y'||(!$_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_encourage_contribution']=='y'))&&!$_smarty_tpl->tpl_vars['lock']->value){?>
						<?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-edit_translation.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Translate"),$_smarty_tpl);?>

					<?php }?>

					<?php if ($_smarty_tpl->tpl_vars['tiki_p_admin_wiki']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['wiki_keywords']=='y'){?>
						<?php echo smarty_function_button(array('_keepall'=>'y','href'=>"tiki-admin_keywords.php",'page'=>$_smarty_tpl->tpl_vars['page']->value,'_text'=>"Keywords"),$_smarty_tpl);?>

					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['user']->value&&(isset($_smarty_tpl->tpl_vars['tiki_p_create_bookmarks']->value)&&$_smarty_tpl->tpl_vars['tiki_p_create_bookmarks']->value=='y')&&$_smarty_tpl->tpl_vars['prefs']->value['feature_user_bookmarks']=='y'){?>
						<?php ob_start();?><?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['page']->value);?>
<?php $_tmp2=ob_get_clean();?><?php ob_start();?><?php echo smarty_modifier_regex_replace(smarty_modifier_regex_replace($_SERVER['REQUEST_URI'],'/^[^\?\&]*/',''),'/(\?page=[^\&]+)/','');?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['urlurl'] = new Smarty_variable($_tmp2.$_tmp3, null, 0);?><?php echo smarty_function_button(array('_script'=>"tiki-user_bookmarks.php",'urlname'=>$_smarty_tpl->tpl_vars['page']->value,'urlurl'=>$_smarty_tpl->tpl_vars['urlurl']->value,'addurl'=>"Add",'_text'=>"Bookmark",'_auto_args'=>"urlname,urlurl,addurl"),$_smarty_tpl);?>

					<?php }?>
				<?php }?>
			<?php }?>
		<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

		<?php if ($_smarty_tpl->tpl_vars['page_bar']->value!=''){?>
			<div class="clearfix" id="page-bar">
				<?php echo $_smarty_tpl->tpl_vars['page_bar']->value;?>

			</div>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['wiki_extras']->value=='y'&&$_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_attachments']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_attachments']->value=='y'){?>
			<a name="attachments"></a>
			<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_use_fgal_for_wiki_attachments']=='y'){?>
				<?php echo smarty_function_attachments(array('_id'=>$_smarty_tpl->tpl_vars['page']->value,'_type'=>'wiki page'),$_smarty_tpl);?>

			<?php }else{ ?>
				<?php /*  Call merged included template "attachments.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('attachments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0, '1038668405567b58d10d4ec4-24702146');
content_567b58d1f1fc45_86923811($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); /*  End of included template "attachments.tpl" */?>
			<?php }?>
		<?php }?>

		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['feature_wiki_comments']=='y'&&$_smarty_tpl->tpl_vars['tiki_p_wiki_view_comments']->value=='y'&&$_smarty_tpl->tpl_vars['edit_page']->value!='y'){?>
			<div id="comment-container"></div>
		<?php }?>

	
<?php }?>
<?php }} ?>