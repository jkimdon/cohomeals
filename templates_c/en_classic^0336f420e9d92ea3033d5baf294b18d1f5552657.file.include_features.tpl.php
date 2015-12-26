<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:37:24
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/admin/include_features.tpl" */ ?>
<?php /*%%SmartyHeaderCode:771332317567b5a6493eb46-14683350%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0336f420e9d92ea3033d5baf294b18d1f5552657' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/admin/include_features.tpl',
      1 => 1431448690,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '771332317567b5a6493eb46-14683350',
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
  'unifunc' => 'content_567b5a64b8be81_09621790',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5a64b8be81_09621790')) {function content_567b5a64b8be81_09621790($_smarty_tpl) {?><?php if (!is_callable('smarty_block_remarksbox')) include 'lib/smarty_tiki/block.remarksbox.php';
if (!is_callable('smarty_block_tabset')) include 'lib/smarty_tiki/block.tabset.php';
if (!is_callable('smarty_block_tab')) include 'lib/smarty_tiki/block.tab.php';
if (!is_callable('smarty_function_preference')) include 'lib/smarty_tiki/function.preference.php';
if (!is_callable('smarty_function_service')) include 'lib/smarty_tiki/function.service.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>"tip",'title'=>"Tip")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Tip"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Please see the <a class='rbox-link' target='tikihelp' href='http://doc.tiki.org/Features'>evaluation of each feature</a> on Tiki's developer site.<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>"tip",'title'=>"Tip"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


	<form class="admin" id="features" name="features" action="tiki-admin.php?page=features" method="post">
		<input type="hidden" name="ticket" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ticket']->value, ENT_QUOTES, 'UTF-8', true);?>
">
		<div class="heading input_submit_container" style="text-align: right">
			<input type="submit" class="btn btn-default" name="features" value="Apply" />
			<input type="reset" class="btn btn-warning" name="featuresreset" value="Reset" />
		</div>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('tabset', array('name'=>"admin_features")); $_block_repeat=true; echo smarty_block_tabset(array('name'=>"admin_features"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>



<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>"Global features")); $_block_repeat=true; echo smarty_block_tab(array('name'=>"Global features"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>


		<fieldset>
			<legend>Main feature</legend>

			<div class="admin clearfix featurelist">
				<?php echo smarty_function_preference(array('name'=>'feature_wiki'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_file_galleries'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_blogs'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_articles'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_forums'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_trackers'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_polls'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_sheet'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_calendar'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_newsletters'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_banners'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_categories'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_freetags'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_search_fulltext'),$_smarty_tpl);?>

			</div>

		</fieldset>

		<fieldset>
			<legend>Additional</legend>

			<div class="admin clearfix featurelist">
				<?php echo smarty_function_preference(array('name'=>'feature_surveys'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_directory'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_quizzes'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_shoutbox'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_minichat'),$_smarty_tpl);?>
				
				<?php echo smarty_function_preference(array('name'=>'feature_live_support'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_tell_a_friend'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_share'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_credits'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_time_sheet'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_invoice'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_accounting'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'payment_feature'),$_smarty_tpl);?>
				
				<?php echo smarty_function_preference(array('name'=>'feature_draw'),$_smarty_tpl);?>

				<div class="adminoptionboxchild" id="feature_draw_childcontainer">
					<?php echo smarty_function_preference(array('name'=>'feature_draw_hide_buttons'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'feature_draw_separate_base_image'),$_smarty_tpl);?>

					<div class="adminoptionboxchild" id="feature_draw_separate_base_image_childcontainer">
						<?php echo smarty_function_preference(array('name'=>'feature_draw_in_userfiles'),$_smarty_tpl);?>

					</div>
				</div>

				<?php echo smarty_function_preference(array('name'=>'feature_docs'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_slideshow'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_slideshow_pdfexport'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_dynamic_content'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_perspective'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_areas'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_sefurl'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_webmail'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_actionlog'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_comm'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_contribution'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_copyright'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_mailin'),$_smarty_tpl);?>
				
					
				<?php echo smarty_function_preference(array('name'=>'feature_custom_home'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_faqs'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_galleries'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_html_pages'),$_smarty_tpl);?>
	
				
				<?php echo smarty_function_preference(array('name'=>'feature_htmlfeed'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_forwardlinkprotocol'),$_smarty_tpl);?>


				<?php echo smarty_function_preference(array('name'=>'feature_jcapture'),$_smarty_tpl);?>

				<div class="adminoptionboxchild" id="feature_jcapture_childcontainer">
					<?php echo smarty_function_preference(array('name'=>'fgal_for_jcapture'),$_smarty_tpl);?>

				</div>
				<?php echo smarty_function_preference(array('name'=>'feature_reports'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_htmlfeed'),$_smarty_tpl);?>

			</div>
		</fieldset>

		<fieldset>
			<legend>Interaction with online services or other software</legend>
			<div class="admin clearfix featurelist">		
				<?php echo smarty_function_preference(array('name'=>'connect_feature'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_maps'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_socialnetworks'),$_smarty_tpl);?>

				
				<?php echo smarty_function_preference(array('name'=>'feature_watershed'),$_smarty_tpl);?>
				
				<?php echo smarty_function_preference(array('name'=>'feature_kaltura'),$_smarty_tpl);?>
				
			
				<?php echo smarty_function_preference(array('name'=>'zotero_enabled'),$_smarty_tpl);?>

				<div class="adminoptionboxchild" id="zotero_enabled_childcontainer">
					<?php if ($_smarty_tpl->tpl_vars['prefs']->value['zotero_client_key']&&$_smarty_tpl->tpl_vars['prefs']->value['zotero_client_secret']&&$_smarty_tpl->tpl_vars['prefs']->value['zotero_group_id']){?>
						<?php $_smarty_tpl->smarty->_tag_stack[] = array('remarksbox', array('type'=>'info','title'=>"Configuration completed")); $_block_repeat=true; echo smarty_block_remarksbox(array('type'=>'info','title'=>"Configuration completed"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<a href="<?php echo smarty_function_service(array('controller'=>'oauth','action'=>'request','provider'=>'zotero'),$_smarty_tpl);?>
">Authenticate with Zotero</a><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_remarksbox(array('type'=>'info','title'=>"Configuration completed"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

					<?php }?>
					<?php echo smarty_function_preference(array('name'=>'zotero_client_key'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'zotero_client_secret'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'zotero_group_id'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'zotero_style'),$_smarty_tpl);?>

				</div>
		
			</div>
		</fieldset>
		
		
		<fieldset>
			<legend>Watches</legend>

			<div class="admin clearfix featurelist">
				<?php echo smarty_function_preference(array('name'=>'feature_user_watches'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_group_watches'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_daily_report_watches'),$_smarty_tpl);?>

				<div class="adminoptionboxchild" id="feature_daily_report_watches_childcontainer">
					<?php echo smarty_function_preference(array('name'=>'dailyreports_enabled_for_new_users'),$_smarty_tpl);?>

				</div>
				<?php echo smarty_function_preference(array('name'=>'feature_user_watches_translations'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_user_watches_languages'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_groupalert'),$_smarty_tpl);?>
				
			</div>
		</fieldset>		
		
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>"Global features"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

			
<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>"Interface")); $_block_repeat=true; echo smarty_block_tab(array('name'=>"Interface"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<fieldset class="admin clearfix featurelist">
				<legend> Ajax </legend>	
				<?php echo smarty_function_preference(array('name'=>'feature_ajax'),$_smarty_tpl);?>

				<div class="adminoptionboxchild half_width" id="feature_ajax_childcontainer">
					<?php echo smarty_function_preference(array('name'=>'ajax_autosave'),$_smarty_tpl);?>

				</div>
			</fieldset>
			<fieldset class="admin clearfix featurelist">
				<legend> jQuery plugins and add-ons </legend>
				<?php echo smarty_function_preference(array('name'=>'feature_jquery_autocomplete'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_media'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_reflection'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_superfish'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_tooltips'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_ui_theme'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_ui'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_validation'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_jquery_zoom'),$_smarty_tpl);?>

				<div class="adminoptionboxchild">
				<fieldset>
					<legend> Experimental: <?php echo smarty_function_icon(array('_id'=>'bug_error'),$_smarty_tpl);?>
</legend>
					<?php echo smarty_function_preference(array('name'=>'feature_jquery_carousel'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'feature_jquery_tablesorter'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'jquery_ui_chosen'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'jquery_ui_selectmenu'),$_smarty_tpl);?>

					<div class="adminoptionboxchild" id="jquery_ui_selectmenu_childcontainer">
						<?php echo smarty_function_preference(array('name'=>'jquery_ui_selectmenu_all'),$_smarty_tpl);?>

					</div>
				</fieldset>
				</div>
			</fieldset>

			<fieldset class="admin clearfix featurelist">
				<legend> Mobile </legend>
					<?php echo smarty_function_preference(array('name'=>'mobile_feature'),$_smarty_tpl);?>


					<div class="adminoptionboxchild" id="mobile_feature_childcontainer">
						<?php echo smarty_function_preference(array('name'=>'mobile_perspectives'),$_smarty_tpl);?>

						<fieldset>
							<legend>Mobile Themes</legend>
						<?php echo smarty_function_preference(array('name'=>'mobile_theme_header'),$_smarty_tpl);?>

						<?php echo smarty_function_preference(array('name'=>'mobile_theme_content'),$_smarty_tpl);?>

						<?php echo smarty_function_preference(array('name'=>'mobile_theme_footer'),$_smarty_tpl);?>

						<?php echo smarty_function_preference(array('name'=>'mobile_theme_modules'),$_smarty_tpl);?>

						<?php echo smarty_function_preference(array('name'=>'mobile_theme_menus'),$_smarty_tpl);?>

						<?php echo smarty_function_preference(array('name'=>'mobile_use_latest_lib'),$_smarty_tpl);?>

						</fieldset>
					</div>
			</fieldset>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>"Interface"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_smarty_tpl->smarty->_tag_stack[] = array('tab', array('name'=>"Programmer")); $_block_repeat=true; echo smarty_block_tab(array('name'=>"Programmer"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

			<div class="admin clearfix featurelist">
				<?php echo smarty_function_preference(array('name'=>'feature_integrator'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_xmlrpc'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_debug_console'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_tikitests'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'disableJavascript'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'smarty_compilation'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_webservices'),$_smarty_tpl);?>

				<?php echo smarty_function_preference(array('name'=>'feature_dummy'),$_smarty_tpl);?>
				
			</div>

			<div class="admin clearfix featurelist">
				<fieldset>
					<legend>Logging and Reporting</legend>
					<div class="adminoptionbox">
						<?php echo smarty_function_preference(array('name'=>'error_reporting_level'),$_smarty_tpl);?>

						<div class="adminoptionboxchild">
							<?php echo smarty_function_preference(array('name'=>'error_reporting_adminonly','label'=>"Visible to admin only"),$_smarty_tpl);?>

							<?php echo smarty_function_preference(array('name'=>'smarty_notice_reporting','label'=>"Include Smarty notices"),$_smarty_tpl);?>

						</div>
					</div>

					<?php echo smarty_function_preference(array('name'=>'log_mail'),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'log_sql'),$_smarty_tpl);?>

					<div class="adminoptionboxchild" id="log_sql_childcontainer">
						<?php echo smarty_function_preference(array('name'=>'log_sql_perf_min'),$_smarty_tpl);?>

					</div>
					<?php echo smarty_function_preference(array('name'=>'log_tpl'),$_smarty_tpl);?>

				</fieldset>
			</div>

			<div class="admin">
				<fieldset>
					<legend>Custom Code</legend>
					<?php echo smarty_function_preference(array('name'=>"header_custom_js"),$_smarty_tpl);?>

					<?php echo smarty_function_preference(array('name'=>'smarty_security'),$_smarty_tpl);?>

				</fieldset>
			</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tab(array('name'=>"Programmer"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tabset(array('name'=>"admin_features"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>



	<div class="input_submit_container" style="margin-top: 5px; text-align: center">
		<input type="submit" class="btn btn-default" name="features" value="Apply" />
	</div>
</form>
<?php }} ?>