<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <p>
                    <i class="fa fa-info"></i> 如果没有，请向新郎或新娘索要
                </p>
                <form action="/join/verify" method="POST">
                    <input class="text-field green-field" name="code" type="text" value="{$code}" placeholder="婚礼邀请码" />
                </form>
                {include file="common/error.tpl"}
                <a href="javascript:$('form').submit();" class="button button-red button-round button-fullscreen">验证</a>
            </div>
        </div>
    </div>
</div>

