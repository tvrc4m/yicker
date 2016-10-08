{if !$hide_tabbar}
<div class="footer">
	<div class="footer-container">
		{foreach from=$bar_items item=bar}
		    <a href="{$bar['link']}" data-pjax="true" class="small-nav-icon {$bar['icon']} {$bar['selected']}">{$bar['name']}</a>
	    {/foreach}
    </div>
</div>
<div class="footer-clear"></div>
{else}
	<style type="text/css">
		#page-content{
			bottom:0;
		}
	</style>
{/if}