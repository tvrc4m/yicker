<style type="text/css">
</style>
<div id="page-content">
    <div class="page-container">
        <div class="container" style="margin-top: 20px;">
            <div class="page-login full-bottom">
                <form action="/login/sms.ajax" method="POST">
                    {include file="common/form_hidden.tpl"}
                    <input type="hidden" name="back" value="{$back}" />
                    <!-- <div class="landing-logo">
                        <img class="replace-2x" src="/static/flaty/img/logo%402x.png" alt="img" width="100" />
                    </div> -->
                    <div class="icon-field">
                        <i class="fa fa-mobile-phone"></i>
                        <input class="text-field green-field" type="text" name="phone" value="{$phone}" placeholder="手机号" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-key"></i>
                        <input class="text-field green-field" type="text" name="code" value="{$code}" placeholder="验证码" />
                        <b id="code_send" class="code_send yes">获取验证码</b>
                    </div>
                    <a href="/forgot" data-pjax="true" class="forgot-password right-text">忘记密码</a>
                    <a id="submit" href="javascript:void(0);" data-ajax="true" class="button button-red button-round button-fullscreen">登陆</a>
                    <a href="/login" data-pjax="true" class="button button-fullscreen">手机密码登录</a>
                    <!-- <a href="/register" data-pjax="true" class="button button-fullscreen">注册</a> -->
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#code_send").on('click',function () {
        tt.send_sms(this,'/sms/code.ajax','login');
    })
</script>

