<div id="page-content">
    <div class="page-container">
        <div class="accordion">
            <div class="one-half-responsive">
                {if !empty($wedding)}
                <a id="wedding_code" class="accordion-toggle" href="javascript:void(0);" data-clipboard-text="{$wedding['wedding_code']}">
                婚礼邀请码
                <i class="fa fa-copy"></i>
                <span>{$wedding['wedding_code']}</span>
            </a>
                <a class="accordion-toggle" href="/setting/wedding/have" data-pjax="true">
                修改婚礼
                <i class="fa fa-angle-right"></i>
            </a>
                <a class="accordion-toggle" href="/setting/wedding/title" data-pjax="true">
                设置婚礼标题
                <i class="fa fa-angle-right"></i>
            </a>
                <a class="accordion-toggle" href="/setting/wedding/guest" data-pjax="true">
                参与来宾
                <i class="fa fa-angle-right"></i>
            </a>
                <a class="accordion-toggle" href="/setting/wedding/pocket" data-pjax="true">
                收到的红包
                <i class="fa fa-angle-right"></i>
            </a>
                <a class="accordion-toggle" href="/setting/wedding/module" data-pjax="true">
                选择模块
                <i class="fa fa-angle-right"></i>
            </a> {else}
                <div class="accordion-toggle center-text">
                    还没有结婚？
                    <p>
                        <a href="/wedding/have" data-pjax="true" class="button button-red button-round button-fullscreen">举行婚礼</a>
                    </p>
                </div>
                {/if}
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    var client = new ZeroClipboard($("#wedding_code"), {
        moviePath: "/static/js/jquery/ZeroClipboard.swf"
    });
    console.log(client);
    client.on("ready", function(readyEvent) {
        alert("ZeroClipboard SWF is ready!");

        client.on("aftercopy", function(event) {
            // `this` === `client`
            // `event.target` === the element that was clicked
            event.target.style.display = "none";
            alert("Copied text to clipboard: " + event.data["text/plain"]);
        });
    });
})
</script>

