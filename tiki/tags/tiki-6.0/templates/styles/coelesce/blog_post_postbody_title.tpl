{* $Id: blog_post_postbody_title.tpl 29178 2010-09-13 17:56:34Z Jyhem $ *}
<div class="clearfix postbody-title">
	<div class="title">
		{if $blog_post_context eq 'view_blog'}
			<h2><a class="link" href="{$post_info.postId|sefurl:blogpost}">{$post_info.title|escape}</a></h2>
		{else}
			<h2>{$post_info.title|escape}</h2>
		{/if}
	</div>
</div>
