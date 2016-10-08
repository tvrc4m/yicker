<div id="page-content">
        <div class="page-container">
<div class="container">
    <div class="one-half-responsive">
        {if !empty($users)}
            {foreach from=$users item=user}
                <div class="user-item">
                    <img class="user-item-image preload-image" src="{$user['avatar']}" style="display: block;">
                    <h5>{$user['realname']}</h5>
                    <em>other</em>
                    <a href="#" data-pjax="true" class="user-item-icon-1 bg-green-dark scale-hover"><i class="fa fa-check"></i></a>
                    <a href="#" data-pjax="true" class="user-item-icon-2 bg-red-dark scale-hover"><i class="fa fa-times"></i></a>
                </div>
            {/foreach}
        {else}
            <div class="accordion-toggle center-text">
                还没有好友参加？
                <p>
                    <a href="javascript:void(0);" class="button button-red button-round button-fullscreen">马上分享邀请好友</a>
                </p>
            </div>
        {/if}
        <!-- <div class="user-item">
            <img class="user-item-image preload-image" alt="img" src="/static/flaty/img/test.jpg" style="display: block;">
            <h5>Alex Well</h5>
            <em>New York, United States.</em>
            <a href="#" data-pjax="true" class="user-item-icon-1 facebook-color scale-hover"><i class="fa fa-facebook"></i></a>
            <a href="#" data-pjax="true" class="user-item-icon-2 twitter-color scale-hover"><i class="fa fa-twitter"></i></a>
        </div>
        <div class="user-item">
            <img class="user-item-image preload-image" alt="img" src="/static/flaty/img/test.jpg" style="display: block;">
            <h5>Max Jack</h5>
            <em>New York, United States.</em>
            <a href="#" data-pjax="true" class="user-item-icon-1 google-color scale-hover"><i class="fa fa-google-plus"></i></a>
            <a href="#" data-pjax="true" class="user-item-icon-2 facebook-color scale-hover"><i class="fa fa-facebook"></i></a>
        </div>
        <div class="user-item">
            <img class="user-item-image preload-image" alt="img" src="/static/flaty/img/test.jpg" style="display: block;">
            <h5>Dan Jim</h5>
            <em>New York, United States.</em>
            <a href="#" data-pjax="true" class="user-item-icon-1 phone-color scale-hover"><i class="fa fa-phone"></i></a>
            <a href="#" data-pjax="true" class="user-item-icon-2 mail-color scale-hover"><i class="fa fa-envelope-o"></i></a>
        </div>
        <div class="user-item">
            <img class="user-item-image preload-image" alt="img" src="/static/flaty/img/test.jpg" style="display: block;">
            <h5>Man Ted</h5>
            <em>New York, United States.</em>
            <a href="#" data-pjax="true" class="user-item-icon-3 bg-green-dark scale-hover">Follow</a>
        </div>
        <div class="user-item">
            <img class="user-item-image preload-image" alt="img" src="/static/flaty/img/test.jpg" style="display: block;">
            <h5>Man Ted</h5>
            <em>New York, United States.</em>
            <a href="#" data-pjax="true" class="user-item-icon-3 bg-red-dark scale-hover">Delete</a>
        </div>
    </div> -->
    </div>
</div>
</div>
</div>

