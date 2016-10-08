<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form action="/wedding/have" method="post">
                    {include file="common/form_hidden.tpl"}
                    <div class="switch switch-small" data-on-label="新郞" data-off-label="新娘">
                        <input name="is_groom" type="checkbox" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-user"></i>
                        <input class="text-field green-field" type="text" name="groom" value="{$groom}" placeholder="新郎" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-user-md"></i>
                        <input class="text-field green-field" type="text" name="bride" value="{$bride}" placeholder="新娘" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-calendar-times-o"></i>
                        <input class="text-field green-field" type="date" name="wedding_date" value="{$wedding_date}" placeholder="婚礼举办日期" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-calendar-times-o"></i>
                        <input class="text-field green-field" type="time" name="wedding_time" value="{$wedding_time}" placeholder="婚礼举办时间" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-map-marker"></i>
                        <input class="text-field green-field" type="text" name="wedding_address" value="{$wedding_address}" placeholder="婚礼举办详细地址" />
                    </div>
                    {include file="common/error.tpl"}
                    <a href="javascript:$('form').submit();" class="button button-red button-round button-fullscreen">提交</a>
                </form>
            </div>
        </div>
    </div>
</div>

