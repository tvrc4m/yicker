<div id="page-content">
    <div class="page-container">
        <div class="one-half-responsive">
            <form action="/mine/module.ajax" method="POST">
                <input type="hidden" name="from" value="{$from}" />
                {foreach from=$modules item=module}
                <div class="accordion-content setting" style="display: block;">
                    <div class="module-item">
                        <h5>{$module['name']}</h5> {if $module['content']}
                        <em>{$module['content']}</em> {/if}
                        <div class="switch switch-small" data-on-label="启用" data-off-label="关闭">
                            <input name="modules[{$module['id']}][status]" type="checkbox" {if $module[ 'status']}checked{/if} />
                        </div>
                        <div class="module-sub">
                            <div class="decoration"></div>
                            {$module['setting']}
                        </div>
                    </div>
                </div>
                {/foreach}
            </form>
        </div>
    </div>
</div>

