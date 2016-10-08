{assign var=page value=$urlpage['page']}
{if $urlpage['total']>1}
<div class="tb-pagination tb-pagination-new">
	<div class="pagination">
		<div class="pagination-pages">
			<div class="pagination-page">
				{if $page>1 && $page<$urlpage['total']}
					<div class="page-wrap page-siblings">
						<a class="page-next" href="{$urlpage['prev']}" title="上一页">上一页</a>
					</div>
				{/if}
				{if $page>5}
					<div class="page-wrap">
						<span class="page-cur">1</span>
					</div>
					<span class="page-split">...</span>
				{/if}
				{foreach from=$urlpage['pages'] item=up}
					{if $page==$up['page']}
						<div class="page-wrap">
							<span class="page-cur">{$page}</span>
						</div>
					{else}
						<div class="page-wrap">
							<div class="bg"></div>
							<a title="第{$up['page']}页" href="{$up['pageurl']}" class="page">{$up['page']}</a>
						</div>
					{/if}
				{/foreach}
				{assign var=last value=array_pop($urlpage['pages'])}
				{if ($page<$urlpage['total'] && $last['page']<$urlpage['total']) }
					<span class="page-split">...</span>
					<div class="page-wrap page-siblings">
						<a class="page-next" href="{$urlpage['next']}" title="下一页">下一页</a>
					</div>
				{/if}
			</div>
			<div class="pagination-count">
				<span>共</span>
				<span class="b">{$urlpage['total']}</span>
				<span>页</span>
			</div>
		</div>
	</div>
</div>
{/if}