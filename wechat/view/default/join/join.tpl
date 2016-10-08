<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                {if $joined}
                <div class="center-text">
                    恭喜你也参加
                    <a href="/account/switch/wedding?id={$wedding_id}&type=2" data-pjax="true" class="button button-red button-round button-fullscreen">切换查看</a>
                </div>
                {else if $owner}
                <div class="center-text">
                    新郎(新娘)不能作为来宾参加
                </div>
                {else}
                <form method="POST">
                    <input type="hidden" name="wedding_code" value="{$wedding_code}" />
                    <input class="text-field green-field" name="realname" value="{$realname}" type="text" placeholder="真实姓名" />
                    <input class="text-field green-field" name="phone" value="{$phone}" type="text" placeholder="联系电话" />
                    <select name="count" class="select-field">
                        <option value="1">独自一人</option>
                        <option value="2">带上男(女)朋友</option>
                        <option value="3">独自领着孩子</option>
                        <option value="3">一家三口</option>
                        <option value="3">一家四口</option>
                    </select>
                    <div class="container switch-box">
                        <h4>是否需要住宿</h4>
                        <div class="switch switch-small" data-on-label="是" data-off-label="否">
                            <input name="lodgment" value="1" type="checkbox" {if $lodgment}checked{/if} />
                        </div>
                        <em class="switch-box-subtitle">
                        将会安排相应的宾馆
                    </em>
                    </div>
                    <div class="container switch-box">
                        <h4>是否需要接送</h4>
                        <div class="switch switch-small" data-on-label="是" data-off-label="否">
                            <input name="deliver" value="1" type="checkbox" {if $deliver}checked{/if} />
                        </div>
                        <em class="switch-box-subtitle">
                        将会有后续安排
                    </em>
                    </div>
                    {include file="common/error.tpl"}
                    <a href="javascript:void(0);" onclick="tt.submit()" class="button button-red button-round button-fullscreen">参加</a>
                </form>
                {/if}
            </div>
        </div>
    </div>
</div>

