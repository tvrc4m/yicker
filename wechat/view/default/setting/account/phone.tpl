<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form action="/setting/account/phone" method="POST">
                    {include file="common/form_hidden.tpl"}
                    <input class="text-field green-field" name="phone" type="text" value="{$phone}" placeholder="旧手机号" />
                    <div class="error-phone error-notification color-orange-dark {if !$error['phone']}hidden{/if}">
                        <p>
                            <i class="fa fa-remove"></i> {$errors['phone']}
                        </p>
                    </div>
                    <input class="text-field green-field hidden" name="code" type="text" value="{$code}" placeholder="验证码" />
                    <a href="javascript:void(0);" onclick="send(this)" class="button button-red button-round button-fullscreen">发达手机短信</a>
                </form>
            </div>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
function send(that) {
    var phone = tt.val("phone");
    if (!phone || !/\d{11}/.test(phone)) {
        console.log(2222);
        $('input[name=phone]').addClass('error-notification');
        $(".error-phone").css('display', 'block');
        $(that).focus();
        return false;
    }
    tt.post("/setting/sms", {
        phone: phone
    }, function(data) {

    })
}
</script>
{/literal} 
