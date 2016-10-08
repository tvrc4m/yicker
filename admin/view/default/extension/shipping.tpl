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
      <h1><img src="{$smarty.const.IMAGE}shipping.png" alt="" /> {$heading_title}</h1>
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
          {if $shippings}
            {foreach from=$shippings item=shipping}
            <tr>
              <td class="left">{$langs[$shipping['code']]}</td>
              <td class="right">
                {if $shipping['installed']} 
                  [<a href="/admin/shipping/{$shipping['code']}">{$button_edit}</a>]
                  [<a href="/admin/extension/shipping/uninstall?code={$shipping['code']}">{$text_uninstall}</a>]
                {else}
                  [<a href="/admin/extension/shipping/install?code={$shipping['code']}">{$text_install}</a>]
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