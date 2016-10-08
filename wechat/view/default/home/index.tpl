<div id="page-content">
    <div class="page-container">
        <div class="">
            <div class="landing-logo">
                <img class="replace-2x" src="/static/flaty/img/logo%402x.png" alt="img" width="100" />
            </div>
        </div>
        <div class="welcome-text">
            <h3>{$wedding['title']}</h3>
            <p>{$wedding['sub_title']}</p>
        </div>
        <div class="landing-homepage">
            <ul>
                {foreach from=$modules item=module}
                <li>
                    <a href="{$module['path']}" data-pjax="true">
                        <i class="fa {$module['icon']} bg-red-dark"></i>
                        <em>{$module['name']}</em>
                    </a>
                </li>
                {/foreach}
                <li>
                    <a href="/setting/setting" data-pjax="true">
                        <i class="fa fa-cog bg-green-dark"></i>
                        <em>设置</em>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

