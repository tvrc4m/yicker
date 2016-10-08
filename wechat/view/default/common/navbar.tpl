<!-- 在微信ios中隐藏掉navigation bar -->
{if $show_navbar}
<div class="header-fixed">
	{if $left_navbar}
	    <a href="{$left_navbar['href']}" data-pjax="true" class="header-icon-left">
	    	<i class="fa {$left_navbar['icon']}"></i>
	    </a>
    {/if}
    <div class="header-title" style="{if $left_navbar}text-align:left;{/if}">{$title}</div>
    <span class="header-right">
    {if $right_navbar}
    	{assign var=right_bar_count value=count($right_navbar)}
    	{if $right_bar_count==2}
	    	<style type="text/css">
	    		.header-title{
	    			margin-right:9rem;
	    		}
	    		.header-right{
	    			width: 9rem;
	    		}
	    	</style>
	    {elseif $right_bar_count==3}
	    	<style type="text/css">
	    		.header-title{
	    			margin-right:13.5rem;
	    		}
	    		.header-right{
	    			width: 13.5rem;
	    		}
	    	</style>
	    {/if}
	    {foreach from=$right_navbar key=index item=bar}
	    	<a href="{$bar['href']}" {if !$bar['ajax']} data-pjax="true"{else} data-ajax="true" {/if} {foreach from=$bar['attr'] key=attr item=attr_value}{$attr}="{$attr_value}"{/foreach} class="header-icon-right {$bar['class']} {if $right_bar_count>1}{$index}{/if}" style="{if $bar['sup']}margin-top:-6.4rem;{/if}">
	    		<i class="fa {$bar['icon']}"></i>{$bar['name']}{$bar['sup']}
	    	</a>

	    {/foreach}
    {/if}
    </span>
</div>
<div class="header-clear"></div>
<script>
	function goBack(index) {
		if (typeof(index)=='undefined') index=-1;

	    if ((navigator.userAgent.indexOf('MSIE') >= 0) && (navigator.userAgent.indexOf('Opera') < 0)) { // IE 
	        if (history.length > 0 && history.length>=Math.abs(index)-1) {
	            window.history.go(index);
	        } else {
	            location.href="/";
	        }
	    } else { //非IE浏览器 
	        if (navigator.userAgent.indexOf('Firefox') >= 0 ||
	            navigator.userAgent.indexOf('Opera') >= 0 ||
	            navigator.userAgent.indexOf('Safari') >= 0 ||
	            navigator.userAgent.indexOf('Chrome') >= 0 ||
	            navigator.userAgent.indexOf('WebKit') >= 0) {

	            if (history.length > 1 && history.length>=Math.abs(index)) {
	                window.history.go(index);
	            } else {
	                location.href="/";
	            }
	        } else { //未知的浏览器 
	            if (history.length > 1 && history.length>=Math.abs(index)) {
	                window.history.go(index);
	            } else {
	                location.href="/";
	            }
	        }
	    }
	}
</script>
{else}
	<style type="text/css">
		#page-content{
			top:0;
		}
	</style>
{/if}