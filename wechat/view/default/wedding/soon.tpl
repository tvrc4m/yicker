<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="cover-page cover-image">
                <div class="cover-page-content unboxed-layout">
                    <div class="content-strip">
                        <img alt="img" src="/static/flaty/img/test.jpg" style="display: block;">
                    </div>
                    <div class="page-soon">
                        <h1>{$wedding['title']}</h1>
                        <h4>{$wedding['sub_title']}</h4>
                        <p>
                        </p>
                        <div class="countdown-class">
                            {if $is_waiting}
                            <div class="date-days">{$date['day']}<em>天</em> </div>
                            <div class="date-hours">{$date['hour']}<em>小时</em> </div>
                            <div class="date-minutes">{$date['minute']}<em>分钟</em> </div>
                            <div class="date-seconds">0<em>秒</em> </div>
                            {elseif $is_over} 婚礼已结束
                            <p>{date('Y-m-d',$wedding['wedding_date'])}</p>
                            {else} 婚礼正在开始
                            <p>{date('Y-m-d',$wedding['wedding_date'])}</p>
                            {/if}
                        </div>
                    </div>
                    <div class="strip-content">
                        {if $is_waiting && !$is_over && !$is_owner}
                        <a href="/join/verify" data-pjax="true" class="button button-red button-round button-fullscreen">报名参加</a> {elseif $is_owner}
                        <a href="javascript:void(0);" class="button button-red button-round button-fullscreen">
                        通过分享邀请好友
                    </a> {/if}
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
var wedding_date = new Date("{date('Y-m-d H:i:s',$wedding['wedding_date'])}");
</script>
{if $is_waiting && !$is_over} {literal}
<script type="text/javascript">
$('.countdown-class').countdown({
    until: wedding_date,
    timezone: +8,
    layout: "<div class='date-years'>{yn}<em>years</em> </div><div class='date-days'>{dn}<em>{dl}</em> </div><div class='date-hours'>{hn}<em>{hl}</em> </div><div class='date-minutes'>{mn}<em>{ml}</em> </div><div class='date-seconds'>{sn}<em>{sl}</em> </div>",
    expiryText: "婚礼正在开始",
    onExpiry: function() {
        console.log(23432434);
    }
});
</script>
{/literal} {/if} 

