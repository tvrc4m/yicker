<div id="page-content">
    <div class="page-container">
        <div class="accordion">
            {if !empty($wedding)}
            <div class="one-half-responsive">
                <a class="accordion-toggle sign" href="/wedding/switch" data-pjax="true">
                    {if $is_owner}
                        我的婚礼
                    {else}
                        {$wedding['groom']}和{$wedding['bride']}的婚礼
                    {/if}
                    <i class="fa fa-angle-right"></i>
                    <span>切换</span>
                </a> 
                {if !empty($modules)}
                    {foreach from=$modules item=module}
                        <a class="accordion-toggle" href="{$module['path']}" data-pjax="true">
                            <em class="fa {$module['icon']}"></em> {$module['name']}
                        </a>
                    {/foreach}
                {elseif $is_owner}
                    <div class="container center-text"><span class="text-notice">你可以点击上面的+号添加模块</span></div>
                {else}
                    <div class="container center-text"><span class="text-notice">新郎(新娘)还没有选择相应的模块</span></div>
                {/if}
            </div>
            {else}
            <div class="accordion-toggle center-text" style="height: auto;">
                在这里可以管理你的婚礼,上传结婚照,制度婚礼当天的流程,让朋友们知晓你们婚礼的进程，查看你们的婚纱照
                <p>
                    <a href="/wedding/have" data-pjax="true" class="button button-red button-round button-fullscreen">举行婚礼</a>
                    <a href="/join/verify" data-pjax="true" class="button button-red button-round button-fullscreen">参加朋友的婚礼</a>
                </p>
            </div>
            {/if}
        </div>
        <div class="clear"></div>
    </div>
</div>
