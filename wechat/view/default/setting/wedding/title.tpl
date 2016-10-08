<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form action="/mine/title.ajax" method="POST">
                    <input type="hidden" name="id" value="{$id}" />
                    <div class="text-container">
                        <p>婚礼标题</p>
                        <input class="text-field green-field" type="text" name="title" value="{$title}" placeholder="婚礼标题" />
                    </div>
                    <div class="text-container">
                        <p>副标题</p>
                        <input class="text-field green-field" type="text" name="sub_title" value="{$sub_title}" placeholder="副标题" />
                    </div>
                    {include file="common/error.tpl"}
                    <a href="javascript:void(0);" data-ajax="true" class="button button-red button-round button-fullscreen">修改</a>
                </form>
            </div>
        </div>
    </div>
</div>

