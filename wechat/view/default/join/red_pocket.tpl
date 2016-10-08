<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form action="/join/red_pocket" method="POST">
                    {include file="common/form_hidden.tpl"}
                    <input class="text-field green-field" name="amount" type="text" value="{$amount}" placeholder="金额" /> {if $errors['amount']}
                    <div class="error-notification color-orange-dark">
                        <p>
                            <i class="fa fa-remove"></i> {$errors['amount']}
                        </p>
                    </div>
                    {/if}
                    <textarea name="content" class="area-field" placeholder="说点祝福的话">{$content}</textarea>
                    <a href="javascript:$('form').submit();" class="button button-red button-round button-fullscreen">发红包</a>
                </form>
            </div>
        </div>
    </div>
</div>

