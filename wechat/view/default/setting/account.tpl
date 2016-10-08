<div id="page-content">
    <div class="page-container">
        <div class="accordion">
            <div class="one-half-responsive">
                <a class="accordion-toggle" href="javascript:void(0);" data-pjax="true">
            手机号
            <i class="fa"></i>
            <span>{$user['phone']}</span>
        </a>
                <a class="accordion-toggle" href="/setting/account/nick" data-pjax="true">
            昵称
            <i class="fa fa-angle-right"></i>
            <span>{$user['nick']}</span>
        </a>
                <a class="accordion-toggle" data-title="修改密码" href="/setting/account/password" data-pjax="true">
            {if $user['password']}
                修改密码
            {else}
                设置密码
            {/if}
            <i class="fa fa-angle-right"></i>
        </a>
                <a class="accordion-toggle" href="/setting/account/avatar" data-pjax="true">
            {if $user['avatar_url']}
                修改头像
            {else}
                设置头像
            {/if}
            <i class="fa fa-angle-right"></i>
            {if $user['avatar_url']}
                <span><img src="{$user['avatar_url']}" /></span>
            {/if}
        </a>
                <!-- <a class="accordion-toggle" href="/setting/account/email" data-pjax="true">
            修改邮箱
            <i class="fa fa-angle-right"></i>
        </a> -->
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

