<div id="page-content">
    <div class="page-container">
        <div class="container" style="margin-top: 20px;">
            <div class="page-login full-bottom">
                <form action="/login.ajax" method="post">
                    {include file="common/form_hidden.tpl"}
                    <input type="hidden" name="back" value="{$back}" />
                    <div class="icon-field">
                        <i class="fa fa-mobile-phone"></i>
                        <input class="text-field green-field" type="text" name="phone" value="{$phone}" placeholder="手机号" />
                    </div>
                    <div class="icon-field sms-container">
                        <i class="fa fa-lock"></i>
                        <input class="text-field green-field" type="password" name="password" value="{$password}" placeholder="密码" />
                        <i class="fa fa-remove remove" onclick="removePwd()"></i>
                    </div>
                    <a href="/forgot" data-pjax="true" class="forgot-password right-text">忘记密码</a>
                    <a id="submit" href="javascript:void(0);" data-ajax="true" class="button button-red button-round button-fullscreen">登陆</a>
                    <a href="/login/sms" data-pjax="true" class="button button-fullscreen">手机验证码登录</a>
                    <!-- <a href="/register" data-pjax="true" class="button button-fullscreen">注册</a> -->
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function removePwd () {
         $("input[name=password]").val("");
    }
</script>
