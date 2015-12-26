<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:30:32
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/modules/mod-last_modif_pages.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1796529567b58c86dc0e7-57169817%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '011173fa6c89076c554ee732b8834e753e2d1881' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/modules/mod-last_modif_pages.tpl',
      1 => 1377003129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1796529567b58c86dc0e7-57169817',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_params' => 0,
    'tpl_module_title' => 0,
    'modLastModif' => 0,
    'nonums' => 0,
    'absurl' => 0,
    'base_url' => 0,
    'prefs' => 0,
    'maxlen' => 0,
    'namespaceoption' => 0,
    'data' => 0,
    'pagename' => 0,
    'url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b58c8862f41_95005279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b58c8862f41_95005279')) {function content_567b58c8862f41_95005279($_smarty_tpl) {?><?php if (!is_callable('smarty_block_tikimodule')) include 'lib/smarty_tiki/block.tikimodule.php';
if (!is_callable('smarty_block_modules_list')) include 'lib/smarty_tiki/block.modules_list.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_modifier_tiki_short_datetime')) include 'lib/smarty_tiki/modifier.tiki_short_datetime.php';
if (!is_callable('smarty_modifier_username')) include 'lib/smarty_tiki/modifier.username.php';
if (!is_callable('smarty_modifier_truncate')) include 'lib/smarty_tiki/modifier.truncate.php';
?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('tikimodule', array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>"last_modif_pages",'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle'])); $_block_repeat=true; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>"last_modif_pages",'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle']), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('modules_list', array('list'=>$_smarty_tpl->tpl_vars['modLastModif']->value,'nonums'=>$_smarty_tpl->tpl_vars['nonums']->value)); $_block_repeat=true; echo smarty_block_modules_list(array('list'=>$_smarty_tpl->tpl_vars['modLastModif']->value,'nonums'=>$_smarty_tpl->tpl_vars['nonums']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ix']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['name'] = 'ix';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ix']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['modLastModif']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<li>
			<a class="linkmodule" 
			<?php if ($_smarty_tpl->tpl_vars['absurl']->value=='y'){?>
				href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
tiki-index.php?page=<?php echo rawurlencode($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName']);?>
" 
			<?php }else{ ?>
				href="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName']);?>
"
			<?php }?>
			title="<?php echo smarty_modifier_tiki_short_datetime($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['lastModif']);?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['wiki_authors_style']!='lastmodif'){?>, by <?php echo smarty_modifier_username($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['user']);?>
<?php }?><?php if ((strlen($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName'])>$_smarty_tpl->tpl_vars['maxlen']->value)&&($_smarty_tpl->tpl_vars['maxlen']->value>0)){?>, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>
<?php }?>">
			<?php if ($_smarty_tpl->tpl_vars['maxlen']->value>0){?>
				<?php if ($_smarty_tpl->tpl_vars['namespaceoption']->value=='n'){?>
					<?php $_smarty_tpl->tpl_vars['data'] = new Smarty_variable(explode($_smarty_tpl->tpl_vars['prefs']->value['namespace_separator'],$_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName']), null, 0);?>
					<?php if (empty($_smarty_tpl->tpl_vars['data']->value['1'])){?>
						<?php $_smarty_tpl->tpl_vars['pagename'] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value['0'], null, 0);?>
					<?php }else{ ?>
						<?php $_smarty_tpl->tpl_vars['pagename'] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value['1'], null, 0);?>
				    <?php }?>
					<?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['pagename']->value, ENT_QUOTES, 'UTF-8', true),$_smarty_tpl->tpl_vars['maxlen']->value,"...",true);?>

				<?php }else{ ?>
					<?php $_smarty_tpl->tpl_vars['data'] = new Smarty_variable(explode($_smarty_tpl->tpl_vars['prefs']->value['namespace_separator'],$_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName']), null, 0);?>
					<?php if (sizeof($_smarty_tpl->tpl_vars['data']->value)==1){?>
						<?php $_smarty_tpl->tpl_vars['pagename'] = new Smarty_variable(htmlspecialchars($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true), null, 0);?>
					<?php }else{ ?>
						<?php $_smarty_tpl->tpl_vars['pagename'] = new Smarty_variable(htmlspecialchars($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']], ENT_QUOTES, 'UTF-8', true), null, 0);?>
					<?php }?>
					<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['pagename']->value,$_smarty_tpl->tpl_vars['maxlen']->value,"...",true);?>

				<?php }?>
			<?php }else{ ?>
				<?php $_smarty_tpl->tpl_vars['data'] = new Smarty_variable(explode($_smarty_tpl->tpl_vars['prefs']->value['namespace_separator'],$_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName']), null, 0);?>
				<?php if ($_smarty_tpl->tpl_vars['namespaceoption']->value=='n'){?>
					<?php if (empty($_smarty_tpl->tpl_vars['data']->value['1'])){?>
						<?php echo $_smarty_tpl->tpl_vars['data']->value['0'];?>

					<?php }else{ ?>
						<?php echo $_smarty_tpl->tpl_vars['data']->value['1'];?>

				    <?php }?>
				<?php }else{ ?>
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['modLastModif']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ix']['index']]['pageName'], ENT_QUOTES, 'UTF-8', true);?>

				<?php }?>
				
			<?php }?>
			</a>
		</li>
	<?php endfor; endif; ?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_modules_list(array('list'=>$_smarty_tpl->tpl_vars['modLastModif']->value,'nonums'=>$_smarty_tpl->tpl_vars['nonums']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<a class="linkmodule" style="margin-left: 20px" href="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
">...more</a>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_tikimodule(array('error'=>$_smarty_tpl->tpl_vars['module_params']->value['error'],'title'=>$_smarty_tpl->tpl_vars['tpl_module_title']->value,'name'=>"last_modif_pages",'flip'=>$_smarty_tpl->tpl_vars['module_params']->value['flip'],'decorations'=>$_smarty_tpl->tpl_vars['module_params']->value['decorations'],'nobox'=>$_smarty_tpl->tpl_vars['module_params']->value['nobox'],'notitle'=>$_smarty_tpl->tpl_vars['module_params']->value['notitle']), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }} ?>