<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="accordion">
                <div class="one-half-responsive">
                    {if !empty($joined_wedding)} {foreach from=$joined_wedding item=wedding}
                    <h6 class="accordion-toggle">
                        {$wedding['groom']}和{$wedding['bride']}
                        <i class="fa fa-angle-down rotate-180"></i>
                        <span>{$wedding['wedding_date']}</span>
                    </h6>
                    <div class="accordion-content">
                        <img src="/static/flaty/img/test.jpg" alt="img" class="responsive-image full-bottom">
                        <p>
                            非常感谢各位的参加，我代表我们表达对你们的谢意之情。
                        </p>
                    </div>
                    {/foreach} {else}
                    <div class="accordion-toggle center-text">
                        还没有参加婚礼？
                        <p>
                            <a href="/join/verify" data-pjax="true" class="button button-red button-round button-fullscreen">参加婚礼</a>
                        </p>
                    </div>
                    {/if}
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
$(".accordion").find(".accordion-toggle").click(function() {
    if ($(this).find('i').hasClass('rotate-180')) {
        $(this).next().slideDown(250);
    } else {
        $(this).next().slideUp(250);
    }
    $(".accordion").find("i").not($(this).find('i')).removeClass("rotate-180"),
        $(this).find("i").toggleClass("rotate-180"),
        $(".accordion-content").not($(this).next()).slideUp(250)
})
</script>

