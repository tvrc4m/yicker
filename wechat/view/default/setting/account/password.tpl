<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form action="/account/changepwd.ajax" method="POST">
                    <input class="text-field green-field" name="oldpwd" type="password" value="{$oldpwd}" placeholder="原密码" /> {if $errors['oldpwd']}
                    <div class="error-notification color-orange-dark">
                        <p>
                            <i class="fa fa-remove"></i> {$errors['oldpwd']}
                        </p>
                    </div>
                    {/if}
                    <input class="text-field green-field" name="newpwd" type="password" value="{$newpwd}" placeholder="新密码" /> {if $errors['newpwd']}
                    <div class="error-notification color-orange-dark">
                        <p>
                            <i class="fa fa-remove"></i> {$errors['newpwd']}
                        </p>
                    </div>
                    {/if}
                    <input class="text-field green-field" name="repwd" type="password" value="{$repwd}" placeholder="确认密码" /> {if $errors['repwd']}
                    <div class="error-notification color-orange-dark">
                        <p>
                            <i class="fa fa-remove"></i> {$errors['repwd']}
                        </p>
                    </div>
                    {/if}
                    <a href="javascript:void();" data-ajax="true" class="button button-red button-round button-fullscreen">修改</a>
                </form>
            </div>
        </div>
    </div>
</div>

