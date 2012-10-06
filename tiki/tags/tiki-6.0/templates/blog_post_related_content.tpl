{* $Id: blog_post_related_content.tpl 28889 2010-09-03 10:08:53Z Jyhem $ *}
{if isset($post_info.related_posts) && !empty($post_info.related_posts)}
	<div class="related_posts">
		<h4>{tr}Related content:{/tr}</h4>
		<ul>	
			{foreach from=$post_info.related_posts item=related}
				<li>{self_link postId=$related.postId}{$related.name}{/self_link}</li>
			{/foreach}
		</ul>
	</div>
{/if}
