<?php /* Smarty version Smarty-3.1-DEV, created on 2015-12-24 02:41:04
         compiled from "/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-list_blogs.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1368243459567b5b4054a489-03463922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0cc8b180b455ac05e22ed8e9fb6168b9f058e171' => 
    array (
      0 => '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/templates/tiki-list_blogs.tpl',
      1 => 1392158507,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1368243459567b5b4054a489-03463922',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tiki_p_create_blogs' => 0,
    'listpages' => 0,
    'find' => 0,
    'prefs' => 0,
    'numbercol' => 0,
    'offset' => 0,
    'sort_mode' => 0,
    'tiki_p_admin' => 0,
    'user' => 0,
    'tiki_p_blog_admin' => 0,
    'tiki_p_blog_post' => 0,
    'tiki_p_assign_perm_blog' => 0,
    'cant' => 0,
    'maxRecords' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_567b5b408c9737_47233610',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_567b5b408c9737_47233610')) {function content_567b5b408c9737_47233610($_smarty_tpl) {?><?php if (!is_callable('smarty_block_title')) include 'lib/smarty_tiki/block.title.php';
if (!is_callable('smarty_function_button')) include 'lib/smarty_tiki/function.button.php';
if (!is_callable('smarty_function_cycle')) include '/home/jkimdon/newStuff/coho/software/code/tiki-12.4/vendor/smarty/smarty/distribution/libs/plugins/function.cycle.php';
if (!is_callable('smarty_modifier_sefurl')) include 'lib/smarty_tiki/modifier.sefurl.php';
if (!is_callable('smarty_modifier_truncate')) include 'lib/smarty_tiki/modifier.truncate.php';
if (!is_callable('smarty_modifier_tiki_short_date')) include 'lib/smarty_tiki/modifier.tiki_short_date.php';
if (!is_callable('smarty_modifier_tiki_short_datetime')) include 'lib/smarty_tiki/modifier.tiki_short_datetime.php';
if (!is_callable('smarty_modifier_userlink')) include 'lib/smarty_tiki/modifier.userlink.php';
if (!is_callable('smarty_modifier_avatarize')) include 'lib/smarty_tiki/modifier.avatarize.php';
if (!is_callable('smarty_function_icon')) include 'lib/smarty_tiki/function.icon.php';
if (!is_callable('smarty_function_norecords')) include 'lib/smarty_tiki/function.norecords.php';
if (!is_callable('smarty_block_pagination_links')) include 'lib/smarty_tiki/block.pagination_links.php';
?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('title', array('help'=>"Blogs",'admpage'=>"blogs")); $_block_repeat=true; echo smarty_block_title(array('help'=>"Blogs",'admpage'=>"blogs"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
Blogs<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_title(array('help'=>"Blogs",'admpage'=>"blogs"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if ($_smarty_tpl->tpl_vars['tiki_p_create_blogs']->value=='y'){?>
  <div class="navbar">
		<?php echo smarty_function_button(array('href'=>"tiki-edit_blog.php",'_text'=>"Create New Blog"),$_smarty_tpl);?>

	</div>
<?php }?>
<div align="center">

<?php if ($_smarty_tpl->tpl_vars['listpages']->value||($_smarty_tpl->tpl_vars['find']->value!='')){?>
  <?php echo $_smarty_tpl->getSubTemplate ('find.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

<?php }?>

<table class="table normal">
<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable(0, null, 0);?>
<tr>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_title']=='y'||$_smarty_tpl->tpl_vars['prefs']->value['blog_list_description']=='y'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='title_desc'){?>title_asc<?php }else{ ?>title_desc<?php }?>">Blog</a></th>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_created']=='y'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='created_desc'){?>created_asc<?php }else{ ?>created_desc<?php }?>">Created</a></th>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_lastmodif']=='y'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='lastModif_desc'){?>lastModif_asc<?php }else{ ?>lastModif_desc<?php }?>">Last post</a></th>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_user']!='disabled'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='user_desc'){?>user_asc<?php }else{ ?>user_desc<?php }?>">User</a></th>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_posts']=='y'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='posts_desc'){?>posts_asc<?php }else{ ?>posts_desc<?php }?>">Posts</a></th>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_visits']=='y'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='hits_desc'){?>hits_asc<?php }else{ ?>hits_desc<?php }?>">Visits</a></th>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_activity']=='y'){?>
	<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
	<th><a href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php if ($_smarty_tpl->tpl_vars['sort_mode']->value=='activity_desc'){?>activity_asc<?php }else{ ?>activity_desc<?php }?>">Activity</a></th>
<?php }?>
<?php $_smarty_tpl->tpl_vars['numbercol'] = new Smarty_variable($_smarty_tpl->tpl_vars['numbercol']->value+1, null, 0);?>
<th>Action</th>
</tr>

<?php echo smarty_function_cycle(array('values'=>"odd,even",'print'=>false),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['changes'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['name'] = 'changes';
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['listpages']->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['changes']['total']);
?>
<tr class="<?php echo smarty_function_cycle(array(),$_smarty_tpl);?>
">
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_title']=='y'||$_smarty_tpl->tpl_vars['prefs']->value['blog_list_description']=='y'){?>
	<td class="text">
		<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual']=='n')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual_tiki_p_read_blog']=='y')){?>
			<a class="blogname" href="<?php echo smarty_modifier_sefurl($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'],'blog');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['title'], ENT_QUOTES, 'UTF-8', true);?>
">
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['title']){?>
			<?php echo htmlspecialchars(smarty_modifier_truncate($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['title'],$_smarty_tpl->tpl_vars['prefs']->value['blog_list_title_len'],"...",true), ENT_QUOTES, 'UTF-8', true);?>

		<?php }else{ ?>
			&nbsp;
		<?php }?>
		<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual']=='n')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual_tiki_p_read_blog']=='y')){?>
			</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_description']=='y'){?>
			<div class="subcomment"><?php echo nl2br(htmlspecialchars($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['description'], ENT_QUOTES, 'UTF-8', true));?>
</div>
		<?php }?>
	</td>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_created']=='y'){?>
	<td class="date">&nbsp;<?php echo smarty_modifier_tiki_short_date($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['created']);?>
&nbsp;</td><!--tiki_date_format:"%b %d" -->
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_lastmodif']=='y'){?>
	<td class="date">&nbsp;<?php echo smarty_modifier_tiki_short_datetime($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['lastModif']);?>
&nbsp;</td><!--tiki_date_format:"%d of %b [%H:%M]"-->
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_user']!='disabled'){?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_user']=='link'){?>
	<td class="username">&nbsp;<?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user']);?>
&nbsp;</td>
<?php }elseif($_smarty_tpl->tpl_vars['prefs']->value['blog_list_user']=='avatar'){?>
	<td>&nbsp;<?php echo smarty_modifier_avatarize($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user']);?>
&nbsp;<br>
	&nbsp;<?php echo smarty_modifier_userlink($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user']);?>
&nbsp;</td>
<?php }else{ ?>
	<td class="username">&nbsp;<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user'], ENT_QUOTES, 'UTF-8', true);?>
&nbsp;</td>
<?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_posts']=='y'){?>
	<td class="integer">&nbsp;<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['posts'];?>
&nbsp;</td>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_visits']=='y'){?>
	<td class="integer">&nbsp;<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['hits'];?>
&nbsp;</td>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['prefs']->value['blog_list_activity']=='y'){?>	
	<td class="integer">&nbsp;<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['activity'];?>
&nbsp;</td>
<?php }?>
<td class="action">
	<?php if (($_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user']==$_smarty_tpl->tpl_vars['user']->value)||($_smarty_tpl->tpl_vars['tiki_p_blog_admin']->value=='y')){?>
		<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual']=='n')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual_tiki_p_blog_create_blog']=='y')){?>
			<a class="icon" href="tiki-edit_blog.php?blogId=<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'];?>
"><?php echo smarty_function_icon(array('_id'=>'page_edit'),$_smarty_tpl);?>
</a>
		<?php }?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['tiki_p_blog_post']->value=='y'){?>
		<?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual']=='n')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual_tiki_p_blog_post']=='y')){?>
			<?php if (($_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user']==$_smarty_tpl->tpl_vars['user']->value)||($_smarty_tpl->tpl_vars['tiki_p_blog_admin']->value=='y')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['public']=='y')){?>
				<a class="icon" href="tiki-blog_post.php?blogId=<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'];?>
"><?php echo smarty_function_icon(array('_id'=>'pencil_add','alt'=>"Post"),$_smarty_tpl);?>
</a>
			<?php }?>
		<?php }?>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['tiki_p_blog_admin']->value=='y'&&$_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['allow_comments']=='y'){?>
		<a class='icon' href='tiki-list_comments.php?types_section=blogs&amp;blogId=<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'];?>
'><?php echo smarty_function_icon(array('_id'=>'comments','alt'=>"List all comments",'title'=>"List all comments"),$_smarty_tpl);?>
</a>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y'||$_smarty_tpl->tpl_vars['tiki_p_assign_perm_blog']->value=='y'){?>
	    <?php if (isset($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['changes']['index']]['individual'])&&$_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual']=='y'){?>
		<a class="icon" href="tiki-objectpermissions.php?objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['title']);?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'];?>
"><?php echo smarty_function_icon(array('_id'=>'key_active','alt'=>"Active Perms"),$_smarty_tpl);?>
</a>
	    <?php }else{ ?>
		<a class="icon" href="tiki-objectpermissions.php?objectName=<?php echo rawurlencode($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['title']);?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'];?>
"><?php echo smarty_function_icon(array('_id'=>'key','alt'=>"Perms"),$_smarty_tpl);?>
</a>
	    <?php }?>
	<?php }?>
        <?php if (($_smarty_tpl->tpl_vars['user']->value&&$_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['user']==$_smarty_tpl->tpl_vars['user']->value)||($_smarty_tpl->tpl_vars['tiki_p_blog_admin']->value=='y')){?>
                <?php if (($_smarty_tpl->tpl_vars['tiki_p_admin']->value=='y')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual']=='n')||($_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['individual_tiki_p_blog_create_blog']=='y')){?>
                        &nbsp;&nbsp;<a class="icon" href="tiki-list_blogs.php?offset=<?php echo $_smarty_tpl->tpl_vars['offset']->value;?>
&amp;sort_mode=<?php echo $_smarty_tpl->tpl_vars['sort_mode']->value;?>
&amp;remove=<?php echo $_smarty_tpl->tpl_vars['listpages']->value[$_smarty_tpl->getVariable('smarty')->value['section']['changes']['index']]['blogId'];?>
"><?php echo smarty_function_icon(array('_id'=>'cross','alt'=>"Remove"),$_smarty_tpl);?>
</a>
                <?php }?>
        <?php }?>
	
</td>
</tr>
<?php endfor; else: ?>
	<?php echo smarty_function_norecords(array('_colspan'=>$_smarty_tpl->tpl_vars['numbercol']->value),$_smarty_tpl);?>

<?php endif; ?>
</table>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('pagination_links', array('cant'=>$_smarty_tpl->tpl_vars['cant']->value,'step'=>$_smarty_tpl->tpl_vars['maxRecords']->value,'offset'=>$_smarty_tpl->tpl_vars['offset']->value)); $_block_repeat=true; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant']->value,'step'=>$_smarty_tpl->tpl_vars['maxRecords']->value,'offset'=>$_smarty_tpl->tpl_vars['offset']->value), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_pagination_links(array('cant'=>$_smarty_tpl->tpl_vars['cant']->value,'step'=>$_smarty_tpl->tpl_vars['maxRecords']->value,'offset'=>$_smarty_tpl->tpl_vars['offset']->value), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

</div>
<?php }} ?>