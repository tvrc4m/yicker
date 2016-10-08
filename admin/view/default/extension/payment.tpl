{$header}
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    <?php } ?>
  </div>
  {if $success}
    <div class="success">{$success}</div>
  {/if}
  {if $error}
    <div class="warning">{$error}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.IMAGE}payment.png" alt="" /> {$heading_title}</h1>
    </div>
    <div class="content">
      <table class="list">
        <thead>
          <tr>
            <td class="left">{$column_name}</td>
            <td class="right">{$column_action}</td>
          </tr>
        </thead>
        <tbody>
          {if $payments}
            {foreach from=$payments item=payment}
            <tr>
              <td class="left">{$langs[$payment['code']]}</td>
              <td class="right">
                {if $payment['installed']} 
                  [<a href="/admin/payment/{$payment['code']}">{$button_edit}</a>]
                  [<a href="/admin/extension/payment/uninstall?code={$payment['code']}">{$text_uninstall}</a>]
                {else}
                  [<a href="/admin/extension/payment/install?code={$payment['code']}">{$text_install}</a>]
                {/if}
              </td>
            </tr>
            {/foreach}
         {else}
            <tr>
              <td class="center" colspan="8">{$text_no_results}</td>
            </tr>
         {/if}
        </tbody>
      </table>
    </div>
  </div>
</div>
{$footer}