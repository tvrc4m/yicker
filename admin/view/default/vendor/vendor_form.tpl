{$header}
<div id="content">
    <div class="breadcrumb">
    </div>
    {if $warning}
      <div class="warning">{$warning}</div>
    {/if}
    <div class="box">
        <div class="heading">
            <h1><img src="{$smarty.const.ADMIN_IMAGE}user.png" alt="" /> {$form_heading_title}</h1>
            <div class="buttons">
                <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
                <a onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
            </div>
        </div>
        <div class="content">
            <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-customer" class="">
                    <table class="form">
                        <tr>
                            <td class="left"><span class="required">*</span>{$entry_name}</td>
                            <td class="left">
                                <input type="text" name="name" value="{$name}" />
                                <span class="error">{$errors['name']}</span>
                            </td>
                        </tr>
                         <tr>
                            <td class="left"><span class="required">*</span>{$entry_nick}</td>
                            <td class="left">
                                <input type="text" name="nick" value="{$nick}" />
                                <span class="error">{$errors['nick']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span>{$entry_email}</td>
                            <td>
                                <input type="text" name="email" value="{$email}" />
                                <span class="error">{$errors['email']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span>{$entry_phone}</td>
                            <td>
                                <input type="text" name="phone" value="{$phone}" />
                                <span class="error">{$errors['phone']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span>{$entry_card}</td>
                            <td>
                                <input type="text" name="idcard" value="{$idcard}" />
                                <span class="error">{$errors['card']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{if !$vendor_id}<span class="required">*</span>{/if}{$entry_password}</td>
                            <td>
                                <input type="password" name="password" value="{$password}" />
                                <span class="error">{$errors['password']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{if !$vendor_id}<span class="required">*</span>{/if}{$entry_repassword}</td>
                            <td>
                                <input type="password" name="repassword" value="{$repassword}" />
                                <span class="error">{$errors['repassword']}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>{$entry_status}</td>
                            <td>
                                <select name="status">
                                    <option value="1" {if "$status"==='1'}selected{/if}>启用</option>
                                    <option value="0" {if "$status"==='0'}selected{/if}>禁用</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
{$footer}
