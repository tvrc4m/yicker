{$header}
<div id="content">
  <div class="breadcrumb">
    {foreach from=$breadcrumbs item=breadcrumb}
      {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    {/foreach}
  </div>
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  {if $success_message}
    <div class="success">{$success_message}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}setting.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">
        <a class="btn btn-small btn-primary" onclick="tt.submit('#form')">{$button_save}</a>
      </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
        <a href="#tab-general">{$tab_general}</a>
        <a href="#tab-server">{$tab_server}</a>
        <a href="#tab-mail">{$tab_mail}</a>
        <a href="#tab-order">{$tab_order}</a>
        <a href="#tab-sms">{$tab_sms}</a>
      </div>
      <form action="{$update}" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            <tr>
              <td><span class="required">*</span> {$entry_name}</td>
              <td>
                <input class="w500" type="text" name="config_name" value="{$config_name}" />
                <span class="error">{$errors['name']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_phone}</td>
              <td>
                <input class="w500" type="text" name="config_phone" value="{$config_phone}" />
              </td>
            </tr>
            <tr>
              <td>{$entry_notice}</td>
              <td>
                <input class="w500" type="text" name="config_notice" value="{$config_notice}" />
              </td>
            </tr>
            <tr>
              <td>{$entry_power}</td>
              <td>
                <input class="w500" type="text" name="config_power" value="{$config_power}" />
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-server">
          <table class="form">
            <tr>
              <td>{$entry_error_display}</td>
              <td>
                {if $config_error_display}
                  <input type="radio" name="config_error_display" value="1" checked="checked" />
                  {$text_yes}
                  <input type="radio" name="config_error_display" value="0" />
                  {$text_no}
                {else}
                  <input type="radio" name="config_error_display" value="1" />
                  {$text_yes}
                  <input type="radio" name="config_error_display" value="0" checked="checked" />
                  {$text_no}
                {/if}
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-mail">
          <table class="form">
            <h2>邮件服务器设置</h2>
            <tr>
              <td>{$entry_mail_protocol}</td>
              <td>SMTP</td>
            </tr>
            <tr>
              <td>{$entry_smtp_host}</td>
              <td><input type="text" name="config_smtp_host" value="{$config_smtp_host}" /></td>
            </tr>
            <tr>
              <td>{$entry_smtp_username}</td>
              <td><input type="text" name="config_smtp_username" value="{$config_smtp_username}" /></td>
            </tr>
            <tr>
              <td>{$entry_smtp_password}</td>
              <td><input type="text" name="config_smtp_password" value="{$config_smtp_password}" /></td>
            </tr>
            <tr>
              <td>{$entry_smtp_port}</td>
              <td><input type="text" name="config_smtp_port" value="{$config_smtp_port}" /></td>
            </tr>
            <tr>
              <td>{$entry_smtp_timeout}</td>
              <td><input type="text" name="config_smtp_timeout" value="{$config_smtp_timeout}" /></td>
            </tr>
          </table>
          <table class="form">
            <h2>出票成功之后</h2>
            <tr>
              <td>{$entry_book_email}</td>
              <td>
                {if $config_book_email}
                  <input type="radio" name="config_book_email" value="1" checked="checked" />{$text_enabled}
                  <input type="radio" name="config_book_email" value="0" />{$text_disabled}
                {else}
                  <input type="radio" name="config_book_email" value="1" />{$text_enabled}
                  <input type="radio" name="config_book_email" value="0" checked="checked" />{$text_disabled}
                {/if}
              </td>
            </tr>
            <tr>
              <td>{$entry_book_email_list}</td>
              <td><input class="w500" type="text" name="config_book_email_list" value="{$config_book_email_list}" /></td>
            </tr>
          </table>
        </div>
        <div id="tab-order">
          <table class="form">
            <tr>
              <td>{$entry_order_unpay_status}</td>
              <td>
                <select name="config_order_unpay_status">
                  <option value="">------</option>
                  {foreach from=$order_status item=status}
                    <option {if $config_order_unpay_status==$status['order_status_id']}selected{/if} value="{$status['order_status_id']}">{$status['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['order_unpay_status']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_order_success_status}</td>
              <td>
                <select name="config_order_success_status">
                  <option value="">------</option>
                  {foreach from=$order_status item=status}
                    <option {if $config_order_success_status==$status['order_status_id']}selected{/if} value="{$status['order_status_id']}">{$status['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['order_success_status']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_order_refund_status}</td>
              <td>
                <select name="config_order_refund_status">
                  <option value="">------</option>
                  {foreach from=$order_status item=status}
                    <option {if $config_order_refund_status==$status['order_status_id']}selected{/if} value="{$status['order_status_id']}">{$status['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['order_refund_status']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_order_complete_status}</td>
              <td>
                <select name="config_order_complete_status">
                  <option value="">------</option>
                  {foreach from=$order_status item=status}
                    <option {if $config_order_complete_status==$status['order_status_id']}selected{/if} value="{$status['order_status_id']}">{$status['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['order_refund_status']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_order_close_status}</td>
              <td>
                <select name="config_order_close_status">
                  <option value="">------</option>
                  {foreach from=$order_status item=status}
                    <option {if $config_order_close_status==$status['order_status_id']}selected{/if} value="{$status['order_status_id']}">{$status['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['order_refund_status']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_order_page}</td>
              <td>
                <input type="text" name="config_order_page" value="{$config_order_page}" />
                <span class="error">{$errors['order_page']}</span>
              </td>
            </tr>
            <tr>
              <td>{$entry_order_success_message}</td>
              <td>
                <textarea id='order_success_message' name="config_order_success_message" style="width: 95%;height: 200px">{$config_order_success_message}</textarea>
                <span class="error">{$errors['order_success_message']}</span>
              </td>
            </tr>
          </table>
        </div>
        <div id="tab-sms">
          <table class="form">
            <tr>
              <td>{$entry_sms_send}</td>
              <td>
                  <input type="radio" name="config_sms_send" value="1" {if $config_sms_send}checked{/if} />
                  {$text_yes}
                  <input type="radio" name="config_sms_send" value="0" {if !$config_sms_send}checked{/if} />
                  {$text_no}
              </td>
            </tr>
            <tr>
              <td>{$entry_sms_phone}</td>
              <td>
                <input type="text" name="config_sms_phone" id="" style="width:90%" value="{$config_sms_phone}" />
              </td>
            </tr>
            <tr>
              <td>{$entry_sms_content}</td>
              <td>
                <textarea name="config_sms_content" style="width: 500px;height: 100px;">{$config_sms_content}</textarea>
                <p>{$sms_params}</p>
              </td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/default/js/ajaxupload.js"></script>
<script type="text/javascript" src="/static/default/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/default/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
   var ue = UE.getEditor('order_success_message');
</script>
{$footer}