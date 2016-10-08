{$header}
<div id="content">
  <div class="breadcrumb">
    {foreach from=$breadcrumbs item=$breadcrumb}
      {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    {/foreach}
  </div>
  {if $error_warning}
    <div class="warning">{$error_warning}</div>
  {/if}
  {if $success}
    <div class="success">{$success}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.IMAGE}setting.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">
        
      </div>
    </div>
    <div class="content">
      <form action="{$delete}" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left">{$column_name}</a></td>
              <td class="left">{$column_url}</td>
              <td class="right">{$column_action}</td>
            </tr>
          </thead>
          <tbody>
            {if $stores}
              {foreach from=$stores item=store}
                <tr>
                  <td style="text-align: center;">
                    {if $store['selected']}
                      <input type="checkbox" name="selected[]" value="{$store['store_id']}" checked="checked" />
                    <?php } else { ?>
                      <input type="checkbox" name="selected[]" value="{$store['store_id']}" />
                    {/if}</td>
                  <td class="left">{$store['name']}</td>
                  <td class="left">{$store['url']}</td>
                  <td class="right">
                      [ <a href="/admin/setting/setting?store={$store['store_id']}">{$text_setting}</a> ]
                  </td>
                </tr>
              {/foreach}
            {else}
              <tr>
                <td class="center" colspan="4">{$text_no_results}</td>
              </tr>
            {/if}
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>
{$footer}