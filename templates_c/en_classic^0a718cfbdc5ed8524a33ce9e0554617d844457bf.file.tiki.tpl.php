<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:24
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki.tpl" */ ?>
<?php /*%%SmartyHeaderCode:929838994567b58c03707e9-40109930%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a718cfbdc5ed8524a33ce9e0554617d844457bf' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki.tpl',
      1 => 1367250806,
      2 => 'file',
    ),
    'fb8cd626f88a68ddf6b267fcb8f1d5edb17715c6' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/layouts/classic/layout_view.tpl',
      1 => 1391098466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '929838994567b58c03707e9-40109930',
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
  'unifunc' => 'content_567b58c0843130_70300145',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c0843130_70300145')) {function content_567b58c0843130_70300145($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_body_attributes')) include 'lib/smarty_tiki/function.html_body_attributes.php';
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
												
	<!-- Legacy template, no support for title block -->

												
    <?php echo $_smarty_tpl->tpl_vars['mid_data']->value;?>


												
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
<?php }} ?>