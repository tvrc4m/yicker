{$header}
<div id="content">
  <div class="breadcrumb">
    {foreach from=$breadcrumbs item=breadcrumb}
      {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    {/foreach}
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}user.png" alt="" />{$text_vendor_info}</h1>
      <div class="buttons">
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_back}</a>
      </div>
    </div>
    <div class="content">
      <div class="">
        <table class="form">
          <tr>
            <td>{$entry_name}</td>
            <td>{$name}</td>
          </tr>
          <tr>
            <td>{$entry_nick}</td>
            <td>{$nick}</td>
          </tr>
          <tr>
            <td>{$entry_email}</td>
            <td>{$email}</td>
          </tr>
          <tr>
            <td>{$entry_phone}</td>
            <td>{$phone}</td>
          </tr>
          <tr>
            <td>{$entry_card}</td>
            <td>{$idcard}</td>
          </tr>
          <tr>
            <td>{$entry_amount}</td>
            <td>{$amount}</td>
          </tr>
          <tr>
            <td>{$entry_create_date}</td>
            <td>{$created_date}</td>
          </tr>
          <tr>
            <td>{$entry_status}</td>
            <td>
              {if $status==1}启用{else}禁用{/if}
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</div>
{literal}
<script type="text/javascript">
</script>
{/literal}
{$footer}