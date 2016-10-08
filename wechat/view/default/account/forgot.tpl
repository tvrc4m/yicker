<div id="page-content">
    <div class="page-container">
        <div class="container" style="margin-top: 70px;">
            <div class="page-login full-bottom">
                <form action="/forgot.ajax" method="post">
                    {include file="common/form_hidden.tpl"}
                    <div class="icon-field">
                        <i class="fa fa-mobile-phone"></i>
                        <input class="text-field green-field" type="text" name="phone" value="{$phone}" placeholder="手机号" />
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-key"></i>
                        <input class="text-field green-field" type="text" name="code" value="{$code}" placeholder="短信验证码" />
                        <b id="code_send" class="code_send yes">获取验证码</b>
                    </div>
                    <div class="icon-field">
                        <i class="fa fa-lock"></i>
                        <input class="text-field green-field" type="password" name="password" placeholder="密码" />
                        <i class="fa fa-remove remove" onclick="removePwd()"></i>
                    </div>
                    {include file="common/error.tpl"}
                    <a id="submit" href="javascript:void(0);" data-ajax="true" class="button button-red button-round button-fullscreen">确认</a>
                    <a href="/login" data-pjax="true" class="button button-fullscreen">手机密码登录</a>
                    <!-- <a href="/login/sms" data-pjax="true" class="button button-fullscreen">手机短信登录</a> -->
                </form>
            </div>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
    function removePwd () {
         $("input[name=password]").val("");
    }
    $("#code_send").on('click',function () {
        tt.send_sms(this,'/sms/code.ajax','forgot');
    })
</script>
{/literal}